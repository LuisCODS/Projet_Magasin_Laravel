<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->id('id_achat');
            $table->unsignedBigInteger('fk_id_user');
            $table->foreign('fk_id_user')->references('id')->on('users')
                                         ->onUpdate('cascade');
            $table->double('sousTotal', 10,2);
            $table->double('tps', 10,2);
            $table->double('tvq', 10,2);
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
        Schema::dropIfExists('achats');
    }
}
