<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // get product list
    public function productList(){
        $product = Product::get();
        return response()->json($product, 200);
    }

    // get category list
    public function categoryList(){
        $category = Category::get();
        return response()->json($category, 200);
    }

    // get order list
    public function orderList(){
        $order = Order::get();
        $orderList = OrderList::get();

        $data = [
            'order' => $order,
            'orderList' => $orderList
        ];

        return $data['order'][0]->user_id;
        return response()->json($data, 200);
    }

    // create category
    public function createCategory(Request $request){
        $data = [
            'name' => $request->name
        ];
        $response = Category::create($data);
        return response()->json($response, 200);
    }

    // create contact
    public function createContact(Request $request){
        $data = $this->getContactData($request);
        Contact::create($data);
        $response = Contact::get();
        return response()->json($response, 200);
    }

    // delete category
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['message' => 'delete success','deleteData' => $data], 200);
        }

        return response()->json(['message' => 'there is no category'], 200);

    }

    // delete category by get method
    public function deleteCategoryByGet($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['message'=>'delete success..','deleteData'=>$data], 200);
        }
        return response()->json(['message'=>'there is no category'], 200);
    }

    // category detail
    public function categoryDetail(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        return response()->json($data, 200);
    }

    // category update
    public function categoryUpdate(Request $request){

        $categoryId = $request->category_id;
        $data = $this->getCategoryUpdateData($request);
        if(isset($categoryId)){
            Category::where('id',$categoryId)->update($data);
            $response = Category::where('id',$categoryId)->first();
            return response()->json(['status'=>'true','message'=>'update success','updated'=>$response], 200);
        }
        return response()->json(['message'=>'there is no category for update'], 500);
        }


    // get contact data
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }

    // get category update data
    private function getCategoryUpdateData($request){
        return [
            'name' => $request->category_name
        ];
    }

}


/*
category list
http://localhost:8000/api/category/list  (GET)

create category
http://localhost:8000/api/create/category (POST)

create contact
http://localhost:8000/api/create/contact  (POST)

delete category
http://localhost:8000/api/delete/category/10   (GET)

category detail
http://localhost:8000/api/category/detail   (POST)

category update
http://localhost:8000/api/category/update  (POST)



*/
