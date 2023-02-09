<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'payment_method',
        'status',
        'subtotal'

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
