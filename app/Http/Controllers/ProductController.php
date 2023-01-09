<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Session;
use App\Http\Requests\ProductRequest;






class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(User::all()->toArray());
        $product = Product::orderBy('created_at', 'DESC')->paginate(10);
        // search
        if ($key = request()->key){
            $product = Product::orderBy('created_at', 'DESC')->where('name','like','%'.$key.'%')->paginate(10);
        }
        return view('admin.product.list',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.product.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $cate = $request->validated();
        try
            {
            // lưu product

                // relationship
                $products = Product::all();
                $category = Category::findOrFail($request->category_id);
                $products = $category->products()->create($request->all());
                // xử lý images
                if ($request->hasFile("photos")){
                    $files = $request->file("photos");
                    foreach ($files as $file) {
                        $imageName=$file->getClientOriginalName();
                        $request['product_id'] = $products->id;
                        $request['link'] = $imageName;
                        $file->move(\public_path('tmp/uploads'),$imageName);
                        Image::create($request->all());
                    }
                }
                $category = Category::all();
                //Kiểm tra delete để trả về một thông báo
                if ($category) {
                    Session::flash('success', 'Create Successful !');
                }else {
                    Session::flash('error', 'Create Failed !');
                }
            }
        catch (Exception $e)
            {
                return $e->getMessage();
            }
        return view('admin.product.add', compact('category'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::findOrFail($id);
        return view('admin.product.detail', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $category = Category::all();
        return view('admin.product.edit', compact('products','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
            {
                $products = Product::findOrFail($id);
                $products->delete();

                //Kiểm tra delete để trả về một thông báo
                if ($products) {
                    Session::flash('success', 'Delete Successful !');
                }else {
                    Session::flash('error', 'Delete Failed !');
                }
            }
        catch (Exception $e)
            {
                return $e->getMessage();
            }

        return redirect('/admin/list-product');
    }
}
