<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Hotel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- Link ke styles.css -->
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background: #007bff;
            color: white;
            padding: 20px 0;
        }
        header h1 {
            margin: 0;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        main {
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .produk-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .produk-item {
            width: 30%;
            margin-bottom: 20px;
            text-align: center;
        }
        .produk-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background: #007bff;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header class="text-center">
    <h1>Selamat Datang di Hotel Api</h1>
    <nav>
        <ul>
            <li><a href="#produk" class="btn btn-light">Tipe Kamar</a></li>
            <li><a href="#harga" class="btn btn-light">Daftar Harga</a></li>
            <li><a href="#tentang" class="btn btn-light">Tentang Kami</a></li>
            <li><a href="pendaftaran.php" class="btn btn-light">Pendaftaran Kamar</a></li>
            <li><a href="tampil_pemesanan.php" class="btn btn-light">Lihat Data Pemesanan</a></li> 
        </ul>
    </nav>
</header>

<main class="container mt-4">
    <section id="produk">
        <h2>Tipe Kamar</h2>
        <p>Kami menawarkan berbagai tipe kamar yang nyaman dan modern. Silakan lihat pilihan di bawah ini.</p>
        <div class="produk-container">
            <div class="produk-item">
                <img src="standar.jpg" alt="Kamar Standar">
                <h3>Kamar Standar</h3>
            </div>
            <div class="produk-item">
                <img src="deluxe.jpeg" alt="Kamar Deluxe">
                <h3>Kamar Deluxe</h3>
            </div>
            <div class="produk-item">
                <img src="executive.jpg" alt="Kamar Eksekutif">
                <h3>Kamar Eksekutif</h3>
            </div>
        </div>
    </section>

    <section id="harga">
        <h2>Daftar Harga</h2>
        <p>Berikut adalah daftar harga kamar kami:</p>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Tipe Kamar</th>
                    <th>Harga per Malam</th>
                    <th>Fasilitas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kamar Standar</td>
                    <td>Rp 500.000</td>
                    <td>AC, TV, Kamar Mandi Pribadi</td>
                </tr>
                <tr>
                    <td>Kamar Deluxe</td>
                    <td>Rp 750.000</td>
                    <td>AC, TV, Kamar Mandi Pribadi, Sarapan</td>
                </tr>
                <tr>
                    <td>Kamar Eksekutif</td>
                    <td>Rp 1.000.000</td>
                    <td>AC, TV, Kamar Mandi Pribadi, Sarapan, Mini Bar</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section id="tentang">
        <h2>Tentang Kami</h2>
        <p>Kami adalah Hotel Api, sebuah hotel bintang tiga yang terletak di jantung kota, menawarkan pengalaman menginap yang nyaman dan menyenangkan bagi semua tamu. Dengan fasilitas modern dan pelayanan yang ramah, kami berkomitmen untuk memberikan pengalaman terbaik selama Anda tinggal. Setiap kamar dirancang dengan cermat untuk memastikan kenyamanan maksimal, dilengkapi dengan berbagai fasilitas seperti AC, TV, dan akses Wi-Fi gratis. Kami juga menyediakan layanan sarapan yang lezat serta akses mudah ke berbagai atraksi wisata dan pusat perbelanjaan. Di Hotel Api, kami percaya bahwa setiap tamu adalah bagian dari keluarga kami, dan kami siap melayani kebutuhan Anda dengan sepenuh hati.</p>
        <p>Alamat: Jl. Cilandak KKO No. 40, Jakarta Selatan</p>
        <p>No Telepon: (021) 234455336</p>
        <p>Email: hotelapi@gmail.com</p>
    </section>
</main>

<footer>
    <p>&copy; 2024 Hotel Kami. Semua hak dilindungi.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>