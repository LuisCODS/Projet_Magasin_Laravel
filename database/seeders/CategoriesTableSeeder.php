<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5 ; $i++) {

        	Categorie::create([
        		'nomCategorie' 	  => 'Categorie - '.$i,
        	]);
        }
    }
}
