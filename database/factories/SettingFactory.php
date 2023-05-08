<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'blog_name' => "Larablog",
            'blog_email' => 'larablog@gmail.com',
            'blog_description' => $this->faker->text(120),
            'blog_logo' => '',
            'blog_favicon' => ''
        ];

    }
}
