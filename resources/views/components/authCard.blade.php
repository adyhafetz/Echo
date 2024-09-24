@props(['title'])

<x-layout>
    <h1 class="title">{{ $title }}</h1>
    
    <div class="mx-auto max-w-screen-sm card">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('Echo.svg') }}" alt="Logo" class="w-32 h-auto"> <!-- Adjust the width and height as needed -->
        </div>

        <!-- Slot for injecting custom content like form -->
        <div>
            {{ $slot }}
        </div>
    </div>
</x-layout>