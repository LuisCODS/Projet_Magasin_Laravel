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
            'nomProduit' => 'Produit sans nom',
            'description' => 'Chemise à carreaux en douce flanelle de coton. Modèle avec col rabattu, deux poches de poitrine et boutonnage classique. Manches longues terminées par fente',
            'img' => 'img/produits/avatar.png',
            'prix' => $this->faker->numberBetween($min = 10, $max = 50),
        ];
    }
}
