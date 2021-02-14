-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2021 at 05:51 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `name_en`, `code`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'មង្គលបូរី', 'Mungkul Borey', '0102', 1, NULL, NULL),
(2, 'ភ្នំស្រុក', 'Phnum Srok', '0103', 1, NULL, NULL),
(3, 'ព្រះនេត្រព្រះ', 'Preah Netr Preah', '0104', 1, NULL, NULL),
(4, 'អូរជ្រៅ', 'Ou Chrov', '0105', 1, NULL, NULL),
(5, 'សិរីសោភ័ណ', 'Serey Sophorn', '0106', 1, NULL, NULL),
(6, 'ថ្មពួក', 'Thma Puok', '0107', 1, NULL, NULL),
(7, 'ស្វាយចេក', 'Svay Chek', '0108', 1, NULL, NULL),
(8, 'ម៉ាឡៃ', 'Malai', '0109', 1, NULL, NULL),
(9, 'បាណន់', 'Banan', '0201', 2, NULL, NULL),
(10, 'ថ្មគោល', 'Thmor Koul', '0202', 2, NULL, NULL),
(11, 'បវេល', 'Bavel', '0204', 2, NULL, NULL),
(12, 'ឯកភ្នំ', 'Aek Phnum', '0205', 2, NULL, NULL),
(13, 'មោងឫស្សី', 'Maung Russey', '0206', 2, NULL, NULL),
(14, 'រុក្ខគីរី', 'Rukhakiri', '0214', 2, NULL, NULL),
(15, 'រតនមណ្ឌល', 'Ratanak Mondul', '0207', 2, NULL, NULL),
(16, 'សង្កែ', 'Sangke', '0208', 2, NULL, NULL),
(17, 'សំឡូត', 'Samlaut', '0209', 2, NULL, NULL),
(18, 'សំពៅលូន', 'Sampov Loun', '0210', 2, NULL, NULL),
(19, 'ភ្នំព្រឹក', 'Phnum Proek', '0211', 2, NULL, NULL),
(20, 'កំរៀង', 'Kamreang', '0212', 2, NULL, NULL),
(21, 'គាស់ក្រឡ', 'Koas Krala', '0213', 2, NULL, NULL),
(22, 'បាត់ដំបង', 'Battambang', '0203', 2, NULL, NULL),
(23, 'ប៉ោយប៉ែត', 'Poipet', '0110', 1, NULL, NULL),
(24, 'កំពង់ចាម', 'Kampong Cham', '0304', 3, NULL, NULL),
(25, 'បាធាយ​', 'Batheay', '0301', 3, NULL, NULL),
(26, 'ចំការលើ​', 'Chamkar Leu', '0302', 3, NULL, NULL),
(27, 'ជើងព្រៃ​', 'Cheung Prey', '0303', 3, NULL, NULL),
(28, 'កំពង់សៀម​', 'Kampong Siem', '0305', 3, NULL, NULL),
(29, 'កងមាស​', 'Kang Meas', '0306', 3, NULL, NULL),
(30, 'កោះសូទិន​', 'Kaoh Soutin', '0307', 3, NULL, NULL),
(31, 'ព្រៃឈរ​', 'Prey Chhor', '0308', 3, NULL, NULL),
(32, 'ស្រីសន្ធរ​', 'Srey Santhor', '0309', 3, NULL, NULL),
(33, 'ស្ទឹងត្រង់', 'Stueng Trang', '0310', 3, NULL, NULL),
(34, 'បរិបូណ៌', 'Baribour', '0401', 4, NULL, NULL),
(35, 'ជលគីរី', 'Chol Kiri', '0402', 4, NULL, NULL),
(36, 'កំពង់ឆ្នាំង', 'Kampong Chhnang', '0403', 4, NULL, NULL),
(37, 'កំពង់លែង', 'Kampong Leaeng', '0404', 4, NULL, NULL),
(38, 'កំពង់ត្រឡាច', 'Kampong Tralach', '0405', 4, NULL, NULL),
(39, 'រលាប្អៀរ', 'Rolea B\'ier', '0406', 4, NULL, NULL),
(40, 'សាមគ្គីមានជ័យ', 'Sameakki Mean Chey', '0407', 4, NULL, NULL),
(41, 'ទឹកផុស', 'Tuek Phos', '0408', 4, NULL, NULL),
(42, 'បរសេដ្ឋ', 'Borsedth', '0501', 5, NULL, NULL),
(43, 'ច្បារមន', 'Chbar Mon', '0502', 5, NULL, NULL),
(44, 'គងពិសី', 'Kong Pisei', '0503', 5, NULL, NULL),
(45, 'ឱរ៉ាល់', 'Aoral', '0504', 5, NULL, NULL),
(46, 'ឧដុង្គ', 'Odongk', '0505', 5, NULL, NULL),
(47, 'ភ្នំស្រួច', 'Phnum Sruoch', '0506', 5, NULL, NULL),
(48, 'សំរោងទង', 'Samraong Tong', '0507', 5, NULL, NULL),
(49, 'ថ្ពង', 'Thpong', '0508', 5, NULL, NULL),
(50, 'បារាយណ៍', 'Baray', '0601', 6, NULL, NULL),
(51, 'កំពង់ស្វាយ', 'Kampong Svay', '0602', 6, NULL, NULL),
(52, 'ស្ទឹងសែន', 'Stueng Saen', '0603', 6, NULL, NULL),
(53, 'ប្រាសាទបល្ល័ង្ក', 'Prasat Balang', '0604', 6, NULL, NULL),
(54, 'ប្រាសាទសំបូរ', 'Prasat Sambour', '0605', 6, NULL, NULL),
(55, 'សណ្ដាន់', 'Sandan', '0606', 6, NULL, NULL),
(56, 'សន្ទុក', 'Santuk', '0607', 6, NULL, NULL),
(57, 'ស្ទោង', 'Stoung', '0608', 6, NULL, NULL),
(58, 'អង្គរជ័យ', 'Angkor Chey', '', 7, NULL, NULL),
(59, 'បន្ទាយមាស', 'Bantay Meas', '', 7, NULL, NULL),
(60, 'ឈូក', 'Chouk', '', 7, NULL, NULL),
(61, 'ជុំគីរី', 'Chum Kiri', '', 7, NULL, NULL),
(62, 'ដងទង់', 'Dong Tung', '', 7, NULL, NULL),
(63, 'កំពង់ត្រាច', 'Kampong Trach', '', 7, NULL, NULL),
(64, 'កំពត', 'Kampot', '', 7, NULL, NULL),
(65, 'ទឹកឈូ', 'Tuek Chu', '', 7, NULL, NULL),
(66, 'កណ្ដាលស្ទឹង', 'Kandal Stueng', '0801', 8, NULL, NULL),
(67, 'កៀនស្វាយ', 'Kien Svay', '0802', 8, NULL, NULL),
(68, 'ខ្សាច់កណ្តាល', 'Khsach Kandal', '0803', 8, NULL, NULL),
(69, 'កោះធំ', 'Kaoh Thum', '0804', 8, NULL, NULL),
(70, 'លើកដែក', 'Leuk Daek', '0805', 8, NULL, NULL),
(71, 'ល្វាឯម', 'Lvea Aem', '0806', 8, NULL, NULL),
(72, 'មុខកំពូល', 'Mukh Kampul', '0807', 8, NULL, NULL),
(73, 'អង្គស្នួល', 'Angk Snuol', '0808', 8, NULL, NULL),
(74, 'ពញាឮ', 'Ponhea Lueu', '0809', 8, NULL, NULL),
(75, 'ស្អាង', 'S\'ang', '0810', 8, NULL, NULL),
(76, 'តាខ្មៅ', 'Ta Khmau', '0811', 8, NULL, NULL),
(77, 'បទុមសាគរ', 'Botum Sakor', '0901', 9, NULL, NULL),
(78, 'គីរីសាគរ', 'Kiri Sakor', '0902', 9, NULL, NULL),
(79, 'កោះកុង', 'Koh Kong', '0903', 9, NULL, NULL),
(80, 'ស្មាច់មានជ័យ', 'Smach Mean Chey', '0904', 9, NULL, NULL),
(81, 'មណ្ឌលសីមា', 'Mondol Seima', '0905', 9, NULL, NULL),
(82, 'ស្រែអំបិល', 'Srae Ambel', '0906', 9, NULL, NULL),
(83, 'ថ្មបាំង', 'Thmo Bang', '0907', 9, NULL, NULL),
(84, 'កំពង់សិលា', 'Kampong Seila', '0908', 9, NULL, NULL),
(85, 'ឆ្លូង​', 'Chhloung', '1001', 10, NULL, NULL),
(86, 'ក្រចេះ', 'Kratie', '1002', 10, NULL, NULL),
(87, 'ព្រែកប្រសព្វ', 'Preaek Prasab', '1003', 10, NULL, NULL),
(88, 'សំបូរ', 'Sambour', '1004', 10, NULL, NULL),
(89, 'ស្នួល', 'Snuol', '1005', 10, NULL, NULL),
(90, 'ចិត្របុរី', 'Chet Borei', '1006', 10, NULL, NULL),
(91, 'ស្រុកកែវសីមា', 'Kaev Seima', '1101', 11, NULL, NULL),
(92, 'ស្រុកកោះញែក', 'Kaoh Nheaek', '1102', 11, NULL, NULL),
(93, 'ស្រុកអូររាំង', 'Ou Reang', '1103', 11, NULL, NULL),
(94, 'ស្រុកពេជ្រាដា', 'Pech Chreada', '1104', 11, NULL, NULL),
(95, 'សែនមនោរម្យ', 'Senmonorom', '1105', 11, NULL, NULL),
(96, 'ចំការមន', 'Chamkar Mon', '', 12, NULL, NULL),
(97, 'ដូនពេញ', 'Doun Penh', '', 12, NULL, NULL),
(98, '៧មករា', '7 Meakkakra', '', 12, NULL, NULL),
(99, 'ទួលគោក', 'Tuol Kouk', '', 12, NULL, NULL),
(100, 'ដង្កោ', 'Dangkao', '', 12, NULL, NULL),
(101, 'មានជ័យ', 'Mean Chey', '', 12, NULL, NULL),
(102, 'ឫស្សីកែវ', 'Russey Keo', '', 12, NULL, NULL),
(103, 'សែនសុខ', 'Sen Sok', '', 12, NULL, NULL),
(104, 'ពោធិ៍សែនជ័យ', 'Pur SenChey', '', 12, NULL, NULL),
(105, 'ជ្រោយចង្វារ', 'Chraoy Chongvar', '', 12, NULL, NULL),
(106, 'ព្រែកព្នៅ', 'Praek Pnov', '', 12, NULL, NULL),
(107, 'ច្បារអំពៅ', 'Chbar Ampov', '', 12, NULL, NULL),
(108, 'ជ័យសែន', 'Chey Saen', '1301', 13, NULL, NULL),
(109, 'ឆែប', 'Chhaeb', '1302', 13, NULL, NULL),
(110, 'ជាំក្សាន្ត', 'Choam Khsant', '1303', 13, NULL, NULL),
(111, 'គូលែន', 'Kuleaen', '1304', 13, NULL, NULL),
(112, 'វៀង', 'Rovieng', '1305', 13, NULL, NULL),
(113, 'សង្គមថ្មី', 'Sangkom Thmei', '1306', 13, NULL, NULL),
(114, 'ត្បែងមានជ័យ', 'Tbaeng Mean chey', '1307', 13, NULL, NULL),
(115, 'ព្រៃវែង​', 'Prey Veng', '1401', 14, NULL, NULL),
(116, 'កំចាយមារ​', 'Kamchay Mea', '1402', 14, NULL, NULL),
(117, 'កំពង់ត្របែក', 'Kampong Trobek', '1403', 14, NULL, NULL),
(118, 'កញ្ច្រៀច​', 'Kachreach', '1404', 14, NULL, NULL),
(119, 'មេសាង​', 'Mesang', '1405', 14, NULL, NULL),
(120, 'ពាមជរ​', 'Peamchor', '1406', 14, NULL, NULL),
(121, 'ពាមរ​', 'Peamr', '1407', 14, NULL, NULL),
(122, 'ពារាំង​', 'Peareang', '1408', 14, NULL, NULL),
(123, 'ព្រះស្ដេច​', 'Prehsdach', '1409', 14, NULL, NULL),
(124, 'ស្វាយអន្ទរ​', 'Svay Ontor', '1410', 14, NULL, NULL),
(125, 'បាភ្នំ​', 'Baphnum', '1411', 14, NULL, NULL),
(126, 'ស៊ីធរកណ្ដាល​', 'Sithor Kandal', '1412', 14, NULL, NULL),
(127, 'កំពង់លាវ', 'Kampong Leav', '1413', 14, NULL, NULL),
(128, 'បាកាន', 'Bakan', '1501', 15, NULL, NULL),
(129, 'កណ្តៀង', 'Kandeang', '1502', 15, NULL, NULL),
(130, 'ក្រគរ', 'Krokor', '1503', 15, NULL, NULL),
(131, 'ភ្នំក្រវាញ', 'Phnum Kravanh', '1504', 15, NULL, NULL),
(132, 'ពោធិ៍សាត់', 'Pursat', '1505', 15, NULL, NULL),
(133, 'វាលវែង', 'Veal Veaeng', '1506', 15, NULL, NULL),
(134, 'អណ្តូងមាស​', 'Andoung Meas', '1601', 16, NULL, NULL),
(135, 'បានលុង', 'Ban Lung', '1602', 16, NULL, NULL),
(136, 'បរកែវ', 'Bar Kaev', '1603', 16, NULL, NULL),
(137, 'កូនមុំ', 'Koun Mom', '1604', 16, NULL, NULL),
(138, 'លំផាត់', 'Lumphat', '1605', 16, NULL, NULL),
(139, 'អូរជុំ', 'Ou Chum', '1606', 16, NULL, NULL),
(140, 'អូរយ៉ាដាវ', 'Ou Ya Dav', '1607', 16, NULL, NULL),
(141, 'តាវែង', 'Ta Veaeng', '1608', 16, NULL, NULL),
(142, 'វើនសៃ', 'Veun Sai', '1609', 16, NULL, NULL),
(143, 'អង្គរជុំ', 'Angkor Chum', '1701', 17, NULL, NULL),
(144, 'អង្គរធំ', 'Angkor Thum', '1702', 17, NULL, NULL),
(145, 'បន្ទាយស្រី', 'Banteay Srei', '1703', 17, NULL, NULL),
(146, 'ជីក្រែង', 'Chi Kraeng', '1704', 17, NULL, NULL),
(147, 'ក្រឡាញ់', 'Kralanh', '1706', 17, NULL, NULL),
(148, 'ពួក', 'Puok', '1707', 17, NULL, NULL),
(149, 'ប្រាសាទបាគង', 'Prasat Bakong', '1709', 17, NULL, NULL),
(150, 'សៀមរាប', 'Siem Reab', '1710', 17, NULL, NULL),
(151, 'សូទ្រនិគម', 'Soutr Nikom', '1711', 17, NULL, NULL),
(152, 'ស្រីស្នំ', 'Srei Snam', '1712', 17, NULL, NULL),
(153, 'ស្វាយលើ', 'Svay Leu', '1713', 17, NULL, NULL),
(154, 'វ៉ារិន', 'Varin', '1714', 17, NULL, NULL),
(155, 'មិត្តភាព', 'Mittakpheap', '1801', 18, NULL, NULL),
(156, 'ព្រៃនប់', 'Prey Nob', '1802', 18, NULL, NULL),
(157, 'ស្ទឹងហាវ', 'Stueng Hav', '1803', 18, NULL, NULL),
(158, 'កំពង់សីលា', 'Kampong Seila', '1804', 18, NULL, NULL),
(159, 'សេសាន', 'Sesan', '1901', 19, NULL, NULL),
(160, 'សៀមបូក', 'Siem Bouk', '1902', 19, NULL, NULL),
(161, 'សៀមប៉ាង', 'Siem Pang', '1903', 19, NULL, NULL),
(162, 'ស្ទឹងត្រែង', 'Stueng Traeng', '1904', 19, NULL, NULL),
(163, 'ថាឡាបរិវ៉ាត់', 'Thala Barivat', '1905', 19, NULL, NULL),
(164, 'ចន្រ្ទា​', 'Chanthrea', '2001', 20, NULL, NULL),
(165, 'កំពង់រោទិ៍', 'Kampong Rou', '2002', 20, NULL, NULL),
(166, 'រំដួល', 'Romdoul', '2003', 20, NULL, NULL),
(167, 'រមាសហែក', 'Romeas Haek', '2004', 20, NULL, NULL),
(168, 'ស្វាយជ្រំ', 'Svay Chrom', '2005', 20, NULL, NULL),
(169, 'ស្វាយរៀង', 'Svay Rieng', '2006', 20, NULL, NULL),
(170, 'ស្វាយទាប', 'Svay Theab', '2007', 20, NULL, NULL),
(171, 'បាវិត', 'Bavet', '2008', 20, NULL, NULL),
(172, 'អង្គរបូរី​', 'Angkor Borei', '2101', 21, NULL, NULL),
(173, 'បាទី', 'Bati', '2102', 21, NULL, NULL),
(174, 'បូរីជលសារ', 'Borei Cholsar', '2103', 21, NULL, NULL),
(175, 'គិរីវង់', 'Kiri Vong', '2104', 21, NULL, NULL),
(176, 'កោះអណ្តែត', 'Kaoh Andaet', '2105', 21, NULL, NULL),
(177, 'ព្រៃកប្បាស', 'Prey Kabbas', '2106', 21, NULL, NULL),
(178, 'សំរោង', 'Samraong', '2107', 21, NULL, NULL),
(179, 'ដូនកែវ', 'Doun Kaev', '2108', 21, NULL, NULL),
(180, 'ត្រាំកក់', 'Tram Kak', '2109', 21, NULL, NULL),
(181, 'ទ្រាំង', 'Treang', '2110', 21, NULL, NULL),
(182, 'ដំណាក់ចង្អើរ', 'Damnak Chang\'aeur', '2201', 23, NULL, NULL),
(183, 'កែប', 'Kep', '2202', 23, NULL, NULL),
(184, 'ប៉ៃលិន​', 'Pailin', '2301', 24, NULL, NULL),
(185, 'សាលា​​ក្រៅ', 'Salakrao', '2302', 24, NULL, NULL),
(186, 'អន្លង់វែង', 'Anlong Veng', '2201', 22, NULL, NULL),
(187, 'បន្ទាយអំពិល', 'Banteay Ampil', '2202', 22, NULL, NULL),
(188, 'ចុងកាល់', 'Chong Kal', '2203', 22, NULL, NULL),
(189, 'សំរោង', 'Samraong', '2204', 22, NULL, NULL),
(190, 'ត្រពាំងប្រាសាទ', 'Trapeang Prasat', '2205', 22, NULL, NULL),
(191, 'ដំបែ', 'Dambe', '', 25, NULL, NULL),
(192, 'ក្រូចឆ្មារ', 'Krochhma', '', 25, NULL, NULL),
(193, 'មេមត់', 'Memut', '', 25, NULL, NULL),
(194, 'អូររាំងឪ', 'Orangov', '', 25, NULL, NULL),
(195, 'ពញាក្រែក', 'Punhea Krek', '', 25, NULL, NULL),
(196, 'ត្បូងឃ្មុំ', 'Tboung Khmum', '', 25, NULL, NULL),
(197, 'សួង', 'Soung', '', 25, NULL, NULL),
(198, 'ព្រះសីហនុ', 'Sihanoukville', '០', 18, NULL, NULL),
(199, 'បឹងកេងកង', 'Boeung Keng Kang', '120000', 12, NULL, NULL),
(200, 'កំបូល', 'Kantaok', '0000', 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_kh` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT 1,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_village` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_commune` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address_province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `echoes`
--

CREATE TABLE `echoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `pt_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt_age` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt_gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pt_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `echo_default_description_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `echoes`
--

INSERT INTO `echoes` (`id`, `date`, `pt_no`, `pt_name`, `pt_age`, `pt_gender`, `pt_phone`, `image`, `description`, `patient_id`, `echo_default_description_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2021-02-01', 'PT-000002', 'ចាន់ ដារា', '12', 'ប្រុស', '0979899100', 'default.png', '<p style=\"text-align:center\"><span style=\"font-size:10pt\"><u><span style=\"font-size:14.0pt\"><span style=\"color:#44546a\">លិខិតចេញពីមន្ទីសំរាកព្យាបាលនិងសម្ភព</span></span></u></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:#44546a\">គ្រូពេទ្យព្យាបាលបញ្ជាក់ថា</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:#00b0f0\">​​​​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">អ្នកជម្ងឺឈ្មោះ</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">:​​&nbsp; ​ស៊ា សុផល&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ភេទ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ស្រី&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;អាយុ​:&nbsp;&nbsp;&nbsp; ២២​&nbsp;&nbsp; ឆ្នាំ&nbsp;&nbsp;&nbsp;&nbsp; សញ្ជាតិ: ​ខ្មែរ</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;ថ្ងៃ&nbsp; ខែ ឆ្នាំ កំណើត</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">:&nbsp;&nbsp;&nbsp;&nbsp; ១៨​ /០១/ ១៩៩៩&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">​​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ទីកន្លែងកំណើត​​​</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">: ភូមិ&nbsp; ផ្លាក​ ​​/ &nbsp;ឃុំ&nbsp; តាប្រុក&nbsp; / ស្រុក ចំការលើ&nbsp;&nbsp;&nbsp; /&nbsp; ខេត្ត​ កំពង់ចាម</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;មុខរបរ</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;សន្តិសុខ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; អង្គភាព :</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ប្រពន្ធ</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">ឈ្មោះ</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">:​&nbsp;&nbsp; ហឿន រីដា&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; អាយុ​:&nbsp;&nbsp;&nbsp; ២៤​&nbsp;&nbsp; ឆ្នាំ&nbsp;&nbsp;&nbsp;&nbsp; សញ្ជាតិ: ​ខ្មែរ</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;ទីកន្លែងកំណើត​​​: ភូមិ&nbsp; ផ្លាក​ ​​/&nbsp; ឃុំ&nbsp; តាប្រុក&nbsp; / ស្រុក ចំការលើ&nbsp;&nbsp;&nbsp; /&nbsp; ខេត្ត​ កំពង់ចាម​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ​មុខរបរ</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">:&nbsp;&nbsp; ចុងភៅ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;អង្គភាព :</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;អាស័យដ្ឋាន: ភូមិ&nbsp; ផ្លាក​ ​​/&nbsp; ឃុំ&nbsp; តាប្រុក&nbsp; / ស្រុក ចំការលើ&nbsp;&nbsp;&nbsp; /&nbsp; ខេត្ត​ កំពង់ចាម</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ចុលសំរាកព្យាបាល​ ថ្ងៃទី&nbsp; ១៩ ​ ខែ​&nbsp; មករា&nbsp;&nbsp; ឆ្នាំ​​​​&nbsp;&nbsp; ២០២០&nbsp;&nbsp; </span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ចេញសំរាកព្យាបាល​ ថ្ងៃទី ​​ ២១&nbsp; ខែ​ &nbsp;មករា&nbsp; ឆ្នាំ​​​​&nbsp;&nbsp; ២០២០</span></span>&nbsp;&nbsp; </span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;រោគវិនិច្ឆ័យ នៅពេលចូលសំរាក​</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">:រលាកក្រពះធ្ងន់ធ្ង</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; រោគវិនិច្ឆ័យ នៅពេលចូលសំរាក</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">:រលាកក្រពះធ្ងន់ធ្ង</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;សភាពអ្នកជម្ងឺនៅពេលចេញ</span></span><span style=\"font-size:11.0pt\"><span style=\"color:black\">:ធូស្រាល</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<u><span style=\"font-size:11.0pt\"><span style=\"color:red\">ចំណាំ</span></span></u><span style=\"font-size:11.0pt\"><span style=\"color:red\">:</span></span><span style=\"font-size:11.0pt\"><span style=\"color:#002060\">សូមយកលិខិតចេញពីមន្ទីសំរាកព្យាបាលនេះដើម្បីសុំច្បាប់កន្លែងការងារតាមតម្រូវការ</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:#002060\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ធ្វើនៅចំការលើ ថ្ងៃទី​​២១​ ខែ មករា ឆ្នាំ​២០២០</span></span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:#002060\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;គ្រូពេទ្យព្យាបាល</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:11.0pt\"><span style=\"color:#002060\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;វេជ្ជបណ្ឌិត អ៊ុត ព្រង</span></span></span></p>', 2, 9, 1, 2, '2021-02-01 13:43:49', '2021-02-10 16:49:15'),
(2, '2021-02-01', 'PT-000001', 'សួស សុថារី', '25', 'ស្រី', '099989796', '1612533928_2.png', '<p><span style=\"font-size:10pt\"><u><span style=\"font-size:12.0pt\">Technique</span></u><span style=\"font-size:12.0pt\">&nbsp;: L`examen est r&eacute;alis&eacute; par voie transcutan&eacute;e</span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><strong><span style=\"font-size:12.0pt\">Echographie pelvienne :</span></strong></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:12.0pt\">Ut&eacute;rus est gravide, pr&eacute;sence d&rsquo;un sac claire mesure d<strong>e: </strong></span><strong><span style=\"font-size:12.0pt\">15.6</span></strong><strong><span style=\"font-size:12.0pt\">mm</span></strong><span style=\"font-size:12.0pt\"> avec sac d&eacute;form&eacute;.</span></span></p>\r\n\r\n<p><span style=\"font-size:10pt\"><span style=\"font-size:12.0pt\">Absence d&rsquo;anomalie de structure de l&#39;ovaire </span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:10pt\"><strong><u><span style=\"font-size:12.0pt\">Conclusion </span></u></strong><strong><span style=\"font-size:12.0pt\">: </span></strong><span style=\"font-size:12.0pt\">Echographie pelvienne montre<strong> une grossesse arret&eacute;<span style=\"color:blue\">.</span></strong></span></span></p>', 1, 1, 1, 1, '2021-02-01 14:53:15', '2021-02-05 14:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `echo_default_descriptions`
--

CREATE TABLE `echo_default_descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `echo_default_descriptions`
--

INSERT INTO `echo_default_descriptions` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Grossesse non évolué', 'grossesse-non-evolue', '<p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><u><span style=\"font-size:12.0pt\">Technique</span></u><span style=\"font-size:12.0pt\">&nbsp;: L`examen est r&eacute;alis&eacute; par voie transcutan&eacute;e</span></span></span></p>\r\n\r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:12.0pt\">Echographie pelvienne :</span></strong></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">Ut&eacute;rus est gravide, pr&eacute;sence d&rsquo;un sac claire mesure d<strong>e: </strong></span><strong><span style=\"font-size:12.0pt\">15.6</span></strong><strong><span style=\"font-size:12.0pt\">mm</span></strong><span style=\"font-size:12.0pt\"> avec sac d&eacute;form&eacute;.</span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">Absence d&rsquo;anomalie de structure de l&#39;ovaire </span></span></span></p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><u><span style=\"font-size:12.0pt\">Conclusion </span></u></strong><strong><span style=\"font-size:12.0pt\">: </span></strong><span style=\"font-size:12.0pt\">Echographie pelvienne montre<strong> une grossesse arret&eacute;<span style=\"color:blue\">.</span></strong></span></span></span></p>\r\n              ', NULL, NULL),
(2, 'Grossesse évolué', 'grossesse-evolue', '<p style=\"margin-left:48px\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Nombre du f&oelig;tus (</span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">ចំនួន</span></span><span style=\"font-size:14.0pt\">) : 01&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DDR&nbsp;: </span><span style=\"font-size:14.0pt\">&nbsp;/&nbsp; / 2020</span></span></span></p>\r\n\r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><u><span style=\"font-size:12.0pt\">Technique</span></u><span style=\"font-size:12.0pt\">&nbsp;: L`examen est r&eacute;alis&eacute; par voie transcutan&eacute;e</span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">Ut&eacute;rus est gravide de: mm DAP, pr&eacute;sence d&rsquo;un sac claire </span>&nbsp;<span style=\"font-size:12.0pt\">mesure d<strong>e</strong></span><strong><span style=\"font-size:12.0pt\">:</span></strong><strong><span style=\"font-size:12.0pt\"> mm</span></strong><span style=\"font-size:12.0pt\"> avec </span><span style=\"font-size:12.0pt\">point de vitalit&eacute;</span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">Absence d&rsquo;anomalie de structure de l&#39;ovaire </span></span></span></p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><u><span style=\"font-size:12.0pt\">Conclusion </span></u></strong><strong><span style=\"font-size:12.0pt\">: </span></strong><span style=\"font-size:12.0pt\">Echographie pelvienne montre<strong> une grossesse de:&nbsp; <span style=\"color:blue\">SA J&nbsp;</span></strong></span><strong><span style=\"font-size:12.0pt\"><span style=\"color:blue\">vienn &eacute;volutive</span></span></strong><strong><span style=\"font-size:12.0pt\"><span style=\"color:blue\">.</span></span></strong></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"color:blue\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terme echographique&nbsp;:&nbsp;&nbsp;&nbsp; /&nbsp;&nbsp;&nbsp; /2021&nbsp;&nbsp;&nbsp;&nbsp; +/- 1w0d</span></span></strong>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></p>\r\n              ', NULL, NULL),
(3, 'Echo abdominaleF', 'echo-abdominalef', '<p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><u><span style=\"font-size:14.0pt\">R&eacute;sultat </span></u></strong></span></span></p>\r\n\r\n              <ul>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Le foie est de taille (FD&nbsp;: mm,FG&nbsp;: mm)&nbsp; de contours r&eacute;guliers, d&#39;&eacute;cho-structure homog&egrave;ne surface liss borde inf&eacute;rieux tranchante.</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Le tronc porte et les veines sus-h&eacute;patiques sont dilat&eacute;.</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">La v&eacute;sicule biliaire alithiasique, la paroi fine et r&eacute;guli&egrave;re.</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Les voies biliaires intra et extra h&eacute;patiques sont &nbsp;dilat&eacute;es.</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Le pancr&eacute;as est de tailles normales, de contours r&eacute;guliers. </span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">La rate est homog&egrave;ne, de taille normale. </span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Les reins de taille normale (RD: mm,RG:mm) la diff&eacute;renciation cortico-m&eacute;dullaire bien visible, absence de dilatations des cavit&eacute;s py&eacute;localicielles.</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">La vessie an&eacute;chogene la paroi fine et absence de diverticule ni de calcul.</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Ut&eacute;rus</span><span style=\"font-size:14.0pt\">:ant&eacute;vers&eacute;</span><span style=\"font-size:22.5pt\"><span style=\"font-family:DaunPenh\">​​</span></span><span style=\"font-size:14.0pt\"> de 40mm de DAP ligne vacuit&eacute; r&eacute;guli&eacute;</span> </span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Annex :normale</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Douglas&nbsp;: libre.</span></span></span></li>\r\n              </ul>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:14.0pt\"><span style=\"color:blue\">&nbsp;&nbsp;&nbsp;&nbsp; Au total</span></span></strong><span style=\"font-size:14.0pt\"> : Echographie pelvienne normale</span></span></span></p>\r\n              ', NULL, NULL),
(4, 'Echo abdominaleM', 'echo-abdominalem', '<p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><u><span style=\"font-size:14.0pt\">R&eacute;sultat </span></u></strong></span></span></p>\r\n\r\n              <ul>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Le foie est de taille (FD&nbsp;: mm,FG&nbsp;: mm)&nbsp; de contours r&eacute;guliers, d&#39;&eacute;cho-structure homog&egrave;ne surface liss borde inf&eacute;rieux tranchante .</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">Le tronc porte et les veines sus-h&eacute;patiques sont perm&eacute;ables.</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">La v&eacute;sicule biliaire alithiasique, la paroi fine et r&eacute;guli&egrave;re.</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">Les voies biliaires intra et extra h&eacute;patiques ne sont pas dilat&eacute;es.</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">Le pancr&eacute;as est de tailles normales, de contours r&eacute;guliers. </span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">La rate est homog&egrave;ne, de taille normale. </span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Les reins de taille normale (RD: mm,RG:mm) la diff&eacute;renciation cortico-m&eacute;dullaire bien visible, absence de dilatations des cavit&eacute;s py&eacute;localicielles</span><span style=\"font-size:22.5pt\"><span style=\"font-family:DaunPenh\">​</span></span> </span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">La vessie an&eacute;chogene la paroi fine et absence de diverticule ni de calcul</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">Prostat&nbsp;:normale</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">Douglas&nbsp;: libre.</span></span></span></li>\r\n                  <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:12.0pt\">Gaz intent</span></span></span></li>\r\n              </ul>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:22.5pt\"><span style=\"font-family:DaunPenh\">​​&nbsp;&nbsp;&nbsp; </span></span><strong><u><span style=\"font-size:14.0pt\">Au total</span></u></strong><span style=\"font-size:14.0pt\"> : Echographie abdominale normale a ce jour</span></span></span></p>\r\n              ', NULL, NULL),
(5, 'Echo SEIN', 'echo-sein', '<p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Nom et Pr&eacute;nom :&nbsp;&nbsp; </span></span></span></p>\r\n\r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Clinique : </span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">M&eacute;decin demander&nbsp;:</span></span></span></p>\r\n              \r\n              <p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><u><span style=\"font-size:16.0pt\">R&eacute;sultat </span></u></strong></span></span></p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tissue sous cutan&eacute;e et graisseuse sont normaux.</span></span></span></p>\r\n              \r\n              <p style=\"margin-left:48px\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Absence anomalie de morphologie et de structure de la glande mammaire.</span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Absence ad&eacute;nopathie </span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"font-size:14.0pt\">Absence </span><span style=\"font-size:14.0pt\">de calcification ou de formation tumorale .</span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; La vascularisation est normale. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><u><span style=\"font-size:14.0pt\">Au total</span></u></strong><span style=\"font-size:14.0pt\">: Echographie du seins sont normaeux.</span></span></span></p>\r\n              ', NULL, NULL),
(6, 'Echo thyroïdienne', 'echo-thyroidienne', '<p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Nom et pr&eacute;nom : &nbsp;</span></span></span></p>\r\n\r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Clinique :&nbsp; </span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">M&eacute;decin demander&nbsp;: &nbsp;</span></span></span></p>\r\n              \r\n              <p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><u><span style=\"font-size:16.0pt\">R&eacute;sultat </span></u></strong></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">La glande thyro&iuml;de est mesur&eacute;e&nbsp; au : &nbsp;</span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:14.0pt\">Lobe droit</span></strong><span style=\"font-size:14.0pt\">&nbsp;: L&nbsp;: mm X&nbsp; L&rsquo; : mm X AP&nbsp;: mm&nbsp; </span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:14.0pt\">Lobe gauche</span></strong><span style=\"font-size:14.0pt\">&nbsp;: L&nbsp;: mm X&nbsp; L&rsquo; : mm X AP&nbsp;: mm &nbsp;</span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:14.0pt\">Isthme&nbsp;</span></strong><span style=\"font-size:14.0pt\">: &nbsp; mm en ant&eacute;ropost&eacute;rieur (AP).</span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:14.0pt\">Volume</span></strong><span style=\"font-size:14.0pt\"> estim&eacute; &agrave;&nbsp; <strong>g</strong> pour un lobe [<strong><em>normal inf&eacute;rieur &agrave; 7g</em></strong>].</span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">L&#39;&eacute;chostructure glandulaire est l&eacute;g&egrave;rement granuleuse, homog&egrave;ne et &eacute;chog&egrave;ne. Les contours de l&#39;isthme et de chaque lobe sont r&eacute;guliers.&nbsp;&nbsp; </span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Diff&eacute;renciation de gradient musculo-parenchymateux.</span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Absence d&#39;ad&eacute;nopathie le long des axes jugulo-carotidiennes.&nbsp;&nbsp; </span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Pas d&#39;argument en faveur d&#39;une pathologie para-thyro&iuml;dienne.&nbsp;&nbsp; </span></span></span></p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><u><span style=\"font-size:14.0pt\">Au total</span></u></strong><span style=\"font-size:14.0pt\">: Echographie thyro&iuml;dienne normale.</span></span></span></p>\r\n              ', NULL, NULL),
(7, 'Obst 3 trimestre', 'obst-3-trimestre', '<p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><u><span style=\"font-size:16.0pt\"><span style=\"color:red\">R&eacute;sultat</span></span></u></span></span></p>\r\n\r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<span style=\"font-size:14.0pt\">&nbsp;&nbsp;Nombre du f&oelig;tus (</span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">ចំនួន</span></span><span style=\"font-size:14.0pt\">) : 01&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DDR&nbsp;: </span><span style=\"font-size:14.0pt\">&nbsp;/ &nbsp;/ 2020</span></span></span></p>\r\n              \r\n              <table cellspacing=\"0\" class=\"Table\" style=\"border-collapse:collapse; border:none; margin-left:73px\">\r\n                <tbody>\r\n                  <tr>\r\n                    <td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:162px\">\r\n                    <p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">Poids (</span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">ទម្ងន់កូន</span></span><span style=\"font-size:14.0pt\">):</span></span></span></p>\r\n                    </td>\r\n                    <td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:168px\">\r\n                    <p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">DBP (</span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">ទំហំក្បាល</span></span><span style=\"font-size:14.0pt\">)</span></span></span></p>\r\n                    </td>\r\n                    <td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:150px\">\r\n                    <p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">F</span><span style=\"font-size:14.0pt\">L(</span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">ប្រវែងភ្លៅកូន</span></span><span style=\"font-size:14.0pt\">)</span></span></span></p>\r\n                    </td>\r\n                  </tr>\r\n                  <tr>\r\n                    <td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:162px\">\r\n                    <p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">g</span></span></span></p>\r\n                    </td>\r\n                    <td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:168px\">\r\n                    <p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">mm</span></span></span></p>\r\n                    </td>\r\n                    <td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:150px\">\r\n                    <p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:14.0pt\">mm</span></span></span></p>\r\n                    </td>\r\n                  </tr>\r\n                </tbody>\r\n              </table>\r\n              \r\n              <ul>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;<span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">Absence anormalie morphologie d&eacute;c&eacute;lable<span style=\"color:red\"> (</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">រូបរាងកូនគ្រប់លកិខណ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:red\">:</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:red\">)</span></span></span></span></span></li>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">&nbsp;Bonne movement <span style=\"color:red\">(</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">ចលនាកូនល្អ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:red\">)</span></span></span></span></span></li>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">&nbsp;Activit&eacute; cardiaque (</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">ចលនាបេះដូងកូនល្អ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">):&nbsp; b/mn</span></span></span></span></li>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">&nbsp;Bonne placenta (<span style=\"color:#bf8f00\">សុកកូនល្អ</span>) post&eacute;rieux en haut( <span style=\"color:#bf8f00\">នៅផ្នែកខាង</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">ក្រោយខាងលើ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">)</span></span></span></span></li>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">&nbsp;Pr&eacute;sentation(</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">ការបង្ហាញ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">ទម្រង់</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">): sommet dose a G&nbsp; (</span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">ក្បាលនៅខាងក្រោម</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">)</span></span></span></span></li>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">Cordon circulaire 2toure A/V du cou</span></span></span></span></li>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">&nbsp;Liquide amniotique normale (<span style=\"color:#bf8f00\">បរិមាណទឹកភ្លោះកូន ល្អគ្រប់គ្រាន់</span>) AFI: 13</span></span></span></span></li>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">&nbsp;Sex (ភេទ)&nbsp;: </span></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:red\">ស្រី ​ ប្រុស</span></span></span>&nbsp; </span></span></li>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:22.5pt\"><span style=\"font-family:DaunPenh\">​ </span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">អាយុកូន</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">ចំនួន</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">:</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">​​&nbsp; សប្ដាហ៍​និង​​ ថ្ងៃ​ </span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">ការលូតលាស់ល្អ</span></span></span></span></span></li>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">Les ovairese sont de taille et de morphologie normale, sans formation kystique a leur niveau.</span></span></span></span></li>\r\n                <li><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">Abcence d&rsquo; &eacute;panchement dans le cul de sac de Douglas</span></span></span></span></li>\r\n              </ul>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><u><span style=\"font-size:22.5pt\"><span style=\"font-family:DaunPenh\">​</span></span></u>&nbsp;&nbsp;&nbsp; <strong><u><span style=\"font-size:14.0pt\"><span style=\"color:#002060\">Au total</span></span></u></strong><strong><span style=\"font-size:14.0pt\">:</span></strong><span style=\"font-size:14.0pt\">&Eacute;chographie pelvienne montrant de grossesse de(</span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">អាយុកូនចំនួន</span></span></span><span style=\"font-size:14.0pt\">):SA et:jours(</span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#bf8f00\">ថ្ងៃ</span></span></span><span style=\"font-size:14.0pt\">)</span><strong> </strong></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:22.5pt\"><span style=\"font-family:DaunPenh\">​​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:14.0pt\">Pr&eacute;sum&eacute; de terme le (</span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\"><span style=\"color:#ffc000\">គ្រប់ខែនៅថ្ងៃទី</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS System&quot;\">)</span></span><span style=\"font-size:14.0pt\"><span style=\"color:#00b0f0\">:</span></span> <strong><span style=\"font-size:12.0pt\"><span style=\"color:#00b0f0\">/&nbsp;&nbsp; /2021&nbsp;&nbsp;&nbsp;&nbsp; +/- w</span></span></strong><span style=\"font-size:19.5pt\"><span style=\"font-family:DaunPenh\"><span style=\"color:#00b0f0\">​</span></span></span><strong> </strong><strong><span style=\"font-size:12.0pt\"><span style=\"color:#00b0f0\">d</span></span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></p>\r\n              ', NULL, NULL),
(8, 'Hématologie analyse', 'hematologie-analyse', '<p style=\"text-align:center\"><u><span style=\"color:red\">R&eacute;sultat</span></u></p>', NULL, NULL),
(9, 'Letter from the hospital', 'letter-form-the-hospital', '<p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><u><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:#44546a\">លិខិតចេញពីមន្ទីសំរាកព្យាបាលនិងសម្ភព</span></span></span></u></span></span></p>\r\n\r\n              <p style=\"text-align:center\"><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:#44546a\">គ្រូពេទ្យព្យាបាលបញ្ជាក់ថា</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:#00b0f0\">​​​​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">អ្នកជម្ងឺឈ្មោះ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">:​​&nbsp; ​ស៊ា សុផល&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ភេទ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ស្រី&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;អាយុ​:&nbsp;&nbsp;&nbsp; ២២​&nbsp;&nbsp; ឆ្នាំ&nbsp;&nbsp;&nbsp;&nbsp; សញ្ជាតិ: ​ខ្មែរ</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;ថ្ងៃ&nbsp; ខែ ឆ្នាំ កំណើត</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">:&nbsp;&nbsp;&nbsp;&nbsp; ១៨​ /០១/ ១៩៩៩&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">​​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ទីកន្លែងកំណើត​​​</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">: ភូមិ&nbsp; ផ្លាក​ ​​/ &nbsp;ឃុំ&nbsp; តាប្រុក&nbsp; / ស្រុក ចំការលើ&nbsp;&nbsp;&nbsp; /&nbsp; ខេត្ត​ កំពង់ចាម</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;មុខរបរ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;សន្តិសុខ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; អង្គភាព :</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ប្រពន្ធ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">ឈ្មោះ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">:​&nbsp;&nbsp; ហឿន រីដា&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; អាយុ​:&nbsp;&nbsp;&nbsp; ២៤​&nbsp;&nbsp; ឆ្នាំ&nbsp;&nbsp;&nbsp;&nbsp; សញ្ជាតិ: ​ខ្មែរ</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;ទីកន្លែងកំណើត​​​: ភូមិ&nbsp; ផ្លាក​ ​​/&nbsp; ឃុំ&nbsp; តាប្រុក&nbsp; / ស្រុក ចំការលើ&nbsp;&nbsp;&nbsp; /&nbsp; ខេត្ត​ កំពង់ចាម​&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ​មុខរបរ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">:&nbsp;&nbsp; ចុងភៅ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;អង្គភាព :</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;អាស័យដ្ឋាន: ភូមិ&nbsp; ផ្លាក​ ​​/&nbsp; ឃុំ&nbsp; តាប្រុក&nbsp; / ស្រុក ចំការលើ&nbsp;&nbsp;&nbsp; /&nbsp; ខេត្ត​ កំពង់ចាម</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ចុលសំរាកព្យាបាល​ ថ្ងៃទី&nbsp; ១៩ ​ ខែ​&nbsp; មករា&nbsp;&nbsp; ឆ្នាំ​​​​&nbsp;&nbsp; ២០២០&nbsp;&nbsp; </span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ចេញសំរាកព្យាបាល​ ថ្ងៃទី ​​ ២១&nbsp; ខែ​ &nbsp;មករា&nbsp; ឆ្នាំ​​​​&nbsp;&nbsp; ២០២០</span></span></span>&nbsp;&nbsp; </span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;រោគវិនិច្ឆ័យ នៅពេលចូលសំរាក​</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">:រលាកក្រពះធ្ងន់ធ្ង</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; រោគវិនិច្ឆ័យ នៅពេលចូលសំរាក</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">:រលាកក្រពះធ្ងន់ធ្ង</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;សភាពអ្នកជម្ងឺនៅពេលចេញ</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:black\">:ធូស្រាល</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<u><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:red\">ចំណាំ</span></span></span></u><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:red\">:</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:#002060\">សូមយកលិខិតចេញពីមន្ទីសំរាកព្យាបាលនេះដើម្បីសុំច្បាប់កន្លែងការងារតាមតម្រូវការ</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:#002060\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ធ្វើនៅចំការលើ ថ្ងៃទី​​២១​ ខែ មករា ឆ្នាំ​២០២០</span></span></span></span></span></p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Siemreap&quot;\"><span style=\"color:#002060\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; គ្រូពេទ្យព្យាបាល</span></span></span></span></span></p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p>&nbsp;</p>\r\n              \r\n              <p><span style=\"font-size:10pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Khmer OS Muol Light&quot;\"><span style=\"color:#002060\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;វេជ្ជបណ្ឌិត អ៊ុត ព្រង</span></span></span></span></span></p>\r\n              ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `inv_number` int(11) NOT NULL,
  `rate` int(11) NOT NULL DEFAULT 4000,
  `pt_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt_age` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pt_gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pt_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `date`, `inv_number`, `rate`, `pt_no`, `pt_name`, `pt_age`, `pt_gender`, `pt_phone`, `status`, `remark`, `patient_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2021-01-30', 1, 4000, 'PT-000002', 'ចាន់ ដារា', '12', 'ប្រុស', '0979899100', 0, NULL, 2, 1, 1, '2021-01-30 08:03:26', '2021-01-30 08:37:44'),
(2, '2021-01-31', 2, 4000, 'PT-000002', 'ចាន់ ដារា', '12', 'ប្រុស', '0979899100', 1, NULL, 2, 1, 1, '2021-01-31 06:58:06', '2021-01-31 06:58:06'),
(3, '2021-02-05', 3, 4000, 'PT-000002', 'ចាន់ ដារា', '12', 'ប្រុស', '0979899100', 1, NULL, 2, 1, 1, '2021-02-05 15:48:34', '2021-02-05 15:48:34'),
(4, '2021-02-05', 4, 4000, 'PT-000002', 'ចាន់ ដារា', '12', 'ប្រុស', '0979899100', 1, NULL, 2, 1, 1, '2021-02-05 15:52:19', '2021-02-07 11:19:41'),
(5, '2021-02-09', 5, 4000, 'PT-000003', 'ដារា ចាន់', '12', 'ប្រុស', NULL, 1, NULL, 3, 1, 1, '2021-02-09 12:28:07', '2021-02-09 12:28:07'),
(6, '2021-02-10', 6, 4000, 'PT-000002', 'ចាន់ ដារា', '25', 'ប្រុស', '0979899100', 1, NULL, 2, 1, 1, '2021-02-10 14:31:03', '2021-02-10 14:32:22'),
(7, '2021-02-10', 7, 4000, 'PT-000002', 'sss', '33', 'ss', '123', 1, NULL, 7, 1, 1, '2021-02-10 15:09:50', '2021-02-10 15:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `qty` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `index` int(11) NOT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `medicine_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `amount`, `qty`, `description`, `index`, `discount`, `invoice_id`, `service_id`, `medicine_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 'Consulting with patient', 1, 0, 1, 2, NULL, 1, 1, '2021-01-30 08:03:26', '2021-01-30 08:03:26'),
(2, 20, 1, 'Echo Pregnant', 2, 0, 1, 1, NULL, 1, 1, '2021-01-30 08:03:26', '2021-01-30 08:03:26'),
(3, 10, 1, 'Consulting', 1, 0, 2, 2, NULL, 1, 1, '2021-01-31 06:58:06', '2021-01-31 06:58:06'),
(4, 10, 1, 'Consulting', 1, 0, 3, 2, NULL, 1, 1, '2021-02-05 15:48:34', '2021-02-05 15:48:34'),
(5, 10, 1, 'Consulting', 1, 0, 4, 2, NULL, 1, 1, '2021-02-05 15:52:19', '2021-02-05 15:52:19'),
(6, 1.3, 1, 'asdfaasdf', 3, 0, 4, NULL, NULL, 1, 1, '2021-02-05 15:52:19', '2021-02-05 15:59:17'),
(7, 0.5, 1, 'Wood', 4, 0, 4, NULL, NULL, 1, 1, '2021-02-05 15:52:19', '2021-02-05 15:59:17'),
(8, 5, 1, 'Paracetamol 500', 2, 0, 4, NULL, NULL, 1, 1, '2021-02-05 15:52:19', '2021-02-05 15:59:17'),
(9, 5, 1, 'Paracetamol 500', 3, 0, 3, NULL, NULL, 1, 1, '2021-02-05 16:06:27', '2021-02-05 16:06:54'),
(10, 1.3, 1, 'asdfaasdf', 2, 0, 3, NULL, NULL, 1, 1, '2021-02-05 16:06:40', '2021-02-05 16:06:40'),
(11, 32, 1, 'aaaaaafff', 1, 0, 6, 9, NULL, 1, 1, '2021-02-10 14:34:11', '2021-02-10 14:34:11'),
(12, 10, 1, 'Consulting', 2, 0, 6, 2, NULL, 1, 1, '2021-02-10 14:34:25', '2021-02-10 14:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usage_id` int(10) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `code`, `description`, `usage_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `price`) VALUES
(1, 'Paracetamol 500', '001', NULL, 1, 1, 1, '2021-01-30 08:01:09', '2021-02-05 15:31:53', 5),
(2, 'Wood', NULL, NULL, 1, 1, 1, '2021-01-30 08:01:34', '2021-02-05 15:32:00', 0.5),
(3, 'asdfaasdf', 'asdf', NULL, 1, 1, 1, '2021-01-31 06:42:49', '2021-02-05 15:32:06', 1.3),
(4, 'asdf', '123', 'asdf', 1, 1, 1, '2021-02-05 15:29:42', '2021-02-05 15:29:42', 123);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_12_18_094613_create_password_resets_table', 1),
(2, '2019_02_22_004943_create_users_table', 1),
(4, '2019_02_22_085134_create_provinces_table', 1),
(5, '2019_02_22_085150_create_districts_table', 1),
(6, '2020_07_29_091923_create_permission_tables', 1),
(7, '2020_07_30_091923_create_default_datas_tables', 1),
(8, '2020_12_17_110019_create_sessions_table', 1),
(9, '2020_12_18_110019_create_patients_table', 1),
(10, '2020_12_18_110019_create_usages_table', 1),
(11, '2020_12_18_110020_create_medicines_table', 1),
(12, '2020_12_18_110021_create_doctors_table', 1),
(13, '2020_12_18_110030_create_services_table', 1),
(14, '2020_12_18_110031_create_invoices_table', 1),
(15, '2020_12_18_110032_create_invoice_details_table', 1),
(16, '2020_12_18_110034_create_prescriptions_table', 1),
(17, '2020_12_18_110035_create_prescription_details_table', 1),
(35, '2019_02_22_085133_create_setting_table', 2),
(36, '2020_12_18_110037_create_echo_default_descriptions_table', 2),
(37, '2020_12_18_110037_create_echoes_table', 2),
(38, '2021_02_05_220905_update_medicine_service_and_invoice', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT 1,
  `age` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_village` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_commune` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address_province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `id_card`, `email`, `phone`, `gender`, `age`, `description`, `full_address`, `address_village`, `address_commune`, `address_district_id`, `address_province_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'សួស សុថារី', NULL, NULL, '099989796', 2, 25, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-01-30 07:56:55', '2021-01-30 07:57:28'),
(2, 'ចាន់ ដារា', NULL, NULL, '0979899100', 1, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-01-30 07:57:12', '2021-01-30 07:57:36'),
(3, 'ដារា ចាន់', NULL, NULL, NULL, 1, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-02-01 14:49:40', '2021-02-01 14:49:40'),
(4, 'ដារា មន្នីរ័ត្ន', NULL, NULL, NULL, 1, 23, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-02-01 14:50:23', '2021-02-01 14:50:23'),
(5, 'ចាន់ធី ដារា', NULL, NULL, NULL, 1, 33, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-02-01 14:50:53', '2021-02-01 14:50:53'),
(6, 'មន្នី ដារា', NULL, NULL, NULL, 1, 33, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-02-01 14:51:18', '2021-02-01 14:51:18'),
(7, 'sss', NULL, NULL, NULL, 2, 123, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-02-10 15:09:50', '2021-02-10 15:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Permission Index', 'web', 'Visit Permission Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(2, 'Permission Create', 'web', 'Create new Permission', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(3, 'Permission Edit', 'web', 'Edit Existed Permission', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(4, 'Permission Delete', 'web', 'Delete Existed Permission', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(5, 'Permission Assign User', 'web', 'Assign Permissions to Users', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(6, 'Permission Assign Role', 'web', 'Assign Permissions to Roles', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(7, 'Role Index', 'web', 'Visit Role Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(8, 'Role Create', 'web', 'Create new Role', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(9, 'Role Edit', 'web', 'Edit Existed Role', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(10, 'Role Delete', 'web', 'Delete Existed Role', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(11, 'Role Assign User', 'web', 'Assign Roles to Users', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(12, 'Role Assign Permission', 'web', 'Assign Permission to Users', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(13, 'User Index', 'web', 'Visit User Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(14, 'User Create', 'web', 'Create new User', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(15, 'User Edit', 'web', 'Edit Existed User', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(16, 'User Delete', 'web', 'Delete Existed User', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(17, 'User Password', 'web', 'Change Password User', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(18, 'User Assign Role', 'web', 'Assign Roles to Users', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(19, 'User Assign Permission', 'web', 'Assign Permission to Users', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(20, 'Province Index', 'web', 'Visit Province Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(21, 'Province Create', 'web', 'Create new Province', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(22, 'Province Edit', 'web', 'Edit Existed Province', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(23, 'Province Delete', 'web', 'Delete Existed Province', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(24, 'District Index', 'web', 'Visit District Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(25, 'District Create', 'web', 'Create new District', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(26, 'District Edit', 'web', 'Edit Existed District', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(27, 'District Delete', 'web', 'Delete Existed District', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(28, 'Medicine Index', 'web', 'Visit Medicine Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(29, 'Medicine Create', 'web', 'Create new Medicine', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(30, 'Medicine Edit', 'web', 'Edit Existed Medicine', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(31, 'Medicine Delete', 'web', 'Delete Existed Medicine', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(32, 'Usage Index', 'web', 'Visit Usage Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(33, 'Usage Create', 'web', 'Create new Usage', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(34, 'Usage Edit', 'web', 'Edit Existed Usage', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(35, 'Usage Delete', 'web', 'Delete Existed Usage', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(36, 'Doctor Index', 'web', 'Visit Doctor Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(37, 'Doctor Create', 'web', 'Create new Doctor', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(38, 'Doctor Edit', 'web', 'Edit Existed Doctor', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(39, 'Doctor Delete', 'web', 'Delete Existed Doctor', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(40, 'Doctor Show', 'web', 'Show Doctor detail', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(41, 'Patient Index', 'web', 'Visit Patient Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(42, 'Patient Create', 'web', 'Create new Patient', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(43, 'Patient Edit', 'web', 'Edit Existed Patient', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(44, 'Patient Delete', 'web', 'Delete Existed Patient', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(45, 'Patient Show', 'web', 'Show Patient detail', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(46, 'Service Index', 'web', 'Visit Service Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(47, 'Service Create', 'web', 'Create new Service', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(48, 'Service Edit', 'web', 'Edit Existed Service', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(49, 'Service Delete', 'web', 'Delete Existed Service', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(50, 'Service Show', 'web', 'Show Service detail', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(51, 'Invoice Index', 'web', 'Visit Invoice Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(52, 'Invoice Create', 'web', 'Create new Invoice', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(53, 'Invoice Edit', 'web', 'Edit Existed Invoice', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(54, 'Invoice Delete', 'web', 'Delete Existed Invoice', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(55, 'Invoice Show', 'web', 'Show Invoice detail', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(56, 'Invoice Print', 'web', 'Show Invoice detail', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(57, 'Prescription Index', 'web', 'Visit Prescription Index', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(58, 'Prescription Create', 'web', 'Create new Prescription', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(59, 'Prescription Edit', 'web', 'Edit Existed Prescription', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(60, 'Prescription Delete', 'web', 'Delete Existed Prescription', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(61, 'Prescription Show', 'web', 'Show Prescription detail', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(62, 'Prescription Print', 'web', 'Print Prescription detail', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(63, 'Setting Index', 'web', NULL, '2021-01-31 06:40:33', '2021-01-31 06:40:33'),
(64, 'Echo Default Description Index', 'web', 'Echo Default Description Index', '2021-01-31 07:16:49', '2021-01-31 07:16:49'),
(65, 'Echo Default Description Create', 'web', 'Create new Echo Default Description', '2021-01-31 07:16:49', '2021-01-31 07:16:49'),
(66, 'Echo Default Description Edit', 'web', 'Edit Existed Echo Default Description', '2021-01-31 07:16:49', '2021-01-31 07:16:49'),
(67, 'Echo Default Description Delete', 'web', 'Delete Existed  Echo Default Description', '2021-01-31 07:16:49', '2021-01-31 07:16:49'),
(68, 'Echo Index', 'web', 'Echo Index', '2021-01-31 07:16:54', '2021-01-31 07:16:54'),
(69, 'Echo Create', 'web', 'Create new Echo', '2021-01-31 07:16:54', '2021-01-31 07:16:54'),
(70, 'Echo Edit', 'web', 'Edit Existed Echo', '2021-01-31 07:16:54', '2021-01-31 07:16:54'),
(71, 'Echo Delete', 'web', 'Delete Existed  Echo', '2021-01-31 07:16:54', '2021-01-31 07:16:54'),
(72, 'Echo Print', 'web', NULL, '2021-02-07 10:48:28', '2021-02-07 10:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `code` int(11) NOT NULL,
  `pt_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt_age` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt_gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pt_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `remark` int(11) DEFAULT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `date`, `code`, `pt_no`, `pt_name`, `pt_age`, `pt_gender`, `pt_phone`, `status`, `remark`, `patient_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2021-01-31', 1, 'PT-000002', 'ចាន់ ដារា', '12', 'ប្រុស', '0979899100', 0, NULL, 2, 1, 1, '2021-01-31 06:54:57', '2021-01-31 06:54:57'),
(2, '2021-02-10', 2, 'PT-000002', 'ចាន់ ដារា', '12', 'ប្រុស', '099', 0, NULL, NULL, 1, 1, '2021-02-10 15:01:00', '2021-02-10 15:01:00'),
(3, '2021-02-10', 2, 'PT-000002', 'ចាន់ ដារា', '12', 'ប្រុស', '099', 0, NULL, NULL, 1, 1, '2021-02-10 15:01:16', '2021-02-10 15:01:16'),
(4, '2021-02-10', 2, 'PT-000002', 'ចាន់ ដារា', '12', 'ប្រុស', '099', 0, NULL, NULL, 1, 1, '2021-02-10 15:02:03', '2021-02-10 15:02:03'),
(5, '2021-02-10', 3, 'PT-000002', 'ចាន់ ដារា', '12', 'ប្រុស', '0979899100', 0, NULL, 2, 1, 1, '2021-02-10 15:11:46', '2021-02-10 16:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_details`
--

CREATE TABLE `prescription_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medicine_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicine_usage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `morning` double NOT NULL DEFAULT 1,
  `afternoon` double NOT NULL DEFAULT 1,
  `evening` double NOT NULL DEFAULT 1,
  `night` double NOT NULL DEFAULT 1,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index` int(11) NOT NULL,
  `medicine_id` bigint(20) UNSIGNED DEFAULT NULL,
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescription_details`
--

INSERT INTO `prescription_details` (`id`, `medicine_name`, `medicine_usage`, `morning`, `afternoon`, `evening`, `night`, `description`, `index`, `medicine_id`, `prescription_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'asdfaasdf', 'លេប', 1, 0, 0, 1, NULL, 1, 3, 1, 1, 1, '2021-01-31 06:54:57', '2021-01-31 06:54:57'),
(2, 'Paracetamol 500', 'លេប', 1, 0, 1, 0, NULL, 1, NULL, 4, 1, 1, '2021-02-10 15:02:03', '2021-02-10 15:02:03'),
(3, 'Wood Serum', 'ផឹក', 1, 1, 1, 1, NULL, 2, NULL, 4, 1, 1, '2021-02-10 15:02:03', '2021-02-10 15:02:03'),
(4, 'Paracetamol 500', 'លេប', 2, 1, 2, 2, NULL, 1, NULL, 5, 1, 1, '2021-02-10 15:11:46', '2021-02-10 15:56:46'),
(7, 'Testing', 'លាប', 1, 1, 1, 1, NULL, 2, NULL, 5, 1, 1, '2021-02-10 16:07:38', '2021-02-10 16:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'បន្ទាយមានជ័យ', 'Banteay Meanchey', NULL, NULL),
(2, 'បាត់ដំបង', 'Battambang', NULL, NULL),
(3, 'កំពង់ចាម', 'Kampong Cham', NULL, NULL),
(4, 'កំពង់ឆ្នាំង', 'Kampong Chhnang', NULL, NULL),
(5, 'កំពង់ស្ពឺ', 'Kampong Speu', NULL, NULL),
(6, 'កំពង់ធំ', 'Kampong Thom', NULL, NULL),
(7, 'កំពត', 'Kampot', NULL, NULL),
(8, 'កណ្ដាល', 'Kandal', NULL, NULL),
(9, 'កោះកុង', 'Koh Kong', NULL, NULL),
(10, 'ក្រចេះ', 'Kratie', NULL, NULL),
(11, 'មណ្ឌលគិរី', 'Mondul Kiri', NULL, NULL),
(12, 'ភ្នំពេញ', 'Phnom Penh', NULL, NULL),
(13, 'ព្រះវិហារ', 'Preah Vihear', NULL, NULL),
(14, 'ព្រៃវែង', 'Prey Veng', NULL, NULL),
(15, 'ពោធិ៍សាត់', 'Pursat', NULL, NULL),
(16, 'រតនគិរី', 'Ratanak', NULL, NULL),
(17, 'សៀមរាប', 'Siemreap', NULL, NULL),
(18, 'ព្រះសីហនុ', 'Preah Sihanouk', NULL, NULL),
(19, 'ស្ទឹងត្រែង', 'Stung Treng', NULL, NULL),
(20, 'ស្វាយរៀង', 'Svay Rieng', NULL, NULL),
(21, 'តាកែវ', 'Takeo', NULL, NULL),
(22, 'ឧត្ដរមានជ័យ', 'Oddar Meanchey', NULL, NULL),
(23, 'កែប', 'Kep', NULL, NULL),
(24, 'ប៉ៃលិន', 'Pailin', NULL, NULL),
(25, 'ត្បូងឃ្មុំ', 'Tboung Khmum', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Dev Admin', 'web', 'Power Administrator or Super Administrator is the highest admin that has all right to CRUD or coding to change everything', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(2, 'Admin', 'web', 'Administrator is a no normal admin.', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(3, 'User', 'web', 'User with no right', '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(4, 'Receptionist', 'web', 'Teacher', '2021-01-30 07:46:32', '2021-01-30 07:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(68, 2),
(69, 1),
(69, 2),
(70, 1),
(70, 2),
(71, 1),
(71, 2),
(72, 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Echo', 20, 'asdf', 1, 1, '2021-01-30 07:55:33', '2021-01-30 07:55:33'),
(2, 'Consulting', 10, NULL, 1, 1, '2021-01-30 07:55:53', '2021-01-30 07:55:53'),
(3, 'Medicine', 0, NULL, 1, 1, '2021-01-30 07:56:09', '2021-01-30 07:56:09'),
(4, 'asdf', 12, 'asdf', 1, 1, '2021-02-10 14:06:08', '2021-02-10 14:06:08'),
(5, 'ssss', 12, 'ssss', 1, 1, '2021-02-10 14:07:46', '2021-02-10 14:07:46'),
(6, 'asdf', 10, 'asdf', 1, 1, '2021-02-10 14:23:48', '2021-02-10 14:23:48'),
(7, 'ssfffff', 13, NULL, 1, 1, '2021-02-10 14:25:32', '2021-02-10 14:25:32'),
(8, 'ssffasdf', 23, 'asdf', 1, 1, '2021-02-10 14:27:29', '2021-02-10 14:27:29'),
(9, 'aaaaaafff', 32, 'asdf', 1, 1, '2021-02-10 14:27:55', '2021-02-10 14:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5iAj2xnHbZj1aCXx52M5Cm5KIHOPnWctr5bpxdZm', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWWtDYjNVUEtvUFBUelQ3MThkR3d6Ynk5Z1hYQndFenBwcXRSYXZBMCI7czozOiJ1cmwiO2E6MDp7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6OTAwMi91c2VyLzMvcm9sZSI7fX0=', 1612975652),
('TcVGyTG1PvdrwqeN8Ux4mJt7M9lIQIacvtY4cAfE', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieVhiczJ0OFZZNUgzaVE1cjNFU21uNHhTRXJDWlMzdFo2dGhaUVQzbCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vbG9jYWxob3N0OjkwMDIvcGF0aWVudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1612975846);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_name_kh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_name_kh` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `echo_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `echo_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `navbar_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'navbar-white navbar-light',
  `sidebar_color` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `logo`, `clinic_name_kh`, `clinic_name_en`, `sign_name_kh`, `sign_name_en`, `phone`, `address`, `description`, `echo_address`, `echo_description`, `navbar_color`, `sidebar_color`, `created_at`, `updated_at`) VALUES
(1, 'logo.png', 'មន្ទីរសំរាកព្យាបាល អ៊ុត ព្រង', 'OUT PRONG CABINET', 'វេជ្ជបណ្ឌិត. អ៊ុត ព្រង', 'Dr. OUT PRONG', '012 792 243 / 088 453 0077', 'ភូមិថ្នល់បែកលិច ឃុំស្វាយទាប ស្រុកចំការលើ ខេត្តកំពង់ចាម', 'ពិនិត្យ និងទទួលព្យាបាលជំងឺទូទៅលើ កុមារ មនុស្សចាស់ និងចាក់វ៉ាក់សាំងឆ្កែឆ្កួត តេតាណូស', 'ភូមិថ្នល់បែកលិច ឃុំស្វាយទាប </br>ស្រុកចំការលើ ខេត្តកំពង់ចាម </br>(ខាងជើងផ្សារ ចំងាយ៥០ម៉ែត)', '-ពិនិត្យអេកូពំណ៍​<br/>\r\n-ពិនិត្យឈាមដោយម៉ាស៊ីនស្វ័យប្រវត្ត<br/>\r\n-ព្យាបាលេជំងឺ កុមារ មនុស្សចាស់ រោគស្រ្តី​ និង​សម្ភព', 'navbar-white navbar-light', 0, NULL, '2021-02-10 16:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `usages`
--

CREATE TABLE `usages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usages`
--

INSERT INTO `usages` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'លេប', 'លេបចូលក្នុងខ្លួន', '2021-01-30 07:46:33', '2021-01-30 07:46:33'),
(2, 'ចាក់', '', '2021-01-30 07:46:33', '2021-01-30 07:46:33'),
(3, 'បន្ទក់', '', '2021-01-30 07:46:33', '2021-01-30 07:46:33'),
(4, 'លាយទឹក', '', '2021-01-30 07:46:33', '2021-01-30 07:46:33'),
(5, 'លាប', '', '2021-01-30 07:46:33', '2021-01-30 07:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_user.png',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kh',
  `gender` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `approval` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `image`, `phone`, `language`, `gender`, `status`, `approval`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Web', 'Dev', 'web@dev.com', '$2y$10$t8QOzY6vEWArgzqEwGaj/etY/o09UHqwyFYw5K3eJogQbRFQkt6Xi', 'default_user.png', '0', 'kh', 1, 1, 1, NULL, NULL, '2021-01-30 07:46:32', '2021-01-30 07:46:32'),
(2, 'asdf', 'asdf', 'admin@clinic.com', '$2y$10$qey/hE4InCypbDqMA9xjNemeX3yu8.FyaFWSS9meuAsGUcjuFHBja', 'default_user.png', NULL, 'kh', 1, 1, 0, NULL, NULL, '2021-02-07 02:10:08', '2021-02-07 02:10:08'),
(3, 'buntheng', 'dev', 'buntheng@dev.com', '$2y$10$GhTLWAWhpjLn3GdEEzpXGOH0KQDgIyR6rpI8bQCv3HR3ixHmjCiYq', 'default_user.png', NULL, 'kh', 1, 1, 0, NULL, NULL, '2021-02-10 16:46:31', '2021-02-10 16:46:31'),
(4, 'cheantha', 'dev', 'cheatha@dev.com', '$2y$10$IQWIXJZzpg6flgBixkXiMuQt3sJHG/HHaeV0gVx1ZtLoYryib3G46', 'default_user.png', NULL, 'kh', 1, 1, 0, NULL, NULL, '2021-02-10 16:47:05', '2021-02-10 16:47:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_province_id_foreign` (`province_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_address_district_id_foreign` (`address_district_id`),
  ADD KEY `doctors_address_province_id_foreign` (`address_province_id`),
  ADD KEY `doctors_created_by_foreign` (`created_by`),
  ADD KEY `doctors_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `echoes`
--
ALTER TABLE `echoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `echoes_patient_id_foreign` (`patient_id`),
  ADD KEY `echoes_echo_default_description_id_foreign` (`echo_default_description_id`),
  ADD KEY `echoes_created_by_foreign` (`created_by`),
  ADD KEY `echoes_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `echo_default_descriptions`
--
ALTER TABLE `echo_default_descriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `echo_dd_slug_unique` (`slug`) USING BTREE;

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_patient_id_foreign` (`patient_id`),
  ADD KEY `invoices_created_by_foreign` (`created_by`),
  ADD KEY `invoices_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_details_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_details_created_by_foreign` (`created_by`),
  ADD KEY `invoice_details_updated_by_foreign` (`updated_by`),
  ADD KEY `invoice_details_medicine_id_foreign` (`medicine_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicines_usage_id_foreign` (`usage_id`),
  ADD KEY `medicines_created_by_foreign` (`created_by`),
  ADD KEY `medicines_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_address_district_id_foreign` (`address_district_id`),
  ADD KEY `patients_address_province_id_foreign` (`address_province_id`),
  ADD KEY `patients_created_by_foreign` (`created_by`),
  ADD KEY `patients_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_patient_id_foreign` (`patient_id`),
  ADD KEY `prescriptions_created_by_foreign` (`created_by`),
  ADD KEY `prescriptions_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `prescription_details`
--
ALTER TABLE `prescription_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_details_medicine_id_foreign` (`medicine_id`),
  ADD KEY `prescription_details_prescription_id_foreign` (`prescription_id`),
  ADD KEY `prescription_details_created_by_foreign` (`created_by`),
  ADD KEY `prescription_details_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_created_by_foreign` (`created_by`),
  ADD KEY `services_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usages`
--
ALTER TABLE `usages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `echoes`
--
ALTER TABLE `echoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `echo_default_descriptions`
--
ALTER TABLE `echo_default_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prescription_details`
--
ALTER TABLE `prescription_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usages`
--
ALTER TABLE `usages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_address_district_id_foreign` FOREIGN KEY (`address_district_id`) REFERENCES `districts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `doctors_address_province_id_foreign` FOREIGN KEY (`address_province_id`) REFERENCES `provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `doctors_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `doctors_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `echoes`
--
ALTER TABLE `echoes`
  ADD CONSTRAINT `echoes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `echoes_echo_default_description_id_foreign` FOREIGN KEY (`echo_default_description_id`) REFERENCES `echo_default_descriptions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `echoes_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `echoes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `invoices_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `invoices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `invoice_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_details_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_details_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `medicines`
--
ALTER TABLE `medicines`
  ADD CONSTRAINT `medicines_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `medicines_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `medicines_usage_id_foreign` FOREIGN KEY (`usage_id`) REFERENCES `usages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_address_district_id_foreign` FOREIGN KEY (`address_district_id`) REFERENCES `districts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `patients_address_province_id_foreign` FOREIGN KEY (`address_province_id`) REFERENCES `provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `patients_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `patients_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prescriptions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prescriptions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prescription_details`
--
ALTER TABLE `prescription_details`
  ADD CONSTRAINT `prescription_details_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prescription_details_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prescription_details_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_details_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `services_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
