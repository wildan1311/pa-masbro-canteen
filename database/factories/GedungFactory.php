<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GedungFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nama" => $this->faker->randomElement(["D4", "PASCASARJANA", "D3"])
        ];
    }
}
