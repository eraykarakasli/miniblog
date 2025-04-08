<?php
include "admin/includes/config.php";
include "includes/visitor_header.php";

//slug kontrol
if (!isset($_GET["slug"])) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Sayfa bulunamadı.</div></div>";
    include "includes/visitor_footer.php";
    exit;
}

$slug = $baglanti->real_escape_string($_GET["slug"]);
$sayfa = $baglanti->query("SELECT * FROM sayfalar WHERE slug = '$slug' ORDER BY sira ASC")->fetch_assoc();

if (!$sayfa) {
    header("Location: 404.php");
    exit;
}
?>

<div class="container my-5">
    <h1 class="mb-4"><?= htmlspecialchars($sayfa["baslik"]) ?></h1>
    <!-- //nl2br metinde de alt satıra geçen kısmların bozulmaması için -->
    <div class="fs-5 lh-lg">
        <?= nl2br($sayfa["icerik"]) ?>
    </div>
</div>

<?php include "includes/visitor_footer.php"; ?>