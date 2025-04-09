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

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h1 class="display-4 fw-bold mb-3"><?= htmlspecialchars($sayfa["baslik"]) ?></h1>
                    </div>
                    
                    <div class="fs-5 lh-lg text-body">
                        <?= nl2br($sayfa["icerik"]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/visitor_footer.php"; ?>