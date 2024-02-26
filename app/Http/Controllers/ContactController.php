<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $user = Auth::user();
        $contact = Contact::whereNull('deleted_at')
            ->where('is_accept', '1')
            ->where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->get();

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
            'email' => $request->email,
        ]);

        return response()->json([
            'contact' => $contact
        ], 201);
    }

    public function delete(Request $request, $id){
        $contact = Contact::find($id);
        $contact->delete();

        return response()->json([
            'contact' => $contact
        ], 201);
    }

    public function contactRequest(){
        $user = Auth::user();
        $contact = Contact::where(DB::raw('LOWER(email)'), strtolower($user->email))
            ->whereNull('deleted_at')
            ->where('is_accept', '0')
            ->get();

        return response()->json([
            'contact' => $contact,
        ], 201);
    }

    public function contactConfirm($id){
        $contact = Contact::find($id);
        $contact->update([
            'is_accept' => '1'
        ]);

        return response()->json([
            'contact' => $contact,
        ], 201);
    }

    public function search(Request $request){
        $user = Auth::user();
        $contact = Contact::whereNull('deleted_at')
            ->where('is_accept', '1')
            ->where(function($query) use ($request, $user) {
                $search = $request->search;

                $query->where('user_id', $user->id);

                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->get();

        return response()->json([
            'contact' => $contact,
        ], 201);
    }
}
