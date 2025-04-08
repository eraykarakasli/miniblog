<?php
include "includes/header.php";
include "includes/config.php";
include "includes/admin_kontrol.php";

//id kontrol
if (!isset($_GET["id"])) {
    echo "<div class='alert alert-danger'>Geçersiz istek!</div>";
    include "includes/footer.php";
    exit;
}

$id = (int) $_GET["id"];
$sayfa = $baglanti->query("SELECT * FROM sayfalar WHERE id= '$id'")->fetch_assoc();

if (!$sayfa) {
    echo "<div class='alert alert-warning'>Sayfa bulunamadı.</div>";
    include "includes/footer.php";
    exit;
}

//sayfa guncelleme
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $baslik = $baglanti->real_escape_string($_POST["baslik"]);
    $slug = $baglanti->real_escape_string($_POST["slug"]);
    $icerik = $baglanti->real_escape_string($_POST["icerik"]);
    $sira = $baglanti->real_escape_string($_POST["sira"]);
    $guncelle = $baglanti->query("UPDATE sayfalar SET baslik= '$baslik', slug= '$slug', icerik = '$icerik', sira='$sira' WHERE id =$id");

    if ($guncelle) {
        echo "<div class='alert alert-success'>Sayfa başarıyla güncellendi.</div>";
        //güncel sayfayı çek
        $sayfa = $baglanti->query("SELECT * FROM sayfalar WHERE id = $id")->fetch_assoc();
    } else {
        $sayfa = $baglanti->query("SELECT * FROM sayfalar WHERE id = $id")->fetch_assoc();
    }
    header("Location: sayfalar.php");
    exit;
}
?>

<h2 class="mb-4">✏️ Sayfa Düzenle</h2>

<form action="" method="post">
    <div class="mb-3">
        <label class="form-label">Sayfa Başlığı</label>
        <input type="text" name="baslik" value="<?= htmlspecialchars($sayfa["baslik"]) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Slug (URL)</label>
        <input type="text" name="slug" value="<?= htmlspecialchars($sayfa["slug"]) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">İçerik</label>
        <textarea name="icerik" rows="6" class="form-control" required><?= htmlspecialchars($sayfa["icerik"]) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="sira" class="form-label">Görünüm Sırası</label>
        <input type="number" name="sira" class="form-control" value="<?= htmlspecialchars($sayfa["sira"])?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Güncelle</button>
</form>

<?php include "includes/footer.php"; ?>