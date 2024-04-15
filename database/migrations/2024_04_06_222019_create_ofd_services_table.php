<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfdServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofd_services', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['ecomkassa']);
            $table->string('login', 32);
            $table->string('password', 32);
            $table->string('token', 1024)->nullable();
            $table->integer('user_id');
            $table->integer('shop_id');

            $table->string('company_email', 32)->nullable();
            $table->enum('company_sno', ['osn', 'usn_income', 'usn_income_outcome', 'envd', 'esn', 'patent'])->nullable();
            $table->string('company_inn', 32)->nullable();
            $table->string('company_payment_address', 128)->nullable();
            $table->string('client_email', 32)->nullable();


            $table->enum('payment_method', ['full_prepayment', 'prepayment', 'advance', 'full_payment', 'partial_payment', 'credit', 'credit_payment'])->nullable();

            $table->enum('payment_object', ['commodity', 'excise', 'job', 'gambling_bet', 'gambling_prize', 'lottery', 'lottery_prize', 'intellectual_activity', 'payment', 'agent_commission', 'composite', 'another'])->nullable();

            $table->enum('vat', ['none', '10', '18', '20', '110', '118', '120', '0'])->nullable();
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
        Schema::dropIfExists('ofd_services');
    }
}
