{{-- using layout.blade --}}
<x-layout>
    <h1 class="title">Welcome back</h1>
    <div class="mx-auto max-w-screen-sm card">

        {{-- form of Log in, consisting of email, password and remember box check. CSRF token is included for protection. User's inputs are posted to the login route set in web, that takes it to the Auth controller to process --}}
        <form action="{{ route('login') }}" method="post">
            @csrf           
            {{-- Email input --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email"   value="{{ old('email')}}" class="input
                @error('email') ring-red-500  @enderror">

                @error('email')
                   <p class="error">  {{ $message }}</p>
                @enderror
            </div>
              {{-- Pasword input--}}
              <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input
                 @error('password') ring-red-500  @enderror">

                @error('password')
                   <p class="error">  {{ $message }}</p>
                @enderror
            </div>
            {{-- Remember checkbox --}}
            <div class="mb-4">
                <input type="checkbox" name="remember" id="remeber">
                <label for="remember">Remember me</label>
            </div>

            @error('failed')
                <p class="error">  {{ $message }}</p>
            @enderror
            <br>
            {{-- submit button --}}
            <button class="btn">Login</button>
        </form>
    </div>
</x-layout>
