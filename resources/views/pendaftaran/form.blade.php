<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            Pendaftaran Magang
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
            <div class="mb-4 rounded-2xl border border-rose-100 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                {{ session('error') }}
            </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl px-6 py-6 sm:px-10 sm:py-8">
                {{-- Header kecil dalam card --}}
                <div class="border-b border-slate-100 pb-4 mb-6">
                    <p class="text-[11px] font-semibold tracking-[0.25em] text-sky-700 uppercase">
                        Formulir Pendaftaran Magang
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Lengkapi data berikut dengan benar. Informasi ini akan digunakan oleh DPPPA untuk proses seleksi dan administrasi magang.
                    </p>
                </div>

                <form method="POST"
                    action="{{ route('pendaftaran.store') }}"
                    enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    {{-- ========== DATA PRIBADI & KONTAK ========== --}}
                    <div>
                        <h3 class="text-sm font-semibold text-sky-800 mb-3">
                            Data Pribadi & Kontak
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                                <x-text-input id="nama_lengkap"
                                    class="block mt-1 w-full bg-slate-50"
                                    type="text"
                                    value="{{ $user->name }}"
                                    disabled />
                            </div>

                            <div>
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email"
                                    class="block mt-1 w-full bg-slate-50"
                                    type="email"
                                    value="{{ $user->email }}"
                                    disabled />
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="nim" value="NIM / NPM" />
                                <x-text-input id="nim"
                                    class="block mt-1 w-full"
                                    type="text"
                                    name="nim"
                                    :value="old('nim')"
                                    required />
                                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="no_hp" value="No HP" />
                                <x-text-input id="no_hp"
                                    class="block mt-1 w-full"
                                    type="text"
                                    name="no_hp"
                                    :value="old('no_hp', $user->phone)"
                                    required />
                                <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- ========== DATA AKADEMIK ========== --}}
                    <div class="pt-4 border-t border-slate-100">
                        <h3 class="text-sm font-semibold text-sky-800 mb-3">
                            Data Akademik
                        </h3>

                        <div class="mt-1">
                            <x-input-label for="universitas" value="Universitas / Perguruan Tinggi" />
                            <x-text-input id="universitas"
                                class="block mt-1 w-full"
                                type="text"
                                name="universitas"
                                :value="old('universitas')"
                                required />
                            <x-input-error :messages="$errors->get('universitas')" class="mt-2" />
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="program_studi" value="Program Studi" />
                                <x-text-input id="program_studi"
                                    class="block mt-1 w-full"
                                    type="text"
                                    name="program_studi"
                                    :value="old('program_studi')"
                                    required />
                                <x-input-error :messages="$errors->get('program_studi')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="semester" value="Semester" />
                                <x-text-input id="semester"
                                    class="block mt-1 w-full"
                                    type="number"
                                    name="semester"
                                    :value="old('semester')"
                                    min="1" max="14" />
                                <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="alamat" value="Alamat Lengkap" />
                            <textarea id="alamat"
                                name="alamat"
                                rows="3"
                                class="border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-md shadow-sm w-full mt-1">{{ old('alamat') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>
                    </div>

                    {{-- ========== RENCANA MAGANG ========== --}}
                    <div class="pt-4 border-t border-slate-100">
                        <h3 class="text-sm font-semibold text-sky-800 mb-3">
                            Rencana Magang
                        </h3>

                        <div>
                            <x-input-label for="judul_magang" value="Judul / Fokus Magang (opsional)" />
                            <x-text-input id="judul_magang"
                                class="block mt-1 w-full"
                                type="text"
                                name="judul_magang"
                                :value="old('judul_magang')" />
                            <x-input-error :messages="$errors->get('judul_magang')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="deskripsi_singkat" value="Deskripsi Singkat / Motivasi (opsional)" />
                            <textarea id="deskripsi_singkat"
                                name="deskripsi_singkat"
                                rows="4"
                                class="border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-md shadow-sm w-full mt-1">{{ old('deskripsi_singkat') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi_singkat')" class="mt-2" />
                        </div>
                    </div>

                    {{-- ========== DOKUMEN PENDUKUNG ========== --}}
                    <div class="pt-4 border-t border-slate-100">
                        <h3 class="text-sm font-semibold text-sky-800 mb-3">
                            Dokumen Pendukung
                        </h3>

                        {{-- CV --}}
                        <div class="mt-2">
                            <x-input-label for="cv" value="Curriculum Vitae (CV) *" />
                            <input id="cv"
                                name="cv"
                                type="file"
                                required
                                class="block mt-1 w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-md shadow-sm">
                            <p class="text-xs text-slate-500 mt-1">Format: PDF/DOC/DOCX, maks 4MB.</p>
                            <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                        </div>

                        {{-- Surat Pengantar --}}
                        <div class="mt-4">
                            <x-input-label for="surat_pengantar" value="Surat Pengantar Kampus" />
                            <input id="surat_pengantar"
                                name="surat_pengantar"
                                type="file"
                                class="block mt-1 w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-md shadow-sm">
                            <p class="text-xs text-slate-500 mt-1">Format: PDF/DOC/DOCX, maks 4MB.</p>
                            <x-input-error :messages="$errors->get('surat_pengantar')" class="mt-2" />
                        </div>

                        {{-- KTM --}}
                        <div class="mt-4">
                            <x-input-label for="ktm" value="Kartu Tanda Mahasiswa (KTM)" />
                            <input id="ktm"
                                name="ktm"
                                type="file"
                                class="block mt-1 w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-md shadow-sm">
                            <p class="text-xs text-slate-500 mt-1">
                                Format: JPG/PNG/PDF, maks 4MB.
                            </p>
                            <x-input-error :messages="$errors->get('ktm')" class="mt-2" />
                        </div>

                        {{-- KTP --}}
                        <div class="mt-4">
                            <x-input-label for="ktp" value="Kartu Tanda Penduduk (KTP)" />
                            <input id="ktp"
                                name="ktp"
                                type="file"
                                class="block mt-1 w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-md shadow-sm">
                            <p class="text-xs text-slate-500 mt-1">
                                Format: JPG/PNG/PDF, maks 4MB.
                            </p>
                            <x-input-error :messages="$errors->get('ktp')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Tombol submit --}}
                    <div class="pt-4 border-t border-slate-100 flex justify-end">
                        <x-primary-button>
                            Kirim Pendaftaran
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>