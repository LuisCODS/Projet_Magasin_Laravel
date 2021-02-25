<?php

namespace Database\Factories;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProduitFactory extends Factory
{

    protected $model = Produit::class;

    public function definition()
    {
        return [
            'fk_id_categorie' => Categorie::factory(),
            'totalStock' => $this->faker->numberBetween($min = 100, $max = 300),
            'nomProduit' => 'Pantalon Coupe régulière',
            'description' => 'Pantalon en molleton. Modèle avec élastique et lien de serrage à la taille. Poches couture. Coupe décontractée et fond plutôt descendu. Ourlet côtelé en bas des jambes effilées.',
            'img' => 'img/produits/avatar.png',
            'prix' => $this->faker->numberBetween($min = 10, $max = 50),
        ];
    }
}
