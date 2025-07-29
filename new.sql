/*
SQLyog Ultimate v11.11 (64 bit)
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `anggotas` */

insert  into `anggotas`(`id`,`nisn`,`nama`,`jk`,`no_hp`,`alamat`,`user_id`,`created_at`,`updated_at`,`kelas`) values (29,'2020','Tiara','P','083124441661','Padang',33,'2024-09-22 05:54:29','2024-09-22 05:54:29','10'),(30,'2021','Randu','L','087566667655','Lubeg',34,'2024-09-22 06:32:56','2024-09-22 06:32:56','10'),(31,'20212','asril','L','085643234571','purus',35,'2024-09-23 06:29:43','2024-09-23 06:29:43','10');

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenis_buku_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_isbn` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengarang_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rak_buku_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `books` */

insert  into `books`(`id`,`jenis_buku_id`,`judul_buku`,`no_isbn`,`tahun_terbit`,`penerbit_buku`,`pengarang_buku`,`rak_buku_id`,`jumlah_buku`,`gambar`,`created_at`,`updated_at`) values (43,'11','SEJARAH','978-602-453-048-85','2019','grasindo','Adinul','23','49','pcW4Zc0InoDgL8UFHJqNifcGvYOGBbcN5Svbn5GT.jpg','2024-09-22 06:00:47','2024-09-22 06:00:47'),(44,'11','KIMIA','978-602-453-048-064','2023','Santosa','Retno','23','100','7kY1PZF7MQN18mqdqdIZ6iFTYsSugCAsjCEbgTLl.jpg','2024-09-23 06:22:20','2024-09-23 06:22:20'),(45,'11','Biologi','978-602-453-048-064','2022','adinul','fajri','23','100','9DiIo1t1vyfSuPSytC6yqF01aktxGT4JLl1VdgIF.jpg','2024-09-23 06:23:55','2024-09-23 06:23:55'),(46,'12','kancil','978-602-453-048-008','2022','atril','fuzan','24','98','GD65XwYPD0i2KxHL2VZbnmHv4PUdvkHauiEw1fiv.jpg','2024-09-23 06:25:07','2024-09-23 06:25:07'),(47,'12','Laut Bercerita','978-602-453-048-008','2023','gramedia','leila','24','97','nfanZjFquAscZGeP6nmwZINjbJBYiHA7GfBNyhgJ.jpg','2024-09-23 06:27:21','2024-09-23 06:27:21');

/*Table structure for table `buku_hilangs` */

DROP TABLE IF EXISTS `buku_hilangs`;

CREATE TABLE `buku_hilangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul_buku` varchar(191) NOT NULL,
  `penulis_buku` varchar(191) NOT NULL,
  `penerbit_buku` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `buku_hilangs` */

insert  into `buku_hilangs`(`id`,`judul_buku`,`penulis_buku`,`penerbit_buku`,`created_at`,`updated_at`) values (1,'sejarah','l','ahmad','2024-09-22 15:17:43','2024-09-22 12:15:25');

/*Table structure for table `buku_rusaks` */

DROP TABLE IF EXISTS `buku_rusaks`;

CREATE TABLE `buku_rusaks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul_buku` varchar(100) NOT NULL,
  `penulis_buku` varchar(100) NOT NULL,
  `penerbit_buku` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `buku_rusaks` */

insert  into `buku_rusaks`(`id`,`judul_buku`,`penulis_buku`,`penerbit_buku`,`created_at`,`updated_at`) values (1,'sejarah','ahmad','rudi','2024-09-23 12:06:38',NULL);

/*Table structure for table `denda_bukus` */

DROP TABLE IF EXISTS `denda_bukus`;

CREATE TABLE `denda_bukus` (
  `id` bigint NOT NULL,
  `judul_buku` varchar(100) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `jenis_buku` varchar(100) DEFAULT NULL,
  `denda` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `denda_bukus` */

/*Table structure for table `detail_peminjaman` */

DROP TABLE IF EXISTS `detail_peminjaman`;

CREATE TABLE `detail_peminjaman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int NOT NULL,
  `id_buku_pinjam` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detail_peminjaman` */

insert  into `detail_peminjaman`(`id`,`id_peminjaman`,`id_buku_pinjam`,`isbn_buku`,`judul_buku`,`jumlah_buku`,`status`,`created_at`,`updated_at`) values (52,31,'47','978-602-453-048-008','Laut Bercerita','1','1',NULL,NULL),(53,31,'46','978-602-453-048-008','kancil','1','0',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jenis_bukus` */

insert  into `jenis_bukus`(`id`,`name`,`slug`,`created_at`,`updated_at`) values (11,'Pelajaran','pelajaran','2024-09-22 05:55:06','2024-09-22 05:55:06'),(12,'Fiksi','fiksi','2024-09-22 05:55:21','2024-09-22 05:55:21');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (7,'2014_10_12_000000_create_users_table',1),(8,'2014_10_12_100000_create_password_resets_table',1),(9,'2019_08_19_000000_create_failed_jobs_table',1),(10,'2019_12_14_000001_create_personal_access_tokens_table',1),(11,'2023_05_07_075646_create_jenis_bukus_table',1),(12,'2023_05_07_132923_add_role_to_users_table',1),(13,'2023_05_08_042037_create_rak_bukus_table',2),(14,'2023_05_08_071557_create_books_table',3),(15,'2023_05_09_071344_create_anggotas_table',4),(16,'2023_05_09_095331_create_peminjaman_table',5),(17,'2023_05_09_095628_create_peminjaman_temp_table',5),(18,'2023_05_09_095703_create_detail_peminjaman_table',5),(19,'2023_05_11_040142_add_status_to_detail_peminjaman',6),(20,'2023_05_11_043314_create_pengembalians_table',7),(21,'2023_05_11_082129_add_tanggal_pengembalian_to_pengembalians',8),(22,'2023_05_13_121917_add_status_to_detail_peminjaman',9),(23,'2023_05_14_044852_add_tanggal_pengembalian_to_pengembalians',10),(24,'2023_05_20_030151_add_jumlah_hari_terlambat_to_pengembalians',11);

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
  `id_anggota_peminjaman` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`id`,`kode_peminjaman`,`tgl_pinjam`,`tgl_kembali`,`id_anggota_peminjaman`,`created_at`,`updated_at`) values (27,'20240922060146722','2024-09-22','2024-12-22','29',NULL,NULL),(28,'20240922063412668','2024-09-22','2024-12-22','30',NULL,NULL),(29,'20240923063033342','2024-09-23','2024-12-23','31',NULL,NULL),(30,'20240923063437431','2024-09-23','2024-12-23','29',NULL,NULL),(31,'20240924064514289','2024-09-24','2024-12-24','30',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `peminjaman_temp` */

/*Table structure for table `pengembalians` */

DROP TABLE IF EXISTS `pengembalians`;

CREATE TABLE `pengembalians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_anggota` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `jumlah_hari_terlambat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denda` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengembalians` */

insert  into `pengembalians`(`id`,`id_anggota`,`id_buku`,`qty`,`tanggal_pengembalian`,`jumlah_hari_terlambat`,`denda`,`created_at`,`updated_at`) values (13,'30','47','1','2024-09-24','0','0',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rak_bukus` */

insert  into `rak_bukus`(`id`,`no_rak`,`nama_rak`,`kapasitas_rak`,`created_at`,`updated_at`) values (23,'1','Mawar','100','2024-09-22 05:56:16','2024-09-22 05:56:16'),(24,'2','Melati','100','2024-09-22 05:56:32','2024-09-22 05:56:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values (2,'Admin','admin@gmail.com',NULL,'$2y$10$I5m7r2qBg0znyQ7Cd74zQu2GU/hjTAV4FfcAKuQtnzCZtzlN89Zf2',1,NULL,'2023-05-07 14:00:22','2023-05-07 14:00:22'),(33,'tiara','tiara@gmail.com',NULL,'$2y$10$XRtci.4g540/loQgXWTevOm/35SnvoghI6KYUYL2DT9qN2aimUREK',0,NULL,'2024-09-22 05:53:00','2024-09-22 05:53:00'),(34,'randu','randu@gmail.com',NULL,'$2y$10$SVV1OGha.j6FApRXZ6i5A.R25XUL312ZU1pE.4.KPbLSsoRuVMfkS',0,NULL,'2024-09-22 06:32:07','2024-09-22 06:32:07'),(35,'asril','asril@gmail.com',NULL,'$2y$10$BSqv38SxqoSjW13CMwyEWep6rX/MFR3eI3w6H8NOqxiLFnMtpJLx.',0,NULL,'2024-09-23 06:28:16','2024-09-23 06:28:16');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
