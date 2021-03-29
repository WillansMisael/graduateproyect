<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('solicitud');
            $table->foreign('solicitud')->references('id')->on('solicitudes')
            /*->onDelete('set null')
            ->onUpdate('cascade')*/;

            $table->unsignedBigInteger('exam');
            $table->foreign('exam')->references('id')->on('examenes')
            /*->onDelete('set null')
            ->onUpdate('cascade')*/;

            $table->decimal('price');
            $table->bigInt('grupo', 20)->nullable();
            $table->bigInt('subgrupo', 20)->nullable();
            $table->bigInt('valores', 20)->nullable();
            $table->string('result',255);
            $table->string('observation',255);

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
        Schema::dropIfExists('solicitud_details');
    }
}
