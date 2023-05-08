<?php

namespace Database\Factories;

use App\Models\Type;
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
        // $types = array ( "Admin/Super Author", "Author");
        // $type = $this->faker->unique()->randomElement($types);
            return [
                // 'name' => $type
            ];

           
    }
}
