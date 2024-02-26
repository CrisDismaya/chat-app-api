<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Contact;
use App\Models\GroupChatMember;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'otp',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function contact() {
        return $this->belongsTo(Contact::class, 'user_id', 'id');
    }

    public function groupChatMembers(){
        return $this->hasMany(GroupChatMember::class);
    }

    public static function validate($request) {
        return $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
    }

    public function getToken($user) {
        // , expiresAt: Carbon::now()->addHours(5)
        $token = $user->createToken('login')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function deleteToken($user) {
        $token = $user->tokens()->delete();

        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}
