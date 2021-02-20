<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        //Call all seeder classes  here...
        
        //$this->call(UsersTableSeeder::class);
        $this->call(ProduitsTableSeeder::class);
    }
}
