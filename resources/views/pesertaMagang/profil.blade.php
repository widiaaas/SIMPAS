@extends('layouts.app')

@section('title', 'Dashboard Peserta Magang')

@section('sidebar')

@section('content')
<h1 class="header">Profil</h1>
<div class="container">
    <div class="d-flex align-items-center mb-3">
        <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #EFEFEF; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <img src="{{ asset('path/to/profile-picture.jpg') }}" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="ms-3" style="flex-grow: 1; text-align: right;">
            <h5 class="m-0">PESERTA MAGANG</h5>
            <p class="m-0 text-muted">2406012210037</p>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">NAMA</label>
            <div class="form-control bg-light text-muted">Widawati Sihaloho</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">EMAIL</label>
            <div class="form-control bg-light text-muted">widawatiscollege@gmail.com</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="school" class="form-label">ASAL SEKOLAH/ PERGURUAN TINGGI</label>
            <div class="form-control bg-light text-muted">Universitas Diponegoro</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">NO TELEPON</label>
            <div class="form-control bg-light text-muted">082167336771</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="major" class="form-label">JURUSAN</label>
            <div class="form-control bg-light text-muted">Informatika</div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" onclick="window.location.href='/edit-profile'">Edit</button>
    </div>
</div>
@endsection
