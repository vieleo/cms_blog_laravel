<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Session;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.list',compact('categories'));
    }

    public function getModel()
    {
        // return view('admin.layouts.layout');
        $data = Product::find(1)->images->toArray();
        dd($data);
        // $data = Category::find()->products->toArray();
        // dd($data);
        // $data = Category::all();
        // foreach($data as $test){

        //     dd($test->id);
        // }


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            // 'description' => 'required',
        ],[
            'name.required' => '* The name field is required.',
            // 'description.required' => 'Nhập mô tả ',
            'name.max' => 'Name field up to 255 characters',

        ]);
        if($validate->fails()){
        return back()->withErrors($validate->errors())->withInput();
        }
        try
            {
                $cate = new Category;
                if ($cate) {
                    $cate->name = $request->get('name');
                    $cate->description = $request->get('description');
                    $cate->save();
                    //Kiểm tra Insert để trả về một thông báo
                    if ($cate) {
                        Session::flash('success', 'Add Successful !');
                    }else {
                        Session::flash('error', 'Add Failed !');
                    }
                    return view('admin.category.add');
                }else{
                    return "Data note Found";
                }

            }
        catch (Exception $e)
            {
                return $e->getMessage();
            }

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
        $categories = Category::findOrFail($id);
        return view('admin.category.edit', compact('categories'));
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
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            // 'description' => 'required',
        ],[
            'name.required' => '* The name field is required.',
            // 'description.required' => 'Nhập mô tả ',
            'name.max' => 'Name field up to 255 characters',

        ]);
        if($validate->fails()){
        return back()->withErrors($validate->errors())->withInput();
        }
        $categories = Category::find($id);
        $categories->name = $request->name;
        $categories->description = $request->description;
        $categories->save();

        //Kiểm tra delete để trả về một thông báo
        if ($categories) {
            Session::flash('success', 'Update Successful !');
        }else {
            Session::flash('error', 'Update Failed !');
        }

        return redirect('/admin/list-category');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        //Kiểm tra delete để trả về một thông báo
        if ($categories) {
            Session::flash('success', 'Delete Successful !');
        }else {
            Session::flash('error', 'Delete Failed !');
        }

        return redirect('/admin/list-category');

    }
}
