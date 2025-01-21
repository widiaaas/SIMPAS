@extends('layouts.app')

@section('title', 'Dashboard Koordinator')

@section('content')

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Aoboshi+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

    .card {
        min-width: 40%;
        background-color:#fdf2ee;
        text-align: start;
        margin-left: 10px;
        box-shadow: none;
    }

    .card h1{
        font-family: 'Inter', sans-serif;
        font-size: 50px;
        font-style: italic;
        font-weight: 1000;
        color:#b31312;
    }

    .stat-peserta {
        min-width: 500px;
        background-color:#fdf2ee;
        margin-left: 30px;
        width: 100%; /* Mengubah lebar card */
        margin: 10px; /* Menambah jarak antar card */
        position: relative; /* Memungkinkan penempatan tombol secara absolute */
    }

    .stat-pendaftar {
        min-width: 500px;
        background-color: #FFDED5;
        width: 100%; /* Mengubah lebar card */
        padding: 20px; /* Menambah padding dalam card */
        margin: 10px; /* Menambah jarak antar card */
        border: 1px solid #ddd; /* Menambahkan border untuk memperjelas batas card */
        border-radius: 8px; /* Membuat sudut card lebih melengkung */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Memberikan efek bayangan pada card */
        position: relative; /* Memungkinkan penempatan tombol secara absolute */
    }

    .btn{
        width: 100%;
        border-radius: 5px;
        color: #FEF7F4;
        font-family: 'Inter', sans-serif;
        font-weight: bold;
        background-color: #FF885B;
        border-color: #FF885B;
        text-align: start;
    }

    .btn:hover {
        background-color: #b53c00d1; /* Sedikit lebih gelap dari warna awal */
        border-color: #b53c00d1;
        color: white;
    }

    .btn:focus,
    .btn:active {
        background-color: #FF885B; /* Tetap dengan warna yang sama */
        border-color: #FF885B;
    }

    .btn-detail-peserta {
        padding-left:10px;
        text-align: start;
    }

    .btn-detail-pendaftar {
        text-align: center;
        border-radius: 5px;
        height: 30px;
        max-width: 100px;
        position: absolute;
        top: 10px; /* Menempatkan tombol 10px dari atas */
        right: 10px; /* Menempatkan tombol 10px dari kanan */
    }

    .card-custom {
        min-width: 150px;
        background-color:#FFDED5;
        min-width: 150px;
    }

    .card-custom h1 {
        font-size: 50px;
        color: #403333;
    }

    .card-custom p {
        color: #b31312;
    }

    .container-custom {
        display: flex;
        justify-content: space-between;
    }
    
    .stat-peserta-diagram {
        /* padding: 0px;
        height: 300px; */
        flex: 1;
        display: flex;
        justify-content: end;
        justify-items: end;
        /* background-color:#403333 */
    }

</style>

<h1 class="header">Beranda</h1>
<p class="text-xl" style="margin-left: 40px">Selamat Datang <strong style="color:#b31312">{{ $koordinator->nama }}</strong></p>

<div class="card">
    <div class="stat-container">
        <div class="stat-peserta">
            <div class="container-custom" style="gap: 40px">
                <div>
                    <p style="font-size: 30px">Total Peserta</p>
                    <h1 style="font-size: 100px">{{ $totalPeserta }}</h1>
                    <p>Peserta</p>
                </div>
                <div class="stat-peserta-diagram" style="height: 250px">
                    <canvas id="pesertaChart" width="250" height="250px"></canvas>
                </div>
            </div>
            <button class="btn btn-detail-peserta mt-3">Lihat Detail Peserta</button>
        </div>        
    </div>
    <div class="stat-pendaftar">
        <p style="font-size: 30px; color:#b31312">Pendaftar Magang</p>
        <div class="container-custom" style="background-color:#FFDED5">
            <div class="card-custom">
                <h1 style="font-size: 50px; text-align:center; color:#403333">{{ $totalPendaftar }}</h1>
                <p style="text-align: center; color:#b31312">Total</p>
            </div>
            <div class="card-custom">
                <h1 style="font-size: 50px; text-align:center; color:#403333">{{ $diterima }}</h1>
                <p style="text-align: center; color:#b31312">Diterima</p>
            </div>
            <div class="card-custom">
                <h1 style="font-size: 50px; text-align:center; color:#403333">{{ $diproses }}</h1>
                <p style="text-align: center; color:#b31312">Belum Diterima</p>
            </div>
        </div>
        <button class="btn btn-detail-pendaftar" style="margin: 25px;" >
            <a href="/koor/pembagianMagang">Detail</a>
        </button>        
    </div>
</div>

<script>
    var ctx = document.getElementById('pesertaChart').getContext('2d');
    var pesertaChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json($instansiLabels),  // Menampilkan label dari instansi
            datasets: [{
                data: @json($instansiCounts),  // Menampilkan jumlah peserta per instansi
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)', // Warna untuk instansi pertama
                    'rgba(153, 102, 255, 0.2)', // Warna untuk instansi kedua
                    'rgba(255, 159, 64, 0.2)',  // Warna untuk instansi ketiga
                    'rgba(54, 162, 235, 0.2)',  // Warna untuk instansi keempat
                    'rgba(255, 99, 132, 0.2)',  // Warna untuk instansi kelima
                    'rgba(201, 203, 207, 0.2)' // Warna untuk 'dll.'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)', // Border untuk instansi pertama
                    'rgba(153, 102, 255, 1)', // Border untuk instansi kedua
                    'rgba(255, 159, 64, 1)',  // Border untuk instansi ketiga
                    'rgba(54, 162, 235, 1)',  // Border untuk instansi keempat
                    'rgba(255, 99, 132, 1)',  // Border untuk instansi kelima
                    'rgba(201, 203, 207, 1)'  // Border untuk 'dll.'
                ],
                borderWidth: 1
            }]
        },
        plugins: [ChartDataLabels],
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'left',
                    labels: {
                        padding: 0 // Mengurangi padding antara legend dan chart
                    }
                },
                title: {
                    display: false // Pastikan title tidak ditampilkan
                }
            },
            layout: {
                padding: {
                    top: 0,
                    bottom: 0
                }
            }
        }
    });
</script>


@endsection