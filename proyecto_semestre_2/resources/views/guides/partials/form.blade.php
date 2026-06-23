@csrf

<div class="grid gap-6">
    <div>
        <x-input-label for="title" value="Titulo" />
        <x-text-input id="title" name="title" type="text" class="mt-2 block w-full" value="{{ old('title', $guide->title) }}" required autofocus />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <x-input-label for="category" value="Categoria" />
            <x-text-input id="category" name="category" type="text" class="mt-2 block w-full" value="{{ old('category', $guide->category ?? 'General') }}" required />
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="visibility" value="Visibilidad" />
            <select id="visibility" name="visibility" class="mt-2 block w-full rounded border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                <option value="public" @selected(old('visibility', $guide->visibility) === 'public')>Publica</option>
                <option value="private" @selected(old('visibility', $guide->visibility) === 'private')>Privada</option>
            </select>
            <x-input-error :messages="$errors->get('visibility')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-input-label for="description" value="Descripcion" />
        <textarea id="description" name="description" rows="6" class="mt-2 block w-full rounded border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('description', $guide->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="pdf" value="Archivo PDF (opcional)" />
        <input id="pdf" name="pdf" type="file" accept=".pdf,application/pdf" class="mt-2 block w-full rounded border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-700 shadow-sm file:mr-4 file:rounded file:border-0 file:bg-zinc-950 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-zinc-800" @required(! $guide->exists) />
        <x-input-error :messages="$errors->get('pdf')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="images" value="Imágenes (puedes subir varias)" />
        <input id="images" name="images[]" type="file" accept=".jpg,.jpeg,.png,.webp,image/*" multiple class="mt-2 block w-full rounded border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-700 shadow-sm file:mr-4 file:rounded file:border-0 file:bg-zinc-950 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-zinc-800" />
        <p class="mt-2 text-sm text-zinc-500">Maximo 10 MB por archivo.</p>
        <x-input-error :messages="$errors->get('images')" class="mt-2" />
        <x-input-error :messages="$errors->get('images.*')" class="mt-2" />
    </div>

    <div class="flex flex-wrap items-center justify-end gap-3 border-t border-zinc-200 pt-6">
        <a href="{{ route('guides.mine') }}" class="rounded border border-zinc-300 px-4 py-2 text-sm font-bold text-zinc-700 hover:bg-zinc-100">Cancelar</a>
        <button type="submit" class="rounded bg-emerald-500 px-5 py-2 text-sm font-bold text-zinc-950 hover:bg-emerald-400">
            {{ $guide->exists ? 'Guardar cambios' : 'Publicar guia' }}
        </button>
    </div>
</div>
