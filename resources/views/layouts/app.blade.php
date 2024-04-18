<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Depresi Check</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

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
</head>

<body class="antialiased font-inter bg-slate-100 dark:bg-slate-900 text-slate-700 dark:text-slate-400"
    :class="{ 'sidebar-expanded': sidebarExpanded }" x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">

    <script>
        if (localStorage.getItem('sidebar-expanded') == 'true') {
            document.querySelector('body').classList.add('sidebar-expanded');
        } else {
            document.querySelector('body').classList.remove('sidebar-expanded');
        }
    </script>

    <!-- Page wrapper -->
    <div class="flex h-[100dvh] overflow-hidden">

        <x-app.sidebar />

        <!-- Content area -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if ($attributes['background']) {{ $attributes['background'] }} @endif"
            x-ref="contentarea">

            <x-app.header />

            <main class="grow">
                {{ $slot }}
            </main>

        </div>

    </div>

    <script>
        window.onclick = function(event) {
            const gejalaModal = document.getElementById('gejala-modal');
            const depresiModal = document.getElementById('depresi-modal');
            const kondisiModal = document.getElementById('kondisi-modal');
            const keputusanModal = document.getElementById('keputusan-modal');
            if (event.target == gejalaModal) {
                gejalaModal.style.display = 'none';
                $('#kode_gejala').val('');
                $('#deskripsi_gejala').val('');
            } else if (event.target == depresiModal) {
                depresiModal.style.display = 'none';
                $('#kode_depresi').val('');
                $('#deskripsi_depresi').val('');
            } else if (event.target == kondisiModal) {
                kondisiModal.style.display = 'none';
                $('#deskripsi_kondisi').val('');
                $('#nilai_kondisi').val('');
            } else if (event.target == keputusanModal) {
                keputusanModal.style.display = 'none';
                $('#kode_gejala_keputusan').val('');
                $('#kode_depresi_keputusan').val('');
                $('#mb_keputusan').val('');
                $('#md_keputusan').val('');
            }
        }
    </script>

    @livewireScripts
</body>

</html>
