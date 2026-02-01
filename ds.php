<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DS GUDANG CKJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            padding-bottom: 50px;
        }
        .bg-dark-green { background-color: #274e13; 
            color: white; 
        }
        .sidebar {
            height: 100vh;
            overflow-y: auto;
            background: rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            backdrop-filter: blur(15px);
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: fixed;
        }
        .sidebar .nav-link {
            color: white;
        }
        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }
        .btn-custom {
            background: #ff9800;
            border: none;
            padding: 10px 15px;
            border-radius: 50px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #e68900;
            transform: scale(1.1);
        }
        .table {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 10px;
            animation: fadeIn 1s ease-in-out;
        }
        .table th, .table td {
            border-color: rgba(255, 255, 255, 0.3);
            text-align: center;
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        .table-wrapper {
            height: 400px; /* Adjust this height as needed */
            overflow-y: auto;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .content-main {
            margin-left: 240px; /* Adjust width of sidebar */
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar p-2">
                <h2 class="text-center">Dashboard</h2>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="input.php">Barang Masuk</a></li>
                    <li class="nav-item"><a class="nav-link" href="barang_keluar.php">Barang Keluar</a></li>
                    <li class="nav-item"><a class="nav-link" href="stock.php">Stock Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="home.php">Jenis-Jenis</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </nav>
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 fade-in content-main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <nav class="bg-blue text-black table-striped">
                        <img src="IMG/kata.png" alt="kata">
                    </nav>
                </div>
                <div class="mt-5">
                    <h3 class="text-center">DATA BARANG MASUK</h3>
                    <div class="col-md-10 mx-auto">
                        <div class="card p-4">
                            <h4 class="text-center">Daftar Barang Masuk</h4>
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <form method="POST">
                                        <div class="input-group mb-3">
                                            <input type="text" name="tcari" class="form-control" placeholder="Masukkan kata kunci">
                                            <button class="btn btn-custom" name="bcari" type="submit">Cari</button>
                                            <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-wrapper">
                                <table class="table table-hover mt-3">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Asal Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $tampil = mysqli_query($conn, "SELECT * FROM tabel_masuk ORDER BY idBarang DESC");
                                        while ($data = mysqli_fetch_array($tampil)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['kodeBarang'] ?></td>
                                            <td><?= $data['namaBarang'] ?></td>
                                            <td><?= $data['asalBarang'] ?></td>
                                            <td><?= $data['jumlahBarang'] . " " . $data['satuanBarang'] ?></td>
                                            <td><?= $data['tanggalMasuk'] ?></td>
                                            <td>
                                                <a href="a" class="btn btn-warning">Edit</a>
                                                <a href="a" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
