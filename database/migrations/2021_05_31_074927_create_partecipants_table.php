<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartecipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partecipants', function (Blueprint $table) {
            $table->bigIncrements('id_partecipazione');
            //$table->timestamps();
            $table->integer('id_evento_partecipazione');
            $table->integer('user_id_partecipazione');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partecipants');
    }
}
