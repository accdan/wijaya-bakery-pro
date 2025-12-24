<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #495057;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .error-container {
            text-align: center;
            max-width: 500px;
            padding: 2rem;
        }
        .error-code {
            font-size: 6rem;
            font-weight: 300;
            color: #6c757d;
            margin-bottom: 1rem;
        }
        .error-title {
            font-size: 2rem;
            font-weight: 500;
            color: #343a40;
            margin-bottom: 1rem;
        }
        .error-message {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .btn-home {
            display: inline-block;
            background-color: #8b6f47;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        .btn-home:hover {
            background-color: #5d4e37;
            color: white;
            text-decoration: none;
        }
        .support-info {
            margin-top: 2rem;
            padding: 1rem;
            background: #e9ecef;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">500</div>
        <h1 class="error-title">Internal Server Error</h1>
        <p class="error-message">
            Maaf, terjadi kesalahan pada server kami. Tim kami telah diberitahu dan sedang berusaha memperbaikinya.
        </p>
        <a href="{{ url('/') }}" class="btn-home">Kembali ke Beranda</a>

        <div class="support-info">
            <strong>Bantuan:</strong><br>
            Jika masalah berlanjut, silakan hubungi kami di:<br>
            <strong>Email:</strong> support@wijayabakery.com<br>
            <strong>WhatsApp:</strong> +6283112116135
        </div>
    </div>
</body>
</html>




