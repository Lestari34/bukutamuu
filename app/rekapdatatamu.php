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
    <!-- Masukkan file CSS Anda jika diperlukan -->
    <style>
        /* Tambahkan gaya CSS Anda di sini */
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
            background-color: #f8f9fa;
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
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Data Tamu</h1>
    </div>
    <!-- Formulir untuk filter hari, bulan, dan tahun -->
    <form action="" method="GET" class="mb-3">
        <div class="input-group">
            <!-- Filter Hari -->
            <select name="hari" class="form-select">
                <option value="">Pilih Tanggal</option>
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>
            <!-- Filter Bulan -->
            <select name="bulan" class="form-select">
                <option value="">Pilih Bulan</option>
                <?php
                $bulan_nama = array(
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember'
                );
                foreach ($bulan_nama as $bulan => $nama) {
                    echo "<option value='$bulan'>$nama</option>";
                }
                ?>
            </select>
            <!-- Filter Tahun -->
            <select name="tahun" class="form-select">
                <option value="">Pilih Tahun</option>
                <?php
                $tahun_sekarang = date('Y');
                for ($tahun = $tahun_sekarang; $tahun >= 1900; $tahun--) {
                    echo "<option value='$tahun'>$tahun</option>";
                }
                ?>
            </select>
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    <div class="grid-container" id="grid-container">
        <?php
        $query = "SELECT * FROM tamu";
        if(isset($_GET['hari']) && isset($_GET['bulan']) && isset($_GET['tahun'])) {
            $hari = $_GET['hari'];
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            // Filter berdasarkan hari, bulan, dan tahun
            $query = "SELECT * FROM tamu WHERE DAY(waktu) = '$hari' AND MONTH(waktu) = '$bulan' AND YEAR(waktu) = '$tahun'";
        }
        $result = $konek->query($query);

        // Inisialisasi array untuk menyimpan data tamu berdasarkan bulan
        $rekap_data = array();

        // Loop untuk mengelompokkan data tamu berdasarkan bulan
        while ($row = $result->fetch_assoc()) {
            $bulan = date('m', strtotime($row['waktu']));
            $rekap_data[$bulan][] = $row;
        }

        // Tampilkan data tamu yang telah direkap
        foreach ($rekap_data as $bulan => $data_per_bulan) {
            echo "<div>";
            echo "<h2>Data Tamu Bulan " . date('F', mktime(0, 0, 0, $bulan, 1)) . "</h2>";
            echo "<div class='grid-container'>";
            foreach ($data_per_bulan as $data) {  
                echo "<div class='card'>";
                echo "<div class='card-content'>";
                echo "<h2>".$data['nama']."</h2>";
                echo "<p><strong>Jenis Kelamin:</strong> ".$data['jk']."</p>";
                echo "<p><strong>Alamat:</strong> ".$data['alamat']."</p>";
                echo "<p><strong>Keperluan:</strong> ".$data['keperluan']."</p>";
                echo "<p><strong>Waktu:</strong> ".$data['waktu']."</p>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
    <!-- Kode JavaScript untuk mencetak data -->
    <script>
        function printData() {
            var btnPrint = document.querySelector('.btn-print');
            btnPrint.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            setTimeout(function() {
                window.print();
                btnPrint.innerHTML = '<i class="fas fa-print"></i>Cetak Data';
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            var cards = document.querySelectorAll('.card');

            cards.forEach(function(card) {
                card.addEventListener('mouseenter', function() {
                    card.style.animation = 'pulse 1s infinite';
                });

                card.addEventListener('mouseleave', function() {
                    card.style.animation = '';
                });
            });
        });
    </script>
    <button class="btn-print" onclick="printData()"><i class="fas fa-print"></i>Cetak Data</button>
</div>
</body>
</html>