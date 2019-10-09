<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('latitud');
            $table->string('longitud');
            $table->string('address');
            $table->integer('zipcode');
            $table->boolean('hasgate');
            //$table->boolean('available');
            $table->float('cost',8,2);
            $table->float('rentaltime',8,2);
            $table->float('waitingtime',8,2);
            $table->string('size');
            $table->boolean('validated')->default(0);
            $table->string('pic_front')->nullable();
            $table->string('pic_inside')->nullable();
            $table->string('pic_both')->nullable();
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
        Schema::dropIfExists('parkings');
    }
}
