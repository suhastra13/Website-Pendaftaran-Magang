<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    Daftar Pendaftar Magang
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Kelola dan pantau seluruh pengajuan magang yang masuk ke sistem.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <div class="mb-4 flex items-center justify-between">
                {{-- kiri: filter status + search yang kemarin --}}
                <div class="flex items-center gap-4">
                    {{-- ... form filter & search ... --}}
                </div>

                {{-- kanan: tombol export --}}
                <a href="{{ route('admin.pendaftar.export') }}"
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-emerald-600 text-white hover:bg-emerald-700">
                    Export CSV
                </a>
            </div>


            {{-- Filter & Pencarian --}}
            <div class="bg-white shadow-sm rounded-2xl border border-sky-50 px-4 py-3 sm:px-6 sm:py-4">
                <form method="GET"
                    action="{{ route('admin.pendaftar.index') }}"
                    class="grid grid-cols-1 md:grid-cols-12 md:items-end gap-3 md:gap-4">

                    {{-- Filter status --}}
                    <div class="md:col-span-3">
                        <label class="block text-xs font-semibold text-slate-600 mb-1">
                            Status
                        </label>
                        <select name="status"
                            class="w-full border-slate-300 text-sm rounded-md shadow-sm focus:border-sky-500 focus:ring-sky-500">
                            <option value="">Semua</option>
                            <option value="pending" @selected(($status ?? '' )==='pending' )>Pending</option>
                            <option value="diterima" @selected(($status ?? '' )==='diterima' )>Diterima</option>
                            <option value="ditolak" @selected(($status ?? '' )==='ditolak' )>Ditolak</option>
                        </select>
                    </div>

                    {{-- Pencarian --}}
                    <div class="md:col-span-7">
                        <label class="block text-xs font-semibold text-slate-600 mb-1">
                            Cari pendaftar
                            <span class="text-[10px] text-slate-400">(nama, email, universitas, prodi)</span>
                        </label>
                        <div class="relative">
                            <input id="search-input"
                                name="q"
                                type="text"
                                value="{{ $search ?? '' }}"
                                placeholder="Ketik minimal satu huruf untuk menyaring daftar di bawah..."
                                class="w-full border-slate-300 text-sm rounded-md shadow-sm pr-9
                              focus:border-sky-500 focus:ring-sky-500">
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="md:col-span-2 flex gap-2 md:justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 rounded-md text-xs font-semibold
                           bg-sky-600 text-white hover:bg-sky-700 shadow-sm">
                            Terapkan
                        </button>

                        <a href="{{ route('admin.pendaftar.index') }}"
                            class="inline-flex items-center px-3 py-2 rounded-md text-xs font-semibold
                      border border-slate-200 text-slate-600 hover:bg-slate-50">
                            Reset
                        </a>
                    </div>
                </form>

                {{-- teks penjelasan di bawah, bukan di dalam kolom search --}}
                <p class="mt-2 text-[11px] text-slate-400">
                    Saat mengetik, daftar di bawah akan tersaring otomatis di halaman ini.
                    Klik <span class="font-semibold">Terapkan</span> untuk menyimpan filter ke URL &amp; pagination.
                </p>
            </div>


            {{-- Tabel --}}
            <div class="bg-white shadow-sm rounded-2xl border border-sky-50 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Universitas
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Prodi
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Tanggal Daftar
                            </th>
                            <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody id="pendaftar-tbody" class="divide-y divide-slate-100">
                        @forelse ($pendaftar as $p)
                        @php
                        $badgeColor = match ($p->status) {
                        'diterima' => 'bg-emerald-100 text-emerald-800',
                        'ditolak' => 'bg-rose-100 text-rose-800',
                        default => 'bg-amber-100 text-amber-800',
                        };
                        @endphp
                        <tr data-row="pendaftar" class="hover:bg-slate-50/80">
                            <td class="px-5 py-3">
                                <div class="font-medium text-slate-800">{{ $p->nama_lengkap }}</div>
                                <div class="text-xs text-slate-500">{{ $p->email }}</div>
                            </td>
                            <td class="px-5 py-3 text-slate-700">
                                {{ $p->universitas }}
                            </td>
                            <td class="px-5 py-3 text-slate-700">
                                {{ $p->program_studi }}
                            </td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-slate-700">
                                {{ $p->created_at->format('d-m-Y') }}
                            </td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('admin.pendaftar.show', $p->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                              bg-indigo-600 text-white hover:bg-indigo-700">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-6 text-center text-sm text-slate-500">
                                Belum ada pendaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $pendaftar->withQueryString()->links() }}
            </div>
        </div>
    </div>

    {{-- LIVE SEARCH (client-side) --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search-input');
            const tbody = document.getElementById('pendaftar-tbody');

            if (!searchInput || !tbody) return;

            searchInput.addEventListener('input', () => {
                const term = searchInput.value.toLowerCase();

                tbody.querySelectorAll('tr[data-row="pendaftar"]').forEach((row) => {
                    const text = row.textContent.toLowerCase();
                    // jika term kosong → semua muncul;
                    // jika ada term → hanya baris yang mengandung term yang tampil
                    if (!term || text.includes(term)) {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</x-app-layout>