<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('parking_id');
            $table->unsignedInteger('car_id');
            $table->date('date');
            $table->time('waiting_time');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('total_time');
            $table->string('total_minuts')->default(0);;
            $table->string('rental_status')->default('Available');; // Available | Busy | Waiting | timing | charging | closed
            $table->float('cost',8,2)->default(0.00)->nullable();
            $table->float('user_fee',8,2)->default(0.00)->nullable();
            $table->float('fee',8,2)->default(0.00)->nullable();
            $table->float('total',8,2)->default(0.00)->nullable();
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
        Schema::dropIfExists('rentals');
    }
}
