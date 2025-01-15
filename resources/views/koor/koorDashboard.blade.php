<html>
 <head>
  <title>
   Dashboard Koordinator
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
 </head>
 <body class="bg-[#fdf7f4] font-roboto">
  <div class="flex h-screen">
   <!-- Sidebar -->
   <div class="w-1/4 bg-[#3a2e2b] text-white p-6">
    <ul>
     <li class="mb-4">
      <a class="block py-2 px-4 bg-[#f28b61] rounded-l-full transform rotate-180" href="/koorDashboard">
       <span class="transform rotate-180 inline-block text-left w-full">
        Beranda
       </span>
      </a>
     </li>
     <li class="mb-4">
      <a class="block py-2 px-4" href="/koorProfil">
       Profil
      </a>
     </li>
     <li class="mb-4">
        <a class="block py-2 px-4" href="/koorPembagianMagang">
         Pembagian Magang
        </a>
       </li>
     <li class="mb-4">
      <a class="block py-2 px-4" href="/koorDftrPsrtMagang">
       Daftar Peserta Magang
      </a>
     </li>
    </ul>
   </div>
   <!-- Main Content -->
   <div class="w-3/4 p-8 rounded-tl-[30px] rounded-bl-[30px] bg-white">
    <div class="flex justify-between items-center mb-8">
     <h2 class="text-2xl font-bold text-[#b12a2f]">
      Beranda
     </h2>
     <div class="text-right">
      <p class="text-sm">
       Pemerintahan Kota Semarang
      </p>
      <img alt="Logo Pemerintahan Kota Semarang" class="inline-block" src="https://placehold.co/50x50"/>
     </div>
    </div>
    <p class="text-xl mb-4">
     Selamat Datang,
     <span class="font-bold text-[#b12a2f]">
      Arif Budiman, S.Kom.
     </span>
     !
    </p>
    <div class="bg-[#f28b61] text-center py-16 rounded-lg">
     <p class="text-xl font-bold mb-4">
      Jumlah Peserta Magang
     </p>
     <p class="text-6xl font-bold text-[#b12a2f]">
      151
     </p>
    </div>
   </div>
  </div>
 </body>
</html>
