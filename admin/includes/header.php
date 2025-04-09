<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($site_ayar["site_aciklama"]) ?>">
    <title><?= htmlspecialchars($site_ayar["site_baslik"]) ?>-Dashboard</title>
    <link rel="icon" href="<?= $site_ayar["favicon"] ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .ck-editor__editable {
            min-height: 300px;
        }
  
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="">
    <nav class=" navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="dashboard.php">📝 MiniBlog</a> -->
            <a class="navbar-brand" href="dashboard.php"> <img src="<?= $site_ayar["logo"] ?>" height="32" alt="Logo"> <?= htmlspecialchars($site_ayar["site_baslik"]) ?></a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-outline-light me-3">Dashboard</a>

                <!-- dropdown menu -->
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="adminMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        Seçenekler
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminMenu">
                        <li><a class="dropdown-item" href="kategoriler.php">Kategoriler</a></li>
                        <li><a class="dropdown-item" href="new_post.php">Yeni Yazı</a></li>
                        <li><a class="dropdown-item" href="sayfalar.php">Sayfalar</a></li>
                        <li><a class="dropdown-item" href="yorumlar.php">Yorumlar</a></li>
                        <li><a class="dropdown-item" href="sifre_guncelle.php">Şifre Değiştir</a></li>
                        <li><a class="dropdown-item" href="ayarlar.php">Blog Ayarları</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="logout.php">🚪 Çıkış Yap</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4" style="min-height: 70vh;>