<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->text('description')->nullable();
            $table->string('color', 20)->nullable();
            $table->string('textColor', 20)->nullable();
            $table->bigInt('user', 20)->nullable();
            $table->enum('state',['CONFIRMADO','SINCONFIRMAR'])->default('SINCONFIRMAR');
            $table->dateTime('start');
            $table->dateTime('end');
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
