<?php
include "./includes/header.php";
include "./includes/config.php";
include "./includes/admin_kontrol.php";

// Veritabanı bağlantısını kontrol et
if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

$gorsel_yolu = null;
//kategorileri çekme
$kategori_sonuc = $baglanti->query("SELECT * FROM kategoriler ORDER BY ad ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $durum = $baglanti->real_escape_string($_POST["durum"]);
    $baslik = $baglanti->real_escape_string($_POST["baslik"]);
    $kategori = $baglanti->real_escape_string($_POST["kategori"]);
    $icerik = $baglanti->real_escape_string($_POST["icerik"]);

    // Görsel yükleme işlemi
    if (isset($_FILES["gorsel"]) && $_FILES["gorsel"]["error"] === UPLOAD_ERR_OK) {
        $dosya_adi = $_FILES["gorsel"]["name"];
        $gecici = $_FILES["gorsel"]["tmp_name"];
        $uzanti = strtolower(pathinfo($dosya_adi, PATHINFO_EXTENSION));

        $izinli = ["jpg", "jpeg", "png", "webp"];
        if (in_array($uzanti, $izinli)) {
            $yeni_ad = uniqid("img_") . "." . $uzanti;
            $hedef_yol = "uploads/" . $yeni_ad;

            if (move_uploaded_file($gecici, $hedef_yol)) {
                $gorsel_yolu = $hedef_yol;
            }
        }
    }

    function slugYap($metin) {
        $metin = strtolower(trim($metin));
        $metin = preg_replace('/[^a-z0-9ğüşıöç\s-]/u', '', $metin);
        $metin = preg_replace('/[\s-]+/', '-', $metin);
        return $metin;
    }

    $slug = slugYap($baslik);
    $tarih = date('Y-m-d H:i:s');

    $sorgu = "INSERT INTO posts (baslik, kategori, icerik, gorsel, slug, durum, eklenme_tarihi) 
              VALUES ('$baslik', '$kategori', '$icerik', '$gorsel_yolu', '$slug', '$durum', '$tarih')";

    if ($baglanti->query($sorgu)) {
        $_SESSION['mesaj'] = "✅ Yazı başarıyla eklendi!";
        header("Location: posts.php");
        exit();
    } else {
        $mesaj = "❌ Hata: " . $baglanti->error;
    }
}
?>

<!-- CKEditor CSS -->
<link rel="stylesheet" href="https://cdn.ckeditor.com/4.25.1-lts/standard/contents.css">

<div class="container mt-4">
    <h2 class="mb-4">📝 Yeni Yazı Ekle</h2>
    <?php if (isset($mesaj)): ?>
        <div class="alert alert-danger"><?= $mesaj ?></div>
    <?php endif ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="" class="form-label">Başlık Görseli (opsiyonel)</label>
            <input type="file" name="gorsel" accept=".jpg, .jpeg, .png, .webp" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Başlık</label>
            <input type="text" name="baslik" class="form-control" placeholder="Yazı başlığını giriniz" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="">Kategori</label>
            <select name="kategori" class="form-select" required>
                <option value="">Kategori Seçiniz</option>
                <?php while ($k = $kategori_sonuc->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($k["ad"]) ?>"><?= htmlspecialchars($k["ad"]) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">İçerik</label>
            <textarea name="icerik" id="editor" class="form-control" placeholder="Yazınız..." required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Yayın Durumu</label>
            <select name="durum" class="form-select" required>
                <option value="taslak">Taslak</option>
                <option value="yayinda">Yayında</option>
            </select>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Yayınla</button>
        </div>
    </form>
</div>

<!-- CKEditor JS -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        height: 400,
        removeButtons: 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Subscript,Superscript,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,JustifyBlock,BidiLtr,BidiRtl,Language,Anchor,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Maximize,ShowBlocks,About',
        removePlugins: 'elementspath,resize',
        toolbarGroups: [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
            { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
            { name: 'forms', groups: [ 'forms' ] },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
            { name: 'links', groups: [ 'links' ] },
            { name: 'insert', groups: [ 'insert' ] },
            '/',
            { name: 'styles', groups: [ 'styles' ] },
            { name: 'colors', groups: [ 'colors' ] },
            { name: 'tools', groups: [ 'tools' ] },
            { name: 'others', groups: [ 'others' ] }
        ]
    });
</script>

<?php include "includes/footer.php"; ?>