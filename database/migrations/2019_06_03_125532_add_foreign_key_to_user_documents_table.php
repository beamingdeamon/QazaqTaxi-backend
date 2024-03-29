<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToUserDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_documents', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned()->nullable()->change();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');

            $table->integer('document_id')->unsigned()->nullable()->change();
            $table->foreign('document_id')->references('id')->on('documents')->onUpdate('RESTRICT')->onDelete('CASCADE');

            $table->integer('reject_reason_id')->unsigned()->nullable()->change();
            $table->foreign('reject_reason_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_documents', function (Blueprint $table) {
            //
            $table->dropForeign('user_id');
            $table->dropForeign('document_id');
            $table->dropForeign('reject_reason_id');
        });
    }
}
