<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ListApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // api-search
    public function search($key)
    {
         $product = Product::orderBy('created_at', 'DESC')->where('name', 'like', '%'.$key.'%')->paginate(10);
         return response(['data'=>$product]);
    }

    // api list-category
    public function categories()
    {
        $categories = DB::table('categories')->paginate(5);
        return response(['data'=>$categories]);
    }

    // api list-product-thuộc-category
    public function categories_products($id)
    {
        $categories = Category::find($id)->products;
         return response(['data'=>$categories]);
    }

    // api list-images-thuộc-products
    public function images_products($id)
    {
        $images = Product::find($id)->images;
        return response(['data'=>$images]);
    }


}
