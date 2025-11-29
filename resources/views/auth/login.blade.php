<x-guest-layout>
    <div class="mb-4 text-center">
        <h1 class="text-lg font-semibold text-sky-800">
            Masuk ke Akun Anda
        </h1>
        <p class="mt-1 text-xs text-gray-500">
            Gunakan email dan kata sandi yang telah terdaftar.
        </p>
    </div>

    {{-- Status (misal setelah reset password) --}}
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Email" class="text-sm text-gray-700" />
            <x-text-input id="email"
                          class="block mt-1 w-full"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div class="mt-4">
            <x-input-label for="password" value="Password" class="text-sm text-gray-700" />
            <x-text-input id="password"
                          class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required
                          autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember me --}}
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me"
                       type="checkbox"
                       class="rounded border-gray-300 text-sky-600 shadow-sm focus:border-sky-500 focus:ring-sky-500"
                       name="remember">
                <span class="ms-2 text-xs text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-6 flex items-center justify-between">
            @if (Route::has('password.request'))
                <a class="text-xs text-sky-700 hover:text-sky-900 underline"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center text-xs text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}"
               class="font-semibold text-sky-700 hover:text-sky-900 underline">
                Daftar sebagai peserta
            </a>
        </div>
    </form>
</x-guest-layout>
