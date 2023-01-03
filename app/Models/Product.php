<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Category;
use App\Models\Inventory;


class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable =[
        'name',
        'price_old',
        'price_new',
        'inventory_id',
        // 'user_id',
        'status',
        'description'
    ];



    // one to many relationship
    public function images()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = category_id, localKey = id)
        return $this->hasMany(Image::class, 'product_id');
    }


    // many to many relationship
    public function categories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = category_id, localKey = id)
        return $this->belongsToMany(Category::class,'products_categories', 'product_id', 'id');
    }





}
