<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;



class ProductService
{
    public function storeProduct($request)
    {
        $server_storage = 'http://172.16.21.143/';
        $cate = $request->validated();
        // relationship
        $products = Product::all();
        $category = Category::findOrFail($request->category_id);
        $products = $category->products()->create($request->all());
        // xử lý images
        if ($request->hasFile('photos')) {
            $files = $request->file('photos');
            foreach ($files as $file) {
                $imageName = $file->getClientOriginalName();
                $request['product_id'] = $products->id;
                $request['link'] =  $server_storage . 'tmp/uploads/'. $imageName;
                $file->move(\public_path('tmp/uploads'), $imageName);
                Image::create($request->all());
            }
        }
        if ($category) {
            Session::flash('success', 'Create Successful !');
        } else {
            Session::flash('error', 'Create Failed !');
        }
    }

    public function updateProduct(Request $request, $id)
    {
        // $server_storage = 'http://172.16.21.143/';
        $server_storage = 'http://viet.fresher.ameladev.click/';
        $products = Product::findOrFail($id);
        $products->fill($request->all());
        // xử lý images
        Image::where('product_id',$id)->delete();
        if ($request->hasFile('photos')) {
            $files = $request->file('photos');
            foreach ($files as $file) {
                $imageName = $file->getClientOriginalName();
                $request['product_id'] = $products->id;
                $request['link'] = $server_storage . 'tmp/uploads/'. $imageName;
                $file->move(\public_path('tmp/uploads'), $imageName);
                Image::create($request->all());
            }
        }
            $products->update();
    }

    public function deleteProduct($id)
    {
        $products = Product::find($id)->orderDetailWithProduct->count();
            if( $products >0 ){
                return Redirect::to('/admin/list-product')
                        ->with('message', 'Something went wrong');
            }
            else{
                $products = Product::findOrFail($id);
                $images = Image::where("product_id",$products->id)->get();
                foreach($images as $image){
                    if (File::exists("tmp/uploads/". $image->photo)){
                        File::delete("tmp/uploads/". $image->photo);
                    }
                }
                $products->delete();
                //Kiểm tra delete để trả về một thông báo
                if ($products) {
                    Session::flash('success', 'Delete Successful !');
                } else {
                    Session::flash('error', 'Delete Failed !');
                }
            }
    }
}
