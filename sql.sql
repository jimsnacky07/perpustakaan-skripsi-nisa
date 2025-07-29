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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `anggotas` */

insert  into `anggotas`(`id`,`nisn`,`nama`,`jk`,`no_hp`,`alamat`,`user_id`,`created_at`,`updated_at`,`kelas`) values (23,'121211','Randu Rb','L','083124441661','Padang',27,'2024-07-31 08:58:18','2024-07-31 08:58:18','10'),(24,'2321','fitri rahma','P','087566667655','Damar',28,'2024-07-31 09:06:37','2024-07-31 09:06:37','11'),(25,'23211','rafi putra','L','08676665445','purus',29,'2024-07-31 09:07:24','2024-07-31 09:07:24','12'),(26,'123421','tiara lubis','P','087677776444','Lubeg',30,'2024-07-31 09:08:42','2024-07-31 09:08:42','11');

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `books` */

insert  into `books`(`id`,`jenis_buku_id`,`judul_buku`,`no_isbn`,`tahun_terbit`,`penerbit_buku`,`pengarang_buku`,`rak_buku_id`,`jumlah_buku`,`gambar`,`created_at`,`updated_at`) values (29,'7','Biologi','978-602-277-683-3','2021','Yrama','Widya','15','142','349ejlYVP8lB259eEhXSC0HOCiE4j4pR67PEvNlC.jpg','2024-07-17 16:54:36','2024-07-17 16:54:36'),(35,'7','KIMIA','978-602-453-048-8','2023','Arif','Adinul','20','99','e9tBLQcs3PRNEpTIsoaEvjiWTomzsTvhtVbWwS5J.jpg','2024-07-31 08:38:53','2024-07-31 08:38:53'),(36,'7','Fisika','978-602-453-048-0','2023','Fajar','Dani','20','99','x91Sj6fVq5IPcT5Mv3ZtUzQpnAubRZdOpmKlJwN8.jpg','2024-07-31 08:41:20','2024-07-31 08:41:20'),(37,'7','Biologi','978-602-453-048-99','2023','Krismanto','Nanik','21','100','Bn54Fu0Qss0sJi9hhpKnwWA3eE9qTA7qksEFaYT7.jpg','2024-07-31 08:42:52','2024-07-31 08:42:52'),(38,'8','SEJARAH','978-602-453-048-898','2020','Asril','Sumanto','22','99','jor9aCKNVdyL3yJPK4LYpch30BJ0gFgqRSOPdqcy.jpg','2024-07-31 08:45:13','2024-07-31 08:45:13'),(39,'8','SOSIOLOGI','978-602-453-048-008','2022','Santosa','Retno','21','99','RJZ9kH7B0JI71dHFINefD5AEUS5XPQKYCOGh2MTz.jpg','2024-07-31 08:47:40','2024-07-31 08:47:40'),(40,'8','EKONOMI','978-602-453-048-064','2023','Kinanti','Nella','21','100','9Hx3aPRSfKgIMOIQa5Tz0UEn64RFD2YQErtkUsWm.jpg','2024-07-31 08:49:55','2024-07-31 08:49:55'),(41,'9','B.Indonesia','978-602-453-048-85','2023','Irwan','Asril','21','98','pZryBIIaX8V6ZX66D2vgQfi49JAvm0hcT03NrJDc.jpg','2024-07-31 08:53:12','2024-07-31 08:53:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detail_peminjaman` */

insert  into `detail_peminjaman`(`id`,`id_peminjaman`,`id_buku_pinjam`,`isbn_buku`,`judul_buku`,`jumlah_buku`,`status`,`created_at`,`updated_at`) values (1,1,'20','ISBN89839723','IPS','1','1',NULL,NULL),(2,2,'20','ISBN89839723','IPS','1','0',NULL,NULL),(3,3,'20','ISBN89839723','IPS','1','2',NULL,NULL),(4,2,'23','982-602-382-531-9','Fisika','1','1',NULL,NULL),(5,2,'22','978-602-382-531-8','Sejarah','1','1',NULL,NULL),(6,4,'23','982-602-382-531-9','Fisika','1','2',NULL,NULL),(7,4,'22','978-602-382-531-8','Sejarah','1','2',NULL,NULL),(8,5,'25','089-978-086','SAINS','1','2',NULL,NULL),(9,6,'26','675-654-76-665','SENI RUPA MODEREN','1','2',NULL,NULL),(10,7,'29','978-602-277-683-3','Biologi','1','1',NULL,NULL),(11,8,'30','0987-087-123-56','Planet Luna','1','1',NULL,NULL),(12,8,'26','675-654-76-665','SENI RUPA MODEREN','1','0',NULL,NULL),(13,8,'29','978-602-277-683-3','Biologi','1','0',NULL,NULL),(14,9,'26','675-654-76-665','SENI RUPA MODEREN','1','2',NULL,NULL),(15,9,'28','978-602-453-048-8','Hakikat&Urgensi','1','2',NULL,NULL),(16,9,'26','675-654-76-665','SENI RUPA MODEREN','1','2',NULL,NULL),(17,14,'26','675-654-76-665','SENI RUPA MODEREN','1','2',NULL,NULL),(18,14,'28','978-602-453-048-8','Hakikat&Urgensi','1','2',NULL,NULL),(19,14,'29','978-602-277-683-3','Biologi','1','2',NULL,NULL),(20,15,'28','978-602-453-048-8','Hakikat&Urgensi','10','1',NULL,NULL),(21,15,'26','675-654-76-665','SENI RUPA MODEREN','1','0',NULL,NULL),(22,15,'31','0987-087-88','Rumah Teteh','1','1',NULL,NULL),(23,16,'26','675-654-76-665','SENI RUPA MODEREN','1','0',NULL,NULL),(24,16,'28','978-602-453-048-8','Hakikat&Urgensi','1','0',NULL,NULL),(25,16,'29','978-602-277-683-3','Biologi','1','0',NULL,NULL),(26,17,'29','978-602-277-683-3','Biologi','1','0',NULL,NULL),(27,18,'26','675-654-76-665','SENI RUPA MODEREN','1','0',NULL,NULL),(28,18,'28','978-602-453-048-8','Hakikat&Urgensi','1','0',NULL,NULL),(29,18,'29','978-602-277-683-3','Biologi','1','0',NULL,NULL),(30,19,'26','675-654-76-665','SENI RUPA MODEREN','1','0',NULL,NULL),(31,19,'28','978-602-453-048-8','Hakikat&Urgensi','1','2',NULL,NULL),(32,19,'29','978-602-277-683-3','Biologi','1','2',NULL,NULL),(33,20,'29','978-602-277-683-3','Biologi','1','0',NULL,NULL),(34,20,'35','978-602-453-048-8','KIMIA','1','0',NULL,NULL),(35,20,'38','978-602-453-048-898','SEJARAH','1','0',NULL,NULL),(36,21,'29','978-602-277-683-3','Biologi','1','0',NULL,NULL),(37,22,'41','978-602-453-048-85','B.Indonesia','1','0',NULL,NULL),(38,23,'42','978-602-453-048-5','B.Inggris','1','0',NULL,NULL),(39,23,'39','978-602-453-048-008','SOSIOLOGI','1','0',NULL,NULL),(40,23,'41','978-602-453-048-85','B.Indonesia','1','0',NULL,NULL),(41,21,'36','978-602-453-048-0','Fisika','1','2',NULL,NULL);

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

insert  into `jenis_bukus`(`id`,`name`,`slug`,`created_at`,`updated_at`) values (7,'SAINS','sains','2024-07-06 17:10:37','2024-07-16 18:22:40'),(8,'BIOGRAFI','biografi','2024-07-06 18:17:11','2024-07-16 18:23:02'),(9,'BAHASA','bahasa','2024-07-16 18:21:24','2024-07-31 08:34:22'),(10,'FIKSI','fiksi','2024-07-16 18:23:32','2024-07-16 18:23:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`id`,`kode_peminjaman`,`tgl_pinjam`,`tgl_kembali`,`id_anggota_peminjaman`,`created_at`,`updated_at`) values (1,'20240706174534679','2024-07-06','2024-10-06','12',NULL,NULL),(2,'20240710024559372','2024-07-10','2024-10-10','12',NULL,NULL),(3,'20240710033425586','2024-07-10','2024-10-10','13',NULL,NULL),(4,'20240715070609193','2024-07-15','2024-10-15','12',NULL,NULL),(5,'20240716171816940','2024-07-16','2024-10-16','12',NULL,NULL),(6,'20240717101615416','2024-07-17','2024-10-17','12',NULL,NULL),(7,'20240717173256448','2024-07-17','2024-10-17','15',NULL,NULL),(8,'2024071717573231','2024-07-17','2024-10-17','16',NULL,NULL),(9,'20240719153015592','2024-07-19','2024-10-19','15',NULL,NULL),(10,'20240721181130583','2024-07-21','2024-10-21','15',NULL,NULL),(11,'20240721182200844','2024-07-21','2024-10-21','15',NULL,NULL),(12,'20240721194357334','2024-07-21','2024-10-21','15',NULL,NULL),(13,'2024072119485294','2024-07-21','2024-10-21','15',NULL,NULL),(14,'20240728132936959','2024-07-28','2024-10-28','18',NULL,NULL),(15,'20240728181919629','2024-07-28','2024-10-28','19',NULL,NULL),(16,'20240728190908876','2024-07-28','2024-10-28','20',NULL,NULL),(17,'20240729081536623','2024-07-29','2024-10-29','19',NULL,NULL),(18,'202407290825477','2024-07-29','2024-10-29','21',NULL,NULL),(19,'20240731032437602','2024-07-31','2024-12-11','22',NULL,NULL),(20,'20240731085946898','2024-07-31','2024-10-31','23',NULL,NULL),(21,'20240731091018208','2024-07-31','2024-10-31','24',NULL,NULL),(22,'20240731091114957','2024-07-31','2024-10-31','26',NULL,NULL),(23,'20240731092205333','2024-07-31','2024-10-31','25',NULL,NULL);

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
  `id_anggota` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_buku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `jumlah_hari_terlambat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denda` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengembalians` */

insert  into `pengembalians`(`id`,`id_anggota`,`id_buku`,`qty`,`tanggal_pengembalian`,`jumlah_hari_terlambat`,`denda`,`created_at`,`updated_at`) values (1,'12','20','1','2024-07-06','0','0',NULL,NULL),(2,'12','23','1','2024-07-10','0','0',NULL,NULL),(3,'12','22','1','2024-07-10','0','0',NULL,NULL),(4,'15','29','1','2024-07-17','0','0',NULL,NULL),(5,'16','30','1','2024-07-21','0','0',NULL,NULL),(6,'19','28','10','2024-07-28','0','0',NULL,NULL),(7,'19','31','1','2024-07-29','10','0',NULL,NULL);

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

insert  into `rak_bukus`(`id`,`no_rak`,`nama_rak`,`kapasitas_rak`,`created_at`,`updated_at`) values (20,'1','Mawar','100','2024-07-31 08:14:16','2024-07-31 08:15:30'),(21,'2','Ambun','100','2024-07-31 08:15:01','2024-07-31 08:15:01'),(22,'3','Anggrek','100','2024-07-31 08:16:01','2024-07-31 08:16:01');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values (2,'Admin','admin@gmail.com',NULL,'$2y$10$I5m7r2qBg0znyQ7Cd74zQu2GU/hjTAV4FfcAKuQtnzCZtzlN89Zf2',1,NULL,'2023-05-07 14:00:22','2023-05-07 14:00:22'),(17,'Anidar','anidar@gmail.com',NULL,'$2y$10$SFurltmeD0Z9czuqOTcb5OhfgMvgdSs4yIpoofBWQSXMWiXb5SAR.',2,NULL,'2024-07-10 04:30:25','2024-07-10 04:30:25'),(27,'randu','randu@gmail.com',NULL,'$2y$10$danL.3dd3UpbtWvji8jMSuMxBMbWIqcwA2igCsUUctJ4PjPTLGDxq',0,NULL,'2024-07-31 08:56:16','2024-07-31 08:56:16'),(28,'fitri','fitri@gmail.com',NULL,'$2y$10$RhsSxA5ekqKDMfON93iPcOvqI4lLvxkwCcLmWSUiZ7ZxZDJmPQeey',0,NULL,'2024-07-31 09:03:21','2024-07-31 09:03:21'),(29,'rafi','rafi@gmail.com',NULL,'$2y$10$.FyXU3mtTbMyWK3EPL7eZOq1n7iUF6yrIMkmGzITEm8gfzeNY/eT.',0,NULL,'2024-07-31 09:04:06','2024-07-31 09:04:06'),(30,'tiara','tiara@gmail.com',NULL,'$2y$10$reKQFGL5AtjoDzwl1.QAD.vD.4CUnhpuE5bPmlxxAZLooKkjFpu5K',0,NULL,'2024-07-31 09:04:30','2024-07-31 09:04:30');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
