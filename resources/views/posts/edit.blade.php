<x-layout>
    <a href="{{ route('dashboard') }}" class="block mb-2 text-xs text-[#DC5F00]">&larr; Go back to your dashboard</a>
    
    {{-- Update Form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4 text-white">Update your post</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" />
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif

        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="input @error('title') ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="body">Post Body</label>
                <textarea name="body" id="" rows="5" class="input @error('body') ring-red-500 @enderror">{{ $post->body }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current Cover Image --}}
            @if ($post->image)
                <div class="h-auto rounded-md mb-4">
                    <label>Current Cover Photo</label>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="" class="w-full h-auto rounded-md">
                </div>
            @endif

            {{-- Post Image (Drag-and-Drop Upload) --}}
            <label>Cover Photo</label>
            <div class="mt-1 mb-4">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-100 relative">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="dropzone-content">
                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <!-- Preview Image -->
                    <img id="image-preview" class="absolute inset-0 w-full h-full object-cover rounded-lg" style="display: none;" />
                    <input id="dropzone-file" type="file" name="image" class="hidden" />
                </label>
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button class="btn">Update</button>
        </form>
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
