<?php
require_once 'includes/api.php';
require_once 'includes/auth.php';

if (isLoggedIn()) {
    $role = getUserRole();
    if ($role === 'manajer') { header('Location: index.php'); exit; }
    header('Location: http://127.0.0.1:8000/login'); exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $result = apiPost('/auth/login', ['email' => $email, 'password' => $password]);
    if (isset($result['user'])) {
        loginUser($result['user']);
        $role = $result['user']['role'];
        if ($role === 'manajer') header('Location: index.php');
        elseif ($role === 'admin') header('Location: http://127.0.0.1:8000/admin/dashboard');
        else header('Location: http://127.0.0.1:8000/petugas/kunjungan');
        exit;
    } else {
        $error = $result['message'] ?? 'Email atau password salah';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TaniPantau</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #16A34A; --primary-dark: #15803D; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #064e3b, #059669, #10b981); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .login-card { background: white; border-radius: 16px; padding: 40px; box-shadow: 0 24px 48px rgba(0,0,0,0.2); max-width: 400px; width: 100%; }
        .login-card h1 { font-weight: 800; color: #0f172a; font-size: 1.5rem; }
        .form-control { border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 12px 14px; font-size: 0.875rem; transition: all 0.2s; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(22,163,74,0.12); }
        .btn-primary { background: var(--primary); border: none; border-radius: 8px; padding: 12px; font-weight: 600; font-size: 0.875rem; transition: all 0.2s; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(22,163,74,0.3); }
        .btn-outline-primary { color: var(--primary); border: 1.5px solid var(--primary); border-radius: 6px; font-weight: 500; font-size: 0.8125rem; padding: 4px 14px; transition: all 0.2s; }
        .btn-outline-primary:hover { background: var(--primary); border-color: var(--primary); color: #fff; }
        .login-icon { width: 56px; height: 56px; background: #dcfce7; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
        .login-icon i { font-size: 1.5rem; color: var(--primary); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <div class="login-icon"><span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL'1;font-size:28px;">eco</span></div>
            <h1>TaniPantau</h1>
            <p class="text-muted" style="font-size:0.875rem;">Masuk ke panel manajemen</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3" style="border:none;border-radius:8px;font-size:0.8125rem;">
                <i class="bi bi-exclamation-circle-fill"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:0.8125rem;">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:0.8125rem;">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                        <i id="eyeIcon" class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>

        </div>
    </div>
    <script>
        function togglePassword() {
            const p = document.getElementById('password');
            const e = document.getElementById('eyeIcon');
            if (p.type === 'password') { p.type = 'text'; e.classList.replace('bi-eye', 'bi-eye-slash'); }
            else { p.type = 'password'; e.classList.replace('bi-eye-slash', 'bi-eye'); }
        }
        function loginAs(e,p) { document.querySelector('[name="email"]').value=e; document.querySelector('[name="password"]').value=p; document.querySelector('form').submit(); }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
