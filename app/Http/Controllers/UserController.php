<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;

use App\Models\User;


class UserController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $users = User::all();

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
        $otp = fake()->unique()->randomNumber(6);
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Mail::to($request->email)->send(new EmailVerification($otp));

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
