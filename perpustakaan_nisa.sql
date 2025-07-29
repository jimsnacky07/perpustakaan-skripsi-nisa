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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `anggotas` */

insert  into `anggotas`(`id`,`nisn`,`nama`,`jk`,`no_hp`,`alamat`,`user_id`,`created_at`,`updated_at`,`kelas`) values (34,'2121','randu','P','0768745345','iiut',40,'2025-07-21 08:50:19','2025-07-21 08:50:19','6'),(35,'9090','caca','P','0823456775353','pasaman',41,'2025-07-21 10:45:50','2025-07-21 10:45:50','8'),(36,'3434','rafu hafid elvaco','L','0834234513','pesisir',42,'2025-07-21 15:11:59','2025-07-21 15:11:59','8'),(37,'4444','caca','P','234567876543','dfvcx',43,'2025-07-21 16:14:04','2025-07-21 16:14:04','5'),(38,'5656','mimi','P','08235422','pasang',44,'2025-07-21 16:22:24','2025-07-21 16:22:24','9'),(39,'343466','meme','P','08675433556','padang',45,'2025-07-21 16:35:58','2025-07-21 16:35:58','8'),(40,'89876','cici','P','08788888','lubeg',46,'2025-07-21 16:40:04','2025-07-21 16:40:04','6'),(41,'8888','kaka','L','091234543','gor',47,'2025-07-21 16:51:35','2025-07-21 16:51:35','8'),(42,'2121111','budi','P','08123456543','gor',49,'2025-07-21 17:08:16','2025-07-21 17:08:16','9'),(43,'3333','lulu','P','0867554567','piai',50,'2025-07-21 17:21:30','2025-07-21 17:21:30','8');

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `books` */

insert  into `books`(`id`,`jenis_buku_id`,`judul_buku`,`no_isbn`,`tahun_terbit`,`penerbit_buku`,`pengarang_buku`,`rak_buku_id`,`jumlah_buku`,`gambar`,`created_at`,`updated_at`) values (43,'11','SEJARAH','978-602-453-048-85','2019','grasindo','Adinul','23','49','pcW4Zc0InoDgL8UFHJqNifcGvYOGBbcN5Svbn5GT.jpg','2024-09-22 06:00:47','2024-09-22 06:00:47'),(46,'12','kancil','978-602-453-048-008','2022','atril','fuzan','24','99','GD65XwYPD0i2KxHL2VZbnmHv4PUdvkHauiEw1fiv.jpg','2024-09-23 06:25:07','2024-09-23 06:25:07');

/*Table structure for table `buku_hilangs` */

DROP TABLE IF EXISTS `buku_hilangs`;

CREATE TABLE `buku_hilangs` (
  `judul_buku` varchar(100) NOT NULL,
  `penerbit_buku` varchar(100) NOT NULL,
  `pengarang_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`judul_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `buku_hilangs` */

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jenis_bukus` */

insert  into `jenis_bukus`(`id`,`name`,`slug`,`created_at`,`updated_at`) values (13,'Lara','lara','2025-07-20 04:21:23','2025-07-20 04:21:23');

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

insert  into `peminjaman`(`id`,`kode_peminjaman`,`tgl_pinjam`,`tgl_kembali`,`id_anggota_peminjaman`,`created_at`,`updated_at`) values (27,'20240922060146722','2024-09-22','2024-12-22','29',NULL,NULL),(28,'20240922063412668','2024-09-22','2024-12-22','30',NULL,NULL),(29,'20240923063033342','2024-09-23','2024-12-23','31',NULL,NULL),(30,'20240923063437431','2024-09-23','2024-12-23','29',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `peminjaman_temp` */

insert  into `peminjaman_temp`(`id`,`isbn`,`judul`,`jumlah`,`created_at`,`updated_at`) values (180,'978-602-453-048-85','SEJARAH','8',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values (2,'Admin','admin@gmail.com',NULL,'$2y$10$I5m7r2qBg0znyQ7Cd74zQu2GU/hjTAV4FfcAKuQtnzCZtzlN89Zf2',1,NULL,'2023-05-07 14:00:22','2023-05-07 14:00:22'),(38,'randu','randu@gmail.com',NULL,'$2y$10$yQozoJM.DTI1Omi17bLYS.UUdakkeiJ7Wx/OzBYDUsRi/P0w3lMku',0,NULL,'2025-07-21 08:25:44','2025-07-21 08:25:44'),(40,'rara@gmail.com','rara@gmail.com',NULL,'$2y$10$kZHoC64gGy30FcNwP3i3juTPDnZwgs9GCjWsT9LsRDuKZp2fol64S',0,NULL,'2025-07-21 08:50:18','2025-07-21 08:50:18'),(41,'kutir@gmail.com','kutir@gmail.com',NULL,'$2y$10$KsPu6kxyhefVpowIoAXrYu5J8WfqtVu1wB32EXOmL0qM2jAJDzuba',0,NULL,'2025-07-21 10:45:49','2025-07-21 10:45:49'),(42,'rafu@gmail.com','rafu@gmail.com',NULL,'$2y$10$yNOiHkD6k0nC5H7xL8g7.OzOLqMLWbkhWwMNzQ7QB/YrrDO4YBwue',0,NULL,'2025-07-21 15:11:58','2025-07-21 15:11:58'),(43,'caca@gmail.com','caca@gmail.com',NULL,'$2y$10$HgGyX9O4hCe8xUpm6oFbT.2yL8bzyaJcyyLDpKQALmA2Idnw8VQU.',0,NULL,'2025-07-21 16:14:03','2025-07-21 16:14:03'),(44,'mimgmail.com','mimi@gmail.com',NULL,'$2y$10$MLzW2Zs2hXk1wQQFpvzZ8u7WRmVcn5ux6tzoqlERNTVTonwJIt23W',0,NULL,'2025-07-21 16:22:24','2025-07-21 16:22:24'),(45,'meme@gmail.com','meme@gmal.com',NULL,'$2y$10$.9ztFH7xePI7b6REnJww6OrPe2ZgrTi9.JFne4QrfduKckyKktCi.',0,NULL,'2025-07-21 16:35:58','2025-07-21 16:35:58'),(46,'cici@gmail.com','cici@gmail.com',NULL,'$2y$10$Wwp6Iez7HDuIFYXp8JxYNOM7tTPk4oaCzYam2eBBaCzpPefcliDXS',0,NULL,'2025-07-21 16:40:04','2025-07-21 16:40:04'),(47,'kaka@gmail.com','kaka@gmail.com',NULL,'$2y$10$ByKHiz4KJZfyJakdmoCFB.GioGOClykMe5g0NLP4PyHTuEODDw2GK',0,NULL,'2025-07-21 16:51:35','2025-07-21 16:51:35'),(49,'admin@gmail.com','budi@gmail.com',NULL,'$2y$10$y.ZDuIvOeHrU1lvuEmSi8uvYahdbOK5yinO0RQ0536RSyKPpBgvsS',0,NULL,'2025-07-21 17:08:16','2025-07-21 17:08:16'),(50,'lulu@gmail.com','lulu@gmail.com',NULL,'$2y$10$ewJ5PibeY8Yjv/2oZOIKX.scvRef221jba1dKDByikZ5IinGVcChq',0,NULL,'2025-07-21 17:21:30','2025-07-21 17:21:30');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
