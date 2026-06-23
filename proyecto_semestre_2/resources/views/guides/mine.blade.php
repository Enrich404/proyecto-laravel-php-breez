<x-layouts.public title="Mis guias">
    <div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-black">Mis guias</h1>

        <div class="mt-6 space-y-4">
            @foreach($guides as $g)
                <div class="rounded border border-zinc-800 bg-zinc-900 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-bold"><a href="{{ route('guides.show', $g) }}">{{ $g->title }}</a></h2>
                            <p class="text-sm text-zinc-400">{{ $g->category }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('guides.edit', $g) }}" class="rounded border px-3 py-1 text-sm">Editar</a>
                            <form action="{{ route('guides.destroy', $g) }}" method="post" onsubmit="return confirm('Eliminar guia?');">
                                @csrf @method('delete')
                                <button type="submit" class="rounded bg-rose-600 px-3 py-1 text-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $guides->links() }}</div>
    </div>
</x-layouts.public>
