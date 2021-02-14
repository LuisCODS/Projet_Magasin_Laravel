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

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_categorie', 45);
            $table->string('nomCategorie');
            $table->timestamps();
        });
    }

    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id('id_produit');
            $table->unsignedBigInteger('fk_id_categorie');
            $table->foreign('fk_id_categorie')->references('id_Categorie')->on('categories');
            $table->integer('totalStock');
            $table->string('nomProduit', 50);
            $table->string('description', 200);
            $table->string('img', 100);
            $table->double('prix', 10, 2);
            $table->timestamps();
        });
    }

    public function up()
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->id('id_achat');
            $table->unsignedBigInteger('fk_id_user');
            $table->foreign('fk_id_user')->references('id_user')->on('users')
                                         ->onUpdate('cascade');
            $table->double('sousTotal', 10,2);
            $table->double('tps', 10,2);
            $table->double('tvq', 10,2);
            $table->timestamps();
        });
    }

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

    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id('id_facture');
            $table->unsignedBigInteger('fk_id_achat');
            $table->foreign('fk_id_achat')->references('id_achat')->on('achats')->onUpdate('cascade');
            $table->double('totalFinal', 10,2);
            $table->timestamps();
        });
    }
