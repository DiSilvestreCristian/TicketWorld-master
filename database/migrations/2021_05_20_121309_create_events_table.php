<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('event_id');
            $table->string('luogo')->nullable();
            $table->date('data')->nullable();
            $table->time('ora')->nullable();
            $table->string('regione')->nullable();
            $table->text('image_catalogo')->nullable();
            $table->longText('programma')->nullable();
            $table->longText('descrizione')->nullable();
            $table->longText('indicazioni')->nullable();
            $table->string('artista')->nullable();
            $table->integer('biglietti_totali')->nullable();
            $table->integer('biglietti_rimasti')->nullable();
            $table->double('costo')->nullable();
            $table->integer('percentuale_sconto')->nullable();
            $table->integer('giorni_sconto')->nullable();
            $table->string('org_name');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
