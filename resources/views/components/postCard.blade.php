@props(['post', 'full' => false])
<div class="mx-3 my-5 p-4 border-4 rounded-xl">
    {{--Post image--}}
    <div>
        @if ($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt=""  class="rounded-lg">
        @else
            
            <img src="{{ asset('storage/posts_images/default.jpg') }}" alt=""  class="rounded-lg">
        @endif
    </div>

    {{--Title--}}
    <h2 class="text-black uppercase">{{$post->title}}</h2>

    {{--Author and date--}}
    <div class="text-xs font-light mb-4">
        <span>Posted {{$post->created_at->diffForHumans()}} by</span>
        <a href="{{route('posts.user', $post->user)}}" class="text-blue-500 font-medium">{{ $post->user->username }}</a>
    </div>

    {{--Body--}}
    @if ($full)
        <div class="text-sm">
            <span class="text-justify">{{ $post->body }}</span>
        </div>
    @else    
        <div class="text-sm">
            <span class="text-justify">{{Str::words($post->body, 30)}}</span>
            <a href="{{route('posts.show', $post)}}" class="text-blue-500 font-medium">Read more &rarr;</a>
        </div>
    @endif

    <div class="mt-4 flex items-center justify-end">
        {{$slot}}
    </div>
</div>