<?php
include "./includes/config.php";
include "./includes/header.php";
include "./includes/admin_kontrol.php";

// id kontrolü 
if (!isset($_GET["id"])) {
    echo "<div class='alert alert-danger'>Geçersiz istek!</div>";
    include "./includes/footer.php";
    exit;
}

$kategori_sonuc = $baglanti->query("SELECT * FROM kategoriler ORDER BY ad ASC");
$id = (int) $_GET["id"];
$yazi = $baglanti->query("SELECT * FROM posts WHERE id = $id")->fetch_assoc();

if (!$yazi) {
    echo "<div class='alert alert-warning'>Yazı bulunamadı.</div>";
    include "./includes/footer.php";
    exit;
}
//slug oluşturucu
function slugOlustur($metin)
{
    $metin = mb_strtolower($metin, "UTF-8");
    $metin = preg_replace('/[^a-z0-9çğıöşü\s-]/u', '', $metin);
    $metin = preg_replace('/[\s-]+/', '-', $metin);
    return trim($metin, '-');
}

// güncelleme işlemi
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $durum = $baglanti->real_escape_string($_POST["durum"]);
    $baslik = $baglanti->real_escape_string($_POST["baslik"]);
    $kategori = $baglanti->real_escape_string($_POST["kategori"]);
    $icerik = $baglanti->real_escape_string($_POST["icerik"]);
    $slider = isset($_POST["slider"]) ? 1 : 0;
    $slug = slugOlustur($baslik);

    // önceki görseli sakla
    $gorsel_yolu = $yazi["gorsel"]; // eğer yeni yüklenmezse eskiyi koru
    if (isset($_FILES["gorsel"]) && $_FILES["gorsel"]["error"] === UPLOAD_ERR_OK) {
        $dosya_adi = $_FILES["gorsel"]["name"];
        $gecici = $_FILES["gorsel"]["tmp_name"];
        $uzanti = strtolower(pathinfo($dosya_adi, PATHINFO_EXTENSION));
        $izinli = ["jpg", "jpeg", "png", "webp"];

        if (in_array($uzanti, $izinli)) {
            $yeni_ad = uniqid("img_") . "." . $uzanti;
            $hedef_yol = "uploads/" . $yeni_ad;

            if (move_uploaded_file($gecici, $hedef_yol)) {
                $gorsel_yolu = $hedef_yol;
            }
        }
    }


    $guncelle = $baglanti->query("UPDATE posts SET 
    baslik = '$baslik', 
    kategori = '$kategori', 
    icerik = '$icerik', 
    gorsel = '$gorsel_yolu', 
    durum = '$durum', 
    slider = '$slider' ,
    slug= '$slug'
    WHERE id = '$id'");

    if ($guncelle) {
        echo "<div class='alert alert-success'>Yazı başarıyla güncellendi.</div>";
        if ($gorsel_yolu !== $yazi["gorsel"] && file_exists($yazi["gorsel"])) {
            unlink($yazi["gorsel"]); // eski görseli sil
        }
        //güncellenmiş içerik
        $yazi = $baglanti->query("SELECT * FROM posts WHERE id = '$id'")->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Hata oluştu " . $baglanti->error . " </div>";
    }

    header("Location: dashboard.php");
    exit;
}



?>

<h2 class="mb-4">✏️ Yazıyı Düzenle</h2>

<form action="" method="post" enctype="multipart/form-data">
    <?php if (!empty($yazi["gorsel"])): ?>
        <div class="mb-3">
            <label class="form-label">Mevcut Görsel</label><br>
            <img src="<?= $yazi["gorsel"] ?>" alt="Görsel" class="img-thumbnail" style="max-height: 120px;">
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Yeni Görsel :</label>
        <input type="file" name="gorsel" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Başlık</label>
        <input type="text" name="baslik" value="<?= htmlspecialchars($yazi["baslik"]) ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori" class="form-select" required>
            <?php while ($k = $kategori_sonuc->fetch_assoc()): ?>
                <option value="<?= $k["ad"] ?>" <?= $yazi["kategori"] == $k["ad"] ? "selected" : "" ?>>
                    <?= htmlspecialchars($k["ad"]) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">İçerik</label>
        <textarea name="icerik" rows="6" class="form-control" required><?= htmlspecialchars($yazi["icerik"]) ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Yayın Durumu</label>
        <select name="durum" class="form-select" required>
            <option value="taslak" <?= $yazi["durum"] === "taslak" ? "selected" : "" ?>>Taslak</option>
            <option value="yayinda" <?= $yazi["durum"] === "yayinda" ? "selected" : "" ?>>Yayında</option>
        </select>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="slider" id="slider" <?= $yazi["slider"] ? "checked" : "" ?>>
        <label class="form-check-label" for="slider">
            Anasayfada slider’da göster
        </label>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">💾 Güncelle</button>
    </div>
</form>

<?php include "./includes/footer.php"; ?>

</form>