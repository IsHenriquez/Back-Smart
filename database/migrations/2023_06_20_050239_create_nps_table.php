<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_ticket');
            $table->integer('evaluation');

            $table->foreign('id_user')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_customer')
            ->references('id')
            ->on('customer')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_ticket')
            ->references('id')
            ->on('tickets')
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
        Schema::dropIfExists('nps');
    }
}
