<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product_Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
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
    public function store(Request $request)
    {
        // img one to many
        if($request->file('photos')){
            $path = public_path('tmp/uploads');
            if ( ! file_exists($path) ) {
                mkdir($path, 0777, true);
            }
            $photos = [];
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move($path, $name);
                    $photos[] = $name;
                }
            }
        }
        // lưu product
            $inventories= Inventory::create([
                'quantity' => $request->quantity,
            ]);

            // relationship


            $category = Category::findOrFail($request->category_id);
            $category =  $inventories->products()->create($request->all());
            // duyệt từng ảnh và thực hiện lưu
            foreach ($request->photos as $photo) {
                Image::create([
                    'product_id' => $category->id,
                    'link' => $name
                ]);
            }


            // $user = User::findOrFail($request->user_id);
            // $test = $user->products()->create($request->all());


            $category = Category::all();

            //Kiểm tra delete để trả về một thông báo
            if ($category) {
                Session::flash('success', 'Create Successful !');
            }else {
                Session::flash('error', 'Create Failed !');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
