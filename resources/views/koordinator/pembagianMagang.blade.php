@extends('layouts.app')

@section('title', 'Pembagian Magang')

@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    .input-group {
        display: flex;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .searchInput {
        max-width: 250px;
        height: 20px;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        padding: 5px;
    }

    .btn {
        background-color: #B31312;
        color: #fff;
        height: 35px;
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
        font-family: 'Inter', sans-serif;
        font-size: 15px;
    }

    .table tbody {
        background-color: #FEF7F4;
        font-family: 'Inter', sans-serif;
        font-size: 12px;
    }

    .table tbody td {
        text-align: start;
    }

    .table tbody td:last-child {
        text-align: center;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px; /* Jarak antara tombol */
    }

    .btn-setujui, .btn-tolak, .btn-detail {
        width: 80%; /* Mengatur lebar tombol agar proporsional dengan sel tabel */
        padding: 5px 0;
        font-size: 12px;
        border-radius: 12px;
        text-align: center;
        font-weight: bold;
        border: none;
    }

    .btn-setujui {
        background-color: #FFDD55;
        color: #333;
    }

    .btn-tolak {
        background-color: #FF4444;
        color: white;
    }

    .btn-detail {
        background-color: #FF885B;
        color: white;
    }

    .btn-setujui:hover {
        background-color: #FFC107;
    }

    .btn-tolak:hover {
        background-color: #C62828;
    }

    .btn-detail:hover {
        background-color: #E57373;
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
    
</style>

<h1 class="header">Pembagian Magang</h1>


<div class="input-group">
    <input type="text" class="form-control searchInput" id="searchInput" placeholder="Pencarian">
    <button class="btn" type="button" id="button-addon2">Cari</button>
</div>

<div class="entries">
    <label for="entriesPerPage">Tampilkan</label>
    <select id="entriesPerPage" onchange="updateEntriesPerPage()">
        <option value="5">5</option>
        <option value="10" selected>10</option>
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
                <th>Bidang</th>
                <th>Periode</th>
                <th>Setujui</th>
            </tr>
        </thead>
        <tbody>
            @foreach(range(1, 20) as $index)
                <tr>
                    <td>{{ $index }}</td>
                    <td>Nama Siswa {{ $index }}</td>
                    <td>Universitas {{ $index }}</td>
                    <td>Dinas {{ $index }}</td>
                    <td>Bidang {{ $index }}</td>
                    <td>{{ date('d/m/Y', strtotime('+'. $index .' days')) }} - {{ date('d/m/Y', strtotime('+'. ($index + 10) .' days')) }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn-setujui" onclick="confirmApproval()">Setujui</button>
                            <button class="btn-tolak" onclick="confirmRejection()">Tolak</button>
                            <button class="btn-detail">
                                <a href="/koor/pembagianMagang/detailPendaftarMagang" style="color: white;">Lihat Detail</a>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="pagination-controls" class="pagination-controls"></div>
</div>

<script>
    function confirmApproval() {
        Swal.fire({
            title: 'Setujui Pengajuan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            customClass: {
                confirmButton: 'btn-ya',
                cancelButton: 'btn-tidak',
                icon: 'icon-approval'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Pengajuan disetujui!', '', 'success');
            }
        });
    }

    function confirmRejection() {
        Swal.fire({
            title: 'Tolak Pengajuan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            customClass: {
                confirmButton: 'btn-ya',
                cancelButton: 'btn-tidak',
                icon: 'icon-rejection'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Pengajuan ditolak!', '', 'success');
            }
        });
    }
</script>

<script>
    let currentPage = 1;
    let rowsPerPage = 10;
    let originalRows = [];

    document.addEventListener('DOMContentLoaded', () => {
        const tableBody = document.querySelector('.table tbody');
        originalRows = Array.from(tableBody.rows).map(row => row.outerHTML);
        updatePagination();
    });

    function updatePagination() {
        const tableBody = document.querySelector('.table tbody');
        tableBody.innerHTML = '';

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const rowsToDisplay = originalRows.slice(start, end);

        rowsToDisplay.forEach(rowHTML => tableBody.innerHTML += rowHTML);

        renderPaginationControls();
    }

    function renderPaginationControls() {
        const paginationControls = document.getElementById('pagination-controls');
        paginationControls.innerHTML = '';

        const totalPages = Math.ceil(originalRows.length / rowsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.textContent = i;
            button.className = 'pagination-button';
            if (i === currentPage) button.disabled = true;
            button.addEventListener('click', () => {
                currentPage = i;
                updatePagination();
            });
            paginationControls.appendChild(button);
        }
    }

    function updateEntriesPerPage() {
        rowsPerPage = parseInt(document.getElementById('entriesPerPage').value, 10);
        currentPage = 1;
        updatePagination();
    }
</script>
>

@endsection
