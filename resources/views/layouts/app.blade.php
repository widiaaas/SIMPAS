<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard ')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Aoboshi+One&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Aoboshi+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        .inter-font {
            font-family: "Inter", serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }
        .aoboshi-one-regular {
            font-family: "Aoboshi One", serif;
            font-weight: 400;
            font-style: normal;
        }
        body {
            font-family: 'Aoboshi One', sans-serif;
            margin: 0;
            padding: 0;
            height: 100%; /* Pastikan body memiliki tinggi penuh */
        }
        .sidebar {
            width: 250px;
            background-color: #403333;
            color: #fff;
            position: fixed;
            height: 100%;
            padding: 20px 0;
            transform: translateX(0);
            transition: transform 0.3s ease;
            padding-top: 75px;
            
        }
        .sidebar.closed {
            transform: translateX(-250px);
        }
        .sidebar a {
            width: 200px;
            text-decoration: none;
            color: #fff;
            display: block;
            padding: 10px 20px;
            font-weight: normal;
            top: 200px; 
            right: 50px;
            
        }
        .sidebar a:hover {
            background-color: #FF885B;
            border-radius: 0 50px 50px 0;
        }
        .sidebar a.active {
            background-color: #FF885B !important;
            border-radius: 0 50px 50px 0;
        }
        .content {
            margin-left: 250px;
            padding: 50px;
            background-color: #FDF2EE;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        .content.expanded {
            margin-left: 0;
        }
        .card {
            background-color: #FFDED5;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }
        .card h3 {
            margin: 0;
            color: #b22222;
        }
        .card p {
            margin: 5px 0;
            font-size: 18px;
        }
        .header {
            color: #B22222;
            font-size: 40px;
            margin-left: 40px;
        }
        .corner-text {
            position: absolute;
            margin-left: 10px;
            font-size: 16px;
            color: #b22222;
            top: 30px; 
            right: 122px; 
            width: 80px;
        }
        .corner-text2 {
            position: absolute;
            margin-left: 10px;
            font-size: 16px;
            color: #b22222;
            top: 50px; 
            right: 130px; 
            width: 80px;
            white-space: nowrap; 
        }
        img.corner-image {
            position: absolute;
            top: 20px; 
            right: 20px; 
            width: 50px; 
            height: auto; 
            z-index: 999; 
        }
        .toggle-button {
            position: fixed;
            top: 20px;
            
            background-color: #403333;
            color: white;
            border: none;
            padding: 10px;
            font-size: 20px;
            border-radius: 4px;
            cursor: pointer;
            z-index: 1000;
            border-radius: 0 50px 50px 0;
            width: 50px;
        }
        .sidebar.closed + .toggle-button {
            left: 20px; 
        }
        .content {
            position: relative; /* Untuk posisi elemen */
        }

        .corner-text,
        .corner-text2,
        .corner-image {
            display: block; /* Atur posisi sesuai kebutuhan */
        }

        .subnav {
            display: none;
            margin-left: 20px;  /* Memberikan indentasi untuk subnavigasi */
        }

        .subnav.show {
            display: block;
        }

    </style>
</head>
<body>
    <button id="toggle-sidebar" class="toggle-button">
        ☰
    </button>

    {{-- <div class="sidebar">
    @if(Auth::user()->role === 'peserta')
        <a href="#" class="active">Beranda</a>
        <a href="#">Profil</a>
        <a href="#">Daftar Magang</a>
        <a href="#">SKL</a>
    @elseif(Auth::user()->role === 'admin')
        <a href="#" class="active">Dashboard</a>
        <a href="#">Kelola Peserta</a>
        <a href="#">Kelola Magang</a>
    @elseif(Auth::user()->role === 'pembimbing')
        <a href="#" class="active">Dashboard</a>
        <a href="#">Peserta Bimbingan</a>
        <a href="#">Evaluasi</a>
    @endif
</div> --}}
<div class="sidebar">
    @if(Auth::check())
        @if(Auth::user()->role === 'peserta')
            <a href="/pesertaMagang/dashboard" class="{{ Request::is('/') ? 'active' : '' }} rounded d-flex align-items-center">Beranda</a>
            <a href="/pesertaMagang/profile" class="{{ Request::is('profil') ? 'active' : '' }}">Profil</a>
            <a href="/pesertaMagang/pendaftaran-magang" class="{{ Request::is('pendaftaran-magang') ? 'active' : '' }}">Daftar Magang</a>
            <a href="/pesertaMagang/kumpul-laporan" class="{{ Request::is('kumpul-laporan') ? 'active' : '' }}">Pengumpulan Laporan</a>
            <a href="/pesertaMagang/penilaian" class="{{ Request::is('penilaian') ? 'active' : '' }}">Penilaian</a>
        
        @elseif(Auth::user()->role == 'koordinator')
            <a href="/koordinator/dashboard" class="{{ Request::is('/') ? 'active' : '' }} rounded d-flex align-items-center">Beranda</a>
            <a href="/koordinator/profil" class="{{ Request::is('profil') ? 'active' : '' }}">Profil</a>
            <!-- Navigasi Pembagian Magang dengan toggle subnavigasi -->
            <div class="nav-item" id="pembagianMagangNav">
                <a href="#" class="nav-link {{ Request::is('pembagianMagang') || Request::is('pembagianMagang/*') ? 'active' : '' }}" id="pembagianMagangToggle">
                    Pembagian Magang
                </a>
                <div class="subnav {{ Request::is('pembagianMagang') || Request::is('pembagianMagang/*') ? 'show' : '' }}">
                    <a href="/koordinator/pembagianMagang/pendaftar" class="{{ Request::is('pembagianMagang/pendaftar') ? 'active' : '' }}">Pendaftar Magang</a>
                    <a href="/koordinator/pembagianMagang/plottingMentor" class="{{ Request::is('pembagianMagang/plottingMentor') ? 'active' : '' }}">Plotting Mentor</a>
                </div>
            </div>
            <a href="/koordinator/daftarPeserta" class="{{ Request::is('daftarPeserta') ? 'active' : '' }}">Daftar Peserta</a>
            <a href="/koordinator/penilaianPeserta" class="{{ Request::is('penilaianPeserta') ? 'active' : '' }}">Penilaian Peserta</a>
        @endif
        
    @else
        <a href="/login">Login</a>
        <p>Silakan login untuk mengakses fitur lengkap.</p>
    @endif
    @yield('sidebar')
</div>

    
    <div class="content overflow-auto">
        <span class="corner-text">Pemerintahan</span>
        <span class="corner-text2">Kota Semarang</span>
        <img src="/img/pemkot.png" alt="Logo Pemkot Semarang" class="corner-image">
        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.getElementById('toggle-sidebar');
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');

            toggleButton.addEventListener('click', function () {
                sidebar.classList.toggle('closed');
                content.classList.toggle('expanded');
            });
        });

        document.getElementById('pembagianMagangToggle').addEventListener('click', function(event) {
            event.preventDefault();
            const subnav = this.nextElementSibling;
            subnav.classList.toggle('show');  // Toggle kelas 'show' untuk menampilkan atau menyembunyikan subnavigasi
        });

    </script>
</body>
</html>