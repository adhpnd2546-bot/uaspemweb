<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>TaniPantau - Portal Pertanian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #16A34A; --primary-dark: #15803D; --primary-light: rgba(22,163,74,0.1); --dark: #1e293b; --body: #64748b; --heading: #0f172a; --border: #e2e8f0; --bg: #f8fafc; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--body); line-height: 1.6; }
        h1, h2, h3, h4, h5, h6 { color: var(--heading); }
        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        .btn-primary { background: var(--primary); border-color: var(--primary); border-radius: 8px; padding: 10px 24px; font-weight: 600; font-size: 0.875rem; transition: all 0.2s; }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(22,163,74,0.25); }
        .btn-outline-primary { color: var(--primary); border-color: var(--primary); border-radius: 8px; font-weight: 600; font-size: 0.875rem; }
        .btn-outline-primary:hover { background: var(--primary); border-color: var(--primary); color: #fff; }
        .btn-outline-danger { border-radius: 8px; font-weight: 600; font-size: 0.875rem; }
        .btn-sm { padding: 6px 16px; font-size: 0.8125rem; }
        .btn-soft { background: var(--primary-light); color: var(--primary); border: none; border-radius: 8px; font-weight: 600; font-size: 0.875rem; padding: 10px 24px; transition: all 0.2s; }
        .btn-soft:hover { background: var(--primary); color: #fff; }
        .form-control, .form-select { border-radius: 8px; border: 1.5px solid #d1d5db; padding: 10px 14px; font-size: 0.875rem; color: #1e293b; background: #fff; transition: all 0.2s; }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); outline: none; background: #fff; }
        .form-control:hover, .form-select:hover { border-color: #9ca3af; }
        .form-control::placeholder { color: #9ca3af; font-weight: 400; }
        .form-control-sm, .form-select-sm { padding: 8px 12px; font-size: 0.8125rem; border-radius: 6px; }
        .form-select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; background-size: 12px; padding-right: 36px; appearance: none; }
        .form-label { font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 4px; letter-spacing: 0.02em; }
        .form-check-input:checked { background-color: var(--primary); border-color: var(--primary); }
        .card { border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04); transition: all 0.25s; }
        .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .badge { font-weight: 500; padding: 4px 12px; border-radius: 6px; font-size: 0.75rem; }
        .badge-sm { padding: 2px 10px; font-size: 0.6875rem; border-radius: 4px; }
        .badge-aman { background: #16a34a; color: #fff; }
        .badge-pantau { background: #d97706; color: #fff; }
        .badge-tindakan { background: #dc2626; color: #fff; }
        .badge-secondary { background: #64748b; color: #fff; }
        .table th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.04em; color: #94a3b8; font-weight: 600; padding: 14px 12px !important; border-bottom: 1.5px solid var(--border); }
        .table td { font-size: 0.875rem; padding: 14px 12px !important; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .table tbody tr:hover { background: #f8fafc; }
        section { padding: 60px 0; }
        .navbar { padding: 0; height: 64px; background: rgba(255,255,255,0.95) !important; backdrop-filter: blur(12px); border-bottom: 1px solid var(--border); }
        .navbar-brand { font-weight: 800; font-size: 1.25rem; color: var(--heading) !important; letter-spacing: -0.02em; }
        .navbar-brand i { color: var(--primary); }
        .nav-link { font-weight: 500; font-size: 0.875rem; color: var(--body) !important; padding: 8px 16px !important; border-radius: 6px; transition: all 0.2s; }
        .nav-link:hover { color: var(--primary) !important; background: var(--primary-light); }
        .user-badge { font-size: 0.8125rem; font-weight: 600; color: var(--body); padding: 6px 14px; background: var(--primary-light); border-radius: 20px; display: flex; align-items: center; gap: 6px; }
        .user-avatar { width: 32px; height: 32px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; }
        .hero-wrap { background: linear-gradient(135deg, #064e3b 0%, #059669 40%, #10b981 100%); position: relative; overflow: hidden; padding: 80px 0; }
        .hero-wrap::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
        .hero-wrap .container { position: relative; z-index: 1; }
        .hero-icon { width: 72px; height: 72px; background: rgba(255,255,255,0.15); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 24px; backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.1); }
        .stat-box { background: white; border-radius: 12px; padding: 28px 24px; text-align: center; border: 1px solid var(--border); transition: all 0.25s; }
        .stat-box:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.06); }
        .stat-box .num { font-size: 2rem; font-weight: 800; color: var(--heading); line-height: 1.2; }
        .stat-box .label { font-size: 0.8125rem; color: var(--body); font-weight: 500; margin-top: 4px; }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 1.25rem; }
        .stat-icon.green { background: #dcfce7; color: #16a34a; }
        .stat-icon.blue { background: #dbeafe; color: #2563eb; }
        .stat-icon.amber { background: #fef3c7; color: #d97706; }
        .card-lahan { border: 1px solid #e9edf2; border-radius: 10px; background: white; transition: all 0.2s; height: 100%; }
        .card-lahan:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.06); border-color: #d0d5dd; }
        .card-lahan .body { padding: 20px; }
        .card-visit { background: white; border: 1px solid #e9edf2; border-radius: 12px; padding: 20px; transition: all 0.25s; }
        .card-visit:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.07); border-color: #d0d5dd; transform: translateY(-2px); }
        .visit-date { display: flex; flex-direction: column; align-items: center; background: #f8fafc; border-radius: 8px; padding: 6px 12px; min-width: 48px; border: 1px solid #f1f5f9; }
        .visit-date .day { font-size: 1.125rem; font-weight: 800; color: #0f172a; line-height: 1.1; }
        .visit-date .month { font-size: 0.625rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.04em; }
        .kondisi-badge { display: inline-flex; align-items: center; font-size: 0.6875rem; font-weight: 600; padding: 3px 10px; border-radius: 6px; border: 1px solid; }
        .visit-note { background: #f8fafc; border-radius: 8px; padding: 10px 14px; font-size: 0.8125rem; color: #475569; border-left: 3px solid var(--primary); margin-top: 12px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .fase-badge { font-size: 0.625rem; font-weight: 700; padding: 3px 10px; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.04em; line-height: 1.4; }
        .badge-persiapan { background: #e9ecef; color: #495057; border: 1px solid #ced4da; }
        .badge-tanam { background: #0284c7; color: #fff; border: 1px solid #0369a1; }
        .badge-pemeliharaan { background: #d97706; color: #fff; border: 1px solid #b45309; }
        .badge-panen { background: #16a34a; color: #fff; border: 1px solid #15803d; }
        .filter-card { background: white; border: 1px solid var(--border); border-radius: 12px; padding: 24px; }
        .progress-bar-custom { height: 6px; border-radius: 3px; background: #f1f5f9; overflow: hidden; }
        .progress-bar-custom .fill { height: 100%; border-radius: 3px; transition: width 0.6s ease; }
        .page-link { border: none; padding: 8px 16px; font-size: 0.875rem; font-weight: 500; color: var(--body); border-radius: 8px !important; margin: 0 2px; }
        .page-link:hover { background: var(--primary-light); color: var(--primary); }
        .page-item.active .page-link { background: var(--primary); color: #fff; }
        footer { background: #0f172a; color: rgba(255,255,255,0.6); padding: 32px 0; font-size: 0.8125rem; }
        .detail-card { background: white; border: 1px solid var(--border); border-radius: 12px; padding: 28px; }
        .info-chip { background: #f8fafc; border-radius: 8px; padding: 16px; text-align: center; border: 1px solid #f1f5f9; }
        .info-chip .chip-label { font-size: 0.6875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em; color: #94a3b8; }
        .info-chip .chip-value { font-size: 1rem; font-weight: 700; color: var(--heading); margin-top: 2px; }
        .navbar-toggler { width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; border-radius: 10px; border: 1.5px solid #e2e8f0; background: white; padding: 0; color: var(--heading); transition: all 0.25s; cursor: pointer; }
        .navbar-toggler:hover { background: #f0fdf4; border-color: #86efac; }
        .navbar-toggler:focus { box-shadow: 0 0 0 3px rgba(22,163,74,0.15); outline: none; }
        .navbar-toggler[aria-expanded="true"] { background: #f0fdf4; border-color: var(--primary); }
        .navbar-toggler-icon { display: block; width: 22px; height: 22px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%231e293b' d='M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: center; background-size: contain; }
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%2316a34a' d='M18.36 5.64a1 1 0 0 1 0 1.42L13.41 12l4.95 4.95a1 1 0 1 1-1.42 1.42L12 13.41l-4.95 4.95a1 1 0 1 1-1.42-1.42L10.59 12 5.64 7.05a1 1 0 0 1 1.42-1.42L12 10.59l4.95-4.95a1 1 0 0 1 1.42 0z'/%3E%3C/svg%3E"); }
        @media (max-width: 991.98px) { .navbar { height: 56px; } .navbar .container { padding: 0 16px; } .navbar-collapse { background: white; border-radius: 0 0 16px 16px; box-shadow: 0 16px 40px rgba(0,0,0,0.08); padding: 8px 16px 16px; margin: 0 -16px; } .navbar-nav { padding: 0; gap: 2px !important; } .navbar-nav .nav-item { width: 100%; } .navbar-nav .nav-link { padding: 12px 16px !important; border-radius: 10px; font-size: 0.9375rem; font-weight: 500; } .navbar-nav .nav-link:hover { background: #f0fdf4 !important; color: var(--primary) !important; } .navbar-nav .ms-lg-2 { margin-left: 0 !important; margin-top: 4px; padding-top: 10px; border-top: 1.5px solid #f1f5f9; } .navbar-nav .btn { width: 100%; text-align: center; padding: 12px !important; font-size: 0.9375rem; border-radius: 10px; } }
        @media (max-width: 768px) { .hero-wrap { padding: 48px 0; } .hero-wrap h1 { font-size: 1.75rem; } .stat-box .num { font-size: 1.5rem; } section { padding: 32px 0; } }
        .fade-in { animation: fadeUp 0.4s ease-out; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <span class="material-symbols-outlined me-2" style="font-variation-settings:'FILL'1;font-size:24px;">eco</span>TaniPantau
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="bi bi-house-fill me-1"></i>Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#statistik"><i class="bi bi-bar-chart-fill me-1"></i>Statistik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#data-lahan"><i class="bi bi-view-list me-1"></i>Data Lahan</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <?php if (isLoggedIn() && getUserRole() === 'manajer'): ?>
                    <div class="d-flex align-items-center gap-2">
                        <div class="user-badge">
                            <span class="user-avatar"><?= strtoupper(substr(getUserName(), 0, 1)) ?></span>
                            <?= htmlspecialchars(getUserName()) ?>
                        </div>
                        <a href="logout.php" class="btn btn-outline-danger btn-sm"><i class="bi bi-box-arrow-right"></i></a>
                    </div>
                    <?php else: ?>
                    <a class="btn btn-outline-primary btn-sm" href="login.php">
                        <i class="bi bi-shield-lock me-1"></i> Masuk
                    </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
