<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_model', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vehicles_brand');
            $table->string('name');
            $table->timestamps();

            $table->foreign('id_vehicles_brand')
            ->references('id')
            ->on('vehicles_brand')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles_model');
    }
}
