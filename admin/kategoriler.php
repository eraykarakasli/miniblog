<?php

include "./includes/admin_kontrol.php";
include "./includes/config.php";

//kategori ekleme
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["kategori_ad"])) {
    $ad = $baglanti->real_escape_string($_POST["kategori_ad"]);
    $baglanti->query("INSERT INTO kategoriler (ad) VALUES ('$ad')");
    header("Location: kategoriler.php");
    exit;
}

//kategori silme
if (isset($_GET["sil"])) {
    $id = (int) $_GET["sil"];
    $baglanti->query("DELETE FROM kategoriler WHERE id = $id");
    header("Location: kategoriler.php");
    exit;
}

// tüm kategorileri çekme
$kategoriler = $baglanti->query("SELECT * FROM kategoriler ORDER BY ad DESC");
?>

<?php include "./includes/header.php" ?>

<h2 class="mb-4">Kategori Yönetimi</h2>

<form method="post" class="d-flex mb-3" style="gap:10pc">
    <input type="text" name="kategori_ad" class="form-control" placeholder="Yeni kategori adı" required>
    <button class="btn btn-primary">Ekle</button>
</form>

<ul class="list-group">
    <?php while ($kat = $kategoriler->fetch_assoc()) : ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= htmlspecialchars($kat["ad"]) ?>
            <a href="?sil=<?= $kat["id"] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bu kategoriyi silmek istediğine emin misin?')">
                Sil
            </a>
        </li>
    <?php endwhile; ?>
</ul>
<?php include "./includes/footer.php"; ?>