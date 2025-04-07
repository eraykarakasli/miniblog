<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniBlog Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="">
    <nav class=" navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">📝 MiniBlog</a>

        <div class="d-flex align-items-center">
            <a href="dashboard.php" class="btn btn-outline-light me-3">Dashboard</a>

            <!-- dropdown menu -->
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="adminMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    Seçenekler
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminMenu">
                    <li><a class="dropdown-item" href="kategoriler.php">📁 Kategoriler</a></li>
                    <li><a class="dropdown-item" href="new_post.php">➕ Yeni Yazı</a></li>
                    <li><a class="dropdown-item" href="yorumlar.php">💬 Yorumlar</a></li>
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