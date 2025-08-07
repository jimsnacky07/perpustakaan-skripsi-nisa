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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `anggotas` */

insert  into `anggotas`(`id`,`nisn`,`nama`,`jk`,`no_hp`,`alamat`,`user_id`,`created_at`,`updated_at`,`kelas`) values 
(44,'1212111','nisa','P','0984345','padang',51,'2025-08-05 04:07:14','2025-08-05 04:07:14','7'),
(46,'21211','sinta','P','081234567','purus',53,'2025-08-05 04:36:13','2025-08-05 04:36:13','8'),
(47,'676544','ragil','L','0845678','purus',54,'2025-08-05 06:33:35','2025-08-05 06:33:35','8'),
(48,'74332634','juju','P','2425465775','pasbar',56,'2025-08-05 07:40:37','2025-08-05 07:40:37','8'),
(50,'2220027','Yudha Bima Sakti','L','081234567890','Padang',58,'2025-08-05 17:19:07','2025-08-05 17:21:29','10'),
(51,'2110001','Tya Putri','P','083156473898','JL. Bandar Buat',59,'2025-08-06 06:31:34','2025-08-06 06:31:34','7'),
(52,'2110002','Herlina Efendi','P','083142637723','duri',60,'2025-08-06 08:04:53','2025-08-06 08:04:53','8'),
(53,'210004','Tasya Putri','P','087635643','bungus',62,'2025-08-07 05:30:09','2025-08-07 05:30:09','8');

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `books` */

insert  into `books`(`id`,`jenis_buku_id`,`judul_buku`,`no_isbn`,`tahun_terbit`,`penerbit_buku`,`pengarang_buku`,`rak_buku_id`,`jumlah_buku`,`gambar`,`created_at`,`updated_at`) values 
(50,'15','IPA','987-6546-764','2025','Grasindo','Ahmad Sabirin','23','48','CwU9x2x4J3rCoqetPpC1bq2wCAtW6KzO1WrLi6a7.jpg','2025-08-05 06:36:16','2025-08-05 06:36:16'),
(51,'15','sejarah','9789790251977','2006','Grasindo','Dr.Nana Nurliani','23','99','hoQvaZrdQDXHLfTB2TbVeoIc6V5Izrd7Ieo6fVFK.jpg','2025-08-05 06:49:16','2025-08-05 06:49:16'),
(52,'14','Laskar Pelangi','9786297561066','2005','JT Books','Andrea Hirata','24','49','wj7dDI7cAmR5od8z3f9Egkw5yNpcVQYysTLGoSXi.jpg','2025-08-05 06:51:09','2025-08-05 06:51:09'),
(53,'15','Kugapai Cintamu','9786020340135','1974','Gramedia Pustaka Utama','Ashadi Siregar','23','100','vLWivbcJ0hIviZQsi66KwzxuklChk4WNhObrFhI7.jpg','2025-08-05 06:53:56','2025-08-05 06:53:56'),
(54,'16','Bumi Manusia','98767-09978--99','2022','Grasindo','Clara','25','50','HBucufb31ROI9F9LHagWtau9cVSs6aBmFzXuSkN5.jpg','2025-08-05 17:17:19','2025-08-05 17:17:47'),
(55,'17','Cara Ngoding Dengan AI','2352-1523-21412-1','2025','Gramedia','Lukas','25','102','KzPJYcfTYfLqVacTBYx3VadIzpBcwHajSsGTTVhC.png','2025-08-07 14:13:09','2025-08-07 14:14:33');

/*Table structure for table `buku_hilangs` */

DROP TABLE IF EXISTS `buku_hilangs`;

CREATE TABLE `buku_hilangs` (
  `judul_buku` varchar(100) NOT NULL,
  `penerbit_buku` varchar(100) NOT NULL,
  `pengarang_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `book_id` bigint DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`judul_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `buku_hilangs` */

insert  into `buku_hilangs`(`judul_buku`,`penerbit_buku`,`pengarang_buku`,`book_id`,`keterangan`,`created_at`,`updated_at`) values 
('IPA','Grasindo','Ahmad Sabirin',50,'Coba 1','2025-08-07 14:01:01','2025-08-07 14:01:01');

/*Table structure for table `buku_rusaks` */

DROP TABLE IF EXISTS `buku_rusaks`;

CREATE TABLE `buku_rusaks` (
  `judulbuku` varchar(100) NOT NULL,
  `jumlahrusak` int DEFAULT NULL,
  `penyebab` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`judulbuku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `buku_rusaks` */

insert  into `buku_rusaks`(`judulbuku`,`jumlahrusak`,`penyebab`,`keterangan`,`created_at`,`updated_at`) values 
('IPA',5,'basah','oke','2025-08-05 04:33:46','2025-08-05 04:33:46'),
('laskar pelangi',1,'robek','oke','2025-08-05 07:47:29','2025-08-05 07:47:29');

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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detail_peminjaman` */

insert  into `detail_peminjaman`(`id`,`id_peminjaman`,`id_buku_pinjam`,`isbn_buku`,`judul_buku`,`jumlah_buku`,`status`,`created_at`,`updated_at`) values 
(56,34,'50','987-6546-764','IPA','1','1',NULL,NULL),
(57,35,'51','9789790251977','sejarah','1','1',NULL,NULL),
(58,35,'52','9786297561066','Laskar Pelangi','1','1',NULL,NULL),
(59,35,'50','987-6546-764','IPA','1','0',NULL,NULL),
(60,36,'50','987-6546-764','IPA','1','0',NULL,NULL),
(61,36,'51','9789790251977','sejarah','1','0',NULL,NULL),
(62,36,'52','9786297561066','Laskar Pelangi','1','0',NULL,NULL),
(63,37,'50','987-6546-764','IPA','1','1',NULL,NULL),
(65,39,'55','2352-1523-21412-1','Cara Ngoding Dengan AI','1','1',NULL,NULL),
(66,40,'55','2352-1523-21412-1','Cara Ngoding Dengan AI','1','1',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jenis_bukus` */

insert  into `jenis_bukus`(`id`,`name`,`slug`,`created_at`,`updated_at`) values 
(14,'Fiksi','fiksi','2025-08-05 06:34:57','2025-08-05 06:34:57'),
(15,'Non Fiksi','non-fiksi','2025-08-05 06:35:06','2025-08-05 06:35:06'),
(16,'Budaya','budaya','2025-08-05 15:45:14','2025-08-05 15:45:25'),
(17,'Pendidikan','pendidikan','2025-08-07 05:41:20','2025-08-07 05:41:20');

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
  `id_anggota_peminjaman` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`id`,`kode_peminjaman`,`tgl_pinjam`,`tgl_kembali`,`id_anggota_peminjaman`,`created_at`,`updated_at`) values 
(40,'2025080716130088','2025-08-07','2025-11-07','50',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengembalians` */

insert  into `pengembalians`(`id`,`id_anggota`,`id_buku`,`qty`,`tanggal_pengembalian`,`jumlah_hari_terlambat`,`denda`,`created_at`,`updated_at`) values 
(20,'50','55','1','2025-08-07','0','0','2025-08-07 16:13:17','2025-08-07 16:13:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rak_bukus` */

insert  into `rak_bukus`(`id`,`no_rak`,`nama_rak`,`kapasitas_rak`,`created_at`,`updated_at`) values 
(23,'1','Mawar','100','2024-09-22 05:56:16','2024-09-22 05:56:16'),
(24,'2','Melati','100','2024-09-22 05:56:32','2024-09-22 05:56:32'),
(25,'3','Lavender','100','2025-08-05 17:16:16','2025-08-05 17:16:33');

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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values 
(2,'Admin','admin@gmail.com',NULL,'$2y$10$I5m7r2qBg0znyQ7Cd74zQu2GU/hjTAV4FfcAKuQtnzCZtzlN89Zf2',1,NULL,'2023-05-07 14:00:22','2023-05-07 14:00:22'),
(38,'randu','randu@gmail.com',NULL,'$2y$10$yQozoJM.DTI1Omi17bLYS.UUdakkeiJ7Wx/OzBYDUsRi/P0w3lMku',0,NULL,'2025-07-21 08:25:44','2025-07-21 08:25:44'),
(51,'nisa@gmail.com','nisa@gmail.com',NULL,'$2y$10$c0.Rvi5TiFbrm7a3pUkQEuXG.tFbdLy4BWqvoFAHL86SE6kkButlm',0,NULL,'2025-08-05 04:07:14','2025-08-05 04:07:14'),
(52,'rafu@gmail.com','rafu@gmail.com',NULL,'$2y$10$zCWVW6wAryW7hH2xOSFYO.83fVuXsal6kmGkRGlGjLccKuDaAkeQO',0,NULL,'2025-08-05 04:10:38','2025-08-05 04:10:38'),
(53,'sinta@gmail.com','sinta@gmail.com',NULL,'$2y$10$Jv3bWMUsZfjJuKBpNtLXpODH5gBWGGEafm8ObcRNcwGKJeCWYdfW2',0,NULL,'2025-08-05 04:36:13','2025-08-05 04:36:13'),
(54,'ragil@gmail.com','ragil@gmail.com',NULL,'$2y$10$VYzt/y9Sc5il7Gq9glkSHO/.hsRzyQiEaG2hUgyyCGG4kiLYP0abu',0,NULL,'2025-08-05 06:33:35','2025-08-05 06:33:35'),
(55,'randi@gmail.com','randi@gmail.com',NULL,'$2y$10$EfuA6FM7k5XygI1QZmXFaet1dtDBf/5hoPCFuvSXQxqndammPetlq',2,NULL,'2025-08-05 06:57:40','2025-08-05 06:57:40'),
(56,'juju@gmail.com','juju@gmail.com',NULL,'$2y$10$1Cs4kp1t5ECuQ5g5./73ZepPIVg2yysHFRcJAip.st2s0K82qYA8a',0,NULL,'2025-08-05 07:40:37','2025-08-05 07:40:37'),
(58,'Yudha Bima Sakti','yudha@gmail.com',NULL,'$2y$10$/hxWrnLxyFN4I57jyY0m5uyMCKyp1RWicP2icGhqm0iIQfzWz5Ode',0,NULL,'2025-08-05 15:44:18','2025-08-05 17:18:28'),
(59,'tya@gmail.com','tya@gmail.com',NULL,'$2y$10$GkAeJgh.MQdYP4PhMYYXY.KrSsrZnu3BX2JTe8njgrzYwt/TZnXQS',0,NULL,'2025-08-06 06:31:34','2025-08-06 06:31:34'),
(60,'Herlina@gmail.com','Herlina@gmail.com',NULL,'$2y$10$q/JXpbARi0dWAlenMnGpUOZtm7dSijF5BFCMyJsFUsfnnTNvG10b6',0,NULL,'2025-08-06 08:04:53','2025-08-06 08:04:53'),
(61,'Bima Putra','BimaPutra@gmail.com',NULL,'$2y$10$gr23lLHsUGWrDAfQMUFxBuLtvyeqpdanc4xQYkjZxNBGILq7O2MQi',2,NULL,'2025-08-06 08:10:25','2025-08-06 08:10:25'),
(62,'tasya@gmail.com','tasya@gmail.com',NULL,'$2y$10$TkgdMUg0INjy6rcMAj8IyeRz8BKZQoDvuVkCpp.XjpmIlqzNsoaXO',0,NULL,'2025-08-07 05:30:09','2025-08-07 05:30:09');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
