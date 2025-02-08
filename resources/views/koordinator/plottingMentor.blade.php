@extends('layouts.app')

@section('title', 'Pembagian Magang')

@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
    .card {
        background-color:#fdf2ee;
        text-align: start;
        margin-top: 40px;
        margin-left: 20px;
        box-shadow: none;
    }

    .input-group {
        display: flex;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 20px;
        box-shadow: #403333;
    }

    .searchInput {
        max-width: 250px;
        height: 30px;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        padding: 5px;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1); /* Inner shadow for search bar */
    }

    .btn {
        background-color: #B31312;
        padding: 5px;
        color: #fff;
        height: 30px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .table th, .table td {
        border: 1px solid #FF885B;
        padding: 10px;
        text-align: center;
    }

    .table thead {
        background-color: #FF885B;
        color: #fff;
        font-size: 15px;
        border-radius: 10px;
    }

    .table tbody {
        background-color: rgba(64, 51, 51, 0.05);
        font-size: 12px;
    }

    .table tbody td {
        font-family: 'Inter', sans-serif;
        text-align: start;
    }

    .table tbody td:last-child {
        text-align: center;
        border-radius: 10px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 15px; /* Round the corners of the table */
        margin-top: 20px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
    }

    .btn-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px; /* Jarak antara tombol */
    }

    .btn-setujui, .btn-tolak, .btn-detail, .btn-confmentor {
        width: 80%; /* Mengatur lebar tombol agar proporsional dengan sel tabel */
        padding: 5px 0;
        font-size: 12px;
        border-radius: 12px;
        text-align: center;
        font-weight: bold;
        border: none;
        justify-content: center
    }

    .btn-confmentor {
        font-size: 15px;
        font-family: 'Inter', serif;
        background-color: #FF885B;
        color: white;
        padding: 10px;
        display: inline-block; /* Memastikan tombol hanya mengambil ruang yang diperlukan */
        width: auto; /* Membiarkan tombol menyesuaikan dengan teksnya */
        margin-top: 40px;
        box-shadow: 0 2px 2px rgba(0, 0, 0, 0.25);
    }

    .btn-setujui {
        background-color: #FFDD55;
        color: #333;
    }

    .btn-tolak {
        background-color: #B31312;
        color: white;
    }

    .btn-detail {
        background-color: #FFDD55;
        color: #403333;
        padding:5px;
        box-shadow: 0 2px 2px rgba(0, 0, 0, 0.25);
    }

    .btn-setujui:hover {
        background-color: #FFC107;
    }

    .btn-confmentor:hover {
        background-color: #e2693d;
    }

    .btn-detail:hover {
        background-color: #FFC107;
    }
    
    .btn-ya {
        background-color: #FF885B !important;
        color: white !important;
    }

    .btn-tidak {
        background-color: #B31312 !important;
        color: white !important;
    }

    .icon-approval .swal2-icon {
        background-color: #FF8800 !important; /* Warna latar belakang ikon */
        color: white !important; /* Warna ikon */
    }

    .icon-rejection .swal2-icon {
        background-color: #C62828 !important; /* Warna latar belakang ikon */
        color: white !important; /* Warna ikon */
    }

    .pagination-controls {
        display: flex;
        justify-content: flex-end;
        gap: 0;
        align-items: center;
    }

    .pagination-controls button {
        padding: 5px 10px;
        font-size: 14px;
        background-color: #B31312; /* Set page buttons background to white */
        color: #fdf2ee; /* Default text color */
        border-radius: 0; /* Reset border-radius */
        box-shadow: 0 2px 0 rgba(0, 0, 0, 0.25);
    }

    .pagination-controls .page-number {
        padding: 5px 10px;
        font-size: 14px;
        background-color: white; /* Set page buttons background to white */
        color: #403333; /* Default text color */
        border-radius: 0; /* Reset border-radius */
        box-shadow: 0 2px 0 rgba(0, 0, 0, 0.25);
    }

    .pagination-controls button:disabled {
        background-color: #cccccc;
        color: #666666;
    }

    .pagination-controls .page-number.current-page {
        color: #FF885B;
    }

    .pagination-controls .page-number:not(.current-page):hover {
        color: #FF885B; /* Slightly highlighted on hover for non-current pages */
    }

    .pagination-controls button:first-child {
        border-top-left-radius: 15px; /* Roundness for Prev button */
        border-bottom-left-radius: 15px;
    }

    .pagination-controls button:last-child {
        border-top-right-radius: 15px; /* Roundness for Next button */
        border-bottom-right-radius: 15px;
    }

    .page-info {
        text-align: left;
        font-size: 14px;
        margin-top: 10px;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 500px;
        border-radius: 10px;
        text-align: center;
        justify-content: center;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

</style>

<h1 class="header">Plotting Mentor</h1>

<div class="card">
    <div class="input-group">
        <input type="text" class="form-control searchInput" id="searchInput" placeholder="Pencarian">
        <button class="btn" type="button" id="button-addon2">
            <span class="material-icons">search</span> <!-- Ganti dengan ikon pencarian -->
        </button>
    </div>    
    
    <div class="entries">
        <label for="entriesPerPage">Tampilkan</label>
        <select id="entriesPerPage" onchange="updateEntriesPerPage()">
            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span>entri</span>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Sekolah / Perguruan Tinggi</th>
                    <th>Dinas</th>
                    <th>Periode</th>
                    <th>Mentor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peserta as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->nama_peserta }}</td>
                        <td>{{ $p->asal_sekolah }}</td>
                        <td class="dinas-cell" value="{{ $p->kode_instansi }}">{{ $p->nama_instansi }}</td>
                        <td>{{ date('d/m/Y', strtotime($p->tanggal_mulai)) }} - {{ date('d/m/Y', strtotime($p->tanggal_selesai)) }}</td>
                        <td>
                            <!-- Button for selecting a mentor -->
                            <button class="btn-detail pilih-mentor-btn" 
                                    data-index="{{ $index }}" 
                                    data-instansi="{{ $p->kode_instansi }}"
                                    data-nip="{{ $p->nip_peserta }}">
                                Pilih Mentor
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="page-info" id="page-info">
        Menampilkan halaman 1 dari 4 halaman
    </div>
    
    <div class="pagination-controls" id="pagination-controls">
        <!-- Pagination buttons will be generated here -->
    </div>
</div>

<!-- Modal -->
<div id="mentorModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 style="font-size: 30px; text-align:center; padding-bottom:50px;">Pilih Mentor</h2>
        <div style="display: flex; justify-content: center">
            <select id="mentorDropdown" disabled>
                <option value="" disabled selected>Pilih Mentor</option>
            </select>
        </div>
        <button id="confirmMentorBtn" class="btn-confmentor" style="justify-content: center">Simpan</button>
    </div>
</div>

{{-- Script untuk Search bar dan Pagination --}}
<script>
let currentPage = 1;
let rowsPerPage = 5;
let originalRows = [];
let filteredRows = [];

document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.querySelector('.table tbody');
    originalRows = Array.from(tableBody.rows).map(row => row.outerHTML);
    filteredRows = originalRows.slice();
    updatePagination();

    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', filterTable);
});

function filterTable() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    filteredRows = originalRows.filter(rowHTML => {
        const row = document.createElement('tr');
        row.innerHTML = rowHTML;
        return Array.from(row.cells).some(cell => cell.textContent.toLowerCase().includes(searchTerm));
    });

    currentPage = 1;
    updatePagination();
}

function updatePagination() {
    const tableBody = document.querySelector('.table tbody');
    tableBody.innerHTML = '';

    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const rowsToDisplay = filteredRows.slice(start, end);

    rowsToDisplay.forEach((rowHTML, index) => {
        const row = document.createElement('tr');
        row.innerHTML = rowHTML;
        row.cells[0].textContent = start + index + 1; // Update the number column
        tableBody.appendChild(row);
    });

    renderPaginationControls();
    updatePageInfo();
}

function renderPaginationControls() {
    const paginationControls = document.getElementById('pagination-controls');
    paginationControls.innerHTML = '';

    const totalPages = Math.ceil(originalRows.length / rowsPerPage);

    // Menentukan range halaman yang ditampilkan
    let startPage = currentPage - 2;
    let endPage = currentPage + 2;

    // Pastikan startPage dan endPage berada dalam batasan yang valid
    if (startPage < 1) {
        startPage = 1;
        endPage = Math.min(5, totalPages);
    }

    if (endPage > totalPages) {
        endPage = totalPages;
        startPage = Math.max(totalPages - 4, 1);
    }

    // Tombol "Prev"
    const prevButton = document.createElement('button');
    prevButton.textContent = 'Prev';
    prevButton.disabled = currentPage === 1;
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    });
    paginationControls.appendChild(prevButton);

    // Tombol nomor halaman
    for (let i = startPage; i <= endPage; i++) {
        const pageButton = document.createElement('button');
        pageButton.classList.add('page-number');
        pageButton.textContent = i;
        if (i === currentPage) {
            pageButton.classList.add('current-page');
        }
        pageButton.addEventListener('click', () => {
            currentPage = i;
            updatePagination();
        });
        paginationControls.appendChild(pageButton);
    }

    // Tombol "Next"
    const nextButton = document.createElement('button');
    nextButton.textContent = 'Next';
    nextButton.disabled = currentPage === totalPages;
    nextButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            updatePagination();
        }
    });
    paginationControls.appendChild(nextButton);
}

function updateEntriesPerPage() {
    rowsPerPage = parseInt(document.getElementById('entriesPerPage').value, 10);
    currentPage = 1;
    updatePagination();
}

function updatePageInfo() {
    const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
    const pageInfo = document.getElementById('page-info');
    pageInfo.textContent = Menampilkan halaman ${currentPage} dari ${totalPages} halaman;
}

</script>

{{-- Mentor --}}
<script>

    document.addEventListener('DOMContentLoaded', () => {
        const rows = document.querySelectorAll('.table tbody tr');
        rows.forEach(row => {
            const dinasCell = row.querySelector('.dinas-cell').textContent.trim();
            const mentorDropdown = row.querySelector('.mentor-dropdown');
            const mentors = kodeInstansi[dinasCell] || [];

            mentors.forEach(mentor => {
                const option = document.createElement('option');
                option.value = mentor;
                option.textContent = mentor;
                mentorDropdown.appendChild(option);
            });
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mentorModal = document.getElementById('mentorModal');
    const mentorDropdown = document.getElementById('mentorDropdown');
    const confirmMentorBtn = document.getElementById('confirmMentorBtn');
    const closeModalBtn = document.querySelector('.close'); 

    let selectedParticipantNIP = null;
    let previousMentor = null;  // Menyimpan mentor sebelumnya

    document.querySelectorAll('.pilih-mentor-btn').forEach(button => {
        button.addEventListener('click', async function () {
            const kodeInstansi = this.getAttribute('data-instansi');
            selectedParticipantNIP = this.getAttribute('data-nip'); 

            if (!selectedParticipantNIP) {
                alert("Peserta tidak ditemukan! Mohon periksa kembali.");
                return;
            }

            mentorDropdown.innerHTML = '<option value="" disabled selected>Pilih Mentor</option>';
            mentorDropdown.disabled = true;

            try{
                const response = await fetch(`/koordinator/get-mentors?kode_instansi=${kodeInstansi}`); // Tambahkan backtick (`) di awal dan akhir URL
                const data = await response.json();
                console.log(data);

                if (!data.mentors || data.mentors.length === 0) {
                    alert('Tidak ada mentor tersedia untuk instansi ini.');
                    return;
                }

                // Simpan mentor yang sudah dipilih sebelumnya
                previousMentor = mentorDropdown.value || null;

                // Mengisi dropdown dengan mentor yang tersedia
                data.mentors.forEach(mentor => {
                    mentorDropdown.innerHTML += <option value="${mentor.nip_mentor}">${mentor.nama}</option>;
                });
                mentorDropdown.disabled = false;
                mentorModal.style.display = 'block';
            } catch (error) {
                console.error('Error fetching mentors:', error);
                alert('Gagal mengambil data mentor.');
            }
        });
    });

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function () {
            mentorModal.style.display = 'none';
        });
    }

    confirmMentorBtn.addEventListener('click', async function () {
        const selectedMentor = mentorDropdown.value;

        if (!selectedMentor) {
            alert('Pilih mentor terlebih dahulu!');
            return;
        }

        if (!selectedParticipantNIP) {
            alert('Peserta tidak ditemukan!');
            return;
        }

        // Cek jika mentor yang dipilih berbeda dengan mentor sebelumnya
        if (selectedMentor === previousMentor) {
            Swal.fire({
                icon: 'error',
                title: 'Tidak ada perubahan!',
                text: 'Mentor yang dipilih sama dengan yang sebelumnya.',
                confirmButtonColor: '#B31312',
            });
            return;
        }

        console.log("Data yang akan dikirim:", {
            nip_peserta: selectedParticipantNIP,
            nip_mentor: selectedMentor
        });

        try {
            // Kirim request untuk memilih mentor (Anda bisa tetap menggunakan POST jika diperlukan)
            const response = await fetch('/koordinator/plot-mentor', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    nip_peserta: selectedParticipantNIP,
                    nip_mentor: selectedMentor
                })
            });

            const result = await response.json();

            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Mentor berhasil dipilih!',
                    text: result.message,
                    confirmButtonColor: '#FF885B',
                }).then(() => {
                    mentorModal.style.display = 'none';
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal memilih mentor!',
                    text: result.message || 'Terjadi kesalahan.',
                    confirmButtonColor: '#B31312',
                });
            }
        } catch (error) {
            console.error('Error plotting mentor:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal memilih mentor!',
                text: result.message || 'Terjadi kesalahan.', // Display the error message from the server
                confirmButtonColor: '#B31312',
            });
        } else { // Handle unexpected status
            console.error('Unexpected response:', result);
            Swal.fire({
                icon: 'error',
                title: 'Gagal memilih mentor!',
                text: 'Terjadi kesalahan yang tidak terduga.',
                confirmButtonColor: '#B31312',
            });
        }

    } catch (error) {
        console.error('Error plotting mentor:', error); // Log the full error details to the console
        Swal.fire({
            icon: 'error',
            title: 'Gagal memilih mentor!',
            text: error.message || 'Terjadi kesalahan saat menyimpan data.', // Display the error message
            confirmButtonColor: '#B31312',
        });
    }
});
});


</script>

@endsection