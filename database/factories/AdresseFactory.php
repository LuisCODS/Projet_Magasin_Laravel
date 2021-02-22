<?php

namespace Database\Factories;

use App\Models\Adresse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdresseFactory extends Factory
{

    protected $model = Adresse::class;

    public function definition()
    {
        return [
            'fk_id_user' => User::factory(),
            'nbCivic' => $this->faker->buildingNumber ,
            'rue' => $this->faker->streetSuffix ,
            'quartie' => 'quartie',
            'pays' => $this->faker->country ,
            'codePostal' => 'H2E1X2',
            'ville' => $this->faker->city,
            'defaulAdresse' => $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
