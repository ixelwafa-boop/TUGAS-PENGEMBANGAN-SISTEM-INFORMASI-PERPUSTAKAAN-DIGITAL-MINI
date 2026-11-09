<?php
include 'config/koneksi.php';
if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul_buku']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $penulis = mysqli_real_escape_string($conn, $_POST['penulis']);
    $tahun = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];

    $nama_file = $_FILES['sampul']['name'];
    $ukuran_file = $_FILES['sampul']['size'];
    $tmp_file = $_FILES['sampul']['tmp_name'];
    $ekstensi = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

    if (in_array($ekstensi, ['jpg', 'jpeg', 'png'])) {
        if ($ukuran_file <= 2097152) { // Maksimal 2MB[cite: 2]
            $nama_baru = uniqid() . '.' . $ekstensi;
            move_uploaded_file($tmp_file, 'uploads/' . $nama_baru);
            mysqli_query($conn, "INSERT INTO buku (judul_buku, kategori, penulis, tahun_terbit, stok, sampul) VALUES ('$judul', '$kategori', '$penulis', '$tahun', '$stok', '$nama_baru')");
            echo "<script>alert('Buku berhasil ditambahkan!'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Ukuran file terlalu besar! Maksimal 2MB.'); window.location='tambah_buku.php';</script>";
        }
    } else {
        echo "<script>alert('Format file tidak diizinkan! Hanya JPG/PNG.'); window.location='tambah_buku.php';</script>";
    }
}
?>