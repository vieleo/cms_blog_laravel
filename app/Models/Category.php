<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable =[
        'name',
        'description'
    ];

    /**
     * Category has many .
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    //  many to many relationship
    public function products()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = category_id, localKey = id)
        // return $this->hasMany(Product::class, 'category_id');
        return $this->belongsToMany(Product::class,'products_categories','category_id','id');
    }
}
