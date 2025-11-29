<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-b from-sky-50 via-white to-lime-50 flex items-center justify-center px-4">
        <div class="w-full max-w-4xl">
            {{-- Kartu utama 2 kolom di layar besar --}}
            <div class="bg-white rounded-[32px] shadow-2xl px-6 py-6 sm:px-10 sm:py-8
                        flex flex-col md:flex-row gap-8 md:gap-10">

                {{-- Kolom kiri: judul & deskripsi --}}
                <div class="md:w-1/2 flex flex-col justify-center">
                    <p class="text-[11px] font-semibold tracking-[0.25em] text-sky-700 uppercase">
                        Sistem Pendaftaran Magang
                    </p>
                    <p class="text-[11px] text-slate-500 mt-1">
                        DPPPA Provinsi Sumatera Selatan
                    </p>

                    <h1 class="mt-4 text-2xl font-semibold text-slate-800">
                        Buat Akun Peserta Magang
                    </h1>
                    <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                        Dengan akun ini Anda dapat mengajukan pendaftaran magang, mengunggah dokumen
                        pendukung, serta memantau status verifikasi tanpa harus datang langsung ke kantor DPPPA.
                    </p>

                    <ul class="mt-4 space-y-1 text-xs text-slate-500">
                        <li>• Satu akun hanya untuk satu peserta.</li>
                        <li>• Pastikan email dan nomor HP aktif untuk menerima informasi lanjutan.</li>
                    </ul>
                </div>

                {{-- Kolom kanan: form --}}
                <div class="md:w-1/2">
                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        {{-- Nama --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700">
                                Nama Lengkap
                            </label>
                            <input id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                class="mt-1 block w-full rounded-md border-slate-300 text-sm
                                          focus:border-sky-500 focus:ring-sky-500">
                            @error('name')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">
                                Email
                            </label>
                            <input id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                class="mt-1 block w-full rounded-md border-slate-300 text-sm
                                          focus:border-sky-500 focus:ring-sky-500">
                            @error('email')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No HP --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700">
                                No HP
                            </label>
                            <input id="phone"
                                name="phone"
                                type="text"
                                value="{{ old('phone') }}"
                                required
                                placeholder="Misal: 0812xxxxxxxx"
                                class="mt-1 block w-full rounded-md border-slate-300 text-sm
                                          focus:border-sky-500 focus:ring-sky-500">
                            @error('phone')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700">
                                Password
                            </label>
                            <input id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="new-password"
                                class="mt-1 block w-full rounded-md border-slate-300 text-sm
                                          focus:border-sky-500 focus:ring-sky-500">
                            @error('password')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-700">
                                Konfirmasi Password
                            </label>
                            <input id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                autocomplete="new-password"
                                class="mt-1 block w-full rounded-md border-slate-300 text-sm
                                          focus:border-sky-500 focus:ring-sky-500">
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <a href="{{ route('login') }}"
                                class="text-xs text-sky-700 hover:text-sky-900">
                                Sudah punya akun? <span class="underline">Masuk</span>
                            </a>

                            <button type="submit"
                                class="inline-flex items-center px-5 py-2 rounded-full text-xs font-semibold
                                           bg-sky-600 text-white hover:bg-sky-700 shadow-sm">
                                REGISTER
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>