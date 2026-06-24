<nav x-data="{ open: false }" class="border-b border-zinc-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('guides.mine') }}" class="flex items-center gap-3">
                        <span class="grid h-9 w-9 place-items-center rounded bg-emerald-400 text-sm font-black text-zinc-950">GA</span>
                        <span class="font-bold text-zinc-950">Guias Abiertas</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('guides.mine')" :active="request()->routeIs('guides.mine')">
                        {{ __('Mis guias') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guides.index')" :active="request()->routeIs('guides.index')">
                        {{ __('Explorar') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guides.create')" :active="request()->routeIs('guides.create')">
                        {{ __('Publicar') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center rounded border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-zinc-600 transition hover:text-zinc-900 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar sesion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded p-2 text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-700 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('guides.mine')" :active="request()->routeIs('guides.mine')">
                {{ __('Mis guias') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guides.index')" :active="request()->routeIs('guides.index')">
                {{ __('Explorar') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guides.create')" :active="request()->routeIs('guides.create')">
                {{ __('Publicar') }}
            </x-responsive-nav-link>
        </div>

        <div class="border-t border-zinc-200 pb-1 pt-4">
            <div class="px-4">
                <div class="text-base font-medium text-zinc-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-zinc-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar sesion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
