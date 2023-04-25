<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToBookingCoordinatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_coordinates', function (Blueprint $table) {
            //
            $table->integer('booking_id')->unsigned()->nullable()->change();
            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_coordinates', function (Blueprint $table) {
            //
            $table->dropForeign('booking_id');
        });
    }
}
