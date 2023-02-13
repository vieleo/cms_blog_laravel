<?php

namespace App\Http\Controllers;

use App\Constants\Params;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Exception;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::paginate(Params::LIMIT_SHOW);
        $total_order = Order::all();
        return view('admin.order.cart', compact('order', 'total_order'));
    }


    public function show(Request $request, $id)
    {
        $detail = DB::table('order_items')->where('order_id', $id)->get();
        $order = DB::table('orders')->where('id', $id)->first();
        $user = Order::find($id)->user;
        $profile = DB::table('profiles')->where('id', $id)->first();



        return view('admin.order.detail', compact('detail','order','user','profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        try {
            $order = Order::find($id);
            $order->status = $request->status;
            $order->save();

            //Kiểm tra delete để trả về một thông báo
            if ($order) {
                Session::flash('success', 'Update Successful !');
            } else {
                Session::flash('error', 'Update Failed !');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return redirect('/admin/cart');
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
