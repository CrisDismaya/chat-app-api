<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct()
    {

    }
    
    public function index(){
        $contact = Contact::all();

        return response()->json([
            'contact' => $contact
        ], 201);
    }

    public function store(Request $request){
        $contact = Contact::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response()->json([
            'contact' => $contact
        ], 201);
    }

    public function show(Request $request, $id){
        $contact = Contact::find($id);

        return response()->json([
            'contact' => $contact
        ], 201);
    }

    public function update(Request $request, $id){
        $contact = Contact::find($id);
        $contact->update([
            'name' => $request->name,
        ]);
    }

    public function delete(Request $request, $id){
        $contact = Contact::find($id);
        $contact->delete();

        return response()->json([
            'contact' => $contact
        ], 201);
    }
}
