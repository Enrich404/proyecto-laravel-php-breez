<x-layouts.public :title="$guide->title">
    <div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-black">{{ $guide->title }}</h1>
            <p class="text-sm text-zinc-400">Por {{ $guide->user->name }}</p>
        </div>

        <p class="mt-4 text-zinc-300">{{ $guide->description }}</p>

        @if($guide->hasPdf())
            <div class="mt-6">
                <p class="text-sm font-bold">Documento PDF</p>
                <a href="{{ $guide->pdf_url }}" target="_blank" class="mt-2 inline-block text-emerald-400">Abrir PDF</a>
                <div class="mt-4">
                    <embed src="{{ $guide->pdf_url }}" type="application/pdf" width="100%" height="600px" />
                </div>
            </div>
        @endif

        @if($guide->hasImages())
            <div class="mt-6">
                <p class="text-sm font-bold">Imagenes</p>
                <div class="mt-3 grid grid-cols-2 gap-4 md:grid-cols-3">
                    @foreach($guide->image_urls as $img)
                        <img src="{{ $img }}" alt="{{ $guide->title }}" class="h-40 w-full rounded object-cover" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layouts.public>
