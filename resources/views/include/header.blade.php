{{--<nav class="navbar navbar-expand-lg bg-body-tertiary">--}}
{{--    <div class="container-fluid">--}}
{{--        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"--}}
{{--                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarText">--}}
{{--            <ul class="navbar-nav me-auto mb-2 mb-lg-0">--}}

{{--                @auth()--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>--}}
{{--                    </li>--}}
{{--                @else--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('register.showRegister') }}">Register</a>--}}
{{--                    </li>--}}
{{--                @endauth--}}
{{--            </ul>--}}
{{--            <span class="navbar-text">--}}
{{--                @auth()--}}
{{--                    {{ auth()->user()->name }}--}}
{{--                @endauth--}}
{{--            </span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}


    <!DOCTYPE html>
<html>
<head>
    <title>My App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="text-white">
                    <a href="/" class="text-lg font-semibold">My App</a>
                </div>
            </div>
            <div class="md:hidden">
                <button id="toggleNavbar" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div id="navbarLinks" class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About</a>
                    <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container mx-auto">
    @yield('content')
</div>

<script>
    const toggleNavbar = document.getElementById("toggleNavbar");
    const navbarLinks = document.getElementById("navbarLinks");

    toggleNavbar.addEventListener("click", () => {
        navbarLinks.classList.toggle("hidden");
    });
</script>

<div class="container mx-auto">
    @yield('content')
</div>
<div class="container mx-auto">
    @yield('content')
</div>
</body>
</html>
