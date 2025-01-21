@extends('layouts.app')

@section('title', 'Dashboard Peserta Magang')

@section('content')
<h1 class="header mb-20">Beranda</h1>
<p class="mb-6 text-xl" style="margin-left: 40px;">Selamat Datang <strong>Widiawati Sihaloho</strong></p>

<style>
    .card-custom {
        width: 33.33%;
        padding: 1.5rem;
        background-color: rgba(255, 124, 75, 0.5);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 1rem;
        margin-left: 40px; 
    }

    .card-custom h3 {
        font-size: 1.25rem;
        color: #B31314;
    }

    .container-custom {
        display: flex;
        justify-content: space-between;
    }

    .button-detail {
        display: inline-block;
        margin-top: 10px;
        padding: 0.5rem 1rem;
        background-color: #B31314;
        color: white;
        border: none;
        border-radius: 0.5rem;
        text-decoration: none;
    }
</style>

<div class="container-custom">
    <div class="card card-custom">
        <h3>Status Pendaftaran</h3>
        <hr>
        @php
            $statusPendaftaran = 'Diterima'; // Contoh status, ini bisa berasal dari database
        @endphp
        <p>{{ $statusPendaftaran }}</p>
        @if (strtolower($statusPendaftaran) === 'diterima' || strtolower($statusPendaftaran) === 'ditolak')
        <a href="/detail-pendaftaran" class="button-detail">Lihat Detail</a>
        @endif
    </div>
    <div class="card card-custom">
        <h3>Status Magang</h3>
        <hr>
        @php
            $statusMagang = 'Aktif'; // Contoh status, ini bisa berasal dari database
            $tanggalMulaiMagang = '02-01-2025'; // Contoh tanggal mulai
            $tanggalSelesaiMagang = '13-02-2025'; // Contoh tanggal selesai
        @endphp
        <p>{{ $statusMagang }}</p>
        @if (strtolower($statusMagang) === 'aktif')
        <p><strong>Tanggal Mulai:</strong> {{ $tanggalMulaiMagang }}</p>
        <p><strong>Tanggal Selesai:</strong> {{ $tanggalSelesaiMagang }}</p>
        @endif
    </div>
    <div class="card card-custom">
        <h3>Status SKL</h3>
        <hr>
        <p>Belum diterbitkan</p>
    </div>
</div>
@endsection
