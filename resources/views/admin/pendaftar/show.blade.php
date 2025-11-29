@php
use Illuminate\Support\Facades\Storage;

$status = $pendaftaran->status;
$badgeColor = match ($status) {
'diterima' => 'bg-emerald-100 text-emerald-800',
'ditolak' => 'bg-rose-100 text-rose-800',
default => 'bg-amber-100 text-amber-800',
};

$cv = $pendaftaran->dokumen->firstWhere('jenis', 'cv');
$surat = $pendaftaran->dokumen->firstWhere('jenis', 'surat_pengantar');
$ktm = $pendaftaran->dokumen->firstWhere('jenis', 'ktm');
$ktp = $pendaftaran->dokumen->firstWhere('jenis', 'ktp');
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    Detail Pendaftar Magang
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Lihat dan kelola informasi lengkap pengajuan magang peserta.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
            <div class="mb-2 rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
            @endif

            {{-- CARD UTAMA --}}
            <div class="rounded-3xl shadow-xl overflow-hidden bg-gradient-to-br from-sky-500 via-sky-500 to-teal-400">
                <div class="h-2 bg-gradient-to-r from-sky-400 via-sky-300 to-teal-300"></div>

                <div class="bg-white rounded-t-3xl px-6 py-6 sm:px-10 sm:py-8 mt-4 mx-3 mb-3 space-y-7">
                    {{-- Header dalam card --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-slate-100">
                        <div>
                            <p class="text-[11px] font-semibold text-sky-700 tracking-[0.25em] uppercase">
                                Data Pendaftar
                            </p>
                            <h3 class="mt-1 text-lg font-semibold text-slate-800">
                                {{ $pendaftaran->nama_lengkap }}
                            </h3>
                            <p class="text-xs text-slate-500 mt-1">
                                {{ $pendaftaran->email }} &bull;
                                {{ $pendaftaran->universitas }} – {{ $pendaftaran->program_studi }}
                            </p>
                            <p class="text-[11px] text-slate-400 mt-1">
                                Didaftarkan pada
                                <span class="font-medium text-slate-600">
                                    {{ $pendaftaran->created_at->format('d M Y H:i') }}
                                </span>
                            </p>
                        </div>

                        <div class="text-right space-y-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                Status: {{ ucfirst($status) }}
                            </span>
                            <p class="text-[11px] text-slate-400">
                                Terakhir diperbarui:
                                <span class="font-medium text-slate-600">
                                    {{ $pendaftaran->updated_at->format('d M Y H:i') }}
                                </span>
                            </p>
                        </div>
                    </div>

                    {{-- GRID: Data & Status --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        {{-- Data utama --}}
                        <div class="lg:col-span-2 space-y-4">
                            <h4 class="text-sm font-semibold text-sky-800">
                                Informasi Pendaftar
                            </h4>

                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <dt class="text-[11px] text-slate-500">Nama</dt>
                                    <dd class="font-medium text-slate-800">{{ $pendaftaran->nama_lengkap }}</dd>
                                </div>
                                <div>
                                    <dt class="text-[11px] text-slate-500">Email</dt>
                                    <dd class="font-medium text-slate-800">{{ $pendaftaran->email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-gray-500">NIM</dt>
                                    <dd class="font-medium">{{ $pendaftaran->nim ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-[11px] text-slate-500">No HP</dt>
                                    <dd class="font-medium text-slate-800">{{ $pendaftaran->no_hp }}</dd>
                                </div>
                                <div>
                                    <dt class="text-[11px] text-slate-500">Semester</dt>
                                    <dd class="font-medium text-slate-800">{{ $pendaftaran->semester ?? '-' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-[11px] text-slate-500">Universitas</dt>
                                    <dd class="font-medium text-slate-800">{{ $pendaftaran->universitas }}</dd>
                                </div>
                                <div>
                                    <dt class="text-[11px] text-slate-500">Program Studi</dt>
                                    <dd class="font-medium text-slate-800">{{ $pendaftaran->program_studi }}</dd>
                                </div>

                                <div class="md:col-span-2">
                                    <dt class="text-[11px] text-slate-500">Alamat</dt>
                                    <dd class="font-medium text-slate-800 leading-relaxed">
                                        {{ $pendaftaran->alamat ?? '-' }}
                                    </dd>
                                </div>

                                <div class="md:col-span-2">
                                    <dt class="text-[11px] text-slate-500">Judul / Fokus Magang</dt>
                                    <dd class="font-medium text-slate-800">
                                        {{ $pendaftaran->judul_magang ?? '-' }}
                                    </dd>
                                </div>

                                <div class="md:col-span-2">
                                    <dt class="text-[11px] text-slate-500">Deskripsi Singkat</dt>
                                    <dd class="font-medium text-slate-800 whitespace-pre-line leading-relaxed">
                                        {{ $pendaftaran->deskripsi_singkat ?? '-' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        {{-- Status & catatan (form) --}}
                        <div class="lg:col-span-1">
                            <h4 class="text-sm font-semibold text-sky-800 mb-2">
                                Status &amp; Catatan Admin
                            </h4>

                            <div class="rounded-2xl border border-sky-100 bg-sky-50/60 px-4 py-4">
                                <form method="POST"
                                    action="{{ route('admin.pendaftar.updateStatus', $pendaftaran->id) }}"
                                    class="space-y-3">
                                    @csrf

                                    <div>
                                        <label for="status" class="block text-xs font-semibold text-slate-600 mb-1">
                                            Status pengajuan
                                        </label>
                                        <select id="status" name="status"
                                            class="w-full border-slate-300 rounded-md shadow-sm text-sm
                                                       focus:border-sky-500 focus:ring-sky-500">
                                            <option value="pending" @selected($pendaftaran->status === 'pending')>Pending</option>
                                            <option value="diterima" @selected($pendaftaran->status === 'diterima')>Diterima</option>
                                            <option value="ditolak" @selected($pendaftaran->status === 'ditolak')>Ditolak</option>
                                        </select>
                                        @error('status')
                                        <div class="text-xs text-rose-600 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="catatan_admin"
                                            class="block text-xs font-semibold text-slate-600 mb-1">
                                            Catatan untuk peserta <span class="text-[10px] text-slate-400">(opsional)</span>
                                        </label>
                                        <textarea id="catatan_admin"
                                            name="catatan_admin"
                                            rows="4"
                                            class="border-slate-300 rounded-md shadow-sm w-full text-sm
                                                         focus:border-sky-500 focus:ring-sky-500">{{ old('catatan_admin', $pendaftaran->catatan_admin) }}</textarea>
                                        @error('catatan_admin')
                                        <div class="text-xs text-rose-600 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                        <div>
                                            <label for="tanggal_mulai" class="block text-sm text-gray-600 mb-1">
                                                Tanggal Mulai Magang
                                            </label>
                                            <input id="tanggal_mulai" name="tanggal_mulai" type="date"
                                                value="{{ old('tanggal_mulai', $pendaftaran->tanggal_mulai) }}"
                                                class="border-gray-300 rounded-md shadow-sm w-full text-sm focus:border-sky-500 focus:ring-sky-500">
                                        </div>
                                        <div>
                                            <label for="tanggal_selesai" class="block text-sm text-gray-600 mb-1">
                                                Tanggal Selesai Magang
                                            </label>
                                            <input id="tanggal_selesai" name="tanggal_selesai" type="date"
                                                value="{{ old('tanggal_selesai', $pendaftaran->tanggal_selesai) }}"
                                                class="border-gray-300 rounded-md shadow-sm w-full text-sm focus:border-sky-500 focus:ring-sky-500">
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-1" />
                                    <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-1" />


                                    <div class="flex justify-end pt-1">
                                        <x-primary-button>
                                            Simpan Status
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Dokumen Pendukung --}}
                    <div class="pt-4 border-t border-slate-100">
                        <h3 class="text-lg font-semibold mb-3 text-sky-800">
                            Dokumen Pendukung
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            {{-- CV --}}
                            <div class="rounded-3xl border border-sky-50 bg-sky-50/70 px-5 py-4 flex items-start gap-3">
                                <div class="mt-1 h-8 w-8 rounded-full bg-sky-100 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 11h14v7a2 2 0 01-2 2H7a2 2 0 01-2-2v-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-[0.18em]">CV</p>
                                    @if ($cv)
                                    <a href="{{ Storage::url($cv->path) }}" target="_blank"
                                        class="block text-sky-700 hover:text-sky-900 font-medium break-all">
                                        {{ $cv->original_name ?? basename($cv->path) }}
                                    </a>
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        {{ $cv->mime_type ?? 'berkas' }} &bull;
                                        {{ number_format(($cv->size ?? 0)/1024, 1) }} KB
                                    </p>
                                    @else
                                    <p class="mt-1 text-sm text-rose-600">Tidak ada CV.</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Surat Pengantar --}}
                            <div class="rounded-3xl border border-sky-50 bg-sky-50/70 px-5 py-4 flex items-start gap-3">
                                <div class="mt-1 h-8 w-8 rounded-full bg-sky-100 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 11h14v7a2 2 0 01-2 2H7a2 2 0 01-2-2v-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-[0.18em]">
                                        Surat Pengantar Kampus
                                    </p>
                                    @if ($surat)
                                    <a href="{{ Storage::url($surat->path) }}" target="_blank"
                                        class="block text-sky-700 hover:text-sky-900 font-medium break-all">
                                        {{ $surat->original_name ?? basename($surat->path) }}
                                    </a>
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        {{ $surat->mime_type ?? 'berkas' }} &bull;
                                        {{ number_format(($surat->size ?? 0)/1024, 1) }} KB
                                    </p>
                                    @else
                                    <p class="mt-1 text-sm text-slate-400">Tidak ada surat pengantar.</p>
                                    @endif
                                </div>
                            </div>

                            {{-- KTM --}}
                            <div class="rounded-3xl border border-sky-50 bg-sky-50/70 px-5 py-4 flex items-start gap-3">
                                <div class="mt-1 h-8 w-8 rounded-full bg-sky-100 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14c-4.418 0-8 1.79-8 4v1h16v-1c0-2.21-3.582-4-8-4z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-[0.18em]">
                                        KTM
                                    </p>
                                    @if ($ktm)
                                    <a href="{{ Storage::url($ktm->path) }}" target="_blank"
                                        class="block text-sky-700 hover:text-sky-900 font-medium break-all">
                                        {{ $ktm->original_name ?? basename($ktm->path) }}
                                    </a>
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        {{ $ktm->mime_type ?? 'berkas' }} &bull;
                                        {{ number_format(($ktm->size ?? 0)/1024, 1) }} KB
                                    </p>
                                    @else
                                    <p class="mt-1 text-sm text-slate-400">Tidak ada KTM.</p>
                                    @endif
                                </div>
                            </div>

                            {{-- KTP --}}
                            <div class="rounded-3xl border border-sky-50 bg-sky-50/70 px-5 py-4 flex items-start gap-3">
                                <div class="mt-1 h-8 w-8 rounded-full bg-sky-100 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 7h16v10H4z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 10h4M7 13h2" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-[0.18em]">
                                        KTP
                                    </p>
                                    @if ($ktp)
                                    <a href="{{ Storage::url($ktp->path) }}" target="_blank"
                                        class="block text-sky-700 hover:text-sky-900 font-medium break-all">
                                        {{ $ktp->original_name ?? basename($ktp->path) }}
                                    </a>
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        {{ $ktp->mime_type ?? 'berkas' }} &bull;
                                        {{ number_format(($ktp->size ?? 0)/1024, 1) }} KB
                                    </p>
                                    @else
                                    <p class="mt-1 text-sm text-slate-400">Tidak ada KTP.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</x-app-layout>