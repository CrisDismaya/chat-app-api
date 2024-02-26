<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Messages;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $user = Auth::user();
        $messages = Messages::where('user_id', $user->id)->get();

        return response()->json([
            'messages' => $messages
        ], 201);
    }

    public function store(Request $request){
        $message = Messages::create([
            'group_chat_id' => $request->group_chat_id,
            'user_id' => $request->user_id,
            'message' => $request->message,
        ]);

        return response()->json([
            'messages' => $message
        ], 201);
    }
}
