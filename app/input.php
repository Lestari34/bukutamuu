<?php
include "boot.php";

// Proses penyimpanan data jika form disubmit
include "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $keperluan = $_POST['keperluan'];

    if ($nama == "") {
        $pesan_error = "Maaf, nama wajib diisi";
    } else {
        $simpan = $konek->query("INSERT INTO tamu (nama, jk, alamat, keperluan) VALUES ('$nama','$jk','$alamat','$keperluan')");
        
        if ($simpan) {
            $pesan_sukses = "Data berhasil disimpan!";
        } else {
            $pesan_error = "Terjadi kesalahan dalam penyimpanan data.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tamu</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container mb-4">
    <form class="form" action="" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama" required>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" class="form-select" aria-label="Default select exampleInputEmail1" name="jk">
                <option value="1">--pilih jenis kelamin--</option>
                <option value="perempuan">Perempuan</option>
                <option value="laki-laki">Laki-Laki</option>
            </select>

            <label for="exampleInputEmail1" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="alamat" required>

            <label for="exampleInputEmail1" class="form-label">Keperluan</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="keperluan" required>

            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <?php
            if(isset($pesan_error)) {
                echo '<div class="alert alert-danger" role="alert">' . $pesan_error . '</div>';
            } elseif(isset($pesan_sukses)) {
                echo '<div class="alert alert-success" role="alert">' . $pesan_sukses . '</div>';
            }
        ?>
    </form>
</div>

</body>
</html>