
\Carbon\Carbon::setLocale('id');

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Selesai Magang</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5; /* Spasi baris 1.5 */
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .header img {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 100px; /* Sesuaikan ukuran logo */
        }
        .header h3, .header h4, .header p {
            margin: 0;
        }
        .header p {
            font-size: 14px;
        }
        .line {
            border-bottom: 3px solid black; /* Garis bawah kop surat */
            margin-top: 10px;
        }
        .content {
            margin-top: 30px;
        }
        .content p {
            text-align: justify;
            line-height: 1.5;
        }
        /* Footer dan tanda tangan rata kanan */
        .footer-signature {
            text-align: right;
            margin-top: 50px;
            line-height: 1.5;
        }
        .date-right {
            text-align: right; /* Membuat tanggal rata kanan */
        }
        img.corner-image {
            position: absolute;
            top: 20px; 
            right: 20px; 
            width: 50px; 
            height: auto; 
            z-index: 999; 
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Kop Surat -->
        <div class="header">
            <img src="/img/pemkot.png" alt="Logo Pemkot Semarang" class="corner-image">
            <h3>PEMERINTAH KOTA SEMARANG</h3>
            <!-- <h4>DINAS KOMUNIKASI DAN INFORMATIKA</h4> -->
            <p>Alamat: Jl. Pemuda No. 148, Semarang, Jawa Tengah</p>
            <p>Email: info@diskominfo.semarangkota.go.id | Telp: (024) 3549446</p>
        </div>
        
        <div class="line"></div> <!-- Garis bawah kop surat -->

        <!-- Tanggal Rata Kanan -->
        <p class="date-right">Semarang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>


        <!-- Isi Surat -->
        <div class="content">
            <p>Yang bertanda tangan di bawah ini:</p>
            <p>Nama: Hanry<br>
            Jabatan: Koordinator Magang<br>
            Pemerintahan Kota Semarang, Jawa Tengah</p>

            <p>Dengan ini menyatakan bahwa:</p>

            <p>Nama: {{ $pesertaMagang->nama_peserta }}<br>
            Jurusan: {{ $pesertaMagang->jurusan }}<br>
            Telah melaksanakan kegiatan magang di {{ $instansi->nama_instansi }} dari tanggal {{ \Carbon\Carbon::parse($pendaftaranMagang->tanggal_mulai)->translatedformat('d F Y') }} sampai dengan {{ \Carbon\Carbon::parse($pendaftaranMagang->tanggal_selesai)->translatedformat('d F Y') }}.</p>

            <p>Demikian surat ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

            <!-- Footer dan Tanda Tangan Rata Kanan -->
            <div class="footer-signature">
                <p>Koodinator Magang</p>
                <br><br>
                <p>Hanry</p>
            </div>
        </div>
    </div>
</body>
</html>
