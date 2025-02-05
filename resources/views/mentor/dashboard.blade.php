@extends('layouts.app')

@section('title', 'Dashboard Mentor - SIMPAS')

@section('content')
<h1 class="header">Beranda</h1>        
        <p class="aoboshi-one-regular text-xl mb-16 mt-16 ml-10">
        Selamat Datang,
        <span class="aoboshi-one-regular font-bold text-[#b12a2f]">
            {{ $mentorName ?? 'mentor' }}
        </span>
        !
        </p>
    <div class="bg-[#f28b61] text-center  py-14 ml-10 rounded-lg">
        <p class="aoboshi-one-regular text-xl font-bold mb-4">Jumlah Peserta Magang</p>
        <p class="inter-font text-7xl font-bold italic text-[#b12a2f]">151</p>
    </div>
@endsection 