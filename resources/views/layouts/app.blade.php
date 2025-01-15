<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard ')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Aoboshi+One&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Aoboshi One', sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #403333;
            color: #fff;
            position: fixed;
            height: 100vh;
            padding: 20px 0;
        }
        .sidebar a {
            width: 200px;
            text-decoration: none;
            color: #fff;
            display: block;
            padding: 10px 20px;
            font-weight: normal;
            
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #FF885B;
            border-radius: 0 50px 50px 0;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #FDF2EE;
            height: 100vh;
            
        }
        .card {
            background-color: #FFDED5;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }
        .card h3 {
            margin: 0;
            color: #b22222;
        }
        .card p {
            margin: 5px 0;
            font-size: 18px;
    
        }
        .header {
            color: #B22222;
        }

        .corner-text {
            position: fixed;
            margin-left: 10px;
            font-size: 16px;
            color: #b22222;
            top: 30px; 
            right: 122px; 
            width: 80px;
        }

        .corner-text2 {
            position: fixed;
            margin-left: 10px;
            font-size: 16px;
            color: #b22222;
            top: 50px; 
            right: 130px; 
            width: 80px;
            white-space: nowrap; 
        }

        img.corner-image {
            position: fixed;
            top: 20px; 
            right: 20px; 
            width: 50px; 
            height: auto; 
            z-index: 999; 
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a>
        <a href="/profil" class="{{ Request::is('profil') ? 'active' : '' }}">Profil</a>
        <a href="/daftar-magang" class="{{ Request::is('daftar-magang') ? 'active' : '' }}">Daftar Magang</a>
        <a href="/skl" class="{{ Request::is('skl') ? 'active' : '' }}">SKL</a>
        @yield('sidebar')
    </div>
    <div class="content">
        <span class="corner-text">Pemerintahan</span>
        <span class="corner-text2">Kota Semarang</span>
        <img src="/img/pemkot.png" alt="Logo Pemkot Semarang" class="corner-image">
        @yield('content')
    </div>
</body>
</html>
