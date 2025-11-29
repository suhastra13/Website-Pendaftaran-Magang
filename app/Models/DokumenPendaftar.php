<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPendaftar extends Model
{
    use HasFactory;

    protected $table = 'dokumen_pendaftar';

    protected $fillable = [
        'pendaftaran_id',
        'jenis',
        'path',
        'original_name',
        'mime_type',
        'size',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranMagang::class, 'pendaftaran_id');
    }
}
