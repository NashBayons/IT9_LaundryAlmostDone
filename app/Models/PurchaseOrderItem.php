<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $fillable = 
    ['purchase_order_id', 'item_id', 'quantity', 'unit_price', 'status'];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function item()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class, 'item_id');
    }
}
