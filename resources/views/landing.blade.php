<x-guest-layout>
    <div class="space-y-6 text-center">
        {{-- Judul kecil di atas --}}
        <div class="space-y-1">
            <p class="text-[11px] sm:text-xs font-semibold tracking-[0.25em] text-sky-700 uppercase">
                Sistem Pendaftaran Magang
            </p>
            <p class="text-xs sm:text-sm text-sky-800">
                DPPPA Provinsi Sumatera Selatan
            </p>
        </div>

        {{-- Kartu utama --}}
        <div class="bg-white/95 backdrop-blur shadow-xl rounded-3xl px-6 py-6 sm:px-10 sm:py-10 max-w-xl mx-auto">
            <div class="space-y-3">
                <h1 class="text-xl sm:text-2xl font-semibold text-sky-800">
                    Sistem Pendaftaran Magang
                </h1>
                <p class="text-sm sm:text-base text-gray-700">
                    Dinas Pemberdayaan Perempuan dan Perlindungan Anak<br>
                    Provinsi Sumatera Selatan
                </p>
                <p class="mt-2 text-xs sm:text-sm text-gray-500 leading-relaxed">
                    Ajukan pendaftaran magang secara online, unggah dokumen pendukung,
                    dan pantau status verifikasi Anda tanpa harus datang langsung.
                    Sistem ini membantu mahasiswa dan pihak Dinas mengelola proses magang
                    dengan lebih terstruktur, transparan, dan tepat waktu.
                </p>
            </div>

            {{-- Tombol aksi --}}
            <div class="mt-6 space-y-3">
                <a href="{{ route('login') }}"
                    class="block w-full text-sm font-semibold tracking-widest uppercase
                          bg-sky-600 text-white rounded-full py-2.5 shadow-sm
                          hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                    Masuk
                </a>

                <a href="{{ route('register') }}"
                    class="block w-full text-sm font-semibold tracking-widest uppercase
                          border border-sky-400 text-sky-700 rounded-full py-2.5
                          hover:bg-sky-50 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                    Daftar Peserta
                </a>
            </div>

            {{-- Info singkat di bawah tombol --}}
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4 text-left text-[11px] sm:text-xs text-gray-600">
                <div>
                    <p class="font-semibold text-sky-800 mb-1">Siapa yang dapat mendaftar?</p>
                    <p>
                        Mahasiswa/i yang ingin melaksanakan magang di DPPPA Provinsi Sumatera Selatan
                        sesuai ketentuan kampus masing-masing.
                    </p>
                </div>
                <div>
                    <p class="font-semibold text-sky-800 mb-1">Dokumen yang disiapkan</p>
                    <p>
                        Curriculum Vitae (CV), surat pengantar dari kampus, serta data diri dan kontak
                        yang dapat dihubungi.
                    </p>
                </div>
                <div>
                    <p class="font-semibold text-sky-800 mb-1">Alur singkat</p>
                    <p>
                        Buat akun &rarr; lengkapi formulir & unggah dokumen &rarr; tunggu verifikasi admin
                        &rarr; terima pemberitahuan melalui email.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>