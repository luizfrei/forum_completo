<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('category_id'); 
            $table->string('title'); 
            $table->text('description'); 
            $table->boolean('status')->default(true); 
            $table->timestamps(); 

            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('topics');
    }
};