-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 24 Mars 2017 à 17:25
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_live`
--

-- --------------------------------------------------------

--
-- Structure de la table `tblactivitylog`
--

CREATE TABLE `tblactivitylog` (
  `id` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `date` datetime NOT NULL,
  `staffid` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblactivitylog`
--

INSERT INTO `tblactivitylog` (`id`, `description`, `date`, `staffid`) VALUES
(1, 'Staff Profile Updated [Staff: Ilyess Abounaaim]', '2016-09-03 23:39:53', '1'),
(2, 'Settings Updated []', '2016-09-03 23:47:51', '1'),
(3, 'Settings Updated []', '2016-09-03 23:51:04', '1'),
(4, 'Settings Updated []', '2016-09-03 23:51:54', '1'),
(5, 'Settings Updated []', '2016-09-03 23:55:43', '1'),
(6, 'Settings Updated []', '2016-09-03 23:58:22', '1'),
(7, 'Settings Updated []', '2016-09-03 23:59:24', '1'),
(8, 'Settings Updated []', '2016-09-03 23:59:37', '1'),
(9, 'New Tax Added [ID: 1, TVA]', '2016-09-04 00:00:18', '1'),
(10, 'New Currency Added [ID: MAD]', '2016-09-04 00:00:43', '1'),
(11, 'Settings Updated []', '2016-09-04 00:01:33', '1'),
(12, 'Settings Updated []', '2016-09-04 00:05:47', '1'),
(13, 'Settings Updated []', '2016-09-04 00:06:52', '1'),
(14, 'Settings Updated []', '2016-09-04 00:11:06', '1'),
(15, 'Settings Updated []', '2016-09-04 00:12:53', '1'),
(16, 'Settings Updated []', '2016-09-04 00:13:32', '1'),
(17, 'Cron Invoked Manually', '2016-09-04 00:23:27', '1'),
(18, 'Settings Updated []', '2016-09-04 00:37:09', '1'),
(19, 'Settings Updated []', '2016-09-04 00:37:54', '1'),
(20, 'Settings Updated []', '2016-09-04 00:39:45', '1'),
(21, 'New Customer Group Created [ID:1, Name:TPE]', '2016-09-04 01:22:48', '1'),
(22, 'New Customer Group Created [ID:2, Name:Semi-Publique]', '2016-09-04 01:23:17', '1'),
(23, 'New Customer Group Created [ID:3, Name:publique]', '2016-09-04 01:23:25', '1'),
(24, 'Customer Group Updated [ID:3]', '2016-09-04 01:23:34', '1'),
(25, 'New Customer Group Created [ID:4, Name:PME/PMI]', '2016-09-04 01:23:43', '1'),
(26, 'New Customer Group Created [ID:5, Name:Personne Physique]', '2016-09-04 01:23:55', '1'),
(27, 'New Customer Group Created [ID:6, Name:Multinationale]', '2016-09-04 01:24:13', '1'),
(28, 'New Customer Group Created [ID:7, Name:Association]', '2016-09-04 01:24:35', '1'),
(29, 'New Customer Group Created [ID:8, Name:Transport & Logistique]', '2016-09-04 01:24:59', '1'),
(30, 'New Customer Group Created [ID:9, Name:Textile]', '2016-09-04 01:25:05', '1'),
(31, 'New Customer Group Created [ID:10, Name:Telecom]', '2016-09-04 01:25:11', '1'),
(32, 'New Customer Group Created [ID:11, Name:Sport, loisir & tourisme]', '2016-09-04 01:25:24', '1'),
(33, 'New Customer Group Created [ID:12, Name:Soins et BeautÃ©]', '2016-09-04 01:25:35', '1'),
(34, 'New Customer Group Created [ID:13, Name:SantÃ©]', '2016-09-04 01:25:39', '1'),
(35, 'New Customer Group Created [ID:14, Name:informatique et technologie]', '2016-09-04 01:25:45', '1'),
(36, 'New Customer Group Created [ID:15, Name:Information et communication]', '2016-09-04 01:25:55', '1'),
(37, 'Customer Group Updated [ID:15]', '2016-09-04 01:26:08', '1'),
(38, 'New Customer Group Created [ID:16, Name:Industries manufacturiÃ¨res]', '2016-09-04 01:26:17', '1'),
(39, 'New Customer Group Created [ID:17, Name:Industries extractives]', '2016-09-04 01:26:25', '1'),
(40, 'New Customer Group Created [ID:18, Name:Industries Automobile	]', '2016-09-04 01:26:34', '1'),
(41, 'New Customer Group Created [ID:19, Name:HotÃªlerie & Restauration]', '2016-09-04 01:26:41', '1'),
(42, 'New Customer Group Created [ID:20, Name:Enseignement]', '2016-09-04 01:26:47', '1'),
(43, 'New Customer Group Created [ID:21, Name:ElectromÃ©nagers]', '2016-09-04 01:26:52', '1'),
(44, 'New Customer Group Created [ID:22, Name:Commerce & Distribution]', '2016-09-04 01:26:59', '1'),
(45, 'New Customer Group Created [ID:23, Name:BTP & Architecture]', '2016-09-04 01:27:07', '1'),
(46, 'New Customer Group Created [ID:24, Name:Banque et Assurance]', '2016-09-04 01:27:14', '1'),
(47, 'New Customer Group Created [ID:25, Name:Audiovisuel & Spectacle]', '2016-09-04 01:27:22', '1'),
(48, 'New Customer Group Created [ID:26, Name:Artisanat & Production sur mesure]', '2016-09-04 01:27:31', '1'),
(49, 'New Customer Group Created [ID:27, Name:Agro-Alimentaire]', '2016-09-04 01:27:39', '1'),
(50, 'New Customer Group Created [ID:28, Name:Agriculture]', '2016-09-04 01:27:45', '1'),
(51, 'New Expense Category Added [ID: 1]', '2016-09-04 01:32:48', '1'),
(52, 'New Expense Category Added [ID: 2]', '2016-09-04 01:33:12', '1'),
(53, 'New Expense Category Added [ID: 3]', '2016-09-04 01:33:20', '1'),
(54, 'New Expense Category Added [ID: 4]', '2016-09-04 01:33:27', '1'),
(55, 'New Client Created [IXINA From Staff: 1]', '2016-09-04 01:37:07', '1'),
(56, 'Customer Info Updated [IXINA]', '2016-09-04 01:37:18', '1'),
(57, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Customer Added/Registered (Welcome Email)]', '2016-09-04 01:38:21', '1'),
(58, 'Email Send To [Email:i.ab@deepmaroc.com, Type:set-password]', '2016-09-04 01:38:21', '1'),
(59, 'Email Send To [Email:n.alami@deepmaroc.com, Template:New Customer Added/Registered (Welcome Email)]', '2016-09-04 01:41:47', '1'),
(60, 'New Staff Member Added [ID: 2, Facial Aboullait]', '2016-09-04 22:59:34', '1'),
(61, 'Staff Member Updated [ID: 2, Facial Aboullait]', '2016-09-04 23:14:15', '1'),
(62, 'Cron Invoked Manually', '2016-09-04 23:17:19', '1'),
(63, 'Settings Updated []', '2016-09-04 23:17:47', '1'),
(64, 'New Custom Field Added [ModalitÃ© de payement]', '2016-09-04 23:19:52', '1'),
(65, 'Customer Info Updated [IXINA]', '2016-09-04 23:20:12', '1'),
(66, 'Custom Field Updated [ModalitÃ© de payement (en Jours)]', '2016-09-04 23:21:09', '1'),
(67, 'Customer Info Updated [IXINA]', '2016-09-04 23:21:25', '1'),
(68, 'New Project Created [ID: 1]', '2016-09-04 23:59:20', '1'),
(69, 'New Task Added [ID:1, Name: enregistrement voix Off]', '2016-09-05 00:03:50', '1'),
(70, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:Staff Added as Follower on Task]', '2016-09-05 00:04:27', '1'),
(71, 'New Task Added [ID:2, Name: post prod]', '2016-09-05 00:05:43', '1'),
(72, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:Staff Added as Follower on Task]', '2016-09-05 00:05:57', '1'),
(73, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Attachment on Task]', '2016-09-05 00:07:01', '1'),
(74, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:Task Marked as Finished]', '2016-09-05 00:07:27', '1'),
(75, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project Discussion (Sent to customer contacts)]', '2016-09-05 00:08:52', '1'),
(76, 'Email Send To [Email:n.alami@deepmaroc.com, Template:New Project Discussion (Sent to customer contacts)]', '2016-09-05 00:08:52', '1'),
(77, 'New Custom Field Added [Titre]', '2016-09-05 00:18:55', '1'),
(78, 'Contact Updated [Justin Auriel]', '2016-09-05 00:19:30', '1'),
(79, 'Custom Field Updated [Titre]', '2016-09-05 00:20:03', '1'),
(80, 'New Invoice Item Added [ID:1, integration Front end]', '2016-09-05 00:45:27', '1'),
(81, 'New Invoice Item Added [ID:2, Design Back Office]', '2016-09-05 00:45:47', '1'),
(82, 'Email Send To [Email:i.ab@deepmaroc.com, Template:Send Estimate to Customer]', '2016-09-05 00:57:01', '1'),
(83, 'Email Send To [Email:n.alami@deepmaroc.com, Template:Send Estimate to Customer]', '2016-09-05 00:57:01', '1'),
(84, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.157.68]', '2016-09-05 10:45:35', '2'),
(85, 'Email Send To [Email:i.ab@deepmaroc.com, Template:Task Marked as Finished]', '2016-09-05 11:15:31', '2'),
(86, 'Staff Profile Updated [Staff: Ahmed FaiÃ§al Aboullait]', '2016-09-05 11:18:31', '2'),
(87, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.157.68]', '2016-09-05 15:11:30', NULL),
(88, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.comjjkjk, Staff:1, IP:105.155.157.68]', '2016-09-05 15:47:10', NULL),
(89, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.comhjgfhjgh, Staff:1, IP:105.155.157.68]', '2016-09-05 15:51:25', NULL),
(90, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.comdsfgsdfg, Staff:1, IP:105.155.157.68]', '2016-09-05 16:06:03', NULL),
(91, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.comfdhfdgh, Staff:1, IP:105.155.157.68]', '2016-09-05 16:07:08', NULL),
(92, 'Failed Login Attempt [Email:hhjhjjhjhjh@dfdgfd.sdgdfg, Staff:1, IP:105.155.157.68]', '2016-09-05 16:18:14', NULL),
(93, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.comk, Staff:1, IP:105.155.157.68]', '2016-09-05 16:21:26', NULL),
(94, 'Email Send To [Email:f.aboullait@deepmaroc.com, Type:forgot-password]', '2016-09-05 16:31:46', NULL),
(95, 'Email Send To [Email:f.aboullait@deepmaroc.com, Type:forgot-password]', '2016-09-05 16:32:45', NULL),
(96, 'Email Send To [Email:f.aboullait@deepmaroc.com, Type:forgot-password]', '2016-09-05 16:34:09', NULL),
(97, 'Email Send To [Email:f.aboullait@deepmaroc.com, Type:forgot-password]', '2016-09-05 16:41:07', NULL),
(98, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.157.68]', '2016-09-05 16:52:30', NULL),
(99, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.157.68]', '2016-09-05 16:52:32', NULL),
(100, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.157.68]', '2016-09-05 16:52:34', NULL),
(101, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.comrtyutyu, Staff:, IP:105.155.157.68]', '2016-09-05 16:52:38', NULL),
(102, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.157.68]', '2016-09-05 17:06:00', NULL),
(103, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:18:13', NULL),
(104, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:20:00', NULL),
(105, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:20:03', NULL),
(106, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:20:04', NULL),
(107, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:20:06', NULL),
(108, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:20:26', NULL),
(109, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:21:20', NULL),
(110, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:21:23', NULL),
(111, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:23:09', NULL),
(112, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:24:30', NULL),
(113, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:24:40', NULL),
(114, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:25:36', NULL),
(115, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:25:38', NULL),
(116, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:26:29', NULL),
(117, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:26:49', NULL),
(118, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:27:11', NULL),
(119, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:27:45', NULL),
(120, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:28:43', NULL),
(121, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:28:46', NULL),
(122, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:29:26', NULL),
(123, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:29:39', NULL),
(124, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:30:12', NULL),
(125, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:30:26', NULL),
(126, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:30:27', NULL),
(127, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:30:37', NULL),
(128, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:31:10', NULL),
(129, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:31:29', NULL),
(130, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:31:31', NULL),
(131, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:31:42', NULL),
(132, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:31:43', NULL),
(133, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:31:51', NULL),
(134, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:31:53', NULL),
(135, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:35:07', NULL),
(136, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:35:21', NULL),
(137, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:44:48', NULL),
(138, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:44:50', NULL),
(139, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:44:55', NULL),
(140, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:44:56', NULL),
(141, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:44:57', NULL),
(142, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:44:58', NULL),
(143, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:44:59', NULL),
(144, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:45:00', NULL),
(145, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:45:02', NULL),
(146, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:45:04', NULL),
(147, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:47:39', NULL),
(148, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:47:40', NULL),
(149, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:47:41', NULL),
(150, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:47:43', NULL),
(151, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:47:44', NULL),
(152, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:47:46', NULL),
(153, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:48:24', NULL),
(154, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:48:25', NULL),
(155, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:48:37', NULL),
(156, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:55:57', NULL),
(157, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:55:59', NULL),
(158, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:56:09', NULL),
(159, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:56:11', NULL),
(160, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:56:13', NULL),
(161, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 17:56:24', NULL),
(162, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:02:23', NULL),
(163, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:02:28', NULL),
(164, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:02:45', NULL),
(165, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:03:11', NULL),
(166, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:03:12', NULL),
(167, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:03:16', NULL),
(168, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:03:18', NULL),
(169, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:03:24', NULL),
(170, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:08:46', NULL),
(171, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:08:58', NULL),
(172, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:13:23', NULL),
(173, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:13:25', NULL),
(174, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-05 18:15:29', NULL),
(175, 'Failed Login Attempt [Email:f.aboullait@gmail.com, Staff:, IP:105.155.152.56]', '2016-09-06 11:06:27', NULL),
(176, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-06 11:06:41', NULL),
(177, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-06 11:06:55', NULL),
(178, 'Contact Status Changed [ContactID: 1 Status(Active/Inactive): 0]', '2016-09-06 13:35:44', '1'),
(179, 'Inactive User Tried to Login [Email:i.ab@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-06 13:51:16', '1'),
(180, 'Inactive User Tried to Login [Email:i.ab@deepmaroc.com, Staff:, IP:105.155.152.56]', '2016-09-06 13:51:24', '1'),
(181, 'New Client Created [Deep Silver From Staff: 2]', '2016-09-06 15:40:54', '2'),
(182, 'Email Send To [Email:i.ab@deepmaroc.com, Template:Staff added as project member]', '2016-09-06 15:45:06', '2'),
(183, 'New Project Created [ID: 2]', '2016-09-06 15:45:06', '2'),
(184, 'New Task Added [ID:3, Name: dfhfdghfgh]', '2016-09-06 15:50:05', '2'),
(185, 'Task Updated [ID:3, Name: Personnalisation du CRM]', '2016-09-06 16:11:37', '2'),
(186, 'New Task Added [ID:4, Name: Ajout dâ€™image slider home screen ]', '2016-09-06 16:13:59', '2'),
(187, 'New Staff Member Added [ID: 3, Ikram  naffah]', '2016-09-06 16:16:16', '2'),
(188, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:Staff Added as Follower on Task]', '2016-09-06 16:19:35', '3'),
(189, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Task Assigned]', '2016-09-06 16:20:40', '3'),
(190, 'Task Updated [ID:4, Name: Ajout dâ€™image slider home screen ]', '2016-09-06 16:26:43', '2'),
(191, 'Task Updated [ID:4, Name: Ajout dâ€™image slider home screen ]', '2016-09-06 16:29:53', '2'),
(192, 'Task Updated [ID:4, Name: Ajout dâ€™image slider home screen ]', '2016-09-06 16:30:41', '2'),
(193, 'Settings Updated []', '2016-09-06 17:45:35', '2'),
(194, 'Email Send To [Email:faissal.ab@gmail.com, Template:New Customer Added/Registered (Welcome Email)]', '2016-09-06 17:49:55', '2'),
(195, 'Invoice Status Updated [Invoice Number: F-2016/000144, From: ImpayÃ©e To: PayÃ©e]', '2016-09-06 17:54:09', '2'),
(196, 'Payment Recorded [ID:1, Invoice Number: F-2016/000144, Total: 3.000,00MAD]', '2016-09-06 17:54:09', '2'),
(197, 'Email Send To [Email:faissal.ab@gmail.com, Template:Invoice Payment Recorded]', '2016-09-06 17:54:09', '2'),
(198, 'Inactive User Tried to Login [Email:i.ab@deepmaroc.com, Staff:, IP:41.251.64.13]', '2016-09-07 02:13:19', NULL),
(199, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.157.236.147]', '2016-09-07 11:02:27', NULL),
(200, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.157.236.147]', '2016-09-07 11:02:29', NULL),
(201, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:105.157.236.147]', '2016-09-07 11:02:33', NULL),
(202, 'Customer Info Updated [Deep Silver]', '2016-09-07 12:43:35', '2'),
(203, 'Customer Info Updated [Deep Silver]', '2016-09-07 16:03:13', '2'),
(204, 'Customer Info Updated [Deep Silver]', '2016-09-07 16:16:51', '2'),
(205, 'Customer Info Updated [Deep Silver]', '2016-09-07 16:19:39', '2'),
(206, 'Customer Info Updated [Deep Silver]', '2016-09-07 16:21:30', '2'),
(207, 'Customer Info Updated [Deep Silver]', '2016-09-07 16:27:54', '2'),
(208, 'Customer Info Updated [Deep Silver]', '2016-09-07 16:27:59', '2'),
(209, 'Customer Info Updated [Deep Silver]', '2016-09-07 16:44:33', '2'),
(210, 'Customer Info Updated [Deep Silver]', '2016-09-07 16:51:31', '2'),
(211, 'Customer Info Updated [Deep Silver]', '2016-09-07 16:57:17', '2'),
(212, 'Customer Info Updated [Deep Silver]', '2016-09-07 16:58:56', '2'),
(213, 'Customer Info Updated [Deep Silver]', '2016-09-07 17:02:39', '2'),
(214, 'Staff Profile Updated [Staff: Ahmed FaiÃ§al Aboullait]', '2016-09-07 17:19:13', '2'),
(215, 'Customer Info Updated [Deep Silver]', '2016-09-07 17:19:30', '2'),
(216, 'Customer Info Updated [Deep Silver]', '2016-09-07 17:19:37', '2'),
(217, 'Email sent to: f.aboullait@deepmaroc.com Subject:Event start today - tygjighjkg - 08.09.2016 ...', '2016-09-08 00:02:02', 'Cron Job'),
(218, 'Failed Login Attempt [Email:faissal.ab@gmail.com, Staff:1, IP:105.157.42.116]', '2016-09-08 10:52:09', NULL),
(219, 'Failed Login Attempt [Email:faissal.ab@gmail.com, Staff:1, IP:105.157.42.116]', '2016-09-08 11:20:20', NULL),
(220, 'Failed Login Attempt [Email:faissal.ab@gmail.com, Staff:1, IP:105.157.42.116]', '2016-09-08 11:20:24', NULL),
(221, 'Failed Login Attempt [Email:faissal.ab@gmail.com, Staff:1, IP:105.157.42.116]', '2016-09-08 11:20:28', NULL),
(222, 'Failed Login Attempt [Email:faissal.ab@gmail.com, Staff:1, IP:105.157.42.116]', '2016-09-08 13:18:28', NULL),
(223, 'Failed Login Attempt [Email:faissal.ab@gmail.com, Staff:1, IP:105.157.42.116]', '2016-09-08 14:47:40', NULL),
(224, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-09-08 15:05:11', '2'),
(225, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-09-08 15:05:12', '2'),
(226, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-09-08 15:05:13', '2'),
(227, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-09-08 15:05:14', '2'),
(228, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-08 15:05:16', '2'),
(229, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-08 15:05:17', '2'),
(230, 'New Custom Field Added [Actif]', '2016-09-08 16:35:59', '2'),
(231, 'Custom Field Deleted [3]', '2016-09-08 16:37:10', '2'),
(232, 'Failed Login Attempt [Email:faissal.ab@gmail.com, Staff:1, IP:105.157.42.116]', '2016-09-08 16:54:29', NULL),
(233, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-09-09 13:30:23', '2'),
(234, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-09-09 13:30:24', '2'),
(235, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-09 13:30:26', '2'),
(236, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-09-09 14:38:46', '2'),
(237, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:12:09', '2'),
(238, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:12:11', '2'),
(239, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:12:52', '2'),
(240, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:13:01', '2'),
(241, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:13:04', '2'),
(242, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:17:54', '2'),
(243, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:18:00', '2'),
(244, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:18:01', '2'),
(245, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:18:06', '2'),
(246, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:20:18', '2'),
(247, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:20:19', '2'),
(248, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:20:22', '2'),
(249, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:20:23', '2'),
(250, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:20:47', '2'),
(251, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:21:04', '2'),
(252, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:21:47', '2'),
(253, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:21:50', '2'),
(254, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:21:58', '2'),
(255, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:22:15', '2'),
(256, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:22:40', '2'),
(257, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:22:58', '2'),
(258, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:23:02', '2'),
(259, 'Settings Updated []', '2016-09-09 15:24:42', '2'),
(260, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:25:07', '2'),
(261, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:26:51', '2'),
(262, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:26:54', '2'),
(263, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:26:55', '2'),
(264, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:26:57', '2'),
(265, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:35:41', '2'),
(266, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:35:45', '2'),
(267, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:35:46', '2'),
(268, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:36:13', '2'),
(269, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:36:36', '2'),
(270, 'Custom Field Status Changed [FieldID: 0 - Active: ]', '2016-09-09 15:36:44', '2'),
(271, 'Custom Field Status Changed [FieldID: 1 - Active: ]', '2016-09-09 15:37:25', '2'),
(272, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 15:38:43', '2'),
(273, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-09-09 15:38:46', '2'),
(274, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-09 15:38:47', '2'),
(275, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 15:39:17', '2'),
(276, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-09 15:39:19', '2'),
(277, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 15:39:21', '2'),
(278, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-09-09 15:39:44', '2'),
(279, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-09 15:39:49', '2'),
(280, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-09-09 15:39:53', '2'),
(281, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 15:40:30', '2'),
(282, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-09-09 15:40:33', '2'),
(283, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-09 15:40:38', '2'),
(284, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 16:16:20', '2'),
(285, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-09-09 16:18:30', '2'),
(286, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 1]', '2016-09-09 16:18:32', '2'),
(287, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-09-09 16:32:23', '2'),
(288, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 16:40:04', '2'),
(289, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-09-09 16:40:05', '2'),
(290, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-09 16:40:13', '2'),
(291, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 16:46:55', '2'),
(292, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 16:47:00', '2'),
(293, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 16:48:49', '2'),
(294, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 16:49:22', '2'),
(295, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 16:49:38', '2'),
(296, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-09-09 16:49:40', '2'),
(297, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-09 16:51:26', '2'),
(298, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-09-09 16:51:30', '2'),
(299, 'Contact Updated [Ahmed Ab]', '2016-09-09 16:53:13', '2'),
(300, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.143.13.90]', '2016-09-09 16:53:27', NULL),
(301, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 1]', '2016-09-09 16:53:33', '2'),
(302, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-09-09 16:53:57', '2'),
(303, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.143.13.90]', '2016-09-09 16:54:08', NULL),
(304, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.141.151.31]', '2016-09-09 17:23:40', NULL),
(305, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 1]', '2016-09-09 17:23:53', '2'),
(306, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.141.151.31]', '2016-09-09 17:24:05', NULL),
(307, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.141.151.31]', '2016-09-09 17:24:12', NULL),
(308, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 17:24:19', '2'),
(309, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.141.151.31]', '2016-09-09 17:24:25', NULL),
(310, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.141.151.31]', '2016-09-09 17:31:55', NULL),
(311, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.141.151.31]', '2016-09-09 17:32:00', NULL),
(312, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-09-09 17:33:07', '2'),
(313, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.141.151.31]', '2016-09-09 17:33:19', NULL),
(314, 'Email Send To [Email:ikram@khadija.com, Template:New Customer Added/Registered (Welcome Email)]', '2016-09-09 17:35:23', '2'),
(315, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 1]', '2016-09-09 17:35:32', '2'),
(316, 'Contact Status Changed [ContactID: 4 Status(Active/Inactive): 0]', '2016-09-09 17:35:33', '2'),
(317, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-09-09 17:35:33', '2'),
(318, 'Contact Status Changed [ContactID: 4 Status(Active/Inactive): 1]', '2016-09-09 17:35:34', '2'),
(319, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 1]', '2016-09-09 17:35:36', '2'),
(320, 'Contact Status Changed [ContactID: 4 Status(Active/Inactive): 0]', '2016-09-09 17:35:44', '2'),
(321, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-09-09 17:35:44', '2'),
(322, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.141.151.31]', '2016-09-09 17:36:08', NULL),
(323, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-09 17:36:48', '2'),
(324, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-09 17:36:52', '2'),
(325, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 1]', '2016-09-09 17:36:58', '2'),
(326, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-09 17:37:32', '2'),
(327, 'Inactive User Tried to Login [Email:faissal.ab@gmail.com, Staff:, IP:41.141.151.31]', '2016-09-09 17:38:21', NULL),
(328, 'Failed Login Attempt [Email:f.aboullait@deepmaroc.com, Staff:, IP:41.141.151.31]', '2016-09-09 18:29:18', NULL),
(329, 'Inactive User Tried to Login [Email:f.aboullait@deepmaroc.com, Staff:1, IP:41.141.151.31]', '2016-09-09 18:29:28', NULL),
(330, 'Inactive User Tried to Login [Email:f.aboullait@deepmaroc.com, Staff:1, IP:41.141.151.31]', '2016-09-09 18:29:31', NULL),
(331, 'Inactive User Tried to Login [Email:f.aboullait@deepmaroc.com, Staff:1, IP:41.141.151.31]', '2016-09-09 18:31:22', NULL),
(332, 'Staff Password Changed [2]', '2016-09-09 18:33:42', '2'),
(333, 'Contact Updated [Ahmed Ab]', '2016-09-14 10:59:10', '2'),
(334, 'Contact Updated [ikram  khadija]', '2016-09-14 11:02:46', '2'),
(335, 'Contact Updated [Ahmed Ab]', '2016-09-14 11:03:00', '2'),
(336, 'Contact Updated [ikram  khadija]', '2016-09-14 11:03:29', '2'),
(337, 'Contact Status Changed [ContactID: 4 Status(Active/Inactive): 1]', '2016-09-14 11:03:34', '2'),
(338, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-14 11:11:46', '2'),
(339, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-09-14 11:11:48', '2'),
(340, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-09-14 11:11:48', '2'),
(341, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-09-14 11:11:49', '2'),
(342, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-09-14 11:15:24', '2'),
(343, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-09-14 11:15:25', '2'),
(344, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 1]', '2016-09-14 12:26:35', '2'),
(345, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 1]', '2016-09-14 12:26:36', '2'),
(346, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 0]', '2016-09-14 12:26:42', '2'),
(347, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 0]', '2016-09-14 12:26:43', '2'),
(348, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 1]', '2016-09-14 12:26:47', '2'),
(349, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 1]', '2016-09-14 12:26:53', '2'),
(350, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 0]', '2016-09-14 12:26:57', '2'),
(351, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 0]', '2016-09-14 12:27:01', '2'),
(352, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 1]', '2016-09-14 12:29:17', '2'),
(353, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 1]', '2016-09-14 12:29:18', '2'),
(354, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 0]', '2016-09-14 12:29:18', '2'),
(355, 'Staff Member Updated [ID: 2, Ahmed FaiÃ§al Aboullait]', '2016-09-14 13:00:18', '2'),
(356, 'Staff Member Updated [ID: 2, Ahmed FaiÃ§al Aboullait]', '2016-09-14 13:04:20', '2'),
(357, 'Staff Member Updated [ID: 2, Ahmed FaiÃ§al Aboullait]', '2016-09-14 13:06:14', '2'),
(358, 'New Department Added [Support technique, ID: 1]', '2016-09-14 13:09:26', '2'),
(359, 'New Department Added [Support commercial, ID: 2]', '2016-09-14 13:09:53', '2'),
(360, 'New Department Added [Support SAV, ID: 3]', '2016-09-14 13:10:13', '2'),
(361, 'Email Send To [Email:faissal.ab@gmail.com, Template:New Ticket Open Autoresponse]', '2016-09-14 13:11:02', NULL),
(362, 'New Ticket Created [ID: 1]', '2016-09-14 13:11:02', NULL),
(363, 'Project Updated [ID: 2]', '2016-09-14 17:04:44', '2'),
(364, 'Contact Updated [Ahmed Ab]', '2016-09-14 17:06:16', '2'),
(365, 'Project Updated [ID: 2]', '2016-09-14 17:06:33', '2'),
(366, 'Project Updated [ID: 2]', '2016-09-14 17:06:58', '2'),
(367, 'Project Updated [ID: 2]', '2016-09-14 17:07:52', '2'),
(368, 'Project Updated [ID: 2]', '2016-09-14 17:08:17', '2'),
(369, 'Project Updated [ID: 2]', '2016-09-14 17:08:35', '2'),
(370, 'Contact Updated [Muhcine Mt]', '2016-09-14 17:13:46', '2'),
(371, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-09-14 17:19:23', '2'),
(372, 'New Project Created [ID: 3]', '2016-09-14 17:21:55', '2'),
(373, 'Inactive User Tried to Login [Email:i.ab@deepmaroc.com, Staff:, IP:105.157.54.156]', '2016-09-15 11:00:59', '1'),
(374, 'Contact Updated [Muhcine Mt]', '2016-09-15 11:15:46', '2'),
(375, 'Project Updated [ID: 3]', '2016-09-15 17:06:38', '2'),
(376, 'Project Updated [ID: 3]', '2016-09-15 18:06:30', '2'),
(377, 'Project Updated [ID: 3]', '2016-09-15 18:19:56', '2'),
(378, 'Project Updated [ID: 3]', '2016-09-16 15:41:10', '2'),
(379, 'Project Updated [ID: 3]', '2016-09-16 17:02:12', '2'),
(380, 'Project Updated [ID: 3]', '2016-09-16 17:15:08', '2'),
(381, 'Project Updated [ID: 3]', '2016-09-16 17:28:23', '2'),
(382, 'Project Updated [ID: 3]', '2016-09-16 17:28:36', '2'),
(383, 'Project Updated [ID: 3]', '2016-09-16 17:28:43', '2'),
(384, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-18 17:15:02', 'Cron Job'),
(385, 'Contact Updated [Ahmed Ab]', '2016-09-19 15:39:15', '2'),
(386, 'New Project Created [ID: 4]', '2016-09-21 12:26:17', '2'),
(387, 'Contact Updated [Ahmed Ab]', '2016-09-21 15:56:44', '2'),
(388, 'Contact Updated [ikram  khadija]', '2016-09-21 15:56:50', '2'),
(389, 'Contact Updated [Muhcine Mt]', '2016-09-21 15:56:55', '2'),
(390, 'Contact Updated [ikram  khadija]', '2016-09-21 15:57:02', '2'),
(391, 'Contact Updated [Ahmed Ab]', '2016-09-21 15:57:07', '2'),
(392, 'Contact Updated [ikram  khadija]', '2016-09-21 15:57:11', '2'),
(393, 'Contact Updated [Muhcine Mt]', '2016-09-21 15:57:16', '2'),
(394, 'Contact Updated [Ahmed Ab]', '2016-09-21 17:04:24', '2'),
(395, 'Contact Updated [ikram  khadija]', '2016-09-21 17:15:50', '2'),
(396, 'Contact Updated [Muhcine Mt]', '2016-09-21 17:15:56', '2'),
(397, 'Contact Updated [Ahmed Ab]', '2016-09-21 17:16:30', '2'),
(398, 'Email Send To [Email:faissal.ab@gmail.com, Template:New Ticket Open Autoresponse]', '2016-09-21 17:30:08', NULL),
(399, 'New Ticket Created [ID: 16]', '2016-09-21 17:30:08', NULL),
(400, 'Email Send To [Email:faissal.ab@gmail.com, Template:New Ticket Open Autoresponse]', '2016-09-21 17:37:27', NULL),
(401, 'New Ticket Created [ID: 20]', '2016-09-21 17:37:27', NULL),
(402, 'Email Send To [Email:faissal.ab@gmail.com, Template:New Ticket Open Autoresponse]', '2016-09-21 17:41:37', NULL),
(403, 'New Ticket Created [ID: 21]', '2016-09-21 17:41:37', NULL),
(404, 'Failed Login Attempt [Email:faissal.ab@gmail.com, Staff:1, IP:41.251.81.49]', '2016-09-22 17:57:01', NULL),
(405, 'Email Send To [Email:f.aboullait@deepmaroc.com, Type:forgot-password]', '2016-09-23 12:55:19', NULL),
(406, 'Settings Updated []', '2016-09-23 15:13:04', '2'),
(407, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:08:07', 'Cron Job'),
(408, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:08:07', 'Cron Job'),
(409, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:08:08', 'Cron Job'),
(410, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:08:08', 'Cron Job'),
(411, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:14:02', 'Cron Job'),
(412, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:20:01', 'Cron Job'),
(413, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:20:02', 'Cron Job'),
(414, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:20:02', 'Cron Job'),
(415, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:20:03', 'Cron Job'),
(416, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:20:04', 'Cron Job'),
(417, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:20:04', 'Cron Job'),
(418, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:20:05', 'Cron Job'),
(419, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:31:02', 'Cron Job'),
(420, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:31:02', 'Cron Job'),
(421, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:31:03', 'Cron Job'),
(422, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:37:01', 'Cron Job'),
(423, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:37:01', 'Cron Job'),
(424, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:43:02', 'Cron Job'),
(425, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:43:02', 'Cron Job'),
(426, 'Email Send To [Email:faissal.ab@gmail.com, Template:Auto Close Ticket]', '2016-09-25 21:43:03', 'Cron Job'),
(427, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:105.154.24.173]', '2016-10-04 15:29:12', NULL),
(428, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:105.154.24.173]', '2016-10-04 15:29:17', NULL),
(429, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 1]', '2016-10-04 15:31:48', '3'),
(430, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 0]', '2016-10-04 15:31:49', '3'),
(431, 'Inactive User Tried to Login [Email:i.ab@deepmaroc.com, Staff:, IP:41.141.146.19]', '2016-10-06 11:36:12', NULL),
(432, 'Contact Status Changed [ContactID: 1 Status(Active/Inactive): 1]', '2016-10-06 11:44:56', '1'),
(433, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 1]', '2016-10-06 12:27:19', '3'),
(434, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 0]', '2016-10-06 12:27:21', '3'),
(435, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 0]', '2016-10-06 12:27:22', '3'),
(436, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 1]', '2016-10-06 12:27:23', '3'),
(437, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-10-06 13:09:53', '1'),
(438, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 1]', '2016-10-06 13:09:53', '1'),
(439, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-10-06 13:10:02', '1'),
(440, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-10-06 13:10:03', '1'),
(441, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:105.155.151.38]', '2016-10-07 11:00:46', NULL),
(442, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-10-07 11:02:05', '3'),
(443, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 1]', '2016-10-07 11:02:08', '3'),
(444, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-10-07 11:02:15', '3'),
(445, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 1]', '2016-10-07 11:02:17', '3'),
(446, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:105.155.151.38]', '2016-10-07 11:04:43', NULL),
(447, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-10-07 11:43:20', '3'),
(448, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-10-07 11:43:22', '3'),
(449, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-10-07 11:43:23', '3'),
(450, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-10-07 11:43:54', '3'),
(451, 'Contact Status Changed [ContactID: 4 Status(Active/Inactive): 0]', '2016-10-07 11:43:54', '3'),
(452, 'Contact Status Changed [ContactID: 5 Status(Active/Inactive): 0]', '2016-10-07 11:43:55', '3'),
(453, 'Contact Status Changed [ContactID: 5 Status(Active/Inactive): 1]', '2016-10-07 11:43:55', '3'),
(454, 'Contact Status Changed [ContactID: 4 Status(Active/Inactive): 1]', '2016-10-07 11:43:57', '3'),
(455, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 1]', '2016-10-07 11:43:58', '3'),
(456, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-10-07 11:46:27', '3'),
(457, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-10-07 11:46:28', '3'),
(458, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-10-07 11:46:29', '3'),
(459, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 1]', '2016-10-07 11:46:32', '3'),
(460, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 0]', '2016-10-07 11:46:33', '3'),
(461, 'Custom Field Status Changed [FieldID: 2 - Active: 0]', '2016-10-07 11:46:34', '3'),
(462, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:105.155.151.38]', '2016-10-07 15:29:05', NULL),
(463, 'Custom Field Status Changed [FieldID: 2 - Active: 1]', '2016-10-10 12:37:35', '1'),
(464, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-10-10 12:37:36', '1'),
(465, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-10-10 12:53:55', '1'),
(466, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-10-10 12:53:56', '1'),
(467, 'Contact Status Changed [ContactID: 3 Status(Active/Inactive): 0]', '2016-10-10 12:54:12', '1'),
(468, 'Contact Status Changed [ContactID: 4 Status(Active/Inactive): 0]', '2016-10-10 12:54:13', '1'),
(469, 'Contact Status Changed [ContactID: 5 Status(Active/Inactive): 0]', '2016-10-10 12:54:14', '1'),
(470, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 1]', '2016-10-10 12:55:23', '1'),
(471, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 0]', '2016-10-10 12:55:23', '1'),
(472, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 1]', '2016-10-10 12:55:24', '1'),
(473, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-11 11:40:52', NULL),
(474, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-11 11:41:00', NULL),
(475, 'Contact Updated [ ]', '2016-10-11 15:39:59', '3'),
(476, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-12 15:47:04', NULL),
(477, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-12 15:47:38', NULL),
(478, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 0]', '2016-10-12 17:07:26', '3'),
(479, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 0]', '2016-10-12 17:07:29', '3'),
(480, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 1]', '2016-10-12 17:07:30', '3'),
(481, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 1]', '2016-10-12 17:09:21', '3'),
(482, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Customer Added/Registered (Welcome Email)]', '2016-10-12 17:12:40', NULL),
(483, 'New Client Created [Ayman\'s Company]', '2016-10-12 17:12:40', NULL),
(484, 'Inactive User Tried to Login [Email:elhaouari.ayman@gmail.com, Staff:, IP:::1]', '2016-10-12 17:12:40', NULL),
(485, 'Inactive User Tried to Login [Email:elhaouari.ayman@gmail.com, Staff:, IP:::1]', '2016-10-12 17:12:59', NULL),
(486, 'Custom Field Status Changed [FieldID: 3 - Active: 1]', '2016-10-12 17:13:41', '3'),
(487, 'Email sent to: elhaouari.ayman@gmail.com Subject:123456', '2016-10-12 17:26:19', '3'),
(488, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 0]', '2016-10-13 15:17:27', '3'),
(489, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 0]', '2016-10-13 15:17:28', '3'),
(490, 'Custom Field Mode alami Changed [FieldID: 3 - Active: 1]', '2016-10-13 15:17:31', '3'),
(491, 'Custom Field Mode alami Changed [FieldID: 2 - Active: 1]', '2016-10-13 15:17:32', '3'),
(492, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 1]', '2016-10-13 15:17:32', '3'),
(493, 'New Contract Added [sujet]', '2016-10-13 17:59:22', '3'),
(494, 'Email sent to: s.sakhraoui@deepmaroc.com Subject:test', '2016-10-17 13:37:08', '3'),
(495, 'Project Updated [ID: 4]', '2016-10-17 17:12:53', '3'),
(496, 'Custom Field Status Changed [FieldID: 1 - Active: 1]', '2016-10-18 15:18:32', '3'),
(497, 'Project Updated [ID: 3]', '2016-10-18 15:19:01', '3'),
(498, 'Project Updated [ID: 3]', '2016-10-18 15:20:11', '3'),
(499, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Send Estimate to Customer]', '2016-10-20 16:07:36', '3'),
(500, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:Estimate Declined (Sent to Staff)]', '2016-10-20 16:10:18', NULL),
(501, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Send Invoice to Customer]', '2016-10-20 17:02:56', '3'),
(502, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-21 12:48:53', NULL),
(503, 'Failed Login Attempt [Email:elhaouari.ayman@gmail.com, Staff:1, IP:::1]', '2016-10-21 12:53:09', NULL),
(504, 'Failed Login Attempt [Email:elhaouari.ayman@gmail.com, Staff:1, IP:::1]', '2016-10-21 15:26:41', NULL),
(505, 'Custom Field Status Changed [FieldID: 3 - Active: 0]', '2016-10-21 16:20:10', '3'),
(506, 'Inactive User Tried to Login [Email:elhaouari.ayman@gmail.com, Staff:, IP:::1]', '2016-10-21 16:21:00', NULL),
(507, 'Custom Field Status Changed [FieldID: 3 - Active: 1]', '2016-10-21 16:21:12', '3'),
(508, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Customer Added/Registered (Welcome Email)]', '2016-10-21 16:23:41', '3'),
(509, 'Contact Status Changed [ContactID: 7 Status(Active/Inactive): 0]', '2016-10-21 16:24:09', '3'),
(510, 'Inactive User Tried to Login [Email:s.sakhraoui@deepmaroc.com, Staff:, IP:::1]', '2016-10-21 16:24:32', NULL),
(511, 'Contact Status Changed [ContactID: 7 Status(Active/Inactive): 1]', '2016-10-21 16:24:37', '3'),
(512, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-21 16:24:41', NULL),
(513, 'Contact Status Changed [ContactID: 6 Status(Active/Inactive): 0]', '2016-10-21 16:25:30', '3'),
(514, 'Inactive User Tried to Login [Email:elhaouari.ayman@gmail.com, Staff:, IP:::1]', '2016-10-21 16:36:19', NULL),
(515, 'Contact Status Changed [ContactID: 6 Status(Active/Inactive): 1]', '2016-10-21 16:36:43', '3'),
(516, 'Contact Status Changed [ContactID: 6 Status(Active/Inactive): 0]', '2016-10-21 16:36:51', '3'),
(517, 'Contact Status Changed [ContactID: 7 Status(Active/Inactive): 0]', '2016-10-21 16:37:34', '3'),
(518, 'Contact Status Changed [ContactID: 7 Status(Active/Inactive): 1]', '2016-10-21 16:37:34', '3'),
(519, 'Custom Field Status Changed [FieldID: 3 - Active: 0]', '2016-10-21 16:37:40', '3');
INSERT INTO `tblactivitylog` (`id`, `description`, `date`, `staffid`) VALUES
(520, 'Inactive User Tried to Login [Email:s.sakhraoui@deepmaroc.com, Staff:, IP:::1]', '2016-10-21 16:37:52', NULL),
(521, 'Custom Field Status Changed [FieldID: 3 - Active: 1]', '2016-10-21 16:37:58', '3'),
(522, 'Contact Status Changed [ContactID: 6 Status(Active/Inactive): 1]', '2016-10-21 16:38:13', '3'),
(523, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 0]', '2016-10-21 16:55:11', '3'),
(524, 'Custom Field Mode alami Changed [FieldID: 1 - Active: 1]', '2016-10-21 16:55:14', '3'),
(525, 'Custom Field Mode alami Changed [FieldID: 3 - Active: 0]', '2016-10-21 16:55:15', '3'),
(526, 'Custom Field Mode alami Changed [FieldID: 3 - Active: 1]', '2016-10-21 16:55:20', '3'),
(527, 'Custom Field Mode alami Changed [FieldID: 3 - Active: 0]', '2016-10-21 16:55:24', '3'),
(528, 'Custom Field Mode alami Changed [FieldID: 3 - Active: 1]', '2016-10-21 16:56:08', '3'),
(529, 'New Proposal Created [ID:1]', '2016-10-21 17:27:48', '3'),
(530, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Ticket Opened (Opened by staff, sent to customer)]', '2016-10-21 17:29:20', '3'),
(531, 'New Ticket Created [ID: 22]', '2016-10-21 17:29:20', '3'),
(532, 'New Project Created [ID: 5]', '2016-10-21 17:50:27', '3'),
(533, 'Email Send To [Email:i.ab@deepmaroc.com, Template:Customer Action - Accepted (Sent to Staff)]', '2016-10-21 17:51:40', NULL),
(534, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:Customer Action - Accepted (Sent to Staff)]', '2016-10-21 17:51:41', NULL),
(535, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Customer Thank You Email (After Accept)]', '2016-10-21 17:51:42', NULL),
(536, 'Proposal Status Changes [ProposalID:1, Status:Accepted,Client Action: 1]', '2016-10-21 17:51:42', NULL),
(537, 'Project Updated [ID: 5]', '2016-10-21 18:13:13', '3'),
(538, 'New Contract Added [123]', '2016-10-21 18:27:44', '3'),
(539, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Send Invoice to Customer]', '2016-10-21 18:30:35', '3'),
(540, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-10-21 18:40:46', '3'),
(541, 'Email Send To [Email:i.ab@deepmaroc.com, Template:Staff added as project member]', '2016-10-24 11:23:51', '3'),
(542, 'Project Updated [ID: 5]', '2016-10-24 11:23:51', '3'),
(543, 'Project Updated [ID: 5]', '2016-10-24 11:25:12', '3'),
(544, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-24 11:31:49', NULL),
(545, 'New Announcement Added [Annonce]', '2016-10-24 11:51:57', '3'),
(546, 'New Staff Member Added [ID: 6, Ilyess Abounaaim]', '2016-10-24 12:22:25', '3'),
(547, 'Staff Member Updated [ID: 6, Ilyess Abounaaim]', '2016-10-24 12:22:47', '3'),
(548, 'Custom Field Mode alami Changed [FieldID: 3 - Active: 0]', '2016-10-24 12:46:36', '6'),
(549, 'New Announcement Added [annonce]', '2016-10-24 12:47:19', '6'),
(550, 'Custom Field Mode alami Changed [FieldID: 3 - Active: 1]', '2016-10-24 12:52:26', '6'),
(551, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-24 12:53:53', NULL),
(552, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-24 12:54:14', NULL),
(553, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-24 13:00:09', NULL),
(554, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-24 13:00:14', NULL),
(555, 'Project Updated [ID: 4]', '2016-10-24 15:27:49', '3'),
(556, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-24 17:08:13', NULL),
(557, 'Project Updated [ID: 5]', '2016-10-24 17:47:19', '6'),
(558, 'New Announcement Added [annonce1]', '2016-10-25 11:28:06', '3'),
(559, 'New Survey Added [ID: 1, Subject: sondage test ]', '2016-10-25 12:00:15', '3'),
(560, 'Survey Email Lists Send Setup [ID: 1, Lists: Clients]', '2016-10-25 12:00:27', '3'),
(561, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project Discussion (Sent to customer contacts)]', '2016-10-25 13:29:29', '6'),
(562, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project Discussion (Sent to customer contacts)]', '2016-10-25 13:29:30', '6'),
(563, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:Staff added as project member]', '2016-10-25 13:30:24', '6'),
(564, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:Staff added as project member]', '2016-10-25 13:30:25', '6'),
(565, 'Project Milestone Created [ID:1]', '2016-10-25 13:30:58', '6'),
(566, 'New Task Added [ID:5, Name: CRMmodification]', '2016-10-25 13:32:32', '6'),
(567, 'New Expense Added [1]', '2016-10-25 13:37:52', '6'),
(568, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-25 15:48:01', '6'),
(569, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-25 15:48:02', '6'),
(570, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-25 15:48:03', '6'),
(571, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-25 15:48:04', '6'),
(572, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-25 15:51:25', NULL),
(573, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-25 15:51:26', NULL),
(574, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-25 15:51:27', NULL),
(575, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-25 15:51:28', NULL),
(576, 'Contact Updated [Sanaà Sakhraoui]', '2016-10-25 15:52:59', '6'),
(577, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-25 15:53:15', NULL),
(578, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-25 15:53:15', NULL),
(579, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-25 15:53:16', NULL),
(580, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-25 15:53:17', NULL),
(581, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-25 16:33:48', '6'),
(582, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-25 16:33:49', '6'),
(583, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-25 16:33:50', '6'),
(584, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-25 16:33:51', '6'),
(585, 'Task Updated [ID:5, Name: CRMmodification]', '2016-10-25 16:49:07', '6'),
(586, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Comment on Task]', '2016-10-25 17:00:54', NULL),
(587, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Ticket Opened (Opened by staff, sent to customer)]', '2016-10-25 17:07:08', '6'),
(588, 'New Ticket Created [ID: 23]', '2016-10-25 17:07:08', '6'),
(589, 'New Ticket Reply [ReplyID: 1]', '2016-10-25 17:16:35', NULL),
(590, 'Email Send To [Email:i.ab@deepmaroc.com, Template:Ticket Reply (Sent to staff)]', '2016-10-25 17:16:37', NULL),
(591, 'New Ticket Reply [ReplyID: 2]', '2016-10-25 17:24:43', '6'),
(592, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Ticket Reply (Sent to customer)]', '2016-10-25 17:24:44', '6'),
(593, 'New Task Added [ID:6, Name: sujet tach]', '2016-10-25 17:33:28', '6'),
(594, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-25 17:39:36', NULL),
(595, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-25 17:39:37', NULL),
(596, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-25 17:39:38', NULL),
(597, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-25 17:39:39', NULL),
(598, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-25 17:43:20', '6'),
(599, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-25 17:43:21', '6'),
(600, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-25 17:43:22', '6'),
(601, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-25 17:43:23', '6'),
(602, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-25 17:59:01', '6'),
(603, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-25 17:59:02', '6'),
(604, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-25 17:59:03', '6'),
(605, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-25 17:59:04', '6'),
(606, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-10-26 11:02:00', NULL),
(607, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-26 17:34:41', NULL),
(608, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-26 17:34:42', NULL),
(609, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-26 17:34:43', NULL),
(610, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-26 17:34:44', NULL),
(611, 'New Project Created [ID: 6]', '2016-10-26 17:46:05', '6'),
(612, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Customer Thank You Email (After Accept)]', '2016-10-26 18:26:17', NULL),
(613, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:Customer Thank You Email (After Accept)]', '2016-10-26 18:26:18', NULL),
(614, 'Email Send To [Email:i.ab@deepmaroc.com, Template:Estimate Accepted (Sent to Staff)]', '2016-10-26 18:26:19', NULL),
(615, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:18:49', '6'),
(616, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:18:50', '6'),
(617, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:19:37', '6'),
(618, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:19:38', '6'),
(619, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:21:09', '6'),
(620, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:21:10', '6'),
(621, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:22:45', '6'),
(622, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:22:46', '6'),
(623, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 13:22:47', '6'),
(624, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 13:22:48', '6'),
(625, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:25:01', '6'),
(626, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:25:02', '6'),
(627, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 13:25:03', '6'),
(628, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 13:25:04', '6'),
(629, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:29:11', '6'),
(630, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:29:12', '6'),
(631, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 13:29:13', '6'),
(632, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 13:29:14', '6'),
(633, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:39:09', '6'),
(634, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:39:10', '6'),
(635, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 13:39:11', '6'),
(636, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 13:39:12', '6'),
(637, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:41:57', '6'),
(638, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:41:58', '6'),
(639, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:42:59', '6'),
(640, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 13:43:00', '6'),
(641, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 13:43:01', '6'),
(642, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 13:43:02', '6'),
(643, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-27 15:52:06', '6'),
(644, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-27 15:52:07', '6'),
(645, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-27 15:52:08', '6'),
(646, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-27 15:52:09', '6'),
(647, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-27 15:54:24', '6'),
(648, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-27 15:54:25', '6'),
(649, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-27 15:54:26', '6'),
(650, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-27 15:54:27', '6'),
(651, 'Email Send To [Email:elhaouari.ayman@gmail.com, Type:forgot-password]', '2016-10-27 16:55:34', NULL),
(652, 'Email Send To [Email:elhaouari.ayman@gmail.com, Type:forgot-password]', '2016-10-27 16:55:44', NULL),
(653, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:10:10', '3'),
(654, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:10:11', '3'),
(655, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:40:25', '3'),
(656, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:40:26', '3'),
(657, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 17:40:27', '3'),
(658, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 17:40:28', '3'),
(659, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:40:41', '3'),
(660, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:40:42', '3'),
(661, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:41:45', '3'),
(662, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:41:46', '3'),
(663, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:42:48', '3'),
(664, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:42:49', '3'),
(665, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 17:42:49', '3'),
(666, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 17:42:51', '3'),
(667, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:43:52', '6'),
(668, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:43:54', '6'),
(669, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 17:43:54', '6'),
(670, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 17:43:56', '6'),
(671, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:45:14', '6'),
(672, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:45:15', '6'),
(673, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:46:24', '6'),
(674, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:46:25', '6'),
(675, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 17:46:26', '6'),
(676, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 17:46:27', '6'),
(677, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:47:30', '6'),
(678, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 17:47:31', '6'),
(679, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 17:47:32', '6'),
(680, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 17:47:33', '6'),
(681, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 18:15:46', '6'),
(682, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 18:15:47', '6'),
(683, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 18:16:20', '6'),
(684, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-10-27 18:16:21', '6'),
(685, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 18:16:22', '6'),
(686, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-10-27 18:16:23', '6'),
(687, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-27 18:17:30', '6'),
(688, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-10-27 18:17:31', '6'),
(689, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-27 18:17:32', '6'),
(690, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-10-27 18:17:33', '6'),
(691, 'Project Updated [ID: 4]', '2016-10-28 11:07:31', '3'),
(692, 'Email Send To [Email:ext.naffah@deepmaroc.com, Type:forgot-password]', '2016-11-01 11:47:24', NULL),
(693, 'Email Send To [Email:elhaouari.ayman@gmail.com, Type:forgot-password]', '2016-11-01 12:38:35', NULL),
(694, 'Email Send To [Email:ext.naffah@deepmaroc.com, Type:forgot-password]', '2016-11-01 15:10:30', NULL),
(695, 'User Reseted Password [User ID:3, Staff:1, IP:::1]', '2016-11-01 15:14:40', NULL),
(696, 'Email Send To [Email:ext.naffah@deepmaroc.com, Type:reset-password]', '2016-11-01 15:14:42', NULL),
(697, 'Email Send To [Email:elhaouari.ayman@gmail.com, Type:forgot-password]', '2016-11-01 15:40:40', NULL),
(698, 'Settings Updated []', '2016-11-02 18:13:19', '3'),
(699, 'Settings Updated []', '2016-11-02 18:13:33', '3'),
(700, 'New Client Created [Supplier Test From Staff: 3]', '2016-11-09 11:13:47', '3'),
(701, 'Supplier Info Updated [Supplier Test23]', '2016-11-09 11:16:08', '3'),
(702, 'New Client Created [System V From Staff: 3]', '2016-11-09 11:24:19', '3'),
(703, 'Email Send To [Email:ayman.elhaouari@gmail.com, Type:set-password]', '2016-11-09 12:25:22', '3'),
(704, 'Email Send To [Email:rokaya.tahour@deepmaroc.com, Type:set-password]', '2016-11-09 12:30:37', '3'),
(705, 'Email Send To [Email:rokaya23.tahour@deepmaroc.com, Type:set-password]', '2016-11-09 12:33:20', '3'),
(706, 'Email Send To [Email:oussama.ferdous@deepmaroc.com, Type:set-password]', '2016-11-09 12:36:37', '3'),
(707, 'Contact Status Changed [ContactID: 7 Status(Active/Inactive): 0]', '2016-11-09 17:42:40', '3'),
(708, 'Contact Status Changed [ContactID: 6 Status(Active/Inactive): 0]', '2016-11-09 17:42:41', '3'),
(709, 'Contact Status Changed [ContactID: 7 Status(Active/Inactive): 1]', '2016-11-09 17:42:42', '3'),
(710, 'Contact Status Changed [ContactID: 6 Status(Active/Inactive): 1]', '2016-11-09 17:42:43', '3'),
(711, 'Supplier Info Updated [Supplier Test23]', '2016-11-10 11:07:12', '3'),
(712, 'Supplier contact Status Changed [ContactID: 0 Status(Active/Inactive): 0]', '2016-11-10 12:00:43', '3'),
(713, 'Supplier contact Status Changed [ContactID: 0 Status(Active/Inactive): 1]', '2016-11-10 12:00:44', '3'),
(714, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-11-14 11:57:54', NULL),
(715, 'Custom Field Status Changed [FieldID: 3 - Active: 1]', '2016-11-16 13:07:16', '3'),
(716, 'Custom Field Status Changed [FieldID: 4 - Active: 1]', '2016-11-16 13:07:17', '3'),
(717, 'Copied Invoice F-2016/000152', '2016-11-16 16:27:43', '3'),
(718, 'Email Send To [Email:i.ab@deepmaroc.com, Template:Staff added as project member]', '2016-11-21 11:31:34', '3'),
(719, 'New Project Created [ID: 7]', '2016-11-21 11:31:34', '3'),
(720, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:Staff added as project member]', '2016-11-21 11:35:30', '3'),
(721, 'New Project Created [ID: 8]', '2016-11-21 11:35:30', '3'),
(722, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-11-21 12:53:53', '3'),
(723, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Project File Uploaded (Sent to customer contacts)]', '2016-11-21 12:53:54', '3'),
(724, 'Custom Field Status Changed [FieldID: 3 - Active: 0]', '2016-11-21 15:32:58', '3'),
(725, 'Custom Field Status Changed [FieldID: 3 - Active: 1]', '2016-11-21 15:32:59', '3'),
(726, 'Custom Field Status Changed [FieldID: 4 - Active: 0]', '2016-11-21 15:33:00', '3'),
(727, 'Custom Field Status Changed [FieldID: 3 - Active: 0]', '2016-11-21 16:44:15', '3'),
(728, 'Custom Field Status Changed [FieldID: 1 - Active: 0]', '2016-11-21 16:44:15', '3'),
(729, 'New Reminder Added [SupplierID: 3 Description: ]', '2016-11-21 17:46:30', '3'),
(730, 'New Reminder Added [SupplierID: 3 Description: ]', '2016-11-21 17:47:41', '3'),
(731, 'New Reminder Added [CustomerID: 3 Description: ]', '2016-11-21 17:48:48', '3'),
(732, 'Email Send To [Email:i.ab@deepmaroc.com, Template:Staff added as project member]', '2016-11-22 11:23:11', '3'),
(733, 'Supplier Info Updated [System V]', '2016-11-28 12:10:26', '3'),
(734, 'Project Deleted [ID: 8, Name: 13]', '2016-11-28 12:36:52', '3'),
(735, 'Payment Mode Status Changed [ModeID: 1 Status(Active/Inactive): 0]', '2016-12-01 12:31:44', '3'),
(736, 'Payment Mode Status Changed [ModeID: 1 Status(Active/Inactive): 1]', '2016-12-01 12:31:50', '3'),
(737, 'Cron Invoked Manually', '2016-12-01 12:37:09', '3'),
(738, 'Email sent to: ext.naffah@deepmaroc.com Subject:Nouveau rappel pour ', '2016-12-01 12:37:19', '3'),
(739, 'Email sent to: ext.naffah@deepmaroc.com Subject:Nouveau rappel pour ', '2016-12-01 12:37:20', '3'),
(740, 'Email sent to: ext.naffah@deepmaroc.com Subject:Nouveau rappel pour client', '2016-12-01 12:37:21', '3'),
(741, 'Invoice Status Updated [Invoice Number: F-2016/000145, From: Impayée To: Echue]', '2016-12-01 12:37:27', '3'),
(742, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Overdue Notice]', '2016-12-01 12:37:30', '3'),
(743, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:Invoice Overdue Notice]', '2016-12-01 12:37:32', '3'),
(744, 'Invoice Status Updated [Invoice Number: F-2016/000149, From: Unpaid To: Overdue]', '2016-12-01 12:37:32', '3'),
(745, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Overdue Notice]', '2016-12-01 12:37:34', '3'),
(746, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:Invoice Overdue Notice]', '2016-12-01 12:37:35', '3'),
(747, 'Invoice Status Updated [Invoice Number: F-2016/000150, From: Unpaid To: Overdue]', '2016-12-01 12:37:35', '3'),
(748, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Overdue Notice]', '2016-12-01 12:37:37', '3'),
(749, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:Invoice Overdue Notice]', '2016-12-01 12:37:39', '3'),
(750, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Auto Close Ticket]', '2016-12-01 12:37:41', '3'),
(751, 'New Client Created [TEST ON SERVER  From Staff: 3]', '2016-12-05 12:48:31', '3'),
(752, 'Email Send To [Email:i.ab@deepmaroc.com, Template:Staff added as project member]', '2016-12-05 12:53:22', '3'),
(753, 'New Project Created [ID: 9]', '2016-12-05 12:53:22', '3'),
(754, 'Project Updated [ID: 9]', '2016-12-05 13:13:58', '3'),
(755, 'Supplier Info Updated [Supplier Test23]', '2016-12-05 13:29:20', '3'),
(756, 'Customer Info Updated [IXINA]', '2016-12-05 16:17:31', '3'),
(757, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-12-05 17:46:27', NULL),
(758, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-12-05 17:46:29', NULL),
(759, 'New Project Created [ID: 10]', '2016-12-05 18:32:41', '3'),
(760, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 10:53:49', '3'),
(761, 'Email Send To [Email:i.ab@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 10:54:15', '3'),
(762, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 12:39:52', '3'),
(763, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 12:40:34', '3'),
(764, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 12:40:55', '3'),
(765, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 12:43:03', '3'),
(766, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 15:30:58', '3'),
(767, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 15:31:16', '3'),
(768, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 15:31:23', '3'),
(769, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 15:31:33', '3'),
(770, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 15:32:06', '3'),
(771, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 15:32:58', '3'),
(772, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 15:33:07', '3'),
(773, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 15:33:38', '3'),
(774, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 15:35:25', '3'),
(775, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Project File Uploaded (Sent to project members)]', '2016-12-06 15:35:37', '3'),
(776, 'Email Template Updated [3]', '2016-12-06 19:16:48', '3'),
(777, 'Email Template Updated [3]', '2016-12-06 19:25:38', '3'),
(778, 'Email Template Updated [3]', '2016-12-06 19:32:10', '3'),
(779, 'Email Template Updated [3]', '2016-12-06 19:33:03', '3'),
(780, 'Email Template Updated [3]', '2016-12-07 11:00:53', '3'),
(781, 'Email Template Updated [3]', '2016-12-07 11:15:34', '6'),
(782, 'Email Template Updated [3]', '2016-12-07 11:16:11', '3'),
(783, 'Email Template Updated [3]', '2016-12-07 11:16:57', '3'),
(784, 'Email Template Updated [3]', '2016-12-07 11:25:35', '6'),
(785, 'Email Template Updated [3]', '2016-12-07 11:25:51', '6'),
(786, 'Email Template Updated [3]', '2016-12-07 11:26:09', '6'),
(787, 'Email Template Updated [3]', '2016-12-07 11:26:33', '3'),
(788, 'Email Template Updated [3]', '2016-12-07 11:32:55', '3'),
(789, 'Email Template Updated [3]', '2016-12-07 11:33:01', '3'),
(790, 'Email Template Updated [3]', '2016-12-07 11:35:41', '3'),
(791, 'Email Template Updated [3]', '2016-12-07 11:36:07', '3'),
(792, 'Email Template Updated [3]', '2016-12-07 11:36:15', '3'),
(793, 'Email Template Updated [3]', '2016-12-07 11:36:27', '3'),
(794, 'Email Template Updated [3]', '2016-12-07 11:36:45', '3'),
(795, 'Email Template Updated [3]', '2016-12-07 11:38:20', '3'),
(796, 'Email Template Updated [3]', '2016-12-07 11:38:58', '3'),
(797, 'Email Template Updated [3]', '2016-12-07 11:39:21', '3'),
(798, 'Email Template Updated [3]', '2016-12-07 11:39:32', '3'),
(799, 'Email Template Updated [3]', '2016-12-07 11:39:46', '3'),
(800, 'Email Template Updated [3]', '2016-12-07 11:39:50', '3'),
(801, 'Email Template Updated [3]', '2016-12-07 11:40:22', '3'),
(802, 'Email Template Updated [3]', '2016-12-07 11:40:40', '3'),
(803, 'Email Template Updated [3]', '2016-12-07 11:41:56', '3'),
(804, 'Email Template Updated [3]', '2016-12-07 12:13:38', '3'),
(805, 'Email Template Updated [3]', '2016-12-07 12:13:45', '3'),
(806, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Send Invoice to Customer]', '2016-12-07 13:57:38', '3'),
(807, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 15:15:18', '3'),
(808, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 15:16:53', '3'),
(809, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Send Invoice to Customer]', '2016-12-07 15:20:55', '3'),
(810, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 15:55:45', '3'),
(811, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 15:57:43', '3'),
(812, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 15:58:26', '3'),
(813, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 15:59:08', '3'),
(814, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Send Invoice to Customer]', '2016-12-07 16:02:01', '3'),
(815, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 16:08:29', '3'),
(816, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 16:09:32', '3'),
(817, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 16:12:46', '3'),
(818, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 16:13:23', '3'),
(819, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 16:14:08', '3'),
(820, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 16:27:07', '3'),
(821, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 17:00:30', '3'),
(822, 'Email Template Not Found', '2016-12-07 17:04:10', '3'),
(823, 'Email Template Not Found', '2016-12-07 17:05:22', '3'),
(824, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 17:06:07', '3'),
(825, 'Email Template Not Found', '2016-12-07 17:07:58', '3'),
(826, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-07 17:20:38', '3'),
(827, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-07 17:21:55', '3'),
(828, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-07 17:24:01', '3'),
(829, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 17:29:37', '3'),
(830, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-07 17:32:31', '3'),
(831, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-07 17:34:32', '3'),
(832, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-07 17:38:42', '3'),
(833, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 17:41:51', '3'),
(834, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Invoice Already Sent to Customer]', '2016-12-07 17:43:03', '3'),
(835, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-07 17:48:08', '3'),
(836, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-07 17:48:54', '3'),
(837, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-08 11:32:16', '3'),
(838, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-08 11:33:26', '3'),
(839, 'Email Template Not Found', '2016-12-08 13:12:06', '3'),
(840, 'Email Template Not Found', '2016-12-08 13:12:19', '3'),
(841, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-08 13:12:29', '3'),
(842, 'Email Template Not Found', '2016-12-08 13:12:29', '3'),
(843, 'Email Template Not Found', '2016-12-08 15:06:33', '3'),
(844, 'Email Template Updated [3]', '2016-12-08 15:27:40', '3'),
(845, 'New Task Added [ID:8, Name: sujet]', '2016-12-08 16:36:12', '3'),
(846, 'Email Template Not Found', '2016-12-08 16:36:19', '3'),
(847, 'Email Template Not Found', '2016-12-08 16:36:21', '3'),
(848, 'Email Template Not Found', '2016-12-08 16:36:40', '3'),
(849, 'Email Template Not Found', '2016-12-08 16:37:23', '3'),
(850, 'Email Template Not Found', '2016-12-08 16:37:28', '3'),
(851, 'Email Template Not Found', '2016-12-08 16:41:15', '3'),
(852, 'Email Template Not Found', '2016-12-08 16:41:15', '3'),
(853, 'Email Template Not Found', '2016-12-08 16:41:15', '3'),
(854, 'Email Template Not Found', '2016-12-08 16:42:31', '3'),
(855, 'Email Template Not Found', '2016-12-08 16:42:31', '3'),
(856, 'Email Template Not Found', '2016-12-08 16:42:31', '3'),
(857, 'Email Template Not Found', '2016-12-08 16:50:20', '3'),
(858, 'Email Template Not Found', '2016-12-08 16:50:20', '3'),
(859, 'Email Template Not Found', '2016-12-08 16:50:20', '3'),
(860, 'Inactive User Tried to Login [Email:elhaouari.ayman@gmail.com, Staff:, IP:::1]', '2016-12-08 16:54:41', NULL),
(861, 'Inactive User Tried to Login [Email:elhaouari.ayman@gmail.com, Staff:, IP:::1]', '2016-12-08 16:54:54', NULL),
(862, 'Custom Field Status Changed [FieldID: 3 - Active: 1]', '2016-12-08 16:55:21', '3'),
(863, 'Failed Login Attempt [Email:elhoauari.ayman@gmail.com, Staff:, IP:::1]', '2016-12-08 16:55:27', NULL),
(864, 'Email Template Not Found', '2016-12-08 16:56:30', '3'),
(865, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Project Discussion (Sent to customer contacts)]', '2016-12-08 16:56:32', '3'),
(866, 'Email Template Not Found', '2016-12-08 16:56:32', '3'),
(867, 'Email Template Not Found', '2016-12-08 16:56:42', '3'),
(868, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-08 16:56:43', '3'),
(869, 'Email Template Not Found', '2016-12-08 16:56:43', '3'),
(870, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-08 16:59:41', '3'),
(871, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-08 17:00:03', '3'),
(872, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-08 17:01:20', '3'),
(873, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Facture déjà envoyée au client]', '2016-12-08 17:02:09', '3'),
(874, 'Invoice Status Updated [Invoice Number: F-2016/000150, From: Echue To: Impayée]', '2016-12-08 17:03:54', '3'),
(875, 'Email Template Not Found', '2016-12-09 11:06:31', '3'),
(876, 'Email Template Updated [99]', '2016-12-09 11:23:44', '3'),
(877, 'Email Template Updated [10]', '2016-12-09 11:25:05', '3'),
(878, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Send Estimate to Customer]', '2016-12-09 11:25:40', '3'),
(879, 'Email Template Not Found', '2016-12-09 11:25:40', '3'),
(880, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Ticket Opened (Opened by staff, sent to customer)]', '2016-12-09 11:28:46', '3'),
(881, 'New Ticket Created [ID: 24]', '2016-12-09 11:28:46', '3'),
(882, 'New Task Added [ID:9, Name: Sujet Tache]', '2016-12-09 11:36:49', '3'),
(883, 'Email Template Not Found', '2016-12-09 11:38:13', '3'),
(884, 'Email Template Not Found', '2016-12-09 11:38:17', '3'),
(885, 'New Task Added [ID:10, Name: Sujet tache 2]', '2016-12-09 11:41:12', '3'),
(886, 'Proposal Converted to Invoice [InvoiceID: 92, ProposalID: 1]', '2016-12-09 11:47:05', '3'),
(887, 'New Task Added [ID:11, Name: Sujet de la tache]', '2016-12-09 12:07:44', '3'),
(888, 'Email Template Not Found', '2016-12-09 12:08:00', '3'),
(889, 'Email Template Not Found', '2016-12-09 12:08:04', '3'),
(890, 'Email Template Not Found', '2016-12-09 12:08:49', '3'),
(891, 'New Task Added [ID:12, Name: Sujet tach estimate ]', '2016-12-09 12:10:01', '3'),
(892, 'Email Template Not Found', '2016-12-09 12:10:06', '3'),
(893, 'Email Template Not Found', '2016-12-09 12:10:08', '3'),
(894, 'Email Template Not Found', '2016-12-09 12:10:15', '3'),
(895, 'Email Template Not Found', '2016-12-09 12:15:45', '3'),
(896, 'New Task Added [ID:13, Name: new task]', '2016-12-09 12:16:35', '3'),
(897, 'Contact Updated [Sanaà Sakhraoui]', '2016-12-09 12:58:49', '3'),
(898, 'Contact Updated [Ayman EL HAOUARI]', '2016-12-09 12:59:03', '3'),
(899, 'Contact Updated [Sanaà Sakhraoui]', '2016-12-09 12:59:37', '3'),
(900, 'Email Template Updated [37]', '2016-12-09 13:01:39', '3'),
(901, 'Email Template Updated [40]', '2016-12-09 13:02:28', '3'),
(902, 'Email Template Not Found', '2016-12-09 13:02:55', '3'),
(903, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 13:02:56', '3'),
(904, 'Email Template Not Found', '2016-12-09 13:02:56', '3'),
(905, 'Email Template Not Found', '2016-12-09 13:04:44', '3'),
(906, 'Email Template Not Found', '2016-12-09 13:04:44', '3'),
(907, 'Email Template Not Found', '2016-12-09 13:04:44', '3'),
(908, 'Email Template Not Found', '2016-12-09 13:20:17', '3'),
(909, 'Email Template Not Found', '2016-12-09 13:20:17', '3'),
(910, 'Email Template Not Found', '2016-12-09 13:20:17', '3'),
(911, 'Email Template Not Found', '2016-12-09 13:28:21', '3'),
(912, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 13:28:22', '3'),
(913, 'Email Template Not Found', '2016-12-09 13:28:22', '3'),
(914, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 13:39:05', '3'),
(915, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 13:39:06', '3'),
(916, 'Email Template Not Found', '2016-12-09 13:39:06', '3'),
(917, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 13:42:40', '3'),
(918, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:]', '2016-12-09 13:42:41', '3'),
(919, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:]', '2016-12-09 13:42:42', '3'),
(920, 'Contact Updated [Ayman EL HAOUARI]', '2016-12-09 13:49:05', '3'),
(921, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 13:50:21', NULL),
(922, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 13:50:23', NULL),
(923, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 13:50:24', NULL),
(924, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 14:01:51', '3'),
(925, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 14:01:52', '3'),
(926, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 14:01:53', '3'),
(927, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 14:05:12', '3'),
(928, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 14:05:13', '3'),
(929, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 14:05:14', '3'),
(930, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 14:06:33', '3'),
(931, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 14:06:34', '3'),
(932, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 14:06:35', '3'),
(933, 'Email Template Updated [41]', '2016-12-09 14:08:10', '3'),
(934, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 14:08:27', '3'),
(935, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 14:08:28', '3'),
(936, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 14:08:30', '3'),
(937, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 14:09:48', '3'),
(938, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 14:09:49', '3'),
(939, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 14:09:50', '3'),
(940, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 15:14:32', NULL),
(941, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 15:14:33', NULL),
(942, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 15:14:34', NULL),
(943, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 15:16:53', '3'),
(944, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 15:16:54', '3'),
(945, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 15:16:55', '3'),
(946, 'Email Send To [Email:ext.naffah@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 15:24:49', NULL),
(947, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 15:24:50', NULL),
(948, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:Staff Added as Follower on Task]', '2016-12-09 15:24:51', NULL),
(949, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 15:25:13', '3'),
(950, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:Staff Added as Follower on Task]', '2016-12-09 15:25:14', '3'),
(951, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:Staff Added as Follower on Task]', '2016-12-09 15:25:15', '3'),
(952, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 15:26:07', '3'),
(953, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 15:26:08', '3'),
(954, 'Email Template Not Found', '2016-12-09 15:26:08', '3'),
(955, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 16:11:20', '3'),
(956, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:11:21', '3'),
(957, 'Email Template Not Found', '2016-12-09 16:11:21', '3'),
(958, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 16:13:37', '3'),
(959, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:13:38', '3'),
(960, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:13:39', '3'),
(961, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 16:15:15', '3'),
(962, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:15:16', '3'),
(963, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:15:17', '3'),
(964, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 16:15:35', '3'),
(965, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:15:36', '3'),
(966, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:15:37', '3'),
(967, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 16:20:55', '3'),
(968, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:20:56', '3'),
(969, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:20:57', '3'),
(970, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 16:21:31', '3');
INSERT INTO `tblactivitylog` (`id`, `description`, `date`, `staffid`) VALUES
(971, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:21:32', '3'),
(972, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:21:34', '3'),
(973, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 16:22:29', '3'),
(974, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:22:30', '3'),
(975, 'Email Send To [Email:s.sakhraoui@deepmaroc.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:22:31', '3'),
(976, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 16:24:48', '3'),
(977, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 16:24:49', '3'),
(978, 'Email Template Not Found', '2016-12-09 16:24:49', '3'),
(979, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-12-09 18:23:11', '3'),
(980, 'Email Send To [Email:f.aboullait@deepmaroc.com, Template:New Discussion Comment (Sent to project members)]', '2016-12-09 18:23:52', '3'),
(981, 'Email Send To [Email:elhaouari.ayman@gmail.com, Template:New Discussion Comment (Sent to customer contacts)]', '2016-12-09 18:23:53', '3'),
(982, 'Email Template Not Found', '2016-12-09 18:23:54', '3'),
(983, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-12-14 11:51:54', NULL),
(984, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2016-12-20 11:38:56', NULL),
(985, 'Failed Login Attempt [Email:ext.naffah@deepmaroc.com, Staff:, IP:::1]', '2017-01-16 13:05:04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblannouncements`
--

CREATE TABLE `tblannouncements` (
  `announcementid` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `message` text,
  `showtousers` int(11) NOT NULL,
  `showtostaff` int(11) NOT NULL,
  `showname` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblannouncements`
--

INSERT INTO `tblannouncements` (`announcementid`, `name`, `message`, `showtousers`, `showtostaff`, `showname`, `dateadded`, `userid`) VALUES
(1, 'Annonce', 'HELLO WORLD', 1, 1, 1, '2016-10-24 11:51:56', 3),
(2, 'annonce', '', 1, 1, 1, '2016-10-24 12:47:19', 6),
(3, 'annonce1', '', 1, 1, 1, '2016-10-25 11:28:06', 3);

-- --------------------------------------------------------

--
-- Structure de la table `tblclientattachments`
--

CREATE TABLE `tblclientattachments` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `file_name` mediumtext NOT NULL,
  `filetype` varchar(25) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblclientattachments`
--

INSERT INTO `tblclientattachments` (`id`, `clientid`, `file_name`, `filetype`, `datecreated`) VALUES
(1, 1, 'Capture-dâ€™Ã©cran-2016-08-31-Ã -12.41_.18_.png', 'image/png', '2016-09-06 13:30:55'),
(2, 1, 'Capture-dâ€™Ã©cran-2016-08-31-Ã -12.41_.27_.png', 'image/png', '2016-09-06 13:31:20'),
(5, 2, 'MCSA01598469_HSG736257M_Packshot_def.jpg', 'image/jpeg', '2016-09-26 17:23:52'),
(6, 2, 'MCSA01616435_1066108_HSG736257M_def.jpg', 'image/jpeg', '2016-09-26 17:23:57'),
(7, 2, 'MCSA01616437_1066110_HSG736257M_def.jpg', 'image/jpeg', '2016-09-26 17:24:01'),
(8, 2, 'DSC_0652_252x168.jpg', 'image/jpeg', '2016-09-26 17:24:08'),
(10, 2, 'Capture.png', 'image/png', '2016-09-26 17:25:41'),
(11, 2, 'MCSA01616435_1066108_HSG736257M_def-1.jpg', 'image/jpeg', '2016-09-27 18:02:31'),
(13, 3, 'UsbFix_Report.txt', 'text/plain', '2016-11-28 17:25:41'),
(15, 3, '17734.txt', 'text/plain', '2016-12-08 16:39:23');

-- --------------------------------------------------------

--
-- Structure de la table `tblclients`
--

CREATE TABLE `tblclients` (
  `userid` int(11) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `vat` varchar(50) DEFAULT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `country` int(11) NOT NULL DEFAULT '0',
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `profile_image` varchar(300) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  `mode_alami` tinyint(1) NOT NULL,
  `leadid` int(11) DEFAULT NULL,
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT '0',
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT '0',
  `longitude` varchar(300) DEFAULT NULL,
  `latitude` varchar(300) DEFAULT NULL,
  `default_language` varchar(40) DEFAULT NULL,
  `default_currency` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblclients`
--

INSERT INTO `tblclients` (`userid`, `company`, `vat`, `phonenumber`, `country`, `city`, `zip`, `state`, `address`, `datecreated`, `profile_image`, `actif`, `mode_alami`, `leadid`, `billing_street`, `billing_city`, `billing_state`, `billing_zip`, `billing_country`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `longitude`, `latitude`, `default_language`, `default_currency`) VALUES
(1, 'IXINA', '', '+212 0522 46 69 30', 149, 'Casablanca', '20100', 'Quartier Gauthier', '161, rue Taha Houcine', '2016-09-04 01:37:07', 'deep-silver-logo.jpg', 0, 1, 1, '161, rue Taha Houcine', 'Casablanca', 'Quartier Gauthier', '20100', 149, '161, rue Taha Houcine', 'Casablanca', 'Quartier Gauthier', '20100', 149, '', '', 'polish', 3),
(2, 'Deep Silver', '', '', 149, '', 'xcvxcv', 'xcwcvwx', 'hdfghdfh dfgdgd', '2016-09-06 15:40:54', 'ea1e755d.jpg', 1, 1, NULL, '', '', '', '', 149, '', '', '', '', 149, '', '', 'french', 3),
(3, 'Ayman\'s Company', '', '+212 698814480', 149, 'Casablanca', '', '', 'Yours', '2016-10-12 17:12:37', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'french', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblcommentlikes`
--

CREATE TABLE `tblcommentlikes` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dateliked` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblcontactpermissions`
--

CREATE TABLE `tblcontactpermissions` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblcontactpermissions`
--

INSERT INTO `tblcontactpermissions` (`id`, `permission_id`, `userid`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 1, 2),
(8, 2, 2),
(9, 3, 2),
(10, 4, 2),
(11, 5, 2),
(12, 6, 2),
(36, 6, 6),
(35, 5, 6),
(34, 4, 6),
(33, 3, 6),
(32, 2, 6),
(31, 1, 6),
(19, 1, 4),
(20, 2, 4),
(21, 3, 4),
(22, 4, 4),
(23, 5, 4),
(24, 6, 4),
(25, 1, 5),
(26, 2, 5),
(27, 3, 5),
(28, 4, 5),
(29, 5, 5),
(30, 6, 5),
(37, 1, 7),
(38, 2, 7),
(39, 3, 7),
(40, 4, 7),
(41, 5, 7),
(42, 6, 7),
(43, 1, 8),
(44, 2, 8),
(45, 3, 8),
(46, 4, 8),
(47, 5, 8),
(48, 6, 8),
(49, 1, 9),
(50, 2, 9),
(51, 3, 9),
(52, 4, 9),
(53, 5, 9),
(54, 6, 9),
(55, 1, 10),
(56, 2, 10),
(57, 3, 10),
(58, 4, 10),
(59, 5, 10),
(60, 6, 10),
(61, 1, 11),
(62, 2, 11),
(63, 3, 11),
(64, 4, 11),
(65, 5, 11),
(66, 6, 11);

-- --------------------------------------------------------

--
-- Structure de la table `tblcontactprojects`
--

CREATE TABLE `tblcontactprojects` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tblcontactprojects`
--

INSERT INTO `tblcontactprojects` (`id`, `project_id`, `contact_id`) VALUES
(35, 2, 3),
(55, 3, 7);

-- --------------------------------------------------------

--
-- Structure de la table `tblcontacts`
--

CREATE TABLE `tblcontacts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `is_primary` int(11) NOT NULL DEFAULT '1',
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `datecreated` datetime NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `new_pass_key` varchar(32) DEFAULT NULL,
  `new_pass_key_requested` datetime DEFAULT NULL,
  `last_ip` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_password_change` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `email_cc` tinyint(1) NOT NULL,
  `profile_image` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblcontacts`
--

INSERT INTO `tblcontacts` (`id`, `userid`, `is_primary`, `firstname`, `lastname`, `email`, `phonenumber`, `title`, `datecreated`, `password`, `new_pass_key`, `new_pass_key_requested`, `last_ip`, `last_login`, `last_password_change`, `active`, `email_cc`, `profile_image`) VALUES
(1, 1, 1, 'Justin', 'Auriel', 'i.ab@deepmaroc.com', '0661286816', 'Directeur GÃ©nÃ©ral', '2016-09-04 01:38:19', '$2a$08$m01GXja7kCO.5p9Gg/MCRubSv2T5ZPxw6EmxJs1o9t/vjzb3eAXpG', 'af07430d310b2a8c0a0c4adb3fa96156', '2016-09-04 01:38:21', '41.141.146.19', '2016-10-06 11:45:30', NULL, 1, 1, NULL),
(2, 1, 0, 'Nordine', 'Alami', 'n.alami@deepmaroc.com', '', 'Responsable Achats', '2016-09-04 01:41:45', '$2a$08$0B/B/Y/I0cJSFqngafc.EOzkVW3.bf9WNSrjKpoyTbgnKU3SZw17O', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL),
(3, 2, 0, 'Ahmed', 'Ab', 'faissal.ab@gmail.com', '0633181834', '', '2016-09-06 17:49:54', '$2a$08$FArDDhFUUkvOGyeq9w69Jei3l7a/j1DBtEWcnK2KKns3mWpGUu306', NULL, NULL, '105.156.13.120', '2016-09-21 17:03:17', '2016-09-21 17:16:30', 0, 1, NULL),
(4, 2, 0, 'ikram ', 'khadija', 'f.aboullait@deepmaroc.com', '', '', '2016-09-09 17:35:23', '$2a$08$JlnD3m15graXy30RFCTQFuCWZ90HzQwkZo9hnJ6qV6PgO2KNxAkYW', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL),
(5, 2, 0, 'Muhcine', 'Mt', 'muhcine@test458.com', '65598', '1', '2016-09-14 17:02:14', '$2a$08$mAzYM7UvCtYry4QOs/Zy9O82qR6bi0ZpsxYWwS4pKLYhcH/swLwZ6', NULL, NULL, '41.251.43.150', '2016-09-27 15:08:16', '2016-09-21 17:15:56', 0, 1, NULL),
(6, 3, 1, 'Ayman', 'EL HAOUARI', 'elhaouari.ayman@gmail.com', 'ext.naffah@deepmaroc.com', '', '2016-10-12 17:12:37', '$2a$08$8bFAzrlNcwF3dQwxk5Wr4e8SnbrWRDQ5B4v5UEjVeCdbjXUvC7EQi', '94b118f06aafbc26e2ff811c89fdd775', '2016-11-01 15:40:39', '::1', '2017-01-13 13:32:12', '2016-12-09 13:49:05', 1, 0, NULL),
(7, 3, 0, 'Sanaà', 'Sakhraoui', 's.sakhraoui@deepmaroc.com', '0617032165', '', '2016-10-21 16:23:39', '$2a$08$69ZoYPqAh4ZS0nROqqvfHujEt0awSHrzVxizJxgXj38axqEWKYRC6', NULL, NULL, '::1', '2016-12-09 12:50:09', '2016-10-25 15:52:58', 1, 1, NULL),
(8, 2, 0, 'Ayman', 'el haoua', 'ayman.elhaouari@gmail.com', 'ext.naffah@deepmaroc.com', '', '2016-11-09 12:25:20', '$2a$08$7GZeWx3Rtb8rhPQV25XW6.8RxvZbxEjEE./sEeBUfILNrL9NnntOC', 'e9ace6858c219161beccc45d475bc88e', '2016-11-09 12:25:20', NULL, NULL, NULL, 1, 1, NULL),
(9, 2, 0, 'Ayman', 'EL HAOUARI', 'rokaya.tahour@deepmaroc.com', 'ext.naffah@deepmaroc.com', '', '2016-11-09 12:30:36', '$2a$08$FCEtNIELWSkXpMIHnMKVD.lPn/LLxKmU5BBKtz3cFAuKmlg3yDxLO', 'cdbfb0eb5f2d56bce5f48d77d5fa822f', '2016-11-09 12:30:36', NULL, NULL, NULL, 1, 1, NULL),
(10, 2, 0, 'The boss', 'Aboullait', 'rokaya23.tahour@deepmaroc.com', 'ext.naffah@deepmaroc.com', '', '2016-11-09 12:33:19', '$2a$08$YBh0gw9WwytKOg3QeZRteuKN6Tc8VN/V90C//l.rlzukk01SSk9Hy', '1ebe344f415b588df4f70ff7fcb31248', '2016-11-09 12:33:19', NULL, NULL, NULL, 1, 1, NULL),
(11, 2, 1, 'Ayman', 'NAFFAH', 'oussama.ferdous@deepmaroc.com', 'ext.naffah@deepmaroc.com', '', '2016-11-09 12:36:36', '$2a$08$L86kTO/4GnNt/VneE4wmIOnfv/nF.R6ce4Kp0wmJkO.SnyZU3Mxd6', 'c0ec4439ad65a81cb8e33f38d213a5d1', '2016-11-09 12:36:36', NULL, NULL, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblcontractattachments`
--

CREATE TABLE `tblcontractattachments` (
  `id` int(11) NOT NULL,
  `contractid` int(11) NOT NULL,
  `file_name` mediumtext NOT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `dateadded` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblcontractrenewals`
--

CREATE TABLE `tblcontractrenewals` (
  `id` int(11) NOT NULL,
  `contractid` int(11) NOT NULL,
  `old_start_date` date NOT NULL,
  `new_start_date` date NOT NULL,
  `old_end_date` date DEFAULT NULL,
  `new_end_date` date DEFAULT NULL,
  `old_value` decimal(11,2) DEFAULT NULL,
  `new_value` decimal(11,2) DEFAULT NULL,
  `date_renewed` datetime NOT NULL,
  `renewed_by` int(11) NOT NULL,
  `is_on_old_expiry_notified` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblcontracts`
--

CREATE TABLE `tblcontracts` (
  `id` int(11) NOT NULL,
  `content` longtext,
  `description` text,
  `subject` varchar(300) DEFAULT NULL,
  `client` int(11) NOT NULL,
  `datestart` date DEFAULT NULL,
  `dateend` date DEFAULT NULL,
  `contract_type` int(11) DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `isexpirynotified` int(11) NOT NULL DEFAULT '0',
  `contract_value` decimal(11,2) DEFAULT NULL,
  `trash` tinyint(1) DEFAULT '0',
  `not_visible_to_client` tinyint(1) NOT NULL DEFAULT '0',
  `supplier` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblcontracts`
--

INSERT INTO `tblcontracts` (`id`, `content`, `description`, `subject`, `client`, `datestart`, `dateend`, `contract_type`, `addedfrom`, `dateadded`, `isexpirynotified`, `contract_value`, `trash`, `not_visible_to_client`, `supplier`) VALUES
(1, NULL, '', 'sujet', 2, '2016-10-13', '2016-10-11', 0, 3, '2016-10-13 17:59:22', 0, '70000.00', 0, 0, 0),
(2, NULL, '', '123', 3, '2016-10-21', '2016-10-16', 0, 3, '2016-10-21 18:27:44', 0, '1354.00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblcontracttypes`
--

CREATE TABLE `tblcontracttypes` (
  `id` int(11) NOT NULL,
  `name` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblcountries`
--

CREATE TABLE `tblcountries` (
  `country_id` int(5) NOT NULL,
  `iso2` char(2) DEFAULT NULL,
  `short_name` varchar(80) NOT NULL DEFAULT '',
  `long_name` varchar(80) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` varchar(6) DEFAULT NULL,
  `un_member` varchar(12) DEFAULT NULL,
  `calling_code` varchar(8) DEFAULT NULL,
  `cctld` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblcountries`
--

INSERT INTO `tblcountries` (`country_id`, `iso2`, `short_name`, `long_name`, `iso3`, `numcode`, `un_member`, `calling_code`, `cctld`) VALUES
(1, 'AF', 'Afghanistan', 'Islamic Republic of Afghanistan', 'AFG', '004', 'yes', '93', '.af'),
(2, 'AX', 'Aland Islands', '&Aring;land Islands', 'ALA', '248', 'no', '358', '.ax'),
(3, 'AL', 'Albania', 'Republic of Albania', 'ALB', '008', 'yes', '355', '.al'),
(4, 'DZ', 'Algeria', 'People\'s Democratic Republic of Algeria', 'DZA', '012', 'yes', '213', '.dz'),
(5, 'AS', 'American Samoa', 'American Samoa', 'ASM', '016', 'no', '1+684', '.as'),
(6, 'AD', 'Andorra', 'Principality of Andorra', 'AND', '020', 'yes', '376', '.ad'),
(7, 'AO', 'Angola', 'Republic of Angola', 'AGO', '024', 'yes', '244', '.ao'),
(8, 'AI', 'Anguilla', 'Anguilla', 'AIA', '660', 'no', '1+264', '.ai'),
(9, 'AQ', 'Antarctica', 'Antarctica', 'ATA', '010', 'no', '672', '.aq'),
(10, 'AG', 'Antigua and Barbuda', 'Antigua and Barbuda', 'ATG', '028', 'yes', '1+268', '.ag'),
(11, 'AR', 'Argentina', 'Argentine Republic', 'ARG', '032', 'yes', '54', '.ar'),
(12, 'AM', 'Armenia', 'Republic of Armenia', 'ARM', '051', 'yes', '374', '.am'),
(13, 'AW', 'Aruba', 'Aruba', 'ABW', '533', 'no', '297', '.aw'),
(14, 'AU', 'Australia', 'Commonwealth of Australia', 'AUS', '036', 'yes', '61', '.au'),
(15, 'AT', 'Austria', 'Republic of Austria', 'AUT', '040', 'yes', '43', '.at'),
(16, 'AZ', 'Azerbaijan', 'Republic of Azerbaijan', 'AZE', '031', 'yes', '994', '.az'),
(17, 'BS', 'Bahamas', 'Commonwealth of The Bahamas', 'BHS', '044', 'yes', '1+242', '.bs'),
(18, 'BH', 'Bahrain', 'Kingdom of Bahrain', 'BHR', '048', 'yes', '973', '.bh'),
(19, 'BD', 'Bangladesh', 'People\'s Republic of Bangladesh', 'BGD', '050', 'yes', '880', '.bd'),
(20, 'BB', 'Barbados', 'Barbados', 'BRB', '052', 'yes', '1+246', '.bb'),
(21, 'BY', 'Belarus', 'Republic of Belarus', 'BLR', '112', 'yes', '375', '.by'),
(22, 'BE', 'Belgium', 'Kingdom of Belgium', 'BEL', '056', 'yes', '32', '.be'),
(23, 'BZ', 'Belize', 'Belize', 'BLZ', '084', 'yes', '501', '.bz'),
(24, 'BJ', 'Benin', 'Republic of Benin', 'BEN', '204', 'yes', '229', '.bj'),
(25, 'BM', 'Bermuda', 'Bermuda Islands', 'BMU', '060', 'no', '1+441', '.bm'),
(26, 'BT', 'Bhutan', 'Kingdom of Bhutan', 'BTN', '064', 'yes', '975', '.bt'),
(27, 'BO', 'Bolivia', 'Plurinational State of Bolivia', 'BOL', '068', 'yes', '591', '.bo'),
(28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', 'BES', '535', 'no', '599', '.bq'),
(29, 'BA', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', 'BIH', '070', 'yes', '387', '.ba'),
(30, 'BW', 'Botswana', 'Republic of Botswana', 'BWA', '072', 'yes', '267', '.bw'),
(31, 'BV', 'Bouvet Island', 'Bouvet Island', 'BVT', '074', 'no', 'NONE', '.bv'),
(32, 'BR', 'Brazil', 'Federative Republic of Brazil', 'BRA', '076', 'yes', '55', '.br'),
(33, 'IO', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'IOT', '086', 'no', '246', '.io'),
(34, 'BN', 'Brunei', 'Brunei Darussalam', 'BRN', '096', 'yes', '673', '.bn'),
(35, 'BG', 'Bulgaria', 'Republic of Bulgaria', 'BGR', '100', 'yes', '359', '.bg'),
(36, 'BF', 'Burkina Faso', 'Burkina Faso', 'BFA', '854', 'yes', '226', '.bf'),
(37, 'BI', 'Burundi', 'Republic of Burundi', 'BDI', '108', 'yes', '257', '.bi'),
(38, 'KH', 'Cambodia', 'Kingdom of Cambodia', 'KHM', '116', 'yes', '855', '.kh'),
(39, 'CM', 'Cameroon', 'Republic of Cameroon', 'CMR', '120', 'yes', '237', '.cm'),
(40, 'CA', 'Canada', 'Canada', 'CAN', '124', 'yes', '1', '.ca'),
(41, 'CV', 'Cape Verde', 'Republic of Cape Verde', 'CPV', '132', 'yes', '238', '.cv'),
(42, 'KY', 'Cayman Islands', 'The Cayman Islands', 'CYM', '136', 'no', '1+345', '.ky'),
(43, 'CF', 'Central African Republic', 'Central African Republic', 'CAF', '140', 'yes', '236', '.cf'),
(44, 'TD', 'Chad', 'Republic of Chad', 'TCD', '148', 'yes', '235', '.td'),
(45, 'CL', 'Chile', 'Republic of Chile', 'CHL', '152', 'yes', '56', '.cl'),
(46, 'CN', 'China', 'People\'s Republic of China', 'CHN', '156', 'yes', '86', '.cn'),
(47, 'CX', 'Christmas Island', 'Christmas Island', 'CXR', '162', 'no', '61', '.cx'),
(48, 'CC', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'CCK', '166', 'no', '61', '.cc'),
(49, 'CO', 'Colombia', 'Republic of Colombia', 'COL', '170', 'yes', '57', '.co'),
(50, 'KM', 'Comoros', 'Union of the Comoros', 'COM', '174', 'yes', '269', '.km'),
(51, 'CG', 'Congo', 'Republic of the Congo', 'COG', '178', 'yes', '242', '.cg'),
(52, 'CK', 'Cook Islands', 'Cook Islands', 'COK', '184', 'some', '682', '.ck'),
(53, 'CR', 'Costa Rica', 'Republic of Costa Rica', 'CRI', '188', 'yes', '506', '.cr'),
(54, 'CI', 'Cote d\'ivoire (Ivory Coast)', 'Republic of C&ocirc;te D\'Ivoire (Ivory Coast)', 'CIV', '384', 'yes', '225', '.ci'),
(55, 'HR', 'Croatia', 'Republic of Croatia', 'HRV', '191', 'yes', '385', '.hr'),
(56, 'CU', 'Cuba', 'Republic of Cuba', 'CUB', '192', 'yes', '53', '.cu'),
(57, 'CW', 'Curacao', 'Cura&ccedil;ao', 'CUW', '531', 'no', '599', '.cw'),
(58, 'CY', 'Cyprus', 'Republic of Cyprus', 'CYP', '196', 'yes', '357', '.cy'),
(59, 'CZ', 'Czech Republic', 'Czech Republic', 'CZE', '203', 'yes', '420', '.cz'),
(60, 'CD', 'Democratic Republic of the Congo', 'Democratic Republic of the Congo', 'COD', '180', 'yes', '243', '.cd'),
(61, 'DK', 'Denmark', 'Kingdom of Denmark', 'DNK', '208', 'yes', '45', '.dk'),
(62, 'DJ', 'Djibouti', 'Republic of Djibouti', 'DJI', '262', 'yes', '253', '.dj'),
(63, 'DM', 'Dominica', 'Commonwealth of Dominica', 'DMA', '212', 'yes', '1+767', '.dm'),
(64, 'DO', 'Dominican Republic', 'Dominican Republic', 'DOM', '214', 'yes', '1+809, 8', '.do'),
(65, 'EC', 'Ecuador', 'Republic of Ecuador', 'ECU', '218', 'yes', '593', '.ec'),
(66, 'EG', 'Egypt', 'Arab Republic of Egypt', 'EGY', '818', 'yes', '20', '.eg'),
(67, 'SV', 'El Salvador', 'Republic of El Salvador', 'SLV', '222', 'yes', '503', '.sv'),
(68, 'GQ', 'Equatorial Guinea', 'Republic of Equatorial Guinea', 'GNQ', '226', 'yes', '240', '.gq'),
(69, 'ER', 'Eritrea', 'State of Eritrea', 'ERI', '232', 'yes', '291', '.er'),
(70, 'EE', 'Estonia', 'Republic of Estonia', 'EST', '233', 'yes', '372', '.ee'),
(71, 'ET', 'Ethiopia', 'Federal Democratic Republic of Ethiopia', 'ETH', '231', 'yes', '251', '.et'),
(72, 'FK', 'Falkland Islands (Malvinas)', 'The Falkland Islands (Malvinas)', 'FLK', '238', 'no', '500', '.fk'),
(73, 'FO', 'Faroe Islands', 'The Faroe Islands', 'FRO', '234', 'no', '298', '.fo'),
(74, 'FJ', 'Fiji', 'Republic of Fiji', 'FJI', '242', 'yes', '679', '.fj'),
(75, 'FI', 'Finland', 'Republic of Finland', 'FIN', '246', 'yes', '358', '.fi'),
(76, 'FR', 'France', 'French Republic', 'FRA', '250', 'yes', '33', '.fr'),
(77, 'GF', 'French Guiana', 'French Guiana', 'GUF', '254', 'no', '594', '.gf'),
(78, 'PF', 'French Polynesia', 'French Polynesia', 'PYF', '258', 'no', '689', '.pf'),
(79, 'TF', 'French Southern Territories', 'French Southern Territories', 'ATF', '260', 'no', NULL, '.tf'),
(80, 'GA', 'Gabon', 'Gabonese Republic', 'GAB', '266', 'yes', '241', '.ga'),
(81, 'GM', 'Gambia', 'Republic of The Gambia', 'GMB', '270', 'yes', '220', '.gm'),
(82, 'GE', 'Georgia', 'Georgia', 'GEO', '268', 'yes', '995', '.ge'),
(83, 'DE', 'Germany', 'Federal Republic of Germany', 'DEU', '276', 'yes', '49', '.de'),
(84, 'GH', 'Ghana', 'Republic of Ghana', 'GHA', '288', 'yes', '233', '.gh'),
(85, 'GI', 'Gibraltar', 'Gibraltar', 'GIB', '292', 'no', '350', '.gi'),
(86, 'GR', 'Greece', 'Hellenic Republic', 'GRC', '300', 'yes', '30', '.gr'),
(87, 'GL', 'Greenland', 'Greenland', 'GRL', '304', 'no', '299', '.gl'),
(88, 'GD', 'Grenada', 'Grenada', 'GRD', '308', 'yes', '1+473', '.gd'),
(89, 'GP', 'Guadaloupe', 'Guadeloupe', 'GLP', '312', 'no', '590', '.gp'),
(90, 'GU', 'Guam', 'Guam', 'GUM', '316', 'no', '1+671', '.gu'),
(91, 'GT', 'Guatemala', 'Republic of Guatemala', 'GTM', '320', 'yes', '502', '.gt'),
(92, 'GG', 'Guernsey', 'Guernsey', 'GGY', '831', 'no', '44', '.gg'),
(93, 'GN', 'Guinea', 'Republic of Guinea', 'GIN', '324', 'yes', '224', '.gn'),
(94, 'GW', 'Guinea-Bissau', 'Republic of Guinea-Bissau', 'GNB', '624', 'yes', '245', '.gw'),
(95, 'GY', 'Guyana', 'Co-operative Republic of Guyana', 'GUY', '328', 'yes', '592', '.gy'),
(96, 'HT', 'Haiti', 'Republic of Haiti', 'HTI', '332', 'yes', '509', '.ht'),
(97, 'HM', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'HMD', '334', 'no', 'NONE', '.hm'),
(98, 'HN', 'Honduras', 'Republic of Honduras', 'HND', '340', 'yes', '504', '.hn'),
(99, 'HK', 'Hong Kong', 'Hong Kong', 'HKG', '344', 'no', '852', '.hk'),
(100, 'HU', 'Hungary', 'Hungary', 'HUN', '348', 'yes', '36', '.hu'),
(101, 'IS', 'Iceland', 'Republic of Iceland', 'ISL', '352', 'yes', '354', '.is'),
(102, 'IN', 'India', 'Republic of India', 'IND', '356', 'yes', '91', '.in'),
(103, 'ID', 'Indonesia', 'Republic of Indonesia', 'IDN', '360', 'yes', '62', '.id'),
(104, 'IR', 'Iran', 'Islamic Republic of Iran', 'IRN', '364', 'yes', '98', '.ir'),
(105, 'IQ', 'Iraq', 'Republic of Iraq', 'IRQ', '368', 'yes', '964', '.iq'),
(106, 'IE', 'Ireland', 'Ireland', 'IRL', '372', 'yes', '353', '.ie'),
(107, 'IM', 'Isle of Man', 'Isle of Man', 'IMN', '833', 'no', '44', '.im'),
(108, 'IL', 'Israel', 'State of Israel', 'ISR', '376', 'yes', '972', '.il'),
(109, 'IT', 'Italy', 'Italian Republic', 'ITA', '380', 'yes', '39', '.jm'),
(110, 'JM', 'Jamaica', 'Jamaica', 'JAM', '388', 'yes', '1+876', '.jm'),
(111, 'JP', 'Japan', 'Japan', 'JPN', '392', 'yes', '81', '.jp'),
(112, 'JE', 'Jersey', 'The Bailiwick of Jersey', 'JEY', '832', 'no', '44', '.je'),
(113, 'JO', 'Jordan', 'Hashemite Kingdom of Jordan', 'JOR', '400', 'yes', '962', '.jo'),
(114, 'KZ', 'Kazakhstan', 'Republic of Kazakhstan', 'KAZ', '398', 'yes', '7', '.kz'),
(115, 'KE', 'Kenya', 'Republic of Kenya', 'KEN', '404', 'yes', '254', '.ke'),
(116, 'KI', 'Kiribati', 'Republic of Kiribati', 'KIR', '296', 'yes', '686', '.ki'),
(117, 'XK', 'Kosovo', 'Republic of Kosovo', '---', '---', 'some', '381', ''),
(118, 'KW', 'Kuwait', 'State of Kuwait', 'KWT', '414', 'yes', '965', '.kw'),
(119, 'KG', 'Kyrgyzstan', 'Kyrgyz Republic', 'KGZ', '417', 'yes', '996', '.kg'),
(120, 'LA', 'Laos', 'Lao People\'s Democratic Republic', 'LAO', '418', 'yes', '856', '.la'),
(121, 'LV', 'Latvia', 'Republic of Latvia', 'LVA', '428', 'yes', '371', '.lv'),
(122, 'LB', 'Lebanon', 'Republic of Lebanon', 'LBN', '422', 'yes', '961', '.lb'),
(123, 'LS', 'Lesotho', 'Kingdom of Lesotho', 'LSO', '426', 'yes', '266', '.ls'),
(124, 'LR', 'Liberia', 'Republic of Liberia', 'LBR', '430', 'yes', '231', '.lr'),
(125, 'LY', 'Libya', 'Libya', 'LBY', '434', 'yes', '218', '.ly'),
(126, 'LI', 'Liechtenstein', 'Principality of Liechtenstein', 'LIE', '438', 'yes', '423', '.li'),
(127, 'LT', 'Lithuania', 'Republic of Lithuania', 'LTU', '440', 'yes', '370', '.lt'),
(128, 'LU', 'Luxembourg', 'Grand Duchy of Luxembourg', 'LUX', '442', 'yes', '352', '.lu'),
(129, 'MO', 'Macao', 'The Macao Special Administrative Region', 'MAC', '446', 'no', '853', '.mo'),
(130, 'MK', 'Macedonia', 'The Former Yugoslav Republic of Macedonia', 'MKD', '807', 'yes', '389', '.mk'),
(131, 'MG', 'Madagascar', 'Republic of Madagascar', 'MDG', '450', 'yes', '261', '.mg'),
(132, 'MW', 'Malawi', 'Republic of Malawi', 'MWI', '454', 'yes', '265', '.mw'),
(133, 'MY', 'Malaysia', 'Malaysia', 'MYS', '458', 'yes', '60', '.my'),
(134, 'MV', 'Maldives', 'Republic of Maldives', 'MDV', '462', 'yes', '960', '.mv'),
(135, 'ML', 'Mali', 'Republic of Mali', 'MLI', '466', 'yes', '223', '.ml'),
(136, 'MT', 'Malta', 'Republic of Malta', 'MLT', '470', 'yes', '356', '.mt'),
(137, 'MH', 'Marshall Islands', 'Republic of the Marshall Islands', 'MHL', '584', 'yes', '692', '.mh'),
(138, 'MQ', 'Martinique', 'Martinique', 'MTQ', '474', 'no', '596', '.mq'),
(139, 'MR', 'Mauritania', 'Islamic Republic of Mauritania', 'MRT', '478', 'yes', '222', '.mr'),
(140, 'MU', 'Mauritius', 'Republic of Mauritius', 'MUS', '480', 'yes', '230', '.mu'),
(141, 'YT', 'Mayotte', 'Mayotte', 'MYT', '175', 'no', '262', '.yt'),
(142, 'MX', 'Mexico', 'United Mexican States', 'MEX', '484', 'yes', '52', '.mx'),
(143, 'FM', 'Micronesia', 'Federated States of Micronesia', 'FSM', '583', 'yes', '691', '.fm'),
(144, 'MD', 'Moldava', 'Republic of Moldova', 'MDA', '498', 'yes', '373', '.md'),
(145, 'MC', 'Monaco', 'Principality of Monaco', 'MCO', '492', 'yes', '377', '.mc'),
(146, 'MN', 'Mongolia', 'Mongolia', 'MNG', '496', 'yes', '976', '.mn'),
(147, 'ME', 'Montenegro', 'Montenegro', 'MNE', '499', 'yes', '382', '.me'),
(148, 'MS', 'Montserrat', 'Montserrat', 'MSR', '500', 'no', '1+664', '.ms'),
(149, 'MA', 'Morocco', 'Kingdom of Morocco', 'MAR', '504', 'yes', '212', '.ma'),
(150, 'MZ', 'Mozambique', 'Republic of Mozambique', 'MOZ', '508', 'yes', '258', '.mz'),
(151, 'MM', 'Myanmar (Burma)', 'Republic of the Union of Myanmar', 'MMR', '104', 'yes', '95', '.mm'),
(152, 'NA', 'Namibia', 'Republic of Namibia', 'NAM', '516', 'yes', '264', '.na'),
(153, 'NR', 'Nauru', 'Republic of Nauru', 'NRU', '520', 'yes', '674', '.nr'),
(154, 'NP', 'Nepal', 'Federal Democratic Republic of Nepal', 'NPL', '524', 'yes', '977', '.np'),
(155, 'NL', 'Netherlands', 'Kingdom of the Netherlands', 'NLD', '528', 'yes', '31', '.nl'),
(156, 'NC', 'New Caledonia', 'New Caledonia', 'NCL', '540', 'no', '687', '.nc'),
(157, 'NZ', 'New Zealand', 'New Zealand', 'NZL', '554', 'yes', '64', '.nz'),
(158, 'NI', 'Nicaragua', 'Republic of Nicaragua', 'NIC', '558', 'yes', '505', '.ni'),
(159, 'NE', 'Niger', 'Republic of Niger', 'NER', '562', 'yes', '227', '.ne'),
(160, 'NG', 'Nigeria', 'Federal Republic of Nigeria', 'NGA', '566', 'yes', '234', '.ng'),
(161, 'NU', 'Niue', 'Niue', 'NIU', '570', 'some', '683', '.nu'),
(162, 'NF', 'Norfolk Island', 'Norfolk Island', 'NFK', '574', 'no', '672', '.nf'),
(163, 'KP', 'North Korea', 'Democratic People\'s Republic of Korea', 'PRK', '408', 'yes', '850', '.kp'),
(164, 'MP', 'Northern Mariana Islands', 'Northern Mariana Islands', 'MNP', '580', 'no', '1+670', '.mp'),
(165, 'NO', 'Norway', 'Kingdom of Norway', 'NOR', '578', 'yes', '47', '.no'),
(166, 'OM', 'Oman', 'Sultanate of Oman', 'OMN', '512', 'yes', '968', '.om'),
(167, 'PK', 'Pakistan', 'Islamic Republic of Pakistan', 'PAK', '586', 'yes', '92', '.pk'),
(168, 'PW', 'Palau', 'Republic of Palau', 'PLW', '585', 'yes', '680', '.pw'),
(169, 'PS', 'Palestine', 'State of Palestine (or Occupied Palestinian Territory)', 'PSE', '275', 'some', '970', '.ps'),
(170, 'PA', 'Panama', 'Republic of Panama', 'PAN', '591', 'yes', '507', '.pa'),
(171, 'PG', 'Papua New Guinea', 'Independent State of Papua New Guinea', 'PNG', '598', 'yes', '675', '.pg'),
(172, 'PY', 'Paraguay', 'Republic of Paraguay', 'PRY', '600', 'yes', '595', '.py'),
(173, 'PE', 'Peru', 'Republic of Peru', 'PER', '604', 'yes', '51', '.pe'),
(174, 'PH', 'Phillipines', 'Republic of the Philippines', 'PHL', '608', 'yes', '63', '.ph'),
(175, 'PN', 'Pitcairn', 'Pitcairn', 'PCN', '612', 'no', 'NONE', '.pn'),
(176, 'PL', 'Poland', 'Republic of Poland', 'POL', '616', 'yes', '48', '.pl'),
(177, 'PT', 'Portugal', 'Portuguese Republic', 'PRT', '620', 'yes', '351', '.pt'),
(178, 'PR', 'Puerto Rico', 'Commonwealth of Puerto Rico', 'PRI', '630', 'no', '1+939', '.pr'),
(179, 'QA', 'Qatar', 'State of Qatar', 'QAT', '634', 'yes', '974', '.qa'),
(180, 'RE', 'Reunion', 'R&eacute;union', 'REU', '638', 'no', '262', '.re'),
(181, 'RO', 'Romania', 'Romania', 'ROU', '642', 'yes', '40', '.ro'),
(182, 'RU', 'Russia', 'Russian Federation', 'RUS', '643', 'yes', '7', '.ru'),
(183, 'RW', 'Rwanda', 'Republic of Rwanda', 'RWA', '646', 'yes', '250', '.rw'),
(184, 'BL', 'Saint Barthelemy', 'Saint Barth&eacute;lemy', 'BLM', '652', 'no', '590', '.bl'),
(185, 'SH', 'Saint Helena', 'Saint Helena, Ascension and Tristan da Cunha', 'SHN', '654', 'no', '290', '.sh'),
(186, 'KN', 'Saint Kitts and Nevis', 'Federation of Saint Christopher and Nevis', 'KNA', '659', 'yes', '1+869', '.kn'),
(187, 'LC', 'Saint Lucia', 'Saint Lucia', 'LCA', '662', 'yes', '1+758', '.lc'),
(188, 'MF', 'Saint Martin', 'Saint Martin', 'MAF', '663', 'no', '590', '.mf'),
(189, 'PM', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', 'SPM', '666', 'no', '508', '.pm'),
(190, 'VC', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'VCT', '670', 'yes', '1+784', '.vc'),
(191, 'WS', 'Samoa', 'Independent State of Samoa', 'WSM', '882', 'yes', '685', '.ws'),
(192, 'SM', 'San Marino', 'Republic of San Marino', 'SMR', '674', 'yes', '378', '.sm'),
(193, 'ST', 'Sao Tome and Principe', 'Democratic Republic of S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'STP', '678', 'yes', '239', '.st'),
(194, 'SA', 'Saudi Arabia', 'Kingdom of Saudi Arabia', 'SAU', '682', 'yes', '966', '.sa'),
(195, 'SN', 'Senegal', 'Republic of Senegal', 'SEN', '686', 'yes', '221', '.sn'),
(196, 'RS', 'Serbia', 'Republic of Serbia', 'SRB', '688', 'yes', '381', '.rs'),
(197, 'SC', 'Seychelles', 'Republic of Seychelles', 'SYC', '690', 'yes', '248', '.sc'),
(198, 'SL', 'Sierra Leone', 'Republic of Sierra Leone', 'SLE', '694', 'yes', '232', '.sl'),
(199, 'SG', 'Singapore', 'Republic of Singapore', 'SGP', '702', 'yes', '65', '.sg'),
(200, 'SX', 'Sint Maarten', 'Sint Maarten', 'SXM', '534', 'no', '1+721', '.sx'),
(201, 'SK', 'Slovakia', 'Slovak Republic', 'SVK', '703', 'yes', '421', '.sk'),
(202, 'SI', 'Slovenia', 'Republic of Slovenia', 'SVN', '705', 'yes', '386', '.si'),
(203, 'SB', 'Solomon Islands', 'Solomon Islands', 'SLB', '090', 'yes', '677', '.sb'),
(204, 'SO', 'Somalia', 'Somali Republic', 'SOM', '706', 'yes', '252', '.so'),
(205, 'ZA', 'South Africa', 'Republic of South Africa', 'ZAF', '710', 'yes', '27', '.za'),
(206, 'GS', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'SGS', '239', 'no', '500', '.gs'),
(207, 'KR', 'South Korea', 'Republic of Korea', 'KOR', '410', 'yes', '82', '.kr'),
(208, 'SS', 'South Sudan', 'Republic of South Sudan', 'SSD', '728', 'yes', '211', '.ss'),
(209, 'ES', 'Spain', 'Kingdom of Spain', 'ESP', '724', 'yes', '34', '.es'),
(210, 'LK', 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', 'LKA', '144', 'yes', '94', '.lk'),
(211, 'SD', 'Sudan', 'Republic of the Sudan', 'SDN', '729', 'yes', '249', '.sd'),
(212, 'SR', 'Suriname', 'Republic of Suriname', 'SUR', '740', 'yes', '597', '.sr'),
(213, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', 'SJM', '744', 'no', '47', '.sj'),
(214, 'SZ', 'Swaziland', 'Kingdom of Swaziland', 'SWZ', '748', 'yes', '268', '.sz'),
(215, 'SE', 'Sweden', 'Kingdom of Sweden', 'SWE', '752', 'yes', '46', '.se'),
(216, 'CH', 'Switzerland', 'Swiss Confederation', 'CHE', '756', 'yes', '41', '.ch'),
(217, 'SY', 'Syria', 'Syrian Arab Republic', 'SYR', '760', 'yes', '963', '.sy'),
(218, 'TW', 'Taiwan', 'Republic of China (Taiwan)', 'TWN', '158', 'former', '886', '.tw'),
(219, 'TJ', 'Tajikistan', 'Republic of Tajikistan', 'TJK', '762', 'yes', '992', '.tj'),
(220, 'TZ', 'Tanzania', 'United Republic of Tanzania', 'TZA', '834', 'yes', '255', '.tz'),
(221, 'TH', 'Thailand', 'Kingdom of Thailand', 'THA', '764', 'yes', '66', '.th'),
(222, 'TL', 'Timor-Leste (East Timor)', 'Democratic Republic of Timor-Leste', 'TLS', '626', 'yes', '670', '.tl'),
(223, 'TG', 'Togo', 'Togolese Republic', 'TGO', '768', 'yes', '228', '.tg'),
(224, 'TK', 'Tokelau', 'Tokelau', 'TKL', '772', 'no', '690', '.tk'),
(225, 'TO', 'Tonga', 'Kingdom of Tonga', 'TON', '776', 'yes', '676', '.to'),
(226, 'TT', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', 'TTO', '780', 'yes', '1+868', '.tt'),
(227, 'TN', 'Tunisia', 'Republic of Tunisia', 'TUN', '788', 'yes', '216', '.tn'),
(228, 'TR', 'Turkey', 'Republic of Turkey', 'TUR', '792', 'yes', '90', '.tr'),
(229, 'TM', 'Turkmenistan', 'Turkmenistan', 'TKM', '795', 'yes', '993', '.tm'),
(230, 'TC', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'TCA', '796', 'no', '1+649', '.tc'),
(231, 'TV', 'Tuvalu', 'Tuvalu', 'TUV', '798', 'yes', '688', '.tv'),
(232, 'UG', 'Uganda', 'Republic of Uganda', 'UGA', '800', 'yes', '256', '.ug'),
(233, 'UA', 'Ukraine', 'Ukraine', 'UKR', '804', 'yes', '380', '.ua'),
(234, 'AE', 'United Arab Emirates', 'United Arab Emirates', 'ARE', '784', 'yes', '971', '.ae'),
(235, 'GB', 'United Kingdom', 'United Kingdom of Great Britain and Nothern Ireland', 'GBR', '826', 'yes', '44', '.uk'),
(236, 'US', 'United States', 'United States of America', 'USA', '840', 'yes', '1', '.us'),
(237, 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'UMI', '581', 'no', 'NONE', 'NONE'),
(238, 'UY', 'Uruguay', 'Eastern Republic of Uruguay', 'URY', '858', 'yes', '598', '.uy'),
(239, 'UZ', 'Uzbekistan', 'Republic of Uzbekistan', 'UZB', '860', 'yes', '998', '.uz'),
(240, 'VU', 'Vanuatu', 'Republic of Vanuatu', 'VUT', '548', 'yes', '678', '.vu'),
(241, 'VA', 'Vatican City', 'State of the Vatican City', 'VAT', '336', 'no', '39', '.va'),
(242, 'VE', 'Venezuela', 'Bolivarian Republic of Venezuela', 'VEN', '862', 'yes', '58', '.ve'),
(243, 'VN', 'Vietnam', 'Socialist Republic of Vietnam', 'VNM', '704', 'yes', '84', '.vn'),
(244, 'VG', 'Virgin Islands, British', 'British Virgin Islands', 'VGB', '092', 'no', '1+284', '.vg'),
(245, 'VI', 'Virgin Islands, US', 'Virgin Islands of the United States', 'VIR', '850', 'no', '1+340', '.vi'),
(246, 'WF', 'Wallis and Futuna', 'Wallis and Futuna', 'WLF', '876', 'no', '681', '.wf'),
(247, 'EH', 'Western Sahara', 'Western Sahara', 'ESH', '732', 'no', '212', '.eh'),
(248, 'YE', 'Yemen', 'Republic of Yemen', 'YEM', '887', 'yes', '967', '.ye'),
(249, 'ZM', 'Zambia', 'Republic of Zambia', 'ZMB', '894', 'yes', '260', '.zm'),
(250, 'ZW', 'Zimbabwe', 'Republic of Zimbabwe', 'ZWE', '716', 'yes', '263', '.zw');

-- --------------------------------------------------------

--
-- Structure de la table `tblcurrencies`
--

CREATE TABLE `tblcurrencies` (
  `id` int(11) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `isdefault` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblcurrencies`
--

INSERT INTO `tblcurrencies` (`id`, `symbol`, `name`, `isdefault`) VALUES
(1, '$', 'USD', 0),
(2, 'â‚¬', 'EUR', 0),
(3, 'MAD', 'MAD', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tblcustomeradmins`
--

CREATE TABLE `tblcustomeradmins` (
  `staff_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_assigned` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblcustomeradmins`
--

INSERT INTO `tblcustomeradmins` (`staff_id`, `customer_id`, `date_assigned`) VALUES
(3, 3, '2016-12-08 17:29:40'),
(6, 3, '2016-11-09 17:00:38');

-- --------------------------------------------------------

--
-- Structure de la table `tblcustomergroups_in`
--

CREATE TABLE `tblcustomergroups_in` (
  `id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblcustomergroups_in`
--

INSERT INTO `tblcustomergroups_in` (`id`, `groupid`, `customer_id`) VALUES
(1, 4, 1),
(2, 21, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tblcustomersgroups`
--

CREATE TABLE `tblcustomersgroups` (
  `id` int(11) NOT NULL,
  `name` varchar(600) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblcustomersgroups`
--

INSERT INTO `tblcustomersgroups` (`id`, `name`) VALUES
(1, 'TPE'),
(2, 'Semi-Publique'),
(3, 'Publique'),
(4, 'PME/PMI'),
(5, 'Personne Physique'),
(6, 'Multinationale'),
(7, 'Association'),
(8, 'Transport & Logistique'),
(9, 'Textile'),
(10, 'Telecom'),
(11, 'Sport, loisir & tourisme'),
(12, 'Soins et Beauté'),
(13, 'SantÃ©'),
(14, 'informatique et technologie'),
(15, 'Presse, Information et communication'),
(16, 'Industries manufacturiÃ¨res'),
(17, 'Industries extractives'),
(18, 'Industries Automobile	'),
(19, 'HotÃªlerie & Restauration'),
(20, 'Enseignement'),
(21, 'ElectromÃ©nagers'),
(22, 'Commerce & Distribution'),
(23, 'BTP & Architecture'),
(24, 'Banque et Assurance'),
(25, 'Audiovisuel & Spectacle'),
(26, 'Artisanat & Production sur mesure'),
(27, 'Agro-Alimentaire'),
(28, 'Agriculture');

-- --------------------------------------------------------

--
-- Structure de la table `tblcustomfields`
--

CREATE TABLE `tblcustomfields` (
  `id` int(11) NOT NULL,
  `fieldto` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL,
  `options` mediumtext,
  `field_order` int(11) DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `show_on_pdf` int(11) NOT NULL DEFAULT '0',
  `only_admin` tinyint(1) NOT NULL DEFAULT '0',
  `show_on_table` tinyint(1) NOT NULL DEFAULT '0',
  `show_on_client_portal` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblcustomfields`
--

INSERT INTO `tblcustomfields` (`id`, `fieldto`, `name`, `slug`, `required`, `type`, `options`, `field_order`, `active`, `show_on_pdf`, `only_admin`, `show_on_table`, `show_on_client_portal`) VALUES
(1, 'customers', 'ModalitÃ© de payement (en Jours)', 'modalite_de_payement', 1, 'select', 'Ã  facturation,30,60', 0, 1, 0, 0, 0, 0),
(2, 'contacts', 'Titre', 'titre', 1, 'select', 'Mr.,Mme.,Mrs', 10, 1, 0, 0, 0, 1),
(5, 'estimates', 'Estimates', '', 1, '', NULL, 0, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblcustomfieldsvalues`
--

CREATE TABLE `tblcustomfieldsvalues` (
  `id` int(11) NOT NULL,
  `relid` int(11) NOT NULL,
  `fieldid` int(11) NOT NULL,
  `fieldto` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblcustomfieldsvalues`
--

INSERT INTO `tblcustomfieldsvalues` (`id`, `relid`, `fieldid`, `fieldto`, `value`) VALUES
(1, 1, 1, 'customers', 'Ã  facturation'),
(2, 1, 2, 'contacts', 'Mr.'),
(3, 2, 1, 'customers', '30'),
(4, 3, 2, 'contacts', 'Mr.'),
(5, 4, 2, 'contacts', 'Mr.'),
(6, 5, 2, 'contacts', 'Mr.'),
(7, 6, 2, 'contacts', 'Mr.'),
(8, 7, 2, 'contacts', 'Mme.'),
(9, 8, 4, 'suppliers', 'A facturation'),
(10, 3, 6, 'suppliers', '30'),
(11, 4, 6, 'suppliers', '30'),
(12, 8, 2, 'contacts', 'Mme.'),
(13, 9, 2, 'contacts', 'Mr.'),
(14, 10, 2, 'contacts', 'Mr.'),
(15, 11, 2, 'contacts', 'Mr.'),
(16, 4, 8, 'suppliers', ''),
(17, 5, 8, 'suppliers', '30'),
(18, 3, 8, 'suppliers', '');

-- --------------------------------------------------------

--
-- Structure de la table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `departmentid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `host` varchar(150) DEFAULT NULL,
  `password` mediumtext,
  `encryption` varchar(3) DEFAULT NULL,
  `delete_after_import` int(11) NOT NULL DEFAULT '0',
  `calendar_id` mediumtext,
  `hidefromclient` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbldepartments`
--

INSERT INTO `tbldepartments` (`departmentid`, `name`, `email`, `host`, `password`, `encryption`, `delete_after_import`, `calendar_id`, `hidefromclient`) VALUES
(1, 'Support technique', 'tech@deepmaroc.com', '', '070b644762019be7cddd22a4436bab0c192f913034782830dc84a6a71ef959a666ffc4231c4bc256aa5ff4f04fff9da92ce1f9f6a9b56453851358d346dcf9e1+ikj7u44uV4xHmTh0hhi6BGZOWc8ucBkAzyjm4NRGZI=', '', 0, '', 0),
(2, 'Support commercial', 'commercial@deepmaroc.com', '', '', '', 0, '', 0),
(3, 'Support SAV', 'sav@deepmaroc.com', '', '', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tbldismissedannouncements`
--

CREATE TABLE `tbldismissedannouncements` (
  `dismissedannouncementid` int(11) NOT NULL,
  `announcementid` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbldismissedannouncements`
--

INSERT INTO `tbldismissedannouncements` (`dismissedannouncementid`, `announcementid`, `staff`, `userid`) VALUES
(1, 1, 1, 6),
(2, 2, 1, 3),
(3, 1, 1, 3),
(4, 3, 1, 3),
(5, 1, 0, 8),
(6, 2, 0, 8),
(7, 3, 0, 8),
(8, 1, 0, 9),
(9, 2, 0, 9),
(10, 3, 0, 9),
(11, 1, 0, 10),
(12, 2, 0, 10),
(13, 3, 0, 10),
(14, 1, 0, 11),
(15, 2, 0, 11),
(16, 3, 0, 11),
(17, 1, 0, 6),
(18, 3, 0, 6),
(19, 2, 0, 6),
(20, 1, 0, 7),
(21, 2, 0, 7),
(22, 3, 0, 7);

-- --------------------------------------------------------

--
-- Structure de la table `tblemaillists`
--

CREATE TABLE `tblemaillists` (
  `listid` int(11) NOT NULL,
  `name` mediumtext NOT NULL,
  `creator` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblemailtemplates`
--

CREATE TABLE `tblemailtemplates` (
  `emailtemplateid` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `type` mediumtext NOT NULL,
  `slug` varchar(100) NOT NULL,
  `name` mediumtext NOT NULL,
  `subject` mediumtext NOT NULL,
  `message` text NOT NULL,
  `fromname` mediumtext NOT NULL,
  `fromemail` varchar(100) DEFAULT NULL,
  `plaintext` int(11) NOT NULL DEFAULT '1',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblemailtemplates`
--

INSERT INTO `tblemailtemplates` (`emailtemplateid`, `language`, `type`, `slug`, `name`, `subject`, `message`, `fromname`, `fromemail`, `plaintext`, `active`, `order`) VALUES
(1, 2, 'client', 'new-client-created', 'New Customer Added/Registered (Welcome Email)', 'Welcome aboard', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {contact_firstname}&nbsp;{contact_lastname}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank you for registering on the {companyname} CRM System.</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We just wanted to say welcome.</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please contact us if you need any help.</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Click here to view your profile: {crm_url}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">(This is an automated email, so please don\'t reply to this email address)</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(2, 2, 'invoice', 'invoice-send-to-client', 'Send Invoice to Customer', 'Invoice with number {invoice_number} created', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {contact_firstname}&nbsp;{contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We have prepared the following invoice for you: #&nbsp;{invoice_number}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Invoice status:&nbsp;<strong style="font-family: Helvetica, Arial, sans-serif;">{invoice_status}</strong></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the link below to view the invoice online: <strong>{invoice_link}</strong></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please contact us for more information.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(3, 2, 'ticket', 'new-ticket-opened-admin', 'New Ticket Opened (Opened by staff, sent to customer)', 'New Support Ticket Open', '<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {contact_firstname} {contact_lastname}</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">New Support Ticket Opened.</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: <span style="background-color: inherit;">{ticket_subject}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; color: #000000; font-size: 12pt; background-color: inherit;">Department: {ticket_department}</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: inherit;">{ticket_priority}</span></span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; color: #000000; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(4, 2, 'ticket', 'ticket-reply', 'Ticket Reply (Sent to customer)', 'New Ticket Reply', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi&nbsp;<span style="background-color: inherit;">{contact_firstname} </span>{contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You have a new ticket reply to ticket #{ticket_id}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: <span style="background-color: inherit;">{ticket_subject}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Department: {ticket_department}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: inherit;">{ticket_priority}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(5, 2, 'ticket', 'ticket-autoresponse', 'New Ticket Open Autoresponse', 'New Support Ticket Opened', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi&nbsp;{contact_firstname} {contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank you for contacting our support team. A support ticket has now been opened for your request. You will be notified when a response is made by email.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: {ticket_subject}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Department: {ticket_department}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: {ticket_priority}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(6, 2, 'invoice', 'invoice-payment-recorded', 'Invoice Payment Recorded', 'Invoice Payment Recorded', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Payment recorded for invoice&nbsp;# {invoice_number}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{invoice_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(7, 2, 'invoice', 'invoice-overdue-notice', 'Invoice Overdue Notice', 'Invoice Overdue Notice - {invoice_number}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {contact_firstname} {contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">This is an overdue notice for invoice # {invoice_number}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">This invoice was due: {invoice_duedate}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please view the invoice here: &nbsp;{invoice_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(8, 2, 'invoice', 'invoice-already-send', 'Invoice Already Sent to Customer', 'On your command here is the invoice', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi <span style="background-color: inherit;">{contact_firstname} {contact_lastname}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">At your request, please see the link to invoice # {invoice_number}&nbsp;below.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Click here to view the invoice online: {invoice_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please contact us for more information.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(9, 2, 'ticket', 'new-ticket-created-staff', 'New Ticket Created (Opened by customer, sent to staff members)', 'New Ticket Created', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">A new support ticket has been opened.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: <span style="background-color: inherit;">{ticket_subject}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Department: {ticket_department}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: inherit;">{ticket_priority}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(10, 2, 'estimate', 'estimate-send-to-client', 'Send Estimate to Customer', 'Estimate # {estimate_number} created', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {contact_firstname}&nbsp;{contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please find the attached estimate # {estimate_number}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Estimate status:&nbsp;<strong>{estimate_status}</strong></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{estimate_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We look forward to your communication.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(12, 2, 'ticket', 'ticket-reply-to-admin', 'Ticket Reply (Sent to staff)', 'New Support Ticket Reply', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">A new support ticket reply from {contact_firstname} {contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: <span style="background-color: inherit;">{ticket_subject}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Department: {ticket_department}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: inherit;">{ticket_priority}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view this ticket any time at <span style="background-color: inherit;">{ticket_url}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(11, 2, 'estimate', 'estimate-already-send', 'Estimate Already Sent to Customer', 'Estimate # {estimate_number} ', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {contact_firstname}&nbsp;{contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank you for your estimate request.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view the follow estimate on the following link {estimate_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please contact us for more information.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(13, 2, 'contract', 'contract-expiration', 'Contract Expiration', 'Contract Expiration Reminder', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {client_company}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">This is a reminder that the following contract will expire soon:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject {contract_subject}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Description {contract_description}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Date Start {contract_datestart}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Date End {contract_dateend}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Value {contract_contract_value}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please contact us for more information.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 1),
(14, 2, 'tasks', 'task-assigned', 'New Task Assigned', 'New Task Assigned to You - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {staff_firstname} {staff_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You have been assigned a new task:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Name: <span style="background-color: #ffffff;">{task_name}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Due date: <span style="background-color: #ffffff;">{task_duedate}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: #ffffff;">{task_priority}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view this task: {task_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(15, 2, 'tasks', 'task-added-as-follower', 'Staff Added as Follower on Task', 'You are added as follower on task - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {staff_firstname} <span style="background-color: #ffffff;">{staff_lastname}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You have been added as follower on the following task:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Name: {task_name}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Description: {task_description}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: {task_priority}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Start date: {task_startdate}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Due date: {task_duedate}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view this task: {task_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div>&nbsp;</div>', '{companyname} | CRM', '', 0, 1, 0),
(16, 2, 'tasks', 'task-commented', 'New Comment on Task', 'New Comment on Task - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {staff_firstname} {staff_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">A comment has been made on the following task:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Name: &nbsp;{task_name}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Description: &nbsp;{task_description}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Click on the following link to view: {task_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(17, 2, 'tasks', 'task-marked-as-finished', 'Task Marked as Finished', 'Task Marked as Finished - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {staff_firstname} {staff_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{task_user_take_action} marked the following task as complete:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Name: </span>{task_name}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Description: </span><span style="background-color: inherit;">{task_description}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Due date: <span style="background-color: #ffffff;">{task_duedate}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view: <span style="background-color: inherit;">{task_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(18, 2, 'tasks', 'task-added-attachment', 'New Attachment on Task', 'New Attachment on Task - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {staff_firstname} {staff_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{task_user_take_action} added an attachment on the following task:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Name: </span>{task_name}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Description: </span><span style="background-color: inherit;">{task_description}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view: <span style="background-color: inherit;">{task_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(19, 2, 'tasks', 'task-unmarked-as-finished', 'Task Unmarked as Finished', 'Task UN-marked as finished - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {staff_firstname} {staff_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{task_user_take_action} <span style="background-color: inherit;">marked the </span>following task as <strong>in-complete / unfinished</strong></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Name: </span><span style="background-color: inherit;">{task_name}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Description: </span><span style="background-color: inherit;">{task_description}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Due date: {task_duedate}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view: <span style="background-color: inherit;">{task_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(28, 2, 'estimate', 'estimate-declined-to-staff', 'Estimate Declined (Sent to Staff)', 'Customer Declined Estimate', '<div><span style="font-size: 12pt;">Hi</span></div>\r\n<div><span style="font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-size: 12pt;">Customer ({client_company}) declined estimate with number <span style="background-color: inherit;">{estimate_number}</span></span></div>\r\n<div><span style="font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-size: 12pt;">You can view the estimate on the following link <span style="background-color: inherit;">{estimate_link}</span></span></div>\r\n<div><span style="font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(27, 2, 'estimate', 'estimate-accepted-to-staff', 'Estimate Accepted (Sent to Staff)', 'Customer Accepted Estimate', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Customer ({client_company}) accepted estimate with number <span style="background-color: inherit;">{estimate_number}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view the estimate on the following link <span style="background-color: inherit;">{estimate_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(20, 2, 'proposals', 'proposal-client-accepted', 'Customer Action - Accepted (Sent to Staff)', 'Customer Accepted Proposal', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Client {proposal_proposal_to} accepted the following proposal:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: {proposal_subject}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Total: {proposal_total}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">View the proposal on the following link: {proposal_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>', '{companyname} | CRM', '', 0, 1, 0),
(21, 2, 'proposals', 'proposal-send-to-customer', 'Send Proposal to Customer', 'Proposal', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear <span style="background-color: inherit;">{proposal_proposal_to}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please find our attached proposal.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">This proposal is valid until: <span style="background-color: inherit;">{proposal_open_till}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view the proposal on the following link: <span style="background-color: inherit;">{proposal_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please don\'t hesitate to comment online if you have any questions.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We look forward to your communication.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(22, 2, 'proposals', 'proposal-client-declined', 'Customer Action - Declined (Sent to Staff)', 'Client Declined Proposal', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Customer {proposal_proposal_to} declined the proposal {proposal_subject}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">View the proposal on the following link {proposal_link} or from the admin area.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div>&nbsp;</div>', '{companyname} | CRM', '', 0, 1, 0),
(24, 2, 'proposals', 'proposal-client-thank-you', 'Customer Thank You Email (After Accept)', 'Thank for you accepting proposal', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {proposal_proposal_to}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank for for accepting the proposal.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We look forward to doing business with you.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We will contact you as soon as possible</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(25, 2, 'proposals', 'proposal-comment-to-client', 'New Comment (Customer)', 'New Proposal Comment', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {proposal_proposal_to}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">A new comment has been made on the following proposal: {proposal_subject}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view and reply to the comment on the following link: {proposal_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(26, 2, 'proposals', 'proposal-comment-to-admin', 'New Comment (Sent to Staff) ', 'New Proposal Comment', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hello</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">A new comment has been made to the proposal <span style="background-color: inherit;">{proposal_subject}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view and reply to the comment on the following link: <span style="background-color: inherit;">{proposal_link} or from the admin area.</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(29, 2, 'estimate', 'estimate-thank-you-to-customer', 'Customer Thank You Email (After Accept)', 'Thank for you accepting estimate', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {contact_firstname}&nbsp;{contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank for for accepting the estimate.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We look forward to doing business with you.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We will contact you as soon as possible.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(31, 2, 'tasks', 'task-deadline-notification', 'Task Deadline Reminder - Sent to assignees', 'Task Deadline Reminder', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {staff_firstname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">This is an automated email from {companyname}.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">The task {task_name} deadline is on {task_duedate}. This task is still not finished.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view: <span style="background-color: inherit;">{task_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(33, 2, 'contract', 'send-contract', 'Send contract to customer', 'Contract - {contract_subject}', '<p>Hi&nbsp;{client_company}</p>\r\n<p>Please find the {contract_subject}&nbsp;attached.</p>\r\n<p>&nbsp;</p>\r\n<p>Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(34, 2, 'invoice', 'invoice-payment-recorded-to-staff', 'Invoice Payment Recorded (Sent to staff)', 'New Invoice Payment', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Customer recorded payment for invoice # {invoice_number}</span></div>\r\n<div>&nbsp;</div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view the invoice on the following link:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{invoice_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO `tblemailtemplates` (`emailtemplateid`, `language`, `type`, `slug`, `name`, `subject`, `message`, `fromname`, `fromemail`, `plaintext`, `active`, `order`) VALUES
(35, 2, 'ticket', 'auto-close-ticket', 'Auto Close Ticket', 'Ticket Auto Closed', '<p><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi&nbsp;{contact_firstname}&nbsp;{contact_lastname}</span></p>\r\n<p><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Ticket&nbsp;{ticket_subject} has been auto close due to inactivity.</span></p>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Ticket #: <span style="background-color: inherit;">{ticket_id}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Department: {ticket_department}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: inherit;">{ticket_priority}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(36, 2, 'project', 'new-project-discussion-created-to-staff', 'New Project Discussion (Sent to project members)', 'New Project Discussion Created', '<p>Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}</p>\r\n<p>New project discussion created from&nbsp;{discussion_creator}</p>\r\n<p>Subject:&nbsp;{discussion_subject}</p>\r\n<p>Description:&nbsp;{discussion_description}</p>\r\n<p>You can view the discussion on the following link:&nbsp;{discussion_link}</p>\r\n<p>Kind Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(37, 2, 'project', 'new-project-discussion-created-to-customer', 'New Project Discussion (Sent to customer contacts)', 'New Project Discussion Created', '<p>Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>\r\n<p>New project discussion created from&nbsp;{discussion_creator}</p>\r\n<p>Subject:&nbsp;{discussion_subject}</p>\r\n<p>Description:&nbsp;{discussion_description}</p>\r\n<p>You can view the discussion on the following link:&nbsp;{discussion_link}</p>\r\n<p>Kind Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(38, 2, 'project', 'new-project-file-uploaded-to-customer', 'New Project File Uploaded (Sent to customer contacts)', 'New Project File Uploaded', '<p>Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>\n<p>New project&nbsp;file is uploaded on&nbsp;{project_name} from&nbsp;{file_creator}</p>\n<p>You can view the project on the following link:&nbsp;{project_link}</p>\n<p>Kind Regards,</p>\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(39, 2, 'project', 'new-project-file-uploaded-to-staff', 'New Project File Uploaded (Sent to project members)', 'New Project File Uploaded', '<p>Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}</p>\r\n<p>New project&nbsp;file is uploaded on&nbsp;{project_name} from&nbsp;{file_creator}</p>\r\n<p>You can view the project on the following link:&nbsp;{project_link}</p>\r\n<p>Kind Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(40, 2, 'project', 'new-project-discussion-comment-to-customer', 'New Discussion Comment (Sent to customer contacts)', 'New Discussion Comment', '<p>Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>\r\n<p>New discussion comment has been made on {discussion_subject} from&nbsp;{comment_creator}</p>\r\n<p>Discussion subject:&nbsp;{discussion_subject}</p>\r\n<p>Comment:&nbsp;{discussion_comment}</p>\r\n<p>You can view the discussion on the following link:&nbsp;{discussion_link}</p>\r\n<p>Kind Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(41, 2, 'project', 'new-project-discussion-comment-to-staff', 'New Discussion Comment (Sent to project members)', 'New Discussion Comment', '<p>Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}</p>\r\n<p>New discussion comment has been made on {discussion_subject} from&nbsp;{comment_creator}</p>\r\n<p>Discussion subject:&nbsp;{discussion_subject}</p>\r\n<p>Comment:&nbsp;{discussion_comment}</p>\r\n<p>You can view the discussion on the following link:&nbsp;{discussion_link}</p>\r\n<p>Kind Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(42, 2, 'project', 'staff-added-as-project-member', 'Staff added as project member', 'New project assigned to you', '<p>Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}</p>\r\n<p>New project has been assigned to you.</p>\r\n<p>You can view the project on the following link&nbsp;{project_link}</p>\r\n<p>Project name:&nbsp;{project_name}</p>\r\n<p>&nbsp;</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(43, 2, 'estimate', 'estimate-expiry-reminder', 'Estimate Expiration Reminder', 'Estimate Expiration Reminder', '<p>Hello&nbsp;{client_company}</p>\r\n<p>The estimate with&nbsp;{estimate_number} will expire on&nbsp;{estimate_expirydate}</p>\r\n<p>You can view the estimate on the following link:&nbsp;{estimate_link}</p>\r\n<p>Regards,</p>\r\n<p>{email_signature}</p>', 'Estimate Expiration Reminder | CRM', '', 0, 1, 0),
(44, 2, 'proposals', 'proposal-expiry-reminder', 'Proposal Expiration Reminder', 'Proposal Expiration Reminder', '<p>Hello&nbsp;{proposal_proposal_to}</p>\r\n<p>The proposal {proposal_subject} will expire on&nbsp;{proposal_open_till}</p>\r\n<p>You can view the proposal on the following link:&nbsp;{proposal_link}</p>\r\n<p>Regards,</p>\r\n<p>{email_signature}</p>', 'Proposal Expiration Reminder | CRM', '', 0, 1, 0),
(45, 2, 'supplier', 'new-supplier-created', 'New supplier Added/Registered (Welcome Email)', 'Welcome aboard', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {supplierContact_firstname}&nbsp;{supplierContact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank you for registering on the {companyname} CRM System.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We just wanted to say welcome.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please contact us if you need any help.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">(This is an automated email, so please don\'t reply to this email address)</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(105, 1, 'tasks', 'task-deadline-notification', 'Task Deadline Reminder - Sent to assignees', 'Task Deadline Reminder', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {staff_firstname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">This is an automated email from {companyname}.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">The task {task_name} deadline is on {task_duedate}. This task is still not finished.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view: <span style="background-color: inherit;">{task_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(106, 1, 'contract', 'send-contract', 'Send contract to customer', 'Contract - {contract_subject}', '<p>Hi&nbsp;{client_company}</p>\r\n<p>Please find the {contract_subject}&nbsp;attached.</p>\r\n<p>&nbsp;</p>\r\n<p>Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(107, 1, 'invoice', 'invoice-payment-recorded-to-staff', 'Paiement de facture enregistré (envoyé au personnel)', 'Nouveau paiement de facture', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Paiement enregistré par le client pour la facture # {invoice_number}</span></div>\n<div>&nbsp;</div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Vous pouvez afficher la facture sur le lien suivant:</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{invoice_link}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Cordialement,</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(104, 1, 'estimate', 'estimate-thank-you-to-customer', 'Customer Thank You Email (After Accept)', 'Thank for you accepting estimate', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {contact_firstname}&nbsp;{contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank for for accepting the estimate.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We look forward to doing business with you.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We will contact you as soon as possible.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(103, 1, 'proposals', 'proposal-comment-to-admin', 'New Comment (Sent to Staff) ', 'New Proposal Comment', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hello</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">A new comment has been made to the proposal <span style="background-color: inherit;">{proposal_subject}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view and reply to the comment on the following link: <span style="background-color: inherit;">{proposal_link} or from the admin area.</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(101, 1, 'proposals', 'proposal-client-thank-you', 'Customer Thank You Email (After Accept)', 'Thank for you accepting proposal', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {proposal_proposal_to}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank for for accepting the proposal.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We look forward to doing business with you.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We will contact you as soon as possible</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(102, 1, 'proposals', 'proposal-comment-to-client', 'New Comment (Customer)', 'New Proposal Comment', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {proposal_proposal_to}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">A new comment has been made on the following proposal: {proposal_subject}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view and reply to the comment on the following link: {proposal_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(100, 1, 'proposals', 'proposal-client-declined', 'Customer Action - Declined (Sent to Staff)', 'Client Declined Proposal', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Customer {proposal_proposal_to} declined the proposal {proposal_subject}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">View the proposal on the following link {proposal_link} or from the admin area.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div>&nbsp;</div>', '{companyname} | CRM', '', 0, 1, 0),
(99, 1, 'proposals', 'proposal-send-to-customer', 'Send Proposal to Customer', 'Proposal', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear <span style="background-color: inherit;">{proposal_proposal_to}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please find our attached proposal.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">This proposal is valid until: <span style="background-color: inherit;">{proposal_open_till}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view the proposal on the following link: <span style="background-color: inherit;">{proposal_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Veuillez ne pas hesiter de commenter en ligne si vous avez des questions.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We look forward to your communication.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(97, 1, 'estimate', 'estimate-accepted-to-staff', 'Estimate Accepted (Sent to Staff)', 'Customer Accepted Estimate', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Customer ({client_company}) accepted estimate with number <span style="background-color: inherit;">{estimate_number}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view the estimate on the following link <span style="background-color: inherit;">{estimate_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(98, 1, 'proposals', 'proposal-client-accepted', 'Customer Action - Accepted (Sent to Staff)', 'Customer Accepted Proposal', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Client {proposal_proposal_to} accepted the following proposal:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: {proposal_subject}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Total: {proposal_total}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">View the proposal on the following link: {proposal_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>', '{companyname} | CRM', '', 0, 1, 0),
(96, 1, 'estimate', 'estimate-declined-to-staff', 'Estimate Declined (Sent to Staff)', 'Customer Declined Estimate', '<div><span style="font-size: 12pt;">Hi</span></div>\r\n<div><span style="font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-size: 12pt;">Customer ({client_company}) declined estimate with number <span style="background-color: inherit;">{estimate_number}</span></span></div>\r\n<div><span style="font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-size: 12pt;">You can view the estimate on the following link <span style="background-color: inherit;">{estimate_link}</span></span></div>\r\n<div><span style="font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(95, 1, 'tasks', 'task-unmarked-as-finished', 'Task Unmarked as Finished', 'Task UN-marked as finished - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {staff_firstname} {staff_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{task_user_take_action} <span style="background-color: inherit;">marked the </span>following task as <strong>in-complete / unfinished</strong></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Name: </span><span style="background-color: inherit;">{task_name}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Description: </span><span style="background-color: inherit;">{task_description}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Due date: {task_duedate}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view: <span style="background-color: inherit;">{task_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(94, 1, 'tasks', 'task-added-attachment', 'New Attachment on Task', 'New Attachment on Task - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {staff_firstname} {staff_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{task_user_take_action} added an attachment on the following task:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Name: </span>{task_name}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Description: </span><span style="background-color: inherit;">{task_description}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view: <span style="background-color: inherit;">{task_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(93, 1, 'tasks', 'task-marked-as-finished', 'Task Marked as Finished', 'Task Marked as Finished - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {staff_firstname} {staff_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{task_user_take_action} marked the following task as complete:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Name: </span>{task_name}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"><span style="background-color: inherit;">Description: </span><span style="background-color: inherit;">{task_description}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Due date: <span style="background-color: #ffffff;">{task_duedate}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view: <span style="background-color: inherit;">{task_link}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(92, 1, 'tasks', 'task-commented', 'New Comment on Task', 'New Comment on Task - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {staff_firstname} {staff_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">A comment has been made on the following task:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Name: &nbsp;{task_name}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Description: &nbsp;{task_description}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Click on the following link to view: {task_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(91, 1, 'tasks', 'task-added-as-follower', 'Staff Added as Follower on Task', 'You are added as follower on task - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi {staff_firstname} <span style="background-color: #ffffff;">{staff_lastname}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You have been added as follower on the following task:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Name: {task_name}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Description: {task_description}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: {task_priority}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Start date: {task_startdate}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Due date: {task_duedate}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view this task: {task_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div>&nbsp;</div>', '{companyname} | CRM', '', 0, 1, 0),
(90, 1, 'tasks', 'task-assigned', 'New Task Assigned', 'New Task Assigned to You - {task_name}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {staff_firstname} {staff_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You have been assigned a new task:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Name: <span style="background-color: #ffffff;">{task_name}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Due date: <span style="background-color: #ffffff;">{task_duedate}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: #ffffff;">{task_priority}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please click on the following link to view this task: {task_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(89, 1, 'contract', 'contract-expiration', 'Contract Expiration', 'Contract Expiration Reminder', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {client_company}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">This is a reminder that the following contract will expire soon:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject {contract_subject}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Description {contract_description}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Date Start {contract_datestart}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Date End {contract_dateend}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Value {contract_contract_value}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please contact us for more information.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 1),
(88, 1, 'estimate', 'estimate-already-send', 'Estimate Already Sent to Customer', 'Estimate # {estimate_number} ', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {contact_firstname}&nbsp;{contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank you for your estimate request.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view the follow estimate on the following link {estimate_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please contact us for more information.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(87, 1, 'ticket', 'ticket-reply-to-admin', 'Ticket Reply (Sent to staff)', 'New Support Ticket Reply', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">A new support ticket reply from {contact_firstname} {contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: <span style="background-color: inherit;">{ticket_subject}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Department: {ticket_department}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: inherit;">{ticket_priority}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You can view this ticket any time at <span style="background-color: inherit;">{ticket_url}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(86, 1, 'estimate', 'estimate-send-to-client', 'Send Estimate to Customer', 'Estimate # {estimate_number} created', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {contact_firstname}&nbsp;{contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please find the attached estimate # {estimate_number}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Estimate status:&nbsp;<strong>{estimate_status}</strong></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{estimate_link}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We look forward to your communication.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Cordialement,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(85, 1, 'ticket', 'new-ticket-created-staff', 'New Ticket Created (Opened by customer, sent to staff members)', 'New Ticket Created', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">A new support ticket has been opened.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: <span style="background-color: inherit;">{ticket_subject}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Department: {ticket_department}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: inherit;">{ticket_priority}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(84, 1, 'invoice', 'invoice-already-send', 'Facture déjà envoyée au client', 'Sur votre commande, voici la facture', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Bonjour <span style="background-color: inherit;">{contact_firstname} {contact_lastname}</span></span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Sur demande, veuillez consulter le lien vers la facture # {invoice_number}&nbsp;below.</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Cliquez ici pour consulter la facture en ligne: {invoice_link}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Veuillez nous contacter pour plus d\'informations.</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Cordialement,</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(82, 1, 'invoice', 'invoice-payment-recorded', 'Paiement de facture enregistré', 'Paiement de facture enregistré', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Paiement enregistré pour la facture&nbsp;# {invoice_number}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{invoice_link}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Cordialement,</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(83, 1, 'invoice', 'invoice-overdue-notice', 'Avis de retard de facturation', 'Avis de retard de facturation - {invoice_number}', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Bonjour {contact_firstname} {contact_lastname}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Il s\'agit d\'un avis en retard pour la facture # {invoice_number}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Cette facture était due: {invoice_duedate}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Veuillez consulter la facture ici: &nbsp;{invoice_link}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Cordialement,</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(81, 1, 'ticket', 'ticket-autoresponse', 'New Ticket Open Autoresponse', 'Nouveau billet d\'assistance ouvert', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi&nbsp;{contact_firstname} {contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank you for contacting our support team. A support ticket has now been opened for your request. You will be notified when a response is made by email.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: {ticket_subject}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Department: {ticket_department}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: {ticket_priority}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO `tblemailtemplates` (`emailtemplateid`, `language`, `type`, `slug`, `name`, `subject`, `message`, `fromname`, `fromemail`, `plaintext`, `active`, `order`) VALUES
(80, 1, 'ticket', 'ticket-reply', 'Ticket Reply (Sent to customer)', 'New Ticket Reply', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi&nbsp;<span style="background-color: inherit;">{contact_firstname} </span>{contact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">You have a new ticket reply to ticket #{ticket_id}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Subject: <span style="background-color: inherit;">{ticket_subject}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Department: {ticket_department}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: inherit;">{ticket_priority}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(79, 1, 'ticket', 'new-ticket-opened-admin', 'New Ticket Opened (Opened by staff, sent to customer)', 'Nouveau billet d\'assistance ouve', '<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">Bonjour&nbsp;{contact_firstname} {contact_lastname}</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">Nouveau ticket d\'\'assistance a &eacute;t&eacute; ouvert.</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">Sujet: <span style="background-color: inherit;">{ticket_subject}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; color: #000000; font-size: 12pt; background-color: inherit;">Departement: {ticket_department}</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priorit&eacute;: <span style="background-color: inherit;">{ticket_priority}</span></span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Message du ticket:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; color: #000000; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(78, 1, 'invoice', 'invoice-send-to-client', 'Envoyer une facture au client', 'Facture avec numéro {invoice_number} créé', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Cher {contact_firstname}&nbsp;{contact_lastname}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Nous avons préparé la facture suivante pour vous: #&nbsp;{invoice_number}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">État de la facture:&nbsp;<strong style="font-family: Helvetica, Arial, sans-serif;">{invoice_status}</strong></span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Veuillez cliquer sur le lien ci-dessous pour consulter la facture en ligne: <strong>{invoice_link}</strong></span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Veuillez nous contacter pour plus d\'informations.</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Cordialement,</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(77, 1, 'client', 'new-client-created', 'New Customer Added/Registered (Welcome Email)', 'Welcome aboard', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {contact_firstname}&nbsp;{contact_lastname}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank you for registering on the {companyname} CRM System.</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We just wanted to say welcome.</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please contact us if you need any help.</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Click here to view your profile: {crm_url}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">(This is an automated email, so please don\'t reply to this email address)</span></div>\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(108, 1, 'ticket', 'auto-close-ticket', 'Auto Close Ticket', 'Ticket Auto Closed', '<p><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Hi&nbsp;{contact_firstname}&nbsp;{contact_lastname}</span></p>\r\n<p><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Ticket&nbsp;{ticket_subject} has been auto close due to inactivity.</span></p>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Ticket #: <span style="background-color: inherit;">{ticket_id}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Department: {ticket_department}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Priority: <span style="background-color: inherit;">{ticket_priority}</span></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">Ticket message:</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt; background-color: inherit;">{ticket_message}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>', '{companyname} | CRM', '', 0, 1, 0),
(109, 1, 'project', 'new-project-discussion-created-to-staff', 'New Project Discussion (Sent to project members)', 'New Project Discussion Created', '<p>Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}</p>\r\n<p>New project discussion created from&nbsp;{discussion_creator}</p>\r\n<p>Subject:&nbsp;{discussion_subject}</p>\r\n<p>Description:&nbsp;{discussion_description}</p>\r\n<p>You can view the discussion on the following link:&nbsp;{discussion_link}</p>\r\n<p>Kind Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(110, 1, 'project', 'new-project-discussion-created-to-customer', 'New Project Discussion (Sent to customer contacts)', 'New Project Discussion Created', '<p>Bonjour {contact_firstname}&nbsp;{contact_lastname}</p>\r\n<p>New project discussion created from&nbsp;{discussion_creator}</p>\r\n<p>Subject:&nbsp;{discussion_subject}</p>\r\n<p>Description:&nbsp;{discussion_description}</p>\r\n<p>You can view the discussion on the following link:&nbsp;{discussion_link}</p>\r\n<p>Kind Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(111, 1, 'project', 'new-project-file-uploaded-to-customer', 'New Project File Uploaded (Sent to customer contacts)', 'New Project File Uploaded', '<p>Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>\n<p>New project&nbsp;file is uploaded on&nbsp;{project_name} from&nbsp;{file_creator}</p>\n<p>You can view the project on the following link:&nbsp;{project_link}</p>\n<p>Kind Regards,</p>\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(112, 1, 'project', 'new-project-file-uploaded-to-staff', 'New Project File Uploaded (Sent to project members)', 'New Project File Uploaded', '<p>Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}</p>\r\n<p>New project&nbsp;file is uploaded on&nbsp;{project_name} from&nbsp;{file_creator}</p>\r\n<p>You can view the project on the following link:&nbsp;{project_link}</p>\r\n<p>Kind Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(113, 1, 'project', 'new-project-discussion-comment-to-customer', 'New Discussion Comment (Sent to customer contacts)', 'New Discussion Comment', '<p>Bonjour&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>\r\n<p>New discussion comment has been made on {discussion_subject} from&nbsp;{comment_creator}</p>\r\n<p>Discussion subject:&nbsp;{discussion_subject}</p>\r\n<p>Comment:&nbsp;{discussion_comment}</p>\r\n<p>You can view the discussion on the following link:&nbsp;{discussion_link}</p>\r\n<p>Kind Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(114, 1, 'project', 'new-project-discussion-comment-to-staff', 'New Discussion Comment (Sent to project members)', 'New Discussion Comment', '<p>Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}</p>\r\n<p>Nouveau discussion comment has been made on {discussion_subject} from&nbsp;{comment_creator}</p>\r\n<p>Discussion subject:&nbsp;{discussion_subject}</p>\r\n<p>Comment:&nbsp;{discussion_comment}</p>\r\n<p>You can view the discussion on the following link:&nbsp;{discussion_link}</p>\r\n<p>Kind Regards,</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(115, 1, 'project', 'staff-added-as-project-member', 'Staff added as project member', 'New project assigned to you', '<p>Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}</p>\r\n<p>New project has been assigned to you.</p>\r\n<p>You can view the project on the following link&nbsp;{project_link}</p>\r\n<p>Project name:&nbsp;{project_name}</p>\r\n<p>&nbsp;</p>\r\n<p>{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(116, 1, 'estimate', 'estimate-expiry-reminder', 'Estimate Expiration Reminder', 'Estimate Expiration Reminder', '<p>Hello&nbsp;{client_company}</p>\r\n<p>The estimate with&nbsp;{estimate_number} will expire on&nbsp;{estimate_expirydate}</p>\r\n<p>You can view the estimate on the following link:&nbsp;{estimate_link}</p>\r\n<p>Regards,</p>\r\n<p>{email_signature}</p>', 'Estimate Expiration Reminder | CRM', '', 0, 1, 0),
(117, 1, 'proposals', 'proposal-expiry-reminder', 'Proposal Expiration Reminder', 'Proposal Expiration Reminder', '<p>Hello&nbsp;{proposal_proposal_to}</p>\r\n<p>The proposal {proposal_subject} will expire on&nbsp;{proposal_open_till}</p>\r\n<p>You can view the proposal on the following link:&nbsp;{proposal_link}</p>\r\n<p>Regards,</p>\r\n<p>{email_signature}</p>', 'Proposal Expiration Reminder | CRM', '', 0, 1, 0),
(118, 1, 'supplier', 'new-supplier-created', 'New supplier Added/Registered (Welcome Email)', 'Welcome aboard', '<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Dear {supplierContact_firstname}&nbsp;{supplierContact_lastname}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Thank you for registering on the {companyname} CRM System.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">We just wanted to say welcome.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Please contact us if you need any help.</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;"></span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">Kind regards,</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">{email_signature}</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">(This is an automated email, so please don\'t reply to this email address)</span></div>\r\n<div><span style="font-family: arial, helvetica, sans-serif; font-size: 12pt;">&nbsp;</span></div>', '{companyname} | CRM', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblestimateactivity`
--

CREATE TABLE `tblestimateactivity` (
  `id` int(11) NOT NULL,
  `estimateid` int(11) NOT NULL,
  `description` text NOT NULL,
  `additional_data` varchar(600) DEFAULT NULL,
  `staffid` varchar(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblestimateactivity`
--

INSERT INTO `tblestimateactivity` (`id`, `estimateid`, `description`, `additional_data`, `staffid`, `date`) VALUES
(1, 1, 'estimate_activity_created', '', '1', '2016-09-05 00:43:27'),
(2, 1, 'invoice_estimate_activity_added_item', 'a:1:{i:0;s:21:"integration Front end";}', '1', '2016-09-05 00:48:34'),
(3, 1, 'invoice_estimate_activity_added_item', 'a:1:{i:0;s:18:"Design Back Office";}', '1', '2016-09-05 00:48:34'),
(4, 1, 'invoice_estimate_activity_sent_to_client', 'a:1:{i:0;s:68:"<custom_data>i.ab@deepmaroc.com, n.alami@deepmaroc.com</custom_data>";}', '1', '2016-09-05 00:57:01'),
(5, 2, 'estimate_activity_created', '', '3', '2016-10-20 16:06:46'),
(6, 2, 'invoice_estimate_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-10-20 16:07:36'),
(7, 2, 'estimate_activity_client_declined', '', NULL, '2016-10-20 16:10:19'),
(8, 2, 'estimate_activity_converted', 'a:1:{i:0;s:84:"<a href="http://localhost/CRM/live/admin/invoices/list_invoices/2">F-2016/000145</a>";}', '3', '2016-10-20 16:18:45'),
(9, 2, 'not_estimate_invoice_deleted', '', '3', '2016-10-20 17:06:50'),
(10, 3, 'estimate_activity_created', '', '6', '2016-10-26 17:37:03'),
(11, 3, 'estimate_activity_converted', 'a:1:{i:0;s:84:"<a href="http://localhost/CRM/live/admin/invoices/list_invoices/7">F-2016/000147</a>";}', '6', '2016-10-26 17:43:54'),
(12, 1, 'estimate_activity_converted', 'a:1:{i:0;s:84:"<a href="http://localhost/CRM/live/admin/invoices/list_invoices/8">F-2016/000148</a>";}', '6', '2016-10-26 17:52:09'),
(13, 4, 'estimate_activity_created', '', '6', '2016-10-26 18:07:38'),
(14, 4, 'estimate_activity_converted', 'a:1:{i:0;s:84:"<a href="http://localhost/CRM/live/admin/invoices/list_invoices/9">F-2016/000149</a>";}', '6', '2016-10-26 18:08:34'),
(15, 4, 'not_estimate_status_updated', 'a:2:{i:0;s:36:"<original_status>4</original_status>";i:1;s:26:"<new_status>2</new_status>";}', '6', '2016-10-26 18:08:58'),
(16, 4, 'estimate_activity_client_accepted_and_converted', 'a:1:{i:0;s:85:"<a href="http://localhost/CRM/live/admin/invoices/list_invoices/10">F-2016/000150</a>";}', NULL, '2016-10-26 18:26:16'),
(17, 5, 'estimate_activity_created', '', '3', '2016-12-08 16:35:14'),
(18, 5, 'invoice_estimate_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-09 11:25:40');

-- --------------------------------------------------------

--
-- Structure de la table `tblestimateitems`
--

CREATE TABLE `tblestimateitems` (
  `id` int(11) NOT NULL,
  `estimateid` int(11) NOT NULL,
  `qty` decimal(11,2) NOT NULL,
  `description` mediumtext NOT NULL,
  `long_description` text,
  `rate` decimal(11,2) NOT NULL,
  `item_order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblestimateitems`
--

INSERT INTO `tblestimateitems` (`id`, `estimateid`, `qty`, `description`, `long_description`, `rate`, `item_order`) VALUES
(1, 1, '1.00', 'Design Logo', 'Logotype charte graphique etude et montage', '3000.00', 1),
(2, 1, '1.00', 'integration Front end', 'njbkjkbjbjk', '2500.00', 2),
(3, 1, '1.00', 'Design Back Office', 'dededededwd', '3500.00', 3),
(4, 5, '10.00', '', '', '23.00', 1),
(5, 5, '1.00', '', '', '0.00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tblestimateitemstaxes`
--

CREATE TABLE `tblestimateitemstaxes` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `estimate_id` int(11) NOT NULL,
  `taxrate` decimal(11,2) NOT NULL,
  `taxname` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblestimateitemstaxes`
--

INSERT INTO `tblestimateitemstaxes` (`id`, `itemid`, `estimate_id`, `taxrate`, `taxname`) VALUES
(1, 1, 1, '20.00', 'TVA'),
(2, 2, 1, '20.00', 'TVA'),
(3, 3, 1, '20.00', 'TVA'),
(4, 4, 5, '20.00', 'TVA'),
(5, 5, 5, '20.00', 'TVA');

-- --------------------------------------------------------

--
-- Structure de la table `tblestimates`
--

CREATE TABLE `tblestimates` (
  `id` int(11) NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `datesend` datetime DEFAULT NULL,
  `clientid` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `date` date NOT NULL,
  `expirydate` date DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `total_tax` decimal(11,2) NOT NULL DEFAULT '0.00',
  `total` decimal(11,2) NOT NULL,
  `adjustment` decimal(11,2) DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `clientnote` text,
  `adminnote` text,
  `discount_percent` decimal(11,2) DEFAULT '0.00',
  `discount_total` decimal(11,2) DEFAULT '0.00',
  `discount_type` varchar(30) DEFAULT NULL,
  `invoiceid` int(11) DEFAULT NULL,
  `invoiced_date` datetime DEFAULT NULL,
  `terms` text,
  `reference_no` varchar(100) DEFAULT NULL,
  `sale_agent` int(11) NOT NULL DEFAULT '0',
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `show_shipping_on_estimate` tinyint(1) NOT NULL DEFAULT '1',
  `show_quantity_as` int(11) NOT NULL DEFAULT '1',
  `pipeline_order` int(11) NOT NULL DEFAULT '0',
  `is_expiry_notified` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) DEFAULT '0',
  `supplierid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblestimates`
--

INSERT INTO `tblestimates` (`id`, `sent`, `datesend`, `clientid`, `number`, `year`, `hash`, `datecreated`, `date`, `expirydate`, `currency`, `subtotal`, `total_tax`, `total`, `adjustment`, `addedfrom`, `status`, `clientnote`, `adminnote`, `discount_percent`, `discount_total`, `discount_type`, `invoiceid`, `invoiced_date`, `terms`, `reference_no`, `sale_agent`, `billing_street`, `billing_city`, `billing_state`, `billing_zip`, `billing_country`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `include_shipping`, `show_shipping_on_estimate`, `show_quantity_as`, `pipeline_order`, `is_expiry_notified`, `project_id`, `supplierid`) VALUES
(1, 1, '2016-09-05 00:57:01', 1, 144, 2016, 'f57bfc5cbf81693f82ca781378b62f08', '2016-09-05 00:43:27', '2016-09-05', '2020-03-04', 3, '9000.00', '1710.00', '10260.00', '0.00', 1, 4, 'deadline sous reserve validation', 'fvffdvdvdvdcdffvvf', '5.00', '450.00', 'before_tax', 8, '2016-10-26 17:52:09', 'terme que tu dois appliquer', '5', 1, '161, rue Taha Houcine', 'Casablanca', 'Quartier Gauthier', '20100', 149, '161, rue Taha Houcine', 'Casablanca', 'Quartier Gauthier', '20100', 149, 1, 1, 1, 0, 0, NULL, 0),
(2, 1, '2016-10-20 16:07:36', 3, 145, 2016, 'c8b5ce897509d16f2e057770bcadd234', '2016-10-20 16:06:46', '2016-10-20', NULL, 3, '0.00', '0.00', '0.00', '0.00', 3, 4, '', '', '0.00', '0.00', '', NULL, NULL, '', '', 3, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 0, 4, 0),
(3, 0, NULL, 3, 146, 2016, 'ba88d7589d90e7fcdf93fd51898b1a46', '2016-10-26 17:37:03', '2016-10-26', NULL, 3, '0.00', '0.00', '0.00', '0.00', 6, 4, '', '', '0.00', '0.00', '', 7, '2016-10-26 17:43:54', '', '', 6, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 0, 0, 0),
(4, 0, NULL, 3, 147, 2016, 'e36afe9d2d4f58b37da7c57b73d49738', '2016-10-26 18:07:38', '2016-10-26', NULL, 3, '0.00', '0.00', '0.00', '0.00', 6, 4, '', '', '0.00', '0.00', '', 10, '2016-10-26 18:26:16', '', '', 6, '', '', '', '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 0, 0, 0),
(5, 1, '2016-12-09 11:25:40', 3, 148, 2016, 'ab5bfe5a4544989bb82e5191b7a3d2df', '2016-12-08 16:35:14', '2016-12-08', '2016-12-21', 3, '230.00', '46.00', '1475.64', '1230.00', 3, 2, '', '', '11.00', '30.36', 'after_tax', NULL, NULL, '', 'ref', 6, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblevents`
--

CREATE TABLE `tblevents` (
  `eventid` int(11) NOT NULL,
  `title` mediumtext NOT NULL,
  `description` text,
  `userid` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `color` varchar(10) DEFAULT NULL,
  `isstartnotified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblevents`
--

INSERT INTO `tblevents` (`eventid`, `title`, `description`, `userid`, `start`, `end`, `public`, `color`, `isstartnotified`) VALUES
(1, 'tygjighjkg', 'yiytuiyhuikhj', 2, '2016-09-08 00:00:00', NULL, 0, '#28B8DA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tblexpenses`
--

CREATE TABLE `tblexpenses` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `currency` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `tax` int(11) DEFAULT NULL,
  `reference_no` varchar(100) DEFAULT NULL,
  `note` text,
  `attachment` mediumtext NOT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `clientid` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `billable` int(11) DEFAULT '0',
  `invoiceid` int(11) DEFAULT NULL,
  `paymentmode` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `recurring_type` varchar(10) DEFAULT NULL,
  `repeat_every` int(11) DEFAULT NULL,
  `recurring` int(11) NOT NULL DEFAULT '0',
  `recurring_ends_on` date DEFAULT NULL,
  `custom_recurring` int(11) NOT NULL DEFAULT '0',
  `last_recurring_date` date DEFAULT NULL,
  `create_invoice_billable` tinyint(1) DEFAULT NULL,
  `send_invoice_to_customer` tinyint(1) NOT NULL,
  `recurring_from` int(11) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `addedfrom` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblexpenses`
--

INSERT INTO `tblexpenses` (`id`, `category`, `currency`, `amount`, `tax`, `reference_no`, `note`, `attachment`, `filetype`, `clientid`, `project_id`, `billable`, `invoiceid`, `paymentmode`, `date`, `recurring_type`, `repeat_every`, `recurring`, `recurring_ends_on`, `custom_recurring`, `last_recurring_date`, `create_invoice_billable`, `send_invoice_to_customer`, `recurring_from`, `dateadded`, `addedfrom`, `supplierid`) VALUES
(1, 2, 3, '13213.00', 1, '', '', '', NULL, 3, 4, 1, 6, 'paypal', '2016-10-25', NULL, NULL, 0, NULL, 0, NULL, 0, 0, NULL, '2016-10-25 13:37:52', 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblexpensescategories`
--

CREATE TABLE `tblexpensescategories` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `description` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblexpensescategories`
--

INSERT INTO `tblexpensescategories` (`id`, `name`, `description`) VALUES
(1, 'Achat D\'arts', ''),
(2, 'Digital', ''),
(3, 'Transport', ''),
(4, 'DÃ©placements', '');

-- --------------------------------------------------------

--
-- Structure de la table `tblgoals`
--

CREATE TABLE `tblgoals` (
  `id` int(11) NOT NULL,
  `subject` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `goal_type` int(11) NOT NULL,
  `contract_type` int(11) NOT NULL DEFAULT '0',
  `achievement` int(11) NOT NULL,
  `addedfrom` int(11) NOT NULL,
  `assigned` int(11) DEFAULT NULL COMMENT AS `test`,
  `notify_when_fail` tinyint(1) NOT NULL DEFAULT '1',
  `notify_when_achieve` tinyint(1) NOT NULL DEFAULT '1',
  `notified` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblinvoiceactivity`
--

CREATE TABLE `tblinvoiceactivity` (
  `id` int(11) NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `description` text NOT NULL,
  `additional_data` varchar(600) DEFAULT NULL,
  `staffid` varchar(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblinvoiceactivity`
--

INSERT INTO `tblinvoiceactivity` (`id`, `invoiceid`, `description`, `additional_data`, `staffid`, `date`) VALUES
(1, 1, 'invoice_activity_created', '', '2', '2016-09-06 17:53:26'),
(2, 1, 'invoice_activity_status_updated', 'a:2:{i:0;s:36:"<original_status>1</original_status>";i:1;s:26:"<new_status>2</new_status>";}', '2', '2016-09-06 17:54:09'),
(3, 1, 'invoice_activity_payment_made_by_staff', 'a:2:{i:0;s:11:"3.000,00MAD";i:1;s:83:"<a href="http://live.deepmaroc.com/admin/payments/payment/1" target="_blank">#1</a>";}', '2', '2016-09-06 17:54:09'),
(13, 7, 'invoice_activity_created', '', '6', '2016-10-26 17:43:54'),
(14, 8, 'invoice_activity_created', '', '6', '2016-10-26 17:52:09'),
(15, 9, 'invoice_activity_created', '', '6', '2016-10-26 18:08:34'),
(11, 5, 'invoice_activity_created', '', '6', '2016-10-24 12:46:03'),
(12, 6, 'invoice_activity_created', '', '6', '2016-10-26 12:54:45'),
(16, 10, 'invoice_activity_created', '', '0', '2016-10-26 18:26:16'),
(17, 11, 'invoice_activity_created', '', '3', '2016-11-16 15:37:57'),
(18, 12, 'invoice_activity_created', '', '3', '2016-11-16 15:45:45'),
(19, 13, 'invoice_activity_created', '', '3', '2016-11-16 16:27:43'),
(20, 14, 'invoice_activity_created', '', '3', '2016-11-22 18:02:23'),
(21, 10, 'invoice_activity_added_attachment', '', '3', '2016-11-22 18:17:05'),
(22, 12, 'invoice_activity_added_attachment', '', '3', '2016-11-23 11:15:50'),
(23, 12, 'invoice_activity_added_attachment', '', '3', '2016-11-23 11:31:05'),
(24, 16, 'invoice_activity_created', '', '3', '2016-11-24 16:18:01'),
(93, 53, 'invoice_activity_created', '', '3', '2016-11-29 11:48:04'),
(26, 18, 'invoice_activity_created', '', '3', '2016-11-24 16:23:44'),
(92, 52, 'invoice_activity_created', '', '3', '2016-11-29 11:34:26'),
(28, 20, 'invoice_activity_created', '', '3', '2016-11-24 16:30:53'),
(94, 54, 'invoice_activity_created', '', '3', '2016-11-29 11:51:26'),
(30, 2, 'invoice_activity_added_attachment', '', '3', '2016-11-24 16:47:21'),
(88, 49, 'invoice_activity_added_attachment', '', '3', '2016-11-29 10:51:31'),
(32, 2, 'invoice_activity_added_attachment', '', '3', '2016-11-24 16:48:40'),
(90, 50, 'invoice_activity_created', '', '3', '2016-11-29 11:07:50'),
(34, 1, 'invoice_activity_added_attachment', '', '3', '2016-11-24 16:49:47'),
(35, 24, 'invoice_activity_created', '', '3', '2016-11-24 16:49:48'),
(36, 12, 'invoice_activity_added_attachment', '', '3', '2016-11-24 16:56:34'),
(37, 25, 'invoice_activity_created', '', '3', '2016-11-24 16:56:35'),
(38, 0, 'invoice_activity_added_attachment', '', '3', '2016-11-24 16:58:11'),
(39, 26, 'invoice_activity_created', '', '3', '2016-11-24 16:58:12'),
(40, 1, 'invoice_activity_added_attachment', '', '3', '2016-11-24 17:19:22'),
(42, 10, 'invoice_activity_added_attachment', '', '3', '2016-11-24 17:38:03'),
(43, 28, 'invoice_activity_created', '', '3', '2016-11-24 17:38:04'),
(44, 0, 'invoice_activity_added_attachment', '', '3', '2016-11-24 17:42:01'),
(45, 29, 'invoice_activity_created', '', '3', '2016-11-24 17:42:02'),
(87, 49, 'invoice_activity_added_attachment', '', '3', '2016-11-28 17:44:03'),
(47, 1, 'invoice_activity_added_attachment', '', '3', '2016-11-24 17:48:42'),
(48, 31, 'invoice_activity_created', '', '3', '2016-11-24 17:48:43'),
(49, 1, 'invoice_activity_added_attachment', '', '3', '2016-11-24 17:51:14'),
(50, 32, 'invoice_activity_created', '', '3', '2016-11-24 17:51:14'),
(51, 1, 'invoice_activity_added_attachment', '', '3', '2016-11-24 17:52:58'),
(52, 33, 'invoice_activity_created', '', '3', '2016-11-24 17:53:00'),
(53, 25, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:02:34'),
(54, 34, 'invoice_activity_created', '', '3', '2016-11-24 18:02:37'),
(55, 35, 'invoice_activity_created', '', '3', '2016-11-24 18:03:33'),
(89, 49, 'invoice_activity_created', '', '3', '2016-11-29 11:06:57'),
(58, 36, 'invoice_activity_created', '', '3', '2016-11-24 18:04:20'),
(59, 0, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:04:53'),
(60, 37, 'invoice_activity_created', '', '3', '2016-11-24 18:04:54'),
(61, 0, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:05:41'),
(62, 38, 'invoice_activity_created', '', '3', '2016-11-24 18:05:41'),
(63, 0, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:06:47'),
(64, 39, 'invoice_activity_created', '', '3', '2016-11-24 18:06:48'),
(65, 0, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:07:37'),
(91, 51, 'invoice_activity_created', '', '3', '2016-11-29 11:20:22'),
(67, 1, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:07:56'),
(68, 41, 'invoice_activity_created', '', '3', '2016-11-24 18:07:57'),
(69, 42, 'invoice_activity_created', '', '3', '2016-11-24 18:09:26'),
(70, 42, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:10:02'),
(71, 43, 'invoice_activity_created', '', '3', '2016-11-24 18:10:06'),
(72, 44, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:11:00'),
(73, 44, 'invoice_activity_created', '', '3', '2016-11-24 18:11:01'),
(74, 45, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:24:42'),
(75, 45, 'invoice_activity_created', '', '3', '2016-11-24 18:24:42'),
(76, 46, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:25:21'),
(77, 46, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:25:35'),
(78, 46, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:26:58'),
(79, 46, 'invoice_activity_created', '', '3', '2016-11-24 18:26:59'),
(80, 47, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:27:43'),
(81, 47, 'invoice_activity_created', '', '3', '2016-11-24 18:27:44'),
(82, 48, 'invoice_activity_added_attachment', '', '3', '2016-11-24 18:28:48'),
(83, 48, 'invoice_activity_created', '', '3', '2016-11-24 18:28:50'),
(84, 49, 'invoice_activity_added_attachment', '', '3', '2016-11-28 12:43:04'),
(85, 11, 'invoice_activity_added_attachment', '', '3', '2016-11-28 12:44:02'),
(86, 49, 'invoice_activity_added_attachment', '', '3', '2016-11-28 13:04:52'),
(95, 55, 'invoice_activity_created', '', '3', '2016-11-29 12:11:11'),
(96, 56, 'invoice_activity_created', '', '3', '2016-11-29 12:13:14'),
(97, 57, 'invoice_activity_created', '', '3', '2016-11-29 12:14:18'),
(98, 58, 'invoice_activity_created', '', '3', '2016-11-29 12:19:11'),
(99, 59, 'invoice_activity_created', '', '3', '2016-11-29 12:20:52'),
(100, 60, 'invoice_activity_created', '', '3', '2016-11-29 12:27:54'),
(101, 61, 'invoice_activity_created', '', '3', '2016-11-29 12:29:45'),
(102, 62, 'invoice_activity_created', '', '3', '2016-11-29 12:40:16'),
(103, 63, 'invoice_activity_created', '', '3', '2016-11-29 12:41:28'),
(104, 64, 'invoice_activity_created', '', '3', '2016-11-29 12:55:04'),
(105, 65, 'invoice_activity_created', '', '3', '2016-11-29 12:57:28'),
(106, 66, 'invoice_activity_created', '', '3', '2016-11-29 12:58:55'),
(107, 67, 'invoice_activity_created', '', '3', '2016-11-29 12:59:47'),
(108, 68, 'invoice_activity_created', '', '3', '2016-11-29 13:05:59'),
(109, 69, 'invoice_activity_created', '', '3', '2016-11-29 13:07:50'),
(110, 70, 'invoice_activity_created', '', '3', '2016-11-29 13:08:28'),
(111, 71, 'invoice_activity_created', '', '3', '2016-11-29 13:21:12'),
(112, 72, 'invoice_activity_created', '', '3', '2016-11-29 13:23:06'),
(113, 73, 'invoice_activity_created', '', '3', '2016-11-29 13:24:05'),
(114, 74, 'invoice_activity_created', '', '3', '2016-11-29 13:30:47'),
(115, 75, 'invoice_activity_created', '', '3', '2016-11-29 13:34:30'),
(116, 76, 'invoice_activity_created', '', '3', '2016-11-29 15:34:56'),
(117, 77, 'invoice_activity_created', '', '3', '2016-11-29 15:38:03'),
(118, 78, 'invoice_activity_created', '', '3', '2016-11-29 15:39:31'),
(119, 79, 'invoice_activity_created', '', '3', '2016-11-29 15:40:32'),
(120, 80, 'invoice_activity_created', '', '3', '2016-11-29 15:42:08'),
(121, 81, 'invoice_activity_created', '', '3', '2016-11-29 15:42:59'),
(122, 82, 'invoice_activity_created', '', '3', '2016-11-29 15:50:44'),
(123, 83, 'invoice_activity_created', '', '3', '2016-11-29 16:10:06'),
(124, 84, 'invoice_activity_created', '', '3', '2016-11-29 16:11:24'),
(125, 85, 'invoice_activity_created', '', '3', '2016-11-29 16:11:50'),
(126, 86, 'invoice_activity_created', '', '3', '2016-11-29 16:12:50'),
(127, 87, 'invoice_activity_added_attachment', '', '3', '2016-11-29 16:23:40'),
(128, 87, 'invoice_activity_added_attachment', '', '3', '2016-11-29 16:24:09'),
(129, 87, 'invoice_activity_added_attachment', '', '3', '2016-11-29 16:25:17'),
(130, 0, 'invoice_activity_added_attachment', '', '3', '2016-11-29 16:52:39'),
(131, 87, 'invoice_activity_created', '', '3', '2016-11-29 16:52:48'),
(132, 88, 'invoice_activity_added_attachment', '', '3', '2016-11-29 16:56:35'),
(133, 88, 'invoice_activity_created', '', '3', '2016-11-29 16:56:39'),
(134, 89, 'invoice_activity_added_attachment', '', '3', '2016-11-29 16:58:55'),
(135, 89, 'invoice_activity_created', '', '3', '2016-11-29 16:59:04'),
(136, 90, 'invoice_activity_added_attachment', '', '3', '2016-11-30 13:49:46'),
(137, 90, 'invoice_activity_created', '', '3', '2016-11-30 13:49:48'),
(138, 5, 'invoice_activity_status_updated', 'a:2:{i:0;s:36:"<original_status>1</original_status>";i:1;s:26:"<new_status>4</new_status>";}', '[CRON]', '2016-12-01 12:37:27'),
(139, 5, 'user_sent_overdue_reminder', 'a:2:{i:0;s:79:"<custom_data>elhaouari.ayman@gmail.com, s.sakhraoui@deepmaroc.com</custom_data>";i:1;s:6:"[CRON]";}', '[CRON]', '2016-12-01 12:37:32'),
(140, 9, 'invoice_activity_status_updated', 'a:2:{i:0;s:36:"<original_status>1</original_status>";i:1;s:26:"<new_status>4</new_status>";}', '[CRON]', '2016-12-01 12:37:32'),
(141, 9, 'user_sent_overdue_reminder', 'a:2:{i:0;s:79:"<custom_data>elhaouari.ayman@gmail.com, s.sakhraoui@deepmaroc.com</custom_data>";i:1;s:6:"[CRON]";}', '[CRON]', '2016-12-01 12:37:35'),
(142, 10, 'invoice_activity_status_updated', 'a:2:{i:0;s:36:"<original_status>1</original_status>";i:1;s:26:"<new_status>4</new_status>";}', '[CRON]', '2016-12-01 12:37:35'),
(143, 10, 'user_sent_overdue_reminder', 'a:2:{i:0;s:79:"<custom_data>elhaouari.ayman@gmail.com, s.sakhraoui@deepmaroc.com</custom_data>";i:1;s:6:"[CRON]";}', '[CRON]', '2016-12-01 12:37:39'),
(144, 91, 'invoice_activity_added_attachment', '', '3', '2016-12-05 12:49:35'),
(145, 91, 'invoice_activity_created', '', '3', '2016-12-05 12:49:37'),
(146, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 13:57:38'),
(147, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 15:15:18'),
(148, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 15:16:53'),
(149, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 15:20:55'),
(150, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 15:55:45'),
(151, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 15:57:43'),
(152, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 15:58:26'),
(153, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 15:59:08'),
(154, 9, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 16:02:01'),
(155, 9, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 16:08:29'),
(156, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 16:09:32'),
(157, 9, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 16:12:46'),
(158, 9, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 16:13:23'),
(159, 9, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 16:14:08'),
(160, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 16:27:07'),
(161, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:00:30'),
(162, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:06:07'),
(163, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:20:38'),
(164, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:21:55'),
(165, 9, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:24:01'),
(166, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:29:37'),
(167, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:32:31'),
(168, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:34:32'),
(169, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:38:42'),
(170, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:41:51'),
(171, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:43:03'),
(172, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:48:08'),
(173, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-07 17:48:54'),
(174, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-08 11:32:16'),
(175, 9, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-08 11:33:26'),
(176, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-08 13:12:29'),
(177, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-08 16:59:41'),
(178, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-08 17:00:03'),
(179, 11, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-08 17:01:20'),
(180, 10, 'invoice_activity_sent_to_client', 'a:1:{i:0;s:52:"<custom_data>elhaouari.ayman@gmail.com</custom_data>";}', '3', '2016-12-08 17:02:09'),
(181, 10, 'invoice_activity_status_updated', 'a:2:{i:0;s:36:"<original_status>4</original_status>";i:1;s:26:"<new_status>1</new_status>";}', '3', '2016-12-08 17:03:54'),
(182, 92, 'invoice_activity_created', '', '3', '2016-12-09 11:47:05');

-- --------------------------------------------------------

--
-- Structure de la table `tblinvoiceitems`
--

CREATE TABLE `tblinvoiceitems` (
  `id` int(11) NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `qty` decimal(11,2) NOT NULL,
  `description` mediumtext NOT NULL,
  `long_description` text,
  `rate` decimal(11,2) NOT NULL,
  `item_order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblinvoiceitems`
--

INSERT INTO `tblinvoiceitems` (`id`, `invoiceid`, `qty`, `description`, `long_description`, `rate`, `item_order`) VALUES
(1, 1, '1.00', 'integration Front end', 'njbkjkbjbjk', '2500.00', 1),
(2, 6, '68.08', 'Test', 'CRMmodification - 68.08 Heures', '0.00', 2),
(3, 6, '1.00', '[Expense] Digital', '', '13213.00', 1),
(4, 8, '1.00', 'Design Logo', 'Logotype charte graphique etude et montage', '3000.00', 1),
(5, 8, '1.00', 'integration Front end', 'njbkjkbjbjk', '2500.00', 2),
(6, 8, '1.00', 'Design Back Office', 'dededededwd', '3500.00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `tblinvoiceitemslist`
--

CREATE TABLE `tblinvoiceitemslist` (
  `id` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `long_description` text,
  `rate` decimal(11,2) NOT NULL,
  `tax` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblinvoiceitemslist`
--

INSERT INTO `tblinvoiceitemslist` (`id`, `description`, `long_description`, `rate`, `tax`) VALUES
(1, 'integration Front end', 'njbkjkbjbjk', '2500.00', 1),
(2, 'Design Back Office', 'dededededwd', '3500.00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tblinvoiceitemstaxes`
--

CREATE TABLE `tblinvoiceitemstaxes` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `taxrate` decimal(11,2) NOT NULL,
  `taxname` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblinvoiceitemstaxes`
--

INSERT INTO `tblinvoiceitemstaxes` (`id`, `itemid`, `invoice_id`, `taxrate`, `taxname`) VALUES
(1, 1, 1, '20.00', 'TVA'),
(2, 2, 6, '20.00', 'TVA'),
(3, 3, 6, '20.00', 'TVA'),
(4, 4, 8, '20.00', 'TVA'),
(5, 5, 8, '20.00', 'TVA'),
(6, 6, 8, '20.00', 'TVA');

-- --------------------------------------------------------

--
-- Structure de la table `tblinvoicepaymentrecords`
--

CREATE TABLE `tblinvoicepaymentrecords` (
  `id` int(11) NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `paymentmode` varchar(40) DEFAULT NULL,
  `date` date NOT NULL,
  `daterecorded` datetime NOT NULL,
  `note` text NOT NULL,
  `addedfrom` int(11) DEFAULT NULL,
  `transactionid` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblinvoicepaymentrecords`
--

INSERT INTO `tblinvoicepaymentrecords` (`id`, `invoiceid`, `amount`, `paymentmode`, `date`, `daterecorded`, `note`, `addedfrom`, `transactionid`) VALUES
(1, 1, '3000.00', '1', '2016-09-06', '2016-09-06 17:54:09', '', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblinvoicepaymentsmodes`
--

CREATE TABLE `tblinvoicepaymentsmodes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblinvoicepaymentsmodes`
--

INSERT INTO `tblinvoicepaymentsmodes` (`id`, `name`, `description`, `active`) VALUES
(1, 'Bank', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tblinvoices`
--

CREATE TABLE `tblinvoices` (
  `id` int(11) NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `datesend` datetime DEFAULT NULL,
  `clientid` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `date` date NOT NULL,
  `duedate` date DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `total_tax` decimal(11,2) NOT NULL DEFAULT '0.00',
  `total` decimal(11,2) NOT NULL,
  `adjustment` decimal(11,2) DEFAULT NULL,
  `addedfrom` int(11) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `status` int(11) DEFAULT '1',
  `clientnote` text,
  `adminnote` text,
  `last_overdue_reminder` date DEFAULT NULL,
  `allowed_payment_modes` mediumtext,
  `token` mediumtext,
  `discount_percent` decimal(11,2) DEFAULT '0.00',
  `discount_total` decimal(11,2) DEFAULT '0.00',
  `discount_type` varchar(30) NOT NULL,
  `recurring` int(11) NOT NULL DEFAULT '0',
  `recurring_ends_on` date DEFAULT NULL,
  `is_recurring_from` int(11) DEFAULT NULL,
  `last_recurring_date` date DEFAULT NULL,
  `terms` text,
  `sale_agent` int(11) NOT NULL DEFAULT '0',
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `show_shipping_on_invoice` tinyint(1) NOT NULL DEFAULT '1',
  `show_quantity_as` int(11) NOT NULL DEFAULT '1',
  `project_id` int(11) DEFAULT '0',
  `suppliernote` varchar(150) DEFAULT NULL,
  `subject` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblinvoices`
--

INSERT INTO `tblinvoices` (`id`, `sent`, `datesend`, `clientid`, `supplierid`, `number`, `year`, `datecreated`, `date`, `duedate`, `currency`, `subtotal`, `total_tax`, `total`, `adjustment`, `addedfrom`, `hash`, `status`, `clientnote`, `adminnote`, `last_overdue_reminder`, `allowed_payment_modes`, `token`, `discount_percent`, `discount_total`, `discount_type`, `recurring`, `recurring_ends_on`, `is_recurring_from`, `last_recurring_date`, `terms`, `sale_agent`, `billing_street`, `billing_city`, `billing_state`, `billing_zip`, `billing_country`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `include_shipping`, `show_shipping_on_invoice`, `show_quantity_as`, `project_id`, `suppliernote`, `subject`) VALUES
(1, 0, NULL, 2, 0, 144, 2016, '2016-09-06 17:53:26', '2016-09-06', '2016-10-06', 3, '2500.00', '500.00', '3000.00', '0.00', 2, 'aff0e76c493ec5b99dcd556e8c7c9930', 2, '', '', NULL, 'a:3:{i:0;s:1:"1";i:1;s:6:"paypal";i:2;s:6:"stripe";}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, '', '', '', '', 149, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 2, NULL, ''),
(52, 0, NULL, 0, 3, 185, 2016, '2016-11-29 11:34:26', '2016-11-29', '2016-12-29', 0, '1235.00', '0.00', '213556.00', NULL, 3, 'f569487e4c47216c6ffb02b658427f97', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(53, 0, NULL, 0, 2, 186, 2016, '2016-11-29 11:48:04', '2016-11-29', '2016-12-29', 0, '135.00', '0.00', '354.00', NULL, 3, 'fa1fc950dcd4551f3c7469183370a2e1', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(5, 0, NULL, 3, 0, 145, 2016, '2016-10-24 12:46:03', '2016-10-24', '2016-11-23', 3, '0.00', '0.00', '0.00', '0.00', 6, '04a4d80a0a657fef8a6891c4dadd3143', 4, '', '', '2016-12-01', 'a:3:{i:0;s:1:"1";i:1;s:6:"paypal";i:2;s:6:"stripe";}', NULL, '0.00', '0.00', '', 3, NULL, NULL, NULL, '', 6, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 5, NULL, ''),
(69, 0, NULL, 0, 3, 202, 2016, '2016-11-29 13:07:50', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '0.00', NULL, 3, 'c82cbdd3f211bb934b2210a57991a686', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(54, 0, NULL, 0, 4, 187, 2016, '2016-11-29 11:51:26', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '0.00', NULL, 3, '62d7b6dddf8fb84fa5d818e9c7dd9f0c', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(55, 0, NULL, 0, 3, 188, 2016, '2016-11-29 12:11:11', '2016-11-29', '2016-12-29', 0, '12354.00', '0.00', '1513.00', NULL, 3, '945d680a96b47b8b164a25b0c9c29649', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(9, 1, '2016-12-08 11:33:26', 3, 0, 149, 2016, '2016-10-26 18:08:34', '2016-10-26', '2016-11-25', 3, '0.00', '0.00', '0.00', '0.00', 6, '3ed5e70bc6c77360ca7429366555a75d', 4, '', '', '2016-12-01', 'a:3:{i:0;s:1:"1";i:1;s:6:"paypal";i:2;s:6:"stripe";}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 6, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, NULL, ''),
(10, 1, '2016-12-08 17:02:09', 3, 0, 150, 2016, '2016-10-26 18:26:16', '2016-10-26', '2016-12-30', 3, '0.00', '0.00', '0.00', '0.00', 6, '42226b115a8ff18127bb67aac090fe59', 1, '', '', '2016-12-01', 'a:3:{i:0;s:1:"1";i:1;s:6:"paypal";i:2;s:6:"stripe";}', NULL, '0.00', '0.00', '', 6, '2016-12-23', NULL, NULL, '', 6, '', '', '', '', 0, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 5, NULL, ''),
(11, 1, '2016-12-08 17:01:20', 3, 0, 151, 2016, '2016-11-16 15:37:57', '2016-11-16', '2016-12-16', 3, '0.00', '0.00', '0.00', '0.00', 3, '3a0c94fa8e9da0a218b237524c310206', 1, '', '', NULL, 'a:3:{i:0;s:1:"1";i:1;s:6:"paypal";i:2;s:6:"stripe";}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 5, NULL, ''),
(49, 0, NULL, 0, 3, 182, 2016, '2016-11-29 11:06:57', '2016-11-29', '2016-12-29', 0, '123.00', '120.00', '1250.00', NULL, 3, '86a6830aec889737b61ef94b33642c1c', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(50, 0, NULL, 0, 3, 183, 2016, '2016-11-29 11:07:50', '2016-11-29', '2016-12-29', 0, '1231.00', '0.00', '1324564.00', NULL, 3, '5d39211357e030cdc946e34a0fb83b87', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(51, 0, NULL, 0, 3, 184, 2016, '2016-11-29 11:20:22', '2016-11-29', '2016-12-29', 0, '1234.00', '0.00', '1294.00', NULL, 3, '6177319119bf3eedb417d501e6f223de', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(18, 0, NULL, 0, 3, 157, 2016, '2016-11-24 16:23:44', '2016-11-24', '2016-12-24', 0, '232134.00', '0.00', '1135468.00', NULL, 3, '724b330a01d246a34b6159c9c82e3f57', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'adzfaefzez', ''),
(67, 0, NULL, 0, 2, 200, 2016, '2016-11-29 12:59:47', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '0.00', NULL, 3, '94ea28835bada38b53620145d2f2592e', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(20, 0, NULL, 0, 3, 159, 2016, '2016-11-24 16:30:53', '2016-11-24', '2016-12-24', 0, '142342.00', '0.00', '1354646.00', NULL, 3, '8ea0e16b8180e8df4688796d29026fe2', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'dqdkjnkqjdvqhlvhqvnhq', ''),
(68, 0, NULL, 0, 3, 201, 2016, '2016-11-29 13:05:59', '2016-11-29', '2016-12-29', 0, '142.00', '0.00', '422.00', NULL, 3, 'c418e9cad196884198c5dfc362c63c4d', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(64, 0, NULL, 0, 3, 197, 2016, '2016-11-29 12:55:04', '2016-11-29', '2016-12-29', 0, '1456.00', '0.00', '12345.00', NULL, 3, '170317d749f8222956f206da7812ec19', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(65, 0, NULL, 0, 3, 198, 2016, '2016-11-29 12:57:28', '2016-11-29', '2016-12-29', 0, '15.00', '0.00', '1354.00', NULL, 3, 'adc4ffe68deeac4c25edfb77d9e6a83a', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(61, 0, NULL, 0, 2, 194, 2016, '2016-11-29 12:29:45', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '1354.00', NULL, 3, '4a6a33cc98b63ea56c9ace6246a4e141', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(25, 0, NULL, 0, 3, 164, 2016, '2016-11-24 16:56:35', '2016-11-24', '2016-12-24', 0, '132453.00', '0.00', '13546576.00', NULL, 3, '80f1481da8870ab57869ae1680c589a9', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'sdh:lknqwhsdkj;:', ''),
(63, 0, NULL, 0, 3, 196, 2016, '2016-11-29 12:41:28', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '1425683.00', NULL, 3, 'bd7b46eb09e5e527e72d5647d04b0fa0', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(28, 0, NULL, 0, 3, 167, 2016, '2016-11-24 17:38:04', '2016-11-24', '2016-12-24', 0, '12354.00', '0.00', '1354657.00', NULL, 3, '049f451c0293b1b9f97207d7b998efbd', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'qdfqiuoybqundiouyncfqoiuzefnz', ''),
(29, 0, NULL, 0, 3, 168, 2016, '2016-11-24 17:42:02', '2016-11-24', '2016-12-24', 0, '1234.00', '0.00', '3215646.00', NULL, 3, '8a5a266e9d92dc0a3c3a19d4d0822b61', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'dsùmfk,sdfgjsdfg', ''),
(62, 0, NULL, 0, 4, 195, 2016, '2016-11-29 12:40:16', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '1425.00', NULL, 3, 'bc6ca2b35882fb7854c3a4e92305fb79', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(31, 0, NULL, 0, 3, 170, 2016, '2016-11-24 17:48:43', '2016-11-24', '2016-12-24', 0, '1425.00', '0.00', '142367.00', NULL, 3, 'aba85064649a95982314325a631d2c9d', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'yhfhdrtyuhehr', ''),
(32, 0, NULL, 0, 3, 171, 2016, '2016-11-24 17:51:14', '2016-11-24', '2016-12-24', 0, '132.00', '0.00', '1354.00', NULL, 3, '27332c17f4c73cbd13d29e383c40c9e3', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'lkndhmqshfjq', ''),
(33, 0, NULL, 0, 4, 172, 2016, '2016-11-24 17:53:00', '2016-11-24', '2016-12-24', 0, '132.00', '0.00', '654687.00', NULL, 3, 'ce339a676d343f6d2793dcc435a2294e', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'ergzrfcqzecr', ''),
(60, 0, NULL, 0, 3, 193, 2016, '2016-11-29 12:27:54', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '1354.00', NULL, 3, '910fe151e554fe1a3ad491a6e5bb5eee', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(59, 0, NULL, 0, 3, 192, 2016, '2016-11-29 12:20:52', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '14256.00', NULL, 3, 'e494a01940a05533682b8f1a54dc158a', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(58, 0, NULL, 0, 4, 191, 2016, '2016-11-29 12:19:11', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '1425.00', NULL, 3, 'f9e9930fdba0103f90234ca756b28512', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(57, 0, NULL, 0, 2, 190, 2016, '2016-11-29 12:14:18', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '142.00', NULL, 3, '8e5f2f8a5f76babb54c870bf33fa2949', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(39, 0, NULL, 0, 3, 178, 2016, '2016-11-24 18:06:47', '2016-11-24', '2016-12-24', 0, '32.00', '0.00', '369.00', NULL, 3, 'b9ef90f46766327af4b08ae8101b1cb8', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(66, 0, NULL, 0, 4, 199, 2016, '2016-11-29 12:58:55', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '0.00', NULL, 3, 'd19dc4a05ace2bbb5a386a808fa64096', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(56, 0, NULL, 0, 3, 189, 2016, '2016-11-29 12:13:14', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '14254.00', NULL, 3, 'bea4a73502fdeeed6510c4582d6d61c8', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(43, 0, NULL, 0, 0, 182, 2016, '2016-11-24 18:10:06', '2016-11-24', '2016-12-24', 0, '0.00', '0.00', '0.00', NULL, 3, '68c738776b657eccd87f645d0ccb4b85', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(44, 0, NULL, 0, 0, 183, 2016, '2016-11-24 18:11:01', '2016-11-24', '2016-12-24', 0, '625.00', '0.00', '62561.00', NULL, 3, '63f98694d43bfbcdaff5b3f6ef899138', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'shsdfh', ''),
(45, 0, NULL, 0, 3, 184, 2016, '2016-11-24 18:24:42', '2016-11-24', '2016-12-24', 0, '0.00', '0.00', '0.00', NULL, 3, 'e7f794ae4e1fd667c116f4d4fc9e6af8', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(46, 0, NULL, 0, 0, 185, 2016, '2016-11-24 18:26:59', '2016-11-24', '2016-12-24', 0, '0.00', '0.00', '0.00', NULL, 3, '1aa6cbdba57d4f437939c172a9ae174c', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(47, 0, NULL, 0, 0, 186, 2016, '2016-11-24 18:27:44', '2016-11-24', '2016-12-24', 0, '3652.00', '0.00', '6256.00', NULL, 3, '827fcffb2deaa6f50fc98245e0d191da', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'xvgndxfgs', ''),
(48, 0, NULL, 0, 3, 187, 2016, '2016-11-24 18:28:50', '2016-11-24', '2016-12-24', 0, '36.00', '0.00', '8926.00', NULL, 3, '3838e29c26537f0fbf1e84648fe87db4', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'rtshrthtrh', ''),
(70, 0, NULL, 0, 3, 203, 2016, '2016-11-29 13:08:28', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '0.00', NULL, 3, '2103c85c8751039d4578b0072d23ce13', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(71, 0, NULL, 0, 2, 204, 2016, '2016-11-29 13:21:12', '2016-11-29', '2016-12-29', 0, '13254.00', '0.00', '3123454.00', NULL, 3, '32f1d6f86b1d3937a98b496f191fe1bd', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(72, 0, NULL, 0, 2, 205, 2016, '2016-11-29 13:23:05', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '1425.00', NULL, 3, '4bb6f24aba15593fcb4d0a69bc1b7a5c', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(73, 0, NULL, 0, 2, 206, 2016, '2016-11-29 13:24:05', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '0.00', NULL, 3, '948d9ddf6767face901a39d0f5b12b7a', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(74, 0, NULL, 0, 0, 207, 2016, '2016-11-29 13:30:47', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '63.00', NULL, 3, '1b8ac4d74bdb67cc30c87059d429a6ab', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(75, 0, NULL, 0, 4, 208, 2016, '2016-11-29 13:34:30', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '4252.00', NULL, 3, 'cd12be9e2608f6d36bfc3eccbc413587', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(76, 0, NULL, 0, 2, 209, 2016, '2016-11-29 15:34:56', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '2145243.00', NULL, 3, '77a154a7299dbb443456a426ec6a83cc', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(77, 0, NULL, 0, 3, 210, 2016, '2016-11-29 15:38:03', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '1425.00', NULL, 3, '0fddd847ca5b1b257f23d0a01bb7a657', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(78, 0, NULL, 0, 3, 211, 2016, '2016-11-29 15:39:31', '2016-11-29', '2016-12-29', 0, '0.00', '0.00', '1425.00', NULL, 3, '1b2830e86d95a652f5dd466d69882173', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(90, 0, NULL, 0, 3, 223, 2016, '2016-11-30 13:49:48', '2016-11-30', '2016-12-31', 0, '123.00', '0.00', '6547.00', NULL, 3, 'ccdddec32454ef0b17974d7b31860080', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'decription<br />\r\ndecription<br />\r\ndecription<br />\r\ndecriptiondecriptiondecriptiondecriptiondecriptiondecriptiondecriptiondecriptiondecriptiondecrip', ''),
(89, 0, NULL, 0, 4, 222, 2016, '2016-11-29 16:59:03', '2016-11-29', '2016-12-29', 0, '1231.00', '0.00', '134564.00', NULL, 3, '9fae52ca48c1ad01e1ea8f0c0c4ed113', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(88, 0, NULL, 0, 4, 221, 2016, '2016-11-29 16:56:38', '2016-11-29', '2016-12-29', 0, '134.00', '0.00', '6457.00', NULL, 3, 'dd1545a2c96df1c5a5ed4f7e88f69e1e', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '', ''),
(91, 0, NULL, 0, 4, 224, 2016, '2016-12-05 12:49:37', '2016-12-05', '2017-01-04', 0, '1234.00', '0.00', '13426.00', NULL, 3, 'b15ec72a5399e6a563725cefeaaeafbf', 1, NULL, '', NULL, 'a:0:{}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 'second test on server subject DESCRIPTION\r\nUPDATE NOW ', ''),
(92, 0, NULL, 3, 0, 225, 2016, '2016-12-09 11:47:05', '2016-12-09', '2017-01-08', 3, '0.00', '0.00', '0.00', '0.00', 3, '7696a46ca49269f62b76d6e16c684972', 1, '', '', NULL, 'a:3:{i:0;s:1:"1";i:1;s:6:"paypal";i:2;s:6:"stripe";}', NULL, '0.00', '0.00', '', 0, NULL, NULL, NULL, '', 3, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 6, NULL, '');

--
-- Déclencheurs `tblinvoices`
--
DELIMITER $$
CREATE TRIGGER `total_taxes` BEFORE INSERT ON `tblinvoices` FOR EACH ROW BEGIN
IF NEW.subtotal IS NOT NULL 
AND NEW.total IS NOT NULL
THEN SET NEW.total_tax := NEW.total - NEW.subtotal;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `tblitemsrelated`
--

CREATE TABLE `tblitemsrelated` (
  `id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(30) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblitemsrelated`
--

INSERT INTO `tblitemsrelated` (`id`, `rel_id`, `rel_type`, `item_id`) VALUES
(1, 5, 'task', 2),
(2, 1, 'expense', 3);

-- --------------------------------------------------------

--
-- Structure de la table `tblknowledgebase`
--

CREATE TABLE `tblknowledgebase` (
  `articleid` int(11) NOT NULL,
  `articlegroup` int(11) NOT NULL,
  `subject` mediumtext NOT NULL,
  `description` text NOT NULL,
  `slug` mediumtext NOT NULL,
  `createdby` int(11) NOT NULL,
  `lasteditedby` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `datecreated` datetime NOT NULL,
  `article_order` int(11) NOT NULL DEFAULT '0',
  `views` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblknowledgebasearticleanswers`
--

CREATE TABLE `tblknowledgebasearticleanswers` (
  `articleanswerid` int(11) NOT NULL,
  `articleid` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblknowledgebasegroups`
--

CREATE TABLE `tblknowledgebasegroups` (
  `groupid` int(11) NOT NULL,
  `name` mediumtext NOT NULL,
  `description` mediumtext,
  `active` tinyint(4) NOT NULL,
  `color` varchar(10) DEFAULT '#28B8DA',
  `group_order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbllanguage`
--

CREATE TABLE `tbllanguage` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbllanguage`
--

INSERT INTO `tbllanguage` (`id`, `label`, `image`) VALUES
(1, 'french', 'france.png'),
(2, 'english', 'uk.png');

-- --------------------------------------------------------

--
-- Structure de la table `tblleadactivitylog`
--

CREATE TABLE `tblleadactivitylog` (
  `id` int(11) NOT NULL,
  `leadid` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `additional_data` varchar(600) DEFAULT NULL,
  `date` datetime NOT NULL,
  `staffid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblleadattachments`
--

CREATE TABLE `tblleadattachments` (
  `id` int(11) NOT NULL,
  `leadid` int(11) NOT NULL,
  `file_name` mediumtext NOT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblleads`
--

CREATE TABLE `tblleads` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `company` varchar(300) DEFAULT NULL,
  `assigned` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `lastcontact` datetime DEFAULT NULL,
  `dateassigned` date DEFAULT NULL,
  `last_status_change` datetime DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `leadorder` int(11) DEFAULT '1',
  `phonenumber` varchar(50) DEFAULT NULL,
  `date_converted` datetime DEFAULT NULL,
  `lost` tinyint(1) NOT NULL DEFAULT '0',
  `junk` int(11) NOT NULL DEFAULT '0',
  `is_imported_from_email_integration` tinyint(1) NOT NULL DEFAULT '0',
  `email_integration_uid` varchar(30) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `supplierid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblleadsemailintegration`
--

CREATE TABLE `tblleadsemailintegration` (
  `id` int(11) NOT NULL COMMENT 'the ID always must be 1',
  `active` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `imap_server` varchar(100) NOT NULL,
  `password` mediumtext NOT NULL,
  `check_every` int(11) NOT NULL DEFAULT '5',
  `responsible` int(11) NOT NULL,
  `lead_source` int(11) NOT NULL,
  `lead_status` int(11) NOT NULL,
  `encryption` varchar(3) DEFAULT NULL,
  `folder` varchar(100) NOT NULL,
  `last_run` varchar(50) DEFAULT NULL,
  `notify_lead_imported` tinyint(1) NOT NULL DEFAULT '1',
  `notify_lead_contact_more_times` tinyint(1) NOT NULL DEFAULT '1',
  `notify_type` varchar(20) DEFAULT NULL,
  `notify_ids` mediumtext,
  `only_loop_on_unseen_emails` tinyint(1) NOT NULL DEFAULT '1',
  `delete_after_import` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblleadsemailintegration`
--

INSERT INTO `tblleadsemailintegration` (`id`, `active`, `email`, `imap_server`, `password`, `check_every`, `responsible`, `lead_source`, `lead_status`, `encryption`, `folder`, `last_run`, `notify_lead_imported`, `notify_lead_contact_more_times`, `notify_type`, `notify_ids`, `only_loop_on_unseen_emails`, `delete_after_import`) VALUES
(1, 0, '', '', '', 10, 0, 0, 0, 'tls', 'inbox', '', 1, 1, 'roles', '', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblleadsemailintegrationemails`
--

CREATE TABLE `tblleadsemailintegrationemails` (
  `id` int(11) NOT NULL,
  `subject` mediumtext,
  `body` mediumtext,
  `dateadded` datetime NOT NULL,
  `leadid` int(11) NOT NULL,
  `emailid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblleadssources`
--

CREATE TABLE `tblleadssources` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblleadssources`
--

INSERT INTO `tblleadssources` (`id`, `name`) VALUES
(1, 'Google'),
(2, 'Facebook');

-- --------------------------------------------------------

--
-- Structure de la table `tblleadsstatus`
--

CREATE TABLE `tblleadsstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `statusorder` int(11) DEFAULT NULL,
  `color` varchar(10) DEFAULT '#28B8DA',
  `isdefault` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblleadsstatus`
--

INSERT INTO `tblleadsstatus` (`id`, `name`, `statusorder`, `color`, `isdefault`) VALUES
(1, 'Client', 1000, '#0288d1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbllistemails`
--

CREATE TABLE `tbllistemails` (
  `emailid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblmaillistscustomfields`
--

CREATE TABLE `tblmaillistscustomfields` (
  `customfieldid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `fieldname` varchar(150) NOT NULL,
  `fieldslug` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblmaillistscustomfieldvalues`
--

CREATE TABLE `tblmaillistscustomfieldvalues` (
  `customfieldvalueid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `customfieldid` int(11) NOT NULL,
  `emailid` int(11) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblmigrations`
--

CREATE TABLE `tblmigrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblmigrations`
--

INSERT INTO `tblmigrations` (`version`) VALUES
(121);

-- --------------------------------------------------------

--
-- Structure de la table `tblmilestones`
--

CREATE TABLE `tblmilestones` (
  `id` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `due_date` date NOT NULL,
  `project_id` int(11) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `milestone_order` int(11) NOT NULL DEFAULT '0',
  `datecreated` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblmilestones`
--

INSERT INTO `tblmilestones` (`id`, `name`, `due_date`, `project_id`, `color`, `milestone_order`, `datecreated`) VALUES
(1, 'etape 1', '2016-09-26', 4, NULL, 5, '2016-10-25');

-- --------------------------------------------------------

--
-- Structure de la table `tblnotes`
--

CREATE TABLE `tblnotes` (
  `id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) NOT NULL,
  `description` text,
  `addedfrom` int(11) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblnotes`
--

INSERT INTO `tblnotes` (`id`, `rel_id`, `rel_type`, `description`, `addedfrom`, `dateadded`) VALUES
(1, 2, 'staff', 'Aenean convallis felis magna, vitae auctor tortor ultrices eget. Morbi et tellus odio viverra fusce.<br />\r\n', 2, '2016-09-14 12:32:34'),
(2, 23, 'ticket', 'note ', 6, '2016-10-25 17:31:47');

-- --------------------------------------------------------

--
-- Structure de la table `tblnotifications`
--

CREATE TABLE `tblnotifications` (
  `id` int(11) NOT NULL,
  `isread` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `description` text NOT NULL,
  `fromuserid` int(11) NOT NULL,
  `fromclientid` int(11) NOT NULL DEFAULT '0',
  `touserid` int(11) NOT NULL,
  `fromcompany` int(11) DEFAULT NULL,
  `link` mediumtext,
  `additional_data` varchar(600) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblnotifications`
--

INSERT INTO `tblnotifications` (`id`, `isread`, `date`, `description`, `fromuserid`, `fromclientid`, `touserid`, `fromcompany`, `link`, `additional_data`) VALUES
(1, 1, '2016-09-05 00:04:27', 'not_task_added_you_as_follower', 1, 0, 2, NULL, 'tasks/list_tasks/1', 'a:1:{i:0;s:23:"enregistrement voix Off";}'),
(2, 1, '2016-09-05 00:05:57', 'not_task_added_you_as_follower', 1, 0, 2, NULL, 'tasks/list_tasks/2', 'a:1:{i:0;s:9:"post prod";}'),
(3, 1, '2016-09-05 00:06:07', 'not_task_will_do_user', 1, 0, 2, NULL, 'tasks/list_tasks/2', 'a:1:{i:0;s:9:"post prod";}'),
(4, 1, '2016-09-05 00:07:01', 'not_task_new_attachment', 1, 0, 2, NULL, 'tasks/list_tasks/2', ''),
(5, 1, '2016-09-05 00:07:27', 'a marquÃ© la tÃ¢che comme accomplie post prod', 1, 0, 2, NULL, 'tasks/list_tasks/2', ''),
(6, 1, '2016-09-05 11:15:31', 'a marquÃ© la tÃ¢che comme accomplie enregistrement voix Off', 2, 0, 1, NULL, 'tasks/list_tasks/1', ''),
(7, 1, '2016-09-06 15:45:05', 'not_staff_added_as_project_member', 2, 0, 1, NULL, 'projects/view/2', 'a:1:{i:0;s:23:"Personnalisation du CRM";}'),
(8, 1, '2016-09-06 16:19:35', 'not_task_added_you_as_follower', 3, 0, 2, NULL, 'tasks/list_tasks/4', 'a:1:{i:0;s:35:"Ajout dâ€™image slider home screen ";}'),
(9, 1, '2016-09-06 16:20:40', 'not_task_assigned_to_you', 3, 0, 2, NULL, 'tasks/list_tasks/4', NULL),
(10, 1, '2016-09-08 00:02:01', 'not_event', 0, 0, 2, 1, NULL, 'a:1:{i:0;s:10:"tygjighjkg";}'),
(11, 1, '2016-09-14 17:19:23', 'not_project_file_uploaded', 2, 0, 1, NULL, 'projects/view/2?group=project_files', NULL),
(12, 0, '2016-10-04 15:36:58', 'not_liked_your_post', 3, 0, 2, NULL, NULL, 'a:2:{i:0;s:13:"Ikram  naffah";i:1;s:50:"http://themarklee.com/2013/10/16/simple-crossfadin";}'),
(13, 1, '2016-10-20 16:10:17', 'not_estimate_customer_declined', 0, 6, 3, 1, 'estimates/list_estimates/2', 'a:1:{i:0;s:13:"D-2016/000145";}'),
(14, 0, '2016-10-21 17:27:48', 'not_proposal_assigned_to_you', 3, 0, 1, NULL, 'proposals/list_proposals/1', 'a:1:{i:0;s:11:"proposition";}'),
(15, 0, '2016-10-21 17:29:19', 'not_ticket_assigned_to_you', 0, 0, 1, 1, 'tickets/ticket/22', 'a:1:{i:0;s:5:"12365";}'),
(16, 0, '2016-10-21 17:51:39', 'not_proposal_proposal_accepted', 0, 6, 1, 1, 'proposals/list_proposals/1', NULL),
(17, 1, '2016-10-21 17:51:39', 'not_proposal_proposal_accepted', 0, 6, 3, 1, 'proposals/list_proposals/1', NULL),
(18, 0, '2016-10-24 11:23:49', 'not_staff_added_as_project_member', 3, 0, 1, NULL, 'projects/view/5', 'a:1:{i:0;s:7:"projet1";}'),
(19, 1, '2016-10-25 13:30:23', 'not_staff_added_as_project_member', 6, 0, 3, NULL, 'projects/view/4', 'a:1:{i:0;s:4:"Test";}'),
(20, 0, '2016-10-25 13:30:23', 'not_staff_added_as_project_member', 6, 0, 2, NULL, 'projects/view/4', 'a:1:{i:0;s:4:"Test";}'),
(21, 1, '2016-10-25 15:48:00', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(22, 0, '2016-10-25 15:48:00', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(23, 1, '2016-10-25 15:51:24', 'not_project_file_uploaded', 0, 6, 6, NULL, 'projects/view/4?group=project_files', NULL),
(24, 1, '2016-10-25 15:51:24', 'not_project_file_uploaded', 0, 6, 3, NULL, 'projects/view/4?group=project_files', NULL),
(25, 0, '2016-10-25 15:51:24', 'not_project_file_uploaded', 0, 6, 2, NULL, 'projects/view/4?group=project_files', NULL),
(26, 1, '2016-10-25 15:53:14', 'not_project_file_uploaded', 0, 6, 6, NULL, 'projects/view/4?group=project_files', NULL),
(27, 1, '2016-10-25 15:53:14', 'not_project_file_uploaded', 0, 6, 3, NULL, 'projects/view/4?group=project_files', NULL),
(28, 0, '2016-10-25 15:53:14', 'not_project_file_uploaded', 0, 6, 2, NULL, 'projects/view/4?group=project_files', NULL),
(29, 1, '2016-10-25 16:33:46', 'not_commented_on_project_discussion', 6, 0, 3, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(30, 0, '2016-10-25 16:33:46', 'not_commented_on_project_discussion', 6, 0, 2, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(31, 1, '2016-10-25 17:00:53', 'not_task_new_comment', 0, 6, 6, NULL, 'tasks/list_tasks/5', 'a:1:{i:0;s:15:"CRMmodification";}'),
(32, 1, '2016-10-25 17:39:35', 'not_commented_on_project_discussion', 0, 6, 6, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(33, 1, '2016-10-25 17:39:35', 'not_commented_on_project_discussion', 0, 6, 3, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(34, 0, '2016-10-25 17:39:35', 'not_commented_on_project_discussion', 0, 6, 2, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(35, 1, '2016-10-25 17:43:19', 'not_commented_on_project_discussion', 6, 0, 3, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(36, 0, '2016-10-25 17:43:19', 'not_commented_on_project_discussion', 6, 0, 2, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(37, 1, '2016-10-25 17:59:00', 'not_commented_on_project_discussion', 6, 0, 3, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(38, 0, '2016-10-25 17:59:00', 'not_commented_on_project_discussion', 6, 0, 2, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(39, 1, '2016-10-26 17:34:39', 'not_project_file_uploaded', 0, 6, 6, NULL, 'projects/view/4?group=project_files', NULL),
(40, 1, '2016-10-26 17:34:39', 'not_project_file_uploaded', 0, 6, 3, NULL, 'projects/view/4?group=project_files', NULL),
(41, 0, '2016-10-26 17:34:39', 'not_project_file_uploaded', 0, 6, 2, NULL, 'projects/view/4?group=project_files', NULL),
(42, 1, '2016-10-26 18:26:18', 'not_estimate_customer_accepted', 0, 6, 6, 1, 'estimates/list_estimates/4', 'a:1:{i:0;s:13:"D-2016/000147";}'),
(43, 1, '2016-10-27 13:18:48', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(44, 0, '2016-10-27 13:18:48', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(45, 1, '2016-10-27 13:19:36', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(46, 0, '2016-10-27 13:19:36', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(47, 1, '2016-10-27 13:21:08', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(48, 0, '2016-10-27 13:21:08', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(49, 1, '2016-10-27 13:22:44', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(50, 0, '2016-10-27 13:22:44', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(51, 1, '2016-10-27 13:25:00', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(52, 0, '2016-10-27 13:25:00', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(53, 1, '2016-10-27 13:29:10', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(54, 0, '2016-10-27 13:29:10', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(55, 1, '2016-10-27 13:38:04', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(56, 0, '2016-10-27 13:38:04', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(57, 1, '2016-10-27 13:38:26', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(58, 0, '2016-10-27 13:38:26', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(59, 1, '2016-10-27 13:39:08', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(60, 0, '2016-10-27 13:39:08', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(61, 1, '2016-10-27 13:41:56', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(62, 0, '2016-10-27 13:41:56', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(63, 1, '2016-10-27 13:42:58', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(64, 0, '2016-10-27 13:42:58', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(65, 1, '2016-10-27 15:52:05', 'not_commented_on_project_discussion', 6, 0, 3, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(66, 0, '2016-10-27 15:52:05', 'not_commented_on_project_discussion', 6, 0, 2, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(67, 1, '2016-10-27 15:54:23', 'not_commented_on_project_discussion', 6, 0, 3, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(68, 0, '2016-10-27 15:54:23', 'not_commented_on_project_discussion', 6, 0, 2, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(69, 1, '2016-10-27 17:10:09', 'not_project_file_uploaded', 3, 0, 6, NULL, 'projects/view/4?group=project_files', NULL),
(70, 0, '2016-10-27 17:10:09', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(71, 1, '2016-10-27 17:40:24', 'not_project_file_uploaded', 3, 0, 6, NULL, 'projects/view/4?group=project_files', NULL),
(72, 0, '2016-10-27 17:40:24', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(73, 1, '2016-10-27 17:40:40', 'not_project_file_uploaded', 3, 0, 6, NULL, 'projects/view/4?group=project_files', NULL),
(74, 0, '2016-10-27 17:40:40', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(75, 1, '2016-10-27 17:41:44', 'not_project_file_uploaded', 3, 0, 6, NULL, 'projects/view/4?group=project_files', NULL),
(76, 0, '2016-10-27 17:41:44', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(77, 1, '2016-10-27 17:42:47', 'not_project_file_uploaded', 3, 0, 6, NULL, 'projects/view/4?group=project_files', NULL),
(78, 0, '2016-10-27 17:42:47', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(79, 1, '2016-10-27 17:43:51', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(80, 0, '2016-10-27 17:43:51', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(81, 1, '2016-10-27 17:45:13', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(82, 0, '2016-10-27 17:45:13', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(83, 1, '2016-10-27 17:46:23', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(84, 0, '2016-10-27 17:46:23', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(85, 1, '2016-10-27 17:47:29', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(86, 0, '2016-10-27 17:47:29', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(87, 1, '2016-10-27 18:15:45', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(88, 0, '2016-10-27 18:15:45', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(89, 1, '2016-10-27 18:16:19', 'not_project_file_uploaded', 6, 0, 3, NULL, 'projects/view/4?group=project_files', NULL),
(90, 0, '2016-10-27 18:16:19', 'not_project_file_uploaded', 6, 0, 2, NULL, 'projects/view/4?group=project_files', NULL),
(91, 1, '2016-10-27 18:17:29', 'not_commented_on_project_discussion', 6, 0, 3, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(92, 0, '2016-10-27 18:17:29', 'not_commented_on_project_discussion', 6, 0, 2, NULL, 'projects/view/4?group=project_discussions&discussion_id=2', NULL),
(93, 0, '2016-11-21 11:31:32', 'not_staff_added_as_project_member', 3, 0, 6, NULL, 'projects/view/7', 'a:1:{i:0;s:2:"13";}'),
(94, 0, '2016-11-21 11:35:28', 'not_staff_added_as_project_member', 3, 0, 2, NULL, 'projects/view/8', 'a:1:{i:0;s:2:"13";}'),
(95, 0, '2016-11-22 11:23:09', 'not_staff_added_as_project_member', 3, 0, 6, NULL, 'projects/view/6', 'a:1:{i:0;s:20:"project_for_estimate";}'),
(96, 1, '2016-12-01 12:37:09', 'not_new_reminder_for', 0, 0, 3, 1, NULL, 'a:1:{i:0;s:3:" - ";}'),
(97, 1, '2016-12-01 12:37:19', 'not_new_reminder_for', 0, 0, 3, 1, NULL, 'a:1:{i:0;s:3:" - ";}'),
(98, 1, '2016-12-01 12:37:20', 'not_new_reminder_for', 0, 0, 3, 1, 'clients/client/3', 'a:1:{i:0;s:9:"client - ";}'),
(99, 0, '2016-12-05 12:53:19', 'not_staff_added_as_project_member', 3, 0, 6, NULL, 'projects/view/9', 'a:1:{i:0;s:22:"TEST ON SERVER PROJECT";}'),
(100, 0, '2016-12-06 10:53:42', 'not_project_file_uploaded', 3, 0, 6, NULL, 'projects/view/6?group=project_files', NULL),
(101, 0, '2016-12-06 10:54:13', 'not_project_file_uploaded', 3, 0, 6, NULL, 'projects/view/9?group=project_files', NULL),
(102, 0, '2016-12-06 12:39:49', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/2?group=project_files', NULL),
(103, 0, '2016-12-06 12:40:32', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/2?group=project_files', NULL),
(104, 0, '2016-12-06 12:40:53', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/2?group=project_files', NULL),
(105, 0, '2016-12-06 12:43:01', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/2?group=project_files', NULL),
(106, 0, '2016-12-06 15:30:57', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(107, 0, '2016-12-06 15:31:14', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(108, 0, '2016-12-06 15:31:22', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(109, 0, '2016-12-06 15:31:32', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(110, 0, '2016-12-06 15:32:04', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(111, 0, '2016-12-06 15:32:56', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(112, 0, '2016-12-06 15:33:06', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(113, 0, '2016-12-06 15:33:37', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(114, 0, '2016-12-06 15:35:23', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(115, 0, '2016-12-06 15:35:35', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(116, 0, '2016-12-08 16:36:19', 'not_task_assigned_to_you', 3, 0, 6, NULL, 'tasks/list_tasks/8', NULL),
(117, 0, '2016-12-08 16:36:21', 'not_task_added_you_as_follower', 3, 0, 6, NULL, 'tasks/list_tasks/8', 'a:1:{i:0;s:5:"sujet";}'),
(118, 0, '2016-12-08 16:36:40', 'not_task_new_attachment', 3, 0, 6, NULL, 'tasks/list_tasks/8', ''),
(119, 0, '2016-12-08 16:37:23', 'a marqué la tâche comme accomplie sujet', 3, 0, 6, NULL, 'tasks/list_tasks/8', ''),
(120, 0, '2016-12-08 16:37:28', 'marquer la tâche comme non accomplie sujet', 3, 0, 6, NULL, 'tasks/list_tasks/8', ''),
(121, 0, '2016-12-08 16:41:15', 'not_created_new_project_discussion', 3, 0, 2, NULL, 'projects/view/3?group=project_discussions&discussion_id=3', NULL),
(122, 0, '2016-12-08 16:42:31', 'not_project_file_uploaded', 3, 0, 2, NULL, 'projects/view/3?group=project_files', NULL),
(123, 0, '2016-12-08 16:50:20', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/3?group=project_discussions&discussion_id=3', NULL),
(124, 0, '2016-12-08 16:56:30', 'not_created_new_project_discussion', 3, 0, 6, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(125, 0, '2016-12-08 16:56:42', 'not_commented_on_project_discussion', 3, 0, 6, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(126, 0, '2016-12-09 11:06:31', 'not_staff_added_as_project_member', 3, 0, 2, NULL, 'projects/view/6', 'a:1:{i:0;s:20:"project_for_estimate";}'),
(127, 0, '2016-12-09 11:38:13', 'not_task_assigned_to_you', 3, 0, 2, NULL, 'tasks/list_tasks/9', NULL),
(128, 0, '2016-12-09 11:38:15', 'not_task_added_himself_as_follower', 3, 0, 2, NULL, 'tasks/list_tasks/9', 'a:1:{i:0;s:11:"Sujet Tache";}'),
(129, 0, '2016-12-09 11:38:17', 'a marqué la tâche comme accomplie Sujet Tache', 3, 0, 2, NULL, 'tasks/list_tasks/9', ''),
(130, 0, '2016-12-09 11:43:47', 'not_task_will_do_user', 3, 0, 6, NULL, 'tasks/list_tasks/6', 'a:1:{i:0;s:10:"sujet tach";}'),
(131, 0, '2016-12-09 12:08:00', 'not_task_assigned_to_you', 3, 0, 2, NULL, 'tasks/list_tasks/11', NULL),
(132, 0, '2016-12-09 12:08:04', 'not_task_added_you_as_follower', 3, 0, 2, NULL, 'tasks/list_tasks/11', 'a:1:{i:0;s:17:"Sujet de la tache";}'),
(133, 0, '2016-12-09 12:08:49', 'not_task_added_you_as_follower', 3, 0, 6, NULL, 'tasks/list_tasks/11', 'a:1:{i:0;s:17:"Sujet de la tache";}'),
(134, 0, '2016-12-09 12:08:49', 'not_task_added_someone_as_follower', 3, 0, 2, NULL, 'tasks/list_tasks/11', 'a:2:{i:0;s:16:"Ilyess Abounaaim";i:1;s:17:"Sujet de la tache";}'),
(135, 0, '2016-12-09 12:10:06', 'not_task_assigned_to_you', 3, 0, 2, NULL, 'tasks/list_tasks/12', NULL),
(136, 0, '2016-12-09 12:10:08', 'not_task_added_you_as_follower', 3, 0, 2, NULL, 'tasks/list_tasks/12', 'a:1:{i:0;s:20:"Sujet tach estimate ";}'),
(137, 0, '2016-12-09 12:10:15', 'not_task_added_you_as_follower', 3, 0, 6, NULL, 'tasks/list_tasks/12', 'a:1:{i:0;s:20:"Sujet tach estimate ";}'),
(138, 0, '2016-12-09 12:10:15', 'not_task_added_someone_as_follower', 3, 0, 2, NULL, 'tasks/list_tasks/12', 'a:2:{i:0;s:16:"Ilyess Abounaaim";i:1;s:20:"Sujet tach estimate ";}'),
(139, 0, '2016-12-09 12:12:09', 'not_task_added_himself_as_follower', 3, 0, 6, NULL, 'tasks/list_tasks/12', 'a:1:{i:0;s:20:"Sujet tach estimate ";}'),
(140, 0, '2016-12-09 12:12:09', 'not_task_added_himself_as_follower', 3, 0, 2, NULL, 'tasks/list_tasks/12', 'a:1:{i:0;s:20:"Sujet tach estimate ";}'),
(141, 0, '2016-12-09 12:15:45', 'not_task_assigned_to_you', 3, 0, 2, NULL, 'tasks/list_tasks/11', NULL),
(142, 0, '2016-12-09 12:15:45', 'not_task_assigned_someone', 3, 0, 6, NULL, 'tasks/list_tasks/11', 'a:2:{i:0;s:25:"Ahmed FaiÃ§al Aboullait";i:1;s:17:"Sujet de la tache";}'),
(143, 0, '2016-12-09 13:02:55', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(144, 0, '2016-12-09 13:04:44', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(145, 0, '2016-12-09 13:20:17', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(146, 0, '2016-12-09 13:28:21', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(147, 0, '2016-12-09 13:39:03', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(148, 0, '2016-12-09 13:42:38', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(149, 1, '2016-12-09 13:50:20', 'not_commented_on_project_discussion', 0, 6, 3, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(150, 0, '2016-12-09 13:50:20', 'not_commented_on_project_discussion', 0, 6, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(151, 0, '2016-12-09 14:01:49', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(152, 0, '2016-12-09 14:05:10', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(153, 0, '2016-12-09 14:06:32', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(154, 0, '2016-12-09 14:08:26', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(155, 0, '2016-12-09 14:09:47', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(156, 1, '2016-12-09 15:14:31', 'not_commented_on_project_discussion', 0, 6, 3, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(157, 0, '2016-12-09 15:14:31', 'not_commented_on_project_discussion', 0, 6, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(158, 0, '2016-12-09 15:16:52', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(159, 1, '2016-12-09 15:24:48', 'not_commented_on_project_discussion', 0, 6, 3, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(160, 0, '2016-12-09 15:24:48', 'not_commented_on_project_discussion', 0, 6, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(161, 0, '2016-12-09 15:25:11', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(162, 0, '2016-12-09 15:26:05', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(163, 0, '2016-12-09 16:11:18', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(164, 0, '2016-12-09 16:13:36', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(165, 0, '2016-12-09 16:15:13', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(166, 0, '2016-12-09 16:15:34', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(167, 0, '2016-12-09 16:20:53', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(168, 0, '2016-12-09 16:21:30', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(169, 0, '2016-12-09 16:22:27', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(170, 0, '2016-12-09 16:24:47', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL),
(171, 0, '2016-12-09 18:23:51', 'not_commented_on_project_discussion', 3, 0, 2, NULL, 'projects/view/6?group=project_discussions&discussion_id=4', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbloptions`
--

CREATE TABLE `tbloptions` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbloptions`
--

INSERT INTO `tbloptions` (`id`, `name`, `value`) VALUES
(1, 'dateformat', 'd.m.Y|%d.%m.%Y'),
(2, 'companyname', 'DeepSilver'),
(3, 'services', '1'),
(4, 'maximum_allowed_ticket_attachments', '4'),
(5, 'ticket_attachments_file_extensions', '.jpg,.png,.pdf,.doc,.docx'),
(6, 'staff_access_only_assigned_departments', '1'),
(7, 'use_knowledge_base', '0'),
(8, 'smtp_email', 'no-reply@deepmaroc.com'),
(9, 'smtp_password', 'd45af94a4528387e051fef6e39842b41d212c3b0182209470d520141f31f7e2837855ec0a7d66499ab559e62893c0473ba104992a03b1c3359c62c85f9d1bfb487cHNdMnm8L6DBXorq0zTacaahbQo/YyORgPIu9OlK0='),
(10, 'smtp_port', '465'),
(11, 'smtp_host', 'deepmaroc.com'),
(12, 'smtp_email_charset', 'utf-8'),
(13, 'default_timezone', 'Europe/Berlin'),
(14, 'clients_default_theme', 'perfex'),
(15, 'company_logo', 'logo.png'),
(16, 'tables_pagination_limit', '25'),
(17, 'main_domain', 'deepmaroc.com'),
(18, 'allow_registration', '0'),
(19, 'knowledge_base_without_registration', '1'),
(20, 'email_signature', 'Kind Regards<br />\r\nLive Projects / DeepSilver Morocco'),
(21, 'default_staff_role', '1'),
(22, 'newsfeed_maximum_files_upload', '20'),
(23, 'newsfeed_maximum_file_size', '10'),
(24, 'contract_expiration_before', '4'),
(25, 'invoice_prefix', 'F-'),
(26, 'decimal_separator', ','),
(27, 'thousand_separator', '.'),
(28, 'currency_placement', 'after'),
(29, 'invoice_company_name', 'DeepSilver'),
(30, 'invoice_company_address', '97-A. Av Hassan Sghir. 1er Ã©tage, NÂ°81'),
(31, 'invoice_company_city', 'Casablanca'),
(32, 'invoice_company_country_code', 'MA'),
(33, 'invoice_company_postal_code', '20150'),
(34, 'invoice_company_phonenumber', '+212 (0) 522 447 699'),
(35, 'view_invoice_only_logged_in', '0'),
(36, 'invoice_number_format', '2'),
(37, 'next_invoice_number', '226'),
(38, 'invoice_year', '2016'),
(39, 'cron_send_invoice_overdue_reminder', '1'),
(40, 'active_language', 'english'),
(41, 'invoice_number_decrement_on_delete', '1'),
(42, 'automatically_send_invoice_overdue_reminder_after', '1'),
(43, 'automatically_resend_invoice_overdue_reminder_after', '3'),
(44, 'paymentmethod_paypal_label', 'Paypal'),
(45, 'paymentmethod_paypal_active', '1'),
(46, 'paymentmethod_paypal_username', ''),
(47, 'paymentmethod_paypal_password', ''),
(48, 'paymentmethod_paypal_signature', ''),
(49, 'paymentmethod_stripe_active', '1'),
(50, 'paymentmethod_paypal_currencies', 'EUR,USD'),
(51, 'paymentmethod_paypal_test_mode_enabled', '1'),
(52, 'last_recurring_expenses_cron', '1480592261'),
(53, 'paymentmethod_stripe_test_mode_enabled', '1'),
(54, 'paymentmethod_stripe_label', 'Stripe'),
(55, 'survey_send_emails_per_cron_run', '100'),
(56, 'delete_only_on_last_invoice', '1'),
(57, 'delete_only_on_last_estimate', '1'),
(58, 'paymentmethod_stripe_api_secret_key', ''),
(59, 'paymentmethod_stripe_currencies', 'USD,CAD'),
(60, 'create_invoice_from_recurring_only_on_paid_invoices', '0'),
(61, 'allow_payment_amount_to_be_modified', '0'),
(62, 'paymentmethod_stripe_api_publishable_key', ''),
(63, 'send_renewed_invoice_from_recurring_to_email', '1'),
(64, 'rtl_support_client', '0'),
(65, 'last_recurring_invoices_cron', '1480592261'),
(66, 'limit_top_search_bar_results_to', '10'),
(67, 'estimate_prefix', 'D-'),
(68, 'next_estimate_number', '149'),
(69, 'estimate_number_decrement_on_delete', '1'),
(70, 'estimate_number_format', '2'),
(71, 'estimate_year', '2016'),
(72, 'estimate_auto_convert_to_invoice_on_client_accept', '1'),
(73, 'exclude_estimate_from_client_area_with_draft_status', '1'),
(74, 'rtl_support_admin', '0'),
(75, 'last_cron_run', '1480592261'),
(76, 'show_sale_agent_on_estimates', '1'),
(77, 'show_sale_agent_on_invoices', '1'),
(78, 'predefined_terms_invoice', ''),
(79, 'leads_default_source', ''),
(80, 'default_contact_permissions', 'a:6:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";}'),
(81, 'predefined_terms_estimate', ''),
(82, 'predefined_clientnote_invoice', ''),
(83, 'predefined_clientnote_estimate', ''),
(84, 'custom_pdf_logo_image_url', ''),
(85, 'number_padding_invoice_and_estimate', '6'),
(86, 'favicon', 'favicon.ico'),
(87, 'auto_backup_enabled', '0'),
(88, 'invoice_due_after', '30'),
(89, 'google_api_key', ''),
(90, 'google_calendar_main_calendar', ''),
(91, 'default_tax', 'TVA|20.00'),
(92, 'show_invoices_on_calendar', '1'),
(93, 'show_estimates_on_calendar', '1'),
(94, 'show_contracts_on_calendar', '1'),
(95, 'show_tasks_on_calendar', '1'),
(96, 'show_customer_reminders_on_calendar', '1'),
(97, 'auto_backup_every', '7'),
(98, 'last_auto_backup', ''),
(99, 'output_client_pdfs_from_admin_area_in_client_language', '1'),
(100, 'show_lead_reminders_on_calendar', '1'),
(101, 'aside_menu_active', '{"aside_menu_active":[{"name":"als_dashboard","url":"\\/","permission":"","icon":"fa fa-tachometer","id":"dashboard"},{"name":"als_clients","url":"clients","permission":"customers","icon":"fa fa-users","id":"customers"},{"id":"suppliers","name":"als_suppliers","url":"#","permission":"","icon":"fa fa-money","children":[{"id":"child-suppliers","name":"projects","url":"Supplier_projects","permission":"projects","icon":""},{"id":"child-suppliers","name":"list_suppliers","url":"suppliers","permission":"","icon":""},{"id":"child-suppliers","name":"invoices_suppliers","url":"Supplier_invoices\\/list_invoice","permission":"suppliers","icon":""}]},{"name":"projects","url":"projects","permission":"","icon":"fa fa-cubes","id":"projects"},{"name":"als_sales","url":"#","permission":"","icon":"fa fa-balance-scale","id":"sales","children":[{"name":"proposals","url":"proposals","permission":"proposals","icon":"","id":"child-proposals"},{"name":"estimates","url":"estimates\\/list_estimates","permission":"estimates","icon":"","id":"child-estimates"},{"name":"invoices","url":"invoices\\/list_invoices","permission":"invoices","icon":"","id":"child-invoices"},{"name":"payments","url":"payments","permission":"payments","icon":"","id":"child-payments"},{"name":"items","url":"invoice_items","permission":"is_admin","icon":"","id":"child-items"}]},{"name":"als_expenses","url":"expenses\\/list_expenses","permission":"expenses","icon":"fa fa-sort-amount-asc","id":"expenses"},{"name":"support","url":"tickets","permission":"","icon":"fa fa-life-ring","id":"tickets"},{"name":"als_contracts","url":"contracts","permission":"contracts","icon":"fa fa-file","id":"contracts"},{"name":"als_leads","url":"leads","permission":"is_staff_member","icon":"fa fa-tty","id":"leads"},{"name":"als_tasks","url":"tasks\\/list_tasks","permission":"","icon":"fa fa-tasks","id":"tasks"},{"name":"als_kb","url":"#","permission":"knowledge_base","icon":"fa fa-folder-open-o","id":"knowledge-base","children":[{"name":"als_add_article","url":"knowledge_base\\/article","permission":"","icon":"","id":"child-add-article"},{"name":"als_all_articles","url":"knowledge_base","permission":"","icon":"","id":"child-all-articles"},{"name":"als_kb_groups","url":"knowledge_base\\/manage_groups","permission":"","icon":"","id":"child-groups"}]},{"name":"als_reports","url":"#","permission":"reports","icon":"fa fa-pie-chart","id":"reports","children":[{"name":"als_reports_sales_submenu","url":"reports\\/sales","permission":"","icon":"","id":"child-sales"},{"name":"als_reports_expenses","url":"reports\\/expenses","permission":"","icon":"","id":"child-expenses"},{"name":"als_expenses_vs_income","url":"reports\\/expenses_vs_income","permission":"","icon":"","id":"child-expenses-vs-income"},{"name":"als_reports_leads_submenu","url":"reports\\/leads","permission":"","icon":"","id":"child-leads"},{"name":"als_kb_articles_submenu","url":"reports\\/knowledge_base_articles","permission":"","icon":"","id":"child-kb-articles"}]},{"name":"als_utilities","url":"#","permission":"","icon":"fa fa-cogs","id":"utilities","children":[{"name":"als_media","url":"utilities\\/media","permission":"","icon":"","id":"child-media"},{"name":"bulk_pdf_exporter","url":"utilities\\/bulk_pdf_exporter","permission":"bulk_pdf_exporter","icon":"","id":"child-bulk-pdf-exporter"},{"name":"als_calendar_submenu","url":"utilities\\/calendar","permission":"","icon":"","id":"child-calendar"},{"name":"als_goals_tracking","url":"goals","permission":"goals","icon":"","id":"child-goals-tracking"},{"name":"als_surveys","url":"surveys","permission":"surveys","icon":"","id":"child-surveys"},{"name":"als_announcements_submenu","url":"announcements","permission":"is_admin","icon":"","id":"child-announcements"},{"id":"child-database-backup","name":"utility_backup","url":"utilities\\/backup","permission":"is_admin","icon":""},{"name":"als_activity_log_submenu","url":"utilities\\/activity_log","permission":"is_admin","icon":"","id":"child-activity-log"},{"name":"ticket_pipe_log","url":"utilities\\/pipe_log","permission":"is_admin","icon":"","id":"ticket-pipe-log"},{"name":"Home slider","url":"utilities\\/home_slider","permission":"is_admin","icon":"","id":"home_slider"}]}]}'),
(102, 'aside_menu_inactive', '{"aside_menu_inactive":[]}'),
(103, 'setup_menu_active', '{"setup_menu_active":[{"permission":"staff","name":"als_staff","url":"staff","icon":"","id":"staff"},{"permission":"is_admin","name":"clients","url":"#","icon":"","id":"customers","children":[{"permission":"","name":"customer_groups","url":"clients\\/groups","icon":"","id":"groups"}]},{"permission":"","name":"support","url":"#","icon":"","id":"tickets","children":[{"permission":"is_admin","name":"acs_departments","url":"departments","icon":"","id":"departments"},{"permission":"is_admin","name":"acs_ticket_predefined_replies_submenu","url":"tickets\\/predifined_replies","icon":"","id":"predifined-replies"},{"permission":"is_admin","name":"acs_ticket_priority_submenu","url":"tickets\\/priorities","icon":"","id":"ticket-priority"},{"permission":"is_admin","name":"acs_ticket_statuses_submenu","url":"tickets\\/statuses","icon":"","id":"ticket-statuses"},{"permission":"is_admin","name":"acs_ticket_services_submenu","url":"tickets\\/services","icon":"","id":"services"},{"permission":"is_admin","name":"spam_filters","url":"tickets\\/spam_filters","icon":"","id":"spam-filters"}]},{"permission":"is_admin","name":"acs_leads","url":"#","icon":"","id":"leads","children":[{"permission":"","name":"acs_leads_sources_submenu","url":"leads\\/sources","icon":"","id":"sources"},{"permission":"","name":"acs_leads_statuses_submenu","url":"leads\\/statuses","icon":"","id":"statuses"},{"permission":"","name":"leads_email_integration","url":"leads\\/email_integration","icon":"","id":"email-integration"}]},{"permission":"is_admin","name":"acs_finance","url":"#","icon":"","id":"finance","children":[{"permission":"","name":"acs_sales_taxes_submenu","url":"taxes","icon":"","id":"taxes"},{"permission":"","name":"acs_sales_currencies_submenu","url":"currencies","icon":"","id":"currencies"},{"permission":"","name":"acs_sales_payment_modes_submenu","url":"paymentmodes","icon":"","id":"payment-modes"},{"permission":"","name":"acs_expense_categories","url":"expenses\\/categories","icon":"","id":"expenses-categories"}]},{"permission":"is_admin","name":"acs_contracts","url":"#","icon":"","id":"contracts","children":[{"permission":"","name":"acs_contract_types","url":"contracts\\/types","icon":"","id":"contract-types"}]},{"permission":"email_templates","name":"acs_email_templates","url":"emails","icon":"","id":"email-templates"},{"permission":"is_admin","name":"asc_custom_fields","url":"custom_fields","icon":"","id":"custom-fields"},{"permission":"roles","name":"acs_roles","url":"roles","icon":"","id":"roles"},{"permission":"is_admin","name":"menu_builder","url":"#","icon":"","id":"menu-builder","children":[{"permission":"","name":"main_menu","url":"utilities\\/main_menu","icon":"","id":"organize-sidebar"},{"permission":"is_admin","name":"setup_menu","url":"utilities\\/setup_menu","icon":"","id":"setup-menu"}]},{"name":"theme_style","permission":"is_admin","icon":"","url":"utilities\\/theme_style","id":"theme-style"},{"permission":"settings","name":"acs_settings","url":"settings","icon":"","id":"settings"}]}'),
(104, 'access_tickets_to_none_staff_members', '0'),
(105, 'setup_menu_inactive', '{"setup_menu_inactive":[]}'),
(106, 'customer_default_country', '149'),
(107, 'view_estimate_only_logged_in', '0'),
(108, 'show_status_on_pdf_ei', '1'),
(109, 'email_piping_only_replies', '0'),
(110, 'email_piping_only_registered', '0'),
(111, 'email_piping_enabled', '0'),
(112, 'email_piping_default_priority', '2'),
(113, 'total_to_words_lowercase', '1'),
(114, 'show_tax_per_item', '0'),
(115, 'last_survey_send_cron', '1480592246'),
(116, 'total_to_words_enabled', '1'),
(117, 'receive_notification_on_new_ticket', '1'),
(118, 'autoclose_tickets_after', '100'),
(119, 'media_max_file_size_upload', '5000'),
(120, 'client_staff_add_edit_delete_task_comments_first_hour', '0'),
(121, 'show_projects_on_calendar', '1'),
(122, 'leads_kanban_limit', '200'),
(123, 'tasks_reminder_notification_before', '2'),
(124, 'pdf_font', 'freesans'),
(125, 'pdf_table_heading_color', '#323a45'),
(126, 'pdf_table_heading_text_color', '#ffffff'),
(127, 'pdf_font_size', '10'),
(128, 'defaut_leads_kanban_sort', 'dateadded'),
(129, 'defaut_leads_kanban_sort_type', 'desc'),
(130, 'allowed_files', '.gif,.png,.jpeg,.jpg,.pdf,.doc,.txt,.docx,.xls,.zip,.rar,.xls,.mp4,.psd,.ai,.ind,.indx'),
(131, 'show_all_tasks_for_project_member', '1'),
(132, 'email_protocol', 'smtp'),
(133, 'calendar_first_day', '1'),
(134, 'recaptcha_secret_key', ''),
(135, 'show_help_on_setup_menu', '1'),
(136, 'show_proposals_on_calendar', '1'),
(137, 'smtp_encryption', 'ssl'),
(138, 'recaptcha_site_key', ''),
(139, 'smtp_username', 'no-reply@deepmaroc.com'),
(140, 'auto_stop_tasks_timers_on_new_timer', '0'),
(141, 'notification_when_customer_pay_invoice', '1'),
(142, 'theme_style', '[]'),
(143, 'calendar_invoice_color', '#ff6f00'),
(144, 'calendar_estimate_color', '#ff6f00'),
(145, 'calendar_proposal_color', '#84c529'),
(146, 'calendar_task_color', '#fc2d42'),
(147, 'calendar_reminder_color', '#03a9f4'),
(148, 'calendar_contract_color', '#b72974'),
(149, 'calendar_project_color', '#eda334'),
(150, 'update_info_message', ''),
(151, 'pdf_logo_width', '100'),
(152, 'show_invoice_reminders_on_calendar', '1'),
(153, 'show_estimate_reminders_on_calendar', '1'),
(154, 'show_proposal_reminders_on_calendar', '1'),
(155, 'proposal_due_after', '15'),
(156, 'allow_customer_to_change_ticket_status', '0'),
(157, 'lead_lock_after_convert_to_customer', '1'),
(158, 'default_estimates_pipeline_sort', 'expirydate'),
(159, 'default_proposals_pipeline_sort', 'open_till'),
(160, 'defaut_proposals_pipeline_sort_type', 'desc'),
(161, 'defaut_estimates_pipeline_sort_type', 'desc'),
(162, 'send_estimate_expiry_reminder_before', '4'),
(163, 'estimate_expiry_reminder_enabled', '1'),
(164, 'leads_default_status', ''),
(165, 'proposal_expiry_reminder_enabled', '1'),
(166, 'send_proposal_expiry_reminder_before', '4'),
(167, 'use_recaptcha_customers_area', '0'),
(168, 'remove_decimals_on_zero', '0'),
(169, 'remove_tax_name_from_item_table', '0'),
(170, 'pdf_format_invoice', 'A4'),
(171, 'pdf_format_estimate', 'A4'),
(172, 'pdf_format_proposal', 'A4'),
(173, 'pdf_format_payment', 'A4'),
(174, 'pdf_format_contract', 'A4'),
(175, 'swap_pdf_info', '0'),
(176, 'pdf_text_color', '#000000'),
(177, 'auto_check_for_new_notifications', '0'),
(178, 'custom_company_field_FAX', '+212 (0) 522 447 699'),
(179, 'default_supplier_contact_permissions', 'a:6:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";}');

-- --------------------------------------------------------

--
-- Structure de la table `tblpermissions`
--

CREATE TABLE `tblpermissions` (
  `permissionid` int(11) NOT NULL,
  `name` mediumtext NOT NULL,
  `shortname` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblpermissions`
--

INSERT INTO `tblpermissions` (`permissionid`, `name`, `shortname`) VALUES
(1, 'Contracts', 'contracts'),
(2, 'Tasks', 'tasks'),
(3, 'Reports', 'reports'),
(4, 'Settings', 'settings'),
(5, 'Projects', 'projects'),
(6, 'Surveys', 'surveys'),
(7, 'Staff', 'staff'),
(8, 'Customers', 'customers'),
(9, 'Email Templates', 'email_templates'),
(10, 'Roles', 'roles'),
(11, 'Estimates', 'estimates'),
(12, 'Knowledge base', 'knowledge_base'),
(13, 'Proposals', 'proposals'),
(14, 'Goals', 'goals'),
(15, 'Expenses', 'expenses'),
(16, 'Bulk PDF Exporter', 'bulk_pdf_exporter'),
(17, 'Payments', 'payments'),
(18, 'Invoices', 'invoices'),
(19, 'Suppliers', 'suppliers'),
(20, 'Supplier Invoices', 'supplier_invoices');

-- --------------------------------------------------------

--
-- Structure de la table `tblpinnedprojects`
--

CREATE TABLE `tblpinnedprojects` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblpinnedprojects`
--

INSERT INTO `tblpinnedprojects` (`id`, `project_id`, `staff_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tblpostattachments`
--

CREATE TABLE `tblpostattachments` (
  `id` int(11) NOT NULL,
  `filename` mediumtext NOT NULL,
  `postid` int(11) NOT NULL,
  `filetype` varchar(20) DEFAULT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblpostcomments`
--

CREATE TABLE `tblpostcomments` (
  `id` int(11) NOT NULL,
  `content` text,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblpostlikes`
--

CREATE TABLE `tblpostlikes` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dateliked` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblpostlikes`
--

INSERT INTO `tblpostlikes` (`id`, `postid`, `userid`, `dateliked`) VALUES
(1, 1, 3, '2016-10-04 15:36:58');

-- --------------------------------------------------------

--
-- Structure de la table `tblposts`
--

CREATE TABLE `tblposts` (
  `postid` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `visibility` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `pinned` int(11) NOT NULL,
  `datepinned` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblposts`
--

INSERT INTO `tblposts` (`postid`, `creator`, `datecreated`, `visibility`, `content`, `pinned`, `datepinned`) VALUES
(1, 2, '2016-09-19 18:34:22', 'all', 'http://themarklee.com/2013/10/16/simple-crossfading-slideshow-css/', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblpredifinedreplies`
--

CREATE TABLE `tblpredifinedreplies` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblpriorities`
--

CREATE TABLE `tblpriorities` (
  `priorityid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblpriorities`
--

INSERT INTO `tblpriorities` (`priorityid`, `name`) VALUES
(1, 'Low'),
(2, 'Medium'),
(3, 'High');

-- --------------------------------------------------------

--
-- Structure de la table `tblprojectactivity`
--

CREATE TABLE `tblprojectactivity` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL DEFAULT '0',
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `visible_to_customer` int(11) NOT NULL DEFAULT '0',
  `description_key` varchar(500) NOT NULL COMMENT 'Language file key',
  `additional_data` text,
  `dateadded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblprojectactivity`
--

INSERT INTO `tblprojectactivity` (`id`, `project_id`, `staff_id`, `contact_id`, `visible_to_customer`, `description_key`, `additional_data`, `dateadded`) VALUES
(1, 1, 1, 0, 1, 'project_activity_added_team_member', 'Ilyess Abounaaim', '2016-09-04 23:59:20'),
(2, 1, 1, 0, 1, 'project_activity_created', '', '2016-09-04 23:59:20'),
(3, 1, 1, 0, 1, 'project_activity_new_task_assignee', 'enregistrement voix Off - Ilyess Abounaaim', '2016-09-05 00:04:08'),
(4, 1, 1, 0, 1, 'project_activity_new_task_assignee', 'post prod - Ilyess Abounaaim', '2016-09-05 00:06:07'),
(5, 1, 1, 0, 1, 'project_activity_new_task_attachment', 'post prod', '2016-09-05 00:07:01'),
(6, 1, 1, 0, 1, 'project_activity_task_marked_complete', 'post prod', '2016-09-05 00:07:27'),
(7, 1, 1, 0, 1, 'project_activity_created_discussion', 'mise a jour de la DBA', '2016-09-05 00:08:52'),
(8, 1, 2, 0, 1, 'project_activity_task_marked_complete', 'enregistrement voix Off', '2016-09-05 11:15:31'),
(9, 2, 2, 0, 1, 'project_activity_added_team_member', 'Ilyess Abounaaim', '2016-09-06 15:45:05'),
(10, 2, 2, 0, 1, 'project_activity_added_team_member', 'Ahmed FaiÃ§al Aboullait', '2016-09-06 15:45:05'),
(11, 2, 2, 0, 1, 'project_activity_created', '', '2016-09-06 15:45:06'),
(12, 2, 3, 0, 1, 'project_activity_new_task_assignee', 'Ajout dâ€™image slider home screen  - Ahmed FaiÃ§al Aboullait', '2016-09-06 16:20:40'),
(13, 2, 3, 0, 1, 'project_activity_task_assignee_removed', 'Ajout dâ€™image slider home screen  - Ahmed FaiÃ§al Aboullait', '2016-09-06 16:20:44'),
(14, 2, 2, 0, 1, 'project_activity_new_task_assignee', 'Ajout dâ€™image slider home screen  - Ahmed FaiÃ§al Aboullait', '2016-09-06 16:22:44'),
(15, 1, 0, 0, 0, 'project_activity_status_updated', '<lang>project_status_4</lang>', '2016-09-12 11:20:01'),
(16, 2, 2, 0, 1, 'project_activity_updated', '', '2016-09-14 17:04:44'),
(17, 2, 2, 0, 1, 'project_activity_updated', '', '2016-09-14 17:06:33'),
(18, 2, 2, 0, 1, 'project_activity_updated', '', '2016-09-14 17:06:58'),
(19, 2, 2, 0, 1, 'project_activity_updated', '', '2016-09-14 17:07:52'),
(20, 2, 2, 0, 1, 'project_activity_updated', '', '2016-09-14 17:08:17'),
(21, 2, 2, 0, 1, 'project_activity_updated', '', '2016-09-14 17:08:35'),
(22, 2, 2, 0, 0, 'project_activity_uploaded_file', 'ea1e755d.jpg<br />image/jpeg', '2016-09-14 17:19:23'),
(23, 3, 2, 0, 1, 'project_activity_added_team_member', 'Ahmed FaiÃ§al Aboullait', '2016-09-14 17:21:55'),
(24, 3, 2, 0, 1, 'project_activity_created', '', '2016-09-14 17:21:55'),
(25, 3, 2, 0, 1, 'project_activity_updated', '', '2016-09-15 17:06:38'),
(26, 3, 2, 0, 1, 'project_activity_updated', '', '2016-09-15 18:06:30'),
(27, 3, 2, 0, 1, 'project_activity_updated', '', '2016-09-15 18:19:56'),
(28, 3, 2, 0, 1, 'project_activity_updated', '', '2016-09-16 15:41:10'),
(29, 3, 2, 0, 1, 'project_activity_updated', '', '2016-09-16 17:02:12'),
(30, 3, 2, 0, 1, 'project_activity_updated', '', '2016-09-16 17:15:08'),
(31, 3, 2, 0, 1, 'project_activity_updated', '', '2016-09-16 17:28:23'),
(32, 3, 2, 0, 1, 'project_activity_updated', '', '2016-09-16 17:28:36'),
(33, 3, 2, 0, 1, 'project_activity_updated', '', '2016-09-16 17:28:43'),
(34, 4, 2, 0, 1, 'project_activity_created', '', '2016-09-21 12:26:17'),
(35, 4, 3, 0, 1, 'project_activity_updated', '', '2016-10-17 17:12:53'),
(36, 3, 3, 0, 1, 'project_activity_updated', '', '2016-10-18 15:19:01'),
(37, 3, 3, 0, 1, 'project_activity_updated', '', '2016-10-18 15:20:11'),
(38, 5, 3, 0, 1, 'project_activity_created', '', '2016-10-21 17:50:27'),
(39, 5, 3, 0, 1, 'project_activity_updated', '', '2016-10-21 18:13:13'),
(40, 5, 3, 0, 1, 'project_status_updated', '<b><lang>project_status_1</lang></b>', '2016-10-21 18:13:14'),
(41, 5, 3, 0, 1, 'project_activity_added_team_member', 'Ilyess Abounaaim', '2016-10-24 11:23:49'),
(42, 5, 3, 0, 1, 'project_activity_updated', '', '2016-10-24 11:23:51'),
(43, 5, 3, 0, 1, 'project_status_updated', '<b><lang>project_status_2</lang></b>', '2016-10-24 11:23:52'),
(44, 5, 3, 0, 1, 'project_activity_marked_all_tasks_as_complete', '', '2016-10-24 11:25:12'),
(45, 5, 3, 0, 1, 'project_activity_updated', '', '2016-10-24 11:25:12'),
(46, 5, 3, 0, 1, 'project_marked_as_finished', '', '2016-10-24 11:25:13'),
(47, 4, 3, 0, 1, 'project_activity_updated', '', '2016-10-24 15:27:49'),
(48, 5, 6, 0, 1, 'project_activity_updated', '', '2016-10-24 17:47:19'),
(49, 4, 6, 0, 1, 'project_activity_created_discussion', 'discussion Alami', '2016-10-25 13:29:30'),
(50, 4, 6, 0, 1, 'project_activity_added_team_member', 'Ilyess Abounaaim', '2016-10-25 13:30:23'),
(51, 4, 6, 0, 1, 'project_activity_added_team_member', 'Ikram  naffah', '2016-10-25 13:30:23'),
(52, 4, 6, 0, 1, 'project_activity_added_team_member', 'Ahmed FaiÃ§al Aboullait', '2016-10-25 13:30:23'),
(53, 4, 6, 0, 1, 'project_activity_created_milestone', 'etape 1', '2016-10-25 13:30:58'),
(54, 4, 6, 0, 1, 'project_activity_new_task_assignee', 'CRMmodification - Ilyess Abounaaim', '2016-10-25 13:32:46'),
(55, 4, 6, 0, 1, 'project_activity_recorded_expense', 'Digital<br />13.213,00MAD', '2016-10-25 13:37:52'),
(56, 4, 6, 0, 1, 'project_activity_uploaded_file', '2.jpg<br />image/jpeg', '2016-10-25 15:48:00'),
(57, 4, 0, 6, 1, 'project_activity_uploaded_file', 'cS-2.jpg<br />image/jpeg', '2016-10-25 15:51:24'),
(58, 4, 0, 6, 1, 'project_activity_uploaded_file', 'large-image1.jpg<br />image/jpeg', '2016-10-25 15:53:14'),
(59, 4, 6, 0, 1, 'project_activity_recorded_timesheet', '<seconds>172800</seconds><br /><lang>project_activity_task_name</lang> CRMmodification', '2016-10-25 16:20:24'),
(60, 4, 6, 0, 1, 'project_activity_commented_on_discussion', 'discussion Alami', '2016-10-25 16:33:51'),
(61, 4, 6, 0, 1, 'project_activity_new_task_comment', 'CRMmodification', '2016-10-25 16:49:25'),
(62, 4, 6, 0, 1, 'project_activity_new_task_attachment', 'CRMmodification', '2016-10-25 16:56:43'),
(63, 4, 0, 6, 1, 'project_activity_new_task_comment', 'CRMmodification', '2016-10-25 17:00:53'),
(64, 4, 6, 0, 1, 'project_activity_new_task_comment', 'CRMmodification', '2016-10-25 17:37:41'),
(65, 4, 0, 6, 1, 'project_activity_commented_on_discussion', 'discussion Alami', '2016-10-25 17:39:39'),
(66, 4, 6, 0, 1, 'project_activity_commented_on_discussion', 'discussion Alami', '2016-10-25 17:43:23'),
(67, 4, 6, 0, 1, 'project_activity_commented_on_discussion', 'discussion Alami', '2016-10-25 17:59:04'),
(68, 4, 6, 0, 1, 'project_activity_invoiced_project', 'F-2016/000146', '2016-10-26 12:54:46'),
(69, 4, 0, 6, 1, 'project_activity_uploaded_file', 'cs-1.jpg<br />image/jpeg', '2016-10-26 17:34:39'),
(70, 6, 6, 0, 1, 'project_activity_added_team_member', 'Ilyess Abounaaim', '2016-10-26 17:46:05'),
(71, 6, 6, 0, 1, 'project_activity_created', '', '2016-10-26 17:46:05'),
(72, 4, 6, 0, 0, 'project_activity_uploaded_file', 'DORKS.txt<br />text/plain', '2016-10-27 13:18:48'),
(73, 4, 6, 0, 0, 'project_activity_uploaded_file', 'pormo.jpg<br />image/jpeg', '2016-10-27 13:19:36'),
(74, 4, 6, 0, 0, 'project_activity_project_file_removed', 'pormo.jpg', '2016-10-27 13:20:45'),
(75, 4, 6, 0, 1, 'project_activity_project_file_removed', 'DORKS.txt', '2016-10-27 13:20:49'),
(76, 4, 6, 0, 0, 'project_activity_uploaded_file', 'pormo.jpg<br />image/jpeg', '2016-10-27 13:21:08'),
(77, 4, 6, 0, 1, 'project_activity_uploaded_file', 'img_nature_wide.jpg<br />image/jpeg', '2016-10-27 13:22:44'),
(78, 4, 6, 0, 1, 'project_activity_uploaded_file', 'img_mountains_wide.jpg<br />image/jpeg', '2016-10-27 13:25:00'),
(79, 4, 6, 0, 1, 'project_activity_uploaded_file', 'deep-silver-logo.jpg<br />image/jpeg', '2016-10-27 13:29:10'),
(80, 4, 6, 0, 1, 'project_activity_uploaded_file', 'cs-1-1.jpg<br />image/jpeg', '2016-10-27 13:38:04'),
(81, 4, 6, 0, 1, 'project_activity_uploaded_file', '2-1.jpg<br />image/jpeg', '2016-10-27 13:38:26'),
(82, 4, 6, 0, 1, 'project_activity_uploaded_file', '2-2.jpg<br />image/jpeg', '2016-10-27 13:39:08'),
(83, 4, 6, 0, 0, 'project_activity_uploaded_file', '1-1.jpg<br />image/jpeg', '2016-10-27 13:41:56'),
(84, 4, 6, 0, 1, 'project_activity_uploaded_file', '3P-2.jpeg<br />image/jpeg', '2016-10-27 13:42:58'),
(85, 4, 6, 0, 1, 'project_activity_commented_on_discussion', 'discussion Alami', '2016-10-27 15:52:09'),
(86, 4, 6, 0, 1, 'project_activity_commented_on_discussion', 'discussion Alami', '2016-10-27 15:54:27'),
(87, 4, 3, 0, 0, 'project_activity_uploaded_file', 'F-2016-000145-DEEPSILVER-32.pdf<br />application/pdf', '2016-10-27 17:10:09'),
(88, 4, 3, 0, 1, 'project_activity_uploaded_file', 'cS-2-1.jpg<br />image/jpeg', '2016-10-27 17:40:24'),
(89, 4, 3, 0, 0, 'project_activity_uploaded_file', 'codeigniter_tutorial.pdf<br />application/pdf', '2016-10-27 17:40:40'),
(90, 4, 3, 0, 0, 'project_activity_uploaded_file', 'largeimage.jpg<br />image/jpeg', '2016-10-27 17:41:44'),
(91, 4, 3, 0, 1, 'project_activity_uploaded_file', 'F-2016-000145-DEEPSILVER-24.pdf<br />application/pdf', '2016-10-27 17:42:47'),
(92, 4, 6, 0, 1, 'project_activity_uploaded_file', 'F-2016-000145-DEEPSILVER-6.pdf<br />application/pdf', '2016-10-27 17:43:51'),
(93, 4, 6, 0, 0, 'project_activity_uploaded_file', 'F-2016-000145-DEEPSILVER-21.pdf<br />application/pdf', '2016-10-27 17:45:13'),
(94, 4, 6, 0, 1, 'project_activity_uploaded_file', 'F-2016-000145-DEEPSILVER-4.pdf<br />application/pdf', '2016-10-27 17:46:23'),
(95, 4, 6, 0, 1, 'project_activity_uploaded_file', 'testt2.jpeg<br />image/jpeg', '2016-10-27 17:47:29'),
(96, 4, 6, 0, 0, 'project_activity_uploaded_file', 'test1.jpeg<br />image/jpeg', '2016-10-27 18:15:45'),
(97, 4, 6, 0, 1, 'project_activity_uploaded_file', 'testt2-1.jpeg<br />image/jpeg', '2016-10-27 18:16:19'),
(98, 4, 6, 0, 1, 'project_activity_commented_on_discussion', 'discussion Alami', '2016-10-27 18:17:33'),
(99, 4, 3, 0, 1, 'project_activity_updated', '', '2016-10-28 11:07:31'),
(108, 4, 0, 0, 0, 'project_activity_status_updated', '<lang>project_status_4</lang>', '2016-12-01 12:37:40'),
(102, 6, 3, 0, 0, 'project_activity_removed_team_member', 'Ilyess Abounaaim', '2016-11-21 12:45:55'),
(103, 6, 3, 0, 1, 'project_activity_uploaded_file', 'DORKS.txt<br />text/plain', '2016-11-21 12:53:51'),
(104, 6, 3, 0, 0, 'project_activity_uploaded_file', 'codeigniter_tutorial.pdf<br />application/pdf', '2016-11-21 13:21:50'),
(105, 6, 3, 0, 0, 'project_activity_uploaded_file', 'codeigniter_tutorial-1.pdf<br />application/pdf', '2016-11-21 13:22:06'),
(106, 6, 3, 0, 0, 'project_activity_uploaded_file', 'cs-1.jpg<br />image/jpeg', '2016-11-21 17:12:20'),
(107, 6, 3, 0, 0, 'project_activity_added_team_member', 'Ilyess Abounaaim', '2016-11-22 11:23:09'),
(109, 9, 3, 0, 0, 'project_activity_added_team_member', 'Ilyess Abounaaim', '2016-12-05 12:53:19'),
(110, 9, 3, 0, 0, 'project_activity_created', '', '2016-12-05 12:53:22'),
(111, 9, 3, 0, 0, 'project_activity_updated', '', '2016-12-05 13:13:58'),
(112, 10, 3, 0, 0, 'project_activity_created', '', '2016-12-05 18:32:41'),
(113, 6, 3, 0, 0, 'project_activity_uploaded_file', 'UsbFix_Report.txt<br />text/plain', '2016-12-06 10:53:42'),
(114, 9, 3, 0, 0, 'project_activity_uploaded_file', 'DORKS.txt<br />text/plain', '2016-12-06 10:54:13'),
(115, 2, 3, 0, 0, 'project_activity_uploaded_file', '234864.jpg<br />image/jpeg', '2016-12-06 12:39:49'),
(116, 2, 3, 0, 0, 'project_activity_project_file_removed', '234864.jpg', '2016-12-06 12:40:18'),
(117, 2, 3, 0, 0, 'project_activity_uploaded_file', 'img_fjords_wide.jpg<br />image/jpeg', '2016-12-06 12:40:32'),
(118, 2, 3, 0, 0, 'project_activity_uploaded_file', 'deep-silver-logo.jpg<br />image/jpeg', '2016-12-06 12:40:53'),
(119, 2, 3, 0, 0, 'project_activity_uploaded_file', 'Sans-titre.png<br />image/png', '2016-12-06 12:43:01'),
(120, 3, 3, 0, 0, 'project_activity_uploaded_file', '234864.jpg<br />image/jpeg', '2016-12-06 15:30:57'),
(121, 3, 3, 0, 0, 'project_activity_uploaded_file', 'img_fjords_wide.jpg<br />image/jpeg', '2016-12-06 15:31:14'),
(122, 3, 3, 0, 0, 'project_activity_uploaded_file', 'img_mountains_wide.jpg<br />image/jpeg', '2016-12-06 15:31:22'),
(123, 3, 3, 0, 0, 'project_activity_uploaded_file', 'large-image1.jpg<br />image/jpeg', '2016-12-06 15:31:31'),
(124, 3, 3, 0, 0, 'project_activity_uploaded_file', 'img_mountains_wide-1.jpg<br />image/jpeg', '2016-12-06 15:32:04'),
(125, 3, 3, 0, 0, 'project_activity_uploaded_file', 'pormo.jpg<br />image/jpeg', '2016-12-06 15:32:56'),
(126, 3, 3, 0, 0, 'project_activity_uploaded_file', 'large-image1-1.jpg<br />image/jpeg', '2016-12-06 15:33:06'),
(127, 3, 3, 0, 0, 'project_activity_uploaded_file', '4.4-slices-export_.zip<br />application/x-zip-compressed', '2016-12-06 15:33:37'),
(128, 3, 3, 0, 0, 'project_activity_project_file_removed', '4.4-slices-export_.zip', '2016-12-06 15:34:01'),
(129, 3, 3, 0, 0, 'project_activity_uploaded_file', '234864-1.jpg<br />image/jpeg', '2016-12-06 15:35:23'),
(130, 3, 3, 0, 0, 'project_activity_uploaded_file', 'pormo-1.jpg<br />image/jpeg', '2016-12-06 15:35:35'),
(131, 3, 3, 0, 0, 'project_activity_project_file_removed', '234864.jpg', '2016-12-06 15:40:09'),
(132, 3, 3, 0, 1, 'project_activity_created_discussion', 'Nouveau billet d\'assistance ouvert', '2016-12-08 16:41:15'),
(133, 3, 3, 0, 1, 'project_activity_uploaded_file', '1481056973_germany.png<br />image/png', '2016-12-08 16:42:31'),
(134, 3, 3, 0, 1, 'project_activity_commented_on_discussion', 'Nouveau billet d\'assistance ouvert', '2016-12-08 16:50:20'),
(135, 6, 3, 0, 1, 'project_activity_created_discussion', 'azery', '2016-12-08 16:56:32'),
(136, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-08 16:56:43'),
(137, 6, 3, 0, 1, 'project_activity_added_team_member', 'Ikram  naffah', '2016-12-09 11:06:31'),
(138, 6, 3, 0, 1, 'project_activity_added_team_member', 'Ahmed FaiÃ§al Aboullait', '2016-12-09 11:06:31'),
(139, 6, 3, 0, 1, 'project_activity_removed_team_member', 'Ikram  naffah', '2016-12-09 11:09:39'),
(140, 6, 3, 0, 1, 'project_activity_removed_team_member', 'Ilyess Abounaaim', '2016-12-09 11:09:45'),
(141, 6, 3, 0, 0, 'project_activity_new_task_assignee', 'Sujet Tache - Ahmed FaiÃ§al Aboullait', '2016-12-09 11:38:13'),
(142, 6, 3, 0, 0, 'project_activity_task_marked_complete', 'Sujet Tache', '2016-12-09 11:38:17'),
(143, 6, 3, 0, 0, 'project_activity_new_task_assignee', 'Sujet de la tache - Ahmed FaiÃ§al Aboullait', '2016-12-09 12:08:00'),
(144, 6, 3, 0, 0, 'project_activity_new_task_assignee', 'Sujet tach estimate  - Ahmed FaiÃ§al Aboullait', '2016-12-09 12:10:06'),
(145, 6, 3, 0, 0, 'project_activity_recorded_timesheet', '<seconds>787620</seconds><br /><lang>project_activity_task_name</lang> Sujet tach estimate ', '2016-12-09 12:14:18'),
(146, 6, 3, 0, 0, 'project_activity_task_assignee_removed', 'Sujet de la tache - Ahmed FaiÃ§al Aboullait', '2016-12-09 12:15:35'),
(147, 6, 3, 0, 0, 'project_activity_new_task_assignee', 'Sujet de la tache - Ahmed FaiÃ§al Aboullait', '2016-12-09 12:15:45'),
(148, 6, 3, 0, 1, 'project_activity_added_team_member', 'Ikram  naffah', '2016-12-09 12:16:57'),
(149, 6, 3, 0, 0, 'project_activity_new_task_assignee', 'new task - Ikram  naffah', '2016-12-09 12:17:06'),
(150, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 13:02:56'),
(151, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 13:04:44'),
(152, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 13:20:17'),
(153, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 13:28:22'),
(154, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 13:39:06'),
(155, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 13:42:42'),
(156, 6, 0, 6, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 13:50:24'),
(157, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 14:01:53'),
(158, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 14:05:14'),
(159, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 14:06:35'),
(160, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 14:08:30'),
(161, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 14:09:50'),
(162, 6, 0, 6, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 15:14:34'),
(163, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 15:16:55'),
(164, 6, 0, 6, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 15:24:51'),
(165, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 15:25:15'),
(166, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 15:26:08'),
(167, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 16:11:21'),
(168, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 16:13:40'),
(169, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 16:15:17'),
(170, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 16:15:37'),
(171, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 16:20:57'),
(172, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 16:21:34'),
(173, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 16:22:31'),
(174, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 16:24:49'),
(175, 6, 3, 0, 1, 'project_activity_commented_on_discussion', 'azery', '2016-12-09 18:23:54'),
(176, 3, 3, 0, 0, 'project_activity_project_file_removed', 'img_mountains_wide.jpg', '2017-01-13 12:23:03');

-- --------------------------------------------------------

--
-- Structure de la table `tblprojectdiscussioncomments`
--

CREATE TABLE `tblprojectdiscussioncomments` (
  `id` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `content` text NOT NULL,
  `staff_id` int(11) NOT NULL,
  `contact_id` int(11) DEFAULT '0',
  `full_name` varchar(300) DEFAULT NULL,
  `file_name` varchar(300) DEFAULT NULL,
  `file_mime_type` varchar(70) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblprojectdiscussioncomments`
--

INSERT INTO `tblprojectdiscussioncomments` (`id`, `discussion_id`, `parent`, `created`, `modified`, `content`, `staff_id`, `contact_id`, `full_name`, `file_name`, `file_mime_type`) VALUES
(1, 2, NULL, '2016-10-25 16:33:46', NULL, 'this is a comment ', 6, 0, NULL, NULL, NULL),
(2, 2, NULL, '2016-10-25 17:39:35', NULL, 'this is client description\n', 0, 6, 'Ayman EL HAOUARI', NULL, NULL),
(3, 2, NULL, '2016-10-25 17:43:19', NULL, '', 6, 0, NULL, '1.jpg', ''),
(4, 2, 2, '2016-10-25 17:59:00', NULL, 'respond !!', 6, 0, NULL, NULL, NULL),
(5, 2, NULL, '2016-10-27 15:52:05', NULL, 'finally , ', 6, 0, NULL, NULL, NULL),
(6, 2, NULL, '2016-10-27 15:54:23', NULL, 'azrerazrr', 6, 0, NULL, NULL, NULL),
(7, 2, 2, '2016-10-27 18:17:29', NULL, 'Allo \n', 6, 0, NULL, NULL, NULL),
(8, 3, NULL, '2016-12-08 16:50:20', NULL, 'azerty', 3, 0, NULL, NULL, NULL),
(9, 4, NULL, '2016-12-08 16:56:42', NULL, 'shgsfghdfgh', 3, 0, NULL, NULL, NULL),
(10, 4, NULL, '2016-12-09 13:02:54', '2016-12-09 16:21:48', 'new commqsdqsdqsdqsdsq', 3, 0, NULL, NULL, NULL),
(11, 4, NULL, '2016-12-09 13:04:44', NULL, 'new comment', 3, 0, NULL, NULL, NULL),
(12, 4, NULL, '2016-12-09 13:20:17', NULL, 'azerrtry', 3, 0, NULL, NULL, NULL),
(13, 4, NULL, '2016-12-09 13:28:21', NULL, 'tata toto ', 3, 0, NULL, NULL, NULL),
(14, 4, NULL, '2016-12-09 13:39:03', NULL, 'toto agaiiiiiiiiiiiin ', 3, 0, NULL, NULL, NULL),
(15, 4, NULL, '2016-12-09 13:42:38', NULL, 'maybe the last one ', 3, 0, NULL, NULL, NULL),
(16, 4, NULL, '2016-12-09 13:50:20', NULL, 'comment', 0, 6, 'Ayman EL HAOUARI', NULL, NULL),
(17, 4, NULL, '2016-12-09 14:01:49', NULL, 'zrgezqgsdggq', 3, 0, NULL, NULL, NULL),
(18, 4, NULL, '2016-12-09 14:05:10', NULL, 'szqrsgqgqdfgdqddgfqfg', 3, 0, NULL, NULL, NULL),
(19, 4, NULL, '2016-12-09 14:06:32', NULL, 'wcbxcnmjhkgfsfs', 3, 0, NULL, NULL, NULL),
(20, 4, NULL, '2016-12-09 14:08:26', NULL, 'wcbxcnmjhkgfsfswcvwxcvxwv', 3, 0, NULL, NULL, NULL),
(21, 4, NULL, '2016-12-09 14:09:47', NULL, 'wcbxcnmjhkgfsfswcvwxcvxwvsdfhshdg', 3, 0, NULL, NULL, NULL),
(22, 4, NULL, '2016-12-09 15:14:31', NULL, 'you sayy ', 0, 6, 'Ayman EL HAOUARI', NULL, NULL),
(23, 4, NULL, '2016-12-09 15:16:52', NULL, 'qsdcsdcq', 3, 0, NULL, NULL, NULL),
(24, 4, NULL, '2016-12-09 15:24:48', NULL, 'zerarezarezar', 0, 6, 'Ayman EL HAOUARI', NULL, NULL),
(25, 4, NULL, '2016-12-09 15:25:11', NULL, 'azerzaerzare', 3, 0, NULL, NULL, NULL),
(26, 4, NULL, '2016-12-09 15:26:05', NULL, 'azerazerazerty', 3, 0, NULL, NULL, NULL),
(27, 4, NULL, '2016-12-09 16:11:18', NULL, 'cause we got it ', 3, 0, NULL, NULL, NULL),
(28, 4, NULL, '2016-12-09 16:13:36', NULL, 'we got something else ', 3, 0, NULL, NULL, NULL),
(29, 4, NULL, '2016-12-09 16:15:13', NULL, 'qfsfqfsfsqf', 3, 0, NULL, NULL, NULL),
(30, 4, NULL, '2016-12-09 16:15:34', NULL, 'qfsfqfsfsqfdsf', 3, 0, NULL, NULL, NULL),
(31, 4, NULL, '2016-12-09 16:20:53', NULL, 'sdhshdfhsfh', 3, 0, NULL, NULL, NULL),
(32, 4, NULL, '2016-12-09 16:21:30', NULL, 'eraztertreterzt', 3, 0, NULL, NULL, NULL),
(33, 4, NULL, '2016-12-09 16:22:27', NULL, 'dsqfsdfsdfsdfgsd', 3, 0, NULL, NULL, NULL),
(34, 4, NULL, '2016-12-09 16:24:47', NULL, 'qdsdssdfsdf', 3, 0, NULL, NULL, NULL),
(35, 4, NULL, '2016-12-09 18:23:51', NULL, 'sdfgsdfg', 3, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblprojectdiscussions`
--

CREATE TABLE `tblprojectdiscussions` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `show_to_customer` tinyint(1) NOT NULL DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  `staff_id` int(11) NOT NULL DEFAULT '0',
  `contact_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblprojectdiscussions`
--

INSERT INTO `tblprojectdiscussions` (`id`, `project_id`, `subject`, `description`, `show_to_customer`, `datecreated`, `last_activity`, `staff_id`, `contact_id`) VALUES
(1, 1, 'mise a jour de la DBA', '', 1, '2016-09-05 00:08:52', NULL, 1, 0),
(2, 4, 'discussion Alami', 'Description from me to you ', 1, '2016-10-25 13:29:27', '2016-10-27 18:17:33', 6, 0),
(3, 3, 'Nouveau billet d\'assistance ouvert', '', 1, '2016-12-08 16:41:15', '2016-12-08 16:50:20', 3, 0),
(4, 6, 'azery', '', 1, '2016-12-08 16:56:30', '2016-12-09 18:23:54', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblprojectfiles`
--

CREATE TABLE `tblprojectfiles` (
  `id` int(11) NOT NULL,
  `file_name` mediumtext NOT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  `visible_to_customer` tinyint(1) DEFAULT '0',
  `staffid` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblprojectfiles`
--

INSERT INTO `tblprojectfiles` (`id`, `file_name`, `filetype`, `dateadded`, `project_id`, `visible_to_customer`, `staffid`, `contact_id`) VALUES
(1, 'ea1e755d.jpg', 'image/jpeg', '2016-09-14 17:19:23', 2, 0, 2, 0),
(2, '2.jpg', 'image/jpeg', '2016-10-25 15:48:00', 4, 1, 6, 0),
(3, 'cS-2.jpg', 'image/jpeg', '2016-10-25 15:51:24', 4, 1, 0, 6),
(4, 'large-image1.jpg', 'image/jpeg', '2016-10-25 15:53:14', 4, 1, 0, 6),
(5, 'cs-1.jpg', 'image/jpeg', '2016-10-26 17:34:39', 4, 1, 0, 6),
(8, 'pormo.jpg', 'image/jpeg', '2016-10-27 13:21:08', 4, 1, 6, 0),
(9, 'img_nature_wide.jpg', 'image/jpeg', '2016-10-27 13:22:44', 4, 1, 6, 0),
(10, 'img_mountains_wide.jpg', 'image/jpeg', '2016-10-27 13:25:00', 4, 1, 6, 0),
(11, 'deep-silver-logo.jpg', 'image/jpeg', '2016-10-27 13:29:10', 4, 1, 6, 0),
(12, 'cs-1-1.jpg', 'image/jpeg', '2016-10-27 13:38:04', 4, 1, 6, 0),
(13, '2-1.jpg', 'image/jpeg', '2016-10-27 13:38:26', 4, 1, 6, 0),
(14, '2-2.jpg', 'image/jpeg', '2016-10-27 13:39:08', 4, 1, 6, 0),
(15, '1-1.jpg', 'image/jpeg', '2016-10-27 13:41:56', 4, 1, 6, 0),
(16, '3P-2.jpeg', 'image/jpeg', '2016-10-27 13:42:58', 4, 1, 6, 0),
(17, 'F-2016-000145-DEEPSILVER-32.pdf', 'application/pdf', '2016-10-27 17:10:09', 4, 1, 3, 0),
(18, 'cS-2-1.jpg', 'image/jpeg', '2016-10-27 17:40:24', 4, 1, 3, 0),
(19, 'codeigniter_tutorial.pdf', 'application/pdf', '2016-10-27 17:40:40', 4, 1, 3, 0),
(20, 'largeimage.jpg', 'image/jpeg', '2016-10-27 17:41:44', 4, 1, 3, 0),
(21, 'F-2016-000145-DEEPSILVER-24.pdf', 'application/pdf', '2016-10-27 17:42:47', 4, 1, 3, 0),
(22, 'F-2016-000145-DEEPSILVER-6.pdf', 'application/pdf', '2016-10-27 17:43:51', 4, 1, 6, 0),
(23, 'F-2016-000145-DEEPSILVER-21.pdf', 'application/pdf', '2016-10-27 17:45:13', 4, 1, 6, 0),
(24, 'F-2016-000145-DEEPSILVER-4.pdf', 'application/pdf', '2016-10-27 17:46:23', 4, 1, 6, 0),
(25, 'testt2.jpeg', 'image/jpeg', '2016-10-27 17:47:29', 4, 1, 6, 0),
(26, 'test1.jpeg', 'image/jpeg', '2016-10-27 18:15:45', 4, 1, 6, 0),
(27, 'testt2-1.jpeg', 'image/jpeg', '2016-10-27 18:16:19', 4, 1, 6, 0),
(28, 'DORKS.txt', 'text/plain', '2016-11-21 12:53:51', 6, 1, 3, 0),
(29, 'codeigniter_tutorial.pdf', 'application/pdf', '2016-11-21 13:21:50', 6, 1, 3, 0),
(30, 'codeigniter_tutorial-1.pdf', 'application/pdf', '2016-11-21 13:22:06', 6, 1, 3, 0),
(31, 'cs-1.jpg', 'image/jpeg', '2016-11-21 17:12:20', 6, 0, 3, 0),
(32, 'UsbFix_Report.txt', 'text/plain', '2016-12-06 10:53:42', 6, 1, 3, 0),
(33, 'DORKS.txt', 'text/plain', '2016-12-06 10:54:13', 9, 0, 3, 0),
(34, '1481056973_germany.png', 'image/png', '2016-12-08 16:42:31', 3, 1, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblprojectmembers`
--

CREATE TABLE `tblprojectmembers` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblprojectmembers`
--

INSERT INTO `tblprojectmembers` (`id`, `project_id`, `staff_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(4, 3, 2),
(5, 5, 1),
(6, 4, 6),
(7, 4, 3),
(8, 4, 2),
(16, 6, 3),
(10, 7, 6),
(13, 9, 6),
(15, 6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tblprojectnotes`
--

CREATE TABLE `tblprojectnotes` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblprojects`
--

CREATE TABLE `tblprojects` (
  `id` int(11) NOT NULL,
  `name` varchar(600) NOT NULL,
  `description` text,
  `status` int(11) NOT NULL DEFAULT '0',
  `clientid` int(11) NOT NULL,
  `contactid` int(11) NOT NULL,
  `billing_type` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `deadline` date NOT NULL,
  `project_created` date NOT NULL,
  `progress` int(11) DEFAULT '0',
  `progress_from_tasks` int(11) NOT NULL DEFAULT '1',
  `project_cost` decimal(11,2) DEFAULT NULL,
  `project_rate_per_hour` decimal(11,2) DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `suppliercontactid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblprojects`
--

INSERT INTO `tblprojects` (`id`, `name`, `description`, `status`, `clientid`, `contactid`, `billing_type`, `start_date`, `deadline`, `project_created`, `progress`, `progress_from_tasks`, `project_cost`, `project_rate_per_hour`, `addedfrom`, `supplierid`, `suppliercontactid`) VALUES
(1, 'VidÃ©o Bosch Car Service', 'Le projet doit &ecirc;tre boucl&eacute; avant la fin du moi d\'Aout L\'agence a un d&eacute;lai d\'une semaine apr&egrave;s r&eacute;ception des &eacute;l&eacute;ments client', 4, 1, 0, 1, '2016-09-10', '2016-09-26', '2016-09-04', 0, 1, '0.00', '0.00', 1, 2, 0),
(2, 'Personnalisation du CRM', '<ul>\r\n<li>Fonctionnalit&eacute;s:\r\n<ul>\r\n<li><strong>Ajout d&rsquo;image slider home screen (sous cat&eacute;gorie de utilitaire)</strong></li>\r\n</ul>\r\n</li>\r\n</ul>', 2, 2, 0, 2, '2016-09-07', '2016-09-30', '2016-09-06', 0, 1, '0.00', '8.00', 2, 0, 0),
(3, 'Testing contact see project', '', 2, 1, 0, 3, '2016-09-14', '2016-09-16', '2016-09-14', 100, 1, '0.00', '0.00', 2, 0, 0),
(4, 'Test', '', 4, 3, 7, 2, '2016-09-22', '2016-09-29', '2016-09-21', 100, 1, '0.00', '0.00', 2, 0, 0),
(5, 'projet1', '', 4, 3, 6, 1, '2016-10-11', '2016-11-05', '2016-10-21', 60, 1, '0.00', '0.00', 3, 2, 0),
(6, 'project_for_estimate', '', 2, 3, 7, 1, '2016-10-17', '2016-10-20', '2016-10-26', 0, 1, '16.00', '0.00', 6, 3, 0),
(7, '13', '', 2, 0, 0, 2, '2016-11-11', '2016-09-25', '2016-11-21', 0, 1, '0.00', '0.00', 3, 3, 0),
(9, 'TEST ON SERVER PROJECT', '', 3, 0, 0, 2, '2016-10-11', '2016-12-23', '2016-12-05', 100, 1, '0.00', '1234.00', 3, 3, 0),
(10, 'another project', '', 2, 0, 0, 3, '2016-12-15', '2016-12-31', '2016-12-05', 0, 1, '0.00', '0.00', 3, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblprojectsettings`
--

CREATE TABLE `tblprojectsettings` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblprojectsettings`
--

INSERT INTO `tblprojectsettings` (`id`, `project_id`, `name`, `value`) VALUES
(1, 1, 'view_tasks', 1),
(2, 1, 'comment_on_tasks', 1),
(3, 1, 'view_task_comments', 1),
(4, 1, 'view_task_attachments', 1),
(5, 1, 'view_task_checklist_items', 1),
(6, 1, 'upload_on_tasks', 1),
(7, 1, 'view_task_total_logged_time', 1),
(8, 1, 'view_finance_overview', 1),
(9, 1, 'upload_files', 1),
(10, 1, 'open_discussions', 1),
(11, 1, 'view_milestones', 1),
(12, 1, 'view_gantt', 1),
(13, 1, 'view_timesheets', 1),
(14, 1, 'view_activity_log', 1),
(15, 1, 'view_team_members', 1),
(16, 2, 'view_tasks', 0),
(17, 2, 'comment_on_tasks', 0),
(18, 2, 'view_task_comments', 0),
(19, 2, 'view_task_attachments', 0),
(20, 2, 'view_task_checklist_items', 0),
(21, 2, 'upload_on_tasks', 0),
(22, 2, 'view_task_total_logged_time', 0),
(23, 2, 'view_finance_overview', 0),
(24, 2, 'upload_files', 0),
(25, 2, 'open_discussions', 0),
(26, 2, 'view_milestones', 0),
(27, 2, 'view_gantt', 0),
(28, 2, 'view_timesheets', 0),
(29, 2, 'view_activity_log', 0),
(30, 2, 'view_team_members', 0),
(31, 3, 'view_tasks', 1),
(32, 3, 'comment_on_tasks', 1),
(33, 3, 'view_task_comments', 1),
(34, 3, 'view_task_attachments', 1),
(35, 3, 'view_task_checklist_items', 1),
(36, 3, 'upload_on_tasks', 1),
(37, 3, 'view_task_total_logged_time', 1),
(38, 3, 'view_finance_overview', 1),
(39, 3, 'upload_files', 1),
(40, 3, 'open_discussions', 1),
(41, 3, 'view_milestones', 1),
(42, 3, 'view_gantt', 1),
(43, 3, 'view_timesheets', 1),
(44, 3, 'view_activity_log', 1),
(45, 3, 'view_team_members', 1),
(46, 4, 'view_tasks', 1),
(47, 4, 'comment_on_tasks', 1),
(48, 4, 'view_task_comments', 1),
(49, 4, 'view_task_attachments', 1),
(50, 4, 'view_task_checklist_items', 1),
(51, 4, 'upload_on_tasks', 1),
(52, 4, 'view_task_total_logged_time', 1),
(53, 4, 'view_finance_overview', 1),
(54, 4, 'upload_files', 1),
(55, 4, 'open_discussions', 1),
(56, 4, 'view_milestones', 1),
(57, 4, 'view_gantt', 1),
(58, 4, 'view_timesheets', 1),
(59, 4, 'view_activity_log', 1),
(60, 4, 'view_team_members', 1),
(61, 5, 'view_tasks', 1),
(62, 5, 'comment_on_tasks', 1),
(63, 5, 'view_task_comments', 1),
(64, 5, 'view_task_attachments', 1),
(65, 5, 'view_task_checklist_items', 1),
(66, 5, 'upload_on_tasks', 1),
(67, 5, 'view_task_total_logged_time', 1),
(68, 5, 'view_finance_overview', 1),
(69, 5, 'upload_files', 1),
(70, 5, 'open_discussions', 1),
(71, 5, 'view_milestones', 1),
(72, 5, 'view_gantt', 1),
(73, 5, 'view_timesheets', 1),
(74, 5, 'view_activity_log', 1),
(75, 5, 'view_team_members', 1),
(76, 6, 'view_tasks', 1),
(77, 6, 'comment_on_tasks', 1),
(78, 6, 'view_task_comments', 1),
(79, 6, 'view_task_attachments', 1),
(80, 6, 'view_task_checklist_items', 1),
(81, 6, 'upload_on_tasks', 1),
(82, 6, 'view_task_total_logged_time', 1),
(83, 6, 'view_finance_overview', 1),
(84, 6, 'upload_files', 1),
(85, 6, 'open_discussions', 1),
(86, 6, 'view_milestones', 1),
(87, 6, 'view_gantt', 1),
(88, 6, 'view_timesheets', 1),
(89, 6, 'view_activity_log', 1),
(90, 6, 'view_team_members', 1),
(91, 7, 'view_tasks', 1),
(92, 7, 'comment_on_tasks', 1),
(93, 7, 'view_task_comments', 1),
(94, 7, 'view_task_attachments', 1),
(95, 7, 'view_task_checklist_items', 1),
(96, 7, 'upload_on_tasks', 1),
(97, 7, 'view_task_total_logged_time', 1),
(98, 7, 'view_finance_overview', 1),
(99, 7, 'upload_files', 1),
(100, 7, 'open_discussions', 1),
(101, 7, 'view_milestones', 1),
(102, 7, 'view_gantt', 1),
(103, 7, 'view_timesheets', 1),
(104, 7, 'view_activity_log', 1),
(105, 7, 'view_team_members', 1),
(131, 9, 'view_milestones', 1),
(130, 9, 'open_discussions', 1),
(129, 9, 'upload_files', 1),
(128, 9, 'view_finance_overview', 1),
(127, 9, 'view_task_total_logged_time', 1),
(126, 9, 'upload_on_tasks', 1),
(125, 9, 'view_task_checklist_items', 1),
(124, 9, 'view_task_attachments', 1),
(123, 9, 'view_task_comments', 1),
(122, 9, 'comment_on_tasks', 1),
(121, 9, 'view_tasks', 1),
(132, 9, 'view_gantt', 1),
(133, 9, 'view_timesheets', 1),
(134, 9, 'view_activity_log', 1),
(135, 9, 'view_team_members', 1),
(136, 10, 'view_tasks', 1),
(137, 10, 'comment_on_tasks', 1),
(138, 10, 'view_task_comments', 1),
(139, 10, 'view_task_attachments', 1),
(140, 10, 'view_task_checklist_items', 1),
(141, 10, 'upload_on_tasks', 1),
(142, 10, 'view_task_total_logged_time', 1),
(143, 10, 'view_finance_overview', 1),
(144, 10, 'upload_files', 1),
(145, 10, 'open_discussions', 1),
(146, 10, 'view_milestones', 1),
(147, 10, 'view_gantt', 1),
(148, 10, 'view_timesheets', 1),
(149, 10, 'view_activity_log', 1),
(150, 10, 'view_team_members', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tblproposalcomments`
--

CREATE TABLE `tblproposalcomments` (
  `id` int(11) NOT NULL,
  `content` mediumtext,
  `proposalid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblproposals`
--

CREATE TABLE `tblproposals` (
  `id` int(11) NOT NULL,
  `subject` varchar(500) DEFAULT NULL,
  `content` longtext,
  `addedfrom` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `open_till` date DEFAULT NULL,
  `date` date NOT NULL,
  `rel_id` int(11) DEFAULT NULL,
  `rel_type` varchar(40) DEFAULT NULL,
  `assigned` int(11) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `proposal_to` varchar(600) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `allow_comments` tinyint(1) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL,
  `estimate_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `date_converted` datetime DEFAULT NULL,
  `pipeline_order` int(11) NOT NULL DEFAULT '0',
  `is_expiry_notified` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblproposals`
--

INSERT INTO `tblproposals` (`id`, `subject`, `content`, `addedfrom`, `datecreated`, `total`, `currency`, `open_till`, `date`, `rel_id`, `rel_type`, `assigned`, `hash`, `proposal_to`, `address`, `email`, `phone`, `allow_comments`, `status`, `estimate_id`, `invoice_id`, `date_converted`, `pipeline_order`, `is_expiry_notified`) VALUES
(1, 'proposition', NULL, 3, '2016-10-21 17:27:48', '0.00', 3, '2016-11-09', '2016-10-12', 3, 'customer', 1, '480d317abc0fa7a3dd5fa45e2ef9b9a4', 'Ayman\'s Company', 'Yours', 'elhaouari.ayman@gmail.com', '+212 698814480', 0, 3, NULL, 92, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblpurchase`
--

CREATE TABLE `tblpurchase` (
  `id_purchase` int(11) NOT NULL,
  `Reference` varchar(20) DEFAULT NULL,
  `Titre` varchar(50) DEFAULT NULL,
  `TVA` int(11) DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `id_project` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tblpurchase`
--

INSERT INTO `tblpurchase` (`id_purchase`, `Reference`, `Titre`, `TVA`, `montant`, `id_project`) VALUES
(1, 'T2584', 'TTT', 20, 125630.2, 5),
(2, 'dsqfqds', 'qdsqdsq', 2545, 425424, 5),
(3, 'fghfg', 'jghjghj', 441, 23132133, 5),
(4, 'sanaa', 'sanaa', 12, 12335, 5),
(5, 'gsffsf', 'dfsfds', 3527, 2542725, 5),
(68, '123', '13shd', 14, 0, NULL),
(72, '123', '13shd', 14, 0, 2),
(73, 'fbwxc', 'wxcb', 0, 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tblpurchase_file`
--

CREATE TABLE `tblpurchase_file` (
  `id` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `attachment` text NOT NULL,
  `filetype` varchar(50) NOT NULL,
  `dateadd` datetime NOT NULL,
  `visible_to_customer` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tblpurchase_file`
--

INSERT INTO `tblpurchase_file` (`id`, `id_purchase`, `attachment`, `filetype`, `dateadd`, `visible_to_customer`, `staffid`, `contact_id`) VALUES
(1, 2, 'templatemo_image_05.jpg', 'image/jpeg', '2016-11-04 12:55:35', 0, 3, 0),
(3, 1, 'templatemo_image_03-1.jpg', 'image/jpeg', '2016-11-04 13:14:06', 0, 3, 0),
(5, 3, 'templatemo_image_06.jpg', 'image/jpeg', '2016-11-04 13:17:07', 0, 3, 0),
(6, 4, 'tooplate_image_05.jpg', 'image/jpeg', '2016-11-04 13:31:08', 0, 3, 0),
(7, 5, 'templatemo_image_02-1.jpg', 'image/jpeg', '2016-11-04 17:01:41', 0, 3, 0),
(9, 69, 'img_fjords_wide.jpg', 'image/jpeg', '2016-12-06 12:40:32', 0, 3, 0),
(10, 71, 'deep-silver-logo.jpg', 'image/jpeg', '2016-12-06 12:40:53', 0, 3, 0),
(11, 69, 'Sans-titre.png', 'image/png', '2016-12-06 12:43:01', 0, 3, 0),
(13, 74, 'img_fjords_wide.jpg', 'image/jpeg', '2016-12-06 15:31:14', 0, 3, 0),
(15, 74, 'large-image1.jpg', 'image/jpeg', '2016-12-06 15:31:31', 0, 3, 0),
(16, 74, 'img_mountains_wide-1.jpg', 'image/jpeg', '2016-12-06 15:32:04', 0, 3, 0),
(17, 74, 'pormo.jpg', 'image/jpeg', '2016-12-06 15:32:56', 0, 3, 0),
(18, 74, 'large-image1-1.jpg', 'image/jpeg', '2016-12-06 15:33:06', 0, 3, 0),
(20, 74, '234864-1.jpg', 'image/jpeg', '2016-12-06 15:35:23', 0, 3, 0),
(21, 74, 'pormo-1.jpg', 'image/jpeg', '2016-12-06 15:35:35', 0, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblreminders`
--

CREATE TABLE `tblreminders` (
  `id` int(11) NOT NULL,
  `description` text,
  `date` datetime NOT NULL,
  `isnotified` int(11) NOT NULL DEFAULT '0',
  `rel_id` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `rel_type` varchar(40) NOT NULL,
  `notify_by_email` int(11) NOT NULL DEFAULT '1',
  `creator` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblreminders`
--

INSERT INTO `tblreminders` (`id`, `description`, `date`, `isnotified`, `rel_id`, `staff`, `rel_type`, `notify_by_email`, `creator`) VALUES
(1, '', '2016-11-21 17:47:00', 1, 3, 3, 'supplier', 1, 3),
(2, '', '2016-11-21 16:48:00', 1, 3, 3, 'supplier', 1, 3),
(3, '', '2016-11-21 16:50:00', 1, 3, 3, 'customer', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tblrolepermissions`
--

CREATE TABLE `tblrolepermissions` (
  `rolepermissionid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `can_view` tinyint(1) NOT NULL DEFAULT '0',
  `can_edit` tinyint(1) DEFAULT '0',
  `can_create` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '0',
  `permissionid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblroles`
--

CREATE TABLE `tblroles` (
  `roleid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblroles`
--

INSERT INTO `tblroles` (`roleid`, `name`) VALUES
(1, 'Employee');

-- --------------------------------------------------------

--
-- Structure de la table `tblsalesattachments`
--

CREATE TABLE `tblsalesattachments` (
  `id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(15) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `filetype` varchar(25) NOT NULL,
  `datecreated` datetime NOT NULL,
  `attachment_key` varchar(32) NOT NULL,
  `visible_to_customer` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblsalesattachments`
--

INSERT INTO `tblsalesattachments` (`id`, `rel_id`, `rel_type`, `file_name`, `filetype`, `datecreated`, `attachment_key`, `visible_to_customer`) VALUES
(1, 10, 'invoice', 'cs-1.jpg', 'image/jpeg', '2016-11-22 18:17:05', '1921ece860c8d18061c6cc226e24fc27', 1),
(4, 0, 'undefined', 'cS-2.jpg', 'image/jpeg', '2016-11-24 16:30:46', 'c8781f5d4d7f94ecd36d3a8d37fdb53d', 0),
(3, 12, 'invoice', 'cs-1.jpg', 'image/jpeg', '2016-11-23 11:31:05', 'ca1a0999c6525210b765576cf88d4c43', 0),
(5, 2, 'invoice', 'cS-2.jpg', 'image/jpeg', '2016-11-24 16:47:21', 'eaf9ce68860de7490583fcfcc2b9c284', 0),
(6, 2, 'invoice', 'cS-2-1.jpg', 'image/jpeg', '2016-11-24 16:48:40', 'b1065cf8d8b24dbc5a1569b4f6ccf407', 0),
(7, 1, 'invoice', 'cS-2.jpg', 'image/jpeg', '2016-11-24 16:49:47', 'ff76c094648c8e1b337bec6d6abbfb3a', 0),
(8, 12, 'invoice', 'deep-silver-logo.jpg', 'image/jpeg', '2016-11-24 16:56:34', '183028779bd89cbcc906219070f8f4a6', 0),
(9, 0, 'invoice', 'img_fjords_wide.jpg', 'image/jpeg', '2016-11-24 16:58:11', '649d1ebc8d64edc801aa33a0872b3ffb', 0),
(10, 1, 'invoice', 'largeimage.jpg', 'image/jpeg', '2016-11-24 17:19:22', '9feb8e7e44796416accac5a75b7b3e82', 0),
(11, 10, 'invoice', 'img_nature_wide.jpg', 'image/jpeg', '2016-11-24 17:38:03', '355bd34b4d2f2510bab65e6662da3256', 0),
(12, 0, 'invoice', 'img_mountains_wide.jpg', 'image/jpeg', '2016-11-24 17:42:01', '120c63dc894b9cfafd968dd3505533a2', 0),
(13, 1, 'invoice', '2.jpg', 'image/jpeg', '2016-11-24 17:48:42', 'c6d2fa891c0f618a94ea7e9b1fd54827', 0),
(14, 1, 'invoice', '3P-2.jpeg', 'image/jpeg', '2016-11-24 17:51:14', '6170a365c0037f772b9a447d182575b5', 0),
(15, 1, 'invoice', '21.jpg', 'image/jpeg', '2016-11-24 17:52:58', '12b89215f419e1a51a10bfe31e8204ec', 0),
(16, 25, 'invoice', 'cs-1-5.jpg', 'image/jpeg', '2016-11-24 18:02:34', 'f5636ac10d12bbfc6af38b40d062a5a8', 0),
(35, 49, 'invoice', 'F-2016-000145-DEEPSILVER-7.pdf', 'application/pdf', '2016-11-28 17:44:03', '470f02adda4067fcad1829d74a5445c3', 0),
(19, 0, 'invoice', 'cs-1.jpg', 'image/jpeg', '2016-11-24 18:04:53', 'b26a17011d61a954e023a6394b6ddee4', 0),
(20, 0, 'invoice', 'F-2016-000145-DEEPSILVER-31.pdf', 'application/pdf', '2016-11-24 18:05:41', 'd4c9c0145fe676de913ba997dc6612a4', 0),
(21, 0, 'invoice', 'F-2016-000145-DEEPSILVER-26.pdf', 'application/pdf', '2016-11-24 18:06:47', 'a7298cd02ed28bdd8fdb68ab128affde', 0),
(22, 0, 'invoice', 'html5_css3.txt', 'text/plain', '2016-11-24 18:07:37', '45714bcdb52c3f467e9379a787309630', 0),
(23, 1, 'invoice', 'supplier_invoices.pdf', 'application/pdf', '2016-11-24 18:07:56', 'ba1c95ebe6073951416563d056debc54', 0),
(24, 42, 'invoice', 'supplier_invoices.pdf', 'application/pdf', '2016-11-24 18:10:02', 'e96df939250568382c02a411b74c5281', 0),
(25, 44, 'invoice', 'F-2016-000145-DEEPSILVER-30.pdf', 'application/pdf', '2016-11-24 18:11:00', '3b0fa3a3ecab40532afd2a46d0003638', 0),
(26, 45, 'invoice', 'F-2016-000145-DEEPSILVER-26.pdf', 'application/pdf', '2016-11-24 18:24:42', 'f253532c78b8f0e19c5d8c4c2eb3aa87', 0),
(27, 46, 'invoice', 'F-2016-000145.pdf', 'application/pdf', '2016-11-24 18:25:21', 'ea7f818848da53e9b0da07567f532836', 0),
(28, 46, 'invoice', 'testt2.jpeg', 'image/jpeg', '2016-11-24 18:25:35', '49ee8f22166003aed9b519454baa5bb3', 0),
(29, 46, 'invoice', 'F-2016-000145-DEEPSILVER-6.pdf', 'application/pdf', '2016-11-24 18:26:58', '6a6b4a319ed75831471818fe6a67956d', 0),
(30, 47, 'invoice', 'ATSCAN-master-1.zip', 'application/x-zip-compres', '2016-11-24 18:27:43', '6ffa1f97a9e261b1e7ff1c4ab9b0e3b1', 0),
(31, 48, 'invoice', 'F-2016-000145-DEEPSILVER-16.pdf', 'application/pdf', '2016-11-24 18:28:48', '46df900a7c55d112e4b189b5382b23b2', 0),
(32, 49, 'invoice', 'F-2016-000145-DEEPSILVER-1.pdf', 'application/pdf', '2016-11-28 12:43:04', 'ab7a6253a5e08ee2c3cda5b011fd7706', 0),
(33, 11, 'invoice', 'F-2016-000145-DEEPSILVER-9.pdf', 'application/pdf', '2016-11-28 12:44:02', '4a6c79bd7126e34bccf5d63e580d0397', 0),
(34, 49, 'invoice', 'cs-1-6.jpg', 'image/jpeg', '2016-11-28 13:04:52', 'd72a50881f7d71b24e30d1be8acb2abd', 0),
(36, 49, 'invoice', 'F-2016-000145-DEEPSILVER-31.pdf', 'application/pdf', '2016-11-29 10:51:31', 'dff2e6dfd669fc6fb3207a1d3313273a', 0),
(37, 87, 'invoice', '2.jpg', 'image/jpeg', '2016-11-29 16:23:40', '2d1a06cfc9d4b44f860e2ef024f30a2d', 0),
(38, 87, 'invoice', 'F-2016-000145-DEEPSILVER-30.pdf', 'application/pdf', '2016-11-29 16:24:09', '4eb17374221aac015151fa38519ac48a', 0),
(39, 87, 'invoice', 'F-2016-000145-DEEPSILVER-2.pdf', 'application/pdf', '2016-11-29 16:25:17', 'a02eefecf6d3c071ff0ba2a9ba199c1d', 0),
(40, 0, 'invoice', '3P-2.jpeg', 'image/jpeg', '2016-11-29 16:52:39', 'a6d4d5cdbbeb8271003dd6f5bb4c8ac5', 0),
(41, 88, 'invoice', 'F-2016-000145-DEEPSILVER-14.pdf', 'application/pdf', '2016-11-29 16:56:35', '039aab0a7fb463af0c2453e3aa54cfcc', 0),
(42, 89, 'invoice', '2.jpg', 'image/jpeg', '2016-11-29 16:58:55', '917bc500e6038fa8297d7be4732e8e90', 0),
(43, 90, 'invoice', 'testt1.jpeg', 'image/jpeg', '2016-11-30 13:49:46', '1af1da67870c5e2735b394c2c09ec30e', 0),
(44, 91, 'invoice', 'table-client.txt', 'text/plain', '2016-12-05 12:49:35', '3b80c43ddbed970f79cf9bc7b204fb36', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblservices`
--

CREATE TABLE `tblservices` (
  `serviceid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblsliders`
--

CREATE TABLE `tblsliders` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `effect` varchar(200) NOT NULL,
  `position` smallint(5) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `right_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tblsliders`
--

INSERT INTO `tblsliders` (`id`, `name`, `image`, `effect`, `position`, `active`, `right_user`) VALUES
(47, 'No_name', 'uk-2.png', 'linear', 0, 1, 0),
(46, 'No_name', 'uk-1.png', 'linear', 0, 1, 0),
(44, 'uk125', 'deep-silver-logo.jpg', 'ease-in', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblstaff`
--

CREATE TABLE `tblstaff` (
  `staffid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email_alami` varchar(100) NOT NULL,
  `firstname_alami` varchar(50) NOT NULL,
  `lastname_alami` varchar(50) NOT NULL,
  `facebook` mediumtext,
  `linkedin` mediumtext,
  `phonenumber` varchar(30) DEFAULT NULL,
  `skype` varchar(50) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `datecreated` datetime NOT NULL,
  `profile_image` varchar(300) DEFAULT NULL,
  `last_ip` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_password_change` datetime DEFAULT NULL,
  `new_pass_key` varchar(32) DEFAULT NULL,
  `new_pass_key_requested` datetime DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `role` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `default_language` varchar(40) DEFAULT NULL,
  `media_path_slug` varchar(300) DEFAULT NULL,
  `is_not_staff` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblstaff`
--

INSERT INTO `tblstaff` (`staffid`, `email`, `firstname`, `lastname`, `email_alami`, `firstname_alami`, `lastname_alami`, `facebook`, `linkedin`, `phonenumber`, `skype`, `password`, `datecreated`, `profile_image`, `last_ip`, `last_login`, `last_password_change`, `new_pass_key`, `new_pass_key_requested`, `admin`, `role`, `active`, `default_language`, `media_path_slug`, `is_not_staff`) VALUES
(2, 'f.aboullait@deepmaroc.com', 'Ahmed FaiÃ§al', 'Aboullait', 'adamdeepsilver@alami.com', 'Adam ', 'Alami', 'https://www.facebook.com/af.aboullait', '', '', 'sdsdfs', '$2a$08$f8dNso5qLhh9/Z0thpJOUuHuxOP9vznDd4WJlBwMejWhXmMH7C0/2', '2016-09-04 22:59:34', NULL, '105.156.2.77', '2016-09-29 14:55:20', '2016-09-09 18:33:42', '7bbbd9397abf3e445962644fc21b7fe1', '2016-09-23 12:55:18', 1, 1, 1, 'french', 'facial-aboullait', 0),
(3, 'ext.naffah@deepmaroc.com', 'Ikram', 'naffah', '', 'naffahalami', '', '', '', '', '', '$2a$08$jKaQujUp4d6.z8pnpTQd6.y2bDaHFhjD.AafkUjqjhisiYNO07Oji', '2016-09-06 16:16:16', NULL, '::1', '2017-01-16 16:13:07', '2016-11-01 15:14:40', NULL, NULL, 1, 1, 1, 'french', 'ikram-naffah', 0),
(6, 'i.ab@deepmaroc.com', 'Ilyess', 'Abounaaim', 'emailAlamai@deepmaroc.com', 'firstAlami', 'lastAlami', '', '', '', 'ext.naffah@deepmaroc.com', '$2a$08$RI1aFBBgftXfvzTccTgwOOHU2bxnlhSglewIX9Frex5Haf8fqf9L.', '2016-10-24 12:22:25', NULL, '::1', '2016-12-07 11:14:52', '2016-10-24 12:22:47', NULL, NULL, 1, 1, 1, 'french', 'ilyess-abounaaim', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblstaffdepartments`
--

CREATE TABLE `tblstaffdepartments` (
  `staffdepartmentid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `departmentid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblstaffdepartments`
--

INSERT INTO `tblstaffdepartments` (`staffdepartmentid`, `staffid`, `departmentid`) VALUES
(6, 6, 3),
(5, 6, 2),
(4, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tblstaffpermissions`
--

CREATE TABLE `tblstaffpermissions` (
  `staffpermid` int(11) NOT NULL,
  `permissionid` int(11) NOT NULL,
  `can_view` tinyint(1) NOT NULL DEFAULT '1',
  `can_edit` tinyint(1) NOT NULL DEFAULT '1',
  `can_create` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '0',
  `staffid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblstafftaskassignees`
--

CREATE TABLE `tblstafftaskassignees` (
  `id` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `assigned_from` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblstafftaskassignees`
--

INSERT INTO `tblstafftaskassignees` (`id`, `staffid`, `taskid`, `assigned_from`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(4, 2, 4, 2),
(5, 6, 5, 6),
(6, 6, 6, 6),
(7, 6, 7, 6),
(8, 6, 8, 3),
(9, 2, 9, 3),
(10, 3, 10, 3),
(11, 3, 6, 3),
(14, 2, 11, 3),
(13, 2, 12, 3),
(15, 3, 13, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tblstafftaskcomments`
--

CREATE TABLE `tblstafftaskcomments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `taskid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `dateadded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblstafftaskcomments`
--

INSERT INTO `tblstafftaskcomments` (`id`, `content`, `taskid`, `staffid`, `contact_id`, `dateadded`) VALUES
(1, 'azeratrya', 5, 6, 0, '2016-10-25 16:49:25'),
(2, 'my comment client', 5, 0, 6, '2016-10-25 17:00:53'),
(3, 'Here\'s a commment&nbsp;', 5, 6, 0, '2016-10-25 17:37:41');

-- --------------------------------------------------------

--
-- Structure de la table `tblstafftasks`
--

CREATE TABLE `tblstafftasks` (
  `id` int(11) NOT NULL,
  `name` mediumtext,
  `description` text,
  `priority` int(11) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `startdate` date NOT NULL,
  `duedate` date DEFAULT NULL,
  `datefinished` datetime NOT NULL,
  `addedfrom` int(11) NOT NULL,
  `finished` int(11) NOT NULL DEFAULT '0',
  `rel_id` int(11) DEFAULT NULL,
  `rel_type` varchar(30) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `billable` tinyint(1) NOT NULL DEFAULT '0',
  `billed` tinyint(1) NOT NULL DEFAULT '0',
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `hourly_rate` decimal(11,2) NOT NULL DEFAULT '0.00',
  `milestone` int(11) DEFAULT '0',
  `visible_to_client` tinyint(1) NOT NULL DEFAULT '0',
  `deadline_notified` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblstafftasks`
--

INSERT INTO `tblstafftasks` (`id`, `name`, `description`, `priority`, `dateadded`, `startdate`, `duedate`, `datefinished`, `addedfrom`, `finished`, `rel_id`, `rel_type`, `is_public`, `billable`, `billed`, `invoice_id`, `hourly_rate`, `milestone`, `visible_to_client`, `deadline_notified`) VALUES
(1, 'enregistrement voix Off', 'faire en sorte que .....', 2, '2016-09-05 00:03:50', '2016-09-05', '2016-09-06', '2016-09-05 11:15:31', 1, 1, 1, 'project', 0, 1, 0, 0, '0.00', 0, 1, 0),
(2, 'post prod', 'un deux trois', 4, '2016-09-05 00:05:43', '2016-09-05', '2016-09-05', '2016-09-05 00:07:27', 1, 1, 1, 'project', 0, 1, 0, 0, '0.00', 0, 1, 0),
(3, 'Personnalisation du CRM', '', 4, '2016-09-06 15:50:05', '2016-09-07', '2016-09-30', '0000-00-00 00:00:00', 2, 0, 2, 'project', 0, 1, 0, 0, '0.00', 0, 1, 0),
(4, 'Ajout dâ€™image slider home screen ', 'Cette fonction permettra d&rsquo;uploader des images pour un slider qui sera sur la page de login (je vous en dirai plus plus bas), cette page doit permettre:<br /><br /><br />\r\n<ul><br />\r\n<ul><br />\r\n<li>l&rsquo;upload</li><br />\r\n</ul><br />\r\n</ul><br />\r\n<br /><br />\r\n<ul><br />\r\n<ul><br />\r\n<li>Download</li><br />\r\n</ul><br />\r\n</ul><br />\r\n<br /><br />\r\n<ul><br />\r\n<ul><br />\r\n<li>Rename</li><br />\r\n</ul><br />\r\n</ul><br />\r\n<br /><br />\r\n<ul><br />\r\n<ul><br />\r\n<li>Order/reOrdre</li><br />\r\n</ul><br />\r\n</ul><br />\r\n<br /><br />\r\n<ul><br />\r\n<ul><br />\r\n<li>Delete</li><br />\r\n</ul><br />\r\n</ul><br />\r\n<br /><br />\r\n<ul><br />\r\n<ul><br />\r\n<li>Activate/disable</li><br />\r\n</ul><br />\r\n</ul>', 1, '2016-09-06 16:13:59', '2016-09-06', '2016-09-07', '0000-00-00 00:00:00', 2, 0, 2, 'project', 0, 1, 0, 0, '0.00', 0, 1, 0),
(5, 'CRMmodification', 'rtezryteryteyrtyeryt', 1, '2016-10-25 13:32:32', '2016-10-25', '2016-09-29', '2016-10-26 12:54:45', 6, 1, 4, 'project', 0, 1, 1, 6, '0.00', 0, 1, 0),
(6, 'sujet tach', 'Description tache&nbsp;', 1, '2016-10-25 17:33:28', '2016-10-25', '2016-10-12', '0000-00-00 00:00:00', 6, 0, 23, 'ticket', 1, 1, 0, 0, '123.00', 0, 1, 0),
(7, 'sujet tach', 'Description tache&nbsp;', 1, '2016-10-25 17:33:58', '2016-10-25', '2016-11-07', '0000-00-00 00:00:00', 6, 0, 23, 'ticket', 1, 1, 0, 0, '123.00', 0, 1, 0),
(8, 'sujet', '', 1, '2016-12-08 16:36:12', '2016-12-08', NULL, '0000-00-00 00:00:00', 3, 0, 5, 'estimate', 1, 0, 0, 0, '0.00', 0, 0, 0),
(9, 'Sujet Tache', '', 3, '2016-12-09 11:36:49', '2016-12-09', '2016-12-31', '2016-12-09 11:38:17', 3, 1, 6, 'project', 0, 0, 0, 0, '12.00', 0, 0, 0),
(10, 'Sujet tache 2', '', 4, '2016-12-09 11:41:12', '2016-12-09', NULL, '0000-00-00 00:00:00', 3, 0, NULL, NULL, 0, 0, 0, 0, '12.00', 0, 0, 0),
(11, 'Sujet de la tache', '', 4, '2016-12-09 12:07:44', '2016-12-09', '2016-10-20', '0000-00-00 00:00:00', 3, 0, 6, 'project', 0, 0, 0, 0, '0.00', 0, 0, 0),
(12, 'Sujet tach estimate ', '', 1, '2016-12-09 12:10:01', '2016-12-09', '2016-10-20', '0000-00-00 00:00:00', 3, 0, 6, 'project', 0, 0, 0, 0, '0.00', 0, 0, 0),
(13, 'new task', '', 1, '2016-12-09 12:16:35', '2016-12-09', NULL, '0000-00-00 00:00:00', 3, 0, 6, 'project', 0, 0, 0, 0, '0.00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblstafftasksattachments`
--

CREATE TABLE `tblstafftasksattachments` (
  `id` int(11) NOT NULL,
  `file_name` mediumtext NOT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `taskid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL DEFAULT '0',
  `contact_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblstafftasksattachments`
--

INSERT INTO `tblstafftasksattachments` (`id`, `file_name`, `filetype`, `dateadded`, `taskid`, `staffid`, `contact_id`) VALUES
(1, 'Capture-dâ€™Ã©cran-2016-08-31-Ã -12.41_.18_.png', 'image/png', '2016-09-05 00:07:01', 2, 1, 0),
(2, '2.jpg', 'image/jpeg', '2016-10-25 16:56:43', 5, 6, 0),
(3, '3P-2.jpeg', 'image/jpeg', '2016-10-25 17:33:46', 6, 6, 0),
(4, '3P-2.jpeg', 'image/jpeg', '2016-10-25 17:33:58', 7, 6, 0),
(5, 'cs-1-1.jpg', 'image/jpeg', '2016-12-08 16:36:40', 8, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblstafftasksfollowers`
--

CREATE TABLE `tblstafftasksfollowers` (
  `id` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `taskid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblstafftasksfollowers`
--

INSERT INTO `tblstafftasksfollowers` (`id`, `staffid`, `taskid`) VALUES
(1, 2, 1),
(2, 2, 2),
(4, 6, 5),
(5, 6, 6),
(6, 6, 7),
(7, 6, 8),
(8, 3, 9),
(9, 3, 10),
(10, 3, 11),
(12, 6, 11),
(14, 6, 12),
(15, 3, 12);

-- --------------------------------------------------------

--
-- Structure de la table `tblsupplieradmins`
--

CREATE TABLE `tblsupplieradmins` (
  `staff_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date_assigned` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblsupplieradmins`
--

INSERT INTO `tblsupplieradmins` (`staff_id`, `supplier_id`, `date_assigned`) VALUES
(3, 2, '2016-12-05 18:17:25');

-- --------------------------------------------------------

--
-- Structure de la table `tblsupplierattachments`
--

CREATE TABLE `tblsupplierattachments` (
  `id` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `file_name` mediumtext NOT NULL,
  `filetype` varchar(25) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblsupplierattachments`
--

INSERT INTO `tblsupplierattachments` (`id`, `supplierid`, `file_name`, `filetype`, `datecreated`) VALUES
(15, 4, 'F-2016-000145-DEEPSILVER-16.pdf', 'application/pdf', '2016-11-28 12:12:25');

-- --------------------------------------------------------

--
-- Structure de la table `tblsuppliercontactpermissions`
--

CREATE TABLE `tblsuppliercontactpermissions` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblsuppliercontactprojects`
--

CREATE TABLE `tblsuppliercontactprojects` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tblsuppliercontacts`
--

CREATE TABLE `tblsuppliercontacts` (
  `id` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `is_primary` int(11) NOT NULL DEFAULT '1',
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `datecreated` datetime NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `new_pass_key` varchar(32) DEFAULT NULL,
  `new_pass_key_requested` datetime DEFAULT NULL,
  `last_ip` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_password_change` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `email_cc` tinyint(1) NOT NULL,
  `profile_image` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblsuppliercontacts`
--

INSERT INTO `tblsuppliercontacts` (`id`, `supplierid`, `is_primary`, `firstname`, `lastname`, `email`, `phonenumber`, `title`, `datecreated`, `password`, `new_pass_key`, `new_pass_key_requested`, `last_ip`, `last_login`, `last_password_change`, `active`, `email_cc`, `profile_image`) VALUES
(0, 3, 1, 'aezraz', 'azreez', 'aerr@aer.ce', 'ext.naffah@deepmaroc.com', '', '2016-11-09 17:18:57', '$2a$08$kf1w3yO6Rz6alWfC.jx5/el2IM7.YNLu917h4im/6vIofWHbUEPVO', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblsuppliergroups_in`
--

CREATE TABLE `tblsuppliergroups_in` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tblsuppliergroups_in`
--

INSERT INTO `tblsuppliergroups_in` (`id`, `supplier_id`, `groupid`) VALUES
(2, 5, 19);

-- --------------------------------------------------------

--
-- Structure de la table `tblsupplierinvoices`
--

CREATE TABLE `tblsupplierinvoices` (
  `id` int(11) NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `datesend` datetime DEFAULT NULL,
  `supplierid` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `date` date NOT NULL,
  `duedate` date DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `total_tax` decimal(11,2) NOT NULL DEFAULT '0.00',
  `total` decimal(11,2) NOT NULL,
  `adjustment` decimal(11,2) DEFAULT NULL,
  `addedfrom` int(11) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `status` int(11) DEFAULT '1',
  `adminnote` text,
  `last_overdue_reminder` date DEFAULT NULL,
  `allowed_payment_modes` mediumtext,
  `token` mediumtext,
  `discount_percent` decimal(11,2) DEFAULT '0.00',
  `discount_total` decimal(11,2) DEFAULT '0.00',
  `discount_type` varchar(30) NOT NULL,
  `recurring` int(11) NOT NULL DEFAULT '0',
  `recurring_ends_on` date DEFAULT NULL,
  `is_recurring_from` int(11) DEFAULT NULL,
  `last_recurring_date` date DEFAULT NULL,
  `terms` text,
  `sale_agent` int(11) NOT NULL DEFAULT '0',
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `show_shipping_on_invoice` tinyint(1) NOT NULL DEFAULT '1',
  `show_quantity_as` int(11) NOT NULL DEFAULT '1',
  `project_id` int(11) DEFAULT '0',
  `suppliernote` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblsuppliers`
--

CREATE TABLE `tblsuppliers` (
  `supplierid` int(11) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `vat` varchar(50) DEFAULT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `country` int(11) NOT NULL DEFAULT '0',
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `profile_image` varchar(300) DEFAULT NULL,
  `leadid` int(11) DEFAULT NULL,
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT '0',
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT '0',
  `longitude` varchar(300) DEFAULT NULL,
  `latitude` varchar(300) DEFAULT NULL,
  `default_language` varchar(40) DEFAULT NULL,
  `default_currency` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblsuppliers`
--

INSERT INTO `tblsuppliers` (`supplierid`, `company`, `vat`, `phonenumber`, `country`, `city`, `zip`, `state`, `address`, `datecreated`, `profile_image`, `leadid`, `billing_street`, `billing_city`, `billing_state`, `billing_zip`, `billing_country`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `longitude`, `latitude`, `default_language`, `default_currency`) VALUES
(2, 'Ayman Comp ', NULL, NULL, 2, '', NULL, NULL, NULL, '2016-11-09 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0),
(3, 'Supplier Test23', '12', '12346', 14, '', '', '', 'adress', '2016-11-09 11:13:46', NULL, NULL, '', '', '', '', 0, '', '', '', '', 1, '', '', 'english', 1),
(4, 'System V', '12', '0688996654', 0, '', '', '', '', '2016-11-09 11:24:19', '2.jpg', NULL, '', '', '', '', 0, '', '', '', '', 1, '', '', '', 0),
(5, 'TEST ON SERVER ', '123', '069854872', 16, '', '', '', '', '2016-12-05 12:48:31', NULL, NULL, '', '', '', '', 0, '', '', '', '', 0, '', '', 'english', 3);

-- --------------------------------------------------------

--
-- Structure de la table `tblsurveyquestionboxes`
--

CREATE TABLE `tblsurveyquestionboxes` (
  `boxid` int(11) NOT NULL,
  `boxtype` varchar(10) NOT NULL,
  `questionid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblsurveyquestionboxesdescription`
--

CREATE TABLE `tblsurveyquestionboxesdescription` (
  `questionboxdescriptionid` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `boxid` mediumtext NOT NULL,
  `questionid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblsurveyquestions`
--

CREATE TABLE `tblsurveyquestions` (
  `questionid` int(11) NOT NULL,
  `surveyid` int(11) NOT NULL,
  `question` mediumtext NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `question_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblsurveyresults`
--

CREATE TABLE `tblsurveyresults` (
  `resultid` int(11) NOT NULL,
  `boxid` int(11) NOT NULL,
  `boxdescriptionid` int(11) DEFAULT NULL,
  `surveyid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `answer` text,
  `resultsetid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblsurveyresultsets`
--

CREATE TABLE `tblsurveyresultsets` (
  `resultsetid` int(11) NOT NULL,
  `surveyid` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `useragent` varchar(150) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblsurveys`
--

CREATE TABLE `tblsurveys` (
  `surveyid` int(11) NOT NULL,
  `subject` mediumtext NOT NULL,
  `slug` mediumtext NOT NULL,
  `description` text NOT NULL,
  `viewdescription` text,
  `datecreated` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `redirect_url` varchar(100) DEFAULT NULL,
  `send` tinyint(1) NOT NULL DEFAULT '0',
  `onlyforloggedin` int(11) DEFAULT '0',
  `fromname` varchar(100) DEFAULT NULL,
  `iprestrict` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `hash` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblsurveys`
--

INSERT INTO `tblsurveys` (`surveyid`, `subject`, `slug`, `description`, `viewdescription`, `datecreated`, `creator`, `redirect_url`, `send`, `onlyforloggedin`, `fromname`, `iprestrict`, `active`, `hash`) VALUES
(1, 'sondage test ', 'sondage-test', '', 'description sondage test ', '2016-10-25 12:00:15', 3, '', 0, 0, '', 0, 1, 'a1924bda9b76fbb9dc3fb4fb98cdebf3');

-- --------------------------------------------------------

--
-- Structure de la table `tblsurveysemailsendcron`
--

CREATE TABLE `tblsurveysemailsendcron` (
  `id` int(11) NOT NULL,
  `surveyid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emailid` int(11) DEFAULT NULL,
  `listid` varchar(11) DEFAULT NULL,
  `log_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblsurveysendlog`
--

CREATE TABLE `tblsurveysendlog` (
  `id` int(11) NOT NULL,
  `surveyid` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `iscronfinished` int(11) NOT NULL DEFAULT '0',
  `send_to_mail_lists` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblsurveysendlog`
--

INSERT INTO `tblsurveysendlog` (`id`, `surveyid`, `total`, `date`, `iscronfinished`, `send_to_mail_lists`) VALUES
(1, 1, 4, '2016-10-25 12:00:27', 1, 'a:1:{i:0;s:7:"Clients";}');

-- --------------------------------------------------------

--
-- Structure de la table `tbltaskchecklists`
--

CREATE TABLE `tbltaskchecklists` (
  `id` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `finished` int(11) NOT NULL DEFAULT '0',
  `dateadded` datetime NOT NULL,
  `addedfrom` int(11) NOT NULL,
  `finished_from` int(11) DEFAULT '0',
  `list_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbltaskchecklists`
--

INSERT INTO `tbltaskchecklists` (`id`, `taskid`, `description`, `finished`, `dateadded`, `addedfrom`, `finished_from`, `list_order`) VALUES
(2, 3, '', 0, '2016-09-14 17:15:01', 2, 0, 1),
(3, 5, 'checkilist', 1, '2016-10-25 13:32:47', 6, 6, 1),
(4, 6, 'checked', 1, '2016-10-25 17:33:36', 6, 6, 1),
(5, 7, 'checked', 0, '2016-10-25 17:33:58', 6, 0, 1),
(6, 8, 'checklist', 1, '2016-12-08 16:36:22', 3, 3, 1),
(7, 12, '', 0, '2016-12-09 12:10:16', 3, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbltaskstimers`
--

CREATE TABLE `tbltaskstimers` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `start_time` varchar(64) NOT NULL,
  `end_time` varchar(64) DEFAULT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbltaskstimers`
--

INSERT INTO `tbltaskstimers` (`id`, `task_id`, `start_time`, `end_time`, `staff_id`) VALUES
(1, 5, '1476109200', '1476282000', 6),
(2, 5, '1477406931', '1477406935', 6),
(3, 5, '1477406954', '1477479238', 6),
(4, 10, '1481280113', NULL, 3),
(5, 6, '1481280229', NULL, 3),
(6, 12, '1482405180', '1483192800', 2),
(7, 13, '1481282228', NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tbltaxes`
--

CREATE TABLE `tbltaxes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `taxrate` decimal(11,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbltaxes`
--

INSERT INTO `tbltaxes` (`id`, `name`, `taxrate`) VALUES
(1, 'TVA', '20.00');

-- --------------------------------------------------------

--
-- Structure de la table `tblticketattachments`
--

CREATE TABLE `tblticketattachments` (
  `id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `replyid` int(11) DEFAULT NULL,
  `file_name` mediumtext NOT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblticketattachments`
--

INSERT INTO `tblticketattachments` (`id`, `ticketid`, `replyid`, `file_name`, `filetype`, `dateadded`) VALUES
(1, 23, NULL, '2.jpg', 'image/jpeg', '2016-10-25 17:07:08'),
(2, 23, 1, 'img_nature_wide.jpg', 'image/jpeg', '2016-10-25 17:16:37'),
(3, 24, NULL, '1481057351_hungary.png', 'image/png', '2016-12-09 11:28:46');

-- --------------------------------------------------------

--
-- Structure de la table `tblticketpipelog`
--

CREATE TABLE `tblticketpipelog` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `email_to` varchar(500) NOT NULL,
  `name` varchar(200) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` mediumtext NOT NULL,
  `email` varchar(300) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblticketreplies`
--

CREATE TABLE `tblticketreplies` (
  `id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `contactid` int(11) NOT NULL DEFAULT '0',
  `name` text,
  `email` text,
  `date` datetime NOT NULL,
  `message` text,
  `attachment` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `ip` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblticketreplies`
--

INSERT INTO `tblticketreplies` (`id`, `ticketid`, `userid`, `contactid`, `name`, `email`, `date`, `message`, `attachment`, `admin`, `ip`) VALUES
(1, 23, 3, 6, NULL, NULL, '2016-10-25 17:16:35', 'azeraezrt', NULL, NULL, '::1'),
(2, 23, 0, 0, NULL, NULL, '2016-10-25 17:24:43', '', NULL, 6, '::1');

-- --------------------------------------------------------

--
-- Structure de la table `tbltickets`
--

CREATE TABLE `tbltickets` (
  `ticketid` int(11) NOT NULL,
  `adminreplying` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL,
  `contactid` int(11) NOT NULL DEFAULT '0',
  `email` text,
  `name` text,
  `department` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `service` int(11) DEFAULT NULL,
  `ticketkey` varchar(32) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message` text,
  `admin` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `lastreply` datetime DEFAULT NULL,
  `clientread` int(11) NOT NULL DEFAULT '0',
  `adminread` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(40) DEFAULT NULL,
  `assigned` int(11) NOT NULL DEFAULT '0',
  `supplierid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbltickets`
--

INSERT INTO `tbltickets` (`ticketid`, `adminreplying`, `userid`, `contactid`, `email`, `name`, `department`, `priority`, `status`, `service`, `ticketkey`, `subject`, `message`, `admin`, `date`, `project_id`, `lastreply`, `clientread`, `adminread`, `ip`, `assigned`, `supplierid`) VALUES
(1, 0, 2, 3, NULL, NULL, 1, 2, 5, 0, '091aab2143463812de3f6288a7e0693d', 'logo', 'Bonjour, J\'ai un prob...', NULL, '2016-09-14 13:11:02', 2, NULL, 1, 1, '41.251.49.212', 0, 0),
(2, 0, 2, 3, NULL, NULL, 1, 2, 5, 0, 'e5f2e939c18b225361cfdfb534177ff5', 'ghfdgh', 'dfghdfg dfgh fdg', NULL, '2016-09-21 17:03:54', 2, NULL, 0, 0, '105.156.13.120', 0, 0),
(3, 0, 2, 3, NULL, NULL, 2, 1, 5, 0, '95861188c09a10f85c8351b1b597f840', 'cvncvn', 'xcncvn cv cgvcv', NULL, '2016-09-21 17:04:39', 2, NULL, 0, 0, '105.156.13.120', 0, 0),
(4, 0, 2, 3, NULL, NULL, 2, 1, 5, 0, 'dd2003f4e773483f865605faac8a588c', 'cvncvn', 'xcncvn cv cgvcv', NULL, '2016-09-21 17:05:16', 2, NULL, 0, 0, '105.156.13.120', 0, 0),
(5, 0, 2, 3, NULL, NULL, 2, 1, 5, 0, 'bfa78553d3448cb8c21714199c4f5afc', 'cvncvn', 'xcncvn cv cgvcv', NULL, '2016-09-21 17:05:31', 2, NULL, 0, 0, '105.156.13.120', 0, 0),
(6, 0, 2, 3, NULL, NULL, 2, 1, 5, 0, 'e5fc05c84cc33860fe8d6edf644e7604', 'cvncvn', 'xcncvn cv cgvcv', NULL, '2016-09-21 17:11:48', 2, NULL, 0, 0, '105.156.13.120', 0, 0),
(7, 0, 2, 3, NULL, NULL, 2, 1, 5, 0, '8e4e08846f432f89a14d69750f03c8a2', 'cvncvn', 'xcncvn cv cgvcv', NULL, '2016-09-21 17:16:04', 2, NULL, 0, 0, '105.156.13.120', 0, 0),
(8, 0, 2, 3, NULL, NULL, 2, 2, 5, 0, 'db565cdfc76d60be5d22ea20641335de', 'fdsfgds', 'sdfsdfgsdfgdsfg', NULL, '2016-09-21 17:16:32', 2, NULL, 0, 0, '105.156.13.120', 0, 0),
(9, 0, 2, 3, NULL, NULL, 2, 3, 5, 0, '918d5c42f57df5dda1caeaff0afdae4f', 'tsting it', 'nb,vbn,', NULL, '2016-09-21 17:17:07', 3, NULL, 0, 0, '105.156.13.120', 0, 0),
(10, 0, 2, 3, NULL, NULL, 2, 3, 5, 0, '35e796200f195a97dd386d41e02d1cf8', 'tsting it', 'nb,vbn,', NULL, '2016-09-21 17:18:42', 3, NULL, 0, 0, '105.156.13.120', 0, 0),
(11, 0, 2, 3, NULL, NULL, 2, 3, 5, 0, 'e4902911b9c972930bf37a68d08ce097', 'tsting it', 'nb,vbn,', NULL, '2016-09-21 17:19:00', 3, NULL, 0, 0, '105.156.13.120', 0, 0),
(12, 0, 2, 3, NULL, NULL, 2, 3, 5, 0, 'a0404c1f02b3f09005a2e38587e58fa3', 'tsting it', 'nb,vbn,', NULL, '2016-09-21 17:19:31', 3, NULL, 0, 0, '105.156.13.120', 0, 0),
(13, 0, 2, 3, NULL, NULL, 2, 3, 5, 0, '0dd052f54dee44d019d1d69f8ec22a8c', 'tsting it', 'nb,vbn,', NULL, '2016-09-21 17:19:39', 3, NULL, 0, 0, '105.156.13.120', 0, 0),
(14, 0, 2, 3, NULL, NULL, 2, 3, 5, 0, '41bcec32b3b5fbe8220a58019770e278', 'tsting it', 'nb,vbn,', NULL, '2016-09-21 17:29:38', 3, NULL, 0, 0, '105.156.13.120', 0, 0),
(15, 0, 2, 3, NULL, NULL, 2, 3, 5, 0, 'b58734af23ba935021c5e2c091299922', 'tsting it', 'nb,vbn,', NULL, '2016-09-21 17:29:42', 3, NULL, 0, 0, '105.156.13.120', 0, 0),
(16, 0, 2, 3, NULL, NULL, 2, 3, 5, 0, '1807a0237ccb36c12eab0dc092573a42', 'tsting it', 'Ticket support', NULL, '2016-09-21 17:30:08', 3, NULL, 1, 0, '105.156.13.120', 0, 0),
(17, 0, 2, 3, NULL, NULL, 2, 3, 5, 0, 'fd5913f59a0052694a425619a9a58c06', 'tsting it', 'Ticket support', NULL, '2016-09-21 17:36:00', 3, NULL, 0, 0, '105.156.13.120', 0, 0),
(18, 0, 2, 3, NULL, NULL, 3, 3, 5, 0, '437fb40f74af99785d6e37debb70fa53', 'tsting it', 'Ticket support fgfh fhf d fdghjfgh', NULL, '2016-09-21 17:36:36', 3, NULL, 0, 0, '105.156.13.120', 0, 0),
(19, 0, 2, 3, NULL, NULL, 3, 3, 5, 0, '681872d77a01b49c5f8ac08ccd0a304e', 'tsting it', 'Ticket support fgfh fhf d fdghjfgh', NULL, '2016-09-21 17:37:02', 3, NULL, 0, 0, '105.156.13.120', 0, 0),
(20, 0, 2, 3, NULL, NULL, 3, 3, 5, 0, 'f796678556ddddd0be8772f474227cfe', 'tsting it', 'Ticket support fgfh fhf d fdghjfgh', NULL, '2016-09-21 17:37:27', 3, NULL, 1, 0, '105.156.13.120', 0, 0),
(21, 0, 2, 3, NULL, NULL, 1, 1, 5, 0, '7915980cc08b85ea548f2cb610e7a55e', 'ghjfgjhgfhj', 'fghjfghjg hfg', NULL, '2016-09-21 17:41:37', 2, NULL, 1, 0, '105.156.13.120', 0, 0),
(22, 0, 3, 6, NULL, NULL, 1, 3, 5, 0, '39949d6fc1bb89421aa850474e705393', '12365', '', 3, '2016-10-21 17:29:19', 0, NULL, 1, 1, '::1', 1, 0),
(23, 0, 3, 6, NULL, NULL, 1, 2, 5, 0, '19bfe0df581eeadaac5164501de3ec0b', 'ticket1', 'r&eacute;ponse pr&eacute;difini&nbsp;', 6, '2016-10-25 17:07:07', 4, '2016-10-25 17:24:43', 1, 1, '::1', 6, 0),
(24, 0, 3, 6, NULL, NULL, 1, 2, 1, 0, 'f1792d273ca1b70c23a80c2e32440c8a', 'Sujet de ticket', '', 3, '2016-12-09 11:28:44', 6, NULL, 0, 1, '::1', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tblticketsspamcontrol`
--

CREATE TABLE `tblticketsspamcontrol` (
  `id` int(11) NOT NULL,
  `type` varchar(40) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblticketstatus`
--

CREATE TABLE `tblticketstatus` (
  `ticketstatusid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isdefault` int(11) NOT NULL DEFAULT '0',
  `statuscolor` varchar(7) DEFAULT NULL,
  `statusorder` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblticketstatus`
--

INSERT INTO `tblticketstatus` (`ticketstatusid`, `name`, `isdefault`, `statuscolor`, `statusorder`) VALUES
(3, 'Answered', 1, '#0000ff', 3),
(4, 'On Hold', 1, '#c0c0c0', 4),
(2, 'In progress', 1, '#84c529', 2),
(5, 'Closed', 1, '#03a9f4', 5),
(1, 'Open', 1, '#ff2d42', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbltodoitems`
--

CREATE TABLE `tbltodoitems` (
  `todoid` int(11) NOT NULL,
  `description` text NOT NULL,
  `staffid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `datefinished` datetime DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbluserautologin`
--

CREATE TABLE `tbluserautologin` (
  `key_id` char(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_agent` varchar(150) NOT NULL,
  `last_ip` varchar(40) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `staff` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tblviewstracking`
--

CREATE TABLE `tblviewstracking` (
  `id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `view_ip` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblviewstracking`
--

INSERT INTO `tblviewstracking` (`id`, `rel_id`, `rel_type`, `date`, `view_ip`) VALUES
(1, 1, 'invoice', '2016-09-06 17:53:44', '105.157.236.147'),
(2, 2, 'estimate', '2016-10-20 16:08:27', '::1'),
(25, 1, 'proposal', '2016-10-26 17:40:47', '::1'),
(24, 6, 'invoice', '2016-10-26 12:55:06', '::1'),
(23, 2, 'estimate', '2016-10-26 12:30:45', '::1'),
(22, 5, 'invoice', '2016-10-26 12:04:11', '::1'),
(8, 2, 'estimate', '2016-10-21 12:44:07', '::1'),
(21, 5, 'invoice', '2016-10-25 13:19:26', '::1'),
(20, 5, 'invoice', '2016-10-24 17:13:26', '::1'),
(11, 2, 'estimate', '2016-10-21 17:23:25', '::1'),
(12, 1, 'proposal', '2016-10-21 17:51:26', '::1'),
(19, 5, 'invoice', '2016-10-24 15:30:55', '::1'),
(14, 2, 'estimate', '2016-10-21 18:41:47', '::1'),
(15, 2, 'estimate', '2016-10-24 11:14:05', '::1'),
(16, 1, 'proposal', '2016-10-24 11:20:58', '::1'),
(18, 5, 'invoice', '2016-10-24 12:46:18', '::1'),
(26, 4, 'estimate', '2016-10-26 18:21:41', '::1'),
(27, 10, 'invoice', '2016-10-26 18:26:20', '::1'),
(28, 10, 'invoice', '2016-10-27 11:58:56', '::1'),
(29, 4, 'estimate', '2016-10-27 12:27:54', '::1'),
(30, 6, 'invoice', '2016-10-27 15:57:08', '::1'),
(31, 1, 'proposal', '2016-10-28 12:44:31', '::1'),
(32, 2, 'estimate', '2016-10-28 15:31:24', '127.0.0.1');

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id` int(10) NOT NULL,
  `test_name` varchar(12) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tblactivitylog`
--
ALTER TABLE `tblactivitylog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staffid` (`staffid`);

--
-- Index pour la table `tblannouncements`
--
ALTER TABLE `tblannouncements`
  ADD PRIMARY KEY (`announcementid`);

--
-- Index pour la table `tblclientattachments`
--
ALTER TABLE `tblclientattachments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblclients`
--
ALTER TABLE `tblclients`
  ADD PRIMARY KEY (`userid`);

--
-- Index pour la table `tblcommentlikes`
--
ALTER TABLE `tblcommentlikes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblcontactpermissions`
--
ALTER TABLE `tblcontactpermissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblcontactprojects`
--
ALTER TABLE `tblcontactprojects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblcontacts`
--
ALTER TABLE `tblcontacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Index pour la table `tblcontractattachments`
--
ALTER TABLE `tblcontractattachments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblcontractrenewals`
--
ALTER TABLE `tblcontractrenewals`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblcontracts`
--
ALTER TABLE `tblcontracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client` (`client`),
  ADD KEY `contract_type` (`contract_type`);

--
-- Index pour la table `tblcontracttypes`
--
ALTER TABLE `tblcontracttypes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblcountries`
--
ALTER TABLE `tblcountries`
  ADD PRIMARY KEY (`country_id`);

--
-- Index pour la table `tblcurrencies`
--
ALTER TABLE `tblcurrencies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblcustomergroups_in`
--
ALTER TABLE `tblcustomergroups_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupid` (`groupid`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Index pour la table `tblcustomersgroups`
--
ALTER TABLE `tblcustomersgroups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblcustomfields`
--
ALTER TABLE `tblcustomfields`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblcustomfieldsvalues`
--
ALTER TABLE `tblcustomfieldsvalues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relid` (`relid`),
  ADD KEY `fieldid` (`fieldid`),
  ADD KEY `fieldto` (`fieldto`);

--
-- Index pour la table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`departmentid`);

--
-- Index pour la table `tbldismissedannouncements`
--
ALTER TABLE `tbldismissedannouncements`
  ADD PRIMARY KEY (`dismissedannouncementid`);

--
-- Index pour la table `tblemaillists`
--
ALTER TABLE `tblemaillists`
  ADD PRIMARY KEY (`listid`);

--
-- Index pour la table `tblemailtemplates`
--
ALTER TABLE `tblemailtemplates`
  ADD PRIMARY KEY (`emailtemplateid`);

--
-- Index pour la table `tblestimateactivity`
--
ALTER TABLE `tblestimateactivity`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblestimateitems`
--
ALTER TABLE `tblestimateitems`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblestimateitemstaxes`
--
ALTER TABLE `tblestimateitemstaxes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblestimates`
--
ALTER TABLE `tblestimates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `currency` (`currency`);

--
-- Index pour la table `tblevents`
--
ALTER TABLE `tblevents`
  ADD PRIMARY KEY (`eventid`);

--
-- Index pour la table `tblexpenses`
--
ALTER TABLE `tblexpenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `category` (`category`);

--
-- Index pour la table `tblexpensescategories`
--
ALTER TABLE `tblexpensescategories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblgoals`
--
ALTER TABLE `tblgoals`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblinvoiceactivity`
--
ALTER TABLE `tblinvoiceactivity`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblinvoiceitems`
--
ALTER TABLE `tblinvoiceitems`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblinvoiceitemslist`
--
ALTER TABLE `tblinvoiceitemslist`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblinvoiceitemstaxes`
--
ALTER TABLE `tblinvoiceitemstaxes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblinvoicepaymentrecords`
--
ALTER TABLE `tblinvoicepaymentrecords`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblinvoicepaymentsmodes`
--
ALTER TABLE `tblinvoicepaymentsmodes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblinvoices`
--
ALTER TABLE `tblinvoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency` (`currency`),
  ADD KEY `clientid` (`clientid`);

--
-- Index pour la table `tblitemsrelated`
--
ALTER TABLE `tblitemsrelated`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblknowledgebase`
--
ALTER TABLE `tblknowledgebase`
  ADD PRIMARY KEY (`articleid`);

--
-- Index pour la table `tblknowledgebasearticleanswers`
--
ALTER TABLE `tblknowledgebasearticleanswers`
  ADD PRIMARY KEY (`articleanswerid`);

--
-- Index pour la table `tblknowledgebasegroups`
--
ALTER TABLE `tblknowledgebasegroups`
  ADD PRIMARY KEY (`groupid`);

--
-- Index pour la table `tbllanguage`
--
ALTER TABLE `tbllanguage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblleadactivitylog`
--
ALTER TABLE `tblleadactivitylog`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblleadattachments`
--
ALTER TABLE `tblleadattachments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblleads`
--
ALTER TABLE `tblleads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `assigned` (`assigned`),
  ADD KEY `source` (`source`);

--
-- Index pour la table `tblleadsemailintegration`
--
ALTER TABLE `tblleadsemailintegration`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblleadsemailintegrationemails`
--
ALTER TABLE `tblleadsemailintegrationemails`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblleadssources`
--
ALTER TABLE `tblleadssources`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblleadsstatus`
--
ALTER TABLE `tblleadsstatus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbllistemails`
--
ALTER TABLE `tbllistemails`
  ADD PRIMARY KEY (`emailid`);

--
-- Index pour la table `tblmaillistscustomfields`
--
ALTER TABLE `tblmaillistscustomfields`
  ADD PRIMARY KEY (`customfieldid`);

--
-- Index pour la table `tblmaillistscustomfieldvalues`
--
ALTER TABLE `tblmaillistscustomfieldvalues`
  ADD PRIMARY KEY (`customfieldvalueid`);

--
-- Index pour la table `tblmilestones`
--
ALTER TABLE `tblmilestones`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblnotes`
--
ALTER TABLE `tblnotes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblnotifications`
--
ALTER TABLE `tblnotifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbloptions`
--
ALTER TABLE `tbloptions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblpermissions`
--
ALTER TABLE `tblpermissions`
  ADD PRIMARY KEY (`permissionid`);

--
-- Index pour la table `tblpinnedprojects`
--
ALTER TABLE `tblpinnedprojects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblpostattachments`
--
ALTER TABLE `tblpostattachments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblpostcomments`
--
ALTER TABLE `tblpostcomments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblpostlikes`
--
ALTER TABLE `tblpostlikes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`postid`);

--
-- Index pour la table `tblpredifinedreplies`
--
ALTER TABLE `tblpredifinedreplies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblpriorities`
--
ALTER TABLE `tblpriorities`
  ADD PRIMARY KEY (`priorityid`);

--
-- Index pour la table `tblprojectactivity`
--
ALTER TABLE `tblprojectactivity`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblprojectdiscussioncomments`
--
ALTER TABLE `tblprojectdiscussioncomments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblprojectdiscussions`
--
ALTER TABLE `tblprojectdiscussions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblprojectfiles`
--
ALTER TABLE `tblprojectfiles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblprojectmembers`
--
ALTER TABLE `tblprojectmembers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblprojectnotes`
--
ALTER TABLE `tblprojectnotes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblprojects`
--
ALTER TABLE `tblprojects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`);

--
-- Index pour la table `tblprojectsettings`
--
ALTER TABLE `tblprojectsettings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblproposalcomments`
--
ALTER TABLE `tblproposalcomments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblproposals`
--
ALTER TABLE `tblproposals`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblpurchase`
--
ALTER TABLE `tblpurchase`
  ADD PRIMARY KEY (`id_purchase`);

--
-- Index pour la table `tblpurchase_file`
--
ALTER TABLE `tblpurchase_file`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblreminders`
--
ALTER TABLE `tblreminders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblrolepermissions`
--
ALTER TABLE `tblrolepermissions`
  ADD PRIMARY KEY (`rolepermissionid`);

--
-- Index pour la table `tblroles`
--
ALTER TABLE `tblroles`
  ADD PRIMARY KEY (`roleid`);

--
-- Index pour la table `tblsalesattachments`
--
ALTER TABLE `tblsalesattachments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`serviceid`);

--
-- Index pour la table `tblsliders`
--
ALTER TABLE `tblsliders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblstaff`
--
ALTER TABLE `tblstaff`
  ADD PRIMARY KEY (`staffid`);

--
-- Index pour la table `tblstaffdepartments`
--
ALTER TABLE `tblstaffdepartments`
  ADD PRIMARY KEY (`staffdepartmentid`);

--
-- Index pour la table `tblstaffpermissions`
--
ALTER TABLE `tblstaffpermissions`
  ADD PRIMARY KEY (`staffpermid`);

--
-- Index pour la table `tblstafftaskassignees`
--
ALTER TABLE `tblstafftaskassignees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taskid` (`taskid`),
  ADD KEY `staffid` (`staffid`);

--
-- Index pour la table `tblstafftaskcomments`
--
ALTER TABLE `tblstafftaskcomments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblstafftasks`
--
ALTER TABLE `tblstafftasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_id` (`rel_id`),
  ADD KEY `rel_type` (`rel_type`);

--
-- Index pour la table `tblstafftasksattachments`
--
ALTER TABLE `tblstafftasksattachments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblstafftasksfollowers`
--
ALTER TABLE `tblstafftasksfollowers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblsupplierattachments`
--
ALTER TABLE `tblsupplierattachments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblsuppliergroups_in`
--
ALTER TABLE `tblsuppliergroups_in`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblsuppliers`
--
ALTER TABLE `tblsuppliers`
  ADD PRIMARY KEY (`supplierid`);

--
-- Index pour la table `tblsurveyquestionboxes`
--
ALTER TABLE `tblsurveyquestionboxes`
  ADD PRIMARY KEY (`boxid`);

--
-- Index pour la table `tblsurveyquestionboxesdescription`
--
ALTER TABLE `tblsurveyquestionboxesdescription`
  ADD PRIMARY KEY (`questionboxdescriptionid`);

--
-- Index pour la table `tblsurveyquestions`
--
ALTER TABLE `tblsurveyquestions`
  ADD PRIMARY KEY (`questionid`);

--
-- Index pour la table `tblsurveyresults`
--
ALTER TABLE `tblsurveyresults`
  ADD PRIMARY KEY (`resultid`);

--
-- Index pour la table `tblsurveyresultsets`
--
ALTER TABLE `tblsurveyresultsets`
  ADD PRIMARY KEY (`resultsetid`);

--
-- Index pour la table `tblsurveys`
--
ALTER TABLE `tblsurveys`
  ADD PRIMARY KEY (`surveyid`);

--
-- Index pour la table `tblsurveysemailsendcron`
--
ALTER TABLE `tblsurveysemailsendcron`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblsurveysendlog`
--
ALTER TABLE `tblsurveysendlog`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbltaskchecklists`
--
ALTER TABLE `tbltaskchecklists`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbltaskstimers`
--
ALTER TABLE `tbltaskstimers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbltaxes`
--
ALTER TABLE `tbltaxes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblticketattachments`
--
ALTER TABLE `tblticketattachments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblticketpipelog`
--
ALTER TABLE `tblticketpipelog`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblticketreplies`
--
ALTER TABLE `tblticketreplies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbltickets`
--
ALTER TABLE `tbltickets`
  ADD PRIMARY KEY (`ticketid`),
  ADD KEY `service` (`service`),
  ADD KEY `department` (`department`),
  ADD KEY `status` (`status`),
  ADD KEY `userid` (`userid`),
  ADD KEY `priority` (`priority`);

--
-- Index pour la table `tblticketsspamcontrol`
--
ALTER TABLE `tblticketsspamcontrol`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tblticketstatus`
--
ALTER TABLE `tblticketstatus`
  ADD PRIMARY KEY (`ticketstatusid`);

--
-- Index pour la table `tbltodoitems`
--
ALTER TABLE `tbltodoitems`
  ADD PRIMARY KEY (`todoid`);

--
-- Index pour la table `tblviewstracking`
--
ALTER TABLE `tblviewstracking`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tblactivitylog`
--
ALTER TABLE `tblactivitylog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=986;
--
-- AUTO_INCREMENT pour la table `tblannouncements`
--
ALTER TABLE `tblannouncements`
  MODIFY `announcementid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tblclientattachments`
--
ALTER TABLE `tblclientattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `tblclients`
--
ALTER TABLE `tblclients`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tblcommentlikes`
--
ALTER TABLE `tblcommentlikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblcontactpermissions`
--
ALTER TABLE `tblcontactpermissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT pour la table `tblcontactprojects`
--
ALTER TABLE `tblcontactprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT pour la table `tblcontacts`
--
ALTER TABLE `tblcontacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `tblcontractattachments`
--
ALTER TABLE `tblcontractattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblcontractrenewals`
--
ALTER TABLE `tblcontractrenewals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblcontracts`
--
ALTER TABLE `tblcontracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tblcontracttypes`
--
ALTER TABLE `tblcontracttypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblcountries`
--
ALTER TABLE `tblcountries`
  MODIFY `country_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
--
-- AUTO_INCREMENT pour la table `tblcurrencies`
--
ALTER TABLE `tblcurrencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tblcustomergroups_in`
--
ALTER TABLE `tblcustomergroups_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tblcustomersgroups`
--
ALTER TABLE `tblcustomersgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `tblcustomfields`
--
ALTER TABLE `tblcustomfields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `tblcustomfieldsvalues`
--
ALTER TABLE `tblcustomfieldsvalues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `departmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tbldismissedannouncements`
--
ALTER TABLE `tbldismissedannouncements`
  MODIFY `dismissedannouncementid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `tblemaillists`
--
ALTER TABLE `tblemaillists`
  MODIFY `listid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblemailtemplates`
--
ALTER TABLE `tblemailtemplates`
  MODIFY `emailtemplateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT pour la table `tblestimateactivity`
--
ALTER TABLE `tblestimateactivity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `tblestimateitems`
--
ALTER TABLE `tblestimateitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tblestimateitemstaxes`
--
ALTER TABLE `tblestimateitemstaxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tblestimates`
--
ALTER TABLE `tblestimates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblexpenses`
--
ALTER TABLE `tblexpenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblexpensescategories`
--
ALTER TABLE `tblexpensescategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `tblgoals`
--
ALTER TABLE `tblgoals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblinvoiceactivity`
--
ALTER TABLE `tblinvoiceactivity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;
--
-- AUTO_INCREMENT pour la table `tblinvoiceitems`
--
ALTER TABLE `tblinvoiceitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `tblinvoiceitemslist`
--
ALTER TABLE `tblinvoiceitemslist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tblinvoiceitemstaxes`
--
ALTER TABLE `tblinvoiceitemstaxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `tblinvoicepaymentrecords`
--
ALTER TABLE `tblinvoicepaymentrecords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblinvoicepaymentsmodes`
--
ALTER TABLE `tblinvoicepaymentsmodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblinvoices`
--
ALTER TABLE `tblinvoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT pour la table `tblitemsrelated`
--
ALTER TABLE `tblitemsrelated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tblknowledgebase`
--
ALTER TABLE `tblknowledgebase`
  MODIFY `articleid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblknowledgebasearticleanswers`
--
ALTER TABLE `tblknowledgebasearticleanswers`
  MODIFY `articleanswerid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblknowledgebasegroups`
--
ALTER TABLE `tblknowledgebasegroups`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tbllanguage`
--
ALTER TABLE `tbllanguage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `tblleadactivitylog`
--
ALTER TABLE `tblleadactivitylog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblleadattachments`
--
ALTER TABLE `tblleadattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblleads`
--
ALTER TABLE `tblleads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblleadsemailintegration`
--
ALTER TABLE `tblleadsemailintegration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'the ID always must be 1', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblleadsemailintegrationemails`
--
ALTER TABLE `tblleadsemailintegrationemails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblleadssources`
--
ALTER TABLE `tblleadssources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tblleadsstatus`
--
ALTER TABLE `tblleadsstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tbllistemails`
--
ALTER TABLE `tbllistemails`
  MODIFY `emailid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblmaillistscustomfields`
--
ALTER TABLE `tblmaillistscustomfields`
  MODIFY `customfieldid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblmaillistscustomfieldvalues`
--
ALTER TABLE `tblmaillistscustomfieldvalues`
  MODIFY `customfieldvalueid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblmilestones`
--
ALTER TABLE `tblmilestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblnotes`
--
ALTER TABLE `tblnotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tblnotifications`
--
ALTER TABLE `tblnotifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT pour la table `tbloptions`
--
ALTER TABLE `tbloptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT pour la table `tblpermissions`
--
ALTER TABLE `tblpermissions`
  MODIFY `permissionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `tblpinnedprojects`
--
ALTER TABLE `tblpinnedprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tblpostattachments`
--
ALTER TABLE `tblpostattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblpostcomments`
--
ALTER TABLE `tblpostcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblpostlikes`
--
ALTER TABLE `tblpostlikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblpredifinedreplies`
--
ALTER TABLE `tblpredifinedreplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblpriorities`
--
ALTER TABLE `tblpriorities`
  MODIFY `priorityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tblprojectactivity`
--
ALTER TABLE `tblprojectactivity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT pour la table `tblprojectdiscussioncomments`
--
ALTER TABLE `tblprojectdiscussioncomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT pour la table `tblprojectdiscussions`
--
ALTER TABLE `tblprojectdiscussions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `tblprojectfiles`
--
ALTER TABLE `tblprojectfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pour la table `tblprojectmembers`
--
ALTER TABLE `tblprojectmembers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `tblprojectnotes`
--
ALTER TABLE `tblprojectnotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblprojects`
--
ALTER TABLE `tblprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `tblprojectsettings`
--
ALTER TABLE `tblprojectsettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT pour la table `tblproposalcomments`
--
ALTER TABLE `tblproposalcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblproposals`
--
ALTER TABLE `tblproposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblpurchase`
--
ALTER TABLE `tblpurchase`
  MODIFY `id_purchase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT pour la table `tblpurchase_file`
--
ALTER TABLE `tblpurchase_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `tblreminders`
--
ALTER TABLE `tblreminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tblrolepermissions`
--
ALTER TABLE `tblrolepermissions`
  MODIFY `rolepermissionid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblroles`
--
ALTER TABLE `tblroles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblsalesattachments`
--
ALTER TABLE `tblsalesattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `serviceid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblsliders`
--
ALTER TABLE `tblsliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `tblstaff`
--
ALTER TABLE `tblstaff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `tblstaffdepartments`
--
ALTER TABLE `tblstaffdepartments`
  MODIFY `staffdepartmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `tblstaffpermissions`
--
ALTER TABLE `tblstaffpermissions`
  MODIFY `staffpermid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT pour la table `tblstafftaskassignees`
--
ALTER TABLE `tblstafftaskassignees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `tblstafftaskcomments`
--
ALTER TABLE `tblstafftaskcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tblstafftasks`
--
ALTER TABLE `tblstafftasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `tblstafftasksattachments`
--
ALTER TABLE `tblstafftasksattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tblstafftasksfollowers`
--
ALTER TABLE `tblstafftasksfollowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `tblsupplierattachments`
--
ALTER TABLE `tblsupplierattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `tblsuppliergroups_in`
--
ALTER TABLE `tblsuppliergroups_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tblsuppliers`
--
ALTER TABLE `tblsuppliers`
  MODIFY `supplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tblsurveyquestionboxes`
--
ALTER TABLE `tblsurveyquestionboxes`
  MODIFY `boxid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblsurveyquestionboxesdescription`
--
ALTER TABLE `tblsurveyquestionboxesdescription`
  MODIFY `questionboxdescriptionid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblsurveyquestions`
--
ALTER TABLE `tblsurveyquestions`
  MODIFY `questionid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblsurveyresults`
--
ALTER TABLE `tblsurveyresults`
  MODIFY `resultid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblsurveyresultsets`
--
ALTER TABLE `tblsurveyresultsets`
  MODIFY `resultsetid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblsurveys`
--
ALTER TABLE `tblsurveys`
  MODIFY `surveyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblsurveysemailsendcron`
--
ALTER TABLE `tblsurveysemailsendcron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `tblsurveysendlog`
--
ALTER TABLE `tblsurveysendlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tbltaskchecklists`
--
ALTER TABLE `tbltaskchecklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `tbltaskstimers`
--
ALTER TABLE `tbltaskstimers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `tbltaxes`
--
ALTER TABLE `tbltaxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tblticketattachments`
--
ALTER TABLE `tblticketattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tblticketpipelog`
--
ALTER TABLE `tblticketpipelog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblticketreplies`
--
ALTER TABLE `tblticketreplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tbltickets`
--
ALTER TABLE `tbltickets`
  MODIFY `ticketid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `tblticketsspamcontrol`
--
ALTER TABLE `tblticketsspamcontrol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblticketstatus`
--
ALTER TABLE `tblticketstatus`
  MODIFY `ticketstatusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tbltodoitems`
--
ALTER TABLE `tbltodoitems`
  MODIFY `todoid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tblviewstracking`
--
ALTER TABLE `tblviewstracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
