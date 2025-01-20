@extends('layouts.app')

@section('title', 'Pengumpulan Laporan Peserta Magang')

@section('sidebar')

@section('content')
<h1 class="header">Pengumpulan Laporan</h1>

<style>
    .registration-container {
        display: flex;
        height: 100vh;
        background-color: #fdf7f4;
        font-family: 'Roboto', sans-serif;
    }

    .registration-content {
        flex: 1;
        padding: 2rem;
    }

    .registration-header {
        font-size: 2rem;
        font-weight: bold;
        color: #3e2c2c;
    }

    .registration-section {
        margin-top: 1.5rem;
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .registration-section {
            grid-template-columns: 1fr 1fr;
        }
    }

    .registration-label {
        font-style: italic;
        font-size: 0.875rem;
        font-weight: 500;
        color: #4a4a4a;
    }

    .registration-value {
        background-color: #ffccbc;
        color: #3e2c2c;
        border-radius: 0.5rem;
        padding: 4rem 4rem;
        font-size: 1rem;
    }

    .register-button {
        background-color: #ff8a65;
        color: white;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        font-weight: normal;
        transition: background-color 0.3s;
    }

    .register-button:hover {
        background-color: #ff7043;
        font-weight: bold;
    }
</style>

<div class="registration-container">
    <div class="registration-content">
        
        <div class="registration-section">
            <div>
                <label class="registration-label">Laporan Akhir Magang *pdf</label>
                <input type="file" class="registration-value w-full" id="proposal" name="proposal" accept=".pdf">
            </div>

        </div>
        <div class="mt-6 text-right">
            <a class="register-button" href="/mtrEditProfil">
                Submit
            </a>
        </div>
    </div>
</div>

@endsection
