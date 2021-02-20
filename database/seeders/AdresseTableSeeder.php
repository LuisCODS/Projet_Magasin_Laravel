<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Adresse;

class AdresseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adresse::factory(10)->create();
    }
}
