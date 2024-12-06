<x-layout>
    <h1 class="title">{{$user->username}}'s Posts - Total: {{
    $posts->total()}}</h1>

    {{-- user's posts --}}

    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)

        <x-postCard :post="$post">
            {{-- Update post --}}
            <a href="{{ route('posts.edit', $post) }}"
               class="bg-yellow-500 text-white px-2 py-1 text-xs rounded-md">Update</a>
            
            {{-- Delete post --}}
            <form action="{{ route('posts.destroy', $post) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
            </form>
        </x-postCard>
            
        @endforeach
    </div>

    {{$posts->links()}}
</x-layout>