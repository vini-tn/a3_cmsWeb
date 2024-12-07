{{-- view structure for posts in paginate form --}}
@props(['post', 'full' => false])
<div class="card">
    {{-- title --}}
    <h2 class="font-bold text-xl">{{ $post->title }}</h2>
    <br>
    {{-- featured photo, if post has one otherwise a default is shown --}}
    <div class="h-52 rounded-md mb-4 w-full object-cover overflow-hidden">
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="">
        @else
            <img src="{{ asset('storage/post_images/Flower 2.jpg') }}" alt="">
        @endif
    </div>

    {{-- user and date, formatted how long ago it was posted --}}
    <div class="text-xs">
        <span>Posted {{ $post->created_at->diffForHumans() }} by</span>
        <a href="{{ route('posts.user', $post->user) }}" class="text-blue-500 font-medium">
            {{ $post->user->username }}
        </a>
    </div>

    {{-- body that displays in full if full attribute is true. Otherwise only up to 15 characters are shown with Read more link. --}}
    @if ($full)
        <div class="text-sm">
            <span>{{ $post->body }} </span>
        </div>
    @else
        <div class="text-sm">
            <span>{{ Str::words($post->body, 15) }} </span>
            <a href="{{ route('posts.show', $post) }}" class="text-blue-500">Read more &rarr;</a>
        </div>
    @endif

    {{-- slot for Edit and Delete buttons on page --}}
    <div class="flex items-center justify-end gap-4 mt-6">
        {{ $slot }}
    </div>
</div>
