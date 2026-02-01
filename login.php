<?php
session_start();
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $QUERY = mysqli_query($conn, "SELECT * FROM userr WHERE Username='$username' AND Password='$password'");
    
    if (mysqli_num_rows($QUERY) > 0) {
        $data = mysqli_fetch_array($QUERY);
        $_SESSION['user'] = $data;
        echo "<script>alert('Selamat datang, " . $data['nama'] . "'); location.href='ds.php';</script>";
    } else {
        echo "<script>alert('Username atau password salah.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKJ Login - Modern UI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        /* Background Fullscreen dengan Efek Blur */
        body {
    font-family: 'Poppins', sans-serif;
    background: url('IMG/kaca.jpg') no-repeat center center fixed;
    background-size: cover; /* Full screen tanpa blur */
    height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

        /* Container Form */
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 350px;
            animation: fadeIn 1s ease-in-out;
        }

        .login-container h3 {
            color: white;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-control {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid rgba(255, 255, 255, 0.4); /* Border lebih terlihat */
    border-radius: 6px;
    background: rgba(255, 255, 255, 0.2);
    color: #222; /* Warna teks lebih gelap supaya jelas */
    transition: 0.3s ease-in-out;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.7); /* Placeholder lebih terang */
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.9); /* Background lebih terang pas fokus */
    color: #000; /* Teks tetap gelap saat fokus */
    box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);
    outline: none;
}


        /* Tombol Login */
        .btn-login {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            border: none;
            color: white;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            font-size: 16px;
        }

        .btn-login:hover {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
            box-shadow: 0px 5px 15px rgba(255, 75, 43, 0.5);
        }

        /* Animasi */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            display: block;
            margin: 0 auto 10px;
        }

        /* Link Register */
        .register-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: #ff4b2b;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container" data-aos="zoom-in">
        <img src="IMG/ogo.png" alt="LOGO" width="120" class="logo">
        <h3>Login User</h3>
        <form method="post">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <button type="submit" class="btn-login">Login</button>
        </form>
        <p class="register-link">Belum punya akun? <a href="#">Daftar</a></p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
