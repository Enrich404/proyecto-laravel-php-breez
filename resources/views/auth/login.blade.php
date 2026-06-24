<x-layouts.public title="Ingresar">
    <div class="mx-auto max-w-xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-white/10 bg-zinc-950/95 p-8 shadow-2xl shadow-black/10 ring-1 ring-white/5">
            <div class="mb-10 text-center">
                <h1 class="text-3xl font-bold tracking-tight text-white">Ingresar</h1>
                <p class="mt-3 text-sm text-zinc-400">Accede a tu cuenta para gestionar y publicar guías.</p>
            </div>

            <x-auth-session-status class="mb-4 rounded-xl bg-emerald-500/10 p-4 text-sm text-emerald-200" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-zinc-200" />
                    <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-zinc-200" />
                    <x-text-input id="password" class="mt-2 block w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center gap-3">
                    <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-zinc-300">
                        <input id="remember_me" type="checkbox" class="rounded border-zinc-700 bg-zinc-950 text-emerald-400 shadow-sm focus:ring-emerald-400" name="remember">
                        {{ __('Remember me') }}
                    </label>

                    @if (Route::has('password.request'))
                        <a class="ml-auto text-sm font-semibold text-zinc-300 hover:text-white" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ route('register') }}" class="text-sm font-semibold text-zinc-300 hover:text-white">
                        {{ __('Create an account') }}
                    </a>

                    <x-primary-button class="w-full sm:w-auto">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.public>
