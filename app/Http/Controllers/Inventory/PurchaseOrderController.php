<?php

namespace App\Http\Controllers\Inventory;

use App\Models\supplier;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller
{
    public function create()
    {
        $suppliers = supplier::all();
        $items = InventoryItem::all();
        return view('employee.stock.PurchcaseOrder', compact('suppliers', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:inventory_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Start a database transaction to ensure both Purchase Order and Items are saved together
        \DB::beginTransaction();

        try {
            $lastOrder = PurchaseOrder::latest()->first();
            $nextId = $lastOrder ? $lastOrder->id + 1 : 1;
            $orderNumber = 'PO-' . $nextId;

            // Create the Purchase Order
            $purchaseOrder = PurchaseOrder::create([
                'supplier_id' => $request->supplier_id,
                'order_number' => $orderNumber,
                'order_date' => now(),
                'status' => 'pending', // Set a default status for now
            ]);

            // Loop through the items and create PurchaseOrderItems
            foreach ($request->items as $item) {
                PurchaseOrderItem::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'item_id' => $item['item_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);
            }

            // Commit the transaction
            \DB::commit();

            // Redirect back with a success message
            return redirect()->route('employee.purchase-orders.create')->with('success', 'Purchase Order created successfully!');
        } catch (\Exception $e) {
            // Rollback if there is an error
            \DB::rollBack();
            return redirect()->route('employee.purchase-orders.create')
                     ->with('error', 'Error: ' . $e->getMessage());
        }
    }


}
