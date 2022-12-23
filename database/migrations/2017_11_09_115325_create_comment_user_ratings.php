<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentUserRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_user_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comment_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->tinyInteger('rate')->default(1)->nullable();
            $table->tinyInteger('active')->default(1);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('update_by')->unsigned()->nullable();
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
        Schema::dropIfExists('comment_user_ratings');
    }
}
