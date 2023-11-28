-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 28 Kas 2023, 16:41:42
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `crud`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `calisanlar`
--

CREATE TABLE `calisanlar` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefon` varchar(15) DEFAULT NULL,
  `maas` decimal(10,2) DEFAULT NULL,
  `dogum_tarihi` date DEFAULT NULL,
  `kayit_tarihi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `calisanlar`
--

INSERT INTO `calisanlar` (`id`, `ad`, `soyad`, `email`, `telefon`, `maas`, `dogum_tarihi`, `kayit_tarihi`) VALUES
(20, 'Aysu', 'Şahin', 'aysu.sahin@example.com', '5550123456', 69000000.00, '1999-07-27', '2023-11-27 20:48:39'),
(21, 'Onur', 'Kara', 'onur.kara@example.com', '5551234567', 5000.00, '1979-10-10', '2023-11-27 20:48:39'),
(22, 'Şeyma', 'Çınar', 'seyma.cinar@example.com', '5552345678', 6200.00, '2000-03-23', '2023-11-27 20:48:39'),
(23, 'Ozan', 'Atalay', 'ozan.atalay@example.com', '5553456789', 5300.00, '1978-06-06', '2023-11-27 20:48:39'),
(41, 'merve', 'koray', 'merve.koray@example.com', NULL, 15550000.00, NULL, '2023-11-28 12:31:42'),
(43, 'feyza', 'diken', 'feyza.diken@example.com', NULL, 4554500.00, NULL, '2023-11-28 13:11:57'),
(53, 'kara', 'ahmet', 'kara.ahmet@example.com', NULL, 123400.00, NULL, '2023-11-28 15:12:49'),
(56, 'Ahmet', 'Yılmaz', 'ahmet.yilmaz@example.com', '555-1234', 5000.00, '1980-05-15', '2023-11-28 15:40:33'),
(57, 'Ayşe', 'Kara', 'ayse.kara@example.com', '555-5678', 6000.00, '1985-08-23', '2023-11-28 15:40:33'),
(58, 'Mehmet', 'Şahin', 'mehmet.sahin@example.com', '555-9101', 7000.00, '1990-02-10', '2023-11-28 15:40:33'),
(59, 'Fatma', 'Demir', 'fatma.demir@example.com', '555-1122', 5500.00, '1977-11-30', '2023-11-28 15:40:33'),
(60, 'Mustafa', 'Çelik', 'mustafa.celik@example.com', '555-3344', 8000.00, '1982-07-19', '2023-11-28 15:40:33'),
(61, 'Zeynep', 'Arslan', 'zeynep.arslan@example.com', '555-5566', 6500.00, '1995-04-05', '2023-11-28 15:40:33'),
(62, 'Ali', 'Güneş', 'ali.gunes@example.com', '555-7788', 7500.00, '1988-09-14', '2023-11-28 15:40:33'),
(63, 'Selin', 'Yıldız', 'selin.yildiz@example.com', '555-9900', 6200.00, '1993-12-28', '2023-11-28 15:40:33'),
(64, 'Burak', 'Turan', 'burak.turan@example.com', '555-1122', 5800.00, '1984-03-08', '2023-11-28 15:40:33'),
(65, 'Elif', 'Bulut', 'elif.bulut@example.com', '555-3344', 7200.00, '1989-06-25', '2023-11-28 15:40:33');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `calisanlar`
--
ALTER TABLE `calisanlar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `calisanlar`
--
ALTER TABLE `calisanlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
