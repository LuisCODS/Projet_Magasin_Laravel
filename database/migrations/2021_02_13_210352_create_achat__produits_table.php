<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achat__produits', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_id_achat');
            $table->foreign('fk_id_achat')->references('id_achat')->on('achats')
                                         ->onUpdate('cascade');
            $table->unsignedBigInteger('fk_id_produit');
            $table->foreign('fk_id_produit')->references('id_produit')->on('produits')
                                         ->onUpdate('cascade');
            $table->integer('quantite');
            $table->double('prixProduit', 10,2);
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
        Schema::dropIfExists('achat__produits');
    }
}
