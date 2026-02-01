<?php
$host = "localhost";
$user = "root"; // Username MySQL
$password = ""; // Password MySQL
$database = "admin_admin";

include "koneksi.php"

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cahya Karunia Jaya</title>
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            padding-bottom: 50px;
        }
        .bg {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
        }
        .bg-dark-green {
            background-color: #274e13;
            color: white;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
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
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .table-wrapper {
            max-height: 400px; /* Adjust this height as needed */
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="bg"></div>
    <div class="container mt-5 fade-in">
        <h2 class="text-center mb-4">✨ INPUT BARANG MASUK ✨</h2>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card p-4">
                    <h4 class="text-center">Form Barang Masuk</h4>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" name="tkode" value="<?php echo $vkodeBarang;?>" class="form-control" placeholder="Masukkan kode barang">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="tnama" value="<?php echo $vnamaBarang;?>" class="form-control" placeholder="Masukkan Nama Barang">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Asal Barang</label>
                            <input type="text" name="tasal" value="<?php echo $vasalBarang;?>" class="form-control" placeholder="Asal Barang">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ukuran Barang</label>
                            <select class="form-select" name="tukuran">
                                <option value="<?php echo $vukuranBarang;?>"><?php echo $vukuranBarang;?></option>
                                <option value="Standar">Standar</option>
                                <option value="Jumbo">Jumbo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="tjumlah" value="<?php echo $vjumlahBarang;?>" class="form-control" placeholder="Masukkan Nama Barang">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Satuan</label>
                            <select class="form-select" name="tsatuan">
                                <option value="<?php echo $vsatuanBarang;?>"><?php echo $vsatuanBarang;?></option>
                                <option value="Lembar">Lembar</option>
                                <option value="Peti">Peti</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Terima</label>
                            <input type="date" name="ttanggal" value="<?php echo $vtanggalMasuk;?>" class="form-control">
                        </div>
                        <button class="btn btn-custom w-100" name="tsimpann">SIMPAN</button>
                        <button class="btn btn-danger w-100 mt-2" name="tkosongkan">KOSONGKAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 fade-in">
        <div class="col-md-10 mx-auto">
            <div class="card p-4">
                <h4 class="text-center">📦 DATA BARANG 📦</h4>
                <form method="POST" class="row mb-3">
                    <div class="col-8">
                        <input type="text" name="tcari" class="form-control" placeholder="Masukkan kata kunci">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-custom w-100" name="bcari" type="submit">CARI</button>
                        <button class="btn btn-danger w-100 mt-2" name="breset" type="submit">RESET</button>
                    </div>
                </form>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (isset($_POST['bcari'])) {
                                $keyword = $_POST['tcari'];
                                $q = "SELECT * FROM tabel_masuk WHERE kodeBarang LIKE '%$keyword%' ORDER BY IdBarang DESC";
                            } else {
                                $q = "SELECT * FROM tabel_masuk ORDER BY IdBarang DESC";
                            }
                            $tampil = mysqli_query($conn, $q);
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
                                        <a href="input.php?hal=edit&id=<?= $data['IdBarang'] ?>" class="btn btn-warning">Edit</a>
                                        <a href="input.php?hal=hapus&id=<?= $data['IdBarang'] ?>" class="btn btn-danger" onclick="return confirm('apakah anda ingin menghapus data ini')">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
