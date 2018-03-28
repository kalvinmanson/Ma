<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->default(0);
            $table->string('category')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('picture')->nullable();
            $table->string('description')->nullable();
            $table->text('fullcontent')->nullable();
            $table->integer('weight')->default(100);
            $table->float('rank')->default(0);
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
        Schema::dropIfExists('contents');
    }
}
