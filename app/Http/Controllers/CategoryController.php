<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct list page
    public function list(){
        $categories = Category::when(request('key'), function($query){
            $query->where('name','like','%'. request('key') .'%');
        })->orderBy('id','asc')->paginate(7);

        return view('admin.category.list',compact('categories'));
    }

    // direct create page
    public function createPage(){
        return view('admin.category.create');
    }

    // category data create
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->categoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess'=>'Category Created...']);

    }

    // category delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted...']);
    }

    // edit page
    public function editPage($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // update
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->categoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');
    }


    // category validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,' . $request->categoryId
        ])->validate();
    }

    // category data
    private function categoryData($request){
        return [
            'name' => $request->categoryName
        ];
    }
}
