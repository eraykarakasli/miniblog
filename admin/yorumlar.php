<?php
include "./includes/header.php";
include "./includes/config.php";
include "./includes/admin_kontrol.php";

// Yorum onaylama
if (isset($_GET["onayla"])) {
    $id = (int) $_GET["onayla"];
    $kontrol = $baglanti->query("SELECT id FROM comments WHERE id = $id");
    if ($kontrol->num_rows > 0) {
        $baglanti->query("UPDATE comments SET onay = 1 WHERE id = $id");
    }
    header("Location: yorumlar.php");
    exit;
}

// Yorum silme
if (isset($_GET["sil"])) {
    $id = (int) $_GET["sil"];
    $baglanti->query("DELETE FROM comments WHERE id = $id");
    header("Location: yorumlar.php");
    exit;
}

// Yorumları çek
$yorumlar = $baglanti->query("
    SELECT comments.*, posts.baslik 
    FROM comments 
    LEFT JOIN posts ON comments.post_id = posts.id 
    ORDER BY tarih DESC
");
?>

<h2 class="mb-4">💬 Yorumlar</h2>

<?php if ($yorumlar->num_rows > 0): ?>
    <ul class="list-group">
        <?php while ($y = $yorumlar->fetch_assoc()): ?>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong><?= htmlspecialchars($y["isim"]) ?></strong> → 
                        <em><?= htmlspecialchars($y["baslik"]) ?></em> <br>
                        <?= nl2br(htmlspecialchars($y["yorum"])) ?>
                        <div class="small text-muted"><?= $y["tarih"] ?></div>
                    </div>
                    <div class="text-end">
                        <?php if (!$y["onay"]): ?>
                            <span class="badge bg-warning text-dark mb-2">Onaysız</span><br>
                            <a href="?onayla=<?= $y["id"] ?>" class="btn btn-success btn-sm">✅ Onayla</a>
                        <?php else: ?>
                            <span class="badge bg-success mb-2">✔️ Onaylı</span>
                        <?php endif; ?>
                        <a href="?sil=<?= $y["id"] ?>" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Yorumu silmek istiyor musunuz?')">🗑 Sil</a>
                    </div>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <div class="alert alert-info">Hiç yorum bulunamadı.</div>
<?php endif; ?>

<?php include "./includes/footer.php"; ?>
