<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        $contacts = Contact::all();
        return response()->json([
            'data' => $contacts,
            'message'=> 'Contacts Data Fetched',
            'status' => 200
        ]);
    }

    public function create(Request $request) {
        Contact::create([
           'name' => $request['name'],
           'email' => $request['email'],
           'dasignation' => $request['dasignation'],
           'phone' => $request['phone'],
           'adress' => $request['adress'],
        ]);
        return response()->json([
            'message' => 'Data Saved Successfully',
            'status' => 200
        ]);
    }

    public function deleteContact($id){
        $contact = Contact::find($id);
        if($contact){
            $contact->delete();
            return response()->json([
                'message' => 'Contact Deleted Successfully',
                'status' => 200
            ]);
        }else{
            return response()->json([
                'message' => "Contact for id:$id not Found",
                'status' => 400
            ]);
        }
    }


    public function edit($id){
        $contact = Contact::find($id);
       if($contact){
        return response()->json([
            'data' => $contact,
            'status' => 200
        ]);
       }else{
        return response()->json([
        'data' => "Contact NOt Found",
        'status' => 400
        ]);
       };
    }

    public function update(Request $request,$id){
        $contact = Contact::where('id',$id)->first();

        $contact->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'dasignation' => $request['dasignation'],
            'phone' => $request['phone'],
            'adress' => $request['adress'],
        ]);
        return response()->json([
            'message' => 'Contact Updated Successfully',
            'status' => 200
        ]);

    }
}
