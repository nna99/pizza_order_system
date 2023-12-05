<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list
    public function list(){
        $order = Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->when(request('key'),function($query){
                        $query->where('users.name','like','%'.request('key').'%');
                    })->orderBy('orders.created_at','desc')
                      ->paginate(5);
                      $order->appends(request()->all());
        return view('admin.order.orderList',compact('order'));
    }

    // order status sorting
    public function orderStatus(Request $request){
        $order = Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->orderBy('created_at','desc');
            if($request->orderStatus == null){
                $order = $order->paginate(5);
            }else{
                $order = $order->orWhere('status',$request->orderStatus)
                               ->paginate(5);
            }
            $order->appends(request()->all());
            return view('admin.order.orderList',compact('order'));
    }

    // change status
    public function changeStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status' => $request->status
        ]);
    }

    // order list
    public function orderList($orderCode){
        $orderList = OrderList::select('order_lists.*','users.name as user_name','users.phone as user_phone','products.name as product_name','products.image as product_image')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->where('order_code',$orderCode)->get();
        $order = Order::where('order_code',$orderCode)->get();

        return view('admin.order.orderInfo',compact('orderList','order'));
    }



}
