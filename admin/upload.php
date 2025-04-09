<?php
include("includes/config.php");

// Sadece POST isteklerini kabul et
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

// Dosya kontrolü
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    exit('File upload failed');
}

// Dosya tipi kontrolü
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($_FILES['file']['type'], $allowed_types)) {
    http_response_code(400);
    exit('Invalid file type');
}

// Dosya boyutu kontrolü (max 5MB)
if ($_FILES['file']['size'] > 5 * 1024 * 1024) {
    http_response_code(400);
    exit('File too large');
}

// Yükleme dizini
$upload_dir = '../uploads/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Benzersiz dosya adı oluştur
$file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$file_name = uniqid() . '.' . $file_extension;
$file_path = $upload_dir . $file_name;

// Dosyayı yükle
if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
    // Başarılı yanıt
    echo json_encode([
        'location' => 'uploads/' . $file_name
    ]);
} else {
    http_response_code(500);
    exit('Upload failed');
} 