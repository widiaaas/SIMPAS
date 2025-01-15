<html>
    <head>
    <title>Dashboard Mentor - SIMPAS </title>
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
    <div class=" w-screen p-8 rounded-tl-[30px] rounded-bl-[30px] bg-[#fdf7f4]">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl aoboshi-one-regular font-bold text-[#b12a2f]">
            Beranda
            </h2>
            <div class="flex items-center justify-end">
                <div class="text-right">
                    <p class="aoboshi-one-regular text-sm text-[#b12a2f]">Pemerintah Kota</p>
                    <p class="aoboshi-one-regular text-sm text-[#b12a2f]">Semarang</p>
                </div>
                <img src="{{asset('img/pemkot.png')}}" class="ml-2" width="30" alt="Logo Pemerintah Kota Semarang"/>
            </div>
            
            
            
    </div class="py-5">
        <p class="aoboshi-one-regular text-xl mb-16">
        Selamat Datang,
        <span class="aoboshi-one-regular font-bold text-[#b12a2f]">
        Arif Budiman, S.Kom.
        </span>
        !
        </p>
    <div class="bg-[#f28b61] text-center  py-16 rounded-lg">
        <p class="aoboshi-one-regular text-xl font-bold mb-4">Jumlah Peserta Magang</p>
        <p class="inter-font text-7xl font-bold italic text-[#b12a2f]">151</p>
    </div>
   </div>
  </div>
 </body>
</html>