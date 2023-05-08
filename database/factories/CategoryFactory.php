<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $categotyname = array ( "App Dev.", "Web Dev.", "Smartphones","Laptops", "Fragrances","Skincare","Groceries","Home-decoration","Furniture");

        return [            
            'category_name' => $this->faker->unique(true)->randomElement($categotyname),       
        ];
    }
}
