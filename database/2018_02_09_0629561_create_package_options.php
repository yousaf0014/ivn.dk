<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_options', function (Blueprint $table){
            $table->increments('id');
            $table->string('text')->nullable();
            $table->tinyInteger('basic')->default(0);
            $table->tinyInteger('silver')->default(0);
            $table->tinyInteger('gold')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
         Schema::drop('package_options');
    }
}
