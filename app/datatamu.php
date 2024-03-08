<?php
    include "koneksi.php";
    include "boot.php";

    // Memproses pencarian jika ada kata kunci yang dikirimkan
    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
        $query = "SELECT * FROM tamu WHERE nama LIKE '%$keyword%'";
        $tampil = $konek->query($query);
    } else {
        // Jika tidak ada kata kunci pencarian, tampilkan semua data
        $tampil = $konek->query("SELECT * FROM tamu");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Custom CSS for table layout */
        .container {
    display: flex;
    justify-content: center; /* Membuat konten berada di tengah secara horizontal */
    align-items: center; /* Membuat konten berada di tengah secara vertikal */
    min-height: 100vh; /* Mengisi tinggi layar penuh */
    padding: 20px;
}

table {
    border-collapse: collapse;
    margin-bottom: 20px; /* Optional margin for spacing */
    /* Menggunakan max-width agar tabel tidak terlalu lebar di layar yang kecil */
    max-width: 100%;
    width: auto; /* Mengatur lebar tabel menjadi otomatis */
    margin-left: auto; /* Mengatur margin kiri menjadi otomatis */
    margin-right: auto; /* Mengatur margin kanan menjadi otomatis */
}


        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* Optional border between rows */
        }
        th {
            background-color: #f2f2f2; /* Optional background color for header row */
        }
        tr:hover {
            background-color: #f5f5f5; /* Optional hover color */
        }
        .btn-group {
            display: flex;
        }
        .btn-group .btn {
            flex: 1;
            margin-right: 5px; /* Optional margin between buttons */
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <br></br>
            <div class="col">
                <center><h1><ins>Data Tamu</h1></ins></center>
                <br>

                <!-- Formulir untuk pencarian -->
                <form action="datatamu.php" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Nama Tamu" name="keyword">
                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                    </div>
                </form>

                <table <center>
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col" style="width: 200px;">Jenis Kelamin</th>
                            <th scope="col">Alamat</th>
                            <th scope="col" style="width: 500px;">Keperluan</th>
                            <th scope="col" style="width: 150px;">Waktu</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $no = 0;
                    while ($s = $tampil->fetch_array()){
                        $no++;
                        echo "<tr>";
                        echo "<td>$no</td>";
                        echo "<td>$s[nama]</td>";
                        echo "<td style='width: 200px;'>$s[jk]</td>";
                        echo "<td>$s[alamat]</td>";
                        echo "<td style='width: 500px;'>$s[keperluan]</td>";
                        // Format waktu menggunakan fungsi date()
                        echo "<td style='width: 200px;'>" . date('Y-m-d H:i:s', strtotime($s['waktu'])) . "</td>";
                    ?>
                        <td class="btn-group">
                            <button class="btn btn-danger" onclick="deleteConfirmation(<?= $s['no'] ?>)">
                                <i class='bi bi-trash'></i>
                            </button>
                            <button class="btn btn-success" onclick="editConfirmation(<?= $s['no'] ?>)">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>
                        <?php
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table >
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Script untuk konfirmasi penghapusan dan pengeditan -->
    <script>
        function deleteConfirmation(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                window.location.href = 'delete.php?id=' + id;
            }
        }

        function editConfirmation(id) {
            if (confirm('Apakah Anda yakin ingin mengedit data ini?')) {
                window.location.href = 'update.php?id=' + id;
            }
        }
    </script>
</body>
</html>