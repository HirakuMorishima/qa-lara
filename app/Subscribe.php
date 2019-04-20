<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function question() {
        return $this->belongsTo('App\Question', 'question_id');
    }
    private static $listName = [1 => '応募', 2 => '質問中', 3 => '回答済み', 4 => '解決済み'];
    public function getStatusName()
        {
            return self::$listName[$this->status];
        }
}
