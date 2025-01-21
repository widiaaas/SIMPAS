@extends('layouts.app')

@section('title', 'Dashboard Peserta Magang')

@section('sidebar')

@section('content')
<h1 class="header">Pendaftaran Magang</h1>

<!-- CSS Khusus untuk Konten ini -->
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
        padding: 0.5rem 1rem;
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
                <label class="registration-label">Dinas Dituju</label>
                <select class="registration-value w-full">
                    <option value="" disabled selected>Pilih Dinas</option>
                    <option value="Disperkim">Dinas Perumahan dan Kawasan Permukiman</option>
                    <option value="DPU">Dinas Pekerjaan Umum </option>
                    <option value="Dishub">Dinas Perhubungan</option>
                    <option value="DPMPTSP">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</option>
                    <option value="DKP">Dinas Ketahanan Pangan</option>
                    <option value="DLH">Dinas Lingkungan Hidup</option>
                    <option value="Disarpus">Dinas Arsip dan Perpustakaan</option>
                    <option value="Disperindag">Dinas Perdagangan</option>
                    <option value="Disperin">Dinas Perindustrian</option>
                    <option value="Dinsos">Dinas Sosial</option>
                    <option value="Disnaker">Dinas Tenaga Kerja</option>
                    <option value="Dispora">Dinas Kepemudaan dan Olahraga</option>
                    <option value="Dispi">Dinas Perikanan</option>
                    <option value="Dinkes">Dinas Kesehatan</option>
                    <option value="Disdik">Dinas Pendidikan</option>
                </select>
            </div>
            <div>
                <label class="registration-label">Surat Pengantar</label>
                <input type="file" class="registration-value w-full" id="suratpengantar" name="suratpengantar" accept=".pdf">
            </div>

            
            <div>
                <label class="registration-label">Tanggal Mulai Magang</label>
                <input type="date" class="registration-value w-full" id="tanggal_mulai" name="tanggal_mulai">
            </div>

            <div>
                <label class="registration-label">CV</label>
                <input type="file" class="registration-value w-full" id="cv" name="cv" accept=".pdf">
            </div>
            <div>
                <label class="registration-label">Tanggal Selesai Magang</label>
                <input type="date" class="registration-value w-full" id="tanggal_selesai" name="tanggal_mulai">
            </div>

            <div>
                <label class="registration-label">Proposal</label>
                <input type="file" class="registration-value w-full" id="proposal" name="proposal" accept=".pdf">
            </div>

        </div>
        <div class="mt-6 text-right">
            <a class="register-button" href="/mtrEditProfil">
                Daftar
            </a>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk validasi ukuran file
    function validateFileSize(fileInput, maxSizeMB) {
        const file = fileInput.files[0];
        if (file) {
            const fileSizeMB = file.size / (1024 * 1024); // Mengonversi ukuran file ke MB
            if (fileSizeMB > maxSizeMB) {
                alert(`File harus lebih kecil dari ${maxSizeMB} MB`);
                fileInput.value = ''; // Reset file input jika ukuran terlalu besar
            }
        }
    }

    // Menambahkan event listener untuk file input
    document.getElementById('suratpengantar').addEventListener('change', function() {
        validateFileSize(this, 1); // Maksimum 1 MB untuk Surat Pengantar
    });

    document.getElementById('cv').addEventListener('change', function() {
        validateFileSize(this, 1); // Maksimum 1 MB untuk CV
    });

    document.getElementById('proposal').addEventListener('change', function() {
        validateFileSize(this, 100); // Maksimum 100 MB untuk Proposal
    });
</script>
@endsection
