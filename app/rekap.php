<?php
    include "koneksi.php";
    include "boot.php";
    $tampil = $konek->query("SELECT * FROM tamu");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tamu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f8f9fa; /* Warna latar belakang kontainer */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: scale(1.01);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #fff; /* Warna latar belakang kartu */
            border-radius: 10px;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Tambahkan efek transisi pada box-shadow */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Efek bayangan ditingkatkan saat dihover */
        }

        .card-content p {
            margin: 5px 0;
            font-size: 16px;
        }

        .btn-print {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            padding: 10px;
            margin-top: 20px;
            width: 100%;
        }

        .btn-print i {
            margin-right: 5px;
        }

        .btn-print:hover {
            background-color: #0056b3;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }
            .container, .container * {
                visibility: visible;
            }
            .container {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Data Tamu</h1>
        </div>

        <div class="grid-container" id="grid-container">
            <?php
            if(isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $query = "SELECT * FROM tamu WHERE nama LIKE '%$keyword%'";
                $result = $konek->query($query);
            } else {
                $result = $tampil;
            }

            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<div class='card-content'>";
                echo "<h2>".$row['nama']."</h2>";
                echo "<p><strong>Jenis Kelamin:</strong> ".$row['jk']."</p>";
                echo "<p><strong>Alamat:</strong> ".$row['alamat']."</p>";
                echo "<p><strong>Keperluan:</strong> ".$row['keperluan']."</p>";
                echo "<p><strong>Waktu:</strong> ".$row['waktu']."</p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <button class="btn-print" onclick="printData()"><i class="fas fa-print"></i>Cetak Data</button>
    </div>

    <script>
        function printData() {
            var btnPrint = document.querySelector('.btn-print');
            btnPrint.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            setTimeout(function() {
                window.print();
                btnPrint.innerHTML = '<i class="fas fa-print"></i>Cetak Data';
            }, 1000);
        }
    </script>
</body>
</html>