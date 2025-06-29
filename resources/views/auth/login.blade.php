<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            position: relative;
            overflow: hidden;
            background-image: url('{{ asset('img/bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: :100vh;
        }

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
            margin: auto;
            max-width: 100%;
            padding: 50px;
            /*margin-top: 110px;*/
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
            box-shadow: none;
        }

        .btn-primary:hover {
            background-color: #FF7733;
            border-color: #FF7733;
            color: white;
        }

        .btn-primary:focus,
        .btn-primary:active {
            background-color: #FF6600;
            border-color: #FF6600;
            outline: none;
            box-shadow: none;
        }

        .btn-primary:focus-visible {
            outline: none;
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

        .card-footer {
            text-align: center;
        }

        /* Responsive adjustments for mobile */
        @media (max-width: 576px) {
            .card-header h2 {
                font-size: 1.5rem;
            }

            .form-control {
                font-size: 0.875rem;
            }

            .logo {
                width: 40px;
            }

            .btn-primary {
                font-size: 0.875rem;
            }

            footer p {
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">


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
                        <h5 class="aoboshi-one-regular">Masuk</h5>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('authenticate') }}" method="POST" autocomplete="on">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label" style="font-style: italic;">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label" style="font-style: italic;">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="card-footer">
                                <h6 style="font-style: italic;">Belum punya akun? <a href="{{ route('daftarakun') }}" style="font-weight: bold;">Daftar sekarang</a></h6>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary aoboshi-one-regular">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer with information -->
    <footer>
        <p>&copy; 2025 All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
