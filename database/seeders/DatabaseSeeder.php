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
        //USER HAS MANY ADRESSES
        $this->call(AdresseTableSeeder::class);

        // $this->call(UsersTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);

        //PRODUCT BELONG TO CATEGORYS
         $this->call(ProduitsTableSeeder::class);
    }
}
