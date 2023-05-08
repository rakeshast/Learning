<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $subcategotyname = array ( "Kotlin", "Laravel", "Vue Js","CodeIgniter", "CakePHP","Flutter","Computer","Cricket");
        $parent_ids = Category::select('id')->where('id' ,'>' ,0)->pluck('id')->toarray(); 

        $cat_name = $this->faker->unique(true)->randomElement($subcategotyname);
    
        return [            
            'subcategory_name' => $cat_name,  
            'slug' =>   Str::slug($cat_name), 
            'parent_category' => $this->faker->randomElement($parent_ids),
        ];

    }
}
