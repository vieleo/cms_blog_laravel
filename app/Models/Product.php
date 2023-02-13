<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $fillable = [
        'name',
        'avatar',
        'price_old',
        'category_id',
        'price_new',
        'quantity',
        // 'user_id',
        'status',
        'description',
    ];

    // one to many relationship
    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    // one to many relationship
    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function orderDetailWithProduct()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }



    public function scopeFilter($products)
    {
        if (request('search')) {
            $products->where('name', 'LIKE', '%'.request('search').'%');
        }
        if (request('price_from')) {
            $products->where('price_new', '>=', request('price_from'))
                ->where('price_new', '<=', request('price_to'))->orderBy('price_new', 'asc');
        }
        if (request('time') == 'newest') {
            $products->orderBy('created_at', 'desc');
        }
        if (request('time') == 'oldest') {
            $products->orderBy('created_at', 'asc');
        }
        if (request('sort') == 'za') {
            $products->orderBy('name', 'desc');
        }
        if (request('sort') == 'az') {
            $products->orderBy('name', 'asc');
        }
        if (request('price') == 'desc') {
            $products->orderBy('price_new', 'desc');
        }
        if (request('price') == 'asc') {
            $products->orderBy('price_new', 'asc');
        }

        return $products;

    }
}
