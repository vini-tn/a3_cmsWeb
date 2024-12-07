{{-- using layout.blade --}}
<x-layout>
    <h1 class="title">Register a new account</h1>
    <div class="mx-auto max-w-screen-sm card">

        {{-- form of Register, consisting of username, email, password and confirm password. CSRF token is included for protection. User's inputs are posted to the register route set in web, that takes it to the Auth controller to process --}}
        <form action="{{ route('register') }}" method="post">
            @csrf

            {{-- username input--}}
            <div class="mb-4">
                <label for="username">Username</label>
                <input type="text" name="username" 
                value="{{ old('username')}}"
                class="input
                 @error('username') ring-red-500  @enderror">

                @error('username')
                   <p class="error">  {{ $message }}</p>
                @enderror
            </div>

            {{-- Email input--}}
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

             {{-- Confirm Pasword input--}}
             <div class="mb-4">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input
                @error('password') ring-red-500  @enderror">
            </div>
            
            {{-- submit button --}}
            <button class="btn">Register</button>
        </form>
    </div>
</x-layout>
