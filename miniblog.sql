-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 09 Nis 2025, 15:11:59
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
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_baslik` varchar(255) DEFAULT NULL,
  `site_aciklama` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_baslik`, `site_aciklama`, `logo`, `favicon`) VALUES
(1, 'MiniBlog', 'Basit ve sade bir blog platformu', 'uploads/logo67f51f6050d47.png', 'uploads/fav_67f65cfb41a87.png');

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
(15, 4, 'testtt', 'testtt', '2025-04-07 20:08:44', 1),
(19, 0, 'test', 'test', '2025-04-08 20:34:21', 1),
(20, 0, 'test', 'test', '2025-04-08 20:35:24', 1),
(24, 11, 'Eray', 'Mükemmel bir yazı.', '2025-04-08 20:52:04', 1),
(25, 12, 'deneme', 'werwerwer', '2025-04-08 20:58:19', 1),
(29, 14, 'Eray', 'Gerçekten başarılı bir yazı olmuş.', '2025-04-09 15:31:38', 1),
(30, 14, 'Eray', 'Gerçekten başarılı bir yazı olmuş...', '2025-04-09 15:31:46', 1);

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
(7, 'Gezi'),
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
  `goruntulenme` int(11) NOT NULL DEFAULT 0,
  `slider` tinyint(1) DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`id`, `baslik`, `kategori`, `icerik`, `eklenme_tarihi`, `gorsel`, `durum`, `goruntulenme`, `slider`, `slug`) VALUES
(1, 'Teknolojinin Genel Yaşama Olan Zararlı Etkileri test', 'Günlük', 'Günümüzde teknoloji hayatımızın ayrılmaz bir parçası haline gelmiş olsa da, aşırı ve bilinçsiz kullanımı bireyler ve toplum üzerinde olumsuz etkiler yaratmaktadır. Özellikle akıllı cihazlara bağımlılık, insan ilişkilerinin zayıflamasına ve yalnızlık duygusunun artmasına yol açmaktadır. Ayrıca, ekran başında uzun süre vakit geçirmek hem fiziksel sağlığı (göz bozuklukları, duruş bozuklukları) hem de zihinsel sağlığı (stres, dikkat dağınıklığı) olumsuz etkileyebilir. Teknolojinin hızlı gelişimi aynı zamanda işsizlik, gizlilik ihlalleri ve çevresel kirlilik gibi sorunları da beraberinde getirmektedir.', '2025-04-06 17:09:36', 'uploads/img_67f3c4c83c1d7.jpg', 'yayinda', 4, 0, 'teknolojinin-genel-yaşama-olan-zararlı-etkileri-test'),
(2, '🟢 Hayatın Küçük Anları', 'Günlük', 'Günlük yaşam, birçok farklı olay ve deneyimle şekillenir. İnsanlar kimi zaman sıradan günlerin değerini fark edemez, ancak basit bir yürüyüş ya da bir dost sohbeti bile hayatımıza anlam katabilir. Bu yüzden küçük anların kıymetini bilmek önemlidir.', '2025-04-06 22:28:11', '', 'yayinda', 1, 0, 'hayatın-küçük-anları'),
(4, '🟡 Bir Günümden Kesitler', 'Günlük', 'Bugün yine sıradan bir gündü. Sabah kalktım, kahvemi içip derslerime odaklandım. Havanın kapalı olması biraz moralimi düşürse de müzik dinlemek bana iyi geldi. Kendime küçük hedefler koyarak günü verimli geçirmeye çalıştım.', '2025-04-06 22:28:37', 'uploads/img_67f3c42130ec4.jpg', 'yayinda', 28, 1, 'bir-günümden-kesitler'),
(5, '🟣 Verimli Ders Çalışma Yöntemi', 'İpucu', 'Ders çalışırken daha verimli olmak istiyorsan, 25 dakikalık odaklanma + 5 dakikalık mola tekniğini deneyebilirsin. Bu yöntem hem dikkati yüksek tutar hem de zihni yormadan uzun süreli çalışma sağlar. Ayrıca telefonu sessize almak da odak için çok işe yarar.', '2025-04-06 22:28:51', 'uploads/img_67f3c1ba5a4a5.webp', 'yayinda', 7, 1, 'verimli-ders-çalışma-yöntemi'),
(6, '📸 Fotoğraf Nasıl Çekilmez?', 'Günlük', 'Fotoğraf çekerken en sık yapılan hatalardan biri, ışık kaynağını doğrudan arka plana almak ve konunun karanlık çıkmasına neden olmaktır. Ayrıca, kadrajı gelişi güzel ayarlamak, konunun yarısını kesmek ya da yersiz zum yapmak da fotoğrafın kalitesini bozar. Titrek ellerle netleme yapmadan çekilen fotoğraflar, hem bulanık hem de anlamsız bir görüntüye yol açar. Bu nedenle fotoğraf çekerken dikkat edilmesi gereken temel kuralları bilmemek, ortaya kötü sonuçlar çıkarır.', '2025-04-07 14:52:30', 'uploads/img_67f3bfe857f2c.jpeg', 'yayinda', 55, 1, 'fotoğraf-nasıl-çekilmez'),
(11, 'What is Lorem Ipsum?', 'Yaşam', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\r\n\r\nWhere can I get some?\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2025-04-08 20:19:58', 'uploads/img_67f55abe05894.png', 'yayinda', 34, 1, 'what-is-lorem-ipsum'),
(12, 'blogg', 'İpucu', 'bloggggggggg', '2025-04-08 20:45:37', 'uploads/img_67f560c1a1a90.png', 'yayinda', 21, 0, 'blog3'),
(14, 'Blog Yazısı Örnekleri', 'İpucu', 'Aradığımız soruların cevapları ve ilgi çekici bilgilerin kaynağı olarak günümüzde blog yazısı örnekleri büyük bir ilgi çekiyor. Özellikle kullanıcıların artık sorularının tamamını arama motorlarına yönelttiği bu günlerde siz de blog sayfanız için en doğru konuları belirleyemeye özen göstermelisiniz. Peki, ilgi çekici blog konuları nasıl belirlenir? Blog konularınızı belirlerken nelere dikkat etmeli ve hangi noktaların üzerinde durmalısınız? Cevapları merak ediyorsanız gelin birlikte yanıt bulalım.\r\n\r\nİlgi Çekici Blog Konuları Nasıl Belirlenir?\r\nİlgi çekici blog konuları söz konusu olduğundan aslında ilk yapmanız gereken sınıflandırmadır. Sınıflandırma derken neyi kastediyor diyorsanız konuyu biraz açalım. Burada belirtmek istediğimiz husus, hedef kitle seçimidir. Elbette hedef kitleniz kadar yazılarınız ile elde etmek istediğiniz amaç ve hedefler de önemlidir.\r\n\r\nHedef Kitlenizi Belirleyin\r\nSiteniz için blog yazısı örnekleri oluşturmadan önce ilk yapmanız gereken hedef kitlenizi belirlemek olmalı. Neden mi? Çünkü arama motoru algoritmaları bizden artık net ve açık olmamızı istiyor. Yani aynı anda herkese ve her konuya hitap edecek genişlikte bir blog sayfası getirdiği avantajlar kadar dezavantajlara da sahiptir. Bu yüzden öncelikle hedef kitlenizi belirleyin.\r\n\r\nAdım bir; hangi sektöre ve neden blog içerikleri üretmek istiyorsunuz?\r\nAdım iki; ulaşmak istediğiniz kişilerle sınırlı mı kalmak yoksa kendinizi daha da büyütmek mi istiyorsunuz?\r\nAdım üç; belirlediğiniz hedef kitlenin ilgi alanları nelerdir?\r\nAdım dört; üretmek istediğiniz içerikler, hedef kitlenizin hangi ihtiyaçlarına yönelik olacak?\r\nAdım beş; içeriklerinizin hedef kitlesinin demografik dağılımı nedir?\r\nİhtiyacınız olan bu sorulara açıklıkla cevap verebilmektir. Ancak unutmayın ki dijital evren en az sizin kadar canlı ve hareketlidir. Yani bu isteklerinin ve ihtiyaçlarının kullanıcı taleplerine göre zamanla değişebileceği anlamına gelir. Kesinlikle durağan bir yapısı yoktur. Bu yüzden sorularınızı zamana yayarak cevaplandırmalı ve arama motoru algoritmalarını ciddiye almalısınız.\r\n\r\nArama motoru algoritmalarını iyi bir şekilde takip ederek aslında hem hedef kitlenize ulaşabilir hem hedef kitlenizin taleplerini ve ilgilerini analiz edebilir hem de okuyucu dostu içerikler üretebilirsiniz. Hedef kitlenizi belirlerken bu aşamada arama motoru algoritmaları en iyi dostunuz olmalıdır.\r\n\r\nYazılarınızın Amacını Belirleyin\r\nKullanıcılar artık cevaplarına daha hızlı ulaşmayı istemekle birlikte güvenilir kaynaklara yöneliyorlar. Bu yüzden iyi blog yazısı örnekleri ortaya çıkartmayı hedefliyorsanız yapacağınız şeylerin başında kesinlikle yazınızın bir amacı olmalıdır.\r\n\r\nBlog yazılarının amacı, okuyucularının sorularını cevaplandırmak ve meraklarını gidermektir. Bu noktada kaçırmamamız gereken üç ana unsur var. Bu noktalara dikkat ederek arama motoru algoritmalarını yani okuyucunuzu memnun edebilirsiniz. Böylece arama motorlarının sitenizi sevmesini sağlar ve bu uçsuz bucaksız dünyanın baş sıralarında yer almayı başarabilirsiniz.\r\n\r\nHedef kitlenizin ihtiyaç ve taleplerine yanıt verin.\r\nOkuyucularınızı bir eyleme yönlendirin.\r\nOkuyucularınızla doğrudan açık bir iletişimde bulunun.\r\nBu saydığımız noktalara dikkat ederek okuyucularınızın ihtiyaçlarına yönelik içerikler hazırlayabilirsiniz.\r\n\r\nBlog Yazısı Örnekleri\r\nKonumuz blog yazısı örnekleri olunca okuyucu dostu içeriklerin nasıl hazırlanması gerektiğinden bahsetmeden geçmeyeceğiz. Ama buraya kadar gelmişken gelin sizler için günümüzde en çok talep gören ve ilgi çekici blog yazısı örnekleri neler bakalım.\r\n\r\nNedir, nasıl yapılır içerikleri,\r\nGüzellik, kozmetik ve cilt bakım rutinlerine ele alan içerikler,\r\nGündeme dair güncel bilgileri kapsayan içerikler,\r\nPratik yemek ve tatlı tariflerini içeren içerikler,\r\nSağlık sektörünü kapsayan çeşitli rahatlıkları ve tedavi yöntemlerini ele alan içerikler günümüzde kullanıcıların en sık yaptığı aramaları kapsayan blog yazısı örneklerini bize gösterir.\r\nOkuyucu Dostu Blog Yazıları Nasıl Yazılır?\r\nEğer içerikleriniz hem okunsun hem de arama motorunda ilk sırlara çıksın istiyorsanız kesinlikle okuyucu dostu içerikler oluşturmalısınız. Zaten okuyucuyu memnun etmek arama motorunu memnun etmek olduğundan ötürü hedef kitlenizin taleplerine ne kadar yönelir ve sorularına ne kadar açık, kullanılabilir cevaplar getirirseniz o kadar iyi blog yazısı örnekleri oluşturabilirsiniz.\r\n\r\nGüçlü ve İlgi Çekici Başlık Seçimi\r\nBaşlık, okuyucunun ilk dikkatini çeken unsurdur. Siteye girmeden önce oluşturduğunuz başlık ile okuyucunun sitenize girmesini ve yazınızı okumasını sağlayabilirsiniz. Bu yüzden oluşturacağınız içeriğin kapsamına göre başlık seçimini doğru yapmalısınız. Bizden size tavsiye bu aralar özellikle snippet mantığında ele alınan içerikler hem okuyucuların hem de arama motorlarının gözdesi. Yani başlıklarınızı buna göre ele alırsanız istediğiniz sonuçlara daha hızlı ulaşabilirsiniz.\r\n\r\nÜslup Kadar Metnin Formu Da Önemli\r\nİçeriğinizi oluştururken kesinlikle net ve açık olun. Okuyucularınıza istedikleri bilgileri sunun ve içeriği uzatmak için gereksiz bilgi paylaşımı yapmayın. Bu kesinlikle yapacağınız son şey bile olmamalıdır. Üslubu ve içeriği doğru tayin ettikten sonra ise metnin formuna dikkat etmelisiniz. Biliyorsunuz okuyucular çoğunlukla metnin tamamını okumak yerine göz gezdirir ve aradığını bulamazsa siz en kaliteli içeriği oluşturmuş olsanız dahi siteyi maalesef terk eder. Buna izin vermemek için;\r\n\r\nİçeriğinizi sınıflandırın.\r\nKısa ve net bir giriş paragrafı düzenleyin.\r\nAnahtar kelimeleri kesinlikle doğru yerde ve doğru şekilde kullanın.\r\nAra başlıklar, en uzun içeriklerde bile okuyucuyu yönlendirir. Etkisini kesinlikle hafife almayın ve doğru ara başlıklar ile metni daha okunabilir kılın.\r\nMaddelemeler kesinlikle daha kolay bir okuma sağlar ve okuyucuları memnun eder. Gerekli yerlerde maddeleme kullanmaktan kaçınmayın.\r\nKesinlikle metni bağlayan bir sonuç paragrafı düzenlemeyi ihmal etmeyin.\r\nOkuyucunun Beklentilerini Karşılayın\r\nOkuyucularınıza değer verin böylece arama motorları tarafından değer görebilirsiniz. Arama motorlarının tek bir gözdesi vardır. O da kullanıcıdırlar. Yani kullanıcıları ne kadar memnun eder ve beklentilerini karşılarsanız istediğiniz sonuçlara o kadar hızlı ulaşabilirsiniz.\r\n\r\nDoğru ve Kullanılabilir Bilgiler Sunun\r\nİyi blog yazısı örnekleri her zaman yararlı içeriklerden oluşur. Burada amaç, kullanıcıda doyum sağlamak ve onun sorularına cevap bulabilmektir. Yani siz okuyucunuza ne kadar değer verir ve ne kadar kaliteli bir içerik kaleme alırsanız, arama motorlarından da o kadar ilgi görür; üst sıralara o kadar hızlı çıkarsınız.\r\n\r\nEğer içeriğimize baştan sona göz attıysanız artık blog sayfalarınız için ihtiyacınız olan her şeyi biliyorsunuz demektir. Unutmayın ki önemli olan her zaman kullanıcılardır ve arama motoru algoritmaları her zaman kullanıcı ihtiyaç ve taleplerini göz önünde bulundurur. Siz de dijital dünyanın içerisinde blog yazılarınızla görünür olmak istiyorsanız okuyucunuza değer vermelisiniz. Bu değeri de elbette oluşturduğunuz içeriklere yansıtmalısınız. Ayrıca bizden tavsiye farklı içerik kanallarını bir arada kullanmak size çoğu zaman avantaj sağlar. Buna örnek olarak blog sayfanız ile bir Instagram hesabınızın ya da YouTube kanalınızın olmasını örnek verebiliriz.', '2025-04-09 15:29:43', 'uploads/img_67f668379b7a2.webp', 'yayinda', 12, 1, 'blog-yazısı-örnekleri'),
(15, 'adsfsdfa', 'Gezi', 'sdafagdfasdf', '2025-04-09 14:48:40', 'uploads/img_67f66ca829a4a.png', 'yayinda', 2, 0, 'adsfsdfa'),
(16, 'Kitle Toplumu Teorisi Nedir?', 'Yaşam', '<h2>Kitle K&uuml;lt&uuml;r&uuml; Nasıl Oluşmuştur?</h2>\n\n<p>Kitle k&uuml;lt&uuml;r&uuml;, sanayi devrimi ve ardından gelen teknolojik ilerlemelerle birlikte 19. y&uuml;zyılın sonlarına doğru ortaya &ccedil;ıkmaya başlamıştır. Bu s&uuml;re&ccedil;, toplumsal, ekonomik ve teknolojik değişimlerle yakından ilişkilidir. Ve kitle k&uuml;lt&uuml;r&uuml;n&uuml;n oluşumunda birka&ccedil; ana fakt&ouml;r etkili olmuştur:</p>\n\n<h3>Sanayi Devrimi:</h3>\n\n<p>Sanayi Devrimi, toplumsal yapıları ve insanların yaşam tarzlarını k&ouml;kten değiştirmiştir. Kentleşme ve fabrika sisteminin gelişmesiyle birlikte, b&uuml;y&uuml;k insan gruplarının şehirlere taşınması, kitle iletişim ara&ccedil;larının yayılmasına zemin hazırlamıştır.</p>\n\n<h3>Teknolojik İlerlemeler:</h3>\n\n<p>Baskı teknolojilerindeki gelişmeler; gazetelerin, dergilerin ve kitapların daha hızlı ve ekonomik bir şekilde &uuml;retilip dağıtılmasını sağlamıştır. Radyo, televizyon ve daha sonraları internet gibi kitle iletişim ara&ccedil;larının gelişimi, bilgi ve k&uuml;lt&uuml;r &uuml;r&uuml;nlerinin geniş kitlelere ulaşmasını kolaylaştırmıştır.</p>\n\n<h3>Ekonomik Değişimler:</h3>\n\n<p>T&uuml;ketim k&uuml;lt&uuml;r&uuml;n&uuml;n y&uuml;kselişi ve sermayenin merkezileşmesi, standartlaşmış &uuml;r&uuml;nlerin ve hizmetlerin geniş kitlelere pazarlanmasına olanak tanımıştır. Reklamcılık ve pazarlama stratejileri, kitle k&uuml;lt&uuml;r&uuml; &uuml;r&uuml;nlerinin tanıtımında ve t&uuml;ketim alışkanlıklarının şekillendirilmesinde &ouml;nemli bir rol oynamıştır.</p>\n\n<h3>Eğitim ve Okuryazarlık Oranlarının Artışı:</h3>\n\n<p>Eğitim seviyesinin y&uuml;kselmesi ve okuryazarlık oranlarının artması, insanların kitle iletişim ara&ccedil;larına erişimini ve bu ara&ccedil;lar aracılığıyla &uuml;retilen i&ccedil;eriklerle etkileşimini artırmıştır.</p>\n\n<h3>K&uuml;lt&uuml;rel Değişimler:</h3>\n\n<p>Toplumların k&uuml;lt&uuml;rel yapısındaki değişimler, ortak değerler, normlar ve semboller etrafında birleşen geniş kitlelerin oluşmasını sağlamıştır. Bu da kitle k&uuml;lt&uuml;r&uuml;n&uuml;n, toplumun geniş kesimleri tarafından paylaşılan ve t&uuml;ketilen bir k&uuml;lt&uuml;r haline gelmesine olanak tanımıştır.</p>\n\n<p>Kitle k&uuml;lt&uuml;r&uuml;, bu fakt&ouml;rlerin bir araya gelmesiyle, geniş kitlelere hitap eden ve genellikle merkezi &uuml;retim mekanizmaları tarafından oluşturulan bir k&uuml;lt&uuml;r bi&ccedil;imi olarak ortaya &ccedil;ıkmıştır. Bu s&uuml;re&ccedil;, bireylerin k&uuml;lt&uuml;rel &uuml;r&uuml;nlerle etkileşim şekillerini değiştirmiştir. Ve toplumsal değerler, inan&ccedil;lar ve yaşam tarzları &uuml;zerinde &ouml;nemli bir etki yaratmıştır. Bug&uuml;n de sosyal medya platformları, dijital yayıncılık ve &ccedil;eşitli interaktif medya ara&ccedil;ları aracılığıyla evrimleşmeye devam etmektedir.</p>\n\n<h2>Kitle K&uuml;lt&uuml;r&uuml;n &Ouml;zellikleri Nelerdir?</h2>\n\n<p>Modern toplumların temel bir par&ccedil;ası haline gelmiş ve bir&ccedil;ok &ouml;zelliği ile tanımlanabilir. Bu &ouml;zellikler, kitle k&uuml;lt&uuml;r&uuml;n&uuml;n nasıl &uuml;retildiğini, dağıtıldığını ve t&uuml;ketildiğini anlamamıza yardımcı olur. İşte kitle k&uuml;lt&uuml;r&uuml;n&uuml;n bazı temel &ouml;zellikleri:</p>\n\n<p><strong>Standartlaşma:</strong>&nbsp;Kitle k&uuml;lt&uuml;r&uuml; &uuml;r&uuml;nleri, geniş kitlelere hitap edebilmek i&ccedil;in genellikle standartlaşmıştır. Bu, belirli bir kalıp veya form&uuml;l kullanılarak &uuml;retilen i&ccedil;eriklerin benzer &ouml;zellikler taşıması anlamına gelir. &Ouml;rneğin;</p>\n\n<ul>\n	<li>pop&uuml;ler m&uuml;zik,</li>\n	<li>televizyon programları veya filmler,</li>\n	<li>geniş bir izleyici kitlesine ulaşmak i&ccedil;in yaygın temalar ve formatlar etrafında şekillendirilir.</li>\n</ul>\n\n<p><a href=\"https://www.yaraticimetinyazari.com/\"><strong>Yaygın &Uuml;retim ve Dağıtım:</strong>&nbsp;</a>Kitle k&uuml;lt&uuml;r&uuml; &uuml;r&uuml;nleri, gelişmiş teknolojik ara&ccedil;lar kullanılarak b&uuml;y&uuml;k &ouml;l&ccedil;ekte &uuml;retilir.&nbsp; Bu, medya ara&ccedil;ları (televizyon, radyo, internet) aracılığıyla hızlı bir şekilde geniş kitlelere ulaşılmasını sağlar.</p>\n\n<p><strong>T&uuml;ketim Odaklılık:</strong>&nbsp;Kitle k&uuml;lt&uuml;r&uuml;, t&uuml;ketim k&uuml;lt&uuml;r&uuml; ile yakından ilişkilidir. Reklamlar ve pazarlama stratejileri, insanları belirli &uuml;r&uuml;nleri ve hizmetleri satın almaya teşvik eder. Bu durum, toplumda t&uuml;ketim alışkanlıklarının ve tercihlerinin şekillenmesine neden olur.</p>\n\n<p><strong>Pasiflik:</strong>&nbsp;Kitle k&uuml;lt&uuml;r&uuml;, genellikle pasif bir t&uuml;ketim modeli &ouml;nerir. İzleyiciler veya dinleyiciler, medya i&ccedil;eriklerini aktif bir katılım olmadan t&uuml;ketirler. Ancak, internetin ve sosyal medyanın y&uuml;kselişiyle birlikte s&uuml;re&ccedil; değişiyor. T&uuml;keticiler artık i&ccedil;erik &uuml;retim ve dağıtım s&uuml;re&ccedil;lerine daha aktif bir şekilde katılabilmektedir.</p>\n\n<p><strong>Homojenleşme:</strong>&nbsp;Kitle k&uuml;lt&uuml;r&uuml;, farklı k&uuml;lt&uuml;rel ve sosyal arka planlara sahip bireyler arasında ortak k&uuml;lt&uuml;rel zemin oluşturur.</p>\n\n<p>Ancak, bu durum bazen yerel k&uuml;lt&uuml;rlerin ve &ccedil;eşitliliğin homojenleşmesine neden olur. Ve k&uuml;resel k&uuml;lt&uuml;rlerin yerel gelenekler &uuml;zerinde baskın hale gelmesine neden olur.</p>\n\n<p><strong>K&uuml;reselleşme:</strong>&nbsp;Kitle k&uuml;lt&uuml;r&uuml;, k&uuml;reselleşme s&uuml;reciyle yakından ilişkilidir. Medya ara&ccedil;ları aracılığıyla, k&uuml;lt&uuml;rel &uuml;r&uuml;nler ve mesajlar uluslararası sınırları aşarak d&uuml;nya &ccedil;apında yayılır. Bu, k&uuml;resel bir k&uuml;lt&uuml;r&uuml;n oluşmasına ve farklı coğrafyalardaki insanlar arasında ortaklık yaratır.&nbsp; K&uuml;lt&uuml;rel referans noktalarının paylaşılmasına olanak tanır.</p>\n\n<p>Kitle k&uuml;lt&uuml;r&uuml;, bu &ouml;zellikleriyle modern toplumların sosyal ve k&uuml;lt&uuml;rel yapısını şekillendiren &ouml;nemli bir g&uuml;&ccedil;t&uuml;r. Ancak, bu &ouml;zelliklerin her biri, toplumdaki farklı insanlar&nbsp; tarafından farklı şekillerde değerlenir.</p>\n', '2025-04-09 14:56:08', 'uploads/img_67f66e68ca812.png', 'yayinda', 5, 1, 'kitle-toplumu-teorisi-nedir');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sayfalar`
--

CREATE TABLE `sayfalar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `icerik` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sira` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sayfalar`
--

INSERT INTO `sayfalar` (`id`, `baslik`, `icerik`, `slug`, `sira`) VALUES
(2, 'Hakkımızda', '📄 Hakkımızda MiniBlog, teknoloji, günlük yaşam, ipuçları ve daha fazlasını okuyucularıyla buluşturmayı amaçlayan sade ve kullanıcı dostu bir içerik platformudur. Amacımız, herkesin ilgisini çekebilecek kaliteli ve özgün içerikler sunarak bilgi paylaşımını kolaylaştırmak. Okuyucularımıza samimi bir ortamda güncel ve faydalı içerikler sunarken, aynı zamanda yazarlara da seslerini duyurma imkânı sağlıyoruz.  Her gün gelişen dünyayı birlikte keşfetmek için buradayız. MiniBlog ailesine katıldığınız için teşekkür ederiz!', 'hakkimizda', 0),
(3, 'item3', 'test', 'test', 3),
(4, 'İtem2', 'test2', 'test2', 2),
(5, 'İletişim', '📞 İletişim\r\nBizimle iletişime geçmekten çekinmeyin! Her türlü soru, görüş ve öneriniz için size yardımcı olmaktan memnuniyet duyarız.\r\nAşağıdaki formu doldurarak ya da doğrudan e-posta yoluyla bize ulaşabilirsiniz.\r\n\r\n📬 E-posta: info@miniblog.com\r\n📍 Adres: X Mahallesi, Y Caddesi, No: 123, İstanbul\r\n📞 Telefon: +90 555 123 45 67\r\n\r\nDestek ekibimiz en kısa sürede sizinle iletişime geçecektir. İlginiz için teşekkür ederiz!', 'iletisim', 1);

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
(1, 'admin', '$2y$10$vg6tDQXqj9keTo6ZvrXEtes9ZLYj2gI.zjJH4k/1X25S5179OF5d2');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Tablo için indeksler `sayfalar`
--
ALTER TABLE `sayfalar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

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
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `sayfalar`
--
ALTER TABLE `sayfalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
