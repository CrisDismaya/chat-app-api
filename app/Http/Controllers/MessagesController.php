<?php

namespace App\Http\Controllers;

use App\Events\SendMessageNotification;
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
        $message = Messages::where('sender_id', $user->id)->get();

        return response()->json([
            'message' => $message
        ], 201);
    }

    public function store(Request $request){
        $user = Auth::user();
        $message = Messages::create([
            'sender_id'  => $user->id,
            'receiver_id'  => $request->receiver_id,
            'group_chat_id'  => $request->group_chat_id,
            'message'  => $request->message,
        ]);

        // event(new SendMessageNotification($request->message));

        return response()->json([
            'message' => $message
        ], 201);
    }

    public function show($id){
        $message = Messages::find($id);

        return response()->json([
            'messages' => $message
        ], 201);
    }

    public function update(Request $request, $id){
        $message = Messages::find($id);
        $message->update([
            'message' => $request->message
        ]);

        return response()->json([
            'message' => $message
        ], 201);
    }

    public function delete(Request $request, $id){
        $message = Messages::find($id);
        $message->update([
            'is_delete' => $request->is_delete
        ]);

        return response()->json([
            'message' => $message
        ], 201);
    }

    public function search(Request $request){
        $user = Auth::user();
        $message = Messages::where('is_delete', '0')->whereNull('deleted_at')
            ->where('sender_id', $user->id)
            ->where(function($query) use ($request) {
                $search = $request->search;

                $query->where('message', 'like', '%' . $search . '%');
            })
            ->get();

        return response()->json([
            'message' => $message,
        ], 201);
    }
}
