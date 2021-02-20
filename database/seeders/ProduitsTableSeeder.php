<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;
use Illuminate\Support\Str;

class ProduitsTableSeeder extends Seeder
{

    public function run()
    {
    	//$faker = Faker\Factory::create();

        for ($i=0; $i < 30 ; $i++) { 

        	Produit::create([
        		'fk_id_categorie' 	  => 1,
        		'nomProduit' 	  => 'Nom produit',
        		'totalStock'	  => 100,
        		'img' 			  => '50d0b79b6a64c06bd3efcd0e834f53e8b5b9222d.jpg',
        		'description'     => 'Som text...',
        		'prix' 		      => 25
        	]);
        }
    }


}


/*        		'fk_id_categorie' => $faker->numberBetween(1, 2),
        		'nomProduit' 	  => $faker->sentence(10),
        		'totalStock'	  => $faker->numberBetween(10, 100),
        		'img' 			  => 'https://via.placeholder.com/345x517',
        		'description'     => $faker->text,
        		'prix' 		      => $faker->numberBetween(10, 100)* 100 */
