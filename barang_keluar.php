<?php
include "koneksi.php";
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>Cahya Karunia Jaya</title>
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: #ecf0f1;
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
        .card {
            background: rgba(44, 62, 80, 0.9);
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        }
        .btn-custom {
            background: #f39c12;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #e67e22;
            transform: scale(1.1);
        }
        .table {
            background: rgba(44, 62, 80, 0.7);
            color: #ecf0f1;
            border-radius: 10px;
            animation: fadeIn 1s ease-in-out;
        }
        .table th, .table td {
            border-color: rgba(255, 255, 255, 0.3);
            text-align: center;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(44, 62, 80, 0.8);
        }
        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: scale(1.02);
            transition: all 0.3s ease;
        }
        .table-wrapper {
            max-height: 400px;
            overflow-y: auto;
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .input-field {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 12px 20px;
            margin-bottom: 10px;
            border: none;
            color: #ecf0f1;
            font-size: 16px;
            transition: 0.3s;
        }
        .input-field:focus {
            background: rgba(255, 255, 255, 0.2);
            outline: none;
        }
        .form-label {
            color: #ecf0f1;
        }
        .btn-primary {
            background-color: #2980b9;
        }
        .btn-danger {
            background-color: #e74c3c;
        }
        .card-header {
            background-color: #16a085;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="bg"></div>
    <div class="container mt-5">
        <h2 class="text-center text-white mb-5">Barang Keluar</h2>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header text-white">
                        Form Barang Keluar
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="col-mb-2">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="tkode" value="<?php echo $vkodebarang;?>" class="input-field" placeholder="Masukkan kode barang">
                            </div>
                            <div class="col-mb-2">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="tnama" value="<?php echo $vnamabarang;?>" class="input-field" placeholder="Masukkan Nama Barang">
                            </div>
                            <div class="col-mb-2">
                                <label class="form-label">Nama Supir</label>
                                <input type="text" name="tsupir" value="<?php echo $vnamasupir;?>" class="input-field" placeholder="Nama Supir">
                            </div>
                            <div class="col-mb-2">
                                <label class="form-label">Ukuran Barang</label>
                                <input type="text" name="tukuran" value="<?php echo $vukuranbarang;?>" class="input-field" placeholder="Ukuran Barang">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="col-mb-2">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" name="tjumlah" value="<?php echo $vjumlahbarang;?>" class="input-field" placeholder="Jumlah Barang">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col-mb-2">
                                        <label class="form-label">Tanggal Kirim</label>
                                        <input type="date" name="tkirim" value="<?php echo $vtanggalkirim;?>" class="input-field">
                                    </div>
                                </div>
                            </div>
                            <div class="col-mb-2">
                                <label class="form-label">Penerima</label>
                                <input type="text" name="tpenerima" value="<?php echo $vpenerima;?>" class="input-field" placeholder="Penerima">
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-custom" name="tsimpan">Simpan</button>
                                <button class="btn btn-danger" name="tkosongkan">Kosongkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Data Keluar -->
        <div class="row mt-5">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header text-white">
                        Riwayat Data Keluar
                    </div>
                    <div class="card-body">
                        <form method="POST" class="row mb-3">
                            <div class="col-8">
                                <input type="text" name="tcari" class="input-field" placeholder="Masukkan kata kunci">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                                <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                            </div>
                        </form>
                        <div class="table-wrapper">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Nama Supir</th>
                                        <th>Jumlah Barang</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Penerima</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (isset($_POST['bcari'])) {
                                        $keyword = $_POST['tcari'];
                                        $q = "SELECT * FROM tabel_keluar WHERE kodeBarang LIKE '%$keyword%' ORDER BY IdBarang DESC";
                                    } else {
                                        $q = "SELECT * FROM tabel_keluar ORDER BY IdBarang DESC";
                                    }
                                    $tampil = mysqli_query($conn, $q);
                                    while ($data = mysqli_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['kodeBarang'] ?></td>
                                        <td><?= $data['namaBarang'] ?></td>
                                        <td><?= $data['namaSupir'] ?></td>
                                        <td><?= $data['jumlahBarang'] . " " . $data['ukuranBarang']?></td>
                                        <td><?= $data['tanggalkirim'] ?></td>
                                        <td><?= $data['penerima']?></td>
                                        <td>
                                            <a href="barang_keluar.php?hal=edit&id=<?= $data['IdBarang'] ?>" class="btn btn-warning">Edit</a>
                                            <a href="barang_keluar.php?hal=hapuss&id=<?= $data['IdBarang'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?')">Hapus</a>
                                            <a href="surat_jalan.php?id=<?= $data['IdBarang'] ?>" class="btn btn-primary">Print</a>
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
