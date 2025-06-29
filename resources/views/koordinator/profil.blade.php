@extends('layouts.app')

@section('title', 'Profil Koordinator')

@section('sidebar')

@section('content')
<h1 class="header">Profil</h1>

<style>
    .profile-container {
        display: flex;
        height: 100vh;
        background-color: #fdf7f4;
        font-family: 'Roboto', sans-serif;
    }

    .profile-content {
        flex: 1;
        padding: 2rem;
    }

    .profile-header h2,
    .profile-header p {
        color: #3e2c2c;
    }

    .profile-header h2 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .profile-header p {
        font-size: 1.125rem;
    }

    .profile-section {
        margin-top: 1.5rem;
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .profile-section {
            grid-template-columns: 1fr 1fr;
        }
    }

    .profile-label {
        font-style: italic;
        font-size: 0.875rem;
        font-weight: 500;
        color: #4a4a4a;
    }

    .profile-value {
        background-color: #ffccbc;
        color: #3e2c2c;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }

    .edit-button {
        background-color: #ff8a65;
        color: white;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        font-weight: normal;
        transition: background-color 0.3s;
    }

    .edit-button:hover {
        background-color: #ff7043;
        font-weight: bold;
    }

    .save-button {
        background-color: #4caf50;
        color: white;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        font-weight: normal;
        transition: background-color 0.3s;
        margin-left: 1rem;
    }

    .save-button:hover {
        background-color: #43a047;
        font-weight: bold;
    }

    .hidden {
        display: none;
    }
</style>

<div class="profile-container">
    <div class="profile-content">
        <div class="profile-header mb-6">
            <h2>{{ $koordinator->nama }}</h2>
            <p>{{ $koordinator->nip_koor }}</p>
        </div>
        <hr class="border-t border-gray-300 mb-6" />
        <div class="profile-section">
            <div>
                <label class="profile-label">NIP</label>
                <p class="profile-value">{{ $koordinator->nip_koor }}</p>
            </div>
            <div>
                <label class="profile-label">Nama</label>
                <p class="profile-value">{{ $koordinator->nama }}</p>
            </div>
            <div>
                <label class="profile-label">Instansi</label>
                <p class="profile-value">{{ $instansi->nama_instansi ?? 'Instansi Tidak Ditemukan' }}</p>
            </div>
            <div>
                <label class="profile-label">Nomor Telepon</label>
                <div class="profile-value">
                    <span id="phone-display">{{ $koordinator->no_telp }}</span>
                    <input type="text" id="phone-edit" class="hidden" value={{ $koordinator->no_telp }} />
                </div>
            </div>
            <div>
                <label class="profile-label">Email</label>
                <div class="profile-value">
                    <span id="email-display">{{ $koordinator->email }}</span>
                    <input type="text" id="email-edit" class="hidden" value={{ $koordinator->email }} />
                </div>
            </div>
            <div>
                <label class="profile-label">Alamat</label>
                <div class="profile-value">
                    <span id="alamat-display">{{ $koordinator->alamat }}</span>
                    <input type="text" id="alamat-edit" class="hidden" value={{ $koordinator->alamat }} />
                </div>
            </div>
        </div>
        <div class="mt-6 text-right">
            <form action="{{ route('koordinator.editProfil') }}" method="POST" id="profile-form">
                @csrf
                <input type="hidden" name="phone" id="phone-input" value="">
                <input type="hidden" name="email" id="email-input" value="">
                <input type="hidden" name="alamat" id="alamat-input" value="">
                <button type="button" class="edit-button" id="edit-button">Edit</button>
                <button type="submit" class="save-button hidden" id="save-button">Save</button>
            </form>
        </div>
    </div>
</div>

<script>
    const editButton = document.getElementById('edit-button');
    const saveButton = document.getElementById('save-button');

    const phoneDisplay = document.getElementById('phone-display');
    const phoneEdit = document.getElementById('phone-edit');

    const emailDisplay = document.getElementById('email-display');
    const emailEdit = document.getElementById('email-edit');

    const alamatDisplay = document.getElementById('alamat-display');
    const alamatEdit = document.getElementById('alamat-edit');

    const phoneInput = document.getElementById('phone-input');
    const emailInput = document.getElementById('email-input');
    const alamatInput = document.getElementById('alamat-input');
    const form = document.getElementById('profile-form');

    editButton.addEventListener('click', function () {
        // Toggle Edit Mode
        phoneDisplay.classList.add('hidden');
        phoneEdit.classList.remove('hidden');
        emailDisplay.classList.add('hidden');
        emailEdit.classList.remove('hidden');
        alamatDisplay.classList.add('hidden');
        alamatEdit.classList.remove('hidden');

        // Set nilai input dengan nilai awal dari tampilan
        phoneEdit.value = phoneDisplay.textContent.trim();
        emailEdit.value = emailDisplay.textContent.trim();
        alamatEdit.value = alamatDisplay.textContent.trim();

        // Show Save Button
        saveButton.classList.remove('hidden');
        editButton.classList.add('hidden');
    });

    saveButton.addEventListener('click', function (event) {
        // Masukkan nilai input ke dalam form
        phoneInput.value = phoneEdit.value;
        emailInput.value = emailEdit.value;

        // Gunakan SweetAlert2 untuk konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Perubahan yang Anda buat akan disimpan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kembali ke mode non-edit
                phoneDisplay.textContent = phoneEdit.value;
                emailDisplay.textContent = emailEdit.value;
                alamatDisplay.textContent = alamatEdit.value;
                phoneDisplay.classList.remove('hidden');
                phoneEdit.classList.add('hidden');
                emailDisplay.classList.remove('hidden');
                emailEdit.classList.add('hidden');
                alamatDisplay.classList.remove('hidden');
                alamatEdit.classList.add('hidden');

                // Ubah tombol save kembali ke edit
                saveButton.classList.add('hidden');
                editButton.classList.remove('hidden');
                
                // Kirim form
                if (result.isConfirmed) {
                    // Kirim form setelah konfirmasi
                    form.submit();
                }
            } else {
                // Kembali ke mode non-edit saat dibatalkan
                phoneEdit.classList.add('hidden');
                phoneDisplay.classList.remove('hidden');
                emailEdit.classList.add('hidden');
                emailDisplay.classList.remove('hidden');
                alamatEdit.classList.add('hidden');
                alamatDisplay.classList.remove('hidden');

                // Ubah tombol save kembali ke edit
                saveButton.classList.add('hidden');
                editButton.classList.remove('hidden');
            }
        });

        // Mencegah pengiriman form default saat tombol diklik
        event.preventDefault();
});


</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- pesan sukses -->
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

<!-- pesan error -->
@if ($errors->has('phone'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ $errors->first("phone") }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if ($errors->has('email'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ $errors->first("email") }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if ($errors->has('alamat'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ $errors->first("alamat") }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@endsection