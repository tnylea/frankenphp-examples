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
                <aside class="w-32 shrink-0">
                    <ul>
                        <li><a href="{{ route('home') }}" class="hover:underline @if(Request::is('/')) underline @endif">Home</a></li>
                        <li><a href="{{ route('string') }}" wire:current="underline" class="hover:underline">String</a></li>
                        <li><a href="{{ route('layout') }}" wire:current="underline" class="hover:underline">Layout</a></li>
                    </ul>
                </aside>
                <div class="flex-1 overflow-hidden" style="max-width:100%">{{ $slot }}</div>
            </div>
        </main>

        @livewireScripts
    </body>
</html>
