<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Penerimaan Magang</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 16px;
            margin: 0;
        }

        .header h2 {
            font-size: 14px;
            margin: 4px 0 0 0;
        }

        .line {
            border-top: 1px solid #000;
            margin-top: 6px;
        }

        .judul-surat {
            text-align: center;
            margin: 24px 0 16px;
            font-weight: bold;
            text-decoration: underline;
        }

        .info {
            margin-bottom: 10px;
        }

        .ttd {
            margin-top: 40px;
            width: 100%;
        }

        .ttd td {
            vertical-align: top;
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>DINAS PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</h1>
        <h2>PROVINSI SUMATERA SELATAN</h2>
        <div class="line"></div>
    </div>

    <div class="judul-surat">
        SURAT PENERIMAAN MAGANG
    </div>

    <p>
        Yang bertanda tangan di bawah ini, menyatakan bahwa:
    </p>

    <table class="info">
        <tr>
            <td style="width: 140px;">Nama</td>
            <td style="width: 10px;">:</td>
            <td>{{ $pendaftaran->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>:</td>
            <td>{{ $pendaftaran->nim }}</td>
        </tr>
        <tr>
            <td>Universitas</td>
            <td>:</td>
            <td>{{ $pendaftaran->universitas }}</td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>:</td>
            <td>{{ $pendaftaran->program_studi }}</td>
        </tr>
    </table>

    <p>
        DITERIMA sebagai peserta magang di
        <strong>Dinas Pemberdayaan Perempuan dan Perlindungan Anak Provinsi Sumatera Selatan</strong>
        pada periode:
    </p>

    <p>
        @php
        $mulai = \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)->translatedFormat('d F Y');
        $selesai = \Carbon\Carbon::parse($pendaftaran->tanggal_selesai)->translatedFormat('d F Y');
        @endphp

        <strong>{{ $mulai }}</strong> s.d. <strong>{{ $selesai }}</strong>.
    </p>

    @if ($pendaftaran->judul_magang)
    <p>
        Dengan fokus/judul magang: <strong>{{ $pendaftaran->judul_magang }}</strong>.
    </p>
    @endif

    <p>
        Peserta yang bersangkutan diwajibkan mematuhi seluruh peraturan yang berlaku di lingkungan
        Dinas Pemberdayaan Perempuan dan Perlindungan Anak Provinsi Sumatera Selatan.
    </p>

    <p>
        Demikian surat ini dibuat untuk dapat digunakan sebagaimana mestinya.
    </p>

    <table class="ttd">
        <tr>
            <td></td>
            <td style="text-align: center;">
                Palembang, ..................................<br>
                Kepala Dinas<br><br><br><br>
                (...........................................)
            </td>
        </tr>
    </table>
</body>

</html>