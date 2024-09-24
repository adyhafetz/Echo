<x-authCard title="Login to your account">
    {{-- Session Messages --}}
    @if (session('status'))
        <x-flashMsg msg="{{ session('status') }}" />
    @endif

    <form action="{{ route('login') }}" method="post">
        @csrf

        {{-- Email --}}
        <div class="mb-4">
            <label for="email">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <!-- FontAwesome Envelope Icon -->
                    <i class="fas fa-envelope text-gray-500 dark:text-gray-400"></i>
                </div>
                <input type="text" name="email" value="{{ old('email') }}"
                    class="input @error('email') ring-red-500 @enderror ps-10 p-2.5">
            </div>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <!-- FontAwesome Lock Icon -->
                    <i class="fas fa-lock text-gray-500 dark:text-gray-400"></i>
                </div>
                <input type="password" name="password" class="input @error('password') ring-red-500 @enderror ps-10 p-2.5">
            </div>
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember checkbox --}}
        <div class="mb-4 flex justify-between items-center">
            <div>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>
            
            <a class="text-[#DC5F00]" href="{{route('password.request')}}">Forgot your password?</a>
        </div>

        @error('failed')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- Submit Button --}}
        <button class="btn">Login</button>
    </form>
</x-authCard>