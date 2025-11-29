@component('mail::message')
# Konfirmasi Pendaftaran Magang

Yth. {{ $pendaftaran->nama_lengkap }},

Terima kasih telah mengajukan pendaftaran magang di
**Dinas Pemberdayaan Perempuan dan Perlindungan Anak Provinsi Sumatera Selatan**.

Berikut ringkasan data pendaftaran Anda:

- **Nama**: {{ $pendaftaran->nama_lengkap }}
- **Email**: {{ $pendaftaran->email }}
- **No HP**: {{ $pendaftaran->no_hp }}
- **Universitas**: {{ $pendaftaran->universitas }}
- **Program Studi**: {{ $pendaftaran->program_studi }}
- **Status saat ini**: **PENDING (menunggu verifikasi admin)**

Tim kami akan melakukan pemeriksaan data dan dokumen yang Anda kirimkan.
Anda akan menerima email lanjutan ketika pendaftaran Anda **diterima** atau **belum dapat diterima**.

Apabila terdapat kesalahan data, silakan menghubungi admin magang DPPPA.

Terima kasih atas perhatian dan kepercayaan Anda.

Salam,
**Sistem Pendaftaran Magang**
DPPPA Provinsi Sumatera Selatan
@endcomponent