<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranMagang;
use Illuminate\Http\Request;
use App\Mail\StatusPendaftaranMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Validation\Rule;




class PendaftaranController extends Controller
{
    // List semua pendaftar (dengan filter status)
    public function index(Request $request)
    {
        $status = $request->get('status');   // pending / diterima / ditolak / null
        $search = $request->get('q');        // kata kunci pencarian

        $query = PendaftaranMagang::query()->latest();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('universitas', 'like', "%{$search}%")
                    ->orWhere('program_studi', 'like', "%{$search}%");
            });
        }

        $pendaftar = $query->paginate(10)->withQueryString();

        return view('admin.pendaftar.index', [
            'pendaftar' => $pendaftar,
            'status'    => $status,
            'search'    => $search,
        ]);
    }

    // Detail 1 pendaftar
    public function show($id)
    {
        $pendaftaran = PendaftaranMagang::with(['user', 'dokumen'])->findOrFail($id);

        return view('admin.pendaftar.show', compact('pendaftaran'));
    }

    // Ubah status (pending / diterima / ditolak)
    // Ubah status (pending / diterima / ditolak)
    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = PendaftaranMagang::findOrFail($id);

        // Validasi awal
        $data = $request->validate([
            'status'          => ['required', Rule::in(['pending', 'diterima', 'ditolak'])],
            'catatan_admin'   => ['nullable', 'string'],
            'tanggal_mulai'   => ['nullable', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
        ]);

        // Kalau status diterima → tanggal wajib diisi
        if ($data['status'] === 'diterima') {
            $request->validate([
                'tanggal_mulai'   => ['required', 'date'],
                'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            ]);
        }

        // Simpan ke database
        $pendaftaran->status          = $data['status'];
        $pendaftaran->catatan_admin   = $data['catatan_admin'] ?? null;
        $pendaftaran->tanggal_mulai   = $data['tanggal_mulai'];      // bisa null kalau bukan "diterima"
        $pendaftaran->tanggal_selesai = $data['tanggal_selesai'];    // sama
        $pendaftaran->save();

        // Kirim email notifikasi ke peserta (tetap kita pakai punya kamu)
        try {
            Mail::to($pendaftaran->email)
                ->send(new StatusPendaftaranMail($pendaftaran));
        } catch (\Throwable $e) {
            // logger($e->getMessage());
        }

        return redirect()
            ->route('admin.pendaftar.show', $pendaftaran->id)
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }


    public function export(Request $request): StreamedResponse
    {
        $fileName = 'pendaftar_magang_' . now()->format('Ymd_His') . '.csv';

        $callback = function () {
            $handle = fopen('php://output', 'w');

            // Header kolom
            fputcsv($handle, [
                'ID',
                'Nama Lengkap',
                'Email',
                'NIM',
                'Universitas',
                'Program Studi',
                'No HP',
                'Status',
                'Tanggal Mulai',
                'Tanggal Selesai',
                'Tanggal Daftar',
            ]);

            PendaftaranMagang::orderBy('created_at')
                ->chunk(200, function ($rows) use ($handle) {
                    foreach ($rows as $row) {
                        fputcsv($handle, [
                            $row->id,
                            $row->nama_lengkap,
                            $row->email,
                            $row->nim,
                            $row->universitas,
                            $row->program_studi,
                            $row->no_hp,
                            $row->status,
                            $row->tanggal_mulai,
                            $row->tanggal_selesai,
                            $row->created_at,
                        ]);
                    }
                });

            fclose($handle);
        };

        return response()->stream($callback, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }
}
