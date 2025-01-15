@extends('layouts.app')

@section('title', 'Dashboard Peserta Magang')

@section('content')
<h1 class="header">Beranda</h1>
<p>Selamat Datang <strong>Widiawati Sihaloho</strong></p>
<div style="display: flex; justify-content: space-between;">
    <div class="card">
        <h3>Status Pendaftaran</h3>
        <p>Diterima</p>
    </div>
    <div class="card">
        <h3>Status Magang</h3>
        <p>Aktif</p>
    </div>
    <div class="card">
        <h3>Status SKL</h3>
        <p>Belum diterbitkan</p>
    </div>
</div>
@endsection
