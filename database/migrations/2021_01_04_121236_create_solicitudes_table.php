<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pacient');
            $table->foreign('pacient')->references('id')->on('pacientes')
            /*->onDelete('set null')
            ->onUpdate('cascade')*/;
           
            $table->unsignedBigInteger('medic');
            $table->foreign('medic')->references('id')->on('medicos')
            /*->onDelete('set null')
            ->onUpdate('cascade')*/;
            
            //$table->string('process');
            $table->decimal('total', 10, 2)->default('0.00');
            $table->decimal('pago', 10, 2)->default('0.00');
            
            $table->decimal('discount', 10, 2)->default('0.00');
            $table->enum('attention',['NORMAL','EMERGENCIA']);
            $table->enum('state_pago',['DEBE','CANCELADO']);
            $table->enum('state_result',['RECEPCIONADO','TRANSCRITO','ENTREGADO']);
            
            $table->dateTime('solicitud_date');
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
        Schema::dropIfExists('solicitudes');
    }
}
