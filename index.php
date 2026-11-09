<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
$cookie_user = isset($_COOKIE['remember_user']) ? $_COOKIE['remember_user'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mini Digital Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-login { width: 100%; max-width: 410px; border: none; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
    </style>
</head>
<body>

    <div class="card card-login bg-white">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                    <i class="fa-solid fa-book-open-reader fs-3"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">Mini Digital Library</h4>
                <p class="text-muted small mb-0">Masukkan akun untuk mengakses dashboard[cite: 1].</p>
            </div>

            <form action="proses_login.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" id="userInput" placeholder="Username" value="<?= htmlspecialchars($cookie_user); ?>" required>
                    <label for="userInput"><i class="fa-solid fa-user me-2 text-muted"></i>Username</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="passInput" placeholder="Password" required>
                    <label for="passInput"><i class="fa-solid fa-lock me-2 text-muted"></i>Password</label>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" value="yes" id="rememberCheck" <?= !empty($cookie_user) ? 'checked' : ''; ?>>
                    <label class="form-check-label text-muted small" for="rememberCheck">
                        Remember Me (Simpan Username)[cite: 1]
                    </label>
                </div>

                <button type="submit" name="login" class="btn btn-primary w-100 py-3 rounded-pill fw-semibold shadow-sm">
                    Sign In <i class="fa-solid fa-arrow-right ms-1"></i>
                </button>
            </form>
        </div>
    </div>

</body>
</html>