<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Guias Abiertas' }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-zinc-950 font-sans text-zinc-100 antialiased">
        <div class="min-h-screen">
            <header class="border-b border-white/10 bg-zinc-950/95">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <span class="grid h-10 w-10 place-items-center rounded bg-emerald-400 text-lg font-black text-zinc-950">GA</span>
                        <span class="text-lg font-bold tracking-normal">Guias Abiertas</span>
                    </a>

                    <nav class="flex items-center gap-2 text-sm font-semibold">
                        <a href="{{ route('guides.index') }}" class="hidden rounded px-3 py-2 text-zinc-300 hover:bg-white/10 hover:text-white sm:inline-flex">Explorar</a>
                        @auth
                            <a href="{{ route('guides.mine') }}" class="rounded px-3 py-2 text-zinc-300 hover:bg-white/10 hover:text-white">Mis guias</a>
                            <a href="{{ route('guides.create') }}" class="rounded bg-emerald-400 px-4 py-2 text-zinc-950 hover:bg-emerald-300">Publicar</a>

                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="rounded px-3 py-2 text-zinc-300 hover:bg-white/10 hover:text-white">Cerrar sesión</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="rounded px-3 py-2 text-zinc-300 hover:bg-white/10 hover:text-white">Ingresar</a>
                            <a href="{{ route('register') }}" class="rounded bg-emerald-400 px-4 py-2 text-zinc-950 hover:bg-emerald-300">Crear cuenta</a>
                        @endauth
                    </nav>
                </div>
            </header>

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
