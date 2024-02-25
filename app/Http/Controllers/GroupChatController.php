<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GroupChat;
use App\Models\GroupChatMember;

class GroupChatController extends Controller
{
    public function __construct()
    {

    }

    public function index() {
        // $group_chat = GroupChat::all();
        $group_chat = GroupChat::with('members.users')->get();
        return response()->json([
            'group' => $group_chat
        ], 201);
    }

    public function store(Request $request) {
        $group = GroupChat::create([
            'path' => $request->path,
            'user_id' => $request->user_id,
            'name' => $request->name,
        ]);

        foreach ($request->members as $item) {
            GroupChatMember::create([
                'group_chat_id' => $group->id,
                'user_id' => $item,
            ]);
        }

        $group_chat = GroupChat::with('members.users')->find($group->id);

        return response()->json([
            'group' => $group_chat
        ], 201);
    }

    public function show($id) {
        $group = GroupChat::with('members.users')->find($id);

        return response()->json([
            'group' => $group
        ], 201);
    }

    public function update(Request $request, $id) {
        $group = GroupChat::find($id);
        $group->update([
            'path' => $request->path,
            'name' => $request->name,
        ]);

        return response()->json([
            'group' => $group
        ], 201);
    }

    public function delete($id) {
        $group = GroupChat::find($id);
        $group->delete();

        return response()->json([
            'group' => $group
        ], 201);
    }

    public function addMember(Request $request, $id) {
        $group = GroupChat::find($id);

        foreach ($request->members as $item) {
            GroupChatMember::create([
                'group_chat_id' => $group->id,
                'user_id' => $item,
            ]);
        }

        return response()->json([
            'group' => $group
        ], 201);
    }

    public function removeMember(Request $request, $id) {
        $group = GroupChat::find($id);
        $members = GroupChatMember::where('group_chat_id', $group->id)->where('user_id', $request->members[0])->get();
        $members[0]->delete();

        return response()->json([
            'group' => $group
        ], 201);
    }
}
