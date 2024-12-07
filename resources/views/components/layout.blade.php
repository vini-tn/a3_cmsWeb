{{-- template of cms site --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-100 text-slate-900">
    {{-- header of cms site that includes Home link, login and register links if user is guest (not logged in) or dropdown menu when user is logged in  --}}
    <header class="bg-slate-700 shadow-lg">
        <nav>
            <a href="{{ route('posts.index') }}" class="nav-link">Home</a>

            @auth
                <div class="relative grid place-items-center"
                x-data="{ open: false}">
                    {{-- Dropdown menu button --}}
                    <button @click="open = !open" type="button" class="round-btn">
                        <img src="{{ asset('img/profile.png') }}" alt="profile">
                    </button>

                    {{-- Dropdown menu --}}

                    <div x-show="open" @click.outside="open=false"
                      class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light">
                      <!-- Username -->
                      <p class="px-4 py-2 border-b border-slate-200 text-gray-750 font-bold italic">{{ auth()->user()->username }}</p>
                      <!-- Dashboard -->
                      <a href="{{ route('dashboard')}}" class="block px-4 py-2 hover:bg-slate-100 text-gray-700">Dashboard</a>
                      
                      <!-- Logout Button -->
                      <form action="{{ route('logout')}}" method="POST">
                          @csrf
                          <button class="block w-full text-left hover:bg-slate-100 px-4 py-2 text-gray-700">Logout</button>
                      </form>
                  </div>
                </div>
            @endauth

            @guest
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </div>
            @endguest

        </nav>
    </header>

    {{-- body of pages that are created from other views --}}
    <main class="py-8 px-4 mx-auto max-w-screen-lg">
        {{ $slot }}
    </main>
</body>

</html>
