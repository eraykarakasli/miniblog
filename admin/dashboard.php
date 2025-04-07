<?php
include "./includes/header.php";
include "./includes/config.php";
include "./includes/admin_kontrol.php";

//toplam yazı sayısı
$toplam_yazi = $baglanti->query("SELECT COUNT(*) AS toplam FROM posts")->fetch_assoc()["toplam"];
// Yayında olanlar
$yayinda = $baglanti->query("SELECT COUNT(*) AS sayi FROM posts WHERE durum = 'yayinda'")->fetch_assoc()["sayi"];

// Taslak olanlar
$taslak = $baglanti->query("SELECT COUNT(*) AS sayi FROM posts WHERE durum = 'taslak'")->fetch_assoc()["sayi"];

// Kategori sayısı
$kategori_sayisi = $baglanti->query("SELECT COUNT(*) AS sayi FROM kategoriler")->fetch_assoc()["sayi"];

$yazilar = $baglanti->query("SELECT * FROM posts ORDER BY eklenme_tarihi DESC");
?>

<h1 class="mb-4">Hoş geldin, Admin 👋</h1>
<h4 class="mb-4">📊 Genel Durum</h6>
<div class="row mb-4 text-center">
    <div class="col-md-3">
        <div class="card border-primary shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Toplam Yazı</h5>
                <p class="display-6"><?= $toplam_yazi ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Yayında</h5>
                <p class="display-6"><?= $yayinda ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-secondary shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Taslak</h5>
                <p class="display-6"><?= $taslak ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Kategori</h5>
                <p class="display-6"><?= $kategori_sayisi ?></p>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-info">
    Bu panel üzerinden blog yazıları ekleyebilir, düzenleyebilir ve silebilirsin.
</div>
<h2 class="mb-4">Son Eklenen Yazılar</h2>
<?php if ($yazilar->num_rows > 0): ?>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php while ($yazi = $yazilar->fetch_assoc()) : ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm position-relative">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title mb-1"><?= htmlspecialchars($yazi["baslik"]) ?></h5>
                            <span class="badge bg-dark"><?= $yazi["kategori"] ?></span>
                            <span class="badge <?= $yazi["durum"] === "yayinda" ? "bg-success" : "bg-secondary" ?>">
                                <?= $yazi["durum"] === "yayinda" ? "Yayında" : "Taslak" ?>
                            </span>
                            <p class="card-text mb-0"><small class="text-muted"><?= $yazi["eklenme_tarihi"] ?></small></p>
                        </div>

                        <div class="d-flex flex-column align-items-end">
                            <a href="edit_post.php?id=<?= $yazi["id"] ?>" class="btn btn-sm btn-outline-primary mb-2">
                                Düzenle
                            </a>
                            <a href="delete_post.php?id=<?= $yazi["id"] ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Bu yazıyı silmek istediğinize emin misiniz?');">
                                Sil
                            </a>
                        </div>
                    </div>
                    <?php if (!empty($yazi["gorsel"])): ?>
                        <img src="<?= $yazi["gorsel"] ?>"
                            class="card-img-bottom"
                            alt="Görsel"
                            style="object-fit: cover; height: 150px;">
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="alert alert-warning">Henüz hiç yazı enlenmemiş.</div>
<?php endif; ?>
<?php include "./includes/footer.php"; ?>