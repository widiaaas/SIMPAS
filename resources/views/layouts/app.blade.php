<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
</head>
<body class="bg-[#fdf7f4] font-roboto">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/4 bg-[#3a2e2b] text-white p-6">
            <ul>
                <li class="mb-4">
                    <a class="block py-2 px-4 bg-[#f28b61] rounded-l-full transform rotate-180" href="#">
                        <span class="transform rotate-180 inline-block text-left w-full">Beranda</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a class="block py-2 px-4" href="#">
                        Profil
                    </a>
                </li>
                <li class="mb-4">
                    <a class="block py-2 px-4" href="#">
                        Daftar Peserta
                    </a>
                </li>
                <li class="mb-4">
                    <a class="block py-2 px-4" href="#">
                        Penilaian
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-3/4 p-8 rounded-tl-[30px] rounded-bl-[30px] bg-white">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-[#b12a2f]">@yield('page_title', 'Dashboard')</h2>
                <div class="text-right">
                    <p class="text-sm">@yield('sub_title', 'Selamat datang di aplikasi')</p>
                    <img alt="Logo" class="inline-block" src="https://placehold.co/50x50"/>
                </div>
            </div>

            <p class="text-xl mb-4">
                Selamat Datang,
                <span class="font-bold text-[#b12a2f]">@yield('username', 'User Name')</span>!
            </p>

            @yield('content')

        </div>
    </div>
</body>
</html>
