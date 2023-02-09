<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    protected $service;
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->paginate(10);
        // search
        if ($key = request()->key) {
            $product = Product::orderBy('created_at', 'DESC')->where('name', 'like', '%'.$key.'%')->paginate(10);
        }
        return view('admin.product.list', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        return view('admin.product.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->service->storeProduct($request);
            DB::commit();
            $category = Category::all();
            return view('admin.product.add', compact('category'));
        } catch (Exception $e) {
            DB::rollBack();
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
        return view('admin.product.edit', compact('products', 'category'));
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
        DB::beginTransaction();
        try {
            $this->service->updateProduct($request, $id);
            DB::commit();
           return redirect('/admin/list-product');
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->service->deleteProduct($id);
            DB::commit();
            return redirect('/admin/list-product');
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
