@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Welcome to Larablog')
@section('content')
{{-- @php
   $test = App\Models\SubCategory::select('id')->where('id' ,'>' ,0)->pluck('id')->toarray();
   dd($test);
//    echo "<pre>";
//    print_r($test);
//    echo "<pre>";
@endphp --}}
<div class="row">
    <div class="col-12">
       <h1 class="mb-4 border-bottom border-primary d-inline-block">{{ $category->subcategory_name }}</h1>
    </div>
    <div class="col-lg-8 mb-5 mb-lg-0">
        <div class="row">
        @forelse ($posts as $post)
            <div class="col-md-6 mb-4">
                <article class="card article-card article-card-sm h-100">
                <a href="{{ route('read_post', $post->post_slug) }}">
                    <div class="card-image">
                        <div class="post-info"> <span class="text-uppercase">{{ date_formatter($post->created_at) }}</span>
                            <span class="text-uppercase">{{ readDuration($post->post_title, $post->post_content ) }} @choice("min|mins", readDuration($post->post_title, $post->post_content )) read</span>
                        </div>
                        <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/resized_{{$post->featured_image}}" alt="{{ $post->post_title}}" class="w-100" width="420" height="280">
                    </div>
                </a>
                <div class="card-body px-0 pb-0">
                    <h2><a class="post-title" href="{{ route('read_post', $post->post_slug) }}">{{$post->post_title}}</a></h2>
                    <p class="card-text">{!! Str::ucfirst(words($post->post_content, 12)) !!}</p>
                    <div class="content"> <a class="read-more-btn" href="{{ route('read_post', $post->post_slug) }}">Read Full Article</a>
                    </div>
                </div>
                </article>
            </div>            
        @empty
            <span class="text-danger">No post(s) found for this category!</span>
        @endforelse
        </div>
        
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    {{ $posts->appends(request()->input())->links('custom_pagination') }}
                </div>
            </div>
        </div>
       
    </div>
    <div class="col-lg-4">
       <div class="widget-blocks">
          <div class="row">
             <div class="col-lg-12">
                <div class="widget">
                   <div class="widget-body">
                      <img loading="lazy" decoding="async" src="/front/images/author.jpg" alt="About Me" class="w-100 author-thumb-sm d-block">
                      <h2 class="widget-title my-3">Hootan Safiyari</h2>
                      <p class="mb-3 pb-2">Hello, I’m Hootan Safiyari. A Content writter, Developer and Story teller. Working as a Content writter at CoolTech Agency. Quam nihil …</p>
                      <a href="about.html" class="btn btn-sm btn-outline-primary">Know
                      More</a>
                   </div>
                </div>
             </div>
            
             
            <x-latest-posts/>
            <x-categories-list/>
            <x-tags-list/>
            

          </div>
       </div>
    </div>
</div>


@endsection