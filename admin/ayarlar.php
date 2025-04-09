<?php
include "includes/header.php";
include "includes/config.php";
include "includes/admin_control.php";

$site_ayar_mesaj = ""; // Mesaj değişkenini tanımla

//formdan gelen veriyi veri tabanına gönderme ve dosya yükleme
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $baslik = $baglanti->real_escape_string($_POST["site_baslik"]);
    $aciklama = $baglanti->real_escape_string($_POST["site_aciklama"]);
    $logo_yolu = $site_ayar["logo"];
    $favicon_yolu = $site_ayar["favicon"];

    //logo yükleme
    if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === 0) {
        $logo_ad = "uploads/" . uniqid("logo") . "." . pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["logo"]["tmp_name"], $logo_ad);
        $logo_yolu = $logo_ad;
    }

    //favicon yükleme
    if (isset($_FILES["favicon"]) && $_FILES["favicon"]["error"] === 0) {
        $favicon_ad = "uploads/" . uniqid("fav_") . "." . pathinfo($_FILES["favicon"]["name"], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["favicon"]["tmp_name"], $favicon_ad);
        $favicon_yolu = $favicon_ad;
    }

    $guncelle = $baglanti->query("UPDATE ayarlar SET site_baslik = '$baslik', site_aciklama = '$aciklama', logo= '$logo_yolu', favicon= '$favicon_yolu' WHERE id='1'");
    
    if ($guncelle) {
        $site_ayar_mesaj = "<div class='alert alert-success'>Ayarlar Başarıyla Güncellendi.</div>";
        // Ayarları güncelle
        $site_ayar["site_baslik"] = $baslik;
        $site_ayar["site_aciklama"] = $aciklama;
        $site_ayar["logo"] = $logo_yolu;
        $site_ayar["favicon"] = $favicon_yolu;
    } else {
        $site_ayar_mesaj = "<div class='alert alert-danger'>Ayarlar güncellenirken bir hata oluştu: " . $baglanti->error . "</div>";
    }
}

// güncel ayarları çek
$ayar = $baglanti->query("SELECT * FROM ayarlar WHERE id=1")->fetch_assoc();

?>

<h2 class="mb-4">⚙️ Site Ayarlar</h2>

<?php if (!empty($site_ayar_mesaj)) echo $site_ayar_mesaj; ?>

<form action="ayarlar.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="site_baslik" class="form-label">Site Başlığı</label>
        <input type="text" class="form-control" id="site_baslik" name="site_baslik" value="<?= htmlspecialchars($ayar["site_baslik"]) ?>">
    </div>
    <div class="mb-3">
        <label for="site_aciklama" class="form-label">Site Açıklaması</label>
        <textarea class="form-control" id="site_aciklama" name="site_aciklama" rows="4"><?= htmlspecialchars($ayar["site_aciklama"]) ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Logo</label>
        <?php if (!empty($site_ayar["logo"])): ?>
            <div>
                <img src="<?= $site_ayar["logo"] ?>" height="50" alt="">
            </div>
        <?php endif; ?>
        <input type="file" name="logo" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Favicon</label>
        <?php if (!empty($site_ayar["favicon"])): ?>
            <div><img src="<?= $site_ayar["favicon"] ?>" height="30"></div>
        <?php endif; ?>
        <input type="file" name="favicon" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Kaydet</button>
</form>

<?php include "includes/footer.php";
