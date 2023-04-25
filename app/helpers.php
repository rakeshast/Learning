<?php 

use App\Models\Setting;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Carbon\Carbon;


if (!function_exists('blogInfo')) {
    function blogInfo(){
        return Setting::find(1);
    }        
}

/**
 * DATE FORMAT eg: January 12, 2023
 */
if (!function_exists('date_formatter')) {
    function date_formatter($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->isoFormat('LL');
    }        
}

/**
 * STRIP WORDS
 */
if (!function_exists('words')) {
    function words($value, $words = 15, $end="..."){
        return Str::words(strip_tags($value), $words, $end);
    }        
}

/**
 * Check if user ins online/have an internet connection.
 */
if (!function_exists('isOnline')) {
    function isOnline($site = "https://www.youtube.com/"){
        if (@fopen($site, 'r')) {
            return true;
        } else {
            return false;
        }        
    }        
}

/**
 * Reading Article Duration
 */
if (!function_exists('readDuration')) {
    function readDuration(...$text){
        Str::macro('timeCounter', function($text){
            $totalWords = str_word_count(implode(" ", $text ));
            $minutesToRead = round($totalWords/200);
            return (int)max(1, $minutesToRead);
        });
        return Str::timeCounter($text);
    }        
}

/**
 * Display Home Main Latest Post
 */
if (!function_exists('single_latest_post')) {
    function single_latest_post(){
        return Post::with('author')
                    ->with('subcategory')   
                    ->limit(1)
                    ->orderBy('created_at', 'desc')
                    ->first();         
    }        
}

/**
 * Display 6 Latest post On Home Page
 */
if (!function_exists('latest_home_6posts')) {
    function latest_home_6posts(){
        return Post::with('author')
                    ->with('subcategory')
                    ->skip(1)
                    ->limit(6)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }        
}

/**
 * RANDOM RECOMMENDED POSTS
 */
if (!function_exists('recommended_posts')) {
    function recommended_posts(){
        return Post::with('author')
                    ->with('subcategory')
                    ->limit(4)
                    ->InRandomOrder()
                    ->get();
    }        
}

/**
 * CATEGORY WITH NUMBERS OF POSTS
 */
if (!function_exists('categories')) {
    function categories(){
        return SubCategory::whereHas('posts')
                    ->with('posts')
                    ->orderBy('subcategory_name', 'asc')
                    ->get();
    }        
}




?>
