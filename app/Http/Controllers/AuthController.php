<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;

class AuthController extends Controller
{

    public function auth(){
        return response()->json([
            'auth' => auth('sanctum')->check()
        ], 401);
    }

    public function login(Request $request){
        $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->whereNull('deleted_at')->first();

        if($user){
            if (!Auth::attempt($request->all())) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            Auth::user();
            return $user->getToken($user);
        }

        return response()->json([
            'users' => $user,
        ], 401);
    }

    public function logout(){
        $user = Auth::user()->id;
        $user = User::where('id', $user)->first();

        return $user->deleteToken($user);
    }

    public function otpValidate(Request $request){
        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();
        $user->update([
            'email_verified_at' => Carbon::now(),
            'otp' => null
        ]);

        return response()->json([
            'user' => $user
        ], 201);
    }
}
