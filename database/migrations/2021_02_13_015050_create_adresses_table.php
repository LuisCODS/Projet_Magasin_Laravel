<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id('id_adresse');
            $table->unsignedBigInteger('fk_id_user');
            $table->foreign('fk_id_user')->references('id_user')->on('users')
                                       ->onDelete('cascade')
                                       ->onUpdate('cascade');
            $table->string('nbCivic');
            $table->string('rue');
            $table->string('quartie');
            $table->string('pays');
            $table->string('codePostal');
            $table->string('ville');
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
        Schema::dropIfExists('adresses');
    }
}
