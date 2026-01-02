<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Wijaya Bakery</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
        }

        .error-container {
            text-align: center;
            padding: 40px 20px;
            max-width: 600px;
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-code {
            font-size: 150px;
            font-weight: 900;
            line-height: 1;
            text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .bakery-icon {
            font-size: 100px;
            margin: 20px 0;
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        h1 {
            font-size: 32px;
            margin: 20px 0;
            font-weight: 700;
        }

        p {
            font-size: 18px;
            margin: 15px 0;
            opacity: 0.95;
            line-height: 1.6;
        }

        .btn-container {
            margin-top: 40px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 35px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-size: 16px;
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: #fff;
            color: #667eea;
            border-color: #fff;
        }

        .btn-primary:hover {
            background: #f0f0f0;
            color: #667eea;
        }

        .search-container {
            margin-top: 30px;
            position: relative;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .search-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            color: #fff;
            font-size: 16px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-input:focus {
            outline: none;
            border-color: #fff;
            background: rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 120px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 16px;
            }

            .btn-container {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <div class="bakery-icon">🍞</div>
        <h1>Oops! Halaman Tidak Ditemukan</h1>
        <p>
            Sepertinya halaman yang kamu cari sudah habis terjual atau tidak pernah ada di etalase kami.
        </p>
        <p style="opacity: 0.8; font-size: 16px;">
            Jangan khawatir! Masih banyak roti enak lainnya yang bisa kamu pilih.
        </p>

        <div class="search-container">
            <form action="/menu" method="GET">
                <input type="text" name="search" class="search-input" placeholder="Cari menu favorit kamu..." autofocus>
            </form>
        </div>

        <div class="btn-container">
            <a href="/" class="btn btn-primary">🏠 Kembali ke Beranda</a>
            <a href="/menu" class="btn">🍰 Lihat Menu</a>
            <a href="javascript:history.back()" class="btn">← Halaman Sebelumnya</a>
        </div>
    </div>

    <script>
        // Auto focus search input
        document.querySelector('.search-input').focus();

        // Prevent form submission on empty search
        document.querySelector('form').addEventListener('submit', function (e) {
            const searchInput = document.querySelector('.search-input');
            if (!searchInput.value.trim()) {
                e.preventDefault();
                window.location.href = '/menu';
            }
        });
    </script>
</body>

</html>