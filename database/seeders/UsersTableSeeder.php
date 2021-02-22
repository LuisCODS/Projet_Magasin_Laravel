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

                        User::factory()
                        // ->has(Adresse::factory())
                        ->hasAdresses(3)
                        // ->count(4)
                        ->create();
    }

}
