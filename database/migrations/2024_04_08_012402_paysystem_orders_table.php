<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaysystemOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paysystem_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('paysystem_id');
            $table->integer('order_number');
            $table->string('mdOrder');
            $table->enum('operation', ['deposited', 'refunded']);
            $table->integer('ofd_created_unix');//мы и проверяем что есть чек уже и когда он был создан
            $table->integer('ofd_try_create');//Сколько было попыток создать чек
            //$table->unique(['paysystem_id', 'order_number', 'mdOrder']);
            $table->jsonb('data')->nullable();
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
        Schema::dropIfExists('paysystem_orders');
    }
}
