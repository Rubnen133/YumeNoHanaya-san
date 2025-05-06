<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('git_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string('banner')->nullable();
            $table->string('bio')->nullable();
            $table->string('pronouns', length: 20)->nullable();
            $table->string('git_token');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
