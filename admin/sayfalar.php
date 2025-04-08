<?php
include "includes/header.php";
include "includes/config.php";
include "includes/admin_kontrol.php";

//veritabanından sayfaları çekme
$sayfalar = $baglanti->query("SELECT * FROM sayfalar ORDER BY id DESC");
?>

<div class="mb-4">
    <div class="d-flex gap-4 align-items-center">
        <h2 class="mb-3">📄 Statik Sayfalar</h2>
        <div class="d-flex align-items-center">
            <a href="sayfa_ekle.php" class="btn btn-sm btn-success mb-3 ">➕ Yeni Sayfa Ekle</a>
        </div>
    </div>
    <?php if ($sayfalar->num_rows > 0): ?>
        <ul class="list-group gap-1">
            <?php while ($s = $sayfalar->fetch_assoc()) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($s["baslik"]) ?>
                    <a href="sayfa_duzenle.php?id=<?= $s["id"] ?>" class="btn btn-sm btn-outline-primary">Düzenle</a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-warning">Henüz hiç sayfa eklenmemiş.</div>
    <?php endif; ?>
</div>

<?php include "includes/footer.php";
