@foreach (categories() as $cats)                       
    <li><a href="{{route("category_posts", $cats->slug)}}">{{ $cats->subcategory_name }}<span class="ml-auto">({{$cats->posts->count()}})</span></a>
    </li>
@endforeach 