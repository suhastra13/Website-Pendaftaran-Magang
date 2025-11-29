<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    Dashboard Admin
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Ringkasan data pendaftar magang dan status pengajuan di DPPPA Provinsi Sumatera Selatan.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- KARTU RINGKASAN --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Total --}}
                <div class="bg-white shadow-sm rounded-2xl px-5 py-4 border border-sky-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500">
                                Total Pendaftar
                            </p>
                            <p class="mt-2 text-2xl font-semibold text-slate-800">
                                {{ $total }}
                            </p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-sky-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6v-2a4 4 0 014-4h0a4 4 0 00-4-4H9a4 4 0 00-4 4h0a4 4 0 014 4v2m4-10a4 4 0 10-8 0 4 4 0 008 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-3 text-[11px] text-slate-500">
                        Total seluruh pengajuan yang masuk ke sistem.
                    </p>
                </div>

                {{-- Pending --}}
                <div class="bg-white shadow-sm rounded-2xl px-5 py-4 border border-amber-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500">
                                Pending
                            </p>
                            <p class="mt-2 text-2xl font-semibold text-slate-800">
                                {{ $pending }}
                            </p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-amber-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l2 2m6-2a8 8 0 11-16 0 8 8 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-3 text-[11px] text-slate-500">
                        Pengajuan yang belum ditindaklanjuti oleh admin.
                    </p>
                </div>

                {{-- Diterima --}}
                <div class="bg-white shadow-sm rounded-2xl px-5 py-4 border border-emerald-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500">
                                Diterima
                            </p>
                            <p class="mt-2 text-2xl font-semibold text-slate-800">
                                {{ $diterima }}
                            </p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-3 text-[11px] text-slate-500">
                        Pengajuan yang sudah dinyatakan lolos seleksi magang.
                    </p>
                </div>

                {{-- Ditolak --}}
                <div class="bg-white shadow-sm rounded-2xl px-5 py-4 border border-rose-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500">
                                Ditolak
                            </p>
                            <p class="mt-2 text-2xl font-semibold text-slate-800">
                                {{ $ditolak }}
                            </p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-rose-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-3 text-[11px] text-slate-500">
                        Pengajuan yang tidak memenuhi kriteria atau kuota.
                    </p>
                </div>
            </div>

            {{-- PENDAFTAR TERBARU --}}
            <div class="bg-white shadow-sm rounded-2xl border border-sky-50 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-800">
                            Pendaftar Terbaru
                        </h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Daftar pengajuan terakhir yang masuk ke sistem.
                        </p>
                    </div>
                    <a href="{{ route('admin.pendaftar.index') }}"
                        class="text-xs font-semibold text-sky-700 hover:text-sky-900">
                        Lihat semua &raquo;
                    </a>
                </div>

                @if ($terbaru->isEmpty())
                <p class="px-6 py-6 text-sm text-slate-500">
                    Belum ada data pendaftar.
                </p>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Universitas
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Tanggal Daftar
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @foreach ($terbaru as $p)
                            @php
                            $badgeColor = match ($p->status) {
                            'diterima' => 'bg-emerald-100 text-emerald-800',
                            'ditolak' => 'bg-rose-100 text-rose-800',
                            default => 'bg-amber-100 text-amber-800',
                            };
                            @endphp
                            <tr class="hover:bg-slate-50/70">
                                <td class="px-6 py-3">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-slate-800">{{ $p->nama_lengkap }}</span>
                                        <span class="text-xs text-slate-500">{{ $p->email }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-slate-700">
                                    {{ $p->universitas }}
                                </td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-slate-700 text-sm">
                                    {{ $p->created_at->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <a href="{{ route('admin.pendaftar.show', $p->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                                      bg-indigo-600 text-white hover:bg-indigo-700">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>