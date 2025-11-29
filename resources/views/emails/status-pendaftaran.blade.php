@component('mail::message')
# Status Pendaftaran Magang

Yth. {{ $pendaftaran->nama_lengkap }},

Berikut informasi terbaru terkait pendaftaran magang Anda di
**Dinas Pemberdayaan Perempuan dan Perlindungan Anak Provinsi Sumatera Selatan**:

@php
$status = ucfirst($pendaftaran->status);
@endphp

**Status:** {{ $status }}

@if ($pendaftaran->status === 'diterima')
Kami informasikan bahwa pendaftaran magang Anda **DITERIMA**.
Tim kami akan menghubungi Anda untuk informasi teknis selanjutnya.
@elseif ($pendaftaran->status === 'ditolak')
Saat ini pendaftaran magang Anda **BELUM DAPAT KAMI TERIMA**.
Kami sangat mengapresiasi minat dan kepercayaan Anda untuk mendaftar.
@else
Pendaftaran magang Anda saat ini **masih dalam proses verifikasi (PENDING)**.
@endif

@if ($pendaftaran->catatan_admin)
**Catatan dari admin:**

> {{ $pendaftaran->catatan_admin }}
@endif

Terima kasih atas perhatian dan kepercayaan Anda.

Salam,
**Sistem Pendaftaran Magang**
DPPPA Provinsi Sumatera Selatan
@endcomponent