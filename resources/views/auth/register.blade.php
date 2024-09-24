<x-authCard title="Register a new account">
    <form action="{{ route('register') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
        @csrf

        {{-- Name --}}
<div class="mb-4">
    <label for="name">Name</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
            <!-- FontAwesome User Icon -->
            <i class="fas fa-user text-gray-500 dark:text-gray-400"></i>
        </div>
        <input type="text" name="name" value="{{ old('name') }}" class="input pl-10 @error('name') ring-red-500 @enderror">
    </div>
    @error('name')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

{{-- Email --}}
<div class="mb-4">
    <label for="email">Email</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
            <!-- FontAwesome Envelope Icon -->
            <i class="fas fa-envelope text-gray-500 dark:text-gray-400"></i>
        </div>
        <input type="text" name="email" value="{{ old('email') }}" class="input pl-10 @error('email') ring-red-500 @enderror">
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
        <input type="password" name="password" class="input pl-10 @error('password') ring-red-500 @enderror">
    </div>
    @error('password')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

{{-- Confirm Password --}}
<div class="mb-8">
    <label for="password_confirmation">Confirm Password</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
            <!-- FontAwesome Lock Icon -->
            <i class="fas fa-lock text-gray-500 dark:text-gray-400"></i>
        </div>
        <input type="password" name="password_confirmation" class="input pl-10 @error('password_confirmation') ring-red-500 @enderror">
    </div>
</div>


        <div class="mb-4">
            <input type="checkbox" name="subscribe" id="subscribe">
            <label for="subscribe">Subscribe to our newsletter</label>
        </div>

        {{-- Submit Button --}}
        <button x-ref="btn" class="btn">Register</button>
    </form>
</x-authCard>