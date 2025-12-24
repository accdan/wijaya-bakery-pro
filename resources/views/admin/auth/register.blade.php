<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Dapur Indonesia</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/icondapur.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: url('{{ asset('storage/image/random2.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }
        .card {
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            max-width: 500px;
        }
        .step {
            display: none;
            animation: fadeIn 0.4s ease-in-out;
        }
        .step.active {
            display: block;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .dropzone {
            border: 2px dashed #ffc107;
            padding: 20px;
            text-align: center;
            color: #ffc107;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .dropzone.hover {
            background-color: rgba(255, 193, 7, 0.15);
        }
        .dropzone img {
            max-width: 100px;
            margin-top: 10px;
            border-radius: 50%;
        }
        .step-tracker {
            position: relative;
            height: 60px;
            margin-bottom: 1.5rem;
        }
        .step-tracker .progress {
            height: 6px;
            border-radius: 10px;
        }
        .step-icon {
            position: absolute;
            top: -18px;
            transform: translateX(-50%);
            z-index: 2;
            text-align: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background-color: #6c757d;
            color: white;
            font-weight: bold;
            line-height: 34px;
            font-size: 16px;
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            user-select: none;
        }
        .step-icon.active {
            background-color: #ffc107;
            color: #212529;
            transform: scale(1.3);
            box-shadow: 0 0 12px rgba(255, 193, 7, 0.9);
            font-weight: 900;
        }
        .step-icon.completed {
            background-color: #28a745;
            color: white;
            box-shadow: 0 0 12px rgba(40, 167, 69, 0.9);
        }
        .step-icon[data-step="0"] {
            left: 0%;
        }
        .step-icon[data-step="1"] {
            left: 33.33%;
        }
        .step-icon[data-step="2"] {
            left: 66.66%;
        }
        .step-icon[data-step="3"] {
            left: 100%;
            transform: translateX(-100%);
        }
    </style>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow border-0 p-4 w-100">
            <div class="text-center mb-3">
                <img loading="lazy" src="{{ asset('storage/image/logo1.png') }}" alt="Logo Dapur Indonesia" class="img-fluid" style="max-height: 100px" />
            </div>

            <h4 class="text-center text-warning mb-4">Daftar Akun Baru</h4>

            {{-- Step Tracker --}}
            <div class="step-tracker">
                <div class="progress bg-secondary" style="height:6px; border-radius:10px;">
                    <div class="progress-bar bg-warning" id="formProgress" role="progressbar" style="width: 25%;"></div>
                </div>
                <div class="step-icon" data-step="0">1</div>
                <div class="step-icon" data-step="1">2</div>
                <div class="step-icon" data-step="2">3</div>
                <div class="step-icon" data-step="3">4</div>
            </div>

            {{-- Registration Form --}}
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate>
                @csrf

                <input type="hidden" name="step" id="stepInput" value="{{ old('step', 0) }}">

                {{-- Step 1: Nama Lengkap --}}
                <div class="step active">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-warning">*</span></label>
                        <input type="text" id="name" name="name" ria-label="Nama Lengkap" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Step 2: Email & No Telepon --}}
                <div class="step">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email (Opsional)</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">Nomor Telepon (Opsional)</label>
                        <input type="text" id="no_telepon" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon') }}" />
                        @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Step 3: Username & Password --}}
                <div class="step">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="text-warning">*</span></label>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required />
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-warning">*</span></label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-warning">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required />
                    </div>
                </div>

                {{-- Step 4: Foto Profil (Drag & Drop) --}}
                <div class="step">
                    <label for="profile_picture" class="form-label">Foto Profil (Opsional)</label>
                    <div class="dropzone rounded" id="dropzone">
                        <p>Seret & lepaskan gambar di sini atau klik untuk memilih</p>
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="d-none" />
                        <img loading="lazy" id="previewImage" class="d-none rounded-circle mt-2" alt="Preview Foto Profil" />
                    </div>
                    @error('profile_picture')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Navigation Buttons --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-light d-none" id="prevBtn">Sebelumnya</button>
                    <button type="button" class="btn btn-warning text-dark" id="nextBtn">Berikutnya</button>
                </div>

                {{-- Submit Button (hidden until last step) --}}
                <div class="d-grid mt-3" id="submitBtnContainer" style="display: none;">
                    <button type="submit" class="btn btn-success">Daftar Sekarang</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <small class="text-white-50">
                    Sudah punya akun? <a href="{{ route('login-user') }}" class="text-warning">Masuk di sini</a>
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const steps = document.querySelectorAll('.step');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const submitContainer = document.getElementById('submitBtnContainer');
        const progressBar = document.getElementById('formProgress');
        const stepIcons = document.querySelectorAll('.step-icon');

        let currentStep = 0;

        function showStep(index) {
            document.getElementById('stepInput').value = index;
            steps.forEach((step, i) => {
                step.classList.toggle('active', i === index);
            });

            prevBtn.classList.toggle('d-none', index === 0);

            if (index === steps.length - 1) {
                nextBtn.style.display = 'none';
                submitContainer.style.display = 'block';
            } else {
                nextBtn.style.display = 'inline-block';
                submitContainer.style.display = 'none';
            }

            progressBar.style.width = ((index + 1) / steps.length) * 100 + '%';

            stepIcons.forEach((icon, i) => {
                icon.classList.remove('active', 'completed');
                if (i < index) icon.classList.add('completed');
                else if (i === index) icon.classList.add('active');
            });
        }

        nextBtn.addEventListener('click', () => {
            const currentInputs = steps[currentStep].querySelectorAll('input[required]');
            let valid = true;
            currentInputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    valid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            if (!valid) return;

            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });

        showStep(currentStep);

        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('profile_picture');
        const previewImage = document.getElementById('previewImage');

        dropzone.addEventListener('click', () => {
            fileInput.click();
        });

        dropzone.addEventListener('dragover', e => {
            e.preventDefault();
            dropzone.classList.add('hover');
        });

        dropzone.addEventListener('dragleave', e => {
            e.preventDefault();
            dropzone.classList.remove('hover');
        });

        dropzone.addEventListener('drop', e => {
            e.preventDefault();
            dropzone.classList.remove('hover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                showPreview(files[0]);
            }
        });

        fileInput.addEventListener('change', e => {
            if (fileInput.files.length > 0) {
                showPreview(fileInput.files[0]);
            }
        });

        function showPreview(file) {
            const maxSize = 2 * 1024 * 1024;
            const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

            if (!allowedTypes.includes(file.type)) {
                alert("Hanya file JPG, PNG, dan WebP yang diperbolehkan.");
                return;
            }

            if (file.size > maxSize) {
                alert("Ukuran gambar maksimal 2MB.");
                return;
            }

            const reader = new FileReader();
            reader.onload = e => {
                previewImage.src = e.target.result;
                previewImage.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }

        const serverErrors = {
            name: "{{ $errors->has('name') ? '1' : '' }}",
            email: "{{ $errors->has('email') ? '1' : '' }}",
            username: "{{ $errors->has('username') ? '1' : '' }}",
            password: "{{ $errors->has('password') ? '1' : '' }}"
        };

        document.addEventListener('DOMContentLoaded', () => {
            const oldStep = parseInt("{{ old('step', 0) }}", 10);
            currentStep = isNaN(oldStep) ? 0 : oldStep;
            showStep(currentStep);
        });
    </script>
</body>
</html>




