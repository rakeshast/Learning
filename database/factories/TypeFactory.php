<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $name = array ( "Admin/Super Author", "Author");

        return [
            'name' => $this->faker->unique(true)->randomElement($name)
        ];
    }
}
