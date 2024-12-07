{{-- using layout.blade --}}
<x-layout>
    <h1 class="title">Latest Posts</h1>

        {{-- when user edits or deletes a post and is directed to this view, message is displayed --}}
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" />
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif

        {{-- display posts in post card layout, with edit and delete button --}}
        <div class="grid grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <x-postCard :post="$post">
                    {{-- display buttons if user is logged in, and is either the user of post or admin --}}
                    @if(auth()->check() && (auth()->id() === $post->user_id || auth()->user()->isAdmin))
                        {{-- Edit post button that navigates to edit.blade--}}
                        <a href="{{ route('posts.edit', $post) }}"
                        class="bg-yellow-500 text-white px-2 py-1 text-xs rounded-md">Edit</a>
                
                        {{-- Delete post button that posts the delete request to controller for process--}}
                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
                        </form>
                    @endif
                </x-postCard>
            @endforeach

        </div>

        {{-- to display the page links of paginate --}}
        <div>
            {{$posts->links()}}
        </div>
   </x-layout>