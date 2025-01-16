@extends('layouts.app')

@section('title', 'SKL')

@section('content')
<h1 class="header">SKL</h1>
<style>
    .container {
        padding: 2rem;
    }

    .table-auto {
        width: 100%;
        margin-bottom: 2rem;
        border-collapse: collapse;
    }

    /* Center text for No, Bobot, and Nilai columns */
    .table-auto th, .table-auto td {
        padding: 0.75rem;
        border: 1px solid #ddd;
    }

    .table-auto th:nth-child(1), 
    .table-auto th:nth-child(3), 
    .table-auto th:nth-child(4),
    .table-auto td:nth-child(1), 
    .table-auto td:nth-child(3), 
    .table-auto td:nth-child(4) {
        text-align: center; /* Center content for No, Bobot, and Nilai */
    }

    /* Left-align text for the Parameter Penilaian column */
    .table-auto th:nth-child(2),
    .table-auto td:nth-child(2) {
        text-align: left; /* Left-align content for Parameter Penilaian */
    }

    .bg-orange-400 {
        background-color: #fb923c;
    }

    .text-white {
        color: white;
    }

    .text-gray-600 {
        color: #4b5563;
    }

    .bg-red-500 {
        background-color: #ef4444;
    }

    .hover\:bg-red-600:hover {
        background-color: #dc2626;
    }

    .rounded-lg {
        border-radius: 0.5rem;
    }

    .px-6 {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .py-2 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .text-right {
        text-align: right;
    }

    .font-bold {
        font-weight: bold;
    }
</style>

<div class="container mx-auto p-6">
    <div class="bg-white p-6 shadow-lg rounded-lg">
        <!-- Tabel Penilaian -->
        <table class="min-w-full table-auto">
            <thead class="bg-orange-400 text-white">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Parameter Penilaian</th>
                    <th class="px-4 py-2">Bobot</th>
                    <th class="px-4 py-2">Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2">1</td>
                    <td class="border px-4 py-2">Kehadiran</td>
                    <td class="border px-4 py-2">5</td>
                    <td class="border px-4 py-2"><span>4</span></td> 
                </tr>
                <tr>
                    <td class="border px-4 py-2">2</td>
                    <td class="border px-4 py-2">Ketepatan Waktu</td>
                    <td class="border px-4 py-2">5</td>
                    <td class="border px-4 py-2"><span>5</span></td> 
                </tr>
                <tr>
                    <td class="border px-4 py-2">3</td>
                    <td class="border px-4 py-2">Sikap Kerja / Prosedur Kerja</td>
                    <td class="border px-4 py-2">10</td>
                    <td class="border px-4 py-2"><span>8</span></td> 
                </tr>
                <tr>
                    <td class="border px-4 py-2">4</td>
                    <td class="border px-4 py-2">Kemampuan bekerja dalam Tim</td>
                    <td class="border px-4 py-2">10</td>
                    <td class="border px-4 py-2"><span>7</span></td> 
                </tr>
                <tr>
                    <td class="border px-4 py-2">5</td>
                    <td class="border px-4 py-2">Kreatifitas Kerja</td>
                    <td class="border px-4 py-2">10</td>
                    <td class="border px-4 py-2"><span>9</span></td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">6</td>
                    <td class="border px-4 py-2">Inisiatif Kerja</td>
                    <td class="border px-4 py-2">15</td>
                    <td class="border px-4 py-2"><span>12</span></td> 
                </tr>
                <tr>
                    <td class="border px-4 py-2">7</td>
                    <td class="border px-4 py-2">Kemampuan Komunikasi</td>
                    <td class="border px-4 py-2">15</td>
                    <td class="border px-4 py-2"><span>14</span></td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">8</td>
                    <td class="border px-4 py-2">Kemampuan Teknikal</td>
                    <td class="border px-4 py-2">20</td>
                    <td class="border px-4 py-2"><span>18</span></td> 
                </tr>
                <tr>
                    <td class="border px-4 py-2">9</td>
                    <td class="border px-4 py-2">Kepercayaan Diri</td>
                    <td class="border px-4 py-2">5</td>
                    <td class="border px-4 py-2"><span>3</span></td> 
                </tr>
                <tr>
                    <td class="border px-4 py-2">10</td>
                    <td class="border px-4 py-2">Penampilan / Kerapihan</td>
                    <td class="border px-4 py-2">5</td>
                    <td class="border px-4 py-2"><span>4</span></td> 
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-bold" colspan="2">Nilai Total</td>
                    <td class="border px-4 py-2">100</td>
                    <td class="border px-4 py-2"><span>4</span></td> 
                </tr>
            </tbody>
        </table>

        <!-- Keterangan -->
        <div class="mt-6 text-right">
            <p class="text-sm text-gray-600">
                Keterangan: Nilai dalam bentuk angka dari 1 sampai nilai bobot
            </p>
        </div>

        <!-- Tombol Unduh SKL -->
        <div class="mt-6 text-right">
            <a href="#" class="bg-red-500 text-white rounded-lg hover:bg-red-600 px-6 py-2">Unduh SKL</a>
        </div>
    </div>
</div>

@endsection
