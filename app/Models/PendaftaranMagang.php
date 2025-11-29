<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranMagang extends Model
{
    use HasFactory;

    // karena nama tabel bukan "pendaftaran_magangs"
    protected $table = 'pendaftaran_magang';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'email',
        'nim',
        'no_hp',
        'universitas',
        'program_studi',
        'semester',
        'alamat',
        'judul_magang',
        'deskripsi_singkat',
        'status',
        'catatan_admin',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenPendaftar::class, 'pendaftaran_id');
    }
}
