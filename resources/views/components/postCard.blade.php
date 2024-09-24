@props(['post', 'full' => false])

<div class="my-8 rounded shadow-lg shadow-gray-200 dark:shadow-gray-900 bg-white dark:bg-[#373a40] duration-300 hover:-translate-y-1 relative h-full"> <!-- Added `relative` and `h-full` classes -->

    <!-- Clickable Area -->
    <a href="{{ route('posts.show', $post) }}" class="cursor-pointer block"> <!-- Added `block` class for full width -->
        <figure>
            <!-- Image -->
            <img src="{{ $post->image && !str_contains($post->image, 'picsum.photos') ? asset('storage/' . $post->image) : 'https://picsum.photos/800/400' }}" class="rounded-t h-72 w-full object-cover" alt="">
            <figcaption class="p-4">
                <!-- Title -->
                <p class="text-lg mb-2 font-bold leading-relaxed text-gray-800 dark:text-gray-300">{{ $post->title }}</p>

                <!-- Author and Date -->
                <div class="text-xs font-light mb-2 dark:text-gray-300">
                    <span>Posted {{ $post->created_at->diffForHumans() }} by </span>
                    <a href="{{ route('posts.user', $post->user) }}" class="text-[#DC5F00] font-medium">{{ $post->user->name }}</a>
                </div>

                <!-- Description -->
                @if ($full)
                    <small class="leading-5 text-gray-500 dark:text-gray-400">
                        {{ $post->body }}
                    </small>
                @else
                    <small class="leading-5 text-gray-500 dark:text-gray-400">
                        {{ Str::words($post->body, 15) }}
                    </small>
                @endif
            </figcaption>
        </figure>
    </a>

    <!-- Buttons slot fixed at the bottom-right -->
    <div class="absolute bottom-4 right-4 flex space-x-2"> <!-- Use flex and space-x-2 for inline buttons -->
        {{ $slot }}
    </div>
</div>
