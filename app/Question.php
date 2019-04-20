<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function subscribesToQuestion() {
        return $this->hasMany('App\Subscribe', 'question_id');
    }
}
