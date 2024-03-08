<?php
$id= $_GET['id'];
include "koneksi.php";
$delete=$konek->query("DELETE from tamu where no='$id'");
?>
<script>
    document.location = 'datatamu.php';
</script>