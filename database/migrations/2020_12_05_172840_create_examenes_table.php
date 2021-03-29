<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenes', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('method',100);
            $table->decimal('price_normal', 10, 2)->default('0.00');
            $table->decimal('price_emergency', 10, 2)->default('0.00');
            $table->enum('state',['Activo','Inactivo'])->default('Activo');
            $table->unsignedBigInteger('grupo');
            $table->foreign('grupo')->references('id')->on('grupos')
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
        Schema::dropIfExists('examenes');
    }
}
