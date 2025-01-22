@extends('layouts.app')

@section('title', 'Profil Mentor - SIMPAS')

@section('content')
<h1 class="header">Profil</h1>        
   <!-- Main Content -->
   <div class="flex-1 p-8">
    <!-- Kotak Profil -->
    <div class="p-8 rounded-lg shadow-md bg-white">
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
                <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font break-words">
                    2344578400009
                </p>
            </div>
            <div>
                <label class=" inter-font italic block text-sm font-medium text-gray-700">
                    Nomor Telepon
                </label>
                <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font break-words">
                    087832630688
                </p>
            </div>
            <div>
                <label class="inter-font italic block text-sm font-medium text-gray-700">
                    Nama
                </label>
                <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font break-words">
                    Arif Budiman, S.Kom.
                </p>
            </div>
            <div>
                <label class="inter-font italic block text-sm font-medium text-gray-700">
                    Email
                </label>
                <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font break-words">
                    arifbudiman@gmail.com
                </p>
            </div>
            <div>
                <label class="inter-font italic block text-sm font-medium text-gray-700">
                    Instansi
                </label>
                <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font break-words">
                    Dinas Komunikasi, Informatika, Statistik, dan Persandian
                </p>
            </div>
            <div>
                <label class="inter-font italic block text-sm font-medium text-gray-700">
                    Alamat
                </label>
                <p class="bg-[#ffccbc] text-[#3e2c2c] rounded-lg px-4 py-2 inter-font break-words">
                    Jalan Kedondong no. 9, Kedungmundu, Semarang.
                </p>
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
            <a class="aoboshi-one-regular bg-[#ff8a65] text-white rounded-lg hover:font-bold hover:bg-orange-500 px-6 py-2" href="/mentor/editProfil">
                Edit
            </a>
        </div>
    </div>
</div>

</div>

@endsection 