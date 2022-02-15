<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 60);
            $table->string('title');
            $table->text('description');
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->float('original_price');
            $table->float('actual_price');
            $table->string('image')->nullable();

            $table->integer('quantity');
            $table->smallInteger('status');
            $table->string('model');
            $table->string('registration');
            $table->string('size');
            $table->timestamps();

            // Creating index
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
