<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Adresse;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        //\App\Models\User::factory()->count(5)->create();

        \App\Models\User::factory()
                        ->has(Adresse::factory())
                        ->count(4)
                        ->create();
    }

}
