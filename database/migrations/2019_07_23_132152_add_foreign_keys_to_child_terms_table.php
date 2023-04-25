<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToChildTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_terms', function (Blueprint $table) {
            //
            $table->integer('merchant_id')->unsigned()->change();
            $table->foreign('merchant_id')->references('id')->on('merchants')->onUpdate('RESTRICT')->onDelete('CASCADE');

            $table->integer('country_id')->unsigned()->nullable()->change();
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('child_terms', function (Blueprint $table) {
            //
            $table->dropForeign('merchant_id');
            $table->dropForeign('country_id');
        });
    }
}
