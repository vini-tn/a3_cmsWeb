<x-layout>

    <a href="{{ route('dashboard') }} " class ="block mb-2 text-xs text-blue-500"> &larr; Go back to your dashboard</a>
    <a href="{{ route('posts.index') }} " class ="block mb-2 text-xs text-blue-500"> &larr; Go back to all posts</a>
    <div class="card">

        <h2 class="font-bold mb-4">
            Update your post
        </h2>

        {{-- edit post form --}}

        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ $post->title }}"
                    class="input
    @error('title') ring-red-500  @enderror">

                @error('title')
                    <p class="error"> {{ $message }}</p>
                @enderror
            </div>

            {{-- post body --}}
            <div class="mb-4">
                <label for="title">Post Content</label>
                <textarea name="body" rows="5"
                    class="input             
       
        @error('body') ring-red-500  @enderror"> {{ $post->body }}</textarea>

                @error('body')
                    <p class="error"> {{ $message }}</p>
                @enderror
            </div>


            @if ($post->image)
                <div class="h-64 rounded-md mb-4 w-1/4 object-cover overflow-hidden">

                    <label for="">Current featured photo</label>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="">  
                </div>
            @endif

                {{-- Post image --}}
                <div class="mb-4">
                    <label for="image">Featured image</label>
                    <input type="file" name="image" id="image">
    
                    @error('image')
                    <p class="error"> {{ $message }}</p>
                @enderror
                </div>

            <button class="btn">Update</button>
        </form>
    </div>
</x-layout>
