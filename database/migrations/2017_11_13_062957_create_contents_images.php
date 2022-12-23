<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_images', function (Blueprint $table){
            $table->increments('id');
            $table->integer('content_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('path')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->unsigned()->default(0);
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('default_photo')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('content_images');
    }
}
