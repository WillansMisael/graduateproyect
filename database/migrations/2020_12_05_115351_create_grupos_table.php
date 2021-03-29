<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->enum('state',['Activo','Inactivo'])->default('Activo');
            $table->unsignedBigInteger('familia');
            $table->foreign('familia')->references('id')->on('familias')
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
        Schema::dropIfExists('grupos');
    }
}
