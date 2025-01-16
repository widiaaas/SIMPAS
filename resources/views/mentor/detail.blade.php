<html>
    <head>
    <title>Detail Peserta - SIMPAS </title>
     <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Aoboshi+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

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
    </style>
    </head>
<body class="bg-[#fdf7f4] inter-font">
    <div class="flex h-screen">
    <!-- Sidebar -->
    <x-sidebar-mentor></x-sidebar-mentor>
    <!--main content-->
    <div class="w-screen p-8 rounded-tl-[30px] rounded-bl-[30px] bg-[#fdf7f4] overflow-auto">
        <div class="mb-8">
            <a class="text-[#282A4C] text-lg mb-4 block inter-font font-bold" href="/mentor/daftarPeserta">
                <i class="fas fa-arrow-left">
                </i>
                Kembali
            </a>
        </div>
        <div class="flex justify-between items-center">
            <h2 class="text-2xl aoboshi-one-regular font-bold text-[#b12a2f]">
               Detail Peserta Magang
            </h2>
            <div class="flex items-center justify-end">
                <div class="text-right">
                    <p class="aoboshi-one-regular text-sm text-[#b12a2f]">Pemerintah Kota</p>
                    <p class="aoboshi-one-regular text-sm text-[#b12a2f]">Semarang</p>
                </div>
                <img src="{{asset('img/pemkot.png')}}" class="ml-2" width="30" alt="Logo Pemerintah Kota Semarang" />
                </div>
            </div>
        <div class="mt-2 bg-[#FEF7F4] rounded-lg p-14">
            <div class="space-y-4">
            <div class="flex space-x-4 justify-between">
              <div>
                <p class="text-sm font-semibold text-gray-600">Nama:</p>
                <p class="text-lg font-medium">Widiawati Sihaloho</p>
              </div>
              <div >
                <p class="text-sm font-semibold text-gray-600">Detail CV:</p>
                <button class=" px-9 py-2 bg-[#282a4c] text-white rounded-lg hover:bg-blue-600 transition">
                  Lihat CV
                </button>
              </div>
            </div>
            <div class="flex space-x-4 justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Sekolah/Universitas Asal:</p>
                    <p class="text-lg font-medium">Universitas Diponegoro</p>
                  </div>
                <div >
                  <p class="text-sm font-semibold text-gray-600">Detail Proposal:</p>
                  <button class=" px-4 py-2 bg-[#282a4c] text-white rounded-lg hover:bg-blue-600 transition">
                    Lihat Proposal
                  </button>
                </div>
              </div>
              <div>
                <p class="text-sm font-semibold text-gray-600">NIM/NISN:</p>
                <p class="text-lg font-medium">24060122130037</p>
              </div>
              <div>
                <p class="text-sm font-semibold text-gray-600">Jurusan:</p>
                <p class="text-lg font-medium">Informatika</p>
              </div>
              <div>
                <p class="text-sm font-semibold text-gray-600">Email:</p>
                <p class="text-lg font-medium">widiawatiscollege@gmail.com</p>
              </div>
              <div>
                <p class="text-sm font-semibold text-gray-600">Diterima Magang di:</p>
                <p class="text-lg font-medium">Dinas Komunikasi, Informasi, Statistik, dan Persandian Kota Semarang</p>
              </div>
              <div>
                <p class="text-sm font-semibold text-gray-600">Bidang:</p>
                <p class="text-lg font-medium">Statistik</p>
              </div>
              <div class="flex space-x-4">
                <div>
                  <p class="text-sm font-semibold text-gray-600">Tanggal Mulai:</p>
                  <p class="text-lg font-medium">02/01/2025</p>
                </div>
                <div>
                  <p class="text-sm font-semibold text-gray-600">Tanggal Selesai:</p>
                  <p class="text-lg font-medium">12/02/2025</p>
                </div>
              </div>
            </div>
        </div>
    </div>
</body>