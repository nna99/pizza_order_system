<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    // rating
    public function rating(Request $request){
        Rating::create([
            'user_id' => $request->userId,
            'rating_count' => $request->ratingCount,
            'product_id' => $request->productId
        ]);
        $response = [
            'status' => 'success',
            'message' => 'Add to like successful..',
        ];
        return response()->json($response, 200);

    }

    // favorite product show
    public function ratingShow(){
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $rating = Rating::get();
        $pizza = Product::select('products.*','ratings.product_id as product_id')
                ->leftJoin('ratings','ratings.product_id','products.id')
                ->orderBy('created_at','desc')->get();
        return view('user.main.rating',compact('categories','pizza','cart','rating'));
    }


}
