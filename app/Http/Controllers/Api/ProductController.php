<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Constants\Params;

class ProductController extends Controller
{
    function search(Request $request)
    {

        $result = Product::with('images')->filter()->paginate(Params::LIMIT_SHOW);

        if (count($result)) {
            return Response()->json($result);
        } else {
            return response()->json(['Result' => 'No Data not found'], 404);
        }
    }



    // api list-product-thuộc-category
    public function categories_products($id)
    {
        $categories = Category::find($id)->products->pluck('id');
        $products = Product::with('images')->whereIn('id',$categories)->paginate(Params::LIMIT_SHOW);
         return response(['data'=>$products]);
    }

    // api all-products
    public function all_products(Request $request)
    {
        // $product = Product::with(['categories', 'images'])->paginate(10);
        // if ($key = request()->key) {
        //     $product = Product::orderBy('created_at', 'DESC')->where('name', 'like', '%'.$key.'%')->paginate(10);
        // }
        //  return response($product);


        $param = $request->input('keyword');
        $products = Product::with('images')->paginate(Params::LIMIT_SHOW);

        return response()->json([
            'product' => $products,
        ]);

    }

    // api list-images-thuộc-products
    public function images_products($id)
    {
        $images = Product::find($id)->images;
        return response(['data'=>$images]);
    }

    // image-product-dai-dien
    public function images_avatar_products($id)
    {
        $images = Product::find($id)->images->first();
        return response(['data'=>$images]);
    }

    public function product_detail($id)
    {
        $products = Product::with('images')->find($id);

        return  Response()->json($products);
    }


}
