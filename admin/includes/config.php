<?php

$baglanti = new mysqli("localhost", "root", "", "miniblog");

if ($baglanti->connect_error) {
    die("Veritabanına bağlanamadı: " . $baglanti->connect_error);
}
?>