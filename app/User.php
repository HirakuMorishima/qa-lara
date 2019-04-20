<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'message'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function messagesToUser() {
        return $this->hasMany('App\Message', 'to_user_id');
    }
    public function messagesFromUser() {
        return $this->hasMany('App\Message', 'from_user_id');
    }
    public function questionsToUser() {
        return $this->hasMany('App\Question', 'user_id');
    }
    public function portfoliosToUser() {
        return $this->hasMany('App\Portfolio', 'user_id');
    }
    public function subscribesToUser() {
        return $this->hasMany('App\Subscribe', 'user_id');
    }
}
