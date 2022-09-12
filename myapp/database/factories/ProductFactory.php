<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->sentence;
        //ao invés de sentence o $name estava com 'word'

        return [
            'name' => $name,
            'slug' => Str::slug($name), //Str:: helper do laravel | fazendo slug do $name
            'cover' => $this->faker->imageUrl, //endereço de uma imagem qualquer
            'price' => $this->faker->randomFloat(1, 20, 30),
            'description' => $this->faker->sentence, //sentence: multiplas palavras
            'stock' => $this->faker->randomDigit(),
        ];
    }
}
