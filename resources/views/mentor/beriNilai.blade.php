@extends('layouts.app')

@section('title', 'Beri Nilai Peserta - SIMPAS')

@section('content')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
      .btn-ok{
        background-color: #FFDD55;
        color: #333;
      }
      .icon-warning .swal2-icon {
        background-color: #FF8800 !important; /* Warna latar belakang ikon */
        color: white !important; /* Warna ikon */
      }
        .btn-ya {
        background-color: #FF885B !important;
        color: white !important;
      }

      .btn-tidak {
        background-color: #B31312 !important;
        color: white !important;
      }  
   
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="mb-8">
  <a class="text-[#282A4C] text-lg mb-4 block inter-font font-bold" href="/mentor/penilaianPeserta">
      <i class="fas fa-arrow-left">
      </i>
      Kembali
  </a>
</div>
<h1 class="header">Penilaian Peserta Magang</h1>
 <!-- Informasi Peserta -->
 <div class="bg-[#FDF2EE] rounded-lg p-5 mt-4 ml-7 inter-font">
  <div class="grid grid-cols-2 gap-6">
    <div>
      <p class="text-sm font-semibold text-gray-600">Nama/NIM:</p>
      <p class="text-lg font-medium">{{ $peserta->nama_peserta ??'-' }}/{{ $peserta->nip_peserta ??'-' }}</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Sekolah/Universitas:</p>
      <p class="text-lg font-medium">{{ $peserta->asal_sekolah ??'-' }}</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Program Studi:</p>
      <p class="text-lg font-medium">{{ $peserta->jurusan ??'-'  }}</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Waktu Magang:</p>
      <p class="text-lg font-medium">{{  \Carbon\Carbon::parse($peserta->pendaftaran->tanggal_mulai)->format('d/m/Y') ??'-'}} - {{  \Carbon\Carbon::parse($peserta->pendaftaran->tanggal_selesai)->format('d/m/Y')??'-' }}</p>
    </div>
    <div class="flex items-start justify-end">

    </div>
  </div>
</div>
<form id="formPenilaian" method="POST" action="{{ route('mentor.simpanPenilaian') }}">
  @csrf
  <input type="hidden" name="nip_peserta" value="{{ $peserta->nip_peserta }}">
  <input type="hidden" name="nip_mentor" value="{{ auth()->user()->nip }}">

<!-- Tabel Penilaian -->
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
        <td class="border px-4 py-2">
          <input type="number" name="nilai1" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="5"  value="{{ $penilaian->nilai1 ?? '' }}" 
            {{ isset($penilaian->nilai1) ? 'disabled' : '' }} onchange="validateAndCalculate(this, 5)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">2</td>
        <td class="border px-4 py-2">Ketepatan Waktu</td>
        <td class="border px-4 py-2">5</td>
        <td class="border px-4 py-2">
          <input type="number" name="nilai2" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="5"  value="{{ $penilaian->nilai2 ?? '' }}" 
            {{ isset($penilaian->nilai2) ? 'disabled' : '' }} onchange="validateAndCalculate(this, 5)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">3</td>
        <td class="border px-4 py-2">Sikap Kerja/Prosedur Kerja</td>
        <td class="border px-4 py-2">10</td>
        <td class="border px-4 py-2">
          <input type="number" name="nilai3" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="10"  value="{{ $penilaian->nilai3 ?? '' }}" 
            {{ isset($penilaian->nilai3) ? 'disabled' : '' }} onchange="validateAndCalculate(this, 10)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">4</td>
        <td class="border px-4 py-2">Kemampuan Bekerja dalam Tim</td>
        <td class="border px-4 py-2">10</td>
        <td class="border px-4 py-2">
          <input type="number" name="nilai4" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="10"  value="{{ $penilaian->nilai4 ?? '' }}" 
            {{ isset($penilaian->nilai4) ? 'disabled' : '' }} onchange="validateAndCalculate(this, 10)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">5</td>
        <td class="border px-4 py-2">Kreatifitas Kerja</td>
        <td class="border px-4 py-2">10</td>
        <td class="border px-4 py-2">
          <input type="number" name="nilai5" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="10"  value="{{ $penilaian->nilai5 ?? '' }}" 
            {{ isset($penilaian->nilai5) ? 'disabled' : '' }} onchange="validateAndCalculate(this, 10)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">6</td>
        <td class="border px-4 py-2">Insitatif Kerja</td>
        <td class="border px-4 py-2">15</td>
        <td class="border px-4 py-2">
          <input type="number" name="nilai6" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="15"  value="{{ $penilaian->nilai6 ?? '' }}" 
            {{ isset($penilaian->nilai6) ? 'disabled' : '' }} onchange="validateAndCalculate(this, 15)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">7</td>
        <td class="border px-4 py-2">Kemampuan Komunikasi</td>
        <td class="border px-4 py-2">15</td>
        <td class="border px-4 py-2">
          <input type="number" name="nilai7" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="15" value="{{ $penilaian->nilai7 ?? '' }}" 
            {{ isset($penilaian->nilai7) ? 'disabled' : '' }} onchange="validateAndCalculate(this, 15)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">8</td>
        <td class="border px-4 py-2">Kemampuan Teknikal</td>
        <td class="border px-4 py-2">20</td>
        <td class="border px-4 py-2">
          <input type="number" name="nilai8" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="20"  value="{{ $penilaian->nilai8 ?? '' }}" 
            {{ isset($penilaian->nilai8) ? 'disabled' : '' }} onchange="validateAndCalculate(this, 20)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">9</td>
        <td class="border px-4 py-2">Kepercayaan Diri</td>
        <td class="border px-4 py-2">5</td>
        <td class="border px-4 py-2">
          <input type="number" name="nilai9" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="5"  value="{{ $penilaian->nilai9 ?? '' }}" 
            {{ isset($penilaian->nilai9) ? 'disabled' : '' }} onchange="validateAndCalculate(this, 5)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">10</td>
        <td class="border px-4 py-2">Penampilan/Kerapihan</td>
        <td class="border px-4 py-2">5</td>
        <td class="border px-4 py-2">
          <input type="number" name="nilai10" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="5"  value="{{ $penilaian->nilai10 ?? '' }}" 
            {{ isset($penilaian->nilai10) ? 'disabled' : '' }} onchange="validateAndCalculate(this, 5)" />
        </td>
      </tr>
      <!-- Tambahkan parameter lainnya di sini -->
      <!-- Nilai Total -->
      <tr class="bg-gray-200">
        <td class="border px-4 py-2 font-bold" colspan="3">Nilai Total</td>
        <td class="border px-4 py-2 font-bold text-red-500" id="totalScore">
          @if($penilaian)
            {{ $penilaian->nilai_total }}
          @else
            0
          @endif
        </td>
      </tr>
    </tbody>
  </table>
</div>
 
<!-- Keterangan -->
<div class="mt-4 ml-8 inter-font">
  <p class="text-sm text-gray-600">Keterangan:</p>
  <p class="text-sm text-gray-600">Nilai dalam bentuk angka dari 1 sampai nilai bobot.</p>
</div>
</form>

<!-- Tombol Simpan -->
<div class="flex justify-end mr-9 inter-font">
  @if(is_null($penilaian) || (is_null($penilaian->nilai1) && is_null($penilaian->nilai2) && 
     is_null($penilaian->nilai3) && is_null($penilaian->nilai4) && 
     is_null($penilaian->nilai5) && is_null($penilaian->nilai6) && 
     is_null($penilaian->nilai7) && is_null($penilaian->nilai8) && 
     is_null($penilaian->nilai9) && is_null($penilaian->nilai10) && 
     is_null($penilaian->nip_mentor)))
    <button id="actionButton" 
    class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
    onclick="handleSave()"  >
    Simpan
    </button>
  @endif
</div>
</div>
<script>
  let isEditable = true; // Status input apakah editable atau tidak

// Fungsi untuk mengubah status edit
  function toggleEdit() {
    const inputs = document.querySelectorAll('.score-input');
    const actionButton = document.getElementById('actionButton');
    
    if (isEditable) {
        // Jika sedang editable dan tombol diklik, kunci input
        inputs.forEach(input => input.disabled = true);
        actionButton.style.display='none';
    }

    isEditable = false; // Toggle status
  }

  function handleSave() {
    const inputs = document.querySelectorAll('.score-input');
    let allFilled = true;

    // Cek apakah semua input telah diisi
    inputs.forEach((input) => {
        if (!input.value.trim()) {
            allFilled = false;
        }
    });

    if (!allFilled) {
        Swal.fire({
            icon: "warning",
            title: "Nilai tidak boleh kosong!",
            text: "Harap isi semua nilai sebelum menyimpan.",
            customClass: {
                confirmButton: 'btn-ok',
                icon: 'icon-warning'
            }
        });
        return;
    }

    Swal.fire({
        title: "Apakah Anda yakin ingin menyimpan?",
        showCancelButton: true,
        confirmButtonText: "Ya, Simpan",
        cancelButtonText: "Batal",
        customClass: {
            confirmButton: 'btn-ya',
            cancelButton: 'btn-tidak',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('formPenilaian');
            const formData = new FormData(form);

            fetch("{{ route('mentor.simpanPenilaian') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.message && data.message.toLowerCase().includes('berhasil')) {
                    Swal.fire({
                        title: "Nilai berhasil disimpan!",
                        icon: "success"
                    }).then(() => {
                        // Menonaktifkan semua input setelah sukses
                        inputs.forEach(input => input.disabled = true);
                        // Menyembunyikan tombol simpan
                        document.getElementById('actionButton').style.display = 'none';
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                Swal.fire({
                    title: "Terjadi kesalahan",
                    text: error.message || "Gagal menyimpan penilaian",
                    icon: "error"
                });
            });
        }
    });
}





  // Fungsi validasi input dan perhitungan total
  function validateAndCalculate(input, max) {
    const value = parseFloat(input.value); // Gunakan parseFloat untuk menangani angka desimal
    if (!Number.isInteger(value)) {
        alert('Masukkan nilai berupa bilangan bulat.');
        input.value = ''; // Kosongkan input jika invalid
    } else if (value < 1 || value > max || isNaN(value)) {
        alert(Masukkan nilai antara 1 dan ${max});
        input.value = ''; // Kosongkan input jika invalid
    } else {
        calculateTotal(); // Hitung total setelah input valid
    }
}


  // Fungsi menghitung total nilai
  function calculateTotal() {
    const inputs = document.querySelectorAll('.score-input');
    let total = 0;
    inputs.forEach(input => {
      const value = parseInt(input.value, 10);
      if (!isNaN(value)) {
        total += value;
      }
    });
    document.getElementById('totalScore').innerText = total;
  }
</script>


    
@endsection