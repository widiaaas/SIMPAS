@extends('layouts.app')

@section('title', 'Profil Peserta - SIMPAS')

@section('content')
<div class="mb-8">
  <a class="text-[#282A4C] text-lg mb-4 block inter-font font-bold" href="/mentor/daftarPeserta">
      <i class="fas fa-arrow-left">
      </i>
      Kembali
  </a>
</div>
<h1 class="header">Profil Peserta Magang</h1>        
<div class="mt-1 bg-[#FDF2EE] rounded-lg p-12 inter-font">
  <div class="space-y-4">
  <div class="flex space-x-4 justify-between">
    <div>
      <p class="text-sm font-semibold text-gray-600">Nama:</p>
      <p class="text-lg font-medium">{{ $peserta->nama_peserta }}</p>
    </div>
    <div >
      <p class="text-sm font-semibold text-gray-600">Detail CV:</p>
      <button class=" px-9 py-2 bg-[#282a4c] text-white rounded-lg hover:bg-blue-600 transition">
        <a href="{{str_replace('http://localhost/storage/', '/storage/', $peserta->file_cv_url)  }}" target="_blank">Lihat CV</a>
      </button>
    </div>
  </div>
  <div class="flex space-x-4 justify-between">
      <div>
          <p class="text-sm font-semibold text-gray-600">Sekolah/Universitas Asal:</p>
          <p class="text-lg font-medium">{{ $peserta->asal_sekolah }}</p>
        </div>
      <div >
        <p class="text-sm font-semibold text-gray-600">Detail Proposal:</p>
        <button class=" px-4 py-2 bg-[#282a4c] text-white rounded-lg hover:bg-blue-600 transition">
          <a href="{{str_replace('http://localhost/storage/', '/storage/', $peserta->file_proposal_url)  }}" target="_blank">Lihat Proposal</a>
        </button>
      </div>
    </div>
    <div>
      <p class="text-sm font-semibold text-gray-600">NIM/NISN:</p>
      <p class="text-lg font-medium">{{ $peserta->nip_peserta}}</p>
    </div>
    <div>
      <p class="text-sm font-semibold text-gray-600">Jurusan:</p>
      <p class="text-lg font-medium">{{ $peserta->jurusan }}</p>
    </div>
    <div>
      <p class="text-sm font-semibold text-gray-600">Email:</p>
      <p class="text-lg font-medium">{{ $peserta->email_peserta }}</p>
    </div>
    <div>
      <p class="text-sm font-semibold text-gray-600">Diterima Magang di:</p>
      <p class="text-lg font-medium"> {{ optional($peserta->pendaftaran->instansi)->nama_instansi ?? '-' }}</p>
    </div>

    <div class="flex space-x-4">
      <div>
        <p class="text-sm font-semibold text-gray-600">Tanggal Mulai:</p>
        <p class="text-lg font-medium">{{  \Carbon\Carbon::parse($peserta->pendaftaran->tanggal_mulai)->format('d/m/Y') }}</p>
      </div>
      <div>
        <p class="text-sm font-semibold text-gray-600">Tanggal Selesai:</p>
        <p class="text-lg font-medium">{{ \Carbon\Carbon::parse($peserta->pendaftaran->tanggal_selesai)->format('d/m/Y')}}</p>
      </div>
    </div>


@endsection 