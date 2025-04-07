# 📝 MiniBlog

MiniBlog, PHP ve MySQL ile geliştirilmiş basit bir blog sistemidir. Admin paneli üzerinden yazı, kategori ve yorum yönetimi yapılabilir. Ziyaretçiler ise blog yazılarını okuyabilir ve yorum yapabilirler.

---

## 🚀 Özellikler

- Admin girişi ve güvenli panel
- Yazı ekleme, düzenleme, silme
- Görsel yükleme desteği
- Dinamik kategori yönetimi
- Yorum sistemi (onaylı)
- Görüntülenme sayacı
- Responsive tasarım (Bootstrap 5)
- Ziyaretçi ve admin arayüzleri

---

## ⚙️ Kurulum


### 1. Projeyi İndir

```bash
git clone https://github.com/eraykarakasli/miniblog.git


### 2. Veritabanını Kur

1. XAMPP/WAMP başlatın ve phpMyAdmine girin.
2. Yeni bir veritabanı oluşturun: miniblog
3. Bu repodaki database.sql dosyasını içe aktarın (Import sekmesinden).


### 3. Veritabanı Bağlantısı Ayarı

admin/includes/config.php dosyasını açın ve aşağıdaki bilgilerin doğru olduğuna emin olun:
$baglanti = new mysqli("localhost", "root", "", "miniblog");


### 4. Admin Girişi

Kullanıcı adı: admin
Şifre: 123456 (veya kendi belirlediğiniz şifre bkz:"admin/admin_ekle.php")

Admin paneli için şu adresi kullan:
http://localhost/miniblog/admin/login.php


### 📁 Proje Yapısı

miniblog/
│
├── admin/
│   ├── dashboard.php
│   ├── new_post.php
│   ├── edit_post.php
│   ├── kategoriler.php
│   ├── delete_post.php
│   ├── admin_ekle.php
│   ├── login.php
│   ├── logout.php
│   ├── yorumlar.php
│   │
│   └── includes/
│       ├── config.php
│       ├── header.php
│       ├── footer.php
│       └── admin_kontrol.php
│
├── includes/
│       ├── visitor_footer.php
│       └── visitor_header.php
│
├── uploads/           → Görsellerin yüklendiği klasör
├── index.php          → Ziyaretçi ana sayfası
├── post.php           → Yazı detay sayfası
├── README.md          → Bu dosya
└── database.sql       → Veritabanı yedeği


