<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

use App\Models\User;
use App\Models\GroupChat;

class GroupChatMember extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'group_chat_member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_chat_id',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'group_chat_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function groups() {
        return $this->belongsTo(GroupChat::class, 'group_chat_id', 'id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
