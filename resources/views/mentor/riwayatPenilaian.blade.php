@extends('layouts.app')

@section('title', 'Riwayat Penilaian Peserta Magang - SIMPAS')

@section('content')
<h1 class="header">Riwayat Penilaian Peserta Magang </h1>
<div class="mt-10 mb-6 ml-10 inter-font">
    <form method="GET" action="{{ route('mentor.riwayatPenilaian') }}">
        <div class="flex items-center">
            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Nama / Institusi Peserta" 
                class="bg-[#EBE4E1] p-2 border border-gray-300 rounded-l-md w-full md:w-1/2" 
            />
            <button class="bg-[#B23A3A] p-2.5 rounded-r-md text-white">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
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
        @forelse ($peserta_magangs as $key => $peserta)
        <tr>
            <td class="p-2 border border-[#FF885B] text-center">{{ $key + 1 }}</td>
            <td class="p-2 border border-[#FF885B]">{{ $peserta->nama_peserta ?? '-' }}</td>
            <td class="p-2 border border-[#FF885B]">{{ $peserta->asal_sekolah }}</td>
            <td class="p-2 border border-[#FF885B]">{{ \Carbon\Carbon::parse($peserta->tanggal_mulai)->format('d/m/Y') }}</td>
            <td class="p-2 border border-[#FF885B]">{{ \Carbon\Carbon::parse($peserta->tanggal_selesai)->format('d/m/Y') }}</td>
            <td class="p-4 border border-[#FF885B] text-center">
               <a href="{{ route('mentor.nilaiAkhir', ['nip_peserta' => $peserta->nip_peserta, 'created_at' => $peserta->created_at]) }}" class="bg-[#B31312] text-white p-2 rounded">
                    Lihat Nilai
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="p-4 border border-[#FF885B] text-center">Tidak ada peserta magang yang ditampilkan disini</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
<div class="flex justify-between items-center mt-4 inter-font">
    <div class="ml-9 text-[#B23A3A]">
        Menampilkan {{ $peserta_magangs->firstItem() }} sampai {{ $peserta_magangs->lastItem() }} dari {{ $peserta_magangs->total() }}
    </div>
    <div class="ml-24 flex items-center">
        @if($peserta_magangs->onFirstPage())
            <button class="bg-gray-400 text-white p-2 rounded-l-md cursor-not-allowed">Sebelumnya</button>
        @else
            <a href="{{ $peserta_magangs->previousPageUrl() }}" class="bg-[#B23A3A] text-white p-2 rounded-l-md">Sebelumnya</a>
        @endif

        @for($i = 1; $i <= $peserta_magangs->lastPage(); $i++)
            <a href="{{ $peserta_magangs->url($i) }}" class="p-2 {{ $peserta_magangs->currentPage() == $i ? 'bg-[#EBE4E1] text-gray-900' : 'bg-[#EBE4E1] text-black' }}">
                {{ $i }}
            </a>
        @endfor

        @if($peserta_magangs->hasMorePages())
            <a href="{{ $peserta_magangs->nextPageUrl() }}" class="bg-[#B23A3A] text-white p-2 rounded-r-md">Berikutnya</a>
        @else
            <button class="bg-gray-400 text-white p-2 rounded-r-md cursor-not-allowed">Berikutnya</button>
        @endif
    </div>
</div>
@endsection
