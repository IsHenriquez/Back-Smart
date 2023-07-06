<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_managing_user');
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_type');
            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_priority');
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->text('title');
            $table->text('description');
            $table->string('address')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->dateTime('fecha_ingreso_solicitud')->nullable();
            $table->dateTime('fecha_realizar_servicio')->nullable();
            $table->dateTime('fecha_termino_servicio')->nullable();
            $table->timestamps();

            $table->foreign('id_managing_user')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_status')
            ->references('id')
            ->on('tickets_status')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_type')
            ->references('id')
            ->on('tickets_type')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_category')
            ->references('id')
            ->on('tickets_category')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_priority')
            ->references('id')
            ->on('tickets_priority')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_customer')
            ->references('id')
            ->on('customer')
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
        Schema::dropIfExists('tickets');
    }
}
