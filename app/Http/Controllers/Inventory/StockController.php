<?php

namespace App\Http\Controllers\Inventory;

use App\Models\supplier;
use App\Models\StockLevel;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\StockTransaction;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function stockInForm()
    {
        $items = InventoryItem::all();  // Get all inventory items
        $suppliers = supplier::all();  // Get all suppliers
        return view('employee.stock.stock_in', compact('items', 'suppliers'));
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

            $stockLevel->save();

            // Commit the transaction
            \DB::commit();

            return redirect()->route('employee.stock-in.form')->with('success', 'Stock-in successful!');
        } catch (\Exception $e) {
            // Rollback if there is an error
            \DB::rollBack();
            return redirect()->route('stock-in.form')->with('error', 'An error occurred. Please try again.');
        }
    }
}
