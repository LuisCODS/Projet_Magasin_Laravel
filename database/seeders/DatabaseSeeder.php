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

      // $this->call(UsersTableSeeder::class);
        //$this->call(AdresseSeeder::class);

        $fake = Fake::create();

        foreach ($ranger(1,20) as $index) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }





    }










}
