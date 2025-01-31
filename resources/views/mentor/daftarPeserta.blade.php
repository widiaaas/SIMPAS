@extends('layouts.app')

@section('title', 'Daftar Peserta Magang - SIMPAS')

@section('content')
<h1 class="header">Daftar Peserta Magang</h1>        
<div class="ml-9 mt-7 mb-6 inter-font">
    <div class="flex items-center">
        <input 
            type="text" 
            placeholder="Cari Nama / Institusi Peserta" 
            class="bg-[#EBE4E1] p-2 border border-gray-300 rounded-l-md w-full md:w-1/2" 
        />
        <button class="bg-[#B23A3A] p-2.5 rounded-r-md text-white">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>

<!-- Tabel -->

<table class="w-full text-left border-collapse inter-font overflow-hidden rounded-tl-lg rounded-tr-lg ml-9 mr-7">
    <thead class="bg-[#FF885B] text-white rounded-tl-lg rounded-tr-lg">
        <tr>
            <th class="p-2 border border-[#FF885B] text-center">No</th>
            <th class="p-2 border border-[#FF885B] text-center">Nama</th>
            <th class="p-2 border border-[#FF885B] text-center">Sekolah / Perguruan Tinggi</th>
            <th class="p-2 border border-[#FF885B] text-center">Tanggal Mulai</th>
            <th class="p-2 border border-[#FF885B] text-center">Tanggal Selesai</th>
            <th class="p-1 border border-[#FF885B] text-center">Detail</th>
        </tr>
    </thead>
    <tbody class="bg-[#F4EDEB] rounded-bl-lg rounded-br-lg">
        @forelse ($peserta_magangs as $key => $peserta)
                <tr>
                    <td class="p-2 border border-[#FF885B] text-center">{{ $key + 1 }}</td>
                    <td class="p-2 border border-[#FF885B]">{{ $peserta->nama_peserta ?? '-' }}</td>
                    <td class="p-2 border border-[#FF885B]">{{ $peserta->asal_sekolah }}</td>
                    <td class="p-2 border border-[#FF885B]">{{ optional($peserta->pendaftaran)->tanggal_mulai ? \Carbon\Carbon::parse($peserta->pendaftaran->tanggal_mulai)->format('d/m/Y') : '-' }}</td>
                    <td class="p-2 border border-[#FF885B]">{{  optional($peserta->pendaftaran)->tanggal_selesai ? \Carbon\Carbon::parse($peserta->pendaftaran->tanggal_selesai)->format('d/m/Y') : '-'}}</td>
                    <td class="p-4 border border-[#FF885B] text-center">
                        <a class="bg-[#282A4C] text-white p-2 rounded" href="/mentor/detail">Detail</a>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="6" class="p-4 text-center">Tidak ada peserta magang yang ditampilkan disini</td>
            </tr>
        @endforelse
    </tbody >
</table>


<!-- Pagination -->
<div class="flex justify-between items-center mt-4 inter-font">
    <div class="ml-9 text-[#B23A3A]"> Menampilkan 1 sampai 10 dari 50</div>
    <div class="ml-24 flex items-center">
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

@endsection 