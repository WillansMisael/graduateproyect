<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('last_name',50);
            $table->string('cargo',50);
            $table->string('nro_ci',12);
            $table->date('date_nac');
            $table->enum('sex',['Masculino','Femenino']);
            $table->string('direction',100);
            $table->string('cel',8);
            $table->enum('state',['Activo','Inactivo'])->default('Activo');
            $table->unsignedBigInteger('user')->unsigned();
            $table->foreign('user')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('personals');
    }
}
