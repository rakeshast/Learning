<div>
    <div class="col-lg-12 col-md-6">
        <div class="widget">
            <h2 class="section-title mb-3">Latest Posts</h2>
            <div class="widget-body">
                <div class="widget-list">
                @foreach (latest_sidebar_posts() as $item)
                    <a class="media align-items-center" href="{{route('read_post', $item->post_slug)}}">
                        <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/thumb_{{$item->featured_image}}" alt="{{$item->post_title}}" class="w-100">
                        <div class="media-body ml-3">
                            <h3 style="margin-top:-5px">{{ $item->post_title }}</h3>
                            <p class="mb-0 small">{!! Str::ucfirst(words($item->post_content, 7)) !!}</p>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>