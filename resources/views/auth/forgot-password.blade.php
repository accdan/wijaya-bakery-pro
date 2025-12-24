<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password | Wijaya Bakery</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }
        .auth-header {
            background: linear-gradient(135deg, #8b5e3c 0%, #a0664f 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .auth-body {
            padding: 2rem;
        }
        .btn-auth {
            background: linear-gradient(135deg, #8b5e3c 0%, #a0664f 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 94, 60, 0.4);
        }
        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }
        .auth-links a {
            color: #8b5e3c;
            text-decoration: none;
            font-weight: 500;
        }
        .auth-links a:hover {
            color: #a0664f;
        }
        .password-strength {
            margin-top: 0.5rem;
        }
        .password-strength .progress {
            height: 6px;
            margin-bottom: 0.5rem;
        }
        .password-requirements .valid {
            color: #198754;
        }
        .password-requirements .invalid {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-header">
            <i class="bi bi-key-fill" style="font-size: 3rem; margin-bottom: 1rem;"></i>
            <h4 class="mb-0">Reset Password</h4>
            <p class="mb-0 opacity-75">Masukkan username/email dan password baru</p>
        </div>

        <div class="auth-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('password.reset.simple') }}" id="resetPasswordForm">
                @csrf

                <div class="mb-3">
                    <label for="identifier" class="form-label fw-bold">
                        <i class="bi bi-person-fill me-2"></i>Username atau Email
                    </label>
                    <input type="text" class="form-control form-control-lg" id="identifier" name="identifier"
                           value="{{ old('identifier') }}" placeholder="Masukkan username atau email Anda" required>
                    @error('identifier')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">
                        <i class="bi bi-lock-fill me-2"></i>Password Baru
                    </label>
                    <div class="input-group">
                        <input type="password" class="form-control form-control-lg" id="password" name="password"
                               placeholder="Minimal 8 karakter" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                    <div class="password-strength mt-2" id="passwordStrength" style="display: none;">
                        <div class="progress">
                            <div class="progress-bar" id="passwordProgress" role="progressbar" style="width: 0%"></div>
                        </div>
                        <div class="password-requirements mt-1" style="font-size: 0.8rem; color: #6c757d;">
                            <div id="lengthReq" class="invalid">Minimal 8 karakter</div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-bold">
                        <i class="bi bi-lock-fill me-2"></i>Konfirmasi Password Baru
                    </label>
                    <div class="input-group">
                        <input type="password" class="form-control form-control-lg" id="password_confirmation"
                               name="password_confirmation" placeholder="Ulangi password baru" required>
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                            <i class="bi bi-eye" id="confirmPasswordIcon"></i>
                        </button>
                    </div>
                    <div id="passwordMatch" class="text-danger small mt-1" style="display: none;">
                        Password tidak cocok
                    </div>
                </div>

                <button type="submit" class="btn btn-auth w-100 btn-lg" id="submitBtn">
                    <i class="bi bi-shield-check me-2"></i>Reset Password
                </button>
            </form>

            <div class="auth-links">
                <p class="mb-2">
                    <a href="{{ route('user.login.form') }}">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Login
                    </a>
                </p>
                <p class="mb-0">
                    Belum punya akun?
                    <a href="{{ route('user.register.form') }}">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const togglePasswordBtn = document.getElementById('togglePassword');
            const toggleConfirmPasswordBtn = document.getElementById('toggleConfirmPassword');
            const passwordIcon = document.getElementById('passwordIcon');
            const confirmPasswordIcon = document.getElementById('confirmPasswordIcon');
            const passwordStrength = document.getElementById('passwordStrength');
            const passwordProgress = document.getElementById('passwordProgress');
            const lengthReq = document.getElementById('lengthReq');
            const passwordMatch = document.getElementById('passwordMatch');
            const submitBtn = document.getElementById('submitBtn');

            // Toggle password visibility
            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                passwordIcon.className = type === 'password' ? 'bi-eye' : 'bi-eye-slash';
            });

            toggleConfirmPasswordBtn.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                confirmPasswordIcon.className = type === 'password' ? 'bi-eye' : 'bi-eye-slash';
            });

            // Password strength checker
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                if (password.length > 0) {
                    passwordStrength.style.display = 'block';

                    if (password.length >= 8) {
                        lengthReq.className = 'valid';
                        passwordProgress.style.width = '100%';
                        passwordProgress.className = 'progress-bar bg-success';
                    } else {
                        lengthReq.className = 'invalid';
                        passwordProgress.style.width = (password.length / 8 * 100) + '%';
                        passwordProgress.className = 'progress-bar bg-warning';
                    }
                } else {
                    passwordStrength.style.display = 'none';
                }

                checkPasswordMatch();
            });

            // Check password confirmation match
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (confirmPassword.length > 0) {
                    if (password === confirmPassword) {
                        passwordMatch.style.display = 'none';
                        submitBtn.disabled = false;
                    } else {
                        passwordMatch.style.display = 'block';
                        submitBtn.disabled = true;
                    }
                } else {
                    passwordMatch.style.display = 'none';
                    submitBtn.disabled = false;
                }
            }

            confirmPasswordInput.addEventListener('input', checkPasswordMatch);

            // Form submission validation
            document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (password !== confirmPassword) {
                    e.preventDefault();
                    passwordMatch.style.display = 'block';
                    return false;
                }

                if (password.length < 8) {
                    e.preventDefault();
                    alert('Password minimal 8 karakter');
                    return false;
                }
            });
        });
    </script>
</body>
</html>




