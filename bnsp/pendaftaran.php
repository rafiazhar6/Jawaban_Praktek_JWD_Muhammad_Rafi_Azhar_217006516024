<!DOCTYPE html>
<html lang="id">
<?php
$servername = "localhost"; 
$username = "root";  
$password = ""; 
$dbname = "hotel_db"; 

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_identitas = $_POST['no_identitas'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $tanggal_pesan = $_POST['tanggal_pesan'];
    $durasi = $_POST['durasi'];
    $sarapan = isset($_POST['breakfast']) ? 1 : 0; // Menyimpan status sarapan (1 untuk ya, 0 untuk tidak)

    // Hitung total bayar
    $harga = 0;
    switch ($tipe_kamar) {
        case 'Standar':
            $harga = 500000;
            break;
        case 'Deluxe':
            $harga = 750000;
            break;
        case 'Family':
            $harga = 1000000;
            break;
    }

    $total = $harga * $durasi; // Hitung total dasar
    if ($sarapan) {
        $total += 80000; // Tambahkan biaya sarapan jika terpilih
    }
    
    // Diskon jika durasi lebih dari 3 hari
    if ($durasi > 3) {
        $total *= 0.9; // Diskon 10%
    }

    // Simpan data ke database
    $sql = "INSERT INTO pemesanan (nama, jenis_kelamin, no_identitas, tipe_kamar, tanggal_pesan, durasi, sarapan, total_bayar) 
            VALUES ('$nama', '$jenis_kelamin', '$no_identitas', '$tipe_kamar', '$tanggal_pesan', $durasi, $sarapan, $total)";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke tampil_pemesanan.php setelah menyimpan data
        header("Location: tampil_pemesanan.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        body {
            background-color: #e9f5ff;
        }
        .form-container {
            background: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #007BFF;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        .harga-box,
        .total-box {
            border: 1px solid #007BFF;
            border-radius: 4px;
            padding: 10px;
            background-color: #f0f8ff;
            min-width: 120px; /* Menentukan lebar minimum */
            text-align: left; /* Menempatkan teks di sebelah kiri */
        }
    </style>
    <script>
        function updatePrice() {
            const tipeKamar = document.getElementById('tipe_kamar').value;
            const hargaKamar = document.getElementById('harga_kamar');
            let harga = 0;

            // Tentukan harga berdasarkan tipe kamar
            switch (tipeKamar) {
                case 'Standar':
                    harga = 500000;
                    break;
                case 'Deluxe':
                    harga = 750000;
                    break;
                case 'Family':
                    harga = 1000000;
                    break;
            }

            // Tampilkan harga kamar
            hargaKamar.textContent = 'Rp ' + harga.toLocaleString('id-ID');
        }

        function calculateTotal() {
            const durasi = parseInt(document.getElementById('durasi').value);
            const tipeKamar = document.getElementById('tipe_kamar').value;
            const breakfast = document.getElementById('breakfast').checked;
            const totalBayar = document.getElementById('total_bayar');
            let harga = 0;

            // Tentukan harga berdasarkan tipe kamar
            switch (tipeKamar) {
                case 'Standar':
                    harga = 500000;
                    break;
                case 'Deluxe':
                    harga = 750000;
                    break;
                case 'Family':
                    harga = 1000000;
                    break;
            }

            // Hitung total
            let total = harga * durasi;

            // Tambahkan biaya untuk breakfast jika terpilih
            if (breakfast) {
                total += 80000; // Tambahan untuk breakfast
            }

            // Diskon jika durasi lebih dari 3 hari
            if (durasi > 3) {
                total *= 0.9; // Diskon 10%
            }

            totalBayar.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        function validateForm() {
            const noIdentitas = document.getElementById('no_identitas').value;
            const durasi = document.getElementById('durasi').value;
            const errorDiv = document.getElementById('error_message');
            errorDiv.innerHTML = ''; // Clear previous errors

            // Validasi Nomor Identitas
            if (!/^\d{16}$/.test(noIdentitas)) {
                errorDiv.innerHTML += '<p>Isian salah..data harus 16 digit</p>';
                return false;
            }

            // Validasi Durasi Menginap
            if (isNaN(durasi) || durasi <= 0) {
                errorDiv.innerHTML += '<p>Durasi menginap harus isi angka</p>';
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<div class="form-container">
    <h2>Form Pemesanan</h2>
    <div id="error_message" class="error"></div>
    <form onsubmit="return validateForm();" method="post" action="">
        <div class="form-group">
            <label for="nama">Nama Pemesan</label>
            <input type="text" id="nama" name="nama" class="form-control" required>
        </div>

        <label>Jenis Kelamin</label>
        <div class="form-group">
            <div class="form-check">
                <input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki" required>
                <label class="form-check-label">Laki-laki</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan" required>
                <label class="form-check-label">Perempuan</label>
            </div>
        </div>

        <div class="form-group">
            <label for="no_identitas">Nomor Identitas (16 Digit)</label>
            <input type="text" id="no_identitas" name="no_identitas" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tipe_kamar">Tipe Kamar</label>
            <select id="tipe_kamar" name="tipe_kamar" class="form-control" onchange="updatePrice()" required>
                <option value="Standar">Standar</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Family">Family</option>
            </select>
        </div>

        <div class="form-group">
            <label>Harga:</label>
            <div class="harga-box" id="harga_kamar">Rp 0</div>
        </div>

        <div class="form-group">
            <label for="tanggal_pesan">Tanggal Pesan</label>
            <input type="date" id="tanggal_pesan" name="tanggal_pesan" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="form-group">
            <label for="durasi">Durasi Menginap (Hari)</label>
            <input type="number" id="durasi" name="durasi" value="3" min="1" class="form-control" required>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" id="breakfast" name="breakfast" class="form-check-input" value="Ya">
            <label class="form-check-label" for="breakfast">Termasuk Breakfast</label>
        </div>

        <div class="form-group">
            <label>Total Bayar:</label>
            <div class="total-box" id="total_bayar">Rp 0</div>
        </div>

        <button type="button" onclick="calculateTotal()" class="btn btn-primary btn-block">Hitung Total Bayar</button>
        <div class="form-footer mt-3">
            <button type="submit" name="simpan" class="btn btn-success btn-block">Simpan</button>
            <button type="button" class="btn btn-danger btn-block" onclick="window.history.back();">Cancel</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>