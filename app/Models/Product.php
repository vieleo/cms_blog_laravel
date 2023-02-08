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
        return $this->hasMany(OrderItem::class);
    }
}
