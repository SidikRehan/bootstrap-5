<?php
$host = "localhost";
$user = "root"; 
$password = ""; 
$database = "adminadmin";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "";

// Tombol simpan jika di klik 
if (isset($_POST['tsimpann'])) {

    // Validasi input
    $kodeBarang = $_POST['tkode'];
    $namaBarang = $_POST['tnama'];
    $asalBarang = $_POST['tasal'];
    $ukuranBarang = $_POST['tukuran'];
    $jumlahBarang = $_POST['tjumlah'];
    $satuanBarang = $_POST['tsatuan'];
    $tanggalMasuk = $_POST['ttanggal'];

    $errors = [];

    if (empty($kodeBarang)) {
        $errors[] = "Kode barang tidak boleh kosong";
    }
    if (empty($namaBarang)) {
        $errors[] = "Nama barang tidak boleh kosong";
    }
    if (empty($asalBarang)) {
        $errors[] = "Asal barang tidak boleh kosong";
    }
    if (empty($ukuranBarang)) {
        $errors[] = "Ukuran barang tidak boleh kosong";
    }
    if (!is_numeric($jumlahBarang) || $jumlahBarang <= 0) {
        $errors[] = "Jumlah barang harus berupa angka positif";
    }
    if (empty($satuanBarang)) {
        $errors[] = "Satuan barang tidak boleh kosong";
    }
    if (empty($tanggalMasuk)) {
        $errors[] = "Tanggal masuk tidak boleh kosong";
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    } else {
        // Barang Masuk
        if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
            $edit = mysqli_query($conn, "UPDATE tabel_masuk SET 
                namaBarang = '$namaBarang', 
                asalBarang = '$asalBarang', 
                ukuranBarang = '$ukuranBarang', 
                jumlahBarang = '$jumlahBarang', 
                satuanBarang = '$satuanBarang', 
                tanggalMasuk = '$tanggalMasuk' 
                WHERE IdBarang = '$_GET[id]'");

            if ($edit) {
                echo "<script>alert('Edit data sukses');document.location='ds.php';</script>";
            } else {
                echo "<script>alert('Edit data gagal');document.location='ds.php';</script>";
            }
        } else {
            $simpan = mysqli_query($conn, "INSERT INTO tabel_masuk 
                (kodeBarang, namaBarang, asalBarang, ukuranBarang, jumlahBarang, satuanBarang, tanggalMasuk) 
                VALUES 
                ('$kodeBarang', '$namaBarang', '$asalBarang', '$ukuranBarang', '$jumlahBarang', '$satuanBarang', '$tanggalMasuk')");

            if ($simpan) {
                echo "<script>alert('Simpan data sukses');document.location='input.php';</script>";
            } else {
                echo "<script>alert('Simpan data gagal');document.location='input.php';</script>";
            }
        }
    }
}


// Barang Keluar
if (isset($_POST['tsimpan'])) {
    // Validasi input
    $kodeBarang = $_POST['tkode'];
    $namaBarang = $_POST['tnama'];
    $namaSupir = $_POST['tsupir'];
    $ukuranBarang = $_POST['tukuran'];
    $jumlahBarang = $_POST['tjumlah'];
    $tanggalKirim = $_POST['tkirim'];
    $penerima = $_POST['tpenerima'];

    $errors = [];

    if (empty($kodeBarang)) {
        $errors[] = "Kode barang tidak boleh kosong";
    }
    if (empty($namaBarang)) {
        $errors[] = "Nama barang tidak boleh kosong";
    }
    if (empty($namaSupir)) {
        $errors[] = "Nama supir tidak boleh kosong";
    }
    if (empty($ukuranBarang)) {
        $errors[] = "Ukuran barang tidak boleh kosong";
    }
    if (!is_numeric($jumlahBarang) || $jumlahBarang <= 0) {
        $errors[] = "Jumlah barang harus berupa angka positif";
    }
    if (empty($tanggalKirim)) {
        $errors[] = "Tanggal kirim tidak boleh kosong";
    }
    if (empty($penerima)) {
        $errors[] = "Penerima tidak boleh kosong";
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    } else {
        if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
            $edit = mysqli_query($conn, "UPDATE tabel_keluar SET 
                namaBarang = '$namaBarang', 
                namaSupir = '$namaSupir', 
                ukuranBarang = '$ukuranBarang', 
                jumlahBarang = '$jumlahBarang', 
                tanggalKirim = '$tanggalKirim', 
                penerima = '$penerima' 
                WHERE IdBarang = '$_GET[id]'");

            if ($edit) {
                echo "<script>alert('Edit data sukses');document.location='barang_keluar.php';</script>";
            } else {
                echo "<script>alert('Edit data gagal');document.location='barang_keluar.php';</script>";
            }
        } else {
            $simpan = mysqli_query($conn, "INSERT INTO tabel_keluar 
                (kodeBarang, namaBarang, namaSupir, ukuranBarang, jumlahBarang, tanggalKirim, penerima) 
                VALUES 
                ('$kodeBarang', '$namaBarang', '$namaSupir', '$ukuranBarang', '$jumlahBarang', '$tanggalKirim', '$penerima')");

            if ($simpan) {
                echo "<script>alert('Simpan data sukses');document.location='barang_keluar.php';</script>";
            } else {
                echo "<script>alert('Simpan data gagal');document.location='barang_keluar.php';</script>";
            }
        }
    }
}


// Menghindari duplikasi variabel
$vkodeBarang ="";
$vnamaBarang ="";
$vasalBarang ="";
$vukuranBarang ="";
$vjumlahBarang ="";
$vsatuanBarang ="";
$vtanggalMasuk="";

if (isset($_GET['hal'])) {

    //pengujian edit data
    if ($_GET['hal'] == "edit") {

        //menampilkan data edit
        $tampil = mysqli_query($conn, "SELECT * FROM tabel_masuk WHERE IdBarang = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data){
            $vkodeBarang = $data['kodeBarang'];
            $vnamaBarang = $data['namaBarang'];
            $vasalBarang = $data['asalBarang'];
            $vukuranBarang = $data['ukuranBarang'];
            $vjumlahBarang = $data['jumlahBarang'];
            $vsatuanBarang = $data['satuanBarang'];
            $vtanggalMasuk = $data['tanggalMasuk'];
        }
    } else if ($_GET['hal'] == "hapus"){
        //persiapan hapus data
        $hapus = mysqli_query($conn, "DELETE FROM tabel_masuk WHERE IdBarang = '$_GET[id]'");
        // Uji hapus data sukses
        if ($hapus){
            echo "<script>alert('Hapus data sukses');document.location='input.php';</script>";
        } else {
            echo "<script>alert('Hapus data gagal');document.location='ds.php';</script>";
        }
    }
}

//deklarasi variable data edit 
$vkodebarang ="";
$vnamabarang ="";
$vnamasupir ="";
$vukuranbarang ="";
$vjumlahbarang ="";
$vtanggalKirim ="";
$vpenerima="";

if (isset($_GET['hal'])) {

    //pengujian edit data
    if ($_GET['hal'] == "edit") {

        //menampilkan data edit
        $tampil = mysqli_query($conn,"SELECT * FROM tabel_keluar WHERE IDBarang = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data){
            $vkodebarang = $data['kodeBarang'];
            $vnamabarang = $data['namaBarang'];
            $vnamasupir = $data['namaSupir'];
            $vukuranbarang = $data['ukuranBarang'];
            $vjumlahbarang = $data['jumlahBarang'];
            $vtanggalkirim = $data['tanggalkirim'];
            $vpenerima = $data['penerima'];
        }
    } else if ($_GET['hal'] == "hapuss"){
        //persiapan hapus data 
        $hapus = mysqli_query($conn,"DELETE FROM tabel_keluar WHERE IDBarang = '$_GET[id]'");
        // Uji hapus data sukses
        if ($hapus){
            echo "<script>alert('Hapus data sukses');document.location='barang_keluar.php';</script>";
        } else {
            echo "<script>alert('Hapus data gagal');document.location='barang_keluar.php';</script>";
        }
    }
}
?>
