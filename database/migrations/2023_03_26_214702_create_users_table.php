<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('id_user_type');
            $table->unsignedBigInteger('id_vehicle')->nullable();
            $table->string('name');
            $table->string('last_name', 50);
            $table->string('mother_last_name', 50)->nullable();
            $table->string('identification_number', 20)->nullable();
            $table->string('gender', 1)->comment('M or F')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();


            $table->foreign('id_user_type')
                ->references('id')
                ->on('users_type')
                ->onUpdate('cascade')
                ->onDelete('restrict');


            $table->foreign('id_vehicle')
                ->references('id')
                ->on('vehicles')
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
        Schema::dropIfExists('users');
    }
}
