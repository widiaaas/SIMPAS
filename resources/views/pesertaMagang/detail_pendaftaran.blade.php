@extends('layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content') 
<h1 class="header mb-20">Detail Pendaftaran</h1>

<div class="detail-container">
    <h2 class="section-title">Informasi Pendaftaran</h2>
    <table class="detail-table">
        <tr>
            <th>Nama</th>
            <td>{{ $pesertaMagang->nama_peserta }}</td>
        </tr>
        <tr>
            <th>Asal Sekolah/Universitas</th>
            <td>{{ $pesertaMagang->asal_sekolah }}</td>
        </tr>
        <tr>
            <th>Tanggal Pendaftaran</th>
            <td>{{ $pendaftaranMagang->created_at -> format('d-m-Y')}}</td>
        </tr>
        <tr>
            <th>Instansi</th>
            <td>{{ $instansi->nama_instansi }}</td>
        </tr>
        <tr>
            <th>Tanggal Mulai Magang</th>
            <td>{{ $pendaftaranMagang->tanggal_mulai }}</td>
        </tr>
        <tr>
            <th>Tanggal Selesai Magang</th>
            <td>{{ $pendaftaranMagang->tanggal_selesai}}</td>
        </tr>
        <tr>
            <th>Status Pendaftaran</th>
            <td>
                <span class="status 
                    @if($pesertaMagang->status_pendaftaran == 'Disetujui') accepted 
                    @elseif($pesertaMagang->status_pendaftaran == 'Ditolak') rejected 
                    @else processing 
                    @endif">
                    {{ $pesertaMagang->status_pendaftaran }}
                </span>
            </td>
        </tr>
        <tr>
        @if ($pesertaMagang->status_pendaftaran !== 'Diproses')
            <tr>
                <th>Alasan</th>
                @if ($pesertaMagang->status_pendaftaran === 'Disetujui')
                    <td>Berkas-berkas sudah disetujui</td>
                @else
                    <td>{{ $pendaftaranMagang->alasan }}</td>
                @endif
            </tr>
        @endif
        </tr>
        @if($pesertaMagang->status_pendaftaran != 'Ditolak' || $pesertaMagang->status_pendaftaran != 'Diproses')
            <tr>
                <th>Mentor</th>
                <td>{{ $pesertaMagang->mentor->nama ?? 'Belum ditentukan' }}</td>
            </tr>
            <tr>
                <th>Kontak Mentor</th>
                <<td>{{ $pesertaMagang->mentor->nomor_telp ?? 'Belum ditentukan' }}</td>
            </tr>
        @endif
    </table>

    <a href="{{ route('pesertaMagang.dashboard') }}" class="back-button">Kembali ke Dashboard</a>
</div>

<style>
    .detail-container {
        margin: 0 auto;
        max-width: 800px;
        background: #fdfdfd;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 20px;
    }

    .detail-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .detail-table th, 
    .detail-table td {
        text-align: left;
        padding: 10px 15px;
        border-bottom: 1px solid #ddd;
    }

    .detail-table th {
        background-color: #f9f9f9;
        font-weight: bold;
    }

    .status {
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .status.accepted {
        color: #fff;
        background-color: #4caf50; /* Hijau untuk diterima */
    }

    .status.rejected {
        color: #fff;
        background-color: #f44336; /* Merah untuk ditolak */
    }

    .status.processing {
        color: #fff;
        background-color: #ff9800; /* Oranye untuk diproses */
    }

    .back-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #B31314;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .back-button:hover {
        background-color: #800000;
    }
</style>
@endsection
