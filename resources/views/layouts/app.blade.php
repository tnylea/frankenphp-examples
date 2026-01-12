<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="p-10">
        
        <main class="w-full max-w-2xl mx-auto flex flex-col items-stretch">
            <h1 class="text-2xl font-bold mb-5">FrankenPHP Isolated rendering examples</h1>
            <div class="flex items-stretch">
                <aside class="w-64 shrink-0 bg-stone-100"></aside>
                <div class="flex-1">{{ $slot }}</div>
            </div>
        </main>

        @livewireScripts
    </body>
</html>
