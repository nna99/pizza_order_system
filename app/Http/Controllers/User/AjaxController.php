<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // pizza list
    public function pizzaList(Request $request){
        if($request->status == 'asc'){
            $data = Product::orderBy('created_at','asc')->get();
        }else{
            $data = Product::orderBy('created_at','desc')->get();
        }

        return response()->json($data, 200);
    }

    // add to cart
    public function addToCart(Request $request){
        $getData = $this->orderPizza($request);
        Cart::create($getData);

        $response = [
            'status' => 'success',
            'message' => 'Add to cart successful..',
        ];
        return response()->json($response, 200);

    }

    // order
    public function order(Request $request){

        $total = 0;
        foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total_price' => $item['total'],
                'order_code' => $item['order_code']
            ]);

            $total += $data->total_price;
        }

        logger($data->order_code);
        Cart::where('user_id',Auth::user()->id)->delete();
            Order::create([
                'user_id' => Auth::user()->id,
                'order_code' => $data->order_code,
                'total_price' => $total + 2500,
            ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order complete'
        ], 200);
    }

    // clear cart all
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // delete button cart
    public function deleteCart(Request $request){
        $orderId = $request['orderId'];
        $productId = $request['productId'];


        Cart::where('user_id',Auth::user()->id)
            ->where('product_id',$productId)
            ->where('id',$orderId)
            ->delete();
    }

    // view count
    public function viewCount(Request $request){

        $product = Product::where('id',$request->productId)->first();

        $viewCount = [
            'view_count' => $product->view_count + 1
        ];

        Product::where('id',$request->productId)->update($viewCount);
    }


    // get order pizza
    private function orderPizza($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'quantity' => $request->count
        ];
    }
}
