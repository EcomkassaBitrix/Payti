<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paysystems', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['sberbank']);
            $table->string('login', 32);
            $table->string('password', 32);
            $table->string('token_notification', 40)->unique();
            $table->integer('user_id');
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
        Schema::dropIfExists('paysystems');
    }
}
