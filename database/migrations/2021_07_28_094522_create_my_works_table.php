<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_works', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('from_user_id')->nullable();
            $table->unsignedInteger('my_work_id')->nullable();
            $table->string('status');
            $table->string('title');
            $table->longText('description');
            $table->date('start_date')->nullable();
            $table->date('complete_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->string('attachment')->nullable();
            $table->integer('year');
            $table->integer('month');
            $table->integer('day');
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
        Schema::dropIfExists('my_works');
    }
}
