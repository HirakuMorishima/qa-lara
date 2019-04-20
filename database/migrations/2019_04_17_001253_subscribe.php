<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subscribe extends Migration
{
    public function up()
    {
        Schema::create('subscribes', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('status');
            $table->longText('message');
            $table->timestamps();
            
            $table->index('question_id');
            $table->index('user_id');
            
            // 参照制約
            $table->foreign('question_id')
                ->references('id')
                ->on('questions');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            
        });
    }


    public function down()
    {
        Schema::drop('subscribes');
    }
}
