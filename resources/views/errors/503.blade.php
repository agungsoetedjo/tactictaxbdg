<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Layanan Tidak Tersedia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(135deg, #0033A0, #0093DD); /* Warna biru khas Kominfo */
            color: #FFFFFF; /* Warna putih agar kontras */
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background: rgba(255, 255, 255, 0.2); /* Efek transparan putih */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        h1 {
            font-size: 50px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background: #FFFFFF; /* Warna putih untuk tombol */
            color: #0033A0; /* Warna biru tua Kominfo */
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn:hover {
            background: #0093DD; /* Warna biru terang Kominfo saat hover */
            color: #FFFFFF;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>503</h1>
        <p>Situs sedang dalam perbaikan. Kami akan segera kembali!</p>
        <a href="{{ url('/') }}" class="btn">Kembali ke Beranda</a>
    </div>
</body>
</html>
