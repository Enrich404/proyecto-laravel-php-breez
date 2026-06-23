<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-white">
    <header class="border-b border-gray-800 bg-gray-950">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a href="/" class="text-2xl font-bold text-red-500">VideoHub</a>

            <div class="flex gap-3">
                <a href="/login" class="text-sm font-semibold text-gray-300 hover:text-white">Login</a>
                <a href="/register" class="rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-500">
                    Registrarse
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-8">
        <h1 class="text-3xl font-bold">Videos recomendados</h1>
        <p class="mt-2 text-gray-400">Explora contenido, tutoriales y videos destacados.</p>

        <section class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ([
                ['Curso de Laravel desde cero', 'Programacion Avanzada', '12K vistas'],
                ['MVC en Laravel explicado', 'Codigo Facil', '8.5K vistas'],
                ['CRUD con PHP y MySQL', 'Dev Web', '22K vistas'],
                ['Tailwind CSS basico', 'Frontend Lab', '15K vistas'],
                ['Laravel Breeze login', 'Laravel Class', '9K vistas'],
                ['Migraciones en Laravel', 'Backend Pro', '18K vistas'],
                ['Subida de archivos', 'PHP Master', '6.2K vistas'],
                ['Inventario de red', 'Redes y Sistemas', '4.8K vistas'],
            ] as $video)
                <article class="cursor-pointer">
                    <div class="flex aspect-video items-center justify-center rounded-xl bg-gray-800">
                        <span class="text-5xl font-bold text-red-500">▶</span>
                    </div>

                    <div class="mt-3 flex gap-3">
                        <div class="h-10 w-10 rounded-full bg-red-600"></div>

                        <div>
                            <h2 class="font-semibold text-white">{{ $video[0] }}</h2>
                            <p class="mt-1 text-sm text-gray-400">{{ $video[1] }}</p>
                            <p class="text-sm text-gray-500">{{ $video[2] }} · hace 2 dias</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
    </main>
</body>
</html>