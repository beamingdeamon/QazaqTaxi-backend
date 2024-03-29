<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToRejectTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reject_translations', function (Blueprint $table) {
            //
            $table->integer('merchant_id')->unsigned()->nullable()->change();
            $table->foreign('merchant_id')->references('id')->on('merchants')->onUpdate('RESTRICT')->onDelete('CASCADE');

            $table->integer('reject_reason_id')->unsigned()->nullable()->change();
            $table->foreign('reject_reason_id')->references('id')->on('reject_reasons')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reject_translations', function (Blueprint $table) {
            //
            $table->dropForeign('merchant_id');
            $table->dropForeign('reject_reason_id');
        });
    }
}
