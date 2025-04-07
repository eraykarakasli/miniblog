<?php
$baglanti = new mysqli("localhost","root","","miniblog");

if($baglanti ->connect_error) {
    die("Bağlantı hatası". $baglanti ->connect_error);
}

$kullanici = "admin";
$sifre = password_hash("123456", PASSWORD_DEFAULT);

$baglanti->query("INSERT INTO users (kullanici, sifre) VALUES ('$kullanici', '$sifre')");

echo "Admin kullanıcısı başarıyla eklendi.";
?>