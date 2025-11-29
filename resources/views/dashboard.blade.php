<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    Dashboard Peserta
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Ringkasan pengajuan magang dan informasi terbaru untuk Anda.
                </p>
            </div>
            <span class="hidden sm:inline text-[11px] text-sky-700 uppercase tracking-[0.25em]">
                Magang DPPPA Sumatera Selatan
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Banner sambutan --}}
            <div class="bg-gradient-to-r from-sky-500 via-sky-500 to-teal-400 text-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-6 sm:px-8 sm:py-7 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-sky-100 mb-1">
                            Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span> 👋
                        </p>
                        <h3 class="text-lg sm:text-xl font-semibold">
                            Kelola pendaftaran magang Anda di satu tempat.
                        </h3>
                        <p class="mt-2 text-xs sm:text-sm text-sky-100 leading-relaxed max-w-xl">
                            Dari pengisian formulir, upload dokumen, hingga melihat hasil verifikasi,
                            semua dapat Anda pantau melalui dashboard ini tanpa harus datang langsung ke kantor DPPPA.
                        </p>
                    </div>

                    <div class="flex flex-col items-stretch gap-2 min-w-[180px]">
                        <a href="{{ route('pendaftaran.index') }}"
                            class="inline-flex justify-center items-center px-4 py-2.5 rounded-full text-xs font-semibold uppercase tracking-widest bg-white text-sky-700 shadow hover:bg-sky-50">
                            Kelola Pendaftaran
                        </a>
                        <p class="text-[11px] text-sky-100 text-center">
                            Status dan riwayat pengajuan bisa Anda lihat setiap saat.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Konten utama: status + info --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Kolom kiri: status pendaftaran --}}
                <div class="lg:col-span-2 space-y-4">
                    <div class="bg-white shadow-sm rounded-xl">
                        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-800">
                                    Status Pendaftaran Magang Anda
                                </h3>
                                <p class="text-xs text-slate-500 mt-1">
                                    Informasi singkat mengenai pengajuan terbaru.
                                </p>
                            </div>

                            @php
                            $pendaftaran = Auth::user()->pendaftaranMagang ?? null;
                            @endphp

                            @if ($pendaftaran)
                            @php
                            $badgeColor = match ($pendaftaran->status) {
                            'diterima' => 'bg-emerald-100 text-emerald-800',
                            'ditolak' => 'bg-rose-100 text-rose-800',
                            default => 'bg-amber-100 text-amber-800',
                            };
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                Status: {{ ucfirst($pendaftaran->status) }}
                            </span>
                            @endif
                        </div>

                        <div class="px-6 py-5 text-sm">
                            @if ($pendaftaran)
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-xs text-slate-500">Terakhir diperbarui</dt>
                                    <dd class="mt-1 font-medium text-slate-800">
                                        {{ $pendaftaran->updated_at->format('d M Y H:i') }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-slate-500">Universitas</dt>
                                    <dd class="mt-1 font-medium text-slate-800">
                                        {{ $pendaftaran->universitas }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-slate-500">Program Studi</dt>
                                    <dd class="mt-1 font-medium text-slate-800">
                                        {{ $pendaftaran->program_studi }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-slate-500">Judul / Fokus Magang</dt>
                                    <dd class="mt-1 font-medium text-slate-800">
                                        {{ $pendaftaran->judul_magang ?? '-' }}
                                    </dd>
                                </div>
                            </dl>

                            @if ($pendaftaran->catatan_admin)
                            <div class="mt-5">
                                <h4 class="text-xs font-semibold text-slate-600 mb-1">
                                    Catatan dari admin
                                </h4>
                                <div class="text-sm text-slate-700 bg-slate-50 border border-slate-100 rounded-lg px-4 py-3">
                                    {{ $pendaftaran->catatan_admin }}
                                </div>
                            </div>
                            @endif

                            <div class="mt-5 flex justify-end">
                                <a href="{{ route('pendaftaran.index') }}"
                                    class="text-xs font-semibold text-sky-700 hover:text-sky-900">
                                    Lihat detail pendaftaran &raquo;
                                </a>
                            </div>
                            @else
                            <p class="text-sm text-slate-600">
                                Anda belum mengirim pendaftaran magang.
                                Mulailah dengan melengkapi data diri dan mengunggah dokumen yang dibutuhkan.
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('pendaftaran.index') }}">
                                    <x-primary-button type="button">
                                        Daftar Magang Sekarang
                                    </x-primary-button>
                                </a>
                            </div>

                            @endif
                        </div>
                    </div>
                </div>

                {{-- Kolom kanan: tips & alur --}}
                <div class="space-y-4">
                    <div class="bg-white shadow-sm rounded-xl p-5">
                        <h3 class="text-sm font-semibold text-slate-800">
                            Alur Singkat Pendaftaran
                        </h3>
                        <ol class="mt-3 space-y-2 text-xs text-slate-600">
                            <li><span class="font-semibold text-sky-700">1.</span> Daftar akun peserta dan login ke sistem.</li>
                            <li><span class="font-semibold text-sky-700">2.</span> Isi formulir pendaftaran magang dengan data yang benar.</li>
                            <li><span class="font-semibold text-sky-700">3.</span> Unggah CV dan surat pengantar kampus.</li>
                            <li><span class="font-semibold text-sky-700">4.</span> Tunggu proses verifikasi oleh admin DPPPA.</li>
                            <li><span class="font-semibold text-sky-700">5.</span> Pantau status dan cek email untuk pengumuman.</li>
                        </ol>
                    </div>

                    <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-5">
                        <h3 class="text-sm font-semibold text-emerald-800">
                            Tips agar pengajuan Anda mudah diterima
                        </h3>
                        <ul class="mt-3 space-y-2 text-xs text-emerald-900">
                            <li>• Pastikan CV terisi rapi dan menonjolkan pengalaman relevan.</li>
                            <li>• Gunakan bahasa yang sopan dan jelas pada deskripsi singkat magang.</li>
                            <li>• Periksa kembali kelengkapan dokumen sebelum mengirim.</li>
                            <li>• Gunakan email dan nomor HP yang aktif agar mudah dihubungi.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>