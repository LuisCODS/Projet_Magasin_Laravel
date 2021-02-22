<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;
use Illuminate\Support\Str;
//use Faker\Factory as Faker;

class ProduitsTableSeeder extends Seeder
{


    protected $description = 'Chemise à carreaux en douce flanelle de coton. Modèle avec col rabattu, deux poches de poitrine et boutonnage classique. Empiècement dans le dos et base arrondie.';

    public function run()
    {
    	//$faker = Faker\Factory::create();

        //Without Factory
        // for ($i=0; $i < 10 ; $i++) {
        // 	Produit::create([
        // 		'fk_id_categorie' => 1,
        // 		'nomProduit' 	  => 'Nom produit-'.$i,
        // 		'totalStock'	  => (100+$i),
        // 		'img' 			  => 'https://via.placeholder.com/345x517',
        // 		'description'     => $this->description,
        // 		'prix' 		      => (25+$i)
        // 	]);
        // }

        //With Factory
        \App\Models\Produit::factory()->count(5)->create();
    }


}
