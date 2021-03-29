<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoresexamenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valoresexamenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subgrupoexamen');
            $table->unsignedBigInteger('unidad');
            $table->string('name',100);
            $table->string('rango_normal',100);
            $table->enum('state',['Activo','Inactivo'])->default('Activo');

            $table->foreign('unidad')->references('id')->on('unidades')
            /*->onDelete('set null')
            ->onUpdate('cascade')*/;
            $table->foreign('subgrupoexamen')->references('id')->on('subgrupoexamenes')
            /*->onDelete('set null')
            ->onUpdate('cascade')*/;
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
        Schema::dropIfExists('valoresexamens');
    }
}
