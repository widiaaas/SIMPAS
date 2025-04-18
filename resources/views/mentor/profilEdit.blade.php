@extends('layouts.app')

@section('title', 'Edit Profil Mentor - SIMPAS')

@section('content')
<h1 class="header">Edit Profil</h1>  
<div class="p-8 rounded-lg shadow-md bg-white mt-8">
    <div class="flex items-center mb-6">
        <div>
            <h2 class="aoboshi-one-regular text-2xl font-bold text-[#3e2c2c]">
                {{ $mentor->nama??'Nama Tidak ditemukan' }}
            </h2>
            <p class="aoboshi-one-regular text-lg text-[#3e2c2c]">
                NIP. {{ $mentor->nip_mentor ??'-' }}
            </p>
        </div>
    </div>
    <hr class="border-t border-gray-300 mb-6" />
    <form method="POST" action="{{ route('mentor.update',['nip_mentor'=>$mentor->nip_mentor]) }}">
    @csrf
    @method('PUT')
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-2 mb-4 rounded relative" role="alert">
        <strong class="font-bold">Ada kesalahan!</strong>
        <span class="block sm:inline">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </span>
    </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                NIP
            </label>
            <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font break-words">
                {{ $mentor->nip_mentor ??'-' }}
            </p>
        </div>
        <div>
            <label class=" inter-font italic block text-sm font-medium text-gray-700">
                Nomor Telepon
            </label>
            <input 
                type="text" 
                name="nomor_telp"
                class="bg-[#f28b61] text-[#3e2c2c] rounded-lg px-4 py-2 w-full inter-font break-words" 
                value="{{ old('nomor_telp',$mentor ->nomor_telp) }}"
            />
        </div>
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                Nama
            </label>
            <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font break-words">
                {{ $mentor->nama ?? '-' }}
            </p>
        </div>
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                Email
            </label>
            <input 
                type="email"
                name="email" 
                class="bg-[#f28b61] text-[#3e2c2c] rounded-lg px-4 py-2 w-full inter-font break-words" 
                value="{{ old('email',$mentor->email) }}"
            />
        </div>
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                Instansi
            </label>
            <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font break-words">
                {{ $namaInstansi ?? '-' }}
            </p>
        </div>
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                Alamat
            </label>
            <input 
                type="text" 
                name="alamat"
                class="bg-[#f28b61] text-[#3e2c2c] rounded-lg px-4 py-2 w-full inter-font break-words" 
                value="{{ old('alamat',$mentor->alamat) }}."
            />
        </div>
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                Jabatan
            </label>
            <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font break-words">
                Kepala Bidang Sistem Pemerintahan Berbasis Elektronik
            </p>
        </div>
    </div>
    <div class="mt-6 text-right">
        <button type="submit" class="aoboshi-one-regular bg-[#ff8a65] text-white rounded-lg hover:font-bold hover:bg-orange-500 px-6 py-2" >
            Simpan
        </button>
    </div>
    


</div>
</div>



@endsection