@extends('layouts.app')

@section('title', 'Riwayat Penilaian Peserta - SIMPAS')

@section('content')
<div class="mb-8">
  <a class="text-[#282A4C] text-lg mb-4 block inter-font font-bold" href="/mentor/riwayatPenilaian">
      <i class="fas fa-arrow-left">
      </i>
      Kembali
  </a>
</div>
<h1 class="header">Nilai Akhir Peserta Magang</h1>
 <!-- Informasi Peserta -->
 <div class="bg-[#FDF2EE] rounded-lg p-5 mt-4 ml-7 inter-font">
  <div class="grid grid-cols-2 gap-6">
    <div>
      <p class="text-sm font-semibold text-gray-600">Nama/NIM:</p>
      <p class="text-lg font-medium">{{ $peserta->pesertaMagang->nama_peserta ??'-' }}/{{ $peserta->nip_peserta ??'-' }}</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Sekolah/Universitas:</p>
      <p class="text-lg font-medium">{{ $peserta->pesertaMagang->asal_sekolah ??'-' }}</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Program Studi:</p>
      <p class="text-lg font-medium">{{ $peserta->pesertaMagang->jurusan ??'-'  }}</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Waktu Magang:</p>
      <p class="text-lg font-medium">{{  \Carbon\Carbon::parse($peserta->tanggal_mulai)->format('d/m/Y') ??'-'}} - {{  \Carbon\Carbon::parse($peserta->tanggal_selesai)->format('d/m/Y')??'-' }}</p>
    </div>
</div>
<div class="overflow-x-auto mt-6 ml-9 mr-7">
    <table class="table-auto w-full border-collapse inter-font overflow-hidden rounded-tl-lg rounded-tr-lg ">
        <thead class="bg-[#FF885B] text-white rounded-tl-lg rounded-tr-lg">
      <tr>
        <th class="px-4 py-2 text-left">No</th>
        <th class="px-4 py-2 text-left">Parameter Penilaian</th>
        <th class="px-4 py-2 text-left">Bobot</th>
        <th class="px-4 py-2 text-left">Nilai</th>
      </tr>
    </thead>
    <tbody>
        <!-- Parameter Penilaian -->
      <tr>
        <td class="border px-4 py-2">1</td>
        <td class="border px-4 py-2">Kehadiran</td>
        <td class="border px-4 py-2">5</td>
        <td class="border px-4 py-2">{{ $penilaian->nilai1 }}</td>
      </tr>
      <tr>
        <td class="border px-4 py-2">2</td>
        <td class="border px-4 py-2">Ketepatan Waktu</td>
        <td class="border px-4 py-2">5</td>
         <td class="border px-4 py-2">{{ $penilaian->nilai2 }}</td>
      </tr>
      <tr>
        <td class="border px-4 py-2">3</td>
        <td class="border px-4 py-2">Sikap Kerja/Prosedur Kerja</td>
        <td class="border px-4 py-2">10</td>
         <td class="border px-4 py-2">{{ $penilaian->nilai3 }}</td>
      </tr>
      <tr>
        <td class="border px-4 py-2">4</td>
        <td class="border px-4 py-2">Kemampuan Bekerja dalam Tim</td>
        <td class="border px-4 py-2">10</td>
         <td class="border px-4 py-2">{{ $penilaian->nilai4 }}</td>
      </tr>
      <tr>
        <td class="border px-4 py-2">5</td>
        <td class="border px-4 py-2">Kreatifitas Kerja</td>
        <td class="border px-4 py-2">10</td>
         <td class="border px-4 py-2">{{ $penilaian->nilai5 }}</td>
      </tr>
      <tr>
        <td class="border px-4 py-2">6</td>
        <td class="border px-4 py-2">Insitatif Kerja</td>
        <td class="border px-4 py-2">15</td>
         <td class="border px-4 py-2">{{ $penilaian->nilai6 }}</td>
      </tr>
      <tr>
        <td class="border px-4 py-2">7</td>
        <td class="border px-4 py-2">Kemampuan Komunikasi</td>
        <td class="border px-4 py-2">15</td>
        <td class="border px-4 py-2">{{ $penilaian->nilai7 }}</td>
      </tr>
      <tr>
        <td class="border px-4 py-2">8</td>
        <td class="border px-4 py-2">Kemampuan Teknikal</td>
        <td class="border px-4 py-2">20</td>
         <td class="border px-4 py-2">{{ $penilaian->nilai8 }}</td>
      </tr>
      <tr>
        <td class="border px-4 py-2">9</td>
        <td class="border px-4 py-2">Kepercayaan Diri</td>
        <td class="border px-4 py-2">5</td>
         <td class="border px-4 py-2">{{ $penilaian->nilai9 }}</td>
      </tr>
      <tr>
        <td class="border px-4 py-2">10</td>
        <td class="border px-4 py-2">Penampilan/Kerapihan</td>
        <td class="border px-4 py-2">5</td>
         <td class="border px-4 py-2">{{ $penilaian->nilai10 }}</td>
      </tr>
      <!-- Tambahkan parameter lainnya di sini -->
      <!-- Nilai Total -->
      <tr class="bg-gray-200">
        <td class="border px-4 py-2 font-bold" colspan="3">Nilai Total</td>
        <td class="border px-4 py-2 font-bold text-red-500">{{ $penilaian->nilai_total }}</td>
      </tr>
    </tbody>
    </table>
</div>
@endsection