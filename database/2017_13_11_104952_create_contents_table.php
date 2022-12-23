<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //mediumText

     public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->nullable();
            $table->integer('parent_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('link_title')->nullable();
            $table->string('meta_title_content')->nullable();
            $table->text('short_description')->nullable();
            $table->text('content')->nullable();
            $table->text('page_keywords')->nullable();
            $table->text('page_description')->nullable();
            $table->string('url')->nullable();
            $table->string('content_for')->nullable();
            $table->tinyInteger('show_on_top')->default(0);
            $table->tinyInteger('show_on_homepage')->default(0);
            $table->tinyInteger('show_on_bottom')->default(0);
            $table->tinyInteger('show_in_footer')->default(0);
            $table->integer('sequence')->unsigned()->default(0);
            $table->string('image_path')->nullable();
            $table->string('image_title')->nullable();
            $table->text('image_details')->nullable();
            $table->tinyInteger('show_image')->default(0);
            $table->tinyInteger('show_gallery')->default(0);
            $table->tinyInteger('is_page')->default(0);
            $table->tinyInteger('is_published')->default(1);
            $table->integer('business_id')->unsigned();
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
         Schema::drop('contents');
    }
}
