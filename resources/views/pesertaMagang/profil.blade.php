@extends('layouts.app')

@section('title', 'Dashboard Peserta Magang')

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
            <h2>Widiawati Sihaloho</h2>
            <p>24060122120037</p>
        </div>
        <hr class="border-t border-gray-300 mb-6" />
        <div class="profile-section">
            <div>
                <label class="profile-label">Nama</label>
                <p class="profile-value">Widiawati Sihaloho</p>
            </div>
            <div>
                <label class="profile-label">Nomor Telepon</label>
                <div class="profile-value">
                    <span id="phone-display">081313243434</span>
                    <input type="text" id="phone-edit" class="hidden" value="081313243434" />
                </div>
            </div>
            <div>
                <label class="profile-label">Asal Sekolah/Perguruan Tinggi</label>
                <p class="profile-value">Universitas Diponegoro</p>
            </div>
            <div>
                <label class="profile-label">Email</label>
                <div class="profile-value">
                    <span id="email-display">widiawati@gmail.com</span>
                    <input type="text" id="email-edit" class="hidden" value="widiawati@gmail.com" />
                </div>
            </div>
            <div>
                <label class="profile-label">Jurusan</label>
                <p class="profile-value">Informatika</p>
            </div>
        </div>
        <div class="mt-6 text-right">
            <button class="edit-button" id="edit-button">
                Edit
            </button>
            <button class="save-button hidden" id="save-button">
                Save
            </button>
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

    editButton.addEventListener('click', function () {
        // Toggle Edit Mode
        phoneDisplay.classList.add('hidden');
        phoneEdit.classList.remove('hidden');

        emailDisplay.classList.add('hidden');
        emailEdit.classList.remove('hidden');

        // Show Save Button
        saveButton.classList.remove('hidden');
        editButton.classList.add('hidden');
    });

    saveButton.addEventListener('click', function () {
        // Save Changes
        phoneDisplay.textContent = phoneEdit.value;
        emailDisplay.textContent = emailEdit.value;

        // Toggle View Mode
        phoneDisplay.classList.remove('hidden');
        phoneEdit.classList.add('hidden');

        emailDisplay.classList.remove('hidden');
        emailEdit.classList.add('hidden');

        // Show Edit Button
        saveButton.classList.add('hidden');
        editButton.classList.remove('hidden');
    });
</script>

@endsection
