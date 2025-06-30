@extends('layouts.app')

@section('title', 'Daftar Peserta Magang - SIMPAS')

@section('content')
<head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head>
<h1 class="header">Daftar Peserta Magang</h1>
<div class="ml-9 mt-7 mb-6 inter-font">
    <form method="GET" action="{{ route('mentor.daftarPeserta') }}">
        <div class="flex items-center">
            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Nama / Institusi Peserta" 
                class="bg-[#EBE4E1] p-2 border border-gray-300 rounded-l-md w-full md:w-1/2" 
            />
            <button class="bg-[#B23A3A] p-2.5 rounded-r-md text-white" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
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
            <th class="p-1 border border-[#FF885B] text-center">Tandai Selesai</th>
        </tr>
    </thead>
    <tbody class="bg-[#F4EDEB] rounded-bl-lg rounded-br-lg">
        @forelse ($peserta_magangs as $key => $peserta)
            <tr>
                <td class="p-2 border border-[#FF885B] text-center">{{ $key + 1 }}</td>
                <td class="p-2 border border-[#FF885B]">{{ $peserta->pesertaMagang->nama_peserta ?? '-' }}</td>
                <td class="p-2 border border-[#FF885B]">{{ $peserta->pesertaMagang->asal_sekolah ?? '-' }}</td>
                <td class="p-2 border border-[#FF885B]">{{ \Carbon\Carbon::parse($peserta->tanggal_mulai)->format('d/m/Y') }}</td>
                <td class="p-2 border border-[#FF885B]">{{ \Carbon\Carbon::parse($peserta->tanggal_selesai)->format('d/m/Y') }}</td>
                <td class="p-4 border border-[#FF885B] text-center">
                    <a class="bg-[#282A4C] text-white p-2 rounded" href="{{ route('mentor.detail', $peserta->nip_peserta) }}">Detail</a>
                </td>
                <td class="p-4 border border-[#FF885B] text-center">
                    <form id="form-selesai-{{ $peserta->nip_peserta }}" action="{{ route('mentor.tandaiSelesai', $peserta->nip_peserta) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button type="button"
                        class="bg-[#16C47F] text-white p-2 rounded"
                        onclick="konfirmasiSelesai('{{ $peserta->nip_peserta }}')">
                        Selesai
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="p-4 border border-[#FF885B] text-center">Tidak ada peserta magang yang ditampilkan disini</td>
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
            <a href="{{ $peserta_magangs->url($i) }}" 
               class="bg-{{ $peserta_magangs->currentPage() == $i ? '[#EBE4E1] text-gray-900' : '[#EBE4E1] text-black' }} p-2">
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


<script>
    function konfirmasiSelesai(nip_peserta) {
        console.log('Tandai selesai dipanggil untuk:', nip_peserta);
        const form = document.getElementById('form-selesai-' + nip_peserta);
        if (!form) {
            console.error('Form tidak ditemukan untuk nip_peserta:', nip_peserta);
            return;
        }

        Swal.fire({
            title: 'Tandai selesai?',
            text: "Tanggal selesai peserta akan diubah menjadi hari ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#16C47F',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tandai selesai!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@if (session()->has('swal'))
    <script>
        // Jalankan setelah DOM siap (aman walau skrip ini di-head ataupun di-body)
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire(@json(session('swal')));
        });
    </script>
    @endif   

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });

</script>
@endif

