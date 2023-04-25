<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMerchantPaymentOptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('merchant_payment_option', function(Blueprint $table)
		{
			$table->foreign('merchant_id')->references('id')->on('merchants')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('payment_option_id')->references('id')->on('payment_options')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('merchant_payment_option', function(Blueprint $table)
		{
			$table->dropForeign('merchant_payment_option_merchant_id_foreign');
			$table->dropForeign('merchant_payment_option_payment_option_id_foreign');
		});
	}

}
