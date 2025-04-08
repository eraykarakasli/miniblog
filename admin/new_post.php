<?php
include "./includes/header.php";
include "./includes/config.php";
include "./includes/admin_kontrol.php";

$gorsel_yolu = null;
//kategorileri çekme
$kategori_sonuc = $baglanti->query("SELECT * FROM kategoriler ORDER BY ad ASC");

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $durum = $baglanti->real_escape_string($_POST["durum"]);
    $baslik = $baglanti->real_escape_string($_POST["baslik"]);
    $kategori = $baglanti->real_escape_string($_POST["kategori"]);
    $icerik = $baglanti->real_escape_string($_POST["icerik"]);
    function slugYap($metin)
    {
        $metin = strtolower(trim($metin));
        $metin = preg_replace('/[^a-z0-9ğüşıöç\s-]/u', '', $metin);
        $metin = preg_replace('/[\s-]+/', '-', $metin);
        return $metin;
    } 

    $slug = slugYap($baslik);

    $sorgu = "INSERT INTO posts (baslik, kategori, icerik, gorsel, slug, durum) 
VALUES ('$baslik', '$kategori', '$icerik', '$gorsel_yolu', '$slug', '$durum')";

    if ($baglanti->query($sorgu)) {
        $mesaj = "✅ Yazı başarıyla eklendi!";
    } else {
        $mesaj = "❌ Hata: " . $baglanti->error;
    }
}
?>

<h2 class="mb4">📝 Yeni Yazı Ekle</h2>
<?php if (isset($mesaj)): ?>
    <div class="alert alert-info"><?= $mesaj ?></div>
<?php endif ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="" class="form-label">Başlık Görseli (opsiyonel)</label>
        <input type="file" name="gorsel" accept=".jpg, .jpeg, .png, .webp" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label" for="">Başlık</label>
        <input type="text" name="baslik" class="form-control" placeholder="Yazı başlığını giriniz" required>
    </div>

    <div class="mb-3">
        <label class="form-label" for="">Kategori</label>
        <select name="kategori" class="form-select" required>
            <option value="">Kategori Seçiniz</option>
            <?php while ($k = $kategori_sonuc->fetch_assoc()): ?>
                <option value="<?= htmlspecialchars($k["ad"]) ?>"><?= htmlspecialchars($k["ad"]) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">İçerik</label>
        <textarea name="icerik" rows="6" class="form-control" placeholder="Yazınız..." required id=""></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Yayın Durumu</label>
        <select name="durum" class="form-select" required>
            <option value="taslak">Taslak</option>
            <option value="yayinda">Yayında</option>
        </select>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-success">Yayınla</button>
    </div>
</form>

<?php include "./includes/footer.php"; ?>