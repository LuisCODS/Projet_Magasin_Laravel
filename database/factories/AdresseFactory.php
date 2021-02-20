<?php

namespace Database\Factories;

use App\Models\Adresse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdresseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adresse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fk_id_user' => User::factory(),
            'nbCivic' => 'nbCivic'. rand(1,2),
            'rue' => $this->faker->rue,
            'quartie' => '',
            'pays' => '',
            'codePostal' => '',
            'ville' => '',
            'defaulAdresse' => '',

        ];
    }
}
