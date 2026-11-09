<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Mini Digital Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php"><i class="fa-solid fa-book-open-reader me-2 text-primary"></i>Mini Library</a>
            <a href="dashboard.php" class="btn btn-outline-light btn-sm rounded-pill"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card card-custom p-3 p-md-4 bg-white">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 56px; height: 56px;">
                                <i class="fa-solid fa-book-medical fs-4"></i>
                            </div>
                            <h4 class="fw-bold">Tambah Buku Baru</h4>
                            <p class="text-muted small mb-0">Isi seluruh informasi detail buku di bawah ini[cite: 2].</p>
                        </div>

                        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-uppercase">Judul Buku</label>
                                <input type="text" name="judul_buku" class="form-control" placeholder="Contoh: Pemrograman Web dengan PHP" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-uppercase">Kategori</label>
                                <input type="text" name="kategori" class="form-control" placeholder="Contoh: Pemrograman / Fiksi / Sains" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-uppercase">Penulis</label>
                                <input type="text" name="penulis" class="form-control" placeholder="Nama lengkap penulis" required>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label class="form-label fw-semibold small text-uppercase">Tahun Terbit</label>
                                    <input type="number" name="tahun_terbit" class="form-control" placeholder="2026" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold small text-uppercase">Stok</label>
                                    <input type="number" name="stok" class="form-control" placeholder="Jumlah stok" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold small text-uppercase">File Sampul (.jpg / .png)</label>
                                <input type="file" name="sampul" class="form-control" accept="image/png, image/jpeg" required>
                                <div class="form-text text-muted small"><i class="fa-solid fa-circle-info me-1"></i>Ukuran berkas maksimal 2MB[cite: 2].</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="simpan" class="btn btn-primary py-2 rounded-pill fw-semibold"><i class="fa-solid fa-floppy-disk me-1"></i> Simpan Buku</button>
                                <a href="dashboard.php" class="btn btn-light py-2 rounded-pill text-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>