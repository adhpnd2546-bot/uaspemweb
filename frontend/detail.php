<?php
require_once 'includes/api.php';
require_once 'includes/header.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<div class='container mt-5'><div class='alert alert-danger shadow-sm border-0'><i class='bi bi-exclamation-triangle-fill me-2'></i>ID Lahan tidak valid! <a href='index.php' class='alert-link'>Kembali ke beranda</a></div></div>";
    require_once 'includes/footer.php';
    exit;
}

$lahan = apiGet('/api/lahan/' . $id);

if (empty($lahan) || !isset($lahan['id'])) {
    echo "<div class='container mt-5'><div class='alert alert-warning shadow-sm border-0 py-4 text-center'><i class='bi bi-inbox fs-1 d-block mb-3 text-warning'></i><h5 class='fw-bold'>Lahan tidak ditemukan</h5><p class='mb-0'><a href='index.php' class='btn btn-outline-success mt-3'>Kembali ke Beranda</a></p></div></div>";
    require_once 'includes/footer.php';
    exit;
}

function getBadgeClass($status) {
    $s = strtolower(trim($status));
    if ($s == 'persiapan') return 'badge-fase-persiapan';
    if ($s == 'tanam') return 'badge-fase-tanam';
    if ($s == 'pemeliharaan') return 'badge-fase-pemeliharaan';
    if ($s == 'panen') return 'badge-fase-panen';
    return 'bg-secondary';
}

$hasLocation = !empty($lahan['latitude']) && !empty($lahan['longitude']);

// Fetch visits securely
$landVisits = [];
if (!empty($lahan['kunjungan_lahans']) && is_array($lahan['kunjungan_lahans'])) {
    $landVisits = $lahan['kunjungan_lahans'];
} else {
    // Fallback if not embedded
    $allVisits = apiGet('/api/kunjungan');
    if (is_array($allVisits)) {
        foreach ($allVisits as $v) {
            if (($v['lahan_id'] ?? 0) == $lahan['id']) {
                $landVisits[] = $v;
            }
        }
    }
}

// Sort latest first
usort($landVisits, function($a, $b) {
    return strtotime($b['tanggal_kunjungan'] ?? 0) - strtotime($a['tanggal_kunjungan'] ?? 0);
});

?>

<div class="container mt-4 mb-5">
    
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php" class="text-success text-decoration-none"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Lahan</li>
      </ol>
    </nav>

    <div class="row g-4 mb-4">
        <!-- Land Information -->
        <div class="col-lg-8">
            <div class="card shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h2 class="fw-bold mb-0 text-success"><i class="bi bi-card-heading me-2"></i><?= htmlspecialchars($lahan['nama_lahan'] ?? '-') ?></h2>
                    <span class="badge <?= getBadgeClass($lahan['status_fase'] ?? '') ?> rounded-pill px-3 py-2 fs-6">
                        <?= htmlspecialchars($lahan['status_fase'] ?? 'Unknown') ?>
                    </span>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="text-success fs-1 me-3"><i class="bi bi-person-badge"></i></div>
                            <div>
                                <small class="text-muted text-uppercase fw-bold">Nama Petani</small>
                                <h5 class="fw-bold mb-0"><?= htmlspecialchars($lahan['petani']['nama'] ?? '-') ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="text-success fs-1 me-3"><i class="bi bi-basket-fill"></i></div>
                            <div>
                                <small class="text-muted text-uppercase fw-bold">Komoditas</small>
                                <h5 class="fw-bold mb-0"><?= htmlspecialchars($lahan['komoditas'] ?? '-') ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="text-success fs-1 me-3"><i class="bi bi-bounding-box-circles"></i></div>
                            <div>
                                <small class="text-muted text-uppercase fw-bold">Luas Lahan</small>
                                <h5 class="fw-bold mb-0"><?= htmlspecialchars($lahan['luas_lahan'] ?? '-') ?> Hektar</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <div class="text-success fs-1 me-3"><i class="bi bi-calendar-event"></i></div>
                            <div>
                                <small class="text-muted text-uppercase fw-bold">Tanggal Tanam</small>
                                <h5 class="fw-bold mb-0"><?= !empty($lahan['tanggal_tanam']) ? date('d F Y', strtotime($lahan['tanggal_tanam'])) : '-' ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="col-lg-4">
            <div class="card shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-3 border-bottom pb-2"><i class="bi bi-geo-alt-fill text-success me-2"></i>Lokasi Lahan</h5>
                
                <?php if($hasLocation): ?>
                    <div id="map" class="mb-3"></div>
                    <div class="bg-light p-3 rounded text-center">
                        <small class="text-muted d-block mb-1">Titik Koordinat</small>
                        <strong class="font-monospace"><?= htmlspecialchars($lahan['latitude']) ?>, <?= htmlspecialchars($lahan['longitude']) ?></strong>
                    </div>
                    
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var lat = <?= json_encode((float)$lahan['latitude']) ?>;
                            var lng = <?= json_encode((float)$lahan['longitude']) ?>;
                            var map = L.map('map').setView([lat, lng], 14);
                            
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; OpenStreetMap contributors'
                            }).addTo(map);
                            
                            L.marker([lat, lng]).addTo(map)
                                .bindPopup("<b><?= htmlspecialchars($lahan['nama_lahan']) ?></b><br>Petani: <?= htmlspecialchars($lahan['petani']['nama'] ?? '') ?>")
                                .openPopup();
                        });
                    </script>
                <?php else: ?>
                    <div class="alert alert-light text-center py-5 d-flex flex-column justify-content-center h-100 mb-0">
                        <i class="bi bi-geo-alt text-muted fs-1 mb-2"></i>
                        Peta dan Lokasi koordinat lahan tidak tersedia.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Visit History -->
    <div class="card shadow-sm p-4">
        <h4 class="fw-bold mb-4 border-bottom pb-2"><i class="bi bi-journal-text text-success me-2"></i>Riwayat Kunjungan Petugas</h4>
        
        <?php if(empty($landVisits)): ?>
            <div class="alert alert-info border-0 shadow-sm text-center py-4 mb-0">
                <i class="bi bi-info-circle-fill fs-4 d-block mb-2 text-info"></i>
                <h6 class="fw-bold mb-0">Belum ada riwayat kunjungan.</h6>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3 py-3">Tanggal</th>
                            <th>Petugas</th>
                            <th>Kondisi Lahan</th>
                            <th>Catatan</th>
                            <th class="pe-3">Status Tindak Lanjut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($landVisits as $v): ?>
                        <tr>
                            <td class="ps-3 fw-medium text-nowrap"><?= !empty($v['tanggal_kunjungan']) ? date('d M Y', strtotime($v['tanggal_kunjungan'])) : '-' ?></td>
                            <td>
                                <i class="bi bi-person-fill text-muted me-1"></i>
                                <?= htmlspecialchars($v['user']['name'] ?? 'Sistem') ?>
                            </td>
                            <td><?= htmlspecialchars($v['kondisi_lahan'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($v['catatan'] ?? '-') ?></td>
                            <td class="pe-3">
                                <?php
                                    $st = strtolower($v['status_tindak_lanjut'] ?? '');
                                    $bClass = 'bg-secondary';
                                    if ($st == 'aman') $bClass = 'bg-success';
                                    else if ($st == 'perlu pemantauan') $bClass = 'bg-warning text-dark';
                                    else if ($st == 'perlu tindakan') $bClass = 'bg-danger';
                                    else if ($st == 'selesai') $bClass = 'bg-primary';
                                ?>
                                <span class="badge <?= $bClass ?> px-2 py-1">
                                    <?= htmlspecialchars(strtoupper($v['status_tindak_lanjut'] ?? 'UNKNOWN')) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php require_once 'includes/footer.php'; ?>
