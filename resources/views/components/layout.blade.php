<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
    <link rel="shortcut icon" href="{{ asset('Echo.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg">
    <header>
        <nav class="max-w-screen-lg flex flex-wrap items-center justify-between mx-auto p-4 max-w-sc">
            <a href="{{ route('posts.index')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('Echo.svg') }}" class="h-10" alt="Echo Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Echo</span>
            </a>
            @auth
                <div class="relative grid place-items-center" x-data="{open: false}">
                    {{-- Dropdown menu button --}}
                    <button @click="open = !open" type="button" class="round-btn">
                        <img src="https://picsum.photos/200" alt="">
                    </button>
    
                    {{-- Dropdown menu --}}
                    <div x-show="open" @click.outside="open = false" class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light z-50">
                        <p class="username">{{auth()->user()->name}}</p>
    
                        <a href="{{ route('dashboard')}}" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Dashboard</a>
    
                        <form action="{{ route('logout')}}" method="post">
                            @csrf
                            <button class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth
            
            @guest
                <div class="flex-items-center">
                    <a href="{{ route('login')}}" class="nav-link">Login</a>
                    <a href="{{ route('register')}}" class="nav-link">Register</a>
                </div>
            @endguest
        </nav>
    </header>
    <main class="px-4 mx-auto max-w-screen-lg">
        {{$slot}}
    </main>
    <script>
        // Set form: x-data="formSubmit" @submit.prevent="submit" and button: x-ref="btn"
        document.addEventListener('alpine:init', () => {
            Alpine.data('formSubmit', () => ({
                submit() {
                    this.$refs.btn.disabled = true;
                    this.$refs.btn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                    this.$refs.btn.classList.add('bg-indigo-400');
                    this.$refs.btn.innerHTML =
                        `<span class="absolute left-2 top-1/2 -translate-y-1/2 transform">
                        <i class="fa-solid fa-spinner animate-spin"></i>
                        </span>Please wait...`;

                    this.$el.submit()
                }
            }))
        })
    </script>
</body>
</html>


