<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta Magang - SIMPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
<body class="bg-[#fdf7f4] font-roboto">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <x-sidebar-mentor></x-sidebar-mentor>
        <!-- Main Content -->
        <div class="w-screen p-8 rounded-tl-[30px] rounded-bl-[30px] bg-[#fdf7f4]">
            <div class="mb-8">
                <!-- Header -->
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl aoboshi-one-regular font-bold text-[#b12a2f]">
                        Penilaian Peserta Magang
                    </h2>
                    <div class="flex items-center justify-end">
                        <div class="text-right">
                            <p class="aoboshi-one-regular text-sm text-[#b12a2f]">Pemerintah Kota</p>
                            <p class="aoboshi-one-regular text-sm text-[#b12a2f]">Semarang</p>
                        </div>
                        <img src="{{asset('img/pemkot.png')}}" class="ml-2" width="30" alt="Logo Pemerintah Kota Semarang" />
                    </div>
                </div>
                
                <!-- Kolom Pencarian -->
                <div class="mt-4 mb-6 inter-font">
                    <div class="flex items-center">
                        <input 
                            type="text" 
                            placeholder="Cari Nama / Institusi Peserta" 
                            class=" bg-[#EBE4E1] p-2 border border-gray-300 rounded-l-md w-full md:w-1/2" 
                        />
                        <button class="bg-[#B23A3A] p-3 rounded-r-md text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Tabel -->
                <table class="w-full text-left border-collapse inter-font overflow-hidden rounded-tl-lg rounded-tr-lg">
                    <thead class="bg-[#FF885B] text-white rounded-tl-lg rounded-tr-lg">
                        <tr>
                            <th class="p-2 border border-[#FF885B] text-center">No</th>
                            <th class="p-2 border border-[#FF885B] text-center">Nama</th>
                            <th class="p-2 border border-[#FF885B] text-center">Sekolah / Perguruan Tinggi</th>
                            <th class="p-2 border border-[#FF885B] text-center">Bidang</th>
                            <th class="p-2 border border-[#FF885B] text-center">Tanggal Mulai</th>
                            <th class="p-2 border border-[#FF885B] text-center">Tanggal Selesai</th>
                            <th class="p-2 border border-[#FF885B] text-center">Penilaian</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#F4EDEB] rounded-bl-lg rounded-br-lg">
                        <tr>
                            <td class="p-2 border border-[#FF885B]">1</td>
                            <td class="p-2 border border-[#FF885B]">Widiawati Sihaloho</td>
                            <td class="p-2 border border-[#FF885B]">Universitas Diponegoro</td>
                            <td class="p-2 border border-[#FF885B]">Statistik</td>
                            <td class="p-2 border border-[#FF885B]">02/01/2025</td>
                            <td class="p-2 border border-[#FF885B]">12/02/2025</td>
                            <td class="p-2 border border-[#FF885B] text-center"><button class="bg-[#282A4C] text-white p-2 rounded">Beri Nilai</button></td>
                        </tr>
                        <tr>
                            <td class="p-2 border border-[#FF885B]">2</td>
                            <td class="p-2 border border-[#FF885B]">Widiawati Sihaloho</td>
                            <td class="p-2 border border-[#FF885B]">Universitas Diponegoro</td>
                            <td class="p-2 border border-[#FF885B]">Statistik</td>
                            <td class="p-2 border border-[#FF885B]">02/01/2025</td>
                            <td class="p-2 border border-[#FF885B]">12/02/2025</td>
                            <td class="p-2 border border-[#FF885B] text-center"><button class="bg-[#282A4C] text-white p-2 rounded">Beri Nilai</button></td>
                        </tr>
                        <tr>
                            <td class="p-2 border border-[#FF885B]">3</td>
                            <td class="p-2 border border-[#FF885B]">Widiawati Sihaloho</td>
                            <td class="p-2 border border-[#FF885B]">Universitas Diponegoro</td>
                            <td class="p-2 border border-[#FF885B]">Statistik</td>
                            <td class="p-2 border border-[#FF885B]">02/01/2025</td>
                            <td class="p-2 border border-[#FF885B]">12/02/2025</td>
                            <td class="p-2 border border-[#FF885B] text-center"><button class="bg-[#282A4C] text-white p-2 rounded">Beri Nilai</button></td>
                        </tr>
                        <tr>
                            <td class="p-2 border border-[#FF885B]">4</td>
                            <td class="p-2 border border-[#FF885B]">Widiawati Sihaloho</td>
                            <td class="p-2 border border-[#FF885B]">Universitas Diponegoro</td>
                            <td class="p-2 border border-[#FF885B]">Statistik</td>
                            <td class="p-2 border border-[#FF885B]">02/01/2025</td>
                            <td class="p-2 border border-[#FF885B]">12/02/2025</td>
                            <td class="p-2 border border-[#FF885B] text-center"><button class="bg-[#282A4C] text-white p-2 rounded">Beri Nilai</button></td>
                        </tr>
                    </tbody >
                </table>
                

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-4">
                    <div class="text-[#B23A3A]"> Menampilkan 1 sampai 10 dari 50</div>
                    <div class="flex items-center">
                        <button class="bg-[#B23A3A] text-white p-2 rounded-l-md"> Sebelumnya</button>
                        <button class="bg-[#EBE4E1] text-black p-2">1</button>
                        <button class="bg-[#EBE4E1] text-black p-2">2</button>
                        <button class="bg-[#EBE4E1] text-black p-2">3</button>
                        <button class="bg-[#EBE4E1] text-black p-2">4</button>
                        <button class="bg-[#EBE4E1] text-black p-2">5</button>
                        <button class="bg-[#B23A3A] text-white p-2 rounded-r-md">Berikutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
