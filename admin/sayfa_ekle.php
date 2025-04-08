<?php
include "includes/header.php";
include "includes/config.php";
include "includes/admin_kontrol.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $baslik = $baglanti->real_escape_string($_POST["baslik"]);
    $slug  = $baglanti->real_escape_string($_POST["slug"]);
    $icerik  = $baglanti->real_escape_string($_POST["icerik"]);
    $sira = (int) $_POST["sira"];
    $sorgu = "INSERT INTO sayfalar (baslik, slug, icerik, sira) VALUES ('$baslik', '$slug', '$icerik', $sira)";
    if ($baglanti->query($sorgu)) {
        echo "<div class='aler alert-success'>✅ Sayfa başarıyla eklendi.</div>";
    } else {
        echo "<div class='alert alert-danger'>❌ Hata: " . $baglanti->error . "</div>";
    }
    header("Location: sayfalar.php");
    exit;
}
?>

<h2 class="mb-4">➕ Yeni Sayfa Ekle</h2>

<form action="" method="post">
    <div class="mb-3">
        <label for="" class="form-label">Sayfa Başlığı</label>
        <input type="text" name="baslik" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Slug (URL)</label>
        <input type="text" name="slug" class="form-control" placeholder="örnek: hakkımızda" required>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">İçerik</label>
        <textarea rows="6" name="icerik" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="sira" class="form-label">Görünüm Sırası</label>
        <input type="number" name="sira" class="form-control" value="0" required>
    </div>
    <button type="submit" class="btn btn-primary">Kaydet</button>
</form>
<?php include "includes/footer.php"; ?>