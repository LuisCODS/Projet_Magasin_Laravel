<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id('id_produit');
            $table->unsignedBigInteger('fk_id_categorie');
            $table->foreign('fk_id_categorie')->references('id_Categorie')->on('categories');
            $table->integer('totalStock');
            $table->string('nomProduit', 50)->unique();
            $table->string('description', 500);
            $table->string('img', 100);
            $table->double('prix', 10, 2);
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
        Schema::dropIfExists('produits');
    }
}
