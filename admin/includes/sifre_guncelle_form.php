<?php
$sifre_mesaj = "";
$sifre_hata = false;

// Şifre değiştirme formu gönderildiğinde
if (isset($_POST["sifre_degistir_submit"])) {
    $mevcut_sifre = $_POST["mevcut_sifre"];
    $yeni_sifre = $_POST["yeni_sifre"];
    $yeni_sifre_tekrar = $_POST["yeni_sifre_tekrar"];
    $admin_kullanici = $_SESSION["admin"];

    // Admin kullanıcısının mevcut bilgilerini çek
    $stmt = $baglanti->prepare("SELECT sifre FROM users WHERE kullanici = ?");
    if ($stmt === false) {
        $sifre_mesaj = "<div class='alert alert-danger'>Sorgu hazırlanırken bir hata oluştu: " . $baglanti->error . "</div>";
        $sifre_hata = true;
    } else {
        $stmt->bind_param("s", $admin_kullanici);
        if (!$stmt->execute()) {
            $sifre_mesaj = "<div class='alert alert-danger'>Sorgu çalıştırılırken bir hata oluştu: " . $stmt->error . "</div>";
            $sifre_hata = true;
        } else {
            $result = $stmt->get_result();
            $admin_veri = $result->fetch_assoc();
            $stmt->close();

            if ($admin_veri) {
                if (password_verify($mevcut_sifre, $admin_veri["sifre"])) {
                    if ($yeni_sifre === $yeni_sifre_tekrar) {
                        if (!empty(trim($yeni_sifre))) {
                            $yeni_sifre_hash = password_hash($yeni_sifre, PASSWORD_DEFAULT);
                            $stmt_update = $baglanti->prepare("UPDATE users SET sifre = ? WHERE kullanici = ?");
                            if ($stmt_update === false) {
                                $sifre_mesaj = "<div class='alert alert-danger'>Güncelleme sorgusu hazırlanırken bir hata oluştu: " . $baglanti->error . "</div>";
                                $sifre_hata = true;
                            } else {
                                $stmt_update->bind_param("ss", $yeni_sifre_hash, $admin_kullanici);
                                if ($stmt_update->execute()) {
                                    $sifre_mesaj = "<div class='alert alert-success'>Şifre başarıyla değiştirildi.</div>";
                                } else {
                                    $sifre_mesaj = "<div class='alert alert-danger'>Şifre güncellenirken bir hata oluştu: " . $stmt_update->error . "</div>";
                                    $sifre_hata = true;
                                }
                                $stmt_update->close();
                            }
                        } else {
                            $sifre_mesaj = "<div class='alert alert-danger'>Yeni şifre boş olamaz.</div>";
                            $sifre_hata = true;
                        }
                    } else {
                        $sifre_mesaj = "<div class='alert alert-danger'>Yeni şifreler eşleşmiyor.</div>";
                        $sifre_hata = true;
                    }
                } else {
                    $sifre_mesaj = "<div class='alert alert-danger'>Mevcut şifre hatalı.</div>";
                    $sifre_hata = true;
                }
            } else {
                $sifre_mesaj = "<div class='alert alert-danger'>Oturumdaki admin kullanıcısı veritabanında bulunamadı. Lütfen tekrar giriş yapın.</div>";
                $sifre_hata = true;
            }
        }
    }
}
?>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h2 class="card-title mb-4">🔑 Şifre Değiştir</h2>

        <?php if (!empty($sifre_mesaj)) echo $sifre_mesaj; ?>

        <form action="ayarlar.php" method="post">
            <div class="mb-3">
                <label for="mevcut_sifre" class="form-label">Mevcut Şifre</label>
                <input type="password" class="form-control <?= ($sifre_hata && isset($_POST['mevcut_sifre'])) ? 'is-invalid' : '' ?>" id="mevcut_sifre" name="mevcut_sifre" required>
            </div>
            <div class="mb-3">
                <label for="yeni_sifre" class="form-label">Yeni Şifre</label>
                <input type="password" class="form-control <?= ($sifre_hata && (isset($_POST['yeni_sifre']) || isset($_POST['yeni_sifre_tekrar']))) ? 'is-invalid' : '' ?>" id="yeni_sifre" name="yeni_sifre" required>
            </div>
            <div class="mb-3">
                <label for="yeni_sifre_tekrar" class="form-label">Yeni Şifre (Tekrar)</label>
                <input type="password" class="form-control <?= ($sifre_hata && (isset($_POST['yeni_sifre']) || isset($_POST['yeni_sifre_tekrar']))) ? 'is-invalid' : '' ?>" id="yeni_sifre_tekrar" name="yeni_sifre_tekrar" required>
            </div>
            <button type="submit" name="sifre_degistir_submit" class="btn btn-warning w-100">Şifreyi Değiştir</button>
        </form>
    </div>
</div> 