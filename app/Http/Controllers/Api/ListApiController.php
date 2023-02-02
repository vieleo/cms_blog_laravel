<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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

    // image-product-dai-dien
    public function images_avatar_products($id)
    {
        $images = Product::find($id)->images->first();
        return response(['data'=>$images]);
    }


    // profile-user
    public function profile_user()
    {
        $profile = User::find(auth('api')->user()->id)->profile;
        $user = $profile;
        return response()->json([
            'status' => 'success',
            'profile' => $user,
            'user' => Auth::user()
        ]);
    }

    // update-profile
    public function update_profile(Request $request)
    {
        $user = User::findOrFail(auth('api')->user()->id);
        $user->profile()->updateOrCreate(
            ['user_id' => auth('api')->user()->id],
            [
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ]
        );
        $profile = User::find(auth('api')->user()->id)->profile;
        $user['profile'] = $profile;
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully edit profile',
            'user' => $user,
        //    'profile' =>$profile
        ]);
    }

}
