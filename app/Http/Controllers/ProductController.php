<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // products list
    public function list(){
        $pizza = Product::select('products.*','categories.name as category_name')
            ->leftJoin('categories','products.category_id','categories.id')
            ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })->orderBy('products.created_at','desc')
          ->paginate(3);
          $pizza->appends(request()->all());
        return view('admin.product.list',compact('pizza'));
    }

    // direct products create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    // pizza create
    public function create(Request $request){
        $this->pizzaValidationCheck($request,"create");
        $data = $this->getPizzaData($request);

        $fileName = uniqid() . '_' . $request->pizzaImage->getClientOriginalName();
        $request->pizzaImage->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list',"create")->with(['createSuccess' => 'Pizza create successful...']);

    }

    // pizza details
    public function view($id){
        $pizza = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.view',compact('pizza'));
    }

    // delete pizza
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Pizza delete successful...']);
    }

    // product update page
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.edit',compact('pizza','category'));
    }

    // update product
    public function update(Request $request){
        $this->pizzaValidationCheck($request,"update");
        $data = $this->getPizzaData($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid() . "_" . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list')->with(['updateSuccess' => 'Pizza update successful...']);
    }


    // get pizza data
    private function getPizzaData($request){
        return [
            'name' => $request->pizzaName,
            'category_id' => $request->pizzaCategory,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }


    // pizza validation check
    private function pizzaValidationCheck($request,$action){
        $validation = [
            'pizzaName' => 'required|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required',
        ];

        $validation['pizzaImage'] = $action == "create" ? 'required|mimes:png,jpg,jpeg,webp,avif | file' : 'mimes:png,jpg,jpeg,webp,avif | file';
        Validator::make($request->all(),$validation)->validate();
    }

}


