<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
include 'config/koneksi.php';

// Hitung Statistik Ringkas
$total_buku    = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM buku"));
$total_tersedia = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM buku WHERE stok > 0"));
$total_dipinjam = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM buku WHERE stok = 0"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mini Digital Library</title>
    <!-- Google Fonts & Bootstrap 5 & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; color: #333; }
        .stat-card { border: none; border-radius: 12px; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-3px); }
        .table-custom { border-radius: 12px; overflow: hidden; background: #fff; }
        .cover-img { object-fit: cover; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.15); }
    </style>
</head>
<body>

    <!-- Navbar Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="dashboard.php">
                <i class="fa-solid fa-book-open-reader me-2 text-primary"></i>Mini Library
            </a>
            <div class="d-flex align-items-center">
                <div class="text-white me-3 d-none d-sm-block">
                    <small class="text-muted d-block" style="font-size: 11px;">Pengguna Active</small>
                    <span class="fw-semibold"><i class="fa-solid fa-circle-user me-1 text-success"></i><?= htmlspecialchars($_SESSION['user']); ?></span>
                </div>
                <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="fa-solid fa-right-from-bracket me-1"></i> Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="container my-4">
        
        <!-- Header Title -->
        <div class="d-md-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Koleksi Perpustakaan Digital</h3>
                <p class="text-muted small mb-0">Kelola inventaris data buku, stok ketersediaan, dan berkas sampul[cite: 1, 2].</p>
            </div>
            <a href="tambah_buku.php" class="btn btn-primary rounded-pill px-4 mt-3 mt-md-0 shadow-sm">
                <i class="fa-solid fa-plus me-2"></i>Tambah Buku Baru
            </a>
        </div>

        <!-- Cards Statistik -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-white p-3 border-start border-4 border-primary">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">TOTAL KOLEKSI</span>
                            <h3 class="fw-bold text-dark mb-0"><?= $total_buku; ?> <small class="fs-6 text-muted">Judul</small></h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle">
                            <i class="fa-solid fa-books fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-white p-3 border-start border-4 border-success">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">STOK TERSEDIA</span>
                            <h3 class="fw-bold text-success mb-0"><?= $total_tersedia; ?> <small class="fs-6 text-muted">Buku</small></h3>
                        </div>
                        <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle">
                            <i class="fa-solid fa-circle-check fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-white p-3 border-start border-4 border-warning">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">HABIS / DIPINJAM</span>
                            <h3 class="fw-bold text-warning mb-0"><?= $total_dipinjam; ?> <small class="fs-6 text-muted">Buku</small></h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle">
                            <i class="fa-solid fa-clock-rotate-left fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Buku -->
        <div class="card border-0 shadow-sm table-custom">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark text-uppercase fs-7">
                            <tr>
                                <th class="py-3 ps-4" style="width: 5%;">No</th>
                                <th class="py-3" style="width: 10%;">Sampul</th>
                                <th class="py-3" style="width: 25%;">Judul Buku</th>
                                <th class="py-3" style="width: 15%;">Kategori</th>
                                <th class="py-3" style="width: 15%;">Penulis</th>
                                <th class="py-3" style="width: 10%;">Tahun</th>
                                <th class="py-3" style="width: 12%;">Status</th>
                                <th class="py-3 text-center" style="width: 9%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = mysqli_query($conn, "SELECT * FROM buku ORDER BY id DESC");
                            if (mysqli_num_rows($data) > 0) {
                                while ($d = mysqli_fetch_array($data)) {
                                    // Logika Percabangan Status Stok
                                    if ($d['stok'] > 0) {
                                        $status_badge = '<span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-medium"><i class="fa-solid fa-circle-check me-1"></i>Tersedia (' . $d['stok'] . ')</span>';
                                    } else {
                                        $status_badge = '<span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-medium"><i class="fa-solid fa-circle-xmark me-1"></i>Dipinjam</span>';
                                    }
                            ?>
                            <tr>
                                <td class="ps-4 fw-bold text-muted"><?= $no++; ?></td>
                                <td>
                                    <img src="uploads/<?= htmlspecialchars($d['sampul']); ?>" class="cover-img" width="48" height="64" alt="Sampul">
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= htmlspecialchars($d['judul_buku']); ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-dark fw-normal px-2 py-1"><?= htmlspecialchars($d['kategori']); ?></span>
                                </td>
                                <td class="text-secondary"><?= htmlspecialchars($d['penulis']); ?></td>
                                <td class="text-muted fw-semibold"><?= $d['tahun_terbit']; ?></td>
                                <td><?= $status_badge; ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="edit_buku.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-outline-warning" title="Edit Data"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="hapus_buku.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-outline-danger" title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini beserta berkas sampulnya?')"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo '<tr><td colspan="8" class="text-center py-5 text-muted"><i class="fa-solid fa-folder-open fs-2 mb-2 d-block"></i>Belum ada koleksi buku yang tersimpan.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>
</html>