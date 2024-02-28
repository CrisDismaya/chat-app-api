<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

use App\Models\GroupChatMember;

class GroupChat extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'group_chat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function group_chats() {
        return $this->hasMany(GroupChatMember::class);
    }

    public function members() {
        return $this->hasMany(GroupChatMember::class, 'group_chat_id', 'id');
    }
}
