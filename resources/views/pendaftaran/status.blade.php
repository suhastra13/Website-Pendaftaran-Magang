@php
use Illuminate\Support\Facades\Storage;

$status = $pendaftaran->status;

$badgeColor = match ($status) {
'diterima' => 'bg-emerald-100 text-emerald-800',
'ditolak' => 'bg-rose-100 text-rose-800',
default => 'bg-amber-100 text-amber-800',
};

$statusLabel = ucfirst($status);

// ambil dokumen dari relasi
$cv = $pendaftaran->dokumen->firstWhere('jenis', 'cv');
$surat = $pendaftaran->dokumen->firstWhere('jenis', 'surat_pengantar');
$ktm = $pendaftaran->dokumen->firstWhere('jenis', 'ktm');
$ktp = $pendaftaran->dokumen->firstWhere('jenis', 'ktp');

$hasCv = (bool) $cv;
$hasSurat = (bool) $surat;
$hasKtm = (bool) $ktm;
$hasKtp = (bool) $ktp;
@endphp

<x-app-layout>
    {{-- HEADER ATAS: teks gelap, tanpa badge --}}
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                Status Pendaftaran Magang
            </h2>
            <p class="text-xs text-slate-500 mt-1">
                Ringkasan pengajuan magang Anda di DPPPA Provinsi Sumatera Selatan.
            </p>
        </div>
        <a href="{{ route('dashboard') }}"
        class="inline-flex items-center text-[11px] font-semibold text-sky-700 hover:text-sky-900 mt-3">
        &larr; Kembali ke Dashboard
    </a>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            {{-- CARD UTAMA BERTEMA --}}
            <div class="rounded-3xl shadow-xl overflow-hidden bg-gradient-to-br from-sky-500 via-sky-500 to-teal-400">
                <div class="h-2 bg-gradient-to-r from-sky-400 via-sky-300 to-teal-300"></div>

                <div class="bg-white rounded-t-3xl px-6 py-6 sm:px-10 sm:py-8 mt-4 mx-3 mb-3">
                    {{-- Header di dalam card: status + info singkat --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-slate-100">

                        
                        
                        <div>
                            <p class="text-[11px] font-semibold text-sky-700 tracking-[0.25em] uppercase">
                                Status Pengajuan
                            </p>
                            <h3 class="mt-1 text-lg font-semibold text-slate-800">
                                {{ $pendaftaran->nama_lengkap }}
                            </h3>
                            <p class="text-xs text-slate-500 mt-1">
                                Terdaftar sebagai mahasiswa {{ $pendaftaran->universitas }}
                                – {{ $pendaftaran->program_studi }}
                            </p>
                            
                    </div>
                    @if ($pendaftaran->status === 'diterima' && $pendaftaran->tanggal_mulai && $pendaftaran->tanggal_selesai)
                    <div class="mb-4 flex items-center justify-between">
                        <div class="text-sm text-slate-600">
                            Anda telah <span class="font-semibold text-emerald-600">DITERIMA</span> sebagai peserta magang.
                            Silakan unduh surat penerimaan berikut, cetak, dan bawa saat datang ke kantor.
                        </div>
                        <a href="{{ route('pendaftaran.surat', $pendaftaran->id) }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-sky-600 text-white hover:bg-sky-700">
                            Unduh Surat Penerimaan (PDF)
                        </a>
                    </div>
                    @endif

                        <div class="text-right space-y-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                Status: {{ $statusLabel }}
                            </span>
                            <p class="text-[11px] text-slate-500">
                                Terakhir diperbarui:
                                <span class="font-medium text-slate-700">
                                    {{ $pendaftaran->updated_at->format('d M Y H:i') }}
                                </span>
                            </p>
                        </div>
                    </div>

                    {{-- DATA UTAMA --}}
                    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-8 text-sm text-slate-800">
                        {{-- Kolom kiri: data pendaftar --}}
                        <div class="space-y-4">
                            <h4 class="text-sm font-semibold text-sky-800">
                                Data Pendaftar
                            </h4>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[11px] text-slate-500">Nama</p>
                                    <p class="font-medium">{{ $pendaftaran->nama_lengkap }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-500">No HP</p>
                                    <p class="font-medium">{{ $pendaftaran->no_hp }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[11px] text-slate-500">Email</p>
                                    <p class="font-medium">{{ $pendaftaran->email }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">NIM</p>
                                    <p class="font-medium">{{ $pendaftaran->nim ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-500">Semester</p>
                                    <p class="font-medium">{{ $pendaftaran->semester }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[11px] text-slate-500">Universitas</p>
                                    <p class="font-medium">{{ $pendaftaran->universitas }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-500">Program Studi</p>
                                    <p class="font-medium">{{ $pendaftaran->program_studi }}</p>
                                </div>
                            </div>

                            <div>
                                <p class="text-[11px] text-slate-500">Alamat</p>
                                <p class="font-medium leading-relaxed">
                                    {{ $pendaftaran->alamat }}
                                </p>
                            </div>
                        </div>

                        {{-- Kolom kanan: informasi magang --}}
                        <div class="space-y-4">
                            <h4 class="text-sm font-semibold text-sky-800">
                                Informasi Magang
                            </h4>

                            <div>
                                <p class="text-[11px] text-slate-500">Judul / Fokus Magang</p>
                                <p class="font-medium">
                                    {{ $pendaftaran->judul_magang ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-[11px] text-slate-500">Deskripsi Singkat</p>
                                <p class="font-medium leading-relaxed">
                                    {{ $pendaftaran->deskripsi_singkat ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-[11px] text-slate-500 mb-1">Catatan dari admin</p>
                                @if ($pendaftaran->catatan_admin)
                                <div class="text-sm text-slate-700 bg-sky-50/70 border border-sky-100 rounded-2xl px-4 py-3">
                                    {{ $pendaftaran->catatan_admin }}
                                </div>
                                @else
                                <p class="text-xs text-slate-500">
                                    Belum ada catatan khusus dari admin. Silakan pantau status Anda secara berkala.
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- DOKUMEN PENDUKUNG --}}
                    <div class="mt-8 pt-5 border-t border-slate-100">
                        <h4 class="text-sm font-semibold text-sky-800 mb-3">
                            Dokumen Pendukung
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            {{-- CV --}}
                            <div class="rounded-3xl border border-sky-50 bg-sky-50/60 px-5 py-4 flex items-start gap-3">
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
                                        CV
                                    </p>
                                    @if ($hasCv)
                                    <a href="{{ Storage::url($cv->path) }}" target="_blank"
                                        class="block text-sky-700 hover:text-sky-900 font-medium break-all">
                                        {{ $cv->original_name ?? basename($cv->path) }}
                                    </a>
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        Tipe: {{ $cv->mime_type ?? 'berkas' }}
                                        &bull;
                                        Ukuran: {{ number_format(($cv->size ?? 0) / 1024, 1) }} KB
                                    </p>
                                    @else
                                    <p class="mt-1 text-sm text-rose-600">
                                        Wajib, belum diunggah.
                                    </p>
                                    @endif
                                </div>
                            </div>

                            {{-- Surat Pengantar --}}
                            <div class="rounded-3xl border border-sky-50 bg-sky-50/60 px-5 py-4 flex items-start gap-3">
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
                                    @if ($hasSurat)
                                    <a href="{{ Storage::url($surat->path) }}" target="_blank"
                                        class="block text-sky-700 hover:text-sky-900 font-medium break-all">
                                        {{ $surat->original_name ?? basename($surat->path) }}
                                    </a>
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        Tipe: {{ $surat->mime_type ?? 'berkas' }}
                                        &bull;
                                        Ukuran: {{ number_format(($surat->size ?? 0) / 1024, 1) }} KB
                                    </p>
                                    @else
                                    <p class="mt-1 text-sm text-rose-600">
                                        Wajib, belum diunggah.
                                    </p>
                                    @endif
                                </div>
                            </div>

                            {{-- KTM --}}
                            <div class="rounded-3xl border border-sky-50 bg-sky-50/60 px-5 py-4 flex items-start gap-3">
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
                                        Kartu Tanda Mahasiswa (KTM)
                                    </p>
                                    @if ($hasKtm)
                                    <a href="{{ Storage::url($ktm->path) }}" target="_blank"
                                        class="block text-sky-700 hover:text-sky-900 font-medium break-all">
                                        {{ $ktm->original_name ?? basename($ktm->path) }}
                                    </a>
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        Tipe: {{ $ktm->mime_type ?? 'berkas' }}
                                        &bull;
                                        Ukuran: {{ number_format(($ktm->size ?? 0) / 1024, 1) }} KB
                                    </p>
                                    @else
                                    <p class="mt-1 text-sm text-slate-400">
                                        Opsional, belum diunggah.
                                    </p>
                                    @endif
                                </div>
                            </div>

                            {{-- KTP --}}
                            <div class="rounded-3xl border border-sky-50 bg-sky-50/60 px-5 py-4 flex items-start gap-3">
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
                                        Kartu Tanda Penduduk (KTP)
                                    </p>
                                    @if ($hasKtp)
                                    <a href="{{ Storage::url($ktp->path) }}" target="_blank"
                                        class="block text-sky-700 hover:text-sky-900 font-medium break-all">
                                        {{ $ktp->original_name ?? basename($ktp->path) }}
                                    </a>
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        Tipe: {{ $ktp->mime_type ?? 'berkas' }}
                                        &bull;
                                        Ukuran: {{ number_format(($ktp->size ?? 0) / 1024, 1) }} KB
                                    </p>
                                    @else
                                    <p class="mt-1 text-sm text-slate-400">
                                        Opsional, belum diunggah.
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <p class="mt-4 text-[11px] text-slate-500">
                            Pastikan dokumen dapat dibuka dengan jelas. Jika terjadi kesalahan pengunggahan, silakan hubungi admin magang atau kirim ulang pendaftaran sesuai kebijakan DPPPA.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>