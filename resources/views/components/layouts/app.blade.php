<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Templater') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-stone-50 text-zinc-950 antialiased">
        <div class="min-h-screen">
            <header class="border-b border-zinc-200 bg-white/90 backdrop-blur">
                <nav class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
                    <a href="{{ route('home') }}" class="text-lg font-bold text-zinc-950">Templater</a>

                    <div class="flex items-center gap-2 text-sm">
                        @auth
                            <a href="{{ route('projects.index') }}" class="rounded-md px-3 py-2 font-medium text-zinc-700 hover:bg-zinc-100">مشاريعي</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="rounded-md bg-zinc-950 px-3 py-2 font-medium text-white hover:bg-zinc-800">خروج</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="rounded-md px-3 py-2 font-medium text-zinc-700 hover:bg-zinc-100">دخول</a>
                            <a href="{{ route('register') }}" class="rounded-md bg-zinc-950 px-3 py-2 font-medium text-white hover:bg-zinc-800">تسجيل</a>
                        @endauth
                    </div>
                </nav>
            </header>

            <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6">
                @if (session('status'))
                    <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900">
                        {{ session('status') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
