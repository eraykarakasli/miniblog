<?php 
include "./includes/config.php";
include "./includes/admin_kontrol.php";
//id kontrolü
if(!isset($_GET["id"])){
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET["id"];

//yazının varlığını kontrol etme
$yazi = $baglanti->query("SELECT * FROM posts WHERE id = '$id'")->fetch_assoc();

if(!$yazi){
    header("Location: dashboard.php");
    exit;
}

//görsel varsa sunucudan sil
if (!empty($yazi["gorsel"]) && file_exists($yazi["gorsel"])) {
    unlink($yazi["gorsel"]);
}

//veritabanından sil
$baglanti->query("DELETE FROM posts WHERE id = '$id'");

//sayfaya geri yönlendirme
header("Location: dashboard.php");
exit
?>