-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 10.2.6-MariaDB-log - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- membuang struktur untuk table db_banksampah.banks
CREATE TABLE IF NOT EXISTS `banks` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.banks: ~1 rows (lebih kurang)
DELETE FROM `banks`;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
INSERT INTO `banks` (`id`, `user_id`, `name`, `address`, `description`, `order_number`, `active`, `created_at`, `updated_at`) VALUES
	('BANK000001', 'bank', 'Bank Sampah Oke', NULL, NULL, 1, 1, '2017-08-10 05:49:34', '2017-08-10 05:49:34');
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.categories: ~3 rows (lebih kurang)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `description`, `unit`, `active`) VALUES
	(1, 'Makanan', 'kebutuhan makanan sehari-hari', 'pcs', 1),
	(2, 'Minuman', 'kebutuhan minuman sehari-hari', 'pcs', 1),
	(3, 'Alat tulis', 'kebutuhan alat tulis kantor dan yang semacamanya', 'pcs', 1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.codes
CREATE TABLE IF NOT EXISTS `codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('+','-') COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codes_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.codes: ~3 rows (lebih kurang)
DELETE FROM `codes`;
/*!40000 ALTER TABLE `codes` DISABLE KEYS */;
INSERT INTO `codes` (`id`, `name`, `description`, `type`, `active`) VALUES
	(1, 'Debit', 'menabung sampah ke bank sampah', '+', 1),
	(2, 'Kredit', 'menarik tunai dari bank sampah', '-', 1),
	(3, 'Belanja', 'berbelanja di koperasi serba usaha', '-', 1);
/*!40000 ALTER TABLE `codes` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_member` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.customers: ~2 rows (lebih kurang)
DELETE FROM `customers`;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `user_id`, `bank_id`, `family_member`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'nasabah', 'BANK000001', 0, 1, '2017-08-10 06:43:29', '2017-08-10 06:43:29'),
	(2, 'nasabah2', 'BANK000001', 0, 1, '2017-08-10 10:45:44', '2017-08-10 10:45:44');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.detailreceipts
CREATE TABLE IF NOT EXISTS `detailreceipts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `receipt_id` int(10) unsigned NOT NULL,
  `good_id` int(10) unsigned NOT NULL,
  `damount` int(11) NOT NULL,
  `dprice` decimal(8,2) NOT NULL,
  `dtotal` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.detailreceipts: ~2 rows (lebih kurang)
DELETE FROM `detailreceipts`;
/*!40000 ALTER TABLE `detailreceipts` DISABLE KEYS */;
INSERT INTO `detailreceipts` (`id`, `receipt_id`, `good_id`, `damount`, `dprice`, `dtotal`) VALUES
	(3, 3, 1, 1, 5000.00, 5000.00),
	(4, 4, 3, 1, 2500.00, 2500.00);
/*!40000 ALTER TABLE `detailreceipts` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.goods
CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `koperasi_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` enum('high','standard') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `price` decimal(8,2) NOT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.goods: ~3 rows (lebih kurang)
DELETE FROM `goods`;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` (`id`, `koperasi_id`, `category_id`, `name`, `description`, `priority`, `price`, `picture`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'KOPR000001', 1, 'Kentang', NULL, 'standard', 5000.00, 'http://belanjasampah.dev/storage/img/KOPR000001-1.jpg', 1, '2017-08-10 06:20:23', '2017-08-10 06:20:23'),
	(2, 'KOPR000001', 2, 'Teh Sisri', NULL, 'high', 500.00, 'http://belanjasampah.dev/storage/img/KOPR000001-2.jpg', 1, '2017-08-10 10:01:31', '2017-08-10 10:01:31'),
	(3, 'KOPR000001', 3, 'Pensil', NULL, 'standard', 2500.00, 'http://belanjasampah.dev/storage/img/KOPR000001-3.jpg', 1, '2017-08-10 10:39:53', '2017-08-10 10:39:53');
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.koperasis
CREATE TABLE IF NOT EXISTS `koperasis` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.koperasis: ~1 rows (lebih kurang)
DELETE FROM `koperasis`;
/*!40000 ALTER TABLE `koperasis` DISABLE KEYS */;
INSERT INTO `koperasis` (`id`, `user_id`, `name`, `address`, `description`, `order_number`, `active`, `created_at`, `updated_at`) VALUES
	('KOPR000001', 'koperasi', 'Koperasi Sukses', NULL, NULL, 1, 1, '2017-08-10 05:49:21', '2017-08-10 05:49:21');
/*!40000 ALTER TABLE `koperasis` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.migrations: ~4 rows (lebih kurang)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2017_05_29_130911_entrust_setup_tables', 1),
	(4, '2017_05_29_130935_create_database', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.password_resets: ~0 rows (lebih kurang)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.receipts
CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `koperasi_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `status` enum('processed','verified') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.receipts: ~2 rows (lebih kurang)
DELETE FROM `receipts`;
/*!40000 ALTER TABLE `receipts` DISABLE KEYS */;
INSERT INTO `receipts` (`id`, `koperasi_id`, `customer_id`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'KOPR000001', 1, 'processed', '2017-08-10 08:39:36', '2017-08-10 09:00:45'),
	(4, 'KOPR000001', 1, 'verified', '2017-08-10 10:43:02', '2017-08-10 10:43:43');
/*!40000 ALTER TABLE `receipts` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.roles: ~4 rows (lebih kurang)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'admin_sistem', 'Admin Sistem', 'mengelola sistem informasi secara keseluruhan (developer)', '2017-08-10 05:46:32', '2017-08-10 05:46:32'),
	(2, 'admin_koperasi', 'Koperasi Serba usaha', 'mengelola barang dan transaksi belanja yang ada di sistem informasi', '2017-08-10 05:46:32', '2017-08-10 05:46:32'),
	(3, 'admin_bank', 'Bank Sampah', 'mengelola nasabah dan transaksi-transaksi perbankan yang ada di sistem informasi', '2017-08-10 05:46:32', '2017-08-10 05:46:32'),
	(4, 'nasabah', 'Nasabah', 'melakukan transaksi belanja dan perbankan di sistem informasi', '2017-08-10 05:46:32', '2017-08-10 05:46:32');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.role_user: ~5 rows (lebih kurang)
DELETE FROM `role_user`;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
	('adminsistem', 1),
	('bank', 3),
	('koperasi', 2),
	('nasabah', 4),
	('nasabah2', 4);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(10) unsigned NOT NULL,
  `user_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.stocks: ~3 rows (lebih kurang)
DELETE FROM `stocks`;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` (`id`, `good_id`, `user_id`, `value`, `created_at`, `updated_at`) VALUES
	(1, 1, 'koperasi', 10, '2017-08-10 06:29:54', '2017-08-10 06:29:54'),
	(2, 3, 'koperasi', 10, '2017-08-10 10:42:25', '2017-08-10 10:42:25'),
	(5, 3, 'nasabah', -1, '2017-08-10 10:43:02', '2017-08-10 10:43:02');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.transactions: ~7 rows (lebih kurang)
DELETE FROM `transactions`;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` (`id`, `code_id`, `customer_id`, `value`, `created_at`, `updated_at`) VALUES
	(1, 3, 1, -5000.00, '2017-08-10 07:12:07', '2017-08-10 07:12:07'),
	(2, 1, 1, 10000.00, '2017-08-10 08:05:05', '2017-08-10 08:05:05'),
	(3, 3, 1, -5000.00, '2017-08-10 08:06:47', '2017-08-10 08:06:47'),
	(4, 1, 1, 10000.00, '2017-08-10 08:39:07', '2017-08-10 08:39:07'),
	(5, 3, 1, -5000.00, '2017-08-10 08:39:36', '2017-08-10 08:39:36'),
	(6, 1, 1, 5000.00, '2017-08-10 10:41:28', '2017-08-10 10:41:28'),
	(7, 3, 1, -2500.00, '2017-08-10 10:43:02', '2017-08-10 10:43:02');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- membuang struktur untuk table db_banksampah.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_banksampah.users: ~5 rows (lebih kurang)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `name`, `address`, `phone_number`, `gender`, `birth_date`, `password`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
	('adminsistem', 'ian.rizkypratama@gmail.com', 'Septianata Rizky Pratama', 'Denpasar, Bali', '085738626264', 'male', '1996-09-11', '$2y$10$2Zlbx.mVnaX5z9avi.HcXuEObp47AkLa59hohPh4a7zoXMazkHLwi', 1, 'TjHDUFdfb5xxv3OPEEJOQGa8RO5dSJbK4eMHf3514zWqvhiftotqNBqQbOLx', '2017-08-10 05:46:32', '2017-08-10 05:46:32'),
	('bank', 'bank@gmail.com', 'Admin Bank', NULL, '', NULL, NULL, '$2y$10$Hr8/GOV0OhS/6kNnT0YkHO4uGKALZnIVExuGQ1hoUMl/OB9gb6CWe', 1, '7oNfiJHTPlNYR417M61PgrNZFu5wr5KPKq5r4hugqhnNwXItWxbZx7zoXnbF', '2017-08-10 05:49:09', '2017-08-10 05:49:09'),
	('koperasi', 'koperasi@gmail.com', 'Admin Koperasi', NULL, '', NULL, NULL, '$2y$10$Q8kumHi3WMw6tmP0mFakT.y/PA/RSMMwrHWn6xn5XVuWarZvJpj7C', 1, 'u7JfXjwsOKdI0rNIuXqlgDMw7EEP2XbVwDQXVJLbL8YiKVutEfUA7KM1DF8Y', '2017-08-10 05:48:14', '2017-08-10 05:48:14'),
	('nasabah', 'nasabah@gmail.com', 'I Putu Nasabah', NULL, '', NULL, NULL, '$2y$10$wXmPINUX6SkPWX.PG0WMIO7jGnWcH8UPU81vGmGq16hf9FraEM5/i', 1, 'umxDRqesvPLY357AdUlVMqKFwydTamUeQmIfrMQXCY79Ij24DrygWbBd1oYh', '2017-08-10 06:43:29', '2017-08-10 06:43:29'),
	('nasabah2', 'nasabah2@gmail.com', 'Nasabah', NULL, '', NULL, NULL, '$2y$10$fblboIjPJX00eYatjDa//.CMk8xau/rmvRtaeRrOVAXeoQ1TsoGbi', 1, 'Dqytx6WrVGm7EP3G1IqVAFzJlxbQz6jFBTXfwm451qRu9bq5bQ1dmyRFjcfa', '2017-08-10 10:45:44', '2017-08-10 10:45:44');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
