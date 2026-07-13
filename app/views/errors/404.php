<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <style>
        :root {
            --golden-brown: #996515;
            --dark-brown: #5c3a0d;
            --light-brown: #f4e8d3;
            --bg-color: #fdfbf7;
            --text-color: #333333;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 40px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(153, 101, 21, 0.1);
            border-top: 6px solid var(--golden-brown);
        }

        h1 {
            font-size: 80px;
            margin: 0;
            color: var(--golden-brown);
            line-height: 1;
        }

        h2 {
            font-size: 24px;
            margin: 20px 0 10px;
            color: var(--dark-brown);
        }

        p {
            font-size: 16px;
            color: #666666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
            background-color: var(--golden-brown);
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: var(--dark-brown);
            transform: translateY(-2px);
        }

        .icon {
            font-size: 40px;
            margin-bottom: 10px;
            color: var(--golden-brown);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="icon">✂️🧵</div>
        <h1>404</h1>
        <h2>Halaman Tidak Ditemukan</h2>
        <p>Mohon maaf, halaman yang Anda tuju tidak dapat kami temukan. Mungkin URL yang Anda masukkan salah atau halaman tersebut telah dipindahkan.</p>
        <a href="javascript:history.back()" class="btn">Kembali</a>
    </div>

</body>
</html>
