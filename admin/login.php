<?php
session_start();
include "./includes/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $kullanici = $_POST["kullanici"];
    $sifre = $_POST["sifre"];

    //kullanıcı verisi çek
    $veri  = $baglanti->query("SELECT * FROM users WHERE kullanici = '$kullanici'")->fetch_assoc();

    // kullanıcı ve şifre doğrulama
    if ($veri && password_verify($sifre, $veri["sifre"])) {
        $_SESSION["admin"] = $veri["kullanici"];
        header("Location: dashboard.php");
        exit;
    } else {
        $hata = "Hatalı kullanıcı adı veya şifre!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 shadow" style="min-width: 300px;">
        <h3 class="mb-3 text-center">🔐 Admin Giriş</h3>

        <?php if (isset($hata)): ?>
            <div class="alert alert-danger"><?= $hata ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <input type="text" name="kullanici" class="form-control" placeholder="Kullanıcı Adı" required>
            </div>
            <div class="mb-3">
                <input type="password" name="sifre" class="form-control" placeholder="Şifre" required>
            </div>
            <button class="btn btn-primary w-100">Giriş Yap</button>
        </form>
    </div>
</body>

</html>