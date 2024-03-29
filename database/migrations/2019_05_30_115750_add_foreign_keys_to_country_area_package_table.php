<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCountryAreaPackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('country_area_package', function(Blueprint $table)
		{
			$table->foreign('country_area_id')->references('id')->on('country_areas')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('service_package_id')->references('id')->on('service_packages')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('country_area_package', function(Blueprint $table)
		{
			$table->dropForeign('country_area_package_country_area_id_foreign');
			$table->dropForeign('country_area_package_package_id_foreign');
		});
	}

}
