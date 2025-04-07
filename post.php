<?php
include "./admin/includes/config.php";
include "includes/visitor_header.php";

//çok okunan 5 yazıyı al
$populer_yazilar = $baglanti->query("SELECT id, baslik, goruntulenme FROM posts WHERE durum = 'yayinda' ORDER BY goruntulenme DESC LIMIT 5");


//id kontrolü
if (!isset($_GET["id"])) {
    echo "<div class='alert alert-danger'>Geçersiz bağlantı.</div>";
    exit;
}

$id = (int)$_GET["id"];

//görüntülenme sayısını 1 artır
$baglanti->query("UPDATE posts SET goruntulenme = goruntulenme + 1 WHERE id = $id");

//yazıyı veritabanından al
$yazi = $baglanti->query("SELECT * FROM posts WHERE id = $id AND durum = 'yayinda'")->fetch_assoc();

if (!$yazi) {
    echo "<div class='alert alert-warning'>Yazı bulunamadı.</div>";
    exit;
}

//yorum kaydetme
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["yorum"])) {
    $isim = $baglanti->real_escape_string($_POST["isim"]);
    $yorum = $baglanti->real_escape_string($_POST["yorum"]);
    $post_id = (int) $_GET["id"];

    $baglanti->query("INSERT INTO comments (post_id, isim, yorum) VALUES ($post_id, '$isim','$yorum')");

    // Yönlendirme ile tekrar gönderimi engelle
    header("Location: post.php?id=$post_id&yorum=ok#yorum-formu");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($yazi["baslik"]) ?> - MiniBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h1><?= htmlspecialchars($yazi["baslik"]) ?></h1>
        <p>
            <span class="badge bg-dark"><?= $yazi["kategori"] ?></span>
            <small class="text-muted ms-2"><?= $yazi["eklenme_tarihi"] ?></small> |
            <small class="text-muted">👁 <?= $yazi["goruntulenme"] ?> kez okundu</small>
        </p>

        <?php if (!empty($yazi["gorsel"])): ?>
            <img src="<?= "./admin/" . $yazi["gorsel"] ?>" class="img-fluid mb-4" style="max-height: 600px;" alt="Yazı görseli">
        <?php endif; ?>

        <div>
            <?= nl2br($yazi["icerik"]) ?>
        </div>
        <hr>
        <a href="index.php" class="btn btn-secondary mt-3">← Geri Dön</a>
    </div>

    <h4 class="mt-5">💬 Yorum Yap</h4>
    <?php if (isset($_GET["yorum"]) && $_GET["yorum"] === "ok"): ?>
        <div class="alert alert-info mt-3">Yorumunuz alındı, admin onayından sonra yayınlanacaktır.</div>
    <?php endif; ?>
    <form method="post" action="" id="yorum-formu">
        <div class="mb-3">
            <label>İsminiz</label>
            <input type="text" name="isim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Yorumunuz</label>
            <textarea name="yorum" rows="4" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gönder</button>
    </form>

    <h4 class="mt-5">🗨️ Yorumlar</h4>
    <?php
    $yorumlar = $baglanti->query("SELECT * FROM comments WHERE post_id = $id AND onay = 1 ORDER BY tarih DESC");

    if ($yorumlar->num_rows > 0):
        while ($y = $yorumlar->fetch_assoc()):
    ?>
            <div class="border rounded p-3 mb-2 bg-light">
                <strong><?= htmlspecialchars($y["isim"]) ?></strong>
                <small class="text-muted"><?= $y["tarih"] ?></small>
                <p class="mb-0"><?= nl2br(htmlspecialchars($y["yorum"])) ?></p>
            </div>
    <?php
        endwhile;
    else:
        echo "<p class='text-muted'>Henüz onaylı yorum yok.</p>";
    endif;
    ?>


</body>

</html>
<?php include "includes/visitor_footer.php"; ?>