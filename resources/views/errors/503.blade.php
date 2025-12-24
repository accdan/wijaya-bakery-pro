<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Mode - Wijaya Bakery</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: linear-gradient(135deg, #F5EBD9 0%, #E8DCC8 50%, #D4C4A8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            text-align: center;
            max-width: 600px;
        }

        .icon {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #8B4513, #A0522D);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: pulse 2s ease-in-out infinite;
        }

        .icon svg {
            width: 80px;
            height: 80px;
            fill: white;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        h1 {
            color: #5D4037;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        p {
            color: #795548;
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: rgba(139, 69, 19, 0.2);
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .progress-bar-inner {
            height: 100%;
            background: linear-gradient(90deg, #8B4513, #CD853F);
            border-radius: 3px;
            animation: loading 2s ease-in-out infinite;
        }

        @keyframes loading {
            0% {
                width: 0%;
            }

            50% {
                width: 70%;
            }

            100% {
                width: 100%;
            }
        }

        .contact {
            background: rgba(255, 255, 255, 0.8);
            padding: 1.5rem 2rem;
            border-radius: 12px;
            display: inline-block;
        }

        .contact p {
            margin: 0;
            font-size: 1rem;
            color: #5D4037;
        }

        .contact a {
            color: #8B4513;
            text-decoration: none;
            font-weight: 600;
        }

        .contact a:hover {
            text-decoration: underline;
        }

        .bakery-decoration {
            position: fixed;
            opacity: 0.1;
            font-size: 4rem;
        }

        .bakery-decoration:nth-child(1) {
            top: 10%;
            left: 10%;
        }

        .bakery-decoration:nth-child(2) {
            top: 20%;
            right: 15%;
        }

        .bakery-decoration:nth-child(3) {
            bottom: 20%;
            left: 20%;
        }

        .bakery-decoration:nth-child(4) {
            bottom: 10%;
            right: 10%;
        }
    </style>
</head>

<body>
    <div class="bakery-decoration">🥖</div>
    <div class="bakery-decoration">🍞</div>
    <div class="bakery-decoration">🥐</div>
    <div class="bakery-decoration">🎂</div>

    <div class="container">
        <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z" />
            </svg>
        </div>

        <h1>Sedang Dalam Perbaikan</h1>
        <p>Website Wijaya Bakery sedang dalam proses maintenance untuk memberikan pengalaman yang lebih baik. Kami akan
            segera kembali!</p>

        <div class="progress-bar">
            <div class="progress-bar-inner"></div>
        </div>

        <div class="contact">
            <p>Ada pertanyaan? Hubungi kami di <a href="mailto:info@wijayabakery.com">info@wijayabakery.com</a></p>
        </div>
    </div>
</body>

</html>