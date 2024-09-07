<!doctype html>
<html class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>skibdi</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>

    <div class="min-h-full">
        {{-- <x-navbar></x-navbar> --}}
        {{-- <x-header>{{ $title }}</x-header> --}}
        <div class="mx-auto ">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
