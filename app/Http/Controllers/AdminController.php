<?php

namespace App\Http\Controllers;


use Storage;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // password change page
    public function passwordChangePage(){
        return view('admin.account.changePassword');
    }

    // password change method
    public function passwordChange(Request $request){

        $this->passwordValidationCheck($request);

        $currentId = Auth::user()->id;
        $oldPass = User::select('password')->where('id',$currentId)->first();
        $dbPassword = $oldPass->password;

        // dd(Hash::make($request->oldPassword));

        if(Hash::check($request->oldPassword, $dbPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];

            User::where('id', $currentId)->update($data);  // array type
            return back()->with(['passwordChange' => "Your password is changed"]);

        }
        return back()->with(['notMatch' => "The old password not match. Try again!"]);
    }

    // account info
    public function details(){
        return view('admin.account.details');
    }

    // edit profile
    public function edit(){
        return view('admin.account.edit');
    }

    // profile update
    public function update($id,Request $request){

        $this->updateValidationCheck($request);
        $data = $this->getUpdateData($request);


        if($request->hasFile('image')){
            $oldImageName = User::where('id',$id)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#account')->with(['updateSuccess' => 'Update Profile Successful...']);
    }

    // admin list page
    public function list(){
        $admin = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
                })->where('role','admin')->paginate(4);
            $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    // admin account delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin account deleted...']);
    }

    // change role page
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    // change role
    public function change($id,Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    // admin change role using ajax
    public function ajaxChangeRole(Request $request){

        $changeRole = User::where('id',$request->userId)->update([
            'role' => $request->role
        ]);
        return response()->json($changeRole, 200);
    }

    // direct user list
    public function userList(){
        $users = User::when(request('key'),function($query){
                    $query->orWhere('name','like','%'.request('key').'%')
                          ->orWhere('email','like','%'.request('key').'%')
                          ->orWhere('phone','like','%'.request('key').'%')
                          ->orWhere('gender','like','%'.request('key').'%');
                        })->where('role','user')
                          ->paginate(4);
        $users->appends(request()->all());
        return view('admin.account.userList',compact('users'));
    }

    // user change role using ajax
    public function userChangeRole(Request $request){
        User::where('id',$request->userId)->update([
            'role' => $request->role
        ]);
    }

    // user delete
    public function userDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User account deleted...']);

    }


    // request user data
    private function requestUserData($request){
        return [
            'role' => $request->role
        ];
    }

    // update validation check
    private function updateValidationCheck($request){
       Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,jpeg,png,web,avif|file',
       ])->validate();
    }

    // get update data
    private function getUpdateData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }



    // password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }
}
