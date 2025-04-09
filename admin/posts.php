<?php
include "./includes/header.php";
include "./includes/config.php";
include "./includes/admin_kontrol.php";

// Mesajı göster ve temizle
if (isset($_SESSION['mesaj'])) {
    $mesaj = $_SESSION['mesaj'];
    unset($_SESSION['mesaj']);
}

// Yazıları çek
$yazilar = $baglanti->query("SELECT * FROM posts ORDER BY eklenme_tarihi DESC");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📝 Yazılar</h2>
        <a href="new_post.php" class="btn btn-success">
            <i class="fas fa-plus"></i> Yeni Yazı
        </a>
    </div>

    <?php if (isset($mesaj)): ?>
        <div class="alert alert-success"><?= $mesaj ?></div>
    <?php endif ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Başlık</th>
                    <th>Kategori</th>
                    <th>Durum</th>
                    <th>Tarih</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($yazi = $yazilar->fetch_assoc()): ?>
                    <tr>
                        <td><?= $yazi['id'] ?></td>
                        <td><?= htmlspecialchars($yazi['baslik']) ?></td>
                        <td><?= htmlspecialchars($yazi['kategori']) ?></td>
                        <td>
                            <?php if ($yazi['durum'] == 'yayinda'): ?>
                                <span class="badge bg-success">Yayında</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Taslak</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d.m.Y H:i', strtotime($yazi['eklenme_tarihi'])) ?></td>
                        <td>
                            <a href="edit_post.php?id=<?= $yazi['id'] ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete_post.php?id=<?= $yazi['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bu yazıyı silmek istediğinizden emin misiniz?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "includes/footer.php"; ?> 