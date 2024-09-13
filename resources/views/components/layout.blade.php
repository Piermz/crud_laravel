<html lang="en" x-data="{ darkMode: getDarkModeFromLocalStorage() }" :class="{ 'dark': darkMode }" @keydown.window="if ($event.key === '.') toggleDarkMode()">
<html class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>skibdi</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body x-cloak x-data="{darkMode: $persist(false)}" :class="{'dark': darkMode === true }" class="antialiased">

    <div class="min-h-full mx-auto bg-white dark:bg-gray-900 shadow dark:shadow-gray-800 dark:text-gray-200">
        <x-navbar></x-navbar>

        {{-- <x-header>{{ $title }}</x-header> --}}
        <div>
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
