<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable =[
        'quantity'
    ];

    // one to one relationship
    public function products()
    {
    return $this->hasOne(Product::class, 'inventory_id', 'id');
    }

}
