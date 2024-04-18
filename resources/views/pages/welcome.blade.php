<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Depresi Check</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <script>
        if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
            document.querySelector('html').classList.remove('dark');
            document.querySelector('html').style.colorScheme = 'light';
        } else {
            document.querySelector('html').classList.add('dark');
            document.querySelector('html').style.colorScheme = 'dark';
        }
    </script>

    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <style>
        .typed {
            -webkit-text-stroke: 2px #000;
        }

        .typed-cursor {
            color: rgb(30, 64, 175);
            font-size: 5rem;
            line-height: 1;

        }
    </style>
</head>

<body class="antialiased font-inter bg-gradient-to-br from-blue-200 to-blue-400 text-slate-700">
    <div class="mx-auto max-w-7xl">
        <header class="fixed flex justify-between w-full px-4 py-8 max-w-7xl">
            <h1>logo</h1>
            <nav>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block px-3 py-1 text-xl font-bold bg-blue-500 rounded text-slate-200 hover:bg-blue-600 hover:text-slate-100 duration-100 shadow hover:shadow-md">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-3 py-1 text-xl font-bold bg-blue-500 rounded text-slate-200 hover:bg-blue-600 hover:text-slate-100 duration-100 shadow hover:shadow-md">Login</a>
                @endauth
            </nav>
        </header>
        <main class="grid items-center justify-center h-full grid-cols-1 md:grid-cols-2 min-h-dvh">
            <div>
                <h1 class="mb-4 text-5xl font-bold text-center md:text-left">Cek Tingkat <span
                        class="text-blue-800">Depresimu</span>
                    Sekarang!</h1>

                <span id="typed-1" class="font-bold text-transparent text-blue-800 capitalize text-8xl typed"></span>
            </div>
            <div class="mx-auto">
                <img src="{{ asset('images/hero.svg') }}" alt="" class="object-cover w-96">
            </div>
        </main>
    </div>

    <script>
        var typed = new Typed('#typed-1', {
            strings: ['solusi', 'atasi', 'depresi'],
            typeSpeed: 80,
            backSpeed: 0,
            startDelay: 200,
            backDelay: 2200,
            loop: true,
            loopCount: false,
            showCursor: true,
            attr: null
        });
    </script>

    @livewireScripts
</body>

</html>
