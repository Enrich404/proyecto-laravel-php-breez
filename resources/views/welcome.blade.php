<x-layouts.public title="Guias Abiertas">
    <section class="border-b border-white/10 bg-zinc-950">
        <div class="mx-auto grid min-h-[calc(100vh-73px)] max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[1fr_0.86fr] lg:px-8">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.22em] text-emerald-300">Biblioteca colaborativa</p>
                <h1 class="mt-5 max-w-4xl text-5xl font-black leading-[0.98] tracking-normal text-white sm:text-6xl lg:text-7xl">
                    Publica guias en PDF e imagenes para tu comunidad.
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-zinc-300">
                    Un espacio para ordenar apuntes, manuales, procedimientos y materiales visuales. Cada usuario administra sus propias guias y decide que comparte.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('guides.index') }}" class="rounded bg-emerald-400 px-5 py-3 text-sm font-bold text-zinc-950 hover:bg-emerald-300">Explorar guias</a>
                    @auth
                        <a href="{{ route('guides.create') }}" class="rounded border border-white/15 px-5 py-3 text-sm font-bold text-white hover:bg-white/10">Subir guia</a>
                    @else
                        <a href="{{ route('register') }}" class="rounded border border-white/15 px-5 py-3 text-sm font-bold text-white hover:bg-white/10">Crear cuenta</a>
                    @endauth
                </div>
            </div>

            <div class="relative">
                <div class="grid gap-4">
                    <div class="rounded border border-white/10 bg-white p-5 text-zinc-950 shadow-2xl shadow-black/30">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-emerald-700">PDF</p>
                                <h2 class="mt-3 text-2xl font-black">Manual de instalacion</h2>
                            </div>
                            <span class="rounded bg-rose-100 px-3 py-1 text-xs font-bold text-rose-700">Nuevo</span>
                        </div>
                        <div class="mt-6 space-y-3">
                            <div class="h-3 w-full rounded bg-zinc-200"></div>
                            <div class="h-3 w-5/6 rounded bg-zinc-200"></div>
                            <div class="h-3 w-2/3 rounded bg-zinc-200"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded border border-white/10 bg-cyan-200 p-4 text-zinc-950">
                            <p class="text-xs font-black uppercase tracking-[0.18em]">Imagen</p>
                            <div class="mt-8 h-24 rounded bg-cyan-600"></div>
                            <p class="mt-4 font-bold">Mapa de red</p>
                        </div>
                        <div class="rounded border border-white/10 bg-amber-200 p-4 text-zinc-950">
                            <p class="text-xs font-black uppercase tracking-[0.18em]">Guia</p>
                            <div class="mt-8 grid h-24 place-items-center rounded bg-amber-500 text-4xl font-black">12</div>
                            <p class="mt-4 font-bold">Pasos clave</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-zinc-100 px-4 py-12 text-zinc-950 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-4 md:grid-cols-3">
            <article class="border border-zinc-200 bg-white p-6">
                <p class="text-3xl font-black">PDF</p>
                <h2 class="mt-4 text-xl font-bold">Documentos completos</h2>
                <p class="mt-2 text-sm leading-6 text-zinc-600">Guarda materiales extensos con nombre, categoria y descripcion.</p>
            </article>
            <article class="border border-zinc-200 bg-white p-6">
                <p class="text-3xl font-black">IMG</p>
                <h2 class="mt-4 text-xl font-bold">Guias visuales</h2>
                <p class="mt-2 text-sm leading-6 text-zinc-600">Comparte capturas, diagramas, referencias y pasos visuales.</p>
            </article>
            <article class="border border-zinc-200 bg-white p-6">
                <p class="text-3xl font-black">USER</p>
                <h2 class="mt-4 text-xl font-bold">Contenido propio</h2>
                <p class="mt-2 text-sm leading-6 text-zinc-600">Cada cuenta mantiene su biblioteca con controles de edicion.</p>
            </article>
        </div>
    </section>
</x-layouts.public>
