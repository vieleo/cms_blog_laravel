<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Category has many .
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    //  one to many relationship
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
