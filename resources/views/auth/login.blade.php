<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%; 
            margin: 0; 
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative; 
            overflow: hidden; 
            background-image: url('{{ asset('img/bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            margin: auto;  
            max-width: 1000px;
            padding: 50px;
            margin-top: 110px;
        }

        /* Dark overlay */
        .overlay {
            position: absolute;
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
            max-width: 400px;
            z-index: 1; 
        }

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

        .form-control {
            background-color: rgba(255, 136, 91, 0.25); 
            border: 2px solid #FF885B; 
            color: #403333;
        }

        .btn-primary {
            border-radius: 20px;
            font-weight: bold;
            background-color: #FF885B;
            border-color: #FF885B;
            outline: none;
            box-shadow: none; /* Menghilangkan shadow biru */
        }

        .btn-primary:hover {
            background-color: #FF7733; /* Sedikit lebih gelap dari warna awal */
            border-color: #FF7733;
            color: white;
        }

        .btn-primary:focus,
        .btn-primary:active {
            background-color: #FF6600; /* Tetap dengan warna yang sama */
            border-color: #FF6600; 
            outline: none; /* Menghilangkan outline biru */
            box-shadow: none; /* Menghilangkan shadow */
        }

        .btn-primary:focus-visible {
            outline: none; /* Hilangkan outline biru */
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
            position: absolute;
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
            padding: 10px 15px;
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
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header">
                        <h2>SIMPAS</h2>
                        <img src="{{ asset('img/pemkot.png') }}" alt="Logo" class="logo">
                        <h5>Masuk</h5>
                    </div>
                    <div class="card-body">
                        <!-- @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif -->
                        <form action="{{ route('login') }}" method="POST" autocomplete="on">
                            @csrf
                            <div class="mb-3">
                                <label for="nim" class="form-label">Nim</label>
                                <input type="nim" name="nim" id="nim" class="form-control" required value="{{ old('nim') }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="card-footer">
                                {{-- nanti route Daftar sekarang ganti ke page daftar --}}
                                <h9>Belum punya akun? <a href="{{ route('login') }}" style="font-weight: bold;">Daftar sekarang</a></h9>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Masuk</button>
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
</body>
</html>