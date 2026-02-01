<?php
session_start();
// Memastikan session user tidak ada, baru redirect ke login
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit(); // Pastikan script berhenti setelah redirection
}

// Pastikan nama user yang akan ditampilkan
$name = isset($_SESSION['user']['nama']) ? $_SESSION['user']['nama'] : 'User'; // Default ke 'User' jika 'nama' tidak ada
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Halaman Admin</h1>
    <a href="index.php">Home</a>
    <a href="logout.php">Logout</a>
    <hr>
    <h3>Selamat datang, <?php echo htmlspecialchars($name); ?></h3> <!-- Menampilkan nama user -->
    Halaman ini akan tampil setelah kita login 
</body>
</html>
