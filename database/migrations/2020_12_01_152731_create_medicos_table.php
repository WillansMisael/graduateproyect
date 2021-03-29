<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('last_name',50);
            $table->enum('sex',['Masculino','Femenino']);
            $table->string('cel',8);
            $table->string('speciality',50);
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
        Schema::dropIfExists('medicos');
    }
}
