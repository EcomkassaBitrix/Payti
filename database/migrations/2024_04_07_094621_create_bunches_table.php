<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBunchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bunches', function (Blueprint $table) {
            $table->id();
            $table->integer('paysystem_id');
            $table->integer('ofd_service_id');
            $table->integer('user_id');
            $table->unique(['paysystem_id', 'ofd_service_id', 'user_id']);
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
        Schema::dropIfExists('bunches');
    }
}
