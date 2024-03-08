<?php
include "koneksi.php";

$id = $_GET['id'];
$ubah = $konek->query("SELECT * FROM tamu WHERE no='$id'");
$a = $ubah->fetch_array();
?>

<?php
include "boot.php";
?>

<style>
    /* CSS untuk mengatur teks menjadi huruf kapital dan di tengah */
    .form-label {
        text-align: center; /* Meletakkan teks di tengah */
    }

    /* CSS untuk menambahkan spasi antar elemen dan mengatur lebar form */
    .form-control {
        margin-bottom: 15px;
        width: 100%;
    }

    /* CSS untuk tombol Kembali */
    .btn-back {
        margin-right: 10px;
    }
</style>

<div class="container col-md-6">
    <form class="form" action="" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $a['nama'] ?>" required>

            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select id="jenis_kelamin" class="form-select" name="jk" required>
                <option selected disabled>PILIH JENIS KELAMIN</option>
                <option value="perempuan" <?php if($a['jk'] == 'perempuan') echo 'selected'; ?>>Perempuan</option>
                <option value="laki-laki" <?php if($a['jk'] == 'laki-laki') echo 'selected'; ?>>Laki-Laki</option>
            </select>

            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $a['alamat'] ?>" required>

            <label for="keperluan" class="form-label">Keperluan</label>
            <input type="text" class="form-control" id="keperluan" name="keperluan" value="<?= $a['keperluan'] ?>" required>

            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-3" name="ganti">Simpan</button>
                <a href="datatamu.php" class="btn btn-secondary mt-3 btn-back">Kembali</a>
            </div>
        </div>
    </form>
</div>

<?php
if(isset($_POST['ganti'])) {
    $nama = $_POST['nama'];
    // Perbaikan: Ambil nilai jenis kelamin yang sudah ada di database
    $jk = $a['jk'];
    $alamat = $_POST['alamat'];
    $keperluan = $_POST['keperluan'];

    $edit = $konek->query("UPDATE tamu SET nama='$nama', jk='$jk', alamat='$alamat', keperluan='$keperluan' WHERE no='$id'");
    
    if($edit) {
        echo '<div class="container col-md-6 alert alert-success" role="alert">Data berhasil diupdate, tekan tombol Kembali untuk cek data.</div>';
        echo '<script>window.location.href = "datatamu.php";</script>'; // Redirect setelah pesan sukses ditampilkan
    } else {
        echo '<div class="container col-md-6 alert alert-danger" role="alert">Terjadi kesalahan dalam pengubahan data.</div>';
    }
} else {
    echo '<div class="container col-md-6 alert alert-info" role="alert">Silahkan ubah.</div>';
}
?>