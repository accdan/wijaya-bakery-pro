<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Terjadi Kesalahan Server | Wijaya Bakery</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
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
        }

        .oven-icon {
            font-size: 100px;
            margin: 20px 0;
            animation: shake 0.5s infinite;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-10px) rotate(-5deg);
            }

            75% {
                transform: translateX(10px) rotate(5deg);
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
            color: #f5576c;
            border-color: #fff;
        }

        .btn-primary:hover {
            background: #f0f0f0;
            color: #f5576c;
        }

        .info-box {
            margin-top: 30px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .info-box h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .info-box p {
            font-size: 14px;
            opacity: 0.9;
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
        <div class="error-code">500</div>
        <div class="oven-icon">🔥</div>
        <h1>Waduh! Oven Kami Sedang Bermasalah</h1>
        <p>
            Sepertinya ada yang tidak beres dengan sistem kami. Tim kami sedang bekerja keras untuk memperbaikinya!
        </p>
        <p style="opacity: 0.8; font-size: 16px;">
            Mohon maaf atas ketidaknyamanannya. Silakan coba lagi dalam beberapa saat.
        </p>

        <div class="info-box">
            <h3>💡 Apa yang bisa kamu lakukan?</h3>
            <p>
                • Refresh halaman ini dalam beberapa menit<br>
                • Kembali ke beranda dan coba menu lain<br>
                • Hubungi kami jika masalah berlanjut
            </p>
        </div>

        <div class="btn-container">
            <a href="/" class="btn btn-primary">🏠 Kembali ke Beranda</a>
            <a href="javascript:location.reload()" class="btn">🔄 Muat Ulang</a>
            <a href="javascript:history.back()" class="btn">← Halaman Sebelumnya</a>
        </div>
    </div>

    <script>
        // Auto retry after 5 seconds (optional, can be removed)
        let countdown = 30;
        const retryBtn = document.querySelector('.btn-primary');

        function updateCountdown() {
            countdown--;
            if (countdown > 0) {
                retryBtn.textContent = `🏠 Kembali (${countdown}s)`;
            } else {
                window.location.href = '/';
            }
        }

        // Uncomment to enable auto-redirect
        // setInterval(updateCountdown, 1000);
    </script>
</body>

</html>