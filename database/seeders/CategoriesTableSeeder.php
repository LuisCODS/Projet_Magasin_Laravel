<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategoriesTableSeeder extends Seeder
{

    public function run()
    {
        //Without Factory
        // for ($i = 0; $i < 5 ; $i++) {
        // 	Categorie::create([
        // 		'nomCategorie' 	  => 'Categorie - '.$i,
        // 	]);
        // }

        //With Factory
        \App\Models\Categorie::factory()->create();

    }
}
