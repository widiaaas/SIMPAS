@extends('layouts.app')

@section('title', 'Edit Profil Mentor - SIMPAS')

@section('content')
<h1 class="header">Edit Profil</h1>  
<div class="p-8 rounded-lg shadow-md bg-white mt-8">
    <div class="flex items-center mb-6">
        <div>
            <h2 class="aoboshi-one-regular text-2xl font-bold text-[#3e2c2c]">
                Arif Budiman, S.Kom.
            </h2>
            <p class="aoboshi-one-regular text-lg text-[#3e2c2c]">
                NIP. 2344578400009
            </p>
        </div>
    </div>
    <hr class="border-t border-gray-300 mb-6" />
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                NIP
            </label>
            <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font">
                2344578400009
            </p>
        </div>
        <div>
            <label class=" inter-font italic block text-sm font-medium text-gray-700">
                Nomor Telepon
            </label>
            <input 
                type="text" 
                class="bg-[#f28b61] text-[#3e2c2c] rounded-lg px-4 py-2 w-full inter-font" 
                value="087832630688"
            />
        </div>
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                Nama
            </label>
            <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font">
                Arif Budiman, S.Kom.
            </p>
        </div>
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                Email
            </label>
            <input 
                type="text" 
                class="bg-[#f28b61] text-[#3e2c2c] rounded-lg px-4 py-2 w-full inter-font" 
                value="arifbudiman@gmail.com"
            />
        </div>
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                Instansi
            </label>
            <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font">
                Dinas Komunikasi, Informatika, Statistik, dan Persandian
            </p>
        </div>
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                Alamat
            </label>
            <input 
                type="text" 
                class="bg-[#f28b61] text-[#3e2c2c] rounded-lg px-4 py-2 w-full inter-font" 
                value="Jalan Kedondong no. 9, Kedungmundu, Semarang."
            />
        </div>
        <div>
            <label class="inter-font italic block text-sm font-medium text-gray-700">
                Jabatan
            </label>
            <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font">
                Kepala Bidang Sistem Pemerintahan Berbasis Elektronik
            </p>
        </div>
    </div>
    <div class="mt-6 text-right">
        <a class="aoboshi-one-regular bg-[#ff8a65] text-white rounded-lg hover:font-bold hover:bg-orange-500 px-6 py-2" href="/mentor/profil">
            Simpan
        </a>
    </div>
</div>
</div>



@endsection