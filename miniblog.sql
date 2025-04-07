-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 Nis 2025, 19:45:59
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `miniblog`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `isim` varchar(100) NOT NULL,
  `yorum` text NOT NULL,
  `tarih` datetime DEFAULT current_timestamp(),
  `onay` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `isim`, `yorum`, `tarih`, `onay`) VALUES
(3, 6, 'Eray', 'çok beğendim', '2025-04-07 19:31:23', 1),
(7, 4, 'Mahmut', 'test ', '2025-04-07 20:00:10', 1),
(12, 4, 'Merve', 'merve test', '2025-04-07 20:03:04', 1),
(13, 4, 'Ece', 'ece123', '2025-04-07 20:03:59', 1),
(15, 4, 'testtt', 'testtt', '2025-04-07 20:08:44', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `ad`) VALUES
(1, 'Günlük'),
(3, 'İpucu'),
(2, 'Teknoloji'),
(5, 'Temizlik'),
(6, 'Yaşam');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `icerik` text NOT NULL,
  `eklenme_tarihi` datetime NOT NULL DEFAULT current_timestamp(),
  `gorsel` varchar(255) DEFAULT NULL,
  `durum` enum('taslak','yayinda') DEFAULT 'taslak',
  `goruntulenme` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`id`, `baslik`, `kategori`, `icerik`, `eklenme_tarihi`, `gorsel`, `durum`, `goruntulenme`) VALUES
(1, 'Teknolojinin Genel Yaşama Olan Zararlı Etkileri test', 'Günlük', 'Günümüzde teknoloji hayatımızın ayrılmaz bir parçası haline gelmiş olsa da, aşırı ve bilinçsiz kullanımı bireyler ve toplum üzerinde olumsuz etkiler yaratmaktadır. Özellikle akıllı cihazlara bağımlılık, insan ilişkilerinin zayıflamasına ve yalnızlık duygusunun artmasına yol açmaktadır. Ayrıca, ekran başında uzun süre vakit geçirmek hem fiziksel sağlığı (göz bozuklukları, duruş bozuklukları) hem de zihinsel sağlığı (stres, dikkat dağınıklığı) olumsuz etkileyebilir. Teknolojinin hızlı gelişimi aynı zamanda işsizlik, gizlilik ihlalleri ve çevresel kirlilik gibi sorunları da beraberinde getirmektedir.', '2025-04-06 17:09:36', 'uploads/img_67f3c4c83c1d7.jpg', 'yayinda', 0),
(2, '🟢 Hayatın Küçük Anları', 'Günlük', 'Günlük yaşam, birçok farklı olay ve deneyimle şekillenir. İnsanlar kimi zaman sıradan günlerin değerini fark edemez, ancak basit bir yürüyüş ya da bir dost sohbeti bile hayatımıza anlam katabilir. Bu yüzden küçük anların kıymetini bilmek önemlidir.', '2025-04-06 22:28:11', '', 'yayinda', 0),
(3, '🔵 Teknolojinin Hayatımıza Etkisi', 'Teknoloji', 'Teknolojinin hızla gelişmesi, hayatımızı her geçen gün daha da kolaylaştırıyor. Akıllı cihazlar, yapay zeka ve internet sayesinde bilgiye ulaşmak saniyeler sürüyor. Ancak bu kolaylıklar, dikkatli kullanılmadığında bağımlılığa ve sosyal kopukluğa yol açabiliyor.', '2025-04-06 22:28:25', NULL, 'taslak', 0),
(4, '🟡 Bir Günümden Kesitler', 'Günlük', 'Bugün yine sıradan bir gündü. Sabah kalktım, kahvemi içip derslerime odaklandım. Havanın kapalı olması biraz moralimi düşürse de müzik dinlemek bana iyi geldi. Kendime küçük hedefler koyarak günü verimli geçirmeye çalıştım.', '2025-04-06 22:28:37', 'uploads/img_67f3c42130ec4.jpg', 'yayinda', 22),
(5, '🟣 Verimli Ders Çalışma Yöntemi', 'İpucu', 'Ders çalışırken daha verimli olmak istiyorsan, 25 dakikalık odaklanma + 5 dakikalık mola tekniğini deneyebilirsin. Bu yöntem hem dikkati yüksek tutar hem de zihni yormadan uzun süreli çalışma sağlar. Ayrıca telefonu sessize almak da odak için çok işe yarar.', '2025-04-06 22:28:51', 'uploads/img_67f3c1ba5a4a5.webp', 'yayinda', 1),
(6, '📸 Fotoğraf Nasıl Çekilmez?', 'Günlük', 'Fotoğraf çekerken en sık yapılan hatalardan biri, ışık kaynağını doğrudan arka plana almak ve konunun karanlık çıkmasına neden olmaktır. Ayrıca, kadrajı gelişi güzel ayarlamak, konunun yarısını kesmek ya da yersiz zum yapmak da fotoğrafın kalitesini bozar. Titrek ellerle netleme yapmadan çekilen fotoğraflar, hem bulanık hem de anlamsız bir görüntüye yol açar. Bu nedenle fotoğraf çekerken dikkat edilmesi gereken temel kuralları bilmemek, ortaya kötü sonuçlar çıkarır.', '2025-04-07 14:52:30', 'uploads/img_67f3bfe857f2c.jpeg', 'yayinda', 22),
(7, 'ay', 'Günlük', 'sdfsdfdsafasf', '2025-04-07 15:05:49', 'uploads/img_67f3bf9db95a6.jpeg', 'yayinda', 10),
(10, 'test', 'Temizlik', 'tetewtwtwetwetewtet', '2025-04-07 17:38:29', '', 'yayinda', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `kullanici` varchar(50) NOT NULL,
  `sifre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `kullanici`, `sifre`) VALUES
(1, 'admin', '$2y$10$od.AQMqIVnbG6nJL7P6MeOvfhOtv2HbtwgUkZTE.9B1ptZvLEFMwW');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ad` (`ad`);

--
-- Tablo için indeksler `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici` (`kullanici`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
