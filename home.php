<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contoh Jenis Kaca</title>
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            padding-bottom: 50px;
        }
        .container {
            padding: 20px;
            animation: fadeIn 1s ease-in-out;
        }
        .jenis-kaca {
            display: flex;
            align-items: flex-start;
            margin: 20px 0;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .jenis-kaca:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }
        .jenis-kaca img {
            max-width: 200px;
            height: auto;
            border-radius: 10px;
            margin-right: 20px;
        }
        .jenis-kaca h3 {
            margin-top: 0;
            color: #ff9800;
        }
        .jenis-kaca p {
            margin: 0;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h1>✨ Contoh Jenis Kaca ✨</h1>
        <div class="jenis-kaca">
            <img src="IMG/polos.jpg" alt="Kaca Bening">
            <div>
                <h3>Kaca Bening</h3>
                <p><strong>Karakteristik:</strong><br>Kaca polos ini memiliki sifat transparan yang memungkinkan cahaya alami masuk dengan baik. Tersedia dalam berbagai ketebalan mulai dari 5 mm, 6 mm, 8 mm, 10 mm, hingga 12 mm. Biasanya memiliki permukaan yang halus dan rata tanpa pola atau tekstur.</p>
                <p><strong>Perawatan:</strong><br> Kaca polos ini mudah dibersihkan dengan pembersih kaca biasa dan kain lembut. Penting untuk menghindari bahan pembersih yang abrasif untuk menjaga permukaan tetap bening.</p>
            </div>
        </div>
        <div class="jenis-kaca">
            <img src="IMG/GW.jpg" alt="Kaca Glasstone White">
            <div>
                <h3>Kaca Stopsol</h3>
                <p>Kaca stopsol memiliki kemampuan memantulkan cahaya matahari, sehingga membantu mengurangi beban energi untuk pendingin ruangan.</p>
            </div>
        </div>
        <div class="jenis-kaca">
            <img src="IMG/GB.jpg" alt="Kaca Es Buram">
            <div>
                <h3>Kaca Es Buram</h3>
                <p>Kaca es buram dikenal dengan tekstur khasnya yang mengaburkan bayangan, baik sebagai dekorasi maupun untuk mengurangi sinar matahari secara langsung.</p>
            </div>
        </div>
    </div>
  </body>
</html>
