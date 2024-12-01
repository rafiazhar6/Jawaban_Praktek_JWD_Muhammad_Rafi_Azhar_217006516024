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

// Hapus data jika tombol hapus ditekan
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $deleteSql = "DELETE FROM pemesanan WHERE id = $id";

    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href='tampil_pemesanan.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data dari tabel pemesanan
$sql = "SELECT * FROM pemesanan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesanan</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        body {
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }
        .room-image {
            width: 100px; /* Atur lebar gambar */
            height: auto; /* Biarkan tinggi otomatis */
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Pemesanan Hotel</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomor Identitas</th>
                    <th>Tipe Kamar</th>
                    <th>Foto Kamar</th>
                    <th>Tanggal Pesan</th>
                    <th>Durasi (Hari)</th>
                    <th>Diskon</th>
                    <th>Total Bayar</th>
                    <th>Sarapan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?> 
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                        <td><?php echo htmlspecialchars($row['no_identitas']); ?></td>
                        <td><?php echo htmlspecialchars($row['tipe_kamar']); ?></td>
                        
                        <?php
                        // Tentukan foto berdasarkan jenis kamar
                        $fotoKamar = '';
                        switch ($row['tipe_kamar']) {
                            case 'Standar':
                                $fotoKamar = 'standar.jpg'; 
                                break;
                            case 'Deluxe':
                                $fotoKamar = 'deluxe.jpeg'; 
                                break;
                            case 'Family':
                                $fotoKamar = 'Executive.jpg'; 
                                break;
                            default:
                                $fotoKamar = 'images/default.jpg'; 
                                break;
                        }
                        ?>
                        <td><img src="<?php echo $fotoKamar; ?>" alt="<?php echo $row['tipe_kamar']; ?>" class="room-image"></td>
                        <td><?php echo htmlspecialchars($row['tanggal_pesan']); ?></td>
                        <td><?php echo htmlspecialchars($row['durasi']); ?></td>

                        <?php
                        // Hitung diskon
                        $diskon = 0;
                        if ($row['durasi'] > 3) {
                            $diskon = 0.1 * $row['total_bayar']; // Diskon 10%
                        }
                        ?>
                        <td><?php echo $diskon > 0 ? '10%' : 'Tidak'; ?></td>
                        <td>Rp <?php echo number_format($row['total_bayar'] - $diskon, 2, ',', '.'); ?></td>

                        <!-- Tampilkan status sarapan -->
                        <td><?php echo $row['sarapan'] == 1 ? 'Ya' : 'Tidak'; ?></td>

                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Tidak ada data pemesanan.</p>
    <?php endif; ?>

    <div class="text-center">
        <a href="pendaftaran.php" class="btn btn-primary">Kembali</a> 
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>