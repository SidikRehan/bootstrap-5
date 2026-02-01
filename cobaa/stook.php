<?php
session_start();
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $jumlah_keluar = mysqli_real_escape_string($conn, $_POST['jumlah_keluar']);
    $tanggal_keluar = date("Y-m-d");

    // Periksa apakah barang ada di tabel stock_barang
    $check_stock = mysqli_query($conn, "SELECT * FROM stock_barang WHERE nama_barang='$nama_barang'");
    if (mysqli_num_rows($check_stock) > 0) {
        // Jika barang ada, update jumlah stock
        $update_stock = "UPDATE stock_barang SET jumlah_stock = jumlah_stock - $jumlah_keluar WHERE nama_barang='$nama_barang'";
        if (mysqli_query($conn, $update_stock)) {
            // Simpan data ke tabel riwayat_pengurangan_stok
            $insert_riwayat = "INSERT INTO riwayat_pengurangan_stok (nama_barang, jumlah_keluar, tanggal_keluar) VALUES ('$nama_barang', '$jumlah_keluar', '$tanggal_keluar')";
            mysqli_query($conn, $insert_riwayat);

            echo "<script>alert('Stok berhasil dikurangi dan riwayat tersimpan.');</script>";
        } else {
            echo "<script>alert('Gagal mengurangi stok.');</script>";
        }
    } else {
        echo "<script>alert('Barang tidak ditemukan di stok.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stok Barang</title>
</head>
<body>
    <h1>Stok Barang</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Jumlah Stok</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM stock_barang");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['nama_barang']."</td>";
            echo "<td>".$row['jumlah_stock']."</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Kurangi Stok Barang</h2>
    <form method="post">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" id="nama_barang" required><br>
        
        <label for="jumlah_keluar">Jumlah Keluar:</label>
        <input type="number" name="jumlah_keluar" id="jumlah_keluar" required><br>
        
        <button type="submit">Kurangi Stok</button>
    </form>

    <h2>Riwayat Pengurangan Stok</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Jumlah Keluar</th>
            <th>Tanggal Keluar</th>
        </tr>
        <?php
        $result_riwayat = mysqli_query($conn, "SELECT * FROM riwayat_pengurangan_stok");
        while ($row_riwayat = mysqli_fetch_assoc($result_riwayat)) {
            echo "<tr>";
            echo "<td>".$row_riwayat['id']."</td>";
            echo "<td>".$row_riwayat['nama_barang']."</td>";
            echo "<td>".$row_riwayat['jumlah_keluar']."</td>";
            echo "<td>".$row_riwayat['tanggal_keluar']."</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
