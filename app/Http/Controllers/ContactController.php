<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // contact message
    public function sendMessage(Request $request){
        $data = $this->getData($request);
        Contact::create($data);
        return back()->with(['successMessage' => 'Your message was sent...']);

    }

    // admin view user contact page
    public function contactPage(){
        $contact = Contact::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->paginate(7);
        $contact->appends(request()->all());
        return view('admin.contact.contactPage',compact('contact'));
    }

    // contact get data
    private function getData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }
}
