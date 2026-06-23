<x-layouts.public title="Publicar guia">
    <div class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-black">Nueva guia</h1>

        <form action="{{ route('guides.store') }}" method="post" enctype="multipart/form-data" class="mt-6">
            @include('guides.partials.form')
        </form>
    </div>
</x-layouts.public>
