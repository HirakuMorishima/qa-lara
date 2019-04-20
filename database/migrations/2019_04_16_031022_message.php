<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Message extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->longText('body');
            $table->unsignedBigInteger('to_user_id');
            $table->unsignedBigInteger('from_user_id');
            $table->timestamps();
            
            $table->index( 'to_user_id' );
            $table->index( 'from_user_id' );
            
            // 参照制約 (Usersテーブルへの外部キー)
            $table->foreign('to_user_id')
                ->references('id')
                ->on('users');
            $table->foreign('from_user_id')
                ->references('id')
                ->on('users');
            
        });
    }


    public function down()
    {
        Schema::drop('messages');
    }
}
