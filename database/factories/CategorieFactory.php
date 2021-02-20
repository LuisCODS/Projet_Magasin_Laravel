<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategorieFactory extends Factory
{

    protected $model = Categorie::class;

    public function definition()
    {
        return [
            'nomCategorie' => $this->faker->name,
        ];
    }
}
