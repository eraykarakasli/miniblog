<?php
include "admin/includes/config.php";
include "includes/visitor_header.php";

// En çok okunan 5 yazıyı al
$populer_yazilar = $baglanti->query("SELECT id, baslik, goruntulenme, slug FROM posts WHERE durum = 'yayinda' ORDER BY goruntulenme DESC LIMIT 10");

// Yalnızca yayındaki ve filtreye göre yazılar
$kosul = "";
if (isset($_GET["kategori"])) {
    $kategori = $baglanti->real_escape_string($_GET["kategori"]);
    $kosul = "WHERE kategori = '$kategori'";
}

$yazilar = $baglanti->query("SELECT * FROM posts $kosul ORDER BY eklenme_tarihi DESC");

//badge renkledirme
function kategoriBadgeRenk($kategori)
{
    return match ($kategori) {
        "Genel" => "bg-primary",
        "Günlük" => "bg-warning text-dark",
        "İpucu" => "bg-success",
        "Teknoloji" => "bg-info text-dark",
        default => "bg-secondary"
    };
}
?>


<?php if ($slider_yazilar->num_rows > 0): ?>
    <div id="slider" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $aktif = true;
            while ($s = $slider_yazilar->fetch_assoc()): ?>
                <div class="carousel-item <?= $aktif ? 'active' : '' ?>">
                    <?php $aktif = false; ?>
                    <img src="<?= "./admin/" . $s["gorsel"] ?>" class="d-block w-100" style="object-fit: cover; height: 450px;" alt="">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 p-4 rounded-3">
                        <h3 class="fw-bold"><?= htmlspecialchars($s["baslik"]) ?></h3>
                        <p class="lead"><?= mb_strimwidth(strip_tags($s["icerik"]), 0, 150, "...") ?></p>
                        <a href="post.php?slug=<?= $s["slug"] ?>" class="btn btn-light btn-lg">Devamını Oku</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
<?php endif; ?>

<div class="container my-5">
    <h1 class="mb-4">📰 MiniBlog</h1>
    <?php if (isset($_GET["kategori"])): ?>
        <h2 class="mb-4"><?= htmlspecialchars($_GET["kategori"]) ?> Kategorisi</h2>
    <?php else: ?>
        <h2 class="mb-4">Tüm Yazılar</h2>
    <?php endif; ?>
    <?php if ($yazilar->num_rows > 0): ?>
        <div class="d-flex justify-content-between col-12">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 col-8">
                <?php while ($yazi = $yazilar->fetch_assoc()): ?>
                    <div class="col">
                        <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4 h-100">
                            <?php if (!empty($yazi["gorsel"])): ?>
                                <img src="<?= "./admin/" . $yazi["gorsel"] ?>" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($yazi["baslik"]) ?></h5>

                                <span class="badge <?= kategoriBadgeRenk($yazi["kategori"]) ?>">
                                    <?= $yazi["kategori"] ?>
                                </span>
                                <p class="card-text mt-2">
                                <p class="card-text"><?= mb_substr(strip_tags($yazi["icerik"]), 0, 120) ?>...</p>
                                </p>
                                <a href="post.php?slug=<?= $yazi["slug"] ?>" class="btn btn-primary btn-sm mt-2">Devamını Oku</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="mt-5 col-4">
                <h4>🔥 En Çok Okunan Yazılar</h4>
                <ul class="list-group">
                    <?php while ($pop = $populer_yazilar->fetch_assoc()): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="post.php?slug=<?= $pop["slug"] ?>" class="text-decoration-none">
                                <?= htmlspecialchars($pop["baslik"]) ?>
                            </a>
                            <span class="badge bg-primary rounded-pill"><?= $pop["goruntulenme"] ?> 👁</span>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-warning">Henüz yayınlanmış yazı yok.</div>
    <?php endif; ?>
</div>

<?php include "includes/visitor_footer.php"; ?>