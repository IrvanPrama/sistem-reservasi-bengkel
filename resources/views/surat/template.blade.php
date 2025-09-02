<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Laporan Imunisasi</title>
    <style>
        body { font-family: "Times New Roman", serif; font-size: 12pt; line-height: 1.5; }
        .judul { text-align: center; font-weight: bold; font-size: 14pt; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="judul">LAPORAN KEGIATAN IMUNISASI</div>
    <p>Nomor Surat: {{ $surat->nomor_surat }}</p>
    <p>Pada hari ini telah dilaksanakan kegiatan imunisasi yang berlokasi di Banjar <b>{{ $surat->lokasi }}</b>.</p>
    <p>Tanggal: {{ \Carbon\Carbon::parse($surat->tanggal)->translatedFormat('d F Y') }}</p>

    <br><br>
    <p style="text-align: right;">Mengetahui,</p>
    <p style="text-align: right; margin-top: 60px;">(_________________)</p>
</body>
</html>
