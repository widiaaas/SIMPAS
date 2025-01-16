
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penilaian Peserta Magang - SIMPAS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
      @import url('https://fonts.googleapis.com/css2?family=Aoboshi+One&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

      .inter-font {
          font-family: "Inter", serif;
          font-optical-sizing: auto;
          font-weight: 400;
          font-style: normal;
      }
      .aoboshi-one-regular {
          font-family: "Aoboshi One", serif;
          font-weight: 400;
          font-style: normal;
      }
  </style>
  <script>
    let isEditable = true; // Status input apakah editable atau tidak

// Fungsi untuk mengubah status edit
function toggleEdit() {
    const inputs = document.querySelectorAll('.score-input');
    const actionButton = document.getElementById('actionButton');

    if (isEditable) {
        // Jika sedang editable dan tombol diklik, kunci input
        inputs.forEach(input => input.disabled = true);
        actionButton.textContent = 'Edit';
    } else {
        // Jika tidak editable, aktifkan input
        inputs.forEach(input => input.disabled = false);
        actionButton.textContent = 'Simpan';
    }

    isEditable = !isEditable; // Toggle status
}
    // Fungsi validasi input dan perhitungan total
    function validateAndCalculate(input, max) {
      const value = parseInt(input.value, 10);
      if (value < 1 || value > max || isNaN(value)) {
        alert(`Masukkan nilai antara 1 dan ${max}`);
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
</head>
<body class="bg-gray-100 inter-font">
  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <x-sidebar-mentor></x-sidebar-mentor>

    <!-- Main Content -->
    <main class="flex-1 bg-[#fdf7f4] p-8 rounded-tl-lg overflow-auto">
      <div class="max-w-5xl mx-auto">
        <a class="text-[#282A4C] text-lg mb-4 block inter-font font-bold" href="/mentor/daftarPeserta">
            <i class="fas fa-arrow-left">
            </i>
            Kembali
        </a>
        <div class="flex justify-between items-center mb-9">
            <h2 class="text-2xl aoboshi-one-regular font-bold text-[#b12a2f]">
                Penilaian Peserta Magang
            </h2>
            <div class="flex items-center justify-end">
                <div class="text-right">
                    <p class="aoboshi-one-regular text-sm text-[#b12a2f]">Pemerintah Kota</p>
                    <p class="aoboshi-one-regular text-sm text-[#b12a2f]">Semarang</p>
                </div>
                <img src="{{asset('img/pemkot.png')}}" class="ml-2" width="30" alt="Logo Pemerintah Kota Semarang" />
            </div>
        </div>
        <!-- Informasi Peserta -->
        <div class="bg-[#fdf7f4] rounded-lg p-6 mt-4">
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
        <div class="overflow-x-auto mt-6">
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
        <div class="mt-4">
          <p class="text-sm text-gray-600">Keterangan:</p>
          <p class="text-sm text-gray-600">Nilai dalam bentuk angka dari 1 sampai nilai bobot.</p>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end mt-6">
            <button id="actionButton" 
            class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
            onclick="toggleEdit()">
            Simpan
            </button>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
