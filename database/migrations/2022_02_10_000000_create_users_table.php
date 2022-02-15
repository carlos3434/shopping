<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;


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
            $table->id();
            $table->string('uuid', 60);
            $table->string('name', 255);
            $table->string('email')->unique();
            $table->string('password');
            $table->smallInteger('role_type');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Creating index
            $table->index('name');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
