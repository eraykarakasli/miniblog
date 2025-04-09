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

        .dropdown-menu {
            min-width: 250px;
            padding: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-item .text-truncate {
            display: inline-block;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dropdown-divider {
            margin: 0.5rem 0;
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
        <?php 
        // Her kategori için son yazıları çek
        $kategoriler->data_seek(0); // Kursoru başa al
        while ($kat = $kategoriler->fetch_assoc()): 
            $son_yazilar = $baglanti->query("SELECT id, baslik, slug FROM posts WHERE kategori = '{$kat["ad"]}' AND durum = 'yayinda' ORDER BY eklenme_tarihi DESC LIMIT 5");
        ?>
            <div class="dropdown">
                <a href="index.php?kategori=<?= urlencode($kat["ad"]) ?>" 
                   class="btn btn-outline-secondary btn-sm dropdown-toggle" 
                   role="button" 
                   data-bs-toggle="dropdown" 
                   aria-expanded="false">
                    <?= htmlspecialchars($kat["ad"]) ?>
                </a>
                <ul class="dropdown-menu shadow-sm border-0 rounded-3">
                    <?php if ($son_yazilar->num_rows > 0): ?>
                        <?php while ($yazi = $son_yazilar->fetch_assoc()): ?>
                            <li>
                                <a class="dropdown-item d-flex justify-content-between align-items-center" 
                                   href="post.php?slug=<?= $yazi["slug"] ?>">
                                    <span class="text-truncate" style="max-width: 200px;">
                                        <?= htmlspecialchars($yazi["baslik"]) ?>
                                    </span>
                                    <small class="text-muted ms-2">Yeni</small>
                                </a>
                            </li>
                        <?php endwhile; ?>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-primary" href="index.php?kategori=<?= urlencode($kat["ad"]) ?>">
                                <i class="fas fa-list me-2"></i>Tüm Yazıları Gör
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <span class="dropdown-item text-muted">
                                <i class="fas fa-info-circle me-2"></i>Henüz yazı yok
                            </span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endwhile; ?>
    </div>
  </div>

  <div class="container">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tüm dropdown menüleri seç
    const dropdowns = document.querySelectorAll('.dropdown');
    
    // Her dropdown için hover olaylarını ekle
    dropdowns.forEach(dropdown => {
        // Mouse üzerine geldiğinde
        dropdown.addEventListener('mouseenter', function() {
            const dropdownMenu = this.querySelector('.dropdown-menu');
            dropdownMenu.classList.add('show');
        });
        
        // Mouse ayrıldığında
        dropdown.addEventListener('mouseleave', function() {
            const dropdownMenu = this.querySelector('.dropdown-menu');
            dropdownMenu.classList.remove('show');
        });
    });
});
</script>

</body>
</html>