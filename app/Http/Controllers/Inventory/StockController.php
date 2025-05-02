<?php

namespace App\Http\Controllers\Inventory;

use App\Models\supplier;
use App\Models\StockLevel;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use App\Models\StockTransaction;
use App\Models\PurchaseOrderItem;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function stockInForm(Request $request)
    {
        $items = InventoryItem::all();  // Get all inventory items
        $suppliers = supplier::all();  // Get all suppliers

        $purchaseOrders = PurchaseOrder::with('supplier')->where('status', '!=', 'complete')->get();
        $selectedOrder = null;

        if ($request->has('purchase_order_id')) {
            $selectedOrder = PurchaseOrder::with(['supplier', 'items.inventoryItem'])
                                ->find($request->purchase_order_id);
        }
    
        return view('employee.stock.stock_in', compact('items', 'suppliers', 'purchaseOrders', 'selectedOrder'));
    }

    public function stockIn(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:inventory_items,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Start a database transaction to handle multiple operations
        \DB::beginTransaction();

        try {
            // Create a stock transaction record
            $stockTransaction = StockTransaction::create([
                'item_id' => $request->item_id,
                'supplier_id' => $request->supplier_id,
                'transaction_type' => 'stock_in',
                'quantity' => $request->quantity,
                'price' => $request->price,
            ]);

            // Update the stock level
            $stockLevel = StockLevel::where('item_id', $request->item_id)->first();

            if ($stockLevel) {
                // If stock level exists, update it
                $stockLevel->quantity += $request->quantity;
            } else {
                // If no stock level exists, create it
                $stockLevel = StockLevel::create([
                    'item_id' => $request->item_id,
                    'quantity' => $request->quantity,
                ]);
            }

            $item = InventoryItem::where('id', $request->item_id)->first();

            if ($item) {
                $item->quantity += $request->quantity;
            } else {
                // This case should never happen unless data is corrupted
                throw new \Exception("Inventory item not found.");
            }

            $stockLevel->save();
            $item->save();
            // Commit the transaction
            \DB::commit();

            return redirect()->route('employee.stock-in.form')->with('success', 'Stock-in successful!');
        } catch (\Exception $e) {
            // Rollback if there is an error
            \DB::rollBack();
            return redirect()->route('stock-in.form')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function stockInFromPurchaseOrderForm(Request $request)
    {
        $purchaseOrders = PurchaseOrder::with('supplier')->where('status', ['pending', 'approved', 'received'])->get();

        $selectedOrder = null;
        if ($request->purchase_order_id) {
            $selectedOrder = PurchaseOrder::with(['supplier', 'items.inventoryItem'])
                                ->findOrFail($request->purchase_order_id);
        }

        return view('employee.stock.stock_in', [
            'purchaseOrders' => $purchaseOrders,
            'purchaseOrder' => $selectedOrder
        ]);
    }


    public function stockInFromPurchaseOrderSubmit(Request $request, $purchaseOrderId)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:purchase_order_items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        \DB::beginTransaction();

        try {
            $purchaseOrder = PurchaseOrder::findOrFail($purchaseOrderId);

            foreach ($request->items as $itemData) {
                $poItem = PurchaseOrderItem::findOrFail($itemData['id']);
                $quantityToStockIn = (int) $itemData['quantity'];

                // Update Stock Level
                $stockLevel = StockLevel::firstOrNew(['item_id' => $poItem->item_id]);
                $stockLevel->quantity += $quantityToStockIn;
                $stockLevel->save();

                $item = InventoryItem::findOrFail($poItem->item_id);
                $item->quantity += $quantityToStockIn;
                $item->save();

                // Create Stock Transaction
                StockTransaction::create([
                    'item_id' => $poItem->item_id,
                    'supplier_id' => $purchaseOrder->supplier_id,
                    'transaction_type' => 'stock_in',
                    'quantity' => $quantityToStockIn,
                    'price' => $poItem->price,
                ]);

                // Update the purchase order item
                $poItem->stocked_in_quantity += $quantityToStockIn;
                $poItem->save();
            }

            // Check if all items are fully stocked in
            $allStockedIn = $purchaseOrder->items->every(function ($item) {
                return $item->stocked_in_quantity >= $item->quantity;
            });

            if ($allStockedIn) {
                $purchaseOrder->status = 'received';
                $purchaseOrder->save();
            }

            \DB::commit();
            return redirect()->route('employee.stock-in.form')->with('success', 'Stock-in completed.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function stockOutForm()
    {
        $items = InventoryItem::all();
        return view('employee.stock.stock_out', compact('items'));
    }

    public function stockOutSubmit(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:inventory_items,id',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
        ]);

        \DB::beginTransaction();
        try {
            $item = InventoryItem::findOrFail($request->item_id);
            $stockLevel = StockLevel::where('item_id', $item->id)->first();

            if (!$stockLevel || $stockLevel->quantity < $request->quantity) {
                throw new \Exception("Insufficient stock.");
            }

            $stockLevel->quantity -= $request->quantity;
            $item->quantity -= $request->quantity;
            $stockLevel->save();
            $item->save();

            StockTransaction::create([
                'item_id' => $item->id,
                'supplier_id' => null,
                'transaction_type' => 'stock_out',
                'quantity' => $request->quantity,
                'price' => null,
                'reason' => $request->reason,
            ]);

            \DB::commit();
            return redirect()->route('employee.stock-out.form')->with('success', 'Stock-out successful.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

}
