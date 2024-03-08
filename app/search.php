<?php
include "koneksi.php";
include "boot.php";
?>
<table class="table table-bordered">
<thead>
<tr>
    <th scope="col">No</th>
    <th scope="col">Nama</th>
    <th scope="col">Jenis Kelamin</th>
    <th scope="col">Alamat</th>
    <th scope="col">Keperluan</th>
    <th scope="col">Waktu</th>
    <th scope="col">Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no = 0; // Inisialisasi variabel $no
$tampil = $konek->query("SELECT * FROM tamu WHERE nama LIKE '%{$_POST['cari']}%' OR alamat LIKE '%{$_POST['cari']}%' ");
while ($s = $tampil->fetch_array()) {
    $no++; // Increment variabel $no
    echo "<tr>";
    echo "<td>$no</td>";
    echo "<td>$s[nama]</td>";
    echo "<td>$s[jk]</td>";
    echo "<td>$s[alamat]</td>";
    echo "<td>$s[keperluan]</td>";
    echo "<td>$s[waktu]</td>";
    ?>
    <td><a href="delete.php?id=<?= $s['no']?>" class="btn btn-danger">Hapus</a></td>
    <td><a href="update.php?id=<?= $s['no']?>" class="btn btn-success">Edit</a></td>
    <?php
    echo "</tr>";
}
?>
</tbody>
</table>