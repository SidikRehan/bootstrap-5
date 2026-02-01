<?php
include 'koneksi.php'; // Pastikan koneksi ke database terhubung

// Fungsi untuk menambah stok
function tambahStok($namaBarang, $jumlah, $satuanBarang) {
    global $conn;
    $stmt = $conn->prepare("SELECT JumlahStok FROM stock WHERE namaBarang=?");
    $stmt->bind_param("s", $namaBarang);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $stokBaru = $data['JumlahStok'] + $jumlah;
        $tanggal = date("Y-m-d H:i:s");
        $updateStmt = $conn->prepare("UPDATE stock SET JumlahStok=?, Last_update=? WHERE namaBarang=?");
        $updateStmt->bind_param("iss", $stokBaru, $tanggal, $namaBarang);
        $updateStmt->execute();
    } else {
        echo "<script>alert('Nama barang tidak ditemukan dalam stok');</script>";
    }
    $stmt->close();
}

// Fungsi untuk mengurangi stok dan menambahkan riwayat barang terpakai
function kurangiStok($namaBarang, $jumlah) {
    global $conn;
    $stmt = $conn->prepare("SELECT JumlahStok FROM stock WHERE namaBarang=?");
    $stmt->bind_param("s", $namaBarang);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo "Jumlah stok awal: " . $data['JumlahStok'] . "<br>"; // Debug awal stok

        if ($data['JumlahStok'] < $jumlah) {
            echo "<script>alert('Stok tidak mencukupi untuk mengurangi jumlah tersebut');</script>";
            return;
        }

        $stokBaru = $data['JumlahStok'] - $jumlah;
        echo "Jumlah yang dikurangi: " . $jumlah . "<br>"; // Debug jumlah pengurangan
        echo "Jumlah stok baru: " . $stokBaru . "<br>"; // Debug stok baru

        $tanggal = date("Y-m-d H:i:s");
        $updateStmt = $conn->prepare("UPDATE stock SET JumlahStok=?, Last_update=? WHERE namaBarang=?");
        $updateStmt->bind_param("iss", $stokBaru, $tanggal, $namaBarang);
        $updateStmt->execute();
        
        // Tambahkan riwayat barang terpakai
        $insertStmt = $conn->prepare("INSERT INTO barang_terpakai (namaBarang, jumlahTerpakai, tanggalTerpakai) VALUES (?, ?, ?)");
        $insertStmt->bind_param("sis", $namaBarang, $jumlah, $tanggal);
        $insertStmt->execute();
    } else {
        echo "<script>alert('Nama barang tidak ditemukan dalam stok');</script>";
    }
    $stmt->close();
}

// Proses barang masuk dan terpakai
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaBarang = htmlspecialchars($_POST['nama_barang']);
    $jumlah = htmlspecialchars($_POST['jumlah']);
    $satuanBarang = htmlspecialchars($_POST['satuan_barang']);
    $aksi = htmlspecialchars($_POST['aksi']);

    if ($aksi == 'barang_masuk') {
        tambahStok($namaBarang, $jumlah, $satuanBarang);
    } else if ($aksi == 'barang_terpakai') {
        kurangiStok($namaBarang, $jumlah);
    }
}

// Mencari stok barang
$searchKeywordStock = isset($_GET['search_stock']) ? htmlspecialchars($_GET['search_stock']) : '';
$stmt = $conn->prepare("SELECT * FROM stock WHERE namaBarang LIKE ?");
$searchTerm = "%$searchKeywordStock%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

// Mencari riwayat barang terpakai
$searchKeywordRiwayat = isset($_GET['search_riwayat']) ? htmlspecialchars($_GET['search_riwayat']) : '';
$riwayatStmt = $conn->prepare("SELECT * FROM barang_terpakai WHERE namaBarang LIKE ?");
$riwayatTerm = "%$searchKeywordRiwayat%";
$riwayatStmt->bind_param("s", $riwayatTerm);
$riwayatStmt->execute();
$riwayat = $riwayatStmt->get_result();
?>




<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Stok Barang</title>
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            padding-bottom: 50px;
        }
        form {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        form:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: auto;
            background: #ff9800;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 50px;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background: #e68900;
            transform: scale(1.1);
        }
        .table-container {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 10px;
            animation: fadeIn 1s ease-in-out;
        }
        table, th, td {
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: rgba(0, 0, 0, 0.8);
        }
        tr:nth-child(even) {
            background: rgba(0, 0, 0, 0.2);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <h2 class="fade-in">Stok Barang</h2>
    <form class="fade-in" method="post" action="">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" required><br>
        
        <label for="jumlah">Jumlah:</label>
        <input type="number" id="jumlah" name="jumlah" required><br>

        <label for="satuan_barang">Satuan Barang:</label>
        <input type="text" id="satuan_barang" name="satuan_barang" required><br>

        <label for="aksi">Aksi:</label>
        <select id="aksi" name="aksi">
            <option value="barang_masuk">Barang Masuk</option>
            <option value="barang_terpakai">Barang Terpakai</option>
        </select><br><br>

        <input type="submit" value="Submit">
    </form>

    <h2 class="fade-in">Cari Stok Barang</h2>
    <form class="fade-in" method="get" action="">
        <input type="text" name="search_stock" placeholder="Cari nama barang..." value="<?php echo htmlspecialchars($searchKeywordStock); ?>">
        <input type="submit" value="Cari">
    </form>
    <div class="table-container fade-in">
    <table>
        <tr>
            <th>NO</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Satuan Barang</th>
            <th>Terakhir Update</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1; // Deklarasi nomor urut
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>"; // Menampilkan nomor urut
                echo "<td>" . htmlspecialchars($row["namaBarang"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["JumlahStok"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["SATUANBarang"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Last_update"]) . "</td>";
                echo "<td>";
                echo "<a href='edit.php?id=" . htmlspecialchars($row["IdStock"]) . "'><button>Edit</button></a>";
                echo "<a href='delete.php?id=" . htmlspecialchars($row["IdStock"]) . "'><button>Hapus</button></a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>0 hasil</td></tr>";
        }
        ?>
    </table>
</div>

<div class="table-container fade-in">
    <table>
        <tr>
            <th>NO</th>
            <th>Nama Barang</th>
            <th>Jumlah Terpakai</th>
            <th>Tanggal Pemakaian</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1; // Deklarasi nomor urut untuk tabel kedua
        if ($riwayat->num_rows > 0) {
            while($row = $riwayat->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>"; // Menampilkan nomor urut
                echo "<td>" . htmlspecialchars($row["namaBarang"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["jumlahTerpakai"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["tanggalTerpakai"]) . "</td>";
                echo "<td>";
                echo "<a href='edit_riwayat.php?id=" . htmlspecialchars($row["IdBarangTerpakai"]) . "'><button>Edit</button></a>";
                echo "<a href='delete_riwayat.php?id=" . htmlspecialchars($row["IdBarangTerpakai"]) . "'><button>Hapus</button></a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>0 hasil</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
