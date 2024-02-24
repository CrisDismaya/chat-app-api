<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{

    public function auth(){
        return response()->json([
            'auth' => auth('sanctum')->check()
        ], 401);
    }

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();

        if (!Auth::attempt($request->all())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        Auth::user();
        return $user->getToken($user);
    }

    public function logout(){
        $user = Auth::user()->id;
        $user = User::where('id', $user)->first();

        return $user->deleteToken($user);
    }
}
