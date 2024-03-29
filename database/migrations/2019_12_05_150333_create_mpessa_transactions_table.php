<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpessaTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mpessa_transactions')) {
            Schema::create('mpessa_transactions', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('merchant_id');
                $table->foreign('merchant_id')->references('id')->on('merchants')->onUpdate('RESTRICT')->onDelete('CASCADE');
                $table->unsignedInteger('user_id');
                $table->tinyInteger('type')->comment('1 - User, 2 - Driver');
                $table->string('checkout_request_id');
                $table->string('amount');
                $table->string('payment_status')->nullable();
                $table->longText('request_parameters')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpessa_transactions');
    }
}
