<!DOCTYPE html>
<html lang="en">
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
            height: 100vh;
            padding: 50px;
            border: 10px solid #000080;
            box-sizing: border-box;
            margin: 0 auto; 
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #000080;
            margin-bottom: 20px;
        }

        .title {
            font-size: 48px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 30px;
        }

        .body {
            font-size: 20px;
            color: #555555;
            margin: 30px 0;
            line-height: 1.6;
        }

        .name {
            font-size: 36px;
            font-weight: bold;
            color: #000000;
            margin-top: 20px;
        }

        .date {
            font-size: 18px;
            margin-top: 40px;
        }

        .signature {
            margin-top: 50px;
            text-align: left;
        }

        .signature .line {
            border-top: 2px solid #000000;
            width: 200px;
            margin: 0 auto;
        }

        .signature-name {
            margin-top: 5px;
            font-size: 18px;
            color: #000000;
        }
        
    </style>
</head>
<body>
    <div class="container">
    <img src="/img/pemkot.png" alt="Logo Pemkot Semarang" >
        <div class="header">Pemerintahan Kota Semarang</div>
        <p class="header">Jawa Tengah</p>
        <div class="title">SERTIFIKAT</div>
        <div class="body">
            Sertifikat ini diberikan kepada:
            <div class="name">{{ $pesertaMagang->nama_peserta }}</div>
            Sebagai bentuk penghargaan atas partisipasi dan pencapaian dalam program magang di {{ $instansi->nama_instansi }}.
        </div>
        <div class="date">Tanggal: {{ now()->format('d-m-Y') }}</div>
        <div class="signature">
            <div class="signature-name">Koordinator Magang</div>
        </div>
        <div class="line"></div>
    </div>
</body>
</html>
