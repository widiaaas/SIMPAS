<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Aoboshi+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
        
        html, body {
            height: 100%; 
            margin: 0; 
        }

        body {
            font-family: "Inter", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Memastikan konten memenuhi tinggi viewport */
            position: relative;
            background-image: url('{{ asset('img/bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
        }

        // <uniquifier>: Use a unique and descriptive class name
        // <weight>: Use a value from 100 to 900

        .inter-font {
            font-family: "Inter", serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }
        .aoboshi-one-regular {
            font-family: "Aoboshi One", serif;
            font-weight: 400;
            font-style: normal;
        }

        .container {
            width: 100%;
            max-width: 1200px; /* Lebar maksimum yang lebih besar */
            margin-top: 100px;
            margin-bottom: 100px;
        }

        /* Dark overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(254, 247, 244, 0.5); 
            z-index: -1; 
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 4000px;
            z-index: 1;
        }
/* 
        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        } */

        .card-header h2 {
            font-weight: bold; 
            color: rgba(64, 51, 51, 1); 
        }

        .card-header {
            border-radius: 10px 10px 0 0;
            background-color: #FEF7F4; 
            color: black;
            text-align: center;
            text-emphasis: none;
        }

        .btn-daftar {
            border-radius: 20px;
            color:#FEF7F4;
            font-weight: bold;
            background-color: #FF885B;
            border-color: #FF885B;
            outline: none;
            box-shadow: none; /* Menghilangkan shadow biru */
        }

        .btn-daftar:hover {
            background-color: #b53c00d1; /* Sedikit lebih gelap dari warna awal */
            border-color: #b53c00d1;
            color: white;
        }

        .btn-daftar:focus,
        .btn-daftar:active {
            background-color: #FF6600; /* Tetap dengan warna yang sama */
            border-color: #FF6600;
        }

        .logo {
            width: 50px;
            height: auto;
            margin-bottom: 10px;
        }

        .alert {
            font-size: 0.875rem; 
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #403333; 
            color: white; 
            box-shadow: 0px -1px 5px rgba(0, 0, 0, 0.1); 
            border-top: 2px solid #FEF7F4; 
            padding: 10px 0; 
            text-align: center;
            font-size: 0.875rem;
            z-index: 1; 
        }

        footer p {
            margin: 0;
        }
        
        .form-control {
            border-radius: 20px;
            padding: 5px;
            max-width: 100%;
            background-color: rgba(255, 136, 91, 0.25); 
            border: 2px #FF885B; 
        }
        .card-footer{
            text-align: center;
        }

    </style>
</head>

<body>

    <!-- Dark overlay -->
    <div class="overlay"></div>

    <!-- Main container for centering -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header">
                        <h2>SIMPAS</h2>
                        <img src="{{ asset('img/pemkot.png') }}" alt="Logo" class="logo">
                        <h5 class="aoboshi-one-regular">Daftar</h5>
                    </div>
                    <div class="card-body">
                    @if(session('status') == 'success')
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Registrasi Berhasil!',
                                text: "{{ session('message') }}",
                                confirmButtonColor: '#FF885B',
                            }).then(() => {
                                window.location.href = "{{ route('login') }}";
                            });
                        </script>
                    @endif

                    @if(session('status') == 'error')
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan!',
                                text: "{{ session('message') }}",
                                confirmButtonColor: '#FF885B',
                            });
                        </script>
                    @endif
                        <form id="registerForm" action="{{ route('register') }}" method="POST" autocomplete="on">
                            @csrf
                            <div class="mb-3">
                                <label for="nip_peserta" class="form-label" style="font-style: italic;">NIP/NISN</label>
                                <input type="text" name="nip_peserta" id="nip_peserta" class="form-control" required value="{{ old('nip_peserta') }}">
                        
                                <label for="nama_peserta" class="form-label" style="font-style: italic;">Nama Lengkap</label>
                                <input type="text" name="nama_peserta" id="nama_peserta" class="form-control" required value="{{ old('nama_peserta') }}">
                        
                                <label for="email" class="form-label" style="font-style: italic;">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                        
                                <label for="no_telp_peserta" class="form-label" style="font-style: italic;">Nomor Telepon</label>
                                <input type="text" name="no_telp_peserta" id="no_telp_peserta" class="form-control" required value="{{ old('no_telp_peserta') }}">
                                
                                <label for="alamat_peserta" class="form-label" style="font-style: italic;">Alamat</label>
                                <input type="text" name="alamat_peserta" id="alamat_peserta" class="form-control" required value="{{ old('alamat_peserta') }}">
                        
                                <label for="asal_sekolah" class="form-label" style="font-style: italic;">Asal Sekolah / Perguruan Tinggi</label>
                                <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" required value="{{ old('asal_sekolah') }}">
                        
                                <label for="jurusan" class="form-label" style="font-style: italic;">Jurusan</label>
                                <input type="text" name="jurusan" id="jurusan" class="form-control" required value="{{ old('jurusan') }}">
                        
                                <label for="password" class="form-label" style="font-style: italic;">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                        
                                <label for="password_confirmation" class="form-label" style="font-style: italic;">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-daftar aoboshi-one-regular">Daftar</button>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer with information -->
    <footer>
        <!-- <p>Hand-crafted & Made with ❤️ by Kelompok 6</p> -->
        <p>&copy; 2025 All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Pendaftaran',
                text: 'Apakah Anda yakin dengan data yang Anda isi?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#FF885B',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, daftar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>




</html>