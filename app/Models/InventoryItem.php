<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $table = 'inventory_items'; // Explicitly set table name

    protected $fillable = [
        'name',
        'category',
        'quantity',
        'price',
        'status'
    ];
}