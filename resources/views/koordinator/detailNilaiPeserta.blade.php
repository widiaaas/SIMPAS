@extends('layouts.app')

@section('title', 'Detail Nilai Peserta - SIMPAS')

@section('content')

<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    .btn-setujui {
        margin-left: 5px;
        font-size: 16px;
        border-radius: 7px;
        text-align: center;
        border: none;
        background-color: #FFDD55;
        color: #333;
    }

    .btn-setujui:hover {
        background-color: #FFC107;
    }
</style>

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
      <p class="text-lg font-medium">{{ $peserta->nama }} / {{ $peserta->nip }}</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Sekolah/Universitas:</p>
      <p class="text-lg font-medium">{{ $peserta->asal_sekolah }}</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Program Studi:</p>
      <p class="text-lg font-medium">{{ $peserta->jurusan }}</p>
      <p class="text-sm font-semibold text-gray-600 mt-2">Waktu Magang:</p>
      <p class="text-lg font-medium">{{ date('d/m/Y', strtotime($peserta->tanggal_mulai)) }} - {{ date('d/m/Y', strtotime($peserta->tanggal_selesai)) }}</p>
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
        <td class="border px-4 py-2">Kreativitas Kerja</td>
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
    <button id="confirmButton" class="px-6 py-2 btn-setujui">Konfirmasi</button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const initialScores = [
      {{ $peserta->nilai1 ?? 0 }},
      {{ $peserta->nilai2 ?? 0 }},
      {{ $peserta->nilai3 ?? 0 }},
      {{ $peserta->nilai4 ?? 0 }},
      {{ $peserta->nilai5 ?? 0 }},
      {{ $peserta->nilai6 ?? 0 }},
      {{ $peserta->nilai7 ?? 0 }},
      {{ $peserta->nilai8 ?? 0 }},
      {{ $peserta->nilai9 ?? 0 }},
      {{ $peserta->nilai10 ?? 0 }}
    ];

    let isEditable = false;
    let nipPeserta = "{{ $peserta->nip }}";

    const inputs = document.querySelectorAll('.score-input');
    inputs.forEach((input, index) => {
      input.value = initialScores[index] || 0;
      input.disabled = !isEditable;
    });

    const actionButton = document.getElementById('actionButton');
    const confirmButton = document.getElementById('confirmButton');
    actionButton.textContent = 'Edit';

    calculateTotal();

    actionButton.addEventListener('click', function() {
      if (isEditable) {
        const updatedScores = Array.from(inputs).map(input => parseInt(input.value, 10));

        // Kirim data ke server dengan fetch
        fetch("{{ route('updateNilaiPeserta', $peserta->nip) }}", {

          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            nilai1: updatedScores[0],
            nilai2: updatedScores[1],
            nilai3: updatedScores[2],
            nilai4: updatedScores[3],
            nilai5: updatedScores[4],
            nilai6: updatedScores[5],
            nilai7: updatedScores[6],
            nilai8: updatedScores[7],
            nilai9: updatedScores[8],
            nilai10: updatedScores[9]
          })
        })
        .then(response => response.json())
        .then(data => {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: data.message
          }).then(() => {
            location.reload();
          });
        })
        .catch(error => {
          Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            text: 'Periksa kembali nilai yang dimasukkan.'
          });
        });
      } else {
        inputs.forEach(input => input.disabled = false);
        actionButton.textContent = 'Simpan';
      }

      isEditable = !isEditable;
    });
    // Tombol Konfirmasi
    confirmButton.addEventListener('click', function() {
      Swal.fire({
        title: 'Konfirmasi Penilaian?',
        text: 'Nilai tidak dapat diubah kembali',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch("{{ route('konfirmasiPenilaian', $peserta->nip) }}",  {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: "Sudah disetujui" })
          })
          .then(response => response.json())
          .then(data => {
            Swal.fire({
              icon: 'success',
              title: 'Penilaian Disetujui!',
              text: data.message
            }).then(() => {
              window.location.href = '/koordinator/penilaianPeserta';
            });
          })
          .catch(error => {
            Swal.fire({
              icon: 'error',
              title: 'Terjadi Kesalahan!',
              text: 'Gagal mengonfirmasi penilaian. Coba lagi nanti.'
            });
          });
        }
      });
    });
  });

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