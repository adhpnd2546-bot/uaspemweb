<?php
require_once 'includes/api.php';
require_once 'includes/header.php';

// Fetch Statistics with Fallback
$statsData = apiGet('/api/statistik');
if (!empty($statsData)) {
    $totalPetani = $statsData['total_petani'] ?? 0;
    $totalLahan = $statsData['total_lahan'] ?? 0;
    $totalKunjungan = $statsData['total_kunjungan'] ?? 0;
} else {
    $petani = apiGet('/api/petani');
    $lahan = apiGet('/api/lahan');
    $kunjungan = apiGet('/api/kunjungan');
    
    $totalPetani = is_array($petani) ? count($petani) : 0;
    $totalLahan = is_array($lahan) ? count($lahan) : 0;
    $totalKunjungan = is_array($kunjungan) ? count($kunjungan) : 0;
}

// Fetch all lands
$allLahan = apiGet('/api/lahan');
if (!is_array($allLahan)) {
    $allLahan = [];
}

// Compute Insights
$commoditiesCount = [];
$statusCount = [];
foreach ($allLahan as $l) {
    if (!empty($l['komoditas'])) {
        $c = $l['komoditas'];
        $commoditiesCount[$c] = ($commoditiesCount[$c] ?? 0) + 1;
    }
    if (!empty($l['status_fase'])) {
        $s = ucfirst($l['status_fase']);
        $statusCount[$s] = ($statusCount[$s] ?? 0) + 1;
    }
}
arsort($commoditiesCount);
arsort($statusCount);
$topCommodities = array_slice($commoditiesCount, 0, 5);
$topStatus = array_slice($statusCount, 0, 5);

// Search Handling
$searchQuery = $_GET['search'] ?? '';
$filteredLahan = $allLahan;

if (!empty($searchQuery)) {
    $searchLower = strtolower($searchQuery);
    $filteredLahan = array_filter($allLahan, function($l) use ($searchLower) {
        $namaLahan = strtolower($l['nama_lahan'] ?? '');
        $namaPetani = strtolower($l['petani']['nama'] ?? '');
        return strpos($namaLahan, $searchLower) !== false || strpos($namaPetani, $searchLower) !== false;
    });
}
$isSearching = !empty($searchQuery);
$searchCount = count($filteredLahan);

// Pagination Logic
$perPage = 10;
$totalFiltered = count($filteredLahan);
$totalPages = ceil($totalFiltered / $perPage);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $totalPages && $totalPages > 0) $page = $totalPages;

$offset = ($page - 1) * $perPage;
$pagedLahan = array_slice($filteredLahan, $offset, $perPage);

// Badge Mapper
function getBadgeClass($status) {
    $s = strtolower($status);
    if ($s == 'persiapan') return 'badge-fase-persiapan';
    if ($s == 'tanam') return 'badge-fase-tanam';
    if ($s == 'pemeliharaan') return 'badge-fase-pemeliharaan';
    if ($s == 'panen') return 'badge-fase-panen';
    return 'bg-secondary';
}
?>

<!-- Hero Section -->
<div class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3"><i class="bi bi-tree-fill me-3"></i>TaniPantau</h1>
        <p class="lead mb-4">Sistem Monitoring Lahan Pertanian dan Kunjungan Petugas Lapangan</p>
        <a href="#data-lahan" class="btn btn-light btn-lg text-success fw-bold px-4 rounded-pill">
            <i class="bi bi-arrow-down-circle me-2"></i> Lihat Data Lahan
        </a>
    </div>
</div>

<div class="container mb-5">
    
    <!-- Statistics Section -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 text-center p-4">
                <div class="icon-box"><i class="bi bi-people-fill"></i></div>
                <h2 class="display-5 fw-bold text-dark mb-0"><?= $totalPetani ?></h2>
                <p class="text-muted mb-0">Total Petani</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center p-4">
                <div class="icon-box"><i class="bi bi-geo-alt-fill"></i></div>
                <h2 class="display-5 fw-bold text-dark mb-0"><?= $totalLahan ?></h2>
                <p class="text-muted mb-0">Total Lahan</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center p-4">
                <div class="icon-box"><i class="bi bi-journal-check"></i></div>
                <h2 class="display-5 fw-bold text-dark mb-0"><?= $totalKunjungan ?></h2>
                <p class="text-muted mb-0">Total Kunjungan</p>
            </div>
        </div>
    </div>
    
    <div class="text-end mb-5">
        <small class="text-muted"><i class="bi bi-clock-history me-1"></i>Data terakhir diperbarui: <?= date('d F Y H:i') ?></small>
    </div>

    <!-- Agricultural Insights -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card h-100 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2"><i class="bi bi-graph-up-arrow text-success me-2"></i>Top Komoditas</h5>
                <?php if(empty($topCommodities)): ?>
                    <div class="alert alert-light text-center">Data komoditas tidak tersedia.</div>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach($topCommodities as $name => $count): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <?= htmlspecialchars($name) ?>
                            <span class="badge bg-success rounded-pill"><?= $count ?> Lahan</span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2"><i class="bi bi-pie-chart-fill text-success me-2"></i>Distribusi Status Lahan</h5>
                <?php if(empty($topStatus)): ?>
                    <div class="alert alert-light text-center">Data status lahan tidak tersedia.</div>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach($topStatus as $name => $count): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <?= htmlspecialchars($name) ?>
                            <span class="badge <?= getBadgeClass($name) ?> rounded-pill border"><?= $count ?> Lahan</span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <hr class="mb-5">

    <!-- Search Section -->
    <div class="row justify-content-between align-items-center mb-4" id="data-lahan">
        <div class="col-md-4 mb-3 mb-md-0">
            <h3 class="fw-bold m-0"><i class="bi bi-view-list text-success me-2"></i>Daftar Lahan</h3>
        </div>
        <div class="col-md-5">
            <form action="#data-lahan" method="GET">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control border-start-0" name="search" placeholder="Cari nama lahan atau petani..." value="<?= htmlspecialchars($searchQuery) ?>">
                    <button class="btn btn-success px-4" type="submit">Cari</button>
                    <?php if($isSearching): ?>
                        <a href="index.php#data-lahan" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Counter -->
    <?php if($isSearching): ?>
        <div class="alert alert-info mb-4 border-0 shadow-sm">
            <i class="bi bi-info-circle-fill me-2"></i>
            <?php if($searchCount > 0): ?>
                Ditemukan <strong><?= $searchCount ?></strong> data lahan untuk pencarian "<strong><?= htmlspecialchars($searchQuery) ?></strong>".
            <?php else: ?>
                Tidak ditemukan data yang sesuai untuk pencarian "<strong><?= htmlspecialchars($searchQuery) ?></strong>".
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Land Lists -->
    <?php if(empty($pagedLahan)): ?>
        <?php if(!$isSearching): ?>
            <div class="alert alert-warning border-0 shadow-sm text-center py-5">
                <i class="bi bi-inbox fs-1 d-block mb-3 text-warning"></i>
                <h5 class="fw-bold">Data lahan tidak tersedia.</h5>
                <p class="mb-0">Belum ada data lahan yang diinput kedalam sistem.</p>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach($pagedLahan as $l): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 p-3">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="fw-bold mb-0 text-truncate" title="<?= htmlspecialchars($l['nama_lahan']) ?>"><?= htmlspecialchars($l['nama_lahan']) ?></h5>
                        <span class="badge <?= getBadgeClass($l['status_fase'] ?? '') ?> rounded-pill px-3 py-2">
                            <?= htmlspecialchars($l['status_fase'] ?? 'Unknown') ?>
                        </span>
                    </div>
                    
                    <ul class="list-unstyled mb-4 text-muted">
                        <li class="mb-2"><i class="bi bi-person-fill me-2 text-success"></i><?= htmlspecialchars($l['petani']['nama'] ?? '-') ?></li>
                        <li class="mb-2"><i class="bi bi-basket-fill me-2 text-success"></i><?= htmlspecialchars($l['komoditas'] ?? '-') ?></li>
                        <li><i class="bi bi-bounding-box-circles me-2 text-success"></i><?= htmlspecialchars($l['luas_lahan'] ?? '-') ?> Hektar</li>
                    </ul>
                    
                    <div class="mt-auto">
                        <a href="detail.php?id=<?= $l['id'] ?>" class="btn btn-outline-success w-100 fw-bold">
                            Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if($totalPages > 1): ?>
        <nav class="mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?><?= $isSearching ? '&search='.urlencode($searchQuery) : '' ?>#data-lahan" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?><?= $isSearching ? '&search='.urlencode($searchQuery) : '' ?>#data-lahan">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
                
                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?><?= $isSearching ? '&search='.urlencode($searchQuery) : '' ?>#data-lahan" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    <?php endif; ?>

</div>

<?php require_once 'includes/footer.php'; ?>
