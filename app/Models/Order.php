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
        'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function oderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
