<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressesTable extends Migration
{
    public function up()
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_id_user');
            $table->foreign('fk_id_user')->references('id')->on('users')
                                       ->onDelete('cascade')
                                       ->onUpdate('cascade');
            $table->string('nbCivic');
            $table->string('rue');
            $table->string('quartie');
            $table->string('pays');
            $table->string('codePostal');
            $table->string('ville');
            $table->integer('defaulAdresse')->default(0);
            $table->softDeletes();
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
