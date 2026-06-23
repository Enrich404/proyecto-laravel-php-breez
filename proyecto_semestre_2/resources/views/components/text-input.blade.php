@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-zinc-950 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm']) }}>
