<x-layout>
    <h1 class="title">Welcome {{auth()->user()->name}} you have {{$posts->total()}} posts</h1>

    {{-- Create Post Form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4 text-white">Create a new post</h2>

        {{-- Session Messages --}}
        @if (session('success'))
                <x-flashMsg msg="{{session('success')}}"/>
        @elseif (session('delete'))
                <x-flashMsg msg="{{session('delete')}}" bg="bg-red-500"/>
        @endif
        <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            
            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="input @error('title') ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="body">Post Body</label>
                <textarea name="body" id="" rows="5" class="input @error('body') ring-red-500 @enderror">{{ old('body') }}</textarea>
                @error('body')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>

            {{-- Post Image --}}
            <label>Cover Photo</label>
            <div class="mt-1 mb-4">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-100 dark:border-white dark:bg-white dark:hover:bg-gray-200 relative">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="dropzone-content">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <!-- Preview Image -->
                    <img id="image-preview" class="absolute inset-0 w-full h-full object-cover rounded-lg" style="display: none;" />
                    <input id="dropzone-file" type="file" name="image" class="hidden bg-white" />
                </label>
                @error('image')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>


            {{-- Submit Button --}}
            <button class="btn">Create</button>
        </form>
    </div>
    {{-- Latest Post --}}
    @if ($posts->isEmpty())
        <p class="text-gray-500">No posts available.</p>
    @else
        <h2 class="font-bold  text-white">Your Latest Post</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <x-postCard :post="$post">
                    {{-- Update post --}}
                    <a href="{{ route('posts.edit', $post) }}" class="glass-button bg-opacity-80 text-white px-2 py-1 text-xs rounded-md flex items-center justify-center w-8 h-8">
                        <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
                    </a>
                    
                    {{-- Delete post --}}
                    <form action="{{ route('posts.destroy', $post) }}" method="post" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="glass-button bg-red-500 text-white px-2 py-1 text-xs rounded-md flex items-center justify-center w-8 h-8">
                            <i class="fas fa-trash-alt"></i> <!-- Font Awesome trash icon -->
                        </button>
                    </form>
                </x-postCard>
            @endforeach
        </div>
    @endif
    <div class="mt-12"> <!-- Added margin-top for spacing -->
        {{ $posts->links() }}
    </div>
    <script>
        document.getElementById('dropzone-file').addEventListener('change', function(event) {
            const fileInput = event.target;
            const previewImage = document.getElementById('image-preview');
            const dropzoneContent = document.getElementById('dropzone-content');
            
            // Check if a file is selected
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Set preview image src to the file's data URL
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    
                    // Hide the dropzone content
                    dropzoneContent.style.display = 'none';
                }
                
                // Read the image file as a data URL
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                // No file selected, reset preview
                previewImage.style.display = 'none';
                dropzoneContent.style.display = 'flex';
            }
        });
    </script>
</x-layout>
