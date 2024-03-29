<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToApplicationConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_configurations', function (Blueprint $table) {
            //
            $table->integer('merchant_id')->unsigned()->nullable()->change();
            $table->foreign('merchant_id')->references('id')->on('merchants')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_configurations', function (Blueprint $table) {
            $table->dropForeign('merchant_id');
        });
    }
}
