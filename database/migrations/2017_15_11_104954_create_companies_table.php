<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('cvr')->nullable();
            $table->text('address1')->nullable();
            $table->text('house_no')->nullable();
            $table->text('address2')->nullable();
            $table->text('zip')->nullable();
            $table->text('city')->nullable();
            $table->text('email')->nullable();
            $table->text('url')->nullable();
            $table->text('Entrepreneurial_status')->nullable();
            $table->integer('weekly_hours')->default(0);
            $table->text('job_type')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
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
         Schema::drop('companies');
    }
}
