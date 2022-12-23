<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('initials')->nullable();
            $table->string('username')->nullable()->unique();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('email')->unique();
            $table->string('cpr')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->integer('housenumber')->nullable();
            $table->string('floor')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('userjobstatus')->nullable();
            $table->string('job_title')->nullable();
            $table->string('education')->nullable();
            $table->string('works_within_education_field')->nullable();
            $table->enum('user_type',['admin','business','user'])->default('user')->nullable();
            $table->enum('user_subscription',['admin','business','level1','level2','level3'])->default('level1')->nullable();
            $table->tinyInteger('fb_merge')->default(0)->nullable();
            $table->tinyInteger('fb_email')->default(0)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('active')->default(1)->nullable();
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
        Schema::drop('users');
    }
}
