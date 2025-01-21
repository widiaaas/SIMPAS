@extends('layouts.app')

@section('title', 'Detail Nilai Peserta - SIMPAS')

@section('content')
<div class="mb-8">
  <a class="text-[#282A4C] text-lg mb-4 block inter-font font-bold" href="/koor/penilaianPeserta">
      <i class="fas fa-arrow-left">
      </i>
      Kembali
  </a>
</div>
<h1 class="header">Detail Nilai Peserta Magang</h1>
 <!-- Informasi Peserta -->
 <div class="bg-[#FDF2EE] rounded-lg p-5 mt-4 ml-7 inter-font">
  <div class="grid grid-cols-2 gap-6">
    <div>
      <p class="text-sm font-semibold text-gray-600">Nama/NIM:</p>
      <p class="text-lg font-medium">Widiawati Sihaloho/24060122130037</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Sekolah/Universitas:</p>
      <p class="text-lg font-medium">Universitas Diponegoro</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Program Studi:</p>
      <p class="text-lg font-medium">Informatika</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Divisi Kerja:</p>
      <p class="text-lg font-medium">Statistik</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Waktu Magang:</p>
      <p class="text-lg font-medium">12/02/2025 - 02/01/2025</p>
    </div>
    <div class="flex items-start justify-end">
      <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
        Unduh Laporan Magang
      </button>
    </div>
  </div>
</div>

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
          <input type="number" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="5" onchange="validateAndCalculate(this, 5)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">2</td>
        <td class="border px-4 py-2">Ketepatan Waktu</td>
        <td class="border px-4 py-2">5</td>
        <td class="border px-4 py-2">
          <input type="number" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="5" onchange="validateAndCalculate(this, 5)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">3</td>
        <td class="border px-4 py-2">Sikap Kerja/Prosedur Kerja</td>
        <td class="border px-4 py-2">10</td>
        <td class="border px-4 py-2">
          <input type="number" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="10" onchange="validateAndCalculate(this, 10)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">4</td>
        <td class="border px-4 py-2">Kemampuan Bekerja dalam Tim</td>
        <td class="border px-4 py-2">10</td>
        <td class="border px-4 py-2">
          <input type="number" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="10" onchange="validateAndCalculate(this, 10)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">5</td>
        <td class="border px-4 py-2">Kreatifitas Kerja</td>
        <td class="border px-4 py-2">10</td>
        <td class="border px-4 py-2">
          <input type="number" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="10" onchange="validateAndCalculate(this, 10)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">6</td>
        <td class="border px-4 py-2">Insitatif Kerja</td>
        <td class="border px-4 py-2">15</td>
        <td class="border px-4 py-2">
          <input type="number" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="15" onchange="validateAndCalculate(this, 15)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">7</td>
        <td class="border px-4 py-2">Kemampuan Komunikasi</td>
        <td class="border px-4 py-2">15</td>
        <td class="border px-4 py-2">
          <input type="number" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="15" onchange="validateAndCalculate(this, 15)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">8</td>
        <td class="border px-4 py-2">Kemampuan Teknikal</td>
        <td class="border px-4 py-2">20</td>
        <td class="border px-4 py-2">
          <input type="number" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="20" onchange="validateAndCalculate(this, 20)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">9</td>
        <td class="border px-4 py-2">Kepercayaan Diri</td>
        <td class="border px-4 py-2">5</td>
        <td class="border px-4 py-2">
          <input type="number" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="5" onchange="validateAndCalculate(this, 5)" />
        </td>
      </tr>
      <tr>
        <td class="border px-4 py-2">10</td>
        <td class="border px-4 py-2">Penampilan/Kerapihan</td>
        <td class="border px-4 py-2">5</td>
        <td class="border px-4 py-2">
          <input type="number" class="score-input w-20 px-2 py-1 border rounded-lg" 
            min="1" max="5" onchange="validateAndCalculate(this, 5)" />
        </td>
      </tr>
      <!-- Tambahkan parameter lainnya di sini -->
      <!-- Nilai Total -->
      <tr class="bg-gray-200">
        <td class="border px-4 py-2 font-bold" colspan="3">Nilai Total</td>
        <td class="border px-4 py-2 font-bold text-red-500" id="totalScore">0</td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Keterangan -->
<div class="mt-4 ml-8 inter-font">
  <p class="text-sm text-gray-600">Keterangan:</p>
  <p class="text-sm text-gray-600">Nilai dalam bentuk angka dari 1 sampai nilai bobot.</p>
</div>

<!-- Tombol Simpan -->
<div class="flex justify-end mr-9 inter-font">
    <button id="actionButton" 
    class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
    onclick="toggleEdit()">
    Simpan
    </button>
</div>
</div>
<script>
    // Contoh data nilai awal
    const initialScores = [4, 5, 7, 8, 9, 12, 13, 17, 4, 5]; // Nilai awal yang diambil dari data
  
    let isEditable = false; // Status input apakah editable atau tidak (default 'false' = tidak editable)
  
    document.addEventListener('DOMContentLoaded', () => {
      // Mengisi input dengan nilai awal saat halaman dimuat
      const inputs = document.querySelectorAll('.score-input');
      inputs.forEach((input, index) => {
        input.value = initialScores[index] || 0; // Mengisi input dengan nilai awal
        input.disabled = !isEditable; // Pastikan input terkunci (disabled) saat awal
      });
  
      // Set tombol untuk pertama kali menjadi "Edit"
      const actionButton = document.getElementById('actionButton');
      actionButton.textContent = 'Edit';
  
      // Menghitung nilai total pada saat halaman dimuat
      calculateTotal();
    });
  
    function toggleEdit() {
      const inputs = document.querySelectorAll('.score-input');
      const actionButton = document.getElementById('actionButton');
  
      if (isEditable) {
        // Jika sudah dalam mode edit, kunci input dan ubah tombol menjadi "Edit"
        inputs.forEach(input => input.disabled = true);
        actionButton.textContent = 'Edit';
      } else {
        // Jika tidak dalam mode edit, buka input dan ubah tombol menjadi "Simpan"
        inputs.forEach(input => input.disabled = false);
        actionButton.textContent = 'Simpan';
      }
  
      isEditable = !isEditable; // Toggle status (mode edit / simpan)
    }
  
    function validateAndCalculate(input, max) {
      const value = parseFloat(input.value);
      if (!Number.isInteger(value)) {
        alert('Masukkan nilai berupa bilangan bulat.');
        input.value = '';
      } else if (value < 1 || value > max || isNaN(value)) {
        alert(`Masukkan nilai antara 1 dan ${max}`);
        input.value = '';
      } else {
        // Hitung total nilai jika valid
        calculateTotal();
      }
    }
  
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