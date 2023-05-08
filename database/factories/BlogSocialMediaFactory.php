<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogSocialMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bsm_facebook' => "https://www.facebook.com/",
            'bsm_instagram' => "https://www.facebook.com/",
            'bsm_youtube' => "https://www.facebook.com/",
            'bsm_linkedin' => "https://www.facebook.com/",
        ];
    }
}
