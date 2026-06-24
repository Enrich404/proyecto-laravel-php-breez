<x-layouts.public title="Explorar guias">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-black">Explorar guias</h1>

        <div class="mt-6 grid gap-6 md:grid-cols-3">
            @foreach($guides as $g)
                <article class="rounded border border-zinc-800 bg-zinc-900 p-4">
                    <h2 class="text-lg font-bold"><a href="{{ route('guides.show', $g) }}">{{ $g->title }}</a></h2>
                    <p class="mt-2 text-sm text-zinc-400">{{ $g->category }} • por {{ $g->user->name }}</p>
                </article>
            @endforeach
        </div>

        <div class="mt-6">{{ $guides->links() }}</div>
    </div>
</x-layouts.public>
