{{-- using layout.blade --}}
<x-layout>
    <h1 class="title">Welcome {{ auth()->user()->username }}, you have {{ $posts->total() }} posts </h1>
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create a new post</h2>
        {{-- when user edits or deletes a post and is directed to this view, message is displayed --}}
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" />
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif

        {{-- form of Post, consisting of title, body and image input. CSRF token is included for protection. User's inputs are posted to the dashboard route set in web, that takes it to the Post controller to process --}}
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- Title input--}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="input @error('title') ring-red-500 @enderror">

                @error('title')
                    <p class="error"> {{ $message }}</p>
                @enderror
            </div>

            {{-- post body input --}}
            <div class="mb-4">
                <label for="title">Post Content</label>
                <textarea name="body" rows="5" class="input @error('body') ring-red-500  @enderror"> {{ old('title') }}</textarea>

                @error('body')
                    <p class="error"> {{ $message }}</p>
                @enderror
            </div>

            {{-- Post image input --}}
            <div class="mb-4">
                <label for="image">Featured image</label>
                <input type="file" name="image" id="image">
                @error('image')
                    <p class="error"> {{ $message }}</p>
                @enderror
            </div>
            <button class="btn">Create</button>
        </form>
    </div>
    <br>

    {{-- displays user's posts section --}}
    <h2 class="font-bold mb-4">Your Latest Posts</h2>

    {{-- display posts in post card layout, with edit and delete button --}}
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
        <x-postCard :post="$post">
            {{-- Edit post button that navigates to edit.blade--}}
            <a href="{{ route('posts.edit', $post) }}"
               class="bg-yellow-500 text-white px-2 py-1 text-xs rounded-md">Edit</a>
            {{-- Delete post button that posts the delete request to controller for process--}}
            <form action="{{ route('posts.destroy', $post) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
            </form>
        </x-postCard>
        @endforeach
    </div>
    
    {{-- to display the page links of paginate --}}
    <div>
        {{ $posts->links() }}
    </div>

</x-layout>
