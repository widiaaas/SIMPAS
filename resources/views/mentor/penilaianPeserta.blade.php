@extends('layouts.app')

@section('title', 'Penilaian Peserta Magang - SIMPAS')

@section('content')
<h1 class="header">Penilaian Peserta Magang </h1>
<div class="mt-10 mb-6 ml-10 inter-font">
    <div class="flex items-center">
        <input 
            type="text" 
            placeholder="Cari Nama / Institusi Peserta" 
            class=" bg-[#EBE4E1] p-2 border border-gray-300 rounded-l-md w-full md:w-1/2" 
        />
        <button class="bg-[#B23A3A] p-2.5 rounded-r-md text-white">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>

<!-- Tabel -->
<table class="w-full ml-10 text-left border-collapse inter-font overflow-hidden rounded-tl-lg rounded-tr-lg">
    <thead class="bg-[#FF885B] text-white rounded-tl-lg rounded-tr-lg">
        <tr>
            <th class="p-2 border border-[#FF885B] text-center">No</th>
            <th class="p-2 border border-[#FF885B] text-center">Nama</th>
            <th class="p-2 border border-[#FF885B] text-center">Sekolah / Perguruan Tinggi</th>
            <th class="p-2 border border-[#FF885B] text-center">Tanggal Mulai</th>
            <th class="p-2 border border-[#FF885B] text-center">Tanggal Selesai</th>
            <th class="p-1 border border-[#FF885B] text-center">Penilaian</th>
        </tr>
    </thead>
    <tbody class="bg-[#F4EDEB] rounded-bl-lg rounded-br-lg">
        <tr>
            <td class="p-2 border border-[#FF885B] text-center">1</td>
            <td class="p-2 border border-[#FF885B]">Widiawati Sihaloho</td>
            <td class="p-2 border border-[#FF885B]">Universitas Diponegoro</td>
            <td class="p-2 border border-[#FF885B]">02/01/2025</td>
            <td class="p-2 border border-[#FF885B]">12/02/2025</td>
            <td class="p-4 border border-[#FF885B] text-center"><a class="bg-[#282A4C] text-white p-2 rounded" href="/mentor/beriNilai">Beri Nilai</a></td>
        </tr>
        <tr>
            <td class="p-2 border border-[#FF885B]">2</td>
            <td class="p-2 border border-[#FF885B]">Widiawati Sihaloho</td>
            <td class="p-2 border border-[#FF885B]">Universitas Diponegoro</td>
            <td class="p-2 border border-[#FF885B]">02/01/2025</td>
            <td class="p-2 border border-[#FF885B]">12/02/2025</td>
            <td class="p-4 border border-[#FF885B] text-center"><a class="bg-[#282A4C] text-white p-2 rounded" href="/mentor/beriNilai">Beri Nilai</a></td>
        </tr>
        <tr>
            <td class="p-2 border border-[#FF885B]">3</td>
            <td class="p-2 border border-[#FF885B]">Widiawati Sihaloho</td>
            <td class="p-2 border border-[#FF885B]">Universitas Diponegoro</td>
            <td class="p-2 border border-[#FF885B]">02/01/2025</td>
            <td class="p-2 border border-[#FF885B]">12/02/2025</td>
            <td class="p-4 border border-[#FF885B] text-center"><a class="bg-[#282A4C] text-white p-2 rounded" href="/mentor/beriNilai">Beri Nilai</a></td>
        </tr>
        <tr>
            <td class="p-2 border border-[#FF885B]">4</td>
            <td class="p-2 border border-[#FF885B]">Widiawati Sihaloho</td>
            <td class="p-2 border border-[#FF885B]">Universitas Diponegoro</td>
            <td class="p-2 border border-[#FF885B]">02/01/2025</td>
            <td class="p-2 border border-[#FF885B]">12/02/2025</td>
            <td class="p-4 border border-[#FF885B] text-center"><a class="bg-[#282A4C] text-white p-2 rounded" href="/mentor/beriNilai">Beri Nilai</a></td>
        </tr>
    </tbody >
</table>


<!-- Pagination -->
<div class="flex justify-between items-center mt-4 inter-font">
    <div class="text-[#B23A3A] ml-10"> Menampilkan 1 sampai 10 dari 50</div>
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

@endsection 