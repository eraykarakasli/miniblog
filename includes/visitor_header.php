<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniBlog</title>
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

    <nav class="navbar navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fs-4 fw-bold" href="index.php">
                📰 MiniBlog
            </a>
        </div>
    </nav>

    <?php
    include "./admin/includes/config.php";
    $kategoriler = $baglanti->query("SELECT * FROM kategoriler");
    ?>
    <div class="bg-light border-bottom py-2 mb-4">
        <div class="container d-flex flex-wrap gap-3">
            <?php while ($kat = $kategoriler->fetch_assoc()): ?>
                <a href="index.php?kategori=<?= urlencode($kat["ad"]) ?>" class="btn btn-outline-secondary btn-sm">
                    <?= htmlspecialchars($kat["ad"]) ?>
                </a>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="container">