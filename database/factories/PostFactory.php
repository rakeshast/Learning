<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = FakerFactory::create("en_AU");
        $users = User::select('id')->where('id' ,'>' ,0)->pluck('id')->toarray(); 
        $subcategories = SubCategory::select('id')->where('id' ,'>' ,0)->pluck('id')->toarray();  
        $user = $faker->randomElement($users);
        $subcategory = $faker->randomElement($subcategories);

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');
        $paragraphs = $faker->paragraphs(rand(2, 6));
        $post = "<h1>{$title}</h1>";
        foreach ($paragraphs as $para) {
            $post .= "<p>{$para}</p>";
        }

        
    
        $path = "images/post_images/";
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path, 0755, true, true);
        }
       
        $featured_image = $faker->image('public/storage/images/post_images',670,448);
        $filename = pathinfo($featured_image, PATHINFO_FILENAME);
        $extension = pathinfo($featured_image, PATHINFO_EXTENSION);
        $newfilename = $filename.'.'.$extension;

        $post_thumbnails_path = $path . 'thumbnails';

        if (!Storage::disk('public')->exists($post_thumbnails_path)) {
            Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
        }
        

        $thumb = Image::make(storage_path('app/public/images/post_images/' . $newfilename))
                ->fit(200,200)
                ->save(storage_path('app/public/images/post_images/thumbnails/' . 'thumb_' . $newfilename));
        
        //Create Resized Image
        Image::make(storage_path('app/public/images/post_images/' . $newfilename))
            ->fit(500, 350)
            ->save(storage_path('app/public/images/post_images/thumbnails/' . 'resized_' . $newfilename));

        
        return [
            "author_id" => $user,
            "category_id" => $subcategory,
            "post_title" => $title,
            "post_slug" => $slug,
            "post_content" => $post,
            "post_tags" => $faker->word,
            "featured_image" => $newfilename,
        ];
    }
}
