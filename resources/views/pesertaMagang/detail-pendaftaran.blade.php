@extends('layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content')
<h1 class="header mb-20">Detail Pendaftaran</h1>

<div class="detail-container">
    <h2 class="section-title">Informasi Pendaftaran</h2>
    <table class="detail-table">
        <tr>
            <th>Nama</th>
            <td>Widiawati Sihaloho</td>
        </tr>
        <tr>
            <th>Asal Sekolah/Universitas</th>
            <td>Universitas Diponegoro</td>
        </tr>
        <tr>
            <th>Tanggal Pendaftaran</th>
            <td>02-01-2025</td>
        </tr>
        <tr>
            <th>Dinas</th>
            <td>Dinas Pendidikan</td>
        </tr>
        <tr>
            <th>Tanggal Mulai Magang</th>
            <td>02-01-2025</td>
        </tr>
        <tr>
            <th>Tanggal Selesai Magang</th>
            <td>13-02-2025</td>
        </tr>
        <tr>
            <th>Status Pendaftaran</th>
            <td><span class="status accepted">Diterima</span></td>
        </tr>
        <tr>
            <th>Alasan</th>
            <td>Diterima karena memenuhi persyaratan.</td>
        </tr>
        <tr>
            <th>Mentor</th>
            <td>Arif Kurnia Rachman</td>
        </tr>
        <tr>
            <th>Kontak Mentor</th>
            <td>0824392852</td>
        </tr>
    </table>

    <a href="/pesertaMagang/dashboard" class="back-button">Kembali ke Dashboard</a>
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
