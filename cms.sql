-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Şub 2023, 12:31:09
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `cms`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `url` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `url`) VALUES
(1, 'Yapay Zeka', 'yapay-zeka'),
(2, 'PHP', 'php'),
(3, 'SQL', 'sql');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `ads` text DEFAULT NULL,
  `favicon` text NOT NULL DEFAULT '/assets/images/favicon.png',
  `description` text NOT NULL DEFAULT 'CMS',
  `desc_isEnabled` int(11) NOT NULL DEFAULT 1,
  `favicon_isEnabled` int(11) NOT NULL DEFAULT 1,
  `ads_isEnabled` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `config`
--

INSERT INTO `config` (`id`, `name`, `ads`, `favicon`, `description`, `desc_isEnabled`, `favicon_isEnabled`, `ads_isEnabled`) VALUES
(1, 'Hofmann', NULL, '/assets/images/favicon.png', 'CMS', 1, 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `url` varchar(3000) DEFAULT NULL,
  `title` varchar(3000) NOT NULL,
  `short` varchar(3000) NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `category` int(11) NOT NULL,
  `author` int(11) NOT NULL DEFAULT 0,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `contents`
--

INSERT INTO `contents` (`id`, `url`, `title`, `short`, `content`, `image`, `category`, `author`, `time`) VALUES
(1, NULL, 'Yapay zeka nedir?', 'Yapay zeka, makine öğrenmesi, sürekli öğrenme ve...', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<style>\n/* Style Definitions */\ntable.MsoNormalTable\n{mso-style-name:\"Normal Tablo\";\nmso-tstyle-rowband-size:0;\nmso-tstyle-colband-size:0;\nmso-style-noshow:yes;\nmso-style-priority:99;\nmso-style-parent:\"\";\nmso-padding-alt:0cm 5.4pt 0cm 5.4pt;\nmso-para-margin-top:0cm;\nmso-para-margin-right:0cm;\nmso-para-margin-bottom:8.0pt;\nmso-para-margin-left:0cm;\nline-height:107%;\nmso-pagination:widow-orphan;\nfont-size:11.0pt;\nfont-family:\"Calibri\",sans-serif;\nmso-ascii-font-family:Calibri;\nmso-ascii-theme-font:minor-latin;\nmso-hansi-font-family:Calibri;\nmso-hansi-theme-font:minor-latin;\nmso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi;\nmso-font-kerning:1.0pt;\nmso-ligatures:standardcontextual;\nmso-fareast-language:EN-US;}\n</style>\n\n\n<p class=\"MsoNormalM\">Yapay zeka, makine öğrenmesi, sürekli öğrenme ve nöral ağ\nteknolojileri gibi alanlardaki son gelişmelerin bir sonucu olarak ortaya\nçıkmıştır. Yapay zeka, insan beyni gibi düşünen ve öğrenen makine sistemlerini\noluşturmak için tasarlandı. Bu sistemler, verileri analiz etme, karar verme ve\nöğrenme gibi görevleri gerçekleştirebilir.</p>\n\n\n<p class=\"MsoNormalM\"> </p>\n\n\n<p class=\"MsoNormalM\">Yapay zeka, çeşitli sektörlerde kullanılmaktadır ve çok\nsayıda faydası vardır. Örneğin, sağlık sektöründe yapay zeka, hastalıkların\nteşhisi ve tedavisi için kullanılabilir. E-ticaret sektöründe, yapay zeka\nmüşterilerin ihtiyaçlarını ve tercihlerini analiz ederek önerilerde\nbulunabilir. Finans sektöründe, yapay zeka fırsatları ve riskleri analiz ederek\nyatırımların yönetimini kolaylaştırabilir.</p>\n\n\n<p class=\"MsoNormalM\"> </p>\n\n\n<p class=\"MsoNormalM\">Yapay zeka, insanlar için çok sayıda fayda sağlamakla\nbirlikte, aynı zamanda bazı riskleri de beraberinde getirir. Örneğin, yapay\nzeka sistemlerinin yanıltıcı sonuçlar vermesi ve insanları yanıltması gibi.\nAyrıca, yapay zeka sistemlerinin insanların işlerini ve işyerlerini tehlikeye\natması da bir risk olarak kabul edilir.</p>\n\n\n<p class=\"MsoNormalM\"> </p>\n\n\n<p class=\"MsoNormalM\">Yapay zeka, gelecekte insanlar için çok sayıda fayda\nsağlayacak ve hayatımızı kolaylaştıracaktır. Ancak, bu teknolojinin doğru\nşekilde kullanımı ve yönetimi çok önemlidir. Bilişimciler, yapay zekanın\nfaydalarını ve risklerini doğru şekilde değerlendirmeli ve bu teknolojinin\ninsanlar için en iyi şekilde kullanılmasını sağlamalıdır.</p>', 'https://bulutistan.com/blog/wp-content/uploads/2022/03/Yapay-Zeka-AI-Nedir-scaled.jpg', 1, 1, '2023-02-04 12:03:18'),
(2, NULL, 'PHP\'nin tarihçesi ve evrimi', 'PHP, Rasmus Lerdorf tarafından 1994 yılında yazılmıştir.', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n\r\n<style>\r\n/* Style Definitions */\r\ntable.MsoNormalTable\r\n{mso-style-name:\"Normal Tablo\";\r\nmso-tstyle-rowband-size:0;\r\nmso-tstyle-colband-size:0;\r\nmso-style-noshow:yes;\r\nmso-style-priority:99;\r\nmso-style-parent:\"\";\r\nmso-padding-alt:0cm 5.4pt 0cm 5.4pt;\r\nmso-para-margin-top:0cm;\r\nmso-para-margin-right:0cm;\r\nmso-para-margin-bottom:8.0pt;\r\nmso-para-margin-left:0cm;\r\nline-height:107%;\r\nmso-pagination:widow-orphan;\r\nfont-size:11.0pt;\r\nfont-family:\"Calibri\",sans-serif;\r\nmso-ascii-font-family:Calibri;\r\nmso-ascii-theme-font:minor-latin;\r\nmso-hansi-font-family:Calibri;\r\nmso-hansi-theme-font:minor-latin;\r\nmso-bidi-font-family:\"Times New Roman\";\r\nmso-bidi-theme-font:minor-bidi;\r\nmso-font-kerning:1.0pt;\r\nmso-ligatures:standardcontextual;\r\nmso-fareast-language:EN-US;}\r\n</style>\r\n\r\n\r\n<p class=\"MsoNormalM\">\r\n<span style=\"font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; white-space: pre-wrap; font-weight: bold;\">PHP nedir ve ne için kullanılır?</span></p>\r\n<p class=\"MsoNormalM\"><span style=\"font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; white-space: pre-wrap;\"><p style=\"font-weight: bold; color: rgb(65, 65, 65); font-size: 14px; line-height: 1.6;\"></p><p style=\"color: rgb(65, 65, 65); font-size: 14px; line-height: 1.6;\">PHP (Hypertext Preprocessor), web uygulamalarının geliştirilmesi için kullanılan bir server-side scripting dilidir. PHP, HTML, CSS ve JavaScript gibi diller ile birlikte kullanılarak, dinamik web sayfaları oluşturulabilir. PHP, veritabanı sistemleriyle (örneğin MySQL) birlikte kullanılarak, dinamik içerik oluşturmak için kullanılabilir.</p><p style=\"color: rgb(65, 65, 65); font-size: 14px; line-height: 1.6;\">PHP, açık kaynaklı bir dil olduğundan, ücretsiz olarak kullanılabilir ve geliştiriciler tarafından geniş ölçekte kullanılmaktadır. PHP, çok sayıda framework ve araç sunması, uygulama geliştirmenin hızlandırılmasına yardımcı olur.</p><p style=\"color: rgb(65, 65, 65); font-size: 14px; line-height: 1.6;\">PHP, web siteleri, e-ticaret uygulamaları, sosyal ağ siteleri, forumlar, bloglar ve benzeri web uygulamalarının geliştirilmesi için yaygın olarak kullanılır. Ayrıca, PHP ile yazılan uygulamalar, sunucular üzerinde çalışır ve tarayıcı tarafından yürütülmez, bu nedenle güvenliği ve performansı artırır.</p><p style=\"\"></p><p style=\"color: rgb(65, 65, 65); font-size: 14px; line-height: 1.6;\">1997 yılında, Andi Gutmans ve Zeev Suraski tarafından PHP 3.0, daha güçlü ve etkili bir çerçeve haline gelmiştir. Daha sonra, PHP 4 ve PHP 5 sürümleri, objeler, nesneler ve diğer özellikler eklenerek PHP\'nin popüler bir web programlama dili haline gelmesine yardımcı oldu.</p><span style=\"font-weight: bold;\">\r\n</span></span></p>\r\n\r\n\r\n<p class=\"MsoNormalM\">\r\n\r\n<span style=\"color: rgb(65, 65, 65); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; font-weight: 700; white-space: pre-wrap\">PHP\'nin Tarihçesi</span></p>\r\n<p class=\"MsoNormalM\">PHP, Rasmus Lerdorf tarafından 1994 yılında yazılmıştir. İlk\r\nolarak, Lerdorf, kendisi için bir web sayfası oluşturmak için kullandığı bir\r\nbetik dilidir. Zamanla, diğer geliştiriciler tarafından da benimsenerek,\r\ngüncellenerek ve geliştirilerek, bugünkü haline evrimleşmiştir.&nbsp;</p>\r\n\r\n\r\n<p class=\"MsoNormalM\">Günümüzde, PHP, web uygulamalarının geliştirilmesinde yaygın\r\nolarak kullanılan bir dil ve popüler CMS sistemleri, örneğin WordPress, Joomla\r\nve Drupal, PHP kullanmaktadır. Ayrıca, PHP ile geliştirilen önemli e-ticaret\r\nuygulamaları ve sosyal ağ siteleri de mevcuttur.</p>\r\n\r\n\r\n<p class=\"MsoNormalM\">PHP\'nin evrimi, sürekli olarak güncellenerek, geliştirilmeye\r\ndevam etmektedir ve gelecekte de popüler bir web programlama dili olarak\r\nkalmaya devam edecektir.</p>\r\n<p><br /></p>\r\n<p><br /></p>\r\n<style>\r\n\r\n<</style>\r\n<style>\r\n /* Style Definitions */\r\n table.MsoNormalTable\r\n	{mso-style-name:\"Normal Tablo\";\r\n	mso-tstyle-rowband-size:0;\r\n	mso-tstyle-colband-size:0;\r\n	mso-style-noshow:yes;\r\n	mso-style-priority:99;\r\n	mso-style-parent:\"\";\r\n	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;\r\n	mso-para-margin-top:0cm;\r\n	mso-para-margin-right:0cm;\r\n	mso-para-margin-bottom:8.0pt;\r\n	mso-para-margin-left:0cm;\r\n	line-height:107%;\r\n	mso-pagination:widow-orphan;\r\n	font-size:11.0pt;\r\n	font-family:\"Calibri\",sans-serif;\r\n	mso-ascii-font-family:Calibri;\r\n	mso-ascii-theme-font:minor-latin;\r\n	mso-hansi-font-family:Calibri;\r\n	mso-hansi-theme-font:minor-latin;\r\n	mso-bidi-font-family:\"Times New Roman\";\r\n	mso-bidi-theme-font:minor-bidi;\r\n	mso-font-kerning:1.0pt;\r\n	mso-ligatures:standardcontextual;\r\n	mso-fareast-language:EN-US;}\r\n<</style>', 'https://www.hafzullah.com/uploads/news/1000x600-php-nedir-kisaca.webp', 2, 1, '2023-02-04 14:15:09'),
(3, NULL, 'SQL Nedir?', ' Veri tabanı içindeki verileri sorgulamak, eklemek, değiştirmek...', '<p>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<style>\r\n/* Style Definitions */\r\ntable.MsoNormalTable\r\n{mso-style-name:\"Normal Tablo\";\r\nmso-tstyle-rowband-size:0;\r\nmso-tstyle-colband-size:0;\r\nmso-style-noshow:yes;\r\nmso-style-priority:99;\r\nmso-style-parent:\"\";\r\nmso-padding-alt:0cm 5.4pt 0cm 5.4pt;\r\nmso-para-margin-top:0cm;\r\nmso-para-margin-right:0cm;\r\nmso-para-margin-bottom:8.0pt;\r\nmso-para-margin-left:0cm;\r\nline-height:107%;\r\nmso-pagination:widow-orphan;\r\nfont-size:11.0pt;\r\nfont-family:\"Calibri\",sans-serif;\r\nmso-ascii-font-family:Calibri;\r\nmso-ascii-theme-font:minor-latin;\r\nmso-hansi-font-family:Calibri;\r\nmso-hansi-theme-font:minor-latin;\r\nmso-bidi-font-family:\"Times New Roman\";\r\nmso-bidi-theme-font:minor-bidi;\r\nmso-font-kerning:1.0pt;\r\nmso-ligatures:standardcontextual;\r\nmso-fareast-language:EN-US;}\r\n</style>\r\n</p>\r\n\r\n\r\n<p class=\"MsoNormalM\">SQL (Structured Query Language), veri tabanı yönetimi için\r\nkullanılan standart bir programlama dildir. Veri tabanı içindeki verileri sorgulamak,\r\neklemek, değiştirmek ve silmek gibi işlemleri yapmak için kullanılır.</p>\r\n\r\n\r\n<p class=\"MsoNormalM\">SQL, verileri depolamak, sınıflandırmak ve erişmek için\r\ntasarlanmış veri tabanı yönetim sistemlerinde (DBMS) en yaygın olarak\r\nkullanılan dil olarak kabul edilir. Örneğin, Microsoft SQL Server, Oracle,\r\nMySQL gibi popüler veri tabanı yönetim sistemleri SQL kullanır.</p>\r\n<p><span style=\"font-weight: bold; font-size: 24px;\">SQL Tarihçesi</span></p>\r\n\r\n\r\n<p>\r\n</p>\r\n<p class=\"MsoNormalM\">SQL\'nin tarihçesi, 1970\'li yıllara kadar gitmektedir. O\r\ndönemde IBM tarafından veri tabanı yönetimi için bir dil oluşturmak için bir\r\nproje başlatılmıştır. 1974 yılında Dr. E. F. Codd tarafından tanımlanmış olan\r\nveri tabanı modeli, bu projenin temelini oluşturmuştur.</p>\r\n\r\n\r\n<p class=\"MsoNormalM\">IBM tarafından SQL, veri tabanı yönetimi için bir standart\r\ndil oluşturmak amacıyla yapılmıştır. İlk olarak 1974 yılında yapılan bu\r\nçalışma, 1979 yılında IBM tarafından yayınlanan System R adlı veri tabanı\r\nyönetim sistemiyle birlikte piyasaya sürülmüştür.</p>\r\n\r\n\r\n<p class=\"MsoNormalM\">SQL, daha sonra ANSI (Amerikan Ulusal Standartlar Enstitüsü)\r\ntarafından standartlaştırılmış ve veri tabanı yönetim sistemleri için bir dil\r\nolarak kabul görmüştür. Günümüzde, SQL veri tabanı yönetimi için en yaygın\r\nolarak kullanılan dil olarak kabul edilmektedir.</p>\r\n\r\n\r\n<br />\r\n\r\n\r\n<p><br /></p>\r\n\r\n\r\n<p><br />\r\n</p>\r\n\r\n\r\n<p><br />\r\n</p>', 'https://res.cloudinary.com/dyd911kmh/image/upload/v1646566163/about_sql_5dcf267e9c.jpg', 3, 1, '2023-02-04 18:23:11');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ranks`
--

CREATE TABLE `ranks` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `ADMIN` int(1) NOT NULL DEFAULT 0,
  `USER_LIST` int(1) NOT NULL DEFAULT 0,
  `USER_ADD` int(1) NOT NULL DEFAULT 0,
  `USER_REMOVE` int(1) NOT NULL DEFAULT 0,
  `USER_UPDATE` int(1) NOT NULL DEFAULT 0,
  `USER_BAN` int(1) NOT NULL DEFAULT 0,
  `RANK_LIST` int(1) NOT NULL DEFAULT 0,
  `CONTENTS_LIST` int(1) NOT NULL DEFAULT 0,
  `CONTENTS_ADD` int(11) NOT NULL DEFAULT 0,
  `CONTENTS_UPDATE` int(11) NOT NULL DEFAULT 0,
  `CONTENTS_REMOVE` int(11) NOT NULL DEFAULT 0,
  `PAGES_LIST` int(11) NOT NULL DEFAULT 0,
  `PAGES_ADD` int(11) NOT NULL DEFAULT 0,
  `PAGES_UPDATE` int(11) NOT NULL DEFAULT 0,
  `PAGES_REMOVE` int(11) NOT NULL DEFAULT 0,
  `CATEGORIES_LIST` int(11) NOT NULL DEFAULT 0,
  `PANEL` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Tablo döküm verisi `ranks`
--

INSERT INTO `ranks` (`id`, `name`, `ADMIN`, `USER_LIST`, `USER_ADD`, `USER_REMOVE`, `USER_UPDATE`, `USER_BAN`, `RANK_LIST`, `CONTENTS_LIST`, `CONTENTS_ADD`, `CONTENTS_UPDATE`, `CONTENTS_REMOVE`, `PAGES_LIST`, `PAGES_ADD`, `PAGES_UPDATE`, `PAGES_REMOVE`, `CATEGORIES_LIST`, `PANEL`) VALUES
(1, 'User', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'Editör', 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 'Admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` text CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL DEFAULT 'null@null.com',
  `password` varchar(500) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `rank` int(20) NOT NULL DEFAULT 1,
  `avatar` text NOT NULL DEFAULT '/assets/images/favicon.png',
  `registerdate` datetime NOT NULL DEFAULT current_timestamp(),
  `lastlogin` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(300) DEFAULT NULL,
  `ban` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `rank`, `avatar`, `registerdate`, `lastlogin`, `ip_address`, `ban`) VALUES
(1, 'Admin', 'admin@email.com', '$2y$12$ByIxfplgoxzjgMLanJ/.TuD55OBW1Hya8GuJHwHFFzD6yFVTR25uS', 3, '/assets/images/favicon.png', '2023-01-30 06:50:27', '2023-02-04 12:03:18', '::1', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
