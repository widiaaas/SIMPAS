@extends('layouts.app')

@section('title', 'Dashboard Koordinator')

@section('content')

<style>
    .stat-pendaftar {
        background-color: #FFDED5;
        margin: 100px;
        width: 100%; /* Mengubah lebar card */
        height: 150px; /* Mengubah tinggi card */
        padding: 20px; /* Menambah padding dalam card */
        margin: 10px; /* Menambah jarak antar card */
        border: 1px solid #ddd; /* Menambahkan border untuk memperjelas batas card */
        border-radius: 8px; /* Membuat sudut card lebih melengkung */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Memberikan efek bayangan pada card */
        position: relative; /* Memungkinkan penempatan tombol secara absolute */
    }

    .stat-peserta {
        margin: 10px;
        width: 100%; /* Mengubah lebar card */
        height: 150px; /* Mengubah tinggi card */
        padding: 20px; /* Menambah padding dalam card */
        margin: 10px; /* Menambah jarak antar card */
        border-radius: 8px; /* Membuat sudut card lebih melengkung */
    }

    .detail-peserta {
        width: 100%;
        border-radius: 5px;
        color: #FEF7F4;
        font-weight: bold;
        background-color: #FF885B;
        border-color: #FF885B;
        outline: none;
        box-shadow: none; /* Menghilangkan shadow biru */
    }

    .detail-peserta:hover {
        background-color: #b53c00d1; /* Sedikit lebih gelap dari warna awal */
        border-color: #b53c00d1;
        color: white;
    }

    .detail-peserta:focus,
    .detail-peserta:active {
        background-color: #FF6600; /* Tetap dengan warna yang sama */
        border-color: #FF6600;
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
</style>

<h1 class="header">Beranda</h1>

<p>Selamat Datang <strong>Wihajun</strong></p>

<div style="display: flex; justify-content: space-between;">
    <div class="stat-peserta">
        <div>
            <p>Total Peserta</p>
            <h1>1257</h1>
            <p>Peserta</p>
        </div>
        <button class="btn detail-peserta mt-3">Lihat Detail Peserta</button>
    </div>
</div>

<div style="display: flex; justify-content: space-between;">
    <div class="stat-pendaftar">
            <div>
                <p>Total Peserta</p>
                <h1>1257</h1>
                <p>Peserta</p>
            </div>
            <!-- Tombol diposisikan di pojok kanan atas -->
            <button class="btn detail-peserta mt-3 btn-detail-pendaftar" style="margin-bottom: 20px">Selengkapnya</button>
    </div>
</div>

{{-- <div style="display: flex; justify-content: space-between;">
    
    <div class="card">
        <h3>Status Pendaftaran</h3>
        <p>Diterima</p>

</div> --}}
@endsection
