<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PendaftaranMagang;
use App\Models\DokumenPendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\KonfirmasiPendaftaranMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;



class PendaftaranController extends Controller
{
    // Tampilkan form atau status
    public function index()
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaranMagang; // relasi dari model User

        if ($pendaftaran) {
            // sudah pernah daftar → tampilkan status
            $pendaftaran->load('dokumen'); // load dokumen juga
            return view('pendaftaran.status', compact('pendaftaran'));
        }

        // belum pernah daftar → tampilkan form
        return view('pendaftaran.form', compact('user'));
    }

    // Simpan pendaftaran
    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        // Cegah pendaftaran ganda
        if ($user->pendaftaranMagang) {
            return redirect()
                ->route('pendaftaran.index')
                ->with('error', 'Anda sudah pernah mengirim pendaftaran magang.');
        }

        $validated = $request->validate([
            'no_hp'             => ['required', 'string', 'max:30'],
            'nim'               => ['required', 'string', 'max:15'],
            'universitas'       => ['required', 'string', 'max:255'],
            'program_studi'     => ['required', 'string', 'max:255'],
            'semester'          => ['nullable', 'integer', 'min:1', 'max:14'],
            'alamat'            => ['nullable', 'string'],
            'judul_magang'      => ['nullable', 'string', 'max:255'],
            'deskripsi_singkat' => ['nullable', 'string'],

            'cv'                => ['required', 'file', 'mimes:pdf,doc,docx', 'max:4096'],
            'surat_pengantar'   => ['required', 'file', 'mimes:pdf,doc,docx', 'max:4096'],
            'ktm'               => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],

            'ktp'               => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
        ]);

        // Update no_hp user (opsional)
        if (!$user->phone || $user->phone !== $validated['no_hp']) {
            $user->phone = $validated['no_hp'];
            $user->save();   // ← sekarang Intelephense tahu ini model User
        }

        // dst... (bagian PendaftaranMagang::create dsb tetap seperti tadi)


        // Buat record pendaftaran
        $pendaftaran = PendaftaranMagang::create([
            'user_id'           => $user->id,
            'nama_lengkap'      => $user->name,
            'email'             => $user->email,
            'nim'               => $validated['nim'],
            'no_hp'             => $validated['no_hp'],
            'universitas'       => $validated['universitas'],
            'program_studi'     => $validated['program_studi'],
            'semester'          => $validated['semester'] ?? null,
            'alamat'            => $validated['alamat'] ?? null,
            'judul_magang'      => $validated['judul_magang'] ?? null,
            'deskripsi_singkat' => $validated['deskripsi_singkat'] ?? null,
            'status'            => 'pending',
        ]);


        // Simpan file CV
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $path = $file->store('dokumen/cv', 'public');

            DokumenPendaftar::create([
                'pendaftaran_id' => $pendaftaran->id,
                'jenis'          => 'cv',
                'path'           => $path,
                'original_name'  => $file->getClientOriginalName(),
                'mime_type'      => $file->getClientMimeType(),
                'size'           => $file->getSize(),
            ]);
        }

        // Simpan file Surat Pengantar (opsional)
        if ($request->hasFile('surat_pengantar')) {
            $file = $request->file('surat_pengantar');
            $path = $file->store('dokumen/surat_pengantar', 'public');

            DokumenPendaftar::create([
                'pendaftaran_id' => $pendaftaran->id,
                'jenis'          => 'surat_pengantar',
                'path'           => $path,
                'original_name'  => $file->getClientOriginalName(),
                'mime_type'      => $file->getClientMimeType(),
                'size'           => $file->getSize(),
            ]);
        }

        // Simpan file KTM
        if ($request->hasFile('ktm')) {
            $file = $request->file('ktm');
            $path = $file->store('dokumen/ktm', 'public');

            DokumenPendaftar::create([
                'pendaftaran_id' => $pendaftaran->id,
                'jenis'          => 'ktm',
                'path'           => $path,
                'original_name'  => $file->getClientOriginalName(),
                'mime_type'      => $file->getClientMimeType(),
                'size'           => $file->getSize(),
            ]);
        }

        // Simpan file KTP
        if ($request->hasFile('ktp')) {
            $file = $request->file('ktp');
            $path = $file->store('dokumen/ktp', 'public');

            DokumenPendaftar::create([
                'pendaftaran_id' => $pendaftaran->id,
                'jenis'          => 'ktp',
                'path'           => $path,
                'original_name'  => $file->getClientOriginalName(),
                'mime_type'      => $file->getClientMimeType(),
                'size'           => $file->getSize(),
            ]);
        }


        // Kirim email konfirmasi ke pendaftar
        try {
            Mail::to($pendaftaran->email)
                ->send(new KonfirmasiPendaftaranMail($pendaftaran));
        } catch (\Throwable $e) {
            // Untuk dev: boleh log, tapi jangan gagalkan pendaftaran cuma karena email gagal
            // logger($e->getMessage());
        }


        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Pendaftaran magang berhasil dikirim. Status Anda saat ini: pending.');
    }

    public function suratPenerimaan(PendaftaranMagang $pendaftaran)
    {
        $user = Auth::user();

        // Hanya pemilik yang boleh download
        if ($pendaftaran->user_id !== $user->id) {
            abort(403, 'Anda tidak berhak mengakses surat ini.');
        }

        // Hanya jika sudah diterima
        if ($pendaftaran->status !== 'diterima') {
            abort(403, 'Surat penerimaan hanya tersedia untuk pendaftar yang sudah diterima.');
        }

        $pdf = Pdf::loadView('pendaftaran.surat_penerimaan_pdf', [
            'pendaftaran' => $pendaftaran,
        ])->setPaper('A4', 'portrait');

        $filename = 'Surat-Penerimaan-Magang-' . str_replace(' ', '-', $pendaftaran->nama_lengkap) . '.pdf';

        return $pdf->download($filename);
    }
}
