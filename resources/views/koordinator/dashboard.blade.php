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
        font-size: 1.25rem;
        color: #B31314;
    }

    .container-custom {
        display: flex;
        justify-content: space-between;
    }
</style>

<h1 class="header">Beranda</h1>
<p class="text-xl" style="margin-left: 40px">Selamat Datang <strong style="color:#b31312">Wihajun</strong></p>

<div class="card">
    <div class= stat-peserta>
        <div>
            <p style="font-size: 30px">Total Peserta</p>
            <h1 style="font-size: 100px">1257</h1>
            <p>Peserta</p>
        </div>
        
        <button class="btn btn-detail-peserta mt-3">Lihat Detail Peserta</button>
    </div>
    
    <div class="stat-pendaftar">
        <p style="font-size: 30px; color:#b31312">Pendaftar Magang</p>
        <div class="container-custom" style="background-color:#FFDED5">
            <div class="card-custom">
                <h1 style="font-size: 50px; text-align:center; color:#403333">1257</h1>
                <p style="text-align: center; color:#b31312">Total</p>
            </div>
            <div class="card-custom">
                <h1 style="font-size: 50px; text-align:center; color:#403333">1257</h1>
                <p style="text-align: center; color:#b31312">Diterima</p>
            </div>
            <div class="card-custom">
                <h1 style="font-size: 50px; text-align:center; color:#403333">1257</h1>
                <p style="text-align: center; color:#b31312">Belum Diterima</p>
            </div>
        </div>
        <button class="btn btn-detail-pendaftar" style="margin: 25px;" >
            <a href="/koor/pembagianMagang">Detail</a>
        </button>        
    </div>
</div>

<script>
    var ctx = document.getElementById('pendaftarChart').getContext('2d');
    var pendaftarChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['DISPERKIM', 'DISKOMINFO', 'DLH', 'DISPERTAN', 'DISHUB', 'dll.'],
            datasets: [{
                label: 'Jumlah Pendaftar',
                data: [300, 250, 200, 180, 127], // Ganti dengan jumlah peserta aktual di setiap dinas
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)', // Warna untuk DISPERKIM
                    'rgba(255, 159, 64, 0.2)', // Warna untuk DISKOMINFO
                    'rgba(255, 205, 86, 0.2)', // Warna untuk DLH
                    'rgba(54, 162, 235, 0.2)', // Warna untuk DISPERTAN
                    'rgba(153, 102, 255, 0.2)', // Warna untuk DISHUB
                    'rgba(201, 203, 207, 0.2)'  // Warna untuk lainnya
                ],

            }]
        },
        options: {
            responsive: true,
            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    legend: {
                        position: 'right', // Menempatkan legenda di sebelah kanan
                    },
                    datalabels: {
                        color: '#000',
                        formatter: (value, ctx) => {
                            let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            let percentage = (value * 100 / sum).toFixed(2) + "%";
                            return percentage;
                        }
                    }
                }
            }
        }
    });
</script>

@endsection