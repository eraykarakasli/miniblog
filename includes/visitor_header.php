<?php
include("./admin/includes/config.php");

//sayfalar
$sayfa_menusu = $baglanti->query("SELECT * FROM sayfalar ORDER BY sira ASC");

//kategoriler
$kategoriler = $baglanti->query("SELECT * FROM kategoriler");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($site_ayar["site_baslik"]) ?></title>
    <link rel="icon" href="admin/<?= $site_ayar["favicon"] ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }
    </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="admin/<?= $site_ayar["logo"] ?>" height="32" alt="Logo">
        <?= htmlspecialchars($site_ayar["site_baslik"]) ?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <?php while ($s = $sayfa_menusu->fetch_assoc()): ?>
            <li class="nav-item">
              <a class="nav-link" href="sayfa.php?slug=<?= htmlspecialchars($s['slug']) ?>">
                <?= htmlspecialchars($s['baslik']) ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="bg-light border-bottom py-2 mb-4">
    <div class="container d-flex flex-wrap gap-2">
      <?php while ($kat = $kategoriler->fetch_assoc()): ?>
        <a href="index.php?kategori=<?= urlencode($kat["ad"]) ?>" class="btn btn-outline-secondary btn-sm">
          <?= htmlspecialchars($kat["ad"]) ?>
        </a>
      <?php endwhile; ?>
    </div>
  </div>

  <div class="container">