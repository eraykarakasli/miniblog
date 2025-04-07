<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "./includes/header.php";
include "./includes/config.php";
include "./includes/admin_kontrol.php";

//yorum onaylama
if (isset($_GET["onayla"])) {
    $id = (int) $_GET["onayla"];
    $baglanti->query("UPDATE comments SET onay = 1 WHERE id =$id");
    header("Location: yorumlar.php");
    exit;
}

//yorum silme
if (isset($_GET["sil"])) {
    $id = (int) $_GET["sil"];
    $baglanti->query("DELETE FROM comments WHERE id = $id");
    header("Location: yorumlar.php");
    exit;
}

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
                <strong><?= htmlspecialchars($y["isim"]) ?></strong> → 
                <em><?= htmlspecialchars($y["baslik"]) ?></em> <br>
                <?= nl2br(htmlspecialchars($y["yorum"])) ?>
                <div class="small text-muted"><?= $y["tarih"] ?></div>
                <div class="mt-2">
                    <?php if (!$y["onay"]): ?>
                        <a href="?onayla=<?= $y["id"] ?>" class="btn btn-success btn-sm">Onayla</a>
                    <?php endif; ?>
                    <a href="?sil=<?= $y["id"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yorumu silmek istiyor musunuz?')">Sil</a>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <div class="alert alert-info">Hiç yorum bulunamadı.</div>
<?php endif; ?>

<?php include "./includes/footer.php"; ?>