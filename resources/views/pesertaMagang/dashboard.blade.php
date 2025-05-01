@extends('layouts.app')

@section('title', 'Dashboard Peserta Magang')

@section('content')
<h1 class="header mb-20">Beranda</h1>
<p class="mb-6 text-xl" style="margin-left: 40px;">
    Selamat Datang <strong>{{ $pesertaMagang->nama_peserta }}</strong>
</p>

<style>
    .card-custom {
        flex: 1 1 100%;
        padding: 1.5rem;
        background-color: rgba(255, 124, 75, 0.5);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 1rem;
        margin: 10px;
    }

    .card-custom h3 {
        font-size: 1.25rem;
        color: #B31314;
    }

    .container-custom {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-left: 30px;
        margin-right: 30px;
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

    @media (min-width: 768px) {
        .card-custom {
            flex: 1 1 calc(33.33% - 20px);
        }
    }

    @media (max-width: 767.98px) {
        h1.header, p.text-xl {
            margin-left: 20px;
            margin-right: 20px;
        }

        .container-custom {
            flex-direction: column;
            align-items: center;
            margin-left: 10px;
            margin-right: 10px;
        }

        .card-custom {
            width: 100%;
            margin: 10px 0;
        }
    }
</style>

<div class="container-custom">
    <div class="card card-custom">
        <h3>Status Pendaftaran</h3>
        <hr>
        @if ($pesertaMagang)
            @if ($pesertaMagang->status_pendaftaran)
                <p>{{ $pesertaMagang->status_pendaftaran }}</p>

                @if (strtolower($pesertaMagang->status_pendaftaran) === 'disetujui' || strtolower($pesertaMagang->status_pendaftaran) === 'diproses' || strtolower($pesertaMagang->status_pendaftaran) === 'ditolak')
                    <a href="{{ route('dashboard.detailPendaftaran') }}" class="button-detail">Lihat Detail</a>
                @endif
            @endif
        </div>
        <div class="card card-custom">
            <h3>Status Magang</h3>
            <hr>
                <p>{{ $pesertaMagang->status_magang }}</p>
                    @if (strtolower($pesertaMagang->status_magang) === 'aktif')
                        <p><strong>Tanggal Mulai:</strong> {{ $tanggalMulai }}</p>
                        <p><strong>Tanggal Selesai:</strong> {{ $tanggalSelesai }}</p>
                    @else
                        <p>Belum mendaftar</p>
                    @endif
        </div>
        <div class="card card-custom">
            <h3>Status SKL</h3>
            <hr>
            @if ($pesertaMagang && $statusSKL)
                <p>{{ $statusSKL }}</p>
            @else
                <p>Belum mendaftar</p>
            @endif
        </div>
</div>
@endsection
