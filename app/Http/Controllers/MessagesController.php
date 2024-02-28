<?php

namespace App\Http\Controllers;

use App\Events\SendMessageNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Contact;
use App\Models\GroupChat;
use App\Models\Messages;
use App\Models\User;

class MessagesController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $auth = Auth::user();
        // $message = Messages::where('sender_id', $user->id)->get();

        $users = User::with('userContacts', 'userGroups.groups')
            ->whereHas('userContacts')->orWhereHas('userGroups')
            ->whereNot('id', $auth->id)
            ->get();

        $contacts = Contact::with('users')
            ->where('is_accept', '1')
            ->where(function($query) use ($auth) {
                $query->where('user_request_id', $auth->id)
                    ->orWhere('user_confirm_id', $auth->id);
            })->get();

        $groupChats = GroupChat::with('members')
            ->where(function($query) use ($auth) {
                $query->whereHas('members', function($subquery) use ($auth) {
                    $subquery->where('user_id', $auth->id);
                });
            })->get();

        // $messages = $contacts->union($groupChats)->get();


        return response()->json([
            // 'messages' => $messages,
            'users' => $users,
            // 'contacts' => $contacts,
            // 'groupChats' => $groupChats,
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
