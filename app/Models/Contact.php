<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

use App\Models\User;

class Contact extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'contact';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_request_id',
        'user_confirm_id',
        'name',
        'email',
        'message',
        'is_accept',
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

    public function users() {
        return $this->belongsTo(User::class, 'user_confirm_id', 'id');
    }

}
