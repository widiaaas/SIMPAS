@extends('layouts.app')

@section('title', 'Profil Peserta - SIMPAS')

@section('content')
<div class="mb-8">
  <a class="text-[#282A4C] text-lg mb-4 block inter-font font-bold" href="/koordinator/daftarPeserta">
      <i class="fas fa-arrow-left">
      </i>
      Kembali
  </a>
</div>
<h1 class="header">Profil Peserta Magang</h1>        
<div class="mt-1 bg-[#FDF2EE] rounded-lg p-12 inter-font">
  <div class="space-y-4">
    <div>
        <p class="text-sm font-semibold text-gray-600">Nama:</p>
        <p class="text-lg font-medium">{{ $peserta->nama }}</p>
    </div>
    <div>
        <p class="text-sm font-semibold text-gray-600">Sekolah/Universitas Asal:</p>
        <p class="text-lg font-medium">{{ $peserta->asal_sekolah }}</p>
    </div>
    <div>
      <p class="text-sm font-semibold text-gray-600">NIM/NISN:</p>
      <p class="text-lg font-medium">{{ $peserta->nip }}</p>
    </div>
    <div>
      <p class="text-sm font-semibold text-gray-600">Jurusan:</p>
      <p class="text-lg font-medium">{{ $peserta->jurusan }}</p>
    </div>
    <div>
      <p class="text-sm font-semibold text-gray-600">Email:</p>
      <p class="text-lg font-medium" href="mailto:{{ $peserta->email }}">{{ $peserta->email }}</p>
    </div>
    <div>
      <p class="text-sm font-semibold text-gray-600">Diterima Magang di:</p>
      <p class="text-lg font-medium">{{ $peserta->nama_instansi }}</p>
    </div>
    <div class="flex space-x-4">
      <div>
        <p class="text-sm font-semibold text-gray-600">Tanggal Mulai:</p>
        <p class="text-lg font-medium">{{ date('d/m/Y', strtotime($peserta->tanggal_mulai)) }}</p>
      </div>
      <div>
        <p class="text-sm font-semibold text-gray-600">Tanggal Selesai:</p>
        <p class="text-lg font-medium">{{ date('d/m/Y', strtotime($peserta->tanggal_selesai)) }}</p>
      </div>
    </div>


@endsection 