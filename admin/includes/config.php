<?php

$baglanti = new mysqli("localhost", "root", "", "miniblog");

if ($baglanti->connect_error) {
    die("Veritabanına bağlanamadı: " . $baglanti->connect_error);
}



$site_ayar = $baglanti->query("SELECT * FROM ayarlar WHERE id = 1")->fetch_assoc();

$slider_yazilar = $baglanti->query("SELECT * FROM posts WHERE slider = 1 AND durum = 'yayinda' ORDER BY eklenme_tarihi DESC LIMIT 5");

?>