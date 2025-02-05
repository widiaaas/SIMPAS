@extends('layouts.app')

@section('title', 'Detail Pendaftar')

@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        .card {
            background-color: #fff;
            text-align: start;
            margin-top: 40px;
            margin-left: 40px;
        }
    
        .info-section {
            font-family: 'Inter', sans-serif; /* Terapkan font Inter hanya pada body tabel */
            font-size: 15px;
                display: flex;
                flex-wrap: wrap;
                margin-bottom: 15px;
            }
    
            .info-label {
                width: 35%;
                font-weight: 50;
                font-style: italic;
            }
    
            .info-value {
                width: 65%;
                font-weight:bold;
            }
    
            .buttons {
                display: flex;
                justify-content: flex-start;
                margin-top: 20px;
            }
    
            .btn {
                background-color: #FF885B;
                color: white;
                border: none;
                padding: 10px 20px;
                margin: 0 5px;
                border-radius: 5px;
                text-align: center;
                cursor: pointer;
                font-weight: 500;
            }
    
            .btn:hover {
                background-color: #b53c00;
            }
    
            .btn-container {
                text-align: center;
            }
    </style>
</head>


<h1 class="header">Detail Pendaftar</h1>

<div class="card">
    <div class="info-section">
        <div class="info-label">Nama</div>
        <div class="info-value">{{ $pendaftar->nama }}</div>
    </div>
    
    <div class="info-section">
        <div class="info-label">Sekolah / Universitas</div>
        <div class="info-value">{{ $pendaftar->asal_sekolah }}</div>
    </div>
    
    <div class="info-section">
        <div class="info-label">NIM/NISN</div>
        <div class="info-value">{{ $pendaftar->nip }}</div>
    </div>
    
    <div class="info-section">
        <div class="info-label">Jurusan</div>
        <div class="info-value">{{ $pendaftar->jurusan }}</div>
    </div>
    
    <div class="info-section">
        <div class="info-label">Email</div>
        <div class="info-value">
            <a style="color:#b53c00" href="mailto:{{ $pendaftar->email }}">{{ $pendaftar->email }}</a>
        </div>
    </div>
    
    <div class="info-section">
        <div class="info-label">Dinas Tujuan</div>
        <div class="info-value">{{ $pendaftar->nama_instansi }}</div>
    </div>
    
    <div class="info-section">
        <div class="info-label">Periode</div>
        <div class="info-value">{{ date('d/m/Y', strtotime($pendaftar->tanggal_mulai)) }} - {{ date('d/m/Y', strtotime($pendaftar->tanggal_selesai)) }}</div>
    </div>    

    <div class="buttons">
        <button class="btn">
            <a href="{{ asset('storage/' . $pendaftar->cv) }}" target="_blank">Lihat CV</a>
        </button>
        <button class="btn">
            <a href="{{ asset('storage/' . $pendaftar->proposal) }}" target="_blank">Lihat Proposal</a>
        </button>
        <button class="btn">
            <a href="{{ asset('storage/' . $pendaftar->spkl) }}" target="_blank">Lihat Surat Pengantar</a>
        </button>
    </div>    
</div>

{{-- Untuk PDF --}}
<script>
    function openPdf(url) {
        window.open(url, '_blank');
    }
</script>

@endsection
