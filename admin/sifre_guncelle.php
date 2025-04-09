<?php
include "includes/header.php"; // Header'ı dahil et
include "includes/config.php"; // Veritabanı bağlantısını dahil et
include "includes/admin_kontrol.php"; // Admin oturum kontrolünü dahil et

$sifre_mesaj = ""; // Şifre değiştirme için mesaj değişkeni
$sifre_hata = false; // Şifre hatası bayrağı

// Şifre değiştirme formu gönderildiğinde
if (isset($_POST["sifre_degistir_submit"])) {
    $mevcut_sifre = $_POST["mevcut_sifre"];
    $yeni_sifre = $_POST["yeni_sifre"];
    $yeni_sifre_tekrar = $_POST["yeni_sifre_tekrar"];
    $admin_kullanici = $_SESSION["admin"]; // Oturumdan admin kullanıcı adını al

    // Admin kullanıcısının mevcut bilgilerini çek (Prepared Statement ile)
    $stmt = $baglanti->prepare("SELECT sifre FROM users WHERE kullanici = ?");
    if ($stmt === false) {
        // Prepare hatası
        $sifre_mesaj = "<div class='alert alert-danger'>Sorgu hazırlanırken bir hata oluştu: " . $baglanti->error . "</div>";
        $sifre_hata = true;
    } else {
        $stmt->bind_param("s", $admin_kullanici);
        if (!$stmt->execute()) {
             // Execute hatası
            $sifre_mesaj = "<div class='alert alert-danger'>Sorgu çalıştırılırken bir hata oluştu: " . $stmt->error . "</div>";
            $sifre_hata = true;
        } else {
            $result = $stmt->get_result();
            $admin_veri = $result->fetch_assoc();
            $stmt->close();

            if ($admin_veri) {
                // 1. Mevcut şifreyi doğrula
                if (password_verify($mevcut_sifre, $admin_veri["sifre"])) {
                    // 2. Yeni şifreler eşleşiyor mu?
                    if ($yeni_sifre === $yeni_sifre_tekrar) {
                         // 3. Yeni şifre boş mu kontrolü (isteğe bağlı ama önerilir)
                        if (!empty(trim($yeni_sifre))) {
                            // 4. Yeni şifreyi hash'le
                            $yeni_sifre_hash = password_hash($yeni_sifre, PASSWORD_DEFAULT);

                            // 5. Veritabanını güncelle (Prepared Statement ile)
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
                // Bu durum normalde olmamalı, çünkü admin_kontrol.php oturumu kontrol ediyor.
                // Ama yine de bir güvenlik katmanı olarak eklenebilir.
                $sifre_mesaj = "<div class='alert alert-danger'>Oturumdaki admin kullanıcısı veritabanında bulunamadı. Lütfen tekrar giriş yapın.</div>";
                $sifre_hata = true;
                // Gerekirse burada oturumu sonlandırabilirsiniz: session_destroy();
            }
        }
    }
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4">🔑 Şifre Değiştir</h2>

                    <?php if (!empty($sifre_mesaj)) echo $sifre_mesaj; ?>

                    <form action="sifre_guncelle.php" method="post">
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
        </div>
    </div>
</div>

<?php include "includes/footer.php"; // Footer'ı dahil et ?>