<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $users = User::select()->get();

        return response()->json([
            'users' => $users
        ], 201);
    }

    public function show(Request $request, $id){
        $user = User::find($id);

        return response([
            'user' => $user
        ], 201);
    }

    public function store(Request $request){
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'users' => $users
        ], 201);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response([
            'user' => $user
        ], 201);
    }

    public function delete(Request $request, $id){
        $user = User::find($id);
        $user->delete();

        return response([
            'user' => $user
        ], 201);
    }
}
