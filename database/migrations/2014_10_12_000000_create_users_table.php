<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('email')->nullable();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('livello_utenza');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('nome_org')->nullable()->unique();
            $table->string('piva')->nullable();
            $table->date('data_nascita')->nullable();

            //$table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
