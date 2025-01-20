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
</style>

<div class="container-custom">
    <div class="card card-custom">
        <h3>Status Pendaftaran</h3>
        <hr>
        <p>Diterima</p>
    </div>
    <div class="card card-custom">
        <h3>Status Magang</h3>
        <hr>
        <p>Aktif</p>
    </div>
    <div class="card card-custom">
        <h3>Status SKL</h3>
        <hr>
        <p>Belum diterbitkan</p>
    </div>
</div>
</div>
@endsection
