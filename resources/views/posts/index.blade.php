<x-layout>
    <x-titleMsg/>
    
    <!-- Image Section (adjust as needed) -->
    <img src="{{asset('storage/post_images')}}" alt="" class="w-full h-auto mb-6"> 

    <!-- Responsive Grid Layout -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <x-postCard :post="$post"/>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-12">
        {{$posts->links()}}
    </div>
</x-layout>
