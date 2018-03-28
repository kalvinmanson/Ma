<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->default(0);
            $table->integer('content_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('fullcontent');
            $table->float('rank')->default(0);
            $table->boolean('solved')->default(false);
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
        Schema::dropIfExists('topics');
    }
}
