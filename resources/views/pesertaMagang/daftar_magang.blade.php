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

<!-- Form Pendaftaran Magang -->
<form method="POST" action="{{ route('pendaftaran.magang.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="registration-container">
        <div class="registration-content"> 
            <div class="registration-section">
                <div>
                    <label class="registration-label">Dinas Dituju</label>
                    <select class="registration-value w-full" name="dinas" required>
                        <option value="" disabled selected>Pilih Dinas</option>
                        @if(isset($instansis) && count($instansis) > 0)
                            @foreach($instansis as $instansi)
                                <option value="{{ $instansi->kode_instansi }}">{{ $instansi->nama_instansi }}</option>
                            @endforeach
                        @else
                            <option value="" disabled>Tidak ada data instansi tersedia.</option>
                        @endif
                    </select>
                </div>

                <div>
                    <label class="registration-label">Surat Pengantar</label>
                    <input type="file" class="registration-value w-full @error ('spkl') is-invalid @enderror" id="spkl" name="spkl" accept=".pdf">
                    @error('spkl')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div>
                    <label class="registration-label">Tanggal Mulai Magang</label>
                    <input type="date" class="registration-value w-full" id="tanggal_mulai" name="tanggal_mulai">
                </div>

                <div>
                    <label class="registration-label">CV</label>
                    <input type="file" class="registration-value w-full @error('cv') is-invalid @enderror" id="cv" name="cv" accept=".pdf">
                    @error('cv')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label class="registration-label">Tanggal Selesai Magang</label>
                    <input type="date" class="registration-value w-full" id="tanggal_selesai" name="tanggal_selesai">
                </div>

                <div>
                    <label class="registration-label">Proposal</label>
                    <input type="file" class="registration-value w-full @error('proposal') is-invalid @enderror" id="proposal" name="proposal" accept=".pdf">
                    @error('proposal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function to validate file size
    function validateFileSize(fileInput, maxSizeMB) {
        const files = fileInput.files;
        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                const fileSizeMB = files[i].size / (1024 * 1024); // Convert file size to MB
                if (fileSizeMB > maxSizeMB) {
                    Swal.fire({
                        title: "Ukuran File Terlalu Besar!",
                        text: `File harus lebih kecil dari ${maxSizeMB} MB. Ukuran file saat ini adalah ${fileSizeMB.toFixed(2)} MB.`,
                        icon: "warning",
                        confirmButtonText: "OK"
                    });
                    fileInput.value = ""; // Reset file input if the file is too large
                    return false;
                }
            }
        }
        return true;
    }

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('pendaftaranForm');

        // size validation
        document.getElementById('spkl').addEventListener('change', function () {
            validateFileSize(this, 1); // Maximum 1 MB for Surat Pengantar
        });

        document.getElementById('cv').addEventListener('change', function () {
            validateFileSize(this, 1); // Maximum 1 MB for CV
        });

        document.getElementById('proposal').addEventListener('change', function () {
            validateFileSize(this, 100); // Maximum 100 MB for Proposal
        });

        // Handle form submission
        form.addEventListener('submit', function (event) {
            let valid = true;

            // Validate file sizes
            if (!validateFileSize(document.getElementById('spkl'), 1)) valid = false;
            if (!validateFileSize(document.getElementById('cv'), 1)) valid = false;
            if (!validateFileSize(document.getElementById('proposal'), 100)) valid = false;

            if (!valid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });

        // SweetAlert for success message
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        // SweetAlert for error messages
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
