<?php

namespace App\Http\Controllers\User;

use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    // user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $rating = Rating::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','categories','cart','rating'));
    }

    // password change page
    public function changePasswordPage(){
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.account.changePassword',compact('cart'));
    }

    // password change
    public function change(Request $request){

        $this->passwordValidationCheck($request);
        $dbHashPassword = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashPassword = $dbHashPassword->password;

        if(Hash::check($request->oldPassword, $dbHashPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with(['passwordChange' => 'Your password is changed...']);
        }

        return back()->with(['notMatch' => 'Your password is not same with old password.Try again!']);
    }

    // profile page
    public function profile(){
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.account.profile',compact('cart'));
    }

    // edit profile
    public function edit($id,Request $request){
        $this->editProfileValidationCheck($request);
        $data = $this->getProfileData($request);

        if($request->hasFile('image')){

            $fileName = uniqid() .'_'. $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;

            $oldImageName = User::where('id',$id)->first();
            $oldImageName = $oldImageName->image;
            Storage::delete('public/'.$oldImageName);

        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess' => 'Profile update successful...']);

    }

    // pizza filter
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','categories','cart'));
    }

    // pizza list
    public function pizzaList($id){
        $pizza = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $rating = Rating::where('user_id',Auth::user()->id)->get();
        return view('user.main.details',compact('pizza','pizzaList','cart','rating'));
    }

    // cart list
    public function cartList(){
        $cart = Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('user_id',Auth::user()->id)->get();

        $totalPrice = 0;
        foreach($cart as $c){
            $totalPrice += $c->product_price * $c->quantity;
        }

        return view('user.cart.cart',compact('cart','totalPrice'));
    }

    // direct history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.cart.history',compact('order','cart'));
    }

    // direct contact page
    public function contactPage(){
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.contact.contact',compact('cart'));
    }


    // password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required |min:6|same:newPassword',
        ])->validate();
    }

    // edit profile validation check
    private function editProfileValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,png,jpeg,avif,webp | file',
        ])->validate();
    }

    // get profile data
    private function getProfileData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }
}
