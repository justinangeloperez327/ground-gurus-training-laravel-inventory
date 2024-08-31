<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'delivery_date',
        'status',
        'supplier_id',
        'user_id',
    ];

    protected $casts = [
        'status' => 'string',
        'items.*.id' => 'integer',
        'items.*.quantity' => 'integer',
        'items.*.price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity', 'price');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
