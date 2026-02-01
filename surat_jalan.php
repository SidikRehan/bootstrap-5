<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tabel_keluar WHERE IDBarang = '$id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Jalan - Cahya Karunia Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .printable-area {
            padding: 20px;
            border: 1px solid #000;
            font-size: 14px;
            line-height: 1.6;
        }
        .heading {
            text-align: center;
            margin-bottom: 20px;
        }
        .heading h2 {
            margin: 0;
        }
        .company-info, .recipient-info, .goods-info {
            margin-bottom: 15px;
        }
        .footer-note {
            margin-top: 20px;
            font-size: 12px;            
        }
        .signature {
            margin-top: 40px;
        }
        .signature div {
            display: inline-block;
            width: 45%;
            text-align: center;
            vertical-align: top;
        }
        .signature-box {
            border: 1px solid #000;
            height: 100px;
            margin-bottom: 15px;
        }
        .print-button {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container printable-area">
        <div class="heading">
            <h2>Surat Jalan</h2>
            <p><em>C K J</em></p>
        </div>
        <div class="company-info">
            <p><strong>Company:</strong> CV.Cahya Karunia Jaya</p>
            <p><strong>Address:</strong> Jl.Bojong No 16,Kec.katapang,Kab,Bandung</p>
            <p><strong>Contact:</strong> 02285872293</p>
        </div>
        <div class="recipient-info">
            <p><strong>Kode Barang:</strong> <?= $data['kodeBarang'] ?></p>
            <p><strong>Nama Barang:</strong> <?= $data['namaBarang'] ?></p>
            <p><strong>Nama Supir:</strong> <?= $data['namaSupir'] ?></p>
        </div>
        <div class="goods-info">
            <p><strong>Jumlah Barang:</strong> <?= $data['jumlahBarang'] . " " . $data['ukuranBarang'] ?></p>
            <p><strong>Tanggal Kirim:</strong> <?= $data['tanggalkirim'] ?></p>
            <p><strong>Penerima:</strong> <?= $data['penerima'] ?></p>
        </div>
        <div class="footer-note">
            <p>Thank you for your business!</p>
            <p><em>This document was generated on <?= date("d M Y") ?></em></p>
        </div>
        <div class="signature">
            <div>
                <div class="signature-box"></div>
                <p><?= $data['penerima'] ?></p>
                <strong>TTD penerima</strong>
            </div>
            <div>
                <div class="signature-box"></div>
                <p><?= $data['namaSupir'] ?></p>
                <strong>TTD Driver</strong>
            </div>
        </div>
        <div class="print-button">
            <button onclick="window.print()" class="btn btn-success">Print Surat Jalan</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
