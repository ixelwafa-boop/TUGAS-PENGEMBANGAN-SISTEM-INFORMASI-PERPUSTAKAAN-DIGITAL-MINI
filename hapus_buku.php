<?php
include 'config/koneksi.php';
$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'"));
if (file_exists('uploads/' . $d['sampul'])) {
    unlink('uploads/' . $d['sampul']); // Hapus file fisik dari server[cite: 2]
}
mysqli_query($conn, "DELETE FROM buku WHERE id='$id'");
echo "<script>alert('Data buku berhasil dihapus!'); window.location='dashboard.php';</script>";
?>