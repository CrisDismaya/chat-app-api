<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $auth = Auth::user();
        $contact = Contact::with('users')
            ->where('is_accept', '1')
            ->where(function($query) use ($auth) {
                $query->where('user_request_id', $auth->id)
                    ->orWhere('user_confirm_id', $auth->id);
            })
            ->get();

        $contactFormat = $contact->map(function ($item) {
            return [
                'id' => $item->id,
                'users' => $item->users
            ];
        });

        return response()->json([
            'contact' => $contactFormat
        ], 201);
    }

    public function store(Request $request){
        $auth = Auth::user();
        $user = User::where('email', 'like', '%'. $request->email .'%')->whereNotNull('email_verified_at')->whereNull('deleted_at')->first();

        if(!$user){
            return response()->json([
                'contact' => 'This email is not exist'
            ], 401);
        }
        else if($user->id == $auth->id){
            return response()->json([
                'contact' => 'This email is same your email'
            ], 401);
        }

        $contact = Contact::create([
            'user_request_id' => $auth->id,
            'user_confirm_id' => $user->id,
            'name' => $user->name,
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
        $auth = Auth::user();
        $contact = Contact::where('user_confirm_id', $auth->id)
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
        $auth = Auth::user();

        $contact = Contact::with('users')
            ->where('is_accept', '1')
            ->where(function($query) use ($request) {
                $search = $request->search;
                $query->whereHas('users', function($subquery) use ($search) {
                    $subquery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->where(function($query) use ($auth) {
                $query->where('user_request_id', $auth->id)
                    ->orWhere('user_confirm_id', $auth->id);
            })
            ->get();

        return response()->json([
            'contact' => $contact
        ], 201);
    }
}
