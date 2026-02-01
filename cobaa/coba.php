<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "admin_admin";
include "koneksi.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sistem Barang Keluar</title>
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            padding-bottom: 50px;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
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
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container mt-5 fade-in">
        <h2 class="text-center mb-4">🚛 Sistem Barang Keluar 🚛</h2>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card p-4">
                    <h4 class="text-center">Form Barang Keluar</h4>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" placeholder="Masukkan Kode Barang">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan Nama Barang">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Supir</label>
                            <input type="text" name="nama_supir" class="form-control" placeholder="Masukkan Nama Supir">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ukuran Barang</label>
                            <input type="text" name="ukuran_barang" class="form-control" placeholder="Masukkan Ukuran Barang">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Masukkan Jumlah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Kirim</label>
                            <input type="date" name="tanggal_kirim" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerima</label>
                            <input type="text" name="penerima" class="form-control" placeholder="Masukkan Nama Penerima">
                        </div>
                        <button class="btn btn-custom w-100" name="simpan">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
