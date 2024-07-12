<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources\css\app.css', 'resources\js\app.js'])
    <!-- component -->
    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
</head>

<body>

    <!-- page -->
    <main class="min-h-screen w-full bg-gray-100 text-gray-700" x-data="layout">
        <!-- header page -->
        <header class="flex w-full items-center justify-between border-b-2 border-gray-200 bg-white p-2" >
            <!-- logo -->
            <div class="flex items-center space-x-2">
                <button type="button" class="text-3xl" @click="asideOpen = !asideOpen"><i
                        class="bx bx-menu"></i></button>
                <div>Logo</div>
            </div>
        </header>

        <div class="flex">
            <!-- aside -->
            <aside class="flex w-72 flex-col space-y-2 border-r-2 border-gray-200 bg-white p-2"
                x-show="asideOpen">
                <a href="{{ route('posts.index') }}"
                    class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-home"></i></span>
                    <span>Home</span>
                </a>

                @guest
                    <a href="{{ route('login') }}"
                        class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                        <span class="text-2xl"><i class="bx bx-user"></i></span>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}"
                        class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                        <span class="text-2xl"><i class="bx bx-user"></i></span>
                        <span>Register</span>
                    </a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                        <span class="text-2xl"><i class="bx bx-user"></i></span>
                        <span>Dashboard</span>
                    </a>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-red-100 hover:text-red-600 w-full">
                            <span class="text-2xl"><i class="bx bx-user"></i></span>
                            <span>{{ auth()->user()->username }}</span>
                        </button>
                    </form>
                @endauth

            </aside>

            <!-- main content page -->
            <div class="w-full p-4">
                {{ $slot }}
            </div>
        </div>
    </main>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("layout", () => ({
                profileOpen: false,
                asideOpen: true,
            }));
        });
    </script>
</body>

</html>
