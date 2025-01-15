<html>
    <head>
    <title>Profil Mentor - SIMPAS </title>
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
<body class="bg-[#fdf7f4] font-roboto">
    <div class="flex h-screen">
    <!-- Sidebar -->
    <x-sidebar-mentor></x-sidebar-mentor>
    <!-- Main Content -->
    <div class="flex-1 p-8">
        <!-- Header Profil -->
        <div class="mb-10">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl aoboshi-one-regular font-bold text-[#b12a2f]">
                    Profil
                </h2>
                <div class="flex items-center">
                    <div class="text-right">
                        <p class="aoboshi-one-regular text-sm text-[#b12a2f]">Pemerintah Kota</p>
                        <p class="aoboshi-one-regular text-sm text-[#b12a2f]">Semarang</p>
                    </div>
                    <img src="{{asset('img/pemkot.png')}}" class="ml-2" width="30" alt="Logo Pemerintah Kota Semarang" />
                </div>
            </div>
        </div>
    
        <!-- Kotak Profil -->
        <div class="p-8 rounded-lg shadow-md bg-white">
            <div class="flex items-center mb-6">
                <div>
                    <h2 class="aoboshi-one-regular text-2xl font-bold text-[#3e2c2c]">
                        Arif Budiman, S.Kom.
                    </h2>
                    <p class="aoboshi-one-regular text-lg text-[#3e2c2c]">
                        NIP. 2344578400009
                    </p>
                </div>
            </div>
            <hr class="border-t border-gray-300 mb-6" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="inter-font italic block text-sm font-medium text-gray-700">
                        NIP
                    </label>
                    <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2">
                        2344578400009
                    </p>
                </div>
                <div>
                    <label class=" inter-font italic block text-sm font-medium text-gray-700">
                        Nomor Telepon
                    </label>
                    <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2">
                        087832630688
                    </p>
                </div>
                <div>
                    <label class="inter-font italic block text-sm font-medium text-gray-700">
                        Nama
                    </label>
                    <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2">
                        Arif Budiman, S.Kom.
                    </p>
                </div>
                <div>
                    <label class="inter-font italic block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2">
                        arifbudiman@gmail.com
                    </p>
                </div>
                <div>
                    <label class="inter-font italic block text-sm font-medium text-gray-700">
                        Instansi
                    </label>
                    <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2">
                        Dinas Komunikasi, Informatika, Statistik, dan Persandian
                    </p>
                </div>
                <div>
                    <label class="inter-font italic block text-sm font-medium text-gray-700">
                        Alamat
                    </label>
                    <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2">
                        Jalan Kedondong no. 9, Kedungmundu, Semarang.
                    </p>
                </div>
                <div>
                    <label class="inter-font italic block text-sm font-medium text-gray-700">
                        Jabatan
                    </label>
                    <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2">
                        Kepala Bidang Sistem Pemerintahan Berbasis Elektronik
                    </p>
                </div>
            </div>
            <div class="mt-6 text-right">
                <a class="aoboshi-one-regular bg-[#ff8a65] text-white rounded-lg hover:font-bold hover:bg-orange-500 px-6 py-2" href="/mentor/editProfil">
                    Simpan
                </a>
            </div>
        </div>
    </div>
    
   </div>
  </div>
 </body>
</html>


