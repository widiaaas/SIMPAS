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


@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($pesertaMagang->status_pendaftaran == 'Diproses')
    <div class="alert alert-warning mt-3" style="font-size: 20px;" >
        <br>
        Pendaftaran magang sudah ditutup karena pendaftaran anda sedang <strong>{{ $pesertaMagang->status_pendaftaran }}</strong>.
    </div>
@elseif ($pesertaMagang->status_pendaftaran == 'Disetujui' && $pesertaMagang->status_skl == 'Belum diterbitkan')
    <div class="alert alert-warning mt-3" style="font-size: 20px;" >
        <br>
        Pendaftaran magang sudah ditutup karena status pendaftaran anda sudah <strong>{{ $pesertaMagang->status_pendaftaran }}</strong>.
    </div>
@else
    <!-- Form Pendaftaran Magang -->
    <form id="pendaftaranForm" method="POST" action="{{ route('pendaftaran.magang.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="registration-container">
            <div class="registration-content">
                <div class="registration-section">
                    <div>
                        <label class="registration-label">Dinas Dituju</label>
                        <select class="registration-value w-full" name="dinas" required>
                            <option value="" disabled selected>Pilih Dinas</option>
                            @forelse ($instansis as $instansi)
                                <option value="{{ $instansi->kode_instansi }}">{{ $instansi->nama_instansi }}</option>
                            @empty
                                <option value="" disabled>Tidak ada data instansi tersedia.</option>
                            @endforelse
                        </select>
                    </div>

                    <div>
                        <label class="registration-label">Surat Pengantar (.Pdf)</label>
                        <input type="file" class="registration-value w-full @error('spkl') is-invalid @enderror" id="spkl" name="spkl" accept=".pdf" required>
                        @error('spkl')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small class="registration-label">Maksimal ukuran file: 1 MB</small>
                    </div>

                    <div>
                        <label class="registration-label">Tanggal Mulai Magang</label>
                        <input type="date" class="registration-value w-full" id="tanggal_mulai" name="tanggal_mulai" required>
                    </div>

                    <div>
                        <label class="registration-label">CV (.Pdf)</label>
                        <input type="file" class="registration-value w-full @error('cv') is-invalid @enderror" id="cv" name="cv" accept=".pdf" required>
                        @error('cv')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small class="registration-label">Maksimal ukuran file: 1 MB</small>

                    </div>

                    <div>
                        <label class="registration-label">Tanggal Selesai Magang</label>
                        <input type="date" class="registration-value w-full" id="tanggal_selesai" name="tanggal_selesai" required>
                    </div>

                    <div>
                        <label class="registration-label">Proposal (.Pdf)</label>
                        <input type="file" class="registration-value w-full @error('proposal') is-invalid @enderror" id="proposal" name="proposal" accept=".pdf" required>
                        @error('proposal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small class="registration-label">Maksimal ukuran file: 100 MB</small>

                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" class="register-button">
                        Daftar
                    </button>
                </div>
            </div>
        </div>
    </form>
@endif


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('pendaftaranForm');

        function validateFileSize(fileInput, maxSizeMB) {
            const files = fileInput.files;
            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    const fileSizeMB = files[i].size / (1024 * 1024);
                    if (fileSizeMB > maxSizeMB) {
                        Swal.fire({
                            title: "Ukuran File Terlalu Besar!",
                            text: File harus lebih kecil dari ${maxSizeMB} MB. Ukuran file saat ini adalah ${fileSizeMB.toFixed(2)} MB.,
                            icon: "warning",
                            confirmButtonText: "OK"
                        });
                        fileInput.value = "";
                        return false;
                    }
                }
            }
            return true;
        }

        function validateDateRange() {
            const tanggalMulai = document.getElementById('tanggal_mulai');
            const tanggalSelesai = document.getElementById('tanggal_selesai');

            const today = new Date().toISOString().split('T')[0]; // Tanggal hari ini

            // Validasi tanggal mulai
            if (tanggalMulai.value < today) {
                Swal.fire({
                    title: "Tanggal Mulai Tidak Valid!",
                    text: "Tanggal mulai tidak boleh lebih kecil dari hari ini.",
                    icon: "warning",
                    confirmButtonText: "OK"
                });
                tanggalMulai.value = "";
                return false;
            }

            // Validasi durasi minimal 30 hari antara tanggal mulai dan selesai
            const startDate = new Date(tanggalMulai.value);
            const endDate = new Date(tanggalSelesai.value);
            const diffTime = endDate - startDate;
            const diffDays = diffTime / (1000 * 3600 * 24);

            if (diffDays < 30) {
                Swal.fire({
                    title: "Durasi Tanggal Tidak Valid!",
                    text: "Durasi antara tanggal mulai dan tanggal selesai minimal 30 hari.",
                    icon: "warning",
                    confirmButtonText: "OK"
                });
                tanggalSelesai.value = "";
                return false;
            }

            return true;
        }

        // Event listeners untuk validasi file upload
        document.getElementById('spkl').addEventListener('change', function () {
            validateFileSize(this, 1);
        });
        document.getElementById('cv').addEventListener('change', function () {
            validateFileSize(this, 1);
        });
        document.getElementById('proposal').addEventListener('change', function () {
            validateFileSize(this, 100);
        });

        // Menetapkan tanggal minimum untuk input tanggal mulai dan tanggal selesai
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal_mulai').setAttribute('min', today);
        document.getElementById('tanggal_selesai').setAttribute('min', today);

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            let valid = true;

            // Validasi file upload
            if (!validateFileSize(document.getElementById('spkl'), 1)) valid = false;
            if (!validateFileSize(document.getElementById('cv'), 1)) valid = false;
            if (!validateFileSize(document.getElementById('proposal'), 100)) valid = false;

            // Validasi tanggal
            if (!validateDateRange()) valid = false;

            if (!valid) return;

            Swal.fire({
                title: 'Konfirmasi Pendaftaran',
                text: 'Apakah Anda yakin ingin mendaftar magang?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, daftar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Menampilkan pesan sukses atau error
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if($errors->any())
            Swal.fire({
                title: 'Error!',
                text: '{{ $errors->first() }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>

@endsection