<x-layout>
    <x-postCard  :post="$post" full>

        @if(auth()->check() && (auth()->id() === $post->user_id || auth()->user()->isAdmin))
        {{-- Update post --}}
        <a href="{{ route('posts.edit', $post) }}"
           class="bg-yellow-500 text-white px-2 py-1 text-xs rounded-md">Update</a>

        {{-- Delete post --}}
        <form action="{{ route('posts.destroy', $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
        </form>
        @endif
    </x-postCard>

</x-layout>