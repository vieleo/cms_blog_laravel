<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderProduct(Request $request)
    {
        $user_id = auth('api')->user()->id;
        $payment_method = $request['payment_method'];
        $subtotal = $request['subtotal'];
        $order = new Order();
        $order['user_id'] = $user_id;
        $order['payment_method'] = $payment_method;
        $order['subtotal'] = $subtotal;
        $order['status'] = 1;
        $order->save();

        $object = $request->obj;

        foreach ($object as $obj) {
            $products = Product::find($obj['product_id']);
            $quantity = $products->quantity - $obj['quantity'];
            DB::table('order_items')->insert([
                'order_id' => $order->id,
                'product_id' => $obj['product_id'],
                'quantity' => $obj['quantity'],
                'name_product' => $products->name,
                'price' => $products->price_new,
            ]);
            $products->update([
                'quantity' => $quantity,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully payment',
        ]);
    }
}
