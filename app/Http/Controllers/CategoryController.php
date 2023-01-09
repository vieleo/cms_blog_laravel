<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Session;
use App\Http\Requests\CategoryRequest;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')->paginate(10);
        return view('admin.category.list',compact('categories'));
    }

    public function getModel()
    {
        $data = Product::find(1)->images->toArray();
        dd($data);
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
    public function store(CategoryRequest $request)
    {

        $cate = $request->validated();
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
        try
            {
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
            }
        catch (Exception $e)
            {
                return $e->getMessage();
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
        try
            {
                $categories = Category::findOrFail($id);
                $categories->delete();

                //Kiểm tra delete để trả về một thông báo
                if ($categories) {
                    Session::flash('success', 'Delete Successful !');
                }else {
                    Session::flash('error', 'Delete Failed !');
                }
            }
        catch (Exception $e)
            {
                return $e->getMessage();
            }
        return redirect('/admin/list-category');
    }
}
