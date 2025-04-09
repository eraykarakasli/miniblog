<?php
include "includes/header.php";
include "includes/config.php";
include "includes/admin_kontrol.php";

//veritabanından sayfaları çekme
$sayfalar = $baglanti->query("SELECT * FROM sayfalar ORDER BY id DESC");
?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <h2 class="h3 mb-0">📄 Statik Sayfalar</h2>
                    <span class="badge bg-primary rounded-pill"><?= $sayfalar->num_rows ?> Sayfa</span>
                </div>
                <a href="sayfa_ekle.php" class="btn btn-success">
                    <i class="fas fa-plus"></i> Yeni Sayfa Ekle
                </a>
            </div>
        </div>
    </div>

    <?php if ($sayfalar->num_rows > 0): ?>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 rounded-start">Sayfa Başlığı</th>
                                        <th class="border-0">Slug</th>
                                        <th class="border-0">Sıra</th>
                                        <th class="border-0 rounded-end">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($s = $sayfalar->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3">
                                                        <h6 class="mb-0"><?= htmlspecialchars($s["baslik"]) ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary"><?= htmlspecialchars($s["slug"]) ?></span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info"><?= $s["sira"] ?></span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="sayfa_duzenle.php?id=<?= $s["id"] ?>" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i> Düzenle
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Henüz hiç sayfa eklenmemiş</h5>
                        <p class="text-muted mb-0">Yeni bir sayfa eklemek için yukarıdaki butonu kullanabilirsiniz.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include "includes/footer.php"; ?>
