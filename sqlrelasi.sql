/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - perpustakaan_skripsi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`perpustakaan_skripsi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `perpustakaan_skripsi`;

/*Table structure for table `anggotas` */

DROP TABLE IF EXISTS `anggotas`;

CREATE TABLE `anggotas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nisn` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kelas` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `anggotas_nisn_unique` (`nisn`),
  KEY `anggotas_user_id_foreign` (`user_id`),
  CONSTRAINT `anggotas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `anggotas` */

insert  into `anggotas`(`id`,`nisn`,`nama`,`jk`,`no_hp`,`alamat`,`user_id`,`created_at`,`updated_at`,`kelas`) values 
(23,'121211','Randu Rb','L','083124441661','Padang',27,'2024-07-31 08:58:18','2024-07-31 08:58:18','10'),
(24,'2321','fitri rahma','P','087566667655','Damar',28,'2024-07-31 09:06:37','2024-07-31 09:06:37','11'),
(25,'23211','rafi putra','L','08676665445','purus',29,'2024-07-31 09:07:24','2024-07-31 09:07:24','12'),
(26,'123421','tiara lubis','P','087677776444','Lubeg',30,'2024-07-31 09:08:42','2024-07-31 09:08:42','11'),
(27,'2121','bintang putra','L','083123334566','padang',31,'2024-08-07 06:11:01','2024-08-07 06:11:01','10'),
(28,'12321','jaya wibowo','L','086544443211','padang',32,'2024-08-07 06:11:44','2024-08-07 06:11:44','11'),
(29,'3211','gita permata','P','083122223542','padang',33,'2024-08-07 06:12:24','2024-08-07 06:12:24','11'),
(30,'2111','hadi nugroho','L','083122223433','padang',34,'2024-08-07 06:13:14','2024-08-07 06:13:14','11'),
(31,'1222','elina wijaya','P','083122223433','padang',35,'2024-08-07 06:14:31','2024-08-07 06:14:31','12'),
(32,'1111','niko ramadan','L','083123334566','padang',36,'2024-08-07 06:16:04','2024-08-07 06:16:04','11'),
(33,'2221','kinanti arum','P','083123334566','padang',37,'2024-08-07 06:16:47','2024-08-07 06:16:47','11'),
(34,'12211','zafira rahma','P','082344445333','padang',38,'2024-08-07 06:21:28','2024-08-07 06:21:28','11'),
(35,'32113','putra maulana','L','083122223433','padang',39,'2024-08-07 06:22:09','2024-08-07 06:22:09','10'),
(36,'11111','rani melati','P','083122223433','padang',40,'2024-08-07 06:22:38','2024-08-07 06:22:38','12'),
(37,'20287','satria hidayat','L','08543445666','padang',41,'2024-08-07 06:23:18','2024-08-07 06:23:18','11'),
(38,'87443','tarik alvi','L','083124448177','padang',42,'2024-08-07 06:23:42','2024-08-07 06:23:42','11'),
(39,'2211','lili melia','P','08543445666','padang',43,'2024-08-07 06:24:17','2024-08-07 06:24:17','10'),
(40,'12111','vila melati','P','083124448177','padang',44,'2024-08-07 06:24:43','2024-08-07 06:24:43','11'),
(41,'4332','wira putri','P','083123334566','padang',45,'2024-08-07 06:25:14','2024-08-07 06:25:14','11'),
(42,'23111','yudi setiawan','L','083122223433','padang',46,'2024-08-07 06:26:33','2024-08-07 06:26:33','12');

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenis_buku_id` bigint unsigned NOT NULL,
  `judul_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_isbn` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengarang_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rak_buku_id` bigint unsigned NOT NULL,
  `jumlah_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rak_buku_id` (`rak_buku_id`),
  KEY `jenis_buku_id` (`jenis_buku_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`rak_buku_id`) REFERENCES `rak_bukus` (`id`),
  CONSTRAINT `books_ibfk_2` FOREIGN KEY (`jenis_buku_id`) REFERENCES `jenis_bukus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `books` */

insert  into `books`(`id`,`jenis_buku_id`,`judul_buku`,`no_isbn`,`tahun_terbit`,`penerbit_buku`,`pengarang_buku`,`rak_buku_id`,`jumlah_buku`,`gambar`,`created_at`,`updated_at`) values 
(43,7,'Kimia','9','2021','Grasindo','Sudono',20,'99','DELkE2Q28GOfa3wFVEiRwykmDSPyyUVA4gEqe1D1.jpg','2024-08-07 05:47:21','2024-08-07 05:47:21'),
(44,7,'Fisika','9098-5644-234-90','2021','Grasindo','Suprihanto',20,'99','k3R3LvBQGv0hIZr6E0cyCAfF2B7QJFWubZq1RHiU.jpg','2024-08-07 05:49:13','2024-08-07 05:49:13'),
(45,7,'Biologi','9098-5644-234-70','2021','Grasindo','Nanik',20,'99','p3zqZmPlpnmaBUcn2b3eMmOSvNTGIl44EITQrddM.jpg','2024-08-07 05:50:35','2024-08-07 05:50:35'),
(46,8,'Ekonomi','9786022989417','2016','Erlangga','Rudianto',21,'100','t4iO7ep47IlQmC1M4BBoqMVlL5UUk7P1ORDOUPmv.jpg','2024-08-07 05:52:47','2024-08-07 05:52:47'),
(47,8,'Sejarah','9098-5224-234-99','2020','Petri s','Asril inra',21,'100','gpx21KjXlXfzmVhgVII5I7lcJqGomgg2cblxvrKV.jpg','2024-08-07 05:55:11','2024-08-07 05:55:11'),
(48,8,'Sosiologi','9778-5644-234-99','2021','Grasindo','Agus santosa',21,'100','4MPAE08UUWwDXEpckXCBVOKhP05MV4q3e3bQ2msn.jpg','2024-08-07 05:56:52','2024-08-07 05:56:52'),
(49,9,'B.Indonesia','9098-9944-234-99','2019','Pusat Kurikulum','Soemaryoto',22,'100','lIVcFXRdf4aVocD3wZZWRFjQml6hQyEEeZHYsa0i.jpg','2024-08-07 05:59:14','2024-08-07 05:59:14'),
(50,9,'B.Inggris','9098-5644-23434-99','2021','Grasindo','Aris',22,'100','tVWwJdeejwLVaKWi1owlmCGkQaMtDu5EVxd5irjG.jpg','2024-08-07 06:00:30','2024-08-07 06:00:30'),
(51,10,'Seni Budaya','9098-5224-234-990','2021','Pusat Kurikulum','Agus Budiman',22,'100','x8tFmlr6SEiISrfeUrYbJ9AnBasnrGeDxjojBbJB.jpg','2024-08-07 06:02:50','2024-08-07 06:02:50'),
(52,10,'TIK','9098-5644-234-00','2021','Pusat Kurikulum','Ali Muhson',22,'100','AHWWMESQOs2mYIxQFnf3QYCK7Pp2gWe4xX6lzN64.jpg','2024-08-07 06:04:21','2024-08-07 06:04:21');

/*Table structure for table `detail_peminjaman` */

DROP TABLE IF EXISTS `detail_peminjaman`;

CREATE TABLE `detail_peminjaman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_peminjaman` bigint unsigned NOT NULL,
  `id_buku_pinjam` bigint unsigned DEFAULT NULL,
  `isbn_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_peminjaman_ibfk_1` (`id_peminjaman`),
  KEY `id_buku_pinjam` (`id_buku_pinjam`),
  CONSTRAINT `detail_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`id_buku_pinjam`) REFERENCES `books` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detail_peminjaman` */

insert  into `detail_peminjaman`(`id`,`id_peminjaman`,`id_buku_pinjam`,`isbn_buku`,`judul_buku`,`jumlah_buku`,`status`,`created_at`,`updated_at`) values 
(42,24,43,'9','Kimia','1','0',NULL,NULL),
(43,24,44,'9098-5644-234-90','Fisika','1','0',NULL,NULL),
(44,24,45,'9098-5644-234-70','Biologi','1','0',NULL,NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `jenis_bukus` */

DROP TABLE IF EXISTS `jenis_bukus`;

CREATE TABLE `jenis_bukus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jenis_bukus` */

insert  into `jenis_bukus`(`id`,`name`,`slug`,`created_at`,`updated_at`) values 
(7,'SAINS','sains','2024-07-06 17:10:37','2024-07-16 18:22:40'),
(8,'BIOGRAFI','biografi','2024-07-06 18:17:11','2024-07-16 18:23:02'),
(9,'BAHASA','bahasa','2024-07-16 18:21:24','2024-07-31 08:34:22'),
(10,'NON FIKSI','non-fiksi','2024-07-16 18:23:32','2024-08-07 06:01:46');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(7,'2014_10_12_000000_create_users_table',1),
(8,'2014_10_12_100000_create_password_resets_table',1),
(9,'2019_08_19_000000_create_failed_jobs_table',1),
(10,'2019_12_14_000001_create_personal_access_tokens_table',1),
(11,'2023_05_07_075646_create_jenis_bukus_table',1),
(12,'2023_05_07_132923_add_role_to_users_table',1),
(13,'2023_05_08_042037_create_rak_bukus_table',2),
(14,'2023_05_08_071557_create_books_table',3),
(15,'2023_05_09_071344_create_anggotas_table',4),
(16,'2023_05_09_095331_create_peminjaman_table',5),
(17,'2023_05_09_095628_create_peminjaman_temp_table',5),
(18,'2023_05_09_095703_create_detail_peminjaman_table',5),
(19,'2023_05_11_040142_add_status_to_detail_peminjaman',6),
(20,'2023_05_11_043314_create_pengembalians_table',7),
(21,'2023_05_11_082129_add_tanggal_pengembalian_to_pengembalians',8),
(22,'2023_05_13_121917_add_status_to_detail_peminjaman',9),
(23,'2023_05_14_044852_add_tanggal_pengembalian_to_pengembalians',10),
(24,'2023_05_20_030151_add_jumlah_hari_terlambat_to_pengembalians',11);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_peminjaman` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_anggota_peminjaman` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_anggota_peminjaman` (`id_anggota_peminjaman`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota_peminjaman`) REFERENCES `anggotas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`id`,`kode_peminjaman`,`tgl_pinjam`,`tgl_kembali`,`id_anggota_peminjaman`,`created_at`,`updated_at`) values 
(24,'20240807070119842','2024-08-07','2024-11-07',23,NULL,NULL);

/*Table structure for table `peminjaman_temp` */

DROP TABLE IF EXISTS `peminjaman_temp`;

CREATE TABLE `peminjaman_temp` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `isbn` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `peminjaman_temp` */

/*Table structure for table `pengembalians` */

DROP TABLE IF EXISTS `pengembalians`;

CREATE TABLE `pengembalians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_anggota` bigint unsigned DEFAULT NULL,
  `id_buku` bigint unsigned DEFAULT NULL,
  `qty` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `jumlah_hari_terlambat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denda` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_buku` (`id_buku`),
  CONSTRAINT `pengembalians_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggotas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `pengembalians_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `books` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengembalians` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `rak_bukus` */

DROP TABLE IF EXISTS `rak_bukus`;

CREATE TABLE `rak_bukus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_rak` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_rak` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas_rak` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rak_bukus` */

insert  into `rak_bukus`(`id`,`no_rak`,`nama_rak`,`kapasitas_rak`,`created_at`,`updated_at`) values 
(20,'1','Mawar','100','2024-07-31 08:14:16','2024-07-31 08:15:30'),
(21,'2','Ambun','100','2024-07-31 08:15:01','2024-07-31 08:15:01'),
(22,'3','Anggrek','100','2024-07-31 08:16:01','2024-07-31 08:16:01');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values 
(2,'Admin','admin@gmail.com',NULL,'$2y$10$I5m7r2qBg0znyQ7Cd74zQu2GU/hjTAV4FfcAKuQtnzCZtzlN89Zf2',1,NULL,'2023-05-07 14:00:22','2023-05-07 14:00:22'),
(17,'Anidar','anidar@gmail.com',NULL,'$2y$10$SFurltmeD0Z9czuqOTcb5OhfgMvgdSs4yIpoofBWQSXMWiXb5SAR.',2,NULL,'2024-07-10 04:30:25','2024-07-10 04:30:25'),
(27,'randu roberttwo','randu@gmail.com',NULL,'$2y$10$danL.3dd3UpbtWvji8jMSuMxBMbWIqcwA2igCsUUctJ4PjPTLGDxq',0,NULL,'2024-07-31 08:56:16','2024-08-07 06:05:22'),
(28,'fitri aidil','fitri@gmail.com',NULL,'$2y$10$RhsSxA5ekqKDMfON93iPcOvqI4lLvxkwCcLmWSUiZ7ZxZDJmPQeey',0,NULL,'2024-07-31 09:03:21','2024-08-07 06:05:34'),
(29,'rafi ramadan','rafi@gmail.com',NULL,'$2y$10$.FyXU3mtTbMyWK3EPL7eZOq1n7iUF6yrIMkmGzITEm8gfzeNY/eT.',0,NULL,'2024-07-31 09:04:06','2024-08-07 06:05:46'),
(30,'tiara rahmadani','tiara@gmail.com',NULL,'$2y$10$reKQFGL5AtjoDzwl1.QAD.vD.4CUnhpuE5bPmlxxAZLooKkjFpu5K',0,NULL,'2024-07-31 09:04:30','2024-08-07 06:05:57'),
(31,'Bintang','bintang@gmail.com',NULL,'$2y$10$GiP/V/kdfXMwj8QnBYaZkOmpRauWZrA/BINjf8KAVf5WYa5cnody.',0,NULL,'2024-08-07 06:06:59','2024-08-07 06:06:59'),
(32,'jaya','jaya@gmail.com',NULL,'$2y$10$sVaIe2MpKOt5f14tDAM4Du7UPlV56EIPj9ErVrE7xx5/7mahCR8/q',0,NULL,'2024-08-07 06:07:50','2024-08-07 06:07:50'),
(33,'gita','gita@gmail.com',NULL,'$2y$10$6kp7/WUxzOow9QbmYK1U2ObmwSILcCd.Tu8NIwZFY8nYGRMn5gRUC',0,NULL,'2024-08-07 06:08:17','2024-08-07 06:08:17'),
(34,'hadi','hadi@gmail.com',NULL,'$2y$10$VS0wh4lG8bMh6jgIfeDuIOWIi3.8aw4.V9n8x3tgLUmaZRdPI.Baa',0,NULL,'2024-08-07 06:08:47','2024-08-07 06:08:47'),
(35,'elina','elina@gmail.com',NULL,'$2y$10$ZI380Zna6OsvZtJNFMxKRek9v8xew9qe3tsLVTxlW2ha.3Zx3jbkS',0,NULL,'2024-08-07 06:09:22','2024-08-07 06:09:22'),
(36,'niko','niko@gmail.com',NULL,'$2y$10$lHjvpoVdsG/nq/xuS.8W6uReQ2IEBHSCyZa1Hc4UadNzClD6wI4RW',0,NULL,'2024-08-07 06:09:46','2024-08-07 06:09:46'),
(37,'kinanti','kinanti@gmail.com',NULL,'$2y$10$0RGcGKAsG6W2GPA9e30uYeHhd0mz6NX1uFqRI/WOIxZiJ3E7Z2Agq',0,NULL,'2024-08-07 06:10:17','2024-08-07 06:10:17'),
(38,'zafira','zafira@gmail.com',NULL,'$2y$10$0NtE5rpogdv726RppPyAiuiGBwUyKriKp5W9wkI0u/n7l2Z8E.oVS',0,NULL,'2024-08-07 06:17:52','2024-08-07 06:17:52'),
(39,'putra','putra@gmail.com',NULL,'$2y$10$n25LqPJugk5C3csNQmRPzOdURsestjRAcMAaG3OmIydhjESaWkHnC',0,NULL,'2024-08-07 06:18:22','2024-08-07 06:18:22'),
(40,'rani','rani@gmail.com',NULL,'$2y$10$rIOXo4sCqeLKF6kggDF2D.F36LXVzBYAQUyk783INEgqHs2gHW7fi',0,NULL,'2024-08-07 06:18:45','2024-08-07 06:18:45'),
(41,'satria','satria@gmail.com',NULL,'$2y$10$.oDdOcHMOKlP.CqBvYcgYO6WGbkv9OO2dDDB0Euli.6X2.WXLLU8G',0,NULL,'2024-08-07 06:19:13','2024-08-07 06:19:13'),
(42,'tarik','tarik@gmail.com',NULL,'$2y$10$m7ePqtUVV.69WUOumhFkrO2ybSVX6f7LEkbpjUPD4yezIcl/COS3i',0,NULL,'2024-08-07 06:19:38','2024-08-07 06:19:38'),
(43,'lili','lili@gmail.com',NULL,'$2y$10$7Yx4yOJN.AIlQf6tP1q70.8uu64Mr7UjNLOPyl0M8JurAjSZJFyVK',0,NULL,'2024-08-07 06:19:57','2024-08-07 06:19:57'),
(44,'vina','vina@gmail.com',NULL,'$2y$10$rTkOktHK9OEMDT6GPIXy2eWAvbin6otAvm8Q37CtR8a7pE7fRRgKK',0,NULL,'2024-08-07 06:20:20','2024-08-07 06:20:20'),
(45,'wira','wira@gmail.com',NULL,'$2y$10$NfUf.Kq8x35DVpgVqR6ZVuRpSfJhROoZGE1OR7ecpI9rKQToA7/Su',0,NULL,'2024-08-07 06:20:40','2024-08-07 06:20:40'),
(46,'yudi','yudi@gmail.com',NULL,'$2y$10$I/k5zBBLPUNQr5bzLdif5e9XbCGRQ2tyKAJ4kS01ioMgOVdyyukAC',0,NULL,'2024-08-07 06:25:58','2024-08-07 06:25:58');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
