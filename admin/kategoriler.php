<?php

include "./includes/admin_kontrol.php";
include "./includes/config.php";

//kategori ekleme
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["kategori_ad"])) {
    $ad = $baglanti->real_escape_string($_POST["kategori_ad"]);
    $baglanti->query("INSERT INTO kategoriler (ad) VALUES ('$ad')");
    header("Location: kategoriler.php");
    exit;
}

//kategori silme
if (isset($_GET["sil"])) {
    $id = (int) $_GET["sil"];
    $baglanti->query("DELETE FROM kategoriler WHERE id = $id");
    header("Location: kategoriler.php");
    exit;
}

// tüm kategorileri çekme
$kategoriler = $baglanti->query("SELECT * FROM kategoriler ORDER BY ad DESC");
?>

<?php include "./includes/header.php" ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <h2 class="h3 mb-0">📑 Kategori Yönetimi</h2>
                    <span class="badge bg-primary rounded-pill"><?= $kategoriler->num_rows ?> Kategori</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body">
                    <form method="post" class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-tag"></i>
                                </span>
                                <input type="text" name="kategori_ad" class="form-control border-0 bg-light" placeholder="Yeni kategori adı" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i> Kategori Ekle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($kategoriler->num_rows > 0): ?>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 rounded-start">Kategori Adı</th>
                                        <th class="border-0 rounded-end">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($kat = $kategoriler->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3">
                                                        <h6 class="mb-0"><?= htmlspecialchars($kat["ad"]) ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="?sil=<?= $kat["id"] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bu kategoriyi silmek istediğine emin misin?')">
                                                    <i class="fas fa-trash"></i> Sil
                                                </a>
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
                        <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Henüz hiç kategori eklenmemiş</h5>
                        <p class="text-muted mb-0">Yeni bir kategori eklemek için yukarıdaki formu kullanabilirsiniz.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include "./includes/footer.php"; ?>