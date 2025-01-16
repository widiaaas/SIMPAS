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
                    <option value="Dispang">Dinas Ketahanan Pangan</option>
                    <option value="DLH">Dinas Lingkungan Hidup</option>
                    <option value="Dinas A">Dinas Arsip dan Perpustakaan</option>
                    <option value="Dinas B">Dinas Perdagangan</option>
                    <option value="Dinas C">Dinas Perindustrian</option>
                    <option value="Dinas A">Dinas Sosial</option>
                    <option value="Disnaker">Dinas Tenaga Kerja</option>
                    <option value="Dinas C">Dinas Kepemudaan dan Olahraga</option>
                    <option value="Diper">Dinas Perikanan</option>
                    <option value="Diskes">Dinas Kesehatan</option>
                    <option value="Dispen">Dinas Pendidikan</option>
                </select>
            </div>
            <div>
                <label class="registration-label">Surat Pengantar</label>
                <input type="file" class="registration-value w-full" id="suratpengantar" name="suratpengantar" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
            </div>

            <div>
                <label class="registration-label">Bidang Dituju</label>
                <select class="registration-value w-full" id="bidang">
                    <option value="" disabled selected>Pilih Bidang</option>
                </select>
            </div>
            <script>
                function updateBidang() {
                    const dinas = document.getElementById('dinas').value;
                    const bidang = document.getElementById('bidang');

                    bidang.innerHTML = '<option value="" disabled selected>Pilih Bidang</option>';

                    let bidangOptions = [];

                    // Tentukan opsi bidang berdasarkan dinas yang dipilih
                    if (dinas === 'Disperkim') {
                        bidangOptions = ['Bidang Perumahan', 'Bidang Kawasan Permukiman'];
                    } else if (dinas === 'DPU') {
                        bidangOptions = ['Bidang Infrastruktur', 'Bidang Jalan Raya'];
                    } else if (dinas === 'Dishub') {
                        bidangOptions = ['Bidang Transportasi Umum', 'Bidang Angkutan Jalan'];
                    } else if (dinas === 'DPMPTSP') {
                        bidangOptions = ['Bidang Penanaman Modal', 'Bidang Pelayanan Terpadu'];
                    } else if (dinas === 'Dispang') {
                        bidangOptions = ['Bidang Ketahanan Pangan', 'Bidang Pertanian'];
                    } else if (dinas === 'DLH') {
                        bidangOptions = ['Bidang Lingkungan Hidup', 'Bidang Pengelolaan Sampah'];
                    } else if (dinas === 'DinasA') {
                        bidangOptions = ['Bidang Arsip', 'Bidang Perpustakaan'];
                    } else if (dinas === 'DinasB') {
                        bidangOptions = ['Bidang Perdagangan', 'Bidang Distribusi'];
                    } else if (dinas === 'DinasC') {
                        bidangOptions = ['Bidang Industri', 'Bidang Pengembangan Usaha'];
                    } else if (dinas === 'DinasSosial') {
                        bidangOptions = ['Bidang Kesejahteraan Sosial', 'Bidang Perlindungan Anak'];
                    } else if (dinas === 'Disnaker') {
                        bidangOptions = ['Bidang Tenaga Kerja', 'Bidang Pelatihan Kerja'];
                    } else if (dinas === 'DinasOlahraga') {
                        bidangOptions = ['Bidang Kepemudaan', 'Bidang Olahraga'];
                    } else if (dinas === 'Diper') {
                        bidangOptions = ['Bidang Perikanan', 'Bidang Kelautan'];
                    } else if (dinas === 'Diskes') {
                        bidangOptions = ['Bidang Kesehatan Umum', 'Bidang Kesehatan Masyarakat'];
                    } else if (dinas === 'Dispen') {
                        bidangOptions = ['Bidang Pendidikan', 'Bidang Pengajaran'];
                    }

                    // Tambahkan opsi bidang yang sesuai
                    for (const option of bidangOptions) {
                        const newOption = document.createElement('option');
                        newOption.value = option;
                        newOption.textContent = option;
                        bidang.appendChild(newOption);
                    }
                }
            </script>
            <div>
                <label class="registration-label">Tanggal Mulai Magang</label>
                <input type="date" class="registration-value w-full" id="tanggal_mulai" name="tanggal_mulai">
            </div>

            <div>
                <label class="registration-label">CV</label>
                <input type="file" class="registration-value w-full" id="cv" name="cv" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
            </div>
            <div>
                <label class="registration-label">Tanggal Selesai Magang</label>
                <input type="date" class="registration-value w-full" id="tanggal_selesai" name="tanggal_mulai">
            </div>

            <div>
                <label class="registration-label">Proposal</label>
                <input type="file" class="registration-value w-full" id="proposal" name="proposal" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
            </div>

        </div>
        <div class="mt-6 text-right">
            <a class="register-button" href="/mtrEditProfil">
                Daftar
            </a>
        </div>
    </div>
</div>

@endsection
