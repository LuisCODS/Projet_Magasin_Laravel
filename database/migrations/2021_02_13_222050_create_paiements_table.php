<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id('id_paiement');
            $table->unsignedBigInteger('fk_id_facture');
            $table->foreign('fk_id_facture')->references('id_facture')->on('factures')
                                           ->onUpdate('cascade');
            $table->double('montant', 10,2);
            $table->string('status', 10);
            $table->string('modePaiement', 20);
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
        Schema::dropIfExists('paiements');
    }
}
