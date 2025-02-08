<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            position: relative;
            width: 100vh;
            height: 150vh;
            padding: 50px;
            border: 10px solid #000080;
            box-sizing: border-box;
            margin: 0 auto; 
        }

        /* Menempatkan logo di tengah atas */
        .corner-image {
            position: absolute;
            top: 30px; /* Jarak dari atas */
            left: 50%;
            transform: translateX(-50%); /* Pusatkan secara horizontal */
            width: 50px; /* Sesuaikan ukuran */
            height: auto;
            margin-bottom: 100px;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #000080;
            margin-top: 90px;
            margin: 0; /* Menghapus margin default */
            padding: 2px 0;  /* Tambahkan margin untuk menghindari tumpang tindih dengan logo */
        }
        .header-container {
            position: relative;
            margin-top: 60px; /* Jarak dari logo */
            text-align: center;
        }

        .title {
            font-size: 48px;
            font-weight: bold;
            color: #333333;
            margin: 0; /* Hapus margin default */
            padding-bottom: 5px; /* Tambahkan sedikit padding jika perlu */
        }

        .body {
            font-size: 20px;
            color: #555555;
            margin: 0; /* Hapus margin default */
            padding-top: 5px; /* Sesuaikan padding */
            line-height: 1.4; /* Kurangi agar lebih rapat */
        }
        .name {
            font-size: 40px;
            font-weight: bold;
            color: #000000;
            margin-top: 5px;
        }

        .date {
            font-size: 18px;
            margin-top: 40px;
        }

        .signature {
            margin-top: 10px;
            text-align: center;
        }

        .line {
            border-top: 2px solid #000000;
            width: 200px;
            margin: 10px auto;
        }

        .signature-name {
            font-size: 18px;
            color: #000000;
            margin-bottom: 80px;
        }

        .nam-koor {
            font-size: 18px;
            color: #000000;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ public_path('img/pemkot.png') }}" alt="Logo Pemkot Semarang" class="corner-image">
        <div class="header-container">
            <div class="header">Pemerintahan Kota Semarang</div>
            <div class="header">Jawa Tengah</div>
        </div>
        <br>
        <div class="title">SERTIFIKAT</div>
        <div class="body">
            Diberikan kepada:
            <div class="name">{{ $pesertaMagang->nama_peserta }}</div>
            <br>
            Sebagai bentuk penghargaan atas partisipasi dan pencapaian dalam program magang di {{ $instansi->nama_instansi }} pada tanggal {{ \Carbon\Carbon::parse($pendaftaranMagang->tanggal_mulai)->translatedformat('d F Y') }} sampai dengan {{ \Carbon\Carbon::parse($pendaftaranMagang->tanggal_selesai)->translatedformat('d F Y') }}.
        </div>
        
        <div class="date">Semarang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
        
        <div class="signature">
            <div class="signature-name">Koordinator Magang</div>
            <div class="name-koor">Hanry Sugihastomo, S.Sos., M. M.</div>
        </div>
    </div>
</body>
</html>
