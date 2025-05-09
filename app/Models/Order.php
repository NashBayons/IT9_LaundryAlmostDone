<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Add all fields that can be mass-assigned
    protected $fillable = [
        'order_name',
        'weight',
        'date',
        'service_type',
        'status',
        'payment_method',
        'payment_status',
        'amount',
        'special_instructions',
        'is_archived'
    ];
}