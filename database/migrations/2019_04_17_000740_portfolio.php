<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Portfolio extends Migration
{
    public function up()
    {
        Schema::create('portfolios', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->longText('content');
            $table->timestamps();
            
            $table->index('user_id');
        
        // 参照規約
        $table->foreign('user_id')
            ->references('id')
            ->on('users');
        });
      }


    public function down()
    {
        Schema::drop('portfolios');
    }
}
