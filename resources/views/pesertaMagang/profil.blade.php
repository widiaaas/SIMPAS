@extends('layouts.app')

@section('title', 'Dashboard Peserta Magang')

@section('sidebar')

@section('content')
<h1 class="header">Profil</h1>

<style>
    .profile-container {
        display: flex;
        height: 100vh;
        background-color: #fdf7f4;
        font-family: 'Roboto', sans-serif;
    }

    .profile-content {
        flex: 1;
        padding: 2rem;
    }

    .profile-header h2,
    .profile-header p {
        color: #3e2c2c;
    }

    .profile-header h2 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .profile-header p {
        font-size: 1.125rem;
    }

    .profile-section {
        margin-top: 1.5rem;
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .profile-section {
            grid-template-columns: 1fr 1fr;
        }
    }

    .profile-label {
        font-style: italic;
        font-size: 0.875rem;
        font-weight: 500;
        color: #4a4a4a;
    }

    .profile-value {
        background-color: #ffccbc;
        color: #3e2c2c;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }

    .edit-button {
        background-color: #ff8a65;
        color: white;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        font-weight: normal;
        transition: background-color 0.3s;
    }

    .edit-button:hover {
        background-color: #ff7043;
        font-weight: bold;
    }
</style>

<div class="profile-container">
    <div class="profile-content">
        <div class="profile-header mb-6">
            <h2>Widiawati Sihaloho</h2>
            <p>24060122120037</p>
        </div>
        <hr class="border-t border-gray-300 mb-6" />
        <div class="profile-section">
            <div>
                <label class="profile-label">Nama</label>
                <p class="profile-value">Widiawati Sihaloho</p>
            </div>
            <div>
                <label class="profile-label">Nomor Telepon</label>
                <p class="profile-value">087832630688</p>
            </div>
            <div>
                <label class="profile-label">Asal Sekolah/Perguruan Tinggi</label>
                <p class="profile-value">Universitas Diponegoro</p>
            </div>
            <div>
                <label class="profile-label">Email</label>
                <p class="profile-value">widiawatis@gmail.com</p>
            </div>
            <div>
                <label class="profile-label">Jurusan</label>
                <p class="profile-value">Informatika</p>
            </div>
        </div>
        <div class="mt-6 text-right">
            <a class="edit-button" href="/mtrEditProfil">
                Edit
            </a>
        </div>
    </div>
</div>

@endsection
