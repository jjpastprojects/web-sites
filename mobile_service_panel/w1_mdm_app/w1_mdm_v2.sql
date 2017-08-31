-- phpMyAdmin SQL Dump
-- version 4.0.10.19
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2017 at 09:18 AM
-- Server version: 5.5.56
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `w1_mdm_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `role` enum('ADMIN','CADMIN') NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `username`, `password`, `role`, `created_on`, `updated_on`, `is_deleted`, `last_login`, `last_activity`) VALUES
(1, 'admin', 'admin@w1mdm.com', 'admin', '202cb962ac59075b964b07152d234b70', 'ADMIN', '2017-01-26 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2017-05-26 17:35:41'),
(3, 'testusers', 'ashish@gmail.com', 'ashish123', 'e10adc3949ba59abbe56e057f20f883e', 'CADMIN', '2017-01-30 10:23:02', '2017-06-30 20:05:39', 1, '0000-00-00 00:00:00', '2017-06-29 05:46:53'),
(4, 'user', 'user@user.com', 'Manish', '8d93d6bad1571f4baac53ac813a7fb57', 'CADMIN', '2017-02-03 13:43:06', '2017-07-24 18:13:32', 1, '0000-00-00 00:00:00', '2017-07-24 18:12:37'),
(5, 'Test user', 'test@test.com', 'test1', '202cb962ac59075b964b07152d234b70', 'CADMIN', '2017-02-27 09:55:08', '2017-07-18 06:18:32', 1, '0000-00-00 00:00:00', '2017-07-18 06:14:24'),
(6, 'asdad', 'user@usesssr.com', 'ssss', '202cb962ac59075b964b07152d234b70', 'CADMIN', '2017-06-29 12:12:55', '2017-06-29 12:13:02', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_admin`
--

CREATE TABLE IF NOT EXISTS `company_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_admin_id` int(11) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `profile_photo` varchar(80) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `company_admin`
--

INSERT INTO `company_admin` (`id`, `company_admin_id`, `is_deleted`, `profile_photo`, `created_on`, `updated_on`) VALUES
(2, 0, '0', '588f5dd99fca2.png', '2017-01-30 10:23:02', '0000-00-00 00:00:00'),
(3, 0, '0', '', '2017-02-03 13:43:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_admin_permission`
--

CREATE TABLE IF NOT EXISTS `company_admin_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cadmin_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `company_admin_permission`
--

INSERT INTO `company_admin_permission` (`id`, `cadmin_id`, `permission_id`, `created_on`) VALUES
(43, 2, 6, '2017-02-03 13:42:29'),
(46, 4, 1, '2017-02-27 10:05:07'),
(47, 4, 3, '2017-02-27 10:05:07'),
(48, 4, 5, '2017-02-27 10:05:07'),
(49, 4, 7, '2017-02-27 10:05:07'),
(50, 4, 9, '2017-02-27 10:05:07'),
(51, 5, 1, '2017-02-27 10:05:19'),
(52, 5, 3, '2017-02-27 10:05:19'),
(53, 5, 5, '2017-02-27 10:05:19'),
(54, 5, 6, '2017-02-27 10:05:19'),
(55, 5, 7, '2017-02-27 10:05:19'),
(56, 5, 8, '2017-02-27 10:05:19'),
(57, 5, 9, '2017-02-27 10:05:19'),
(58, 3, 1, '2017-06-29 12:11:18'),
(59, 3, 3, '2017-06-29 12:11:18'),
(60, 3, 5, '2017-06-29 12:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `data_request`
--

CREATE TABLE IF NOT EXISTS `data_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(250) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_device`
--

CREATE TABLE IF NOT EXISTS `deleted_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(100) NOT NULL,
  `createdon` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `deleted_device`
--

INSERT INTO `deleted_device` (`id`, `device_id`, `createdon`) VALUES
(1, 'd4f71d2d23454a32', '2017-05-05 06:26:35'),
(5, 'D4F41BBC-7D1D-4418-BDE9-0F6736FE5294', '2017-05-30 05:19:59'),
(6, 'AB4569BB-2A22-487D-B553-C695F6BAA034', '2017-06-20 13:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `device_contact`
--

CREATE TABLE IF NOT EXISTS `device_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(250) DEFAULT NULL,
  `contact_detail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `device_contact`
--

INSERT INTO `device_contact` (`id`, `device_id`, `contact_detail`, `createdon`, `updatedon`) VALUES
(6, 'F3A83F82-3159-4FC9-86B5-1ED26A8F710F', '{\n  "contacts" : [\n    {\n      "full_name" : "Philip Servistronic",\n      "last_name" : "Servistronic",\n      "phone" : [\n        {\n          "mobile_2" : "+65 9877 2227"\n        }\n      ],\n      "first_name" : "Philip"\n    },\n    {\n      "full_name" : "Has",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 12-374 9272"\n        }\n      ],\n      "first_name" : "Has"\n    },\n    {\n      "full_name" : "Ayu",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 12-216 1184"\n        }\n      ],\n      "first_name" : "Ayu"\n    },\n    {\n      "full_name" : "Jeanny Mc",\n      "last_name" : "Mc",\n      "phone" : [\n        {\n          "mobile" : "+65 9476 3216"\n        }\n      ],\n      "first_name" : "Jeanny"\n    },\n    {\n      "full_name" : "Dapur Ummi2",\n      "last_name" : "Ummi2",\n      "phone" : [\n        {\n          "mobile" : "86518651"\n        }\n      ],\n      "first_name" : "Dapur"\n    },\n    {\n      "full_name" : "K ita",\n      "last_name" : "ita",\n      "phone" : [\n        {\n          "mobile" : "+60172650159"\n        }\n      ],\n      "first_name" : "K"\n    },\n    {\n      "full_name" : "Nikie",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 19-327 2704"\n        }\n      ],\n      "first_name" : "Nikie"\n    },\n    {\n      "full_name" : "Za -Libry",\n      "last_name" : "-Libry",\n      "phone" : [\n        {\n          "mobile" : "+6584349105"\n        }\n      ],\n      "first_name" : "Za"\n    },\n    {\n      "full_name" : "Ms Tiffany Quek - Tutor",\n      "last_name" : "Tutor",\n      "phone" : [\n        {\n          "mobile" : "81253999"\n        }\n      ],\n      "first_name" : "Tiffany Quek"\n    },\n    {\n      "full_name" : "Kk-insurance",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "63941209"\n        }\n      ],\n      "first_name" : "Kk-insurance"\n    },\n    {\n      "full_name" : "Inakid",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 19-343 6183"\n        }\n      ],\n      "first_name" : "Inakid"\n    },\n    {\n      "full_name" : "Fiona Chinese Tutor",\n      "last_name" : "Tutor",\n      "phone" : [\n        {\n          "mobile" : "96890221"\n        }\n      ],\n      "first_name" : "Fiona"\n    },\n    {\n      "full_name" : "K marni",\n      "last_name" : "marni",\n      "phone" : [\n        {\n          "mobile" : "+60 12-472 3052"\n        }\n      ],\n      "first_name" : "K"\n    },\n    {\n      "full_name" : "Masjid Mujahidin",\n      "last_name" : "Mujahidin",\n      "phone" : [\n        {\n          "mobile" : "64737400"\n        }\n      ],\n      "first_name" : "Masjid"\n    },\n    {\n      "full_name" : "Ms LU WEI-IZaac Laoshi",\n      "last_name" : "Laoshi",\n      "phone" : [\n        {\n          "mobile" : "+6593262875"\n        }\n      ],\n      "first_name" : "Ms LU"\n    },\n    {\n      "full_name" : "Hometuition",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "92725433"\n        }\n      ],\n      "first_name" : "Hometuition"\n    },\n    {\n      "full_name" : "Kawan Iza",\n      "last_name" : "Iza",\n      "phone" : [\n        {\n          "mobile_2" : "+65 8309 2383"\n        }\n      ],\n      "first_name" : "Kawan"\n    },\n    {\n      "full_name" : "Tuty",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 19-209 4460"\n        }\n      ],\n      "first_name" : "Tuty"\n    },\n    {\n      "full_name" : "Dak Teropong",\n      "last_name" : "Teropong",\n      "phone" : [\n        {\n          "mobile_2" : "+60 19-311 3575"\n        }\n      ],\n      "first_name" : "Dak"\n    },\n    {\n      "full_name" : "Ms Mui- Chinese Tutor",\n      "last_name" : "Tutor",\n      "phone" : [\n        {\n          "mobile" : "87231105"\n        }\n      ],\n      "first_name" : "Mui-"\n    },\n    {\n      "full_name" : "Rohaida",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 16-207 0721"\n        }\n      ],\n      "first_name" : "Rohaida"\n    },\n    {\n      "full_name" : "Ayahbonda",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "01860342919584"\n        }\n      ],\n      "first_name" : "Ayahbonda"\n    },\n    {\n      "full_name" : "Maddy",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 12-630 2211"\n        }\n      ],\n      "first_name" : "Maddy"\n    },\n    {\n      "full_name" : "K ita",\n      "last_name" : "ita",\n      "phone" : [\n        {\n          "mobile" : "90176082"\n        }\n      ],\n      "first_name" : "K"\n    },\n    {\n      "full_name" : "Trainer DEWI-english Hazim",\n      "last_name" : "Hazim",\n      "phone" : [\n        {\n          "mobile" : "97457970"\n        }\n      ],\n      "first_name" : "Trainer"\n    },\n    {\n      "full_name" : "Xtay",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60123708251"\n        }\n      ],\n      "first_name" : "Xtay"\n    },\n    {\n      "full_name" : "Arni-order Lauk Raya",\n      "last_name" : "Raya",\n      "phone" : [\n        {\n          "mobile" : "+6590265526"\n        }\n      ],\n      "first_name" : "Arni-order"\n    },\n    {\n      "full_name" : "Buai",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "83328389"\n        }\n      ],\n      "first_name" : "Buai"\n    },\n    {\n      "full_name" : "Literacy Plus",\n      "last_name" : "Plus",\n      "phone" : [\n        {\n          "mobile" : "67772468"\n        }\n      ],\n      "first_name" : "Literacy"\n    },\n    {\n      "full_name" : "Mdm NG-Tutor",\n      "last_name" : "NG-Tutor",\n      "phone" : [\n        {\n          "mobile" : "94773266"\n        }\n      ],\n      "first_name" : "Mdm"\n    },\n    {\n      "full_name" : "Ayah Hp",\n      "last_name" : "Hp",\n      "phone" : [\n        {\n          "mobile" : "+60 13-887 9498"\n        }\n      ],\n      "first_name" : "Ayah"\n    },\n    {\n      "full_name" : "Minds Champ",\n      "last_name" : "Champ",\n      "phone" : [\n        {\n          "mobile" : "68282661"\n        }\n      ],\n      "first_name" : "Minds"\n    },\n    {\n      "full_name" : "Mr LEE-Plumber",\n      "last_name" : "LEE-Plumber",\n      "phone" : [\n        {\n          "mobile" : "91381771"\n        }\n      ],\n      "first_name" : "Mr"\n    },\n    {\n      "email" : "ida@ezzacouture.com",\n      "full_name" : "Ezza Couture",\n      "last_name" : "Couture",\n      "phone" : [\n        {\n          "mobile" : "+60 12-221 8748"\n        }\n      ],\n      "first_name" : "Ezza"\n    },\n    {\n      "full_name" : "Hazim",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "90670874"\n        }\n      ],\n      "first_name" : "Hazim"\n    },\n    {\n      "full_name" : "Saleh",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 13-511 1235"\n        }\n      ],\n      "first_name" : "Saleh"\n    },\n    {\n      "full_name" : "Aya",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 11-2376 9003"\n        }\n      ],\n      "first_name" : "Aya"\n    },\n    {\n      "full_name" : "Atie",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 12-955 7904"\n        }\n      ],\n      "first_name" : "Atie"\n    },\n    {\n      "full_name" : "Ira-ezza",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "‪+60 18-287 7823‬"\n        }\n      ],\n      "first_name" : "Ira-ezza"\n    },\n    {\n      "full_name" : "K shidah -sil",\n      "last_name" : "-sil",\n      "phone" : [\n        {\n          "mobile" : "+60199500301"\n        }\n      ],\n      "first_name" : "K"\n    },\n    {\n      "full_name" : "Syarol Ati",\n      "last_name" : "Ati",\n      "phone" : [\n        {\n          "mobile" : "+60199416007"\n        }\n      ],\n      "first_name" : "Syarol"\n    },\n    {\n      "full_name" : "Noo Ul Aida",\n      "last_name" : "Aida",\n      "phone" : [\n        {\n          "mobile" : "+60 13-784 6424"\n        }\n      ],\n      "first_name" : "Noo"\n    },\n    {\n      "full_name" : "Aircon-Kenny",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "97885687"\n        }\n      ],\n      "first_name" : "Aircon-Kenny"\n    },\n    {\n      "full_name" : "Aahubby KL",\n      "last_name" : "KL",\n      "phone" : [\n        {\n          "mobile" : "+60 19-204 4001"\n        }\n      ],\n      "first_name" : "Aahubby"\n    },\n    {\n      "full_name" : "Xtau2",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60166414465"\n        }\n      ],\n      "first_name" : "Xtau2"\n    },\n    {\n      "email" : "sk@sitikhadijah.com",\n      "full_name" : "Team Siti Khadijah",\n      "last_name" : "Team Siti Khadijah",\n      "phone" : [\n\n      ],\n      "first_name" : ""\n    },\n    {\n      "full_name" : "Mai",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 13-722 7668"\n        }\n      ],\n      "first_name" : "Mai"\n    },\n    {\n      "full_name" : "Mrs Koh- Izaac Literacy Plus Teacher",\n      "last_name" : "Teacher",\n      "phone" : [\n        {\n          "mobile" : "90010578"\n        }\n      ],\n      "first_name" : "Mrs Koh- Izaac Literacy"\n    },\n    {\n      "full_name" : "Suri",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 12-292 3713"\n        }\n      ],\n      "first_name" : "Suri"\n    },\n    {\n      "full_name" : "Taxi Comfort",\n      "last_name" : "Comfort",\n      "phone" : [\n        {\n          "mobile" : "65521111"\n        }\n      ],\n      "first_name" : "Taxi"\n    },\n    {\n      "full_name" : "Faizal-trainer Minds Champ",\n      "last_name" : "Champ",\n      "phone" : [\n        {\n          "mobile" : "96971397"\n        }\n      ],\n      "first_name" : "Faizal-trainer"\n    },\n    {\n      "full_name" : "Kkk Hospital",\n      "last_name" : "Hospital",\n      "phone" : [\n        {\n          "mobile" : "62944050"\n        }\n      ],\n      "first_name" : "Kkk"\n    },\n    {\n      "full_name" : "Haida Fatimah",\n      "last_name" : "Fatimah",\n      "phone" : [\n        {\n          "mobile" : "+60122099984"\n        }\n      ],\n      "first_name" : "Haida"\n    },\n    {\n      "full_name" : "Izzah",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+65 9858 3941"\n        }\n      ],\n      "first_name" : "Izzah"\n    },\n    {\n      "full_name" : "Asslam Taylor Ampang",\n      "last_name" : "Ampang",\n      "phone" : [\n        {\n          "mobile" : "01860149678400"\n        }\n      ],\n      "first_name" : "Asslam"\n    },\n    {\n      "full_name" : "Pos Malaysia-cus Servis",\n      "last_name" : "Servis",\n      "phone" : [\n        {\n          "mobile" : "01860327279100"\n        }\n      ],\n      "first_name" : "Pos"\n    },\n    {\n      "full_name" : "Mrs Bay",\n      "last_name" : "Bay",\n      "phone" : [\n        {\n          "mobile" : "96937465"\n        }\n      ],\n      "first_name" : ""\n    },\n    {\n      "full_name" : "Jasmine-startusen",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+65 9183 4868"\n        }\n      ],\n      "first_name" : "Jasmine-startusen"\n    },\n    {\n      "full_name" : "Kma",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 17-209 9103"\n        }\n      ],\n      "first_name" : "Kma"\n    },\n    {\n      "full_name" : "Ap Lim",\n      "last_name" : "Lim",\n      "phone" : [\n        {\n          "mobile" : "+65 9476 3027"\n        }\n      ],\n      "first_name" : "Ap"\n    },\n    {\n      "full_name" : "Miya Laoshi",\n      "last_name" : "Laoshi",\n      "phone" : [\n        {\n          "mobile" : "+6596317316"\n        }\n      ],\n      "first_name" : "Miya"\n    },\n    {\n      "full_name" : "Ms Choo",\n      "last_name" : "Choo",\n      "phone" : [\n        {\n          "mobile" : "83729425"\n        }\n      ],\n      "first_name" : "Ms"\n    },\n    {\n      "full_name" : "Mama",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 12-375 5899"\n        }\n      ],\n      "first_name" : "Mama"\n    },\n    {\n      "full_name" : "Philip-servatronic Audi",\n      "last_name" : "Audi",\n      "phone" : [\n        {\n          "mobile" : "98772227"\n        }\n      ],\n      "first_name" : "Philip-servatronic"\n    },\n    {\n      "full_name" : "Nazri -nani",\n      "last_name" : "-nani",\n      "phone" : [\n        {\n          "mobile_2" : "+60 19-922 8118"\n        }\n      ],\n      "first_name" : "Nazri"\n    },\n    {\n      "full_name" : "Consulate Mlaysia Embassy",\n      "last_name" : "Embassy",\n      "phone" : [\n        {\n          "mobile" : "68876228"\n        }\n      ],\n      "first_name" : "Consulate"\n    },\n    {\n      "full_name" : "Aahubby",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+65 9875 3587"\n        }\n      ],\n      "first_name" : "Aahubby"\n    },\n    {\n      "full_name" : "Dak Teropong",\n      "last_name" : "Teropong",\n      "phone" : [\n        {\n          "mobile_2" : "+60 19-311 3575"\n        }\n      ],\n      "first_name" : "Dak"\n    },\n    {\n      "full_name" : "Mr HAW - Teacher 6joy",\n      "last_name" : "6joy",\n      "phone" : [\n        {\n          "mobile" : "88581444"\n        }\n      ],\n      "first_name" : "HAW -"\n    },\n    {\n      "full_name" : "Dapur Ummi",\n      "last_name" : "Ummi",\n      "phone" : [\n        {\n          "mobile" : "67554225"\n        }\n      ],\n      "first_name" : "Dapur"\n    },\n    {\n      "full_name" : "Nani",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 11-1518 4421"\n        }\n      ],\n      "first_name" : "Nani"\n    },\n    {\n      "full_name" : "Malyana",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 13-978 8837"\n        }\n      ],\n      "first_name" : "Malyana"\n    },\n    {\n      "full_name" : "Lynn Siregar",\n      "last_name" : "Siregar",\n      "phone" : [\n        {\n          "mobile" : "90228272"\n        }\n      ],\n      "first_name" : "Lynn"\n    },\n    {\n      "email" : "erfan@brainsurgeon.com.sg",\n      "full_name" : "Erfan @ Brain Surgeon",\n      "last_name" : "Surgeon",\n      "phone" : [\n        {\n          "mobile_2" : "+65 9878 9205"\n        }\n      ],\n      "first_name" : "Erfan @"\n    },\n    {\n      "full_name" : "Ms Wei -dylan Mom",\n      "last_name" : "Mom",\n      "phone" : [\n        {\n          "mobile" : "90028777"\n        }\n      ],\n      "first_name" : "Wei"\n    },\n    {\n      "full_name" : "Literacy Plus Hp",\n      "last_name" : "Hp",\n      "phone" : [\n        {\n          "mobile" : "90350769"\n        }\n      ],\n      "first_name" : "Literacy"\n    },\n    {\n      "full_name" : "Fiza Ani",\n      "last_name" : "Ani",\n      "phone" : [\n        {\n          "mobile" : "+60 19-409 4960"\n        }\n      ],\n      "first_name" : "Fiza"\n    },\n    {\n      "full_name" : "Pn Adina Mara",\n      "last_name" : "Mara",\n      "phone" : [\n        {\n          "mobile" : "+60197671816"\n        }\n      ],\n      "first_name" : "Pn"\n    },\n    {\n      "full_name" : "Munir @Ex-ITTM",\n      "last_name" : "@Ex-ITTM",\n      "phone" : [\n        {\n          "mobile_2" : "+60 12-302 3909"\n        }\n      ],\n      "first_name" : "Munir"\n    },\n    {\n      "full_name" : "Ziba",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 17-359 2711"\n        }\n      ],\n      "first_name" : "Ziba"\n    },\n    {\n      "full_name" : "En Ahmad Quicklane",\n      "last_name" : "Quicklane",\n      "phone" : [\n        {\n          "mobile" : "96904556"\n        }\n      ],\n      "first_name" : "En"\n    },\n    {\n      "full_name" : "Ani",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 19-590 8871"\n        }\n      ],\n      "first_name" : "Ani"\n    },\n    {\n      "full_name" : "Samsul",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 13-982 7277"\n        }\n      ],\n      "first_name" : "Samsul"\n    },\n    {\n      "full_name" : "Za New",\n      "last_name" : "New",\n      "phone" : [\n        {\n          "mobile" : "+65 9247 6069"\n        }\n      ],\n      "first_name" : "Za"\n    },\n    {\n      "full_name" : "Mr Poh",\n      "last_name" : "Poh",\n      "phone" : [\n        {\n          "mobile" : "+65 9856 9851"\n        }\n      ],\n      "first_name" : "Mr"\n    },\n    {\n      "full_name" : "Aida Ismaliza",\n      "last_name" : "Ismaliza",\n      "phone" : [\n        {\n          "mobile" : "+65 9121 8115"\n        }\n      ],\n      "first_name" : "Aida"\n    },\n    {\n      "full_name" : "Mr Yeoh Plumber",\n      "last_name" : "Plumber",\n      "phone" : [\n        {\n          "mobile" : "+6597450705"\n        }\n      ],\n      "first_name" : "Mr"\n    },\n    {\n      "full_name" : "Andrea Kk",\n      "last_name" : "Kk",\n      "phone" : [\n        {\n          "mobile" : "63941483"\n        }\n      ],\n      "first_name" : "Andrea"\n    },\n    {\n      "full_name" : "KDO",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 19-655 9177"\n        }\n      ],\n      "first_name" : "KDO"\n    },\n    {\n      "full_name" : "Izawat",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+60 12-366 9598"\n        }\n      ],\n      "first_name" : "Izawat"\n    },\n    {\n      "full_name" : "Mak Hp",\n      "last_name" : "Hp",\n      "phone" : [\n        {\n          "mobile" : "01860133996007"\n        }\n      ],\n      "first_name" : "Mak"\n    },\n    {\n      "full_name" : "Kelly",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+6596895053"\n        }\n      ],\n      "first_name" : "Kelly"\n    },\n    {\n      "full_name" : "MaoGen- Bos Hubby",\n      "last_name" : "Hubby",\n      "phone" : [\n        {\n          "mobile_2" : "+65 9731 2572"\n        }\n      ],\n      "first_name" : "MaoGen-"\n    },\n    {\n      "full_name" : "Azzahra Maternity Clinic",\n      "last_name" : "Clinic",\n      "phone" : [\n        {\n          "mobile" : "01860389212510"\n        }\n      ],\n      "first_name" : "Azzahra"\n    },\n    {\n      "full_name" : "Aahubby 2",\n      "last_name" : "2",\n      "phone" : [\n        {\n          "mobile" : "+6593833971"\n        }\n      ],\n      "first_name" : "Aahubby"\n    },\n    {\n      "full_name" : "Sorsi",\n      "last_name" : "",\n      "phone" : [\n        {\n          "mobile" : "+65 9778 9298"\n        }\n      ],\n      "first_name" : "Sorsi"\n    },\n    {\n      "full_name" : "Telekung SK",\n      "last_name" : "SK",\n      "phone" : [\n        {\n          "mobile" : "+60106000864"\n        }\n      ],\n      "first_name" : "Telekung"\n    },\n    {\n      "full_name" : "Minds Champ Trivett",\n      "last_name" : "Trivett",\n      "phone" : [\n        {\n          "mobile" : "81367180"\n        }\n      ],\n      "first_name" : "Minds"\n    },\n    {\n      "full_name" : "En Yusof -k. ita",\n      "last_name" : "ita",\n      "phone" : [\n        {\n\n        }\n      ],\n      "first_name" : "En Yusof"\n    }\n  ]\n}', '2017-07-17 18:00:16', '0000-00-00 00:00:00'),
(7, '04BE6F63-F25B-42A8-9041-3E71FDE540D2', '{\n  "contacts" : [\n\n  ]\n}', '2017-07-17 18:43:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `device_events`
--

CREATE TABLE IF NOT EXISTS `device_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(250) DEFAULT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `device_events`
--

INSERT INTO `device_events` (`id`, `uuid`, `detail`, `createdon`, `updatedon`) VALUES
(6, 'F3A83F82-3159-4FC9-86B5-1ED26A8F710F', '{\n  "calendar" : [\n    {\n      "alarms" : "YES",\n      "location" : "",\n      "time_zone" : "Asia\\/Singapore (GMT+8) offset 28800",\n      "start_date" : "2017-07-27 00:00:00 +0000",\n      "all_day_event" : "0",\n      "title" : "",\n      "last_modified_date" : "2017-07-10 02:35:57 +0000",\n      "end_date" : "2017-07-27 01:00:00 +0000",\n      "calendar_title" : "ida@ezzacouture.com",\n      "url" : ""\n    }\n  ]\n}', '2017-07-17 18:00:13', '0000-00-00 00:00:00'),
(7, '04BE6F63-F25B-42A8-9041-3E71FDE540D2', '{\n  "calendar" : [\n\n  ]\n}', '2017-07-17 18:43:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `device_general`
--

CREATE TABLE IF NOT EXISTS `device_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(250) DEFAULT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `device_general`
--

INSERT INTO `device_general` (`id`, `uuid`, `detail`, `createdon`, `updatedon`) VALUES
(6, 'F3A83F82-3159-4FC9-86B5-1ED26A8F710F', '{\n  "connectedVia3G" : false,\n  "carrierTelephony" : "CTRadioAccessTechnologyLTE",\n  "gps_status" : "1",\n  "batteryLevel" : 65,\n  "bluetooth_status" : false,\n  "wifi_status" : "1",\n  "ssid_data" : "",\n  "batteryState" : 1,\n  "cellIPAddress" : "100.100.186.41",\n  "devicePluggedIntoPower" : false,\n  "accessoriesPluggedIn" : false,\n  "network_type" : "WiFi",\n  "totalMemory" : 2048,\n  "carrierAllowsVOIP" : true,\n  "freeDiskSpace" : "233.04 GB",\n  "activeMemory" : 837,\n  "carrierMobileNetworkCode" : "12",\n  "batteryFullCharged" : false,\n  "remainingHoursForStandby" : "162:29",\n  "freeMemory" : 623,\n  "remainingHoursForInternetWiFi" : "7:08",\n  "totalDiskSpace" : "238.41 GB",\n  "remainingHoursForVideo" : "7:08",\n  "carrierName" : "Maxis",\n  "remainingHoursForAudio" : "32:29",\n  "currentIPAddress" : "0.0.0.0",\n  "carrierISOCountryCode" : "my",\n  "inCharge" : false,\n  "remainingHoursForInternet3g" : "6:29",\n  "inactiveMemory" : 109,\n  "usedDiskSpace" : "5.37 GB",\n  "mobileData_status" : "0",\n  "numberOfAccessoriesPluggedIn" : 0,\n  "carrierMobileCountryCode" : "502",\n  "usedMemory" : 1121,\n  "bssid" : "62:f1:89:26:b1:65",\n  "remainingHoursFor2gConversation" : "15:35",\n  "isHeadphonesAttached" : false,\n  "ssid" : "Danny S7",\n  "wiredMemory" : 174,\n  "WiFiNetmaskAddress" : "255.255.255.0",\n  "connectedViaWiFi" : true,\n  "macAddress" : "02:00:00:00:00:00",\n  "WiFiBroadcastAddress" : "0.0.0.255",\n  "externalIPAddress" : "",\n  "remainingHoursFor3gConversation" : "9:05"\n}', '2017-07-17 18:00:13', '0000-00-00 00:00:00'),
(7, '04BE6F63-F25B-42A8-9041-3E71FDE540D2', '{\n  "connectedVia3G" : false,\n  "carrierTelephony" : "CTRadioAccessTechnologyLTE",\n  "gps_status" : "1",\n  "batteryLevel" : 60,\n  "bluetooth_status" : true,\n  "wifi_status" : "1",\n  "ssid_data" : "",\n  "batteryState" : 1,\n  "cellIPAddress" : "10.145.231.118",\n  "devicePluggedIntoPower" : false,\n  "accessoriesPluggedIn" : false,\n  "network_type" : "WiFi",\n  "totalMemory" : 2048,\n  "carrierAllowsVOIP" : true,\n  "freeDiskSpace" : "233.40 GB",\n  "activeMemory" : 762,\n  "carrierMobileNetworkCode" : "12",\n  "batteryFullCharged" : false,\n  "remainingHoursForStandby" : "150:00",\n  "freeMemory" : 703,\n  "remainingHoursForInternetWiFi" : "6:36",\n  "totalDiskSpace" : "238.41 GB",\n  "remainingHoursForVideo" : "6:36",\n  "carrierName" : "Maxis",\n  "remainingHoursForAudio" : "30:00",\n  "currentIPAddress" : "192.168.43.81",\n  "carrierISOCountryCode" : "my",\n  "inCharge" : false,\n  "remainingHoursForInternet3g" : "6:00",\n  "inactiveMemory" : 245,\n  "usedDiskSpace" : "5.01 GB",\n  "mobileData_status" : "0",\n  "numberOfAccessoriesPluggedIn" : 0,\n  "carrierMobileCountryCode" : "502",\n  "usedMemory" : 1179,\n  "bssid" : "62:f1:89:26:b1:65",\n  "remainingHoursFor2gConversation" : "14:24",\n  "isHeadphonesAttached" : false,\n  "ssid" : "Danny S7",\n  "wiredMemory" : 171,\n  "WiFiNetmaskAddress" : "255.255.255.0",\n  "connectedViaWiFi" : true,\n  "macAddress" : "02:00:00:00:00:00",\n  "WiFiBroadcastAddress" : "192.168.43.255",\n  "externalIPAddress" : "",\n  "remainingHoursFor3gConversation" : "8:24"\n}', '2017-07-17 18:42:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `device_gps`
--

CREATE TABLE IF NOT EXISTS `device_gps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(250) DEFAULT NULL,
  `location_detail` longtext,
  `location_time` text,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `device_gps`
--

INSERT INTO `device_gps` (`id`, `device_id`, `location_detail`, `location_time`, `createdon`, `updatedon`) VALUES
(51, 'F3A83F82-3159-4FC9-86B5-1ED26A8F710F', '[3.158709,101.717961,01:07]|[3.158609,101.717946,01:07]|[3.158452,101.717892,01:08]|[3.158058,101.717576,01:08]|[3.157396,101.717074,01:08]|[3.157522,101.717074,01:08]|[3.157458,101.716968,01:08]|[3.158278,101.717809,01:08]|[3.158403,101.717828,01:09]|[3.158544,101.717873,01:10]|[3.159067,101.716410,01:12]|[3.158754,101.717947,01:15]|[3.158219,101.717654,01:16]|[3.158406,101.717705,02:01]|[3.158406,101.717705,02:01]|[3.158429,101.717866,02:01]|[3.158579,101.717900,02:01]|[3.158523,101.718035,02:01]|[3.158646,101.717912,02:02]|[3.156889,101.716681,02:03]', NULL, '2017-07-17 17:07:44', '2017-07-17 18:03:32'),
(52, '04BE6F63-F25B-42A8-9041-3E71FDE540D2', '[3.158636,101.717955,02:33]|[3.158448,101.717812,02:33]|[3.158350,101.717779,02:33]|[3.158218,101.717644,02:33]|[3.158147,101.717470,02:34]|[3.157918,101.717391,02:35]|[3.158212,101.717608,02:35]|[3.158423,101.717742,02:35]|[3.158581,101.717900,02:37]|[3.159178,101.716433,02:39]|[3.159237,101.716285,02:41]|[3.158656,101.717882,02:41]', NULL, '2017-07-17 18:33:45', '2017-07-17 18:41:27'),
(56, '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '[47.374649,8.537959,16:50]|[47.370966,8.535241,16:50]|[47.370966,8.535241,16:50]|[47.370606,8.534974,16:50]|[47.374649,8.537959,16:51]|[47.370551,8.534934,16:54]|[47.374649,8.537959,16:54]', NULL, '2017-07-24 14:50:12', '2017-07-24 14:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `device_info`
--

CREATE TABLE IF NOT EXISTS `device_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '4',
  `uuid` varchar(100) DEFAULT NULL,
  `device_name` varchar(100) DEFAULT NULL,
  `device_detail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `device_token` text,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  `status` enum('ONLINE','OFFLINE') NOT NULL DEFAULT 'ONLINE',
  `last_status_check` datetime DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `battery_level` varchar(20) DEFAULT NULL,
  `battery` varchar(20) DEFAULT NULL,
  `module_loading` varchar(100) DEFAULT 'Loading',
  `loading_per` varchar(100) DEFAULT 'Getting  ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `device_info`
--

INSERT INTO `device_info` (`id`, `user_id`, `uuid`, `device_name`, `device_detail`, `device_token`, `createdon`, `updatedon`, `status`, `last_status_check`, `image`, `is_delete`, `battery_level`, `battery`, `module_loading`, `loading_per`) VALUES
(51, 4, 'AEB4CA9E-B4AB-44EA-BEFA-DA80AE5C13EA', NULL, '{\n  "weight" : "607 g.",\n  "WLAN" : "WiFi 802.11 a\\/b\\/g\\/n",\n  "cameraPrimary" : "0.7 MP",\n  "proximitySensor" : false,\n  "timezone_info" : "Local Time Zone (Asia\\/Kolkata (GMT+5:30) offset 19800)",\n  "cpu" : "Apple A5",\n  "bluetooth" : "2.1",\n  "cameraSecondary" : "VGA",\n  "measurementSystem" : "Metric",\n  "deviceModel" : "iPad",\n  "displayType" : "LED-backlit IPS LCD, capacitive touchscreen",\n  "gpu" : "PowerVR SGX543MP2",\n  "systemName" : "iPhone OS",\n  "multitaskingEnabled" : true,\n  "sim" : "Micro-SIM",\n  "displayDensity" : "132 ppi",\n  "screenHeight" : 480,\n  "screenWidth" : 320,\n  "isJailbroken" : false,\n  "deviceName" : "SB iPad black",\n  "currencySimbol" : "TRY",\n  "timeZone" : "Asia\\/Kolkata",\n  "language" : "en-TR",\n  "country" : "en_TR",\n  "brightness" : 50,\n  "bootTime" : "162:42:50",\n  "currencyCode" : "TRY",\n  "platformType" : "iPad 2",\n  "systemVersion" : "9.3.2"\n}', NULL, '2017-07-17 11:55:11', '2017-07-17 17:00:12', 'ONLINE', '2017-07-17 11:55:18', NULL, 0, NULL, NULL, 'Loading', 'Getting  '),
(52, 4, 'F3A83F82-3159-4FC9-86B5-1ED26A8F710F', NULL, '{\n  "platformType" : "iPhone",\n  "weight" : "129 g.",\n  "displayDensity" : "326 ppi",\n  "language" : "en-MY",\n  "currencySimbol" : "RM",\n  "country" : "en_MY",\n  "cpu" : "Apple A8 64 bit \\/ M8",\n  "deviceName" : "iPhone 7",\n  "isJailbroken" : false,\n  "screenHeight" : 568,\n  "bluetooth" : "4.0",\n  "gpu" : "PowerVR GX6650 (hexa-core graphics)",\n  "WLAN" : "Wi-Fi 802.11 a\\/b\\/g\\/n\\/ac",\n  "systemName" : "iOS",\n  "sim" : "Nano-SIM",\n  "multitaskingEnabled" : true,\n  "cameraPrimary" : "8.0 MP",\n  "timeZone" : "Asia\\/Kuala_Lumpur",\n  "currencyCode" : "MYR",\n  "timezone_info" : "Local Time Zone (Asia\\/Kuala_Lumpur (MYT) offset 28800)",\n  "measurementSystem" : "Metric",\n  "deviceModel" : "iPhone",\n  "screenWidth" : 320,\n  "displayType" : "Retina HD",\n  "systemVersion" : "10.3.1",\n  "brightness" : 35.72091,\n  "bootTime" : "00:01:45",\n  "proximitySensor" : true,\n  "cameraSecondary" : "1.2 MP"\n}', NULL, '2017-07-17 17:00:28', '2017-07-17 18:18:27', 'ONLINE', '2017-07-17 18:15:00', NULL, 0, 'OK', NULL, 'Contact info', '60'),
(53, 4, '04BE6F63-F25B-42A8-9041-3E71FDE540D2', NULL, '{\n  "platformType" : "iPhone",\n  "weight" : "129 g.",\n  "displayDensity" : "326 ppi",\n  "language" : "en-MY",\n  "currencySimbol" : "RM",\n  "country" : "en_MY",\n  "cpu" : "Apple A8 64 bit \\/ M8",\n  "deviceName" : "iPhone",\n  "isJailbroken" : false,\n  "screenHeight" : 568,\n  "bluetooth" : "4.0",\n  "gpu" : "PowerVR GX6650 (hexa-core graphics)",\n  "WLAN" : "Wi-Fi 802.11 a\\/b\\/g\\/n\\/ac",\n  "systemName" : "iOS",\n  "sim" : "Nano-SIM",\n  "multitaskingEnabled" : true,\n  "cameraPrimary" : "8.0 MP",\n  "timeZone" : "Asia\\/Kuala_Lumpur",\n  "currencyCode" : "MYR",\n  "timezone_info" : "Local Time Zone (Asia\\/Kuala_Lumpur (MYT) offset 28800)",\n  "measurementSystem" : "Metric",\n  "deviceModel" : "iPhone",\n  "screenWidth" : 320,\n  "displayType" : "Retina HD",\n  "systemVersion" : "10.3.1",\n  "brightness" : 0.6530212,\n  "bootTime" : "01:14:28",\n  "proximitySensor" : true,\n  "cameraSecondary" : "1.2 MP"\n}', NULL, '2017-07-17 18:33:43', '2017-07-17 23:44:16', 'ONLINE', '2017-07-17 18:43:48', NULL, 0, 'OK', NULL, 'Event Info', '80'),
(55, 4, '65DF7D3C-2934-43D3-AA2A-37681924042B', NULL, '{\n  "weight" : "88 g.",\n  "WLAN" : "Wi-Fi 802.11 a\\/b\\/g\\/n, dual-band",\n  "cameraPrimary" : "5.0 MP",\n  "proximitySensor" : false,\n  "timezone_info" : "Local Time Zone (America\\/New_York (GMT-4) offset -14400 (Daylight))",\n  "cpu" : "Apple A5",\n  "bluetooth" : "4.0",\n  "cameraSecondary" : "1.2 MP",\n  "measurementSystem" : "Metric",\n  "deviceModel" : "iPod touch",\n  "displayType" : "LED-backlit IPS LCD, capacitive touchscreen",\n  "gpu" : "625",\n  "systemName" : "iPhone OS",\n  "multitaskingEnabled" : true,\n  "sim" : "",\n  "displayDensity" : "326 ppi",\n  "screenHeight" : 568,\n  "screenWidth" : 320,\n  "isJailbroken" : false,\n  "deviceName" : "Rajendra''s iPod touch",\n  "currencySimbol" : "TRY",\n  "timeZone" : "America\\/New_York",\n  "language" : "en-IN",\n  "country" : "en_TR",\n  "brightness" : 47.66246,\n  "bootTime" : "00:03:45",\n  "currencyCode" : "TRY",\n  "platformType" : "iPod Touch 5",\n  "systemVersion" : "9.3.5"\n}', NULL, '2017-07-19 05:07:40', '2017-07-21 05:15:20', 'ONLINE', NULL, NULL, 0, NULL, NULL, 'Loading', 'Getting  '),
(57, 4, '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', NULL, '{\n  "platformType" : "iPhone 5s",\n  "weight" : "112 g.",\n  "displayDensity" : "326 ppi",\n  "language" : "de-CH",\n  "currencySimbol" : "CHF",\n  "country" : "de_CH",\n  "cpu" : "Apple A7 64 bit \\/ M7",\n  "deviceName" : "P.Zehnders iPhone",\n  "isJailbroken" : false,\n  "screenHeight" : 568,\n  "bluetooth" : "4.0",\n  "gpu" : "PowerVR SGX 543MP3 (triple-core graphics)",\n  "WLAN" : "Wi-Fi 802.11 a\\/b\\/g\\/n, dual-band",\n  "systemName" : "iOS",\n  "sim" : "Nano-SIM",\n  "multitaskingEnabled" : true,\n  "cameraPrimary" : "8.0 MP",\n  "timeZone" : "Europe\\/Zurich",\n  "currencyCode" : "CHF",\n  "timezone_info" : "Local Time Zone (Europe\\/Zurich (MESZ) offset 7200 (Daylight))",\n  "measurementSystem" : "Metric",\n  "deviceModel" : "iPhone",\n  "screenWidth" : 320,\n  "displayType" : "LED IPS LCD",\n  "systemVersion" : "10.3.3",\n  "brightness" : 34.27523,\n  "bootTime" : "00:26:50",\n  "proximitySensor" : true,\n  "cameraSecondary" : "1.2 MP, 720p"\n}', NULL, '2017-07-24 14:49:59', '2017-07-24 15:20:26', 'ONLINE', '2017-07-24 15:29:49', NULL, 0, NULL, NULL, 'Loading', 'Getting  ');

-- --------------------------------------------------------

--
-- Table structure for table `device_setting`
--

CREATE TABLE IF NOT EXISTS `device_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(250) DEFAULT NULL,
  `auto_sync` tinyint(4) NOT NULL DEFAULT '0',
  `auto_sleep` tinyint(4) NOT NULL DEFAULT '0',
  `sync_time` time DEFAULT NULL,
  `screen_recording_activate` int(11) NOT NULL DEFAULT '0',
  `ocrvideo_recording` tinyint(4) NOT NULL DEFAULT '0',
  `ocrscreenshot` tinyint(4) NOT NULL DEFAULT '0',
  `ocrtype` tinyint(4) NOT NULL DEFAULT '0',
  `media_sync` varchar(100) DEFAULT NULL,
  `microphone` varchar(100) DEFAULT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `device_setting`
--

INSERT INTO `device_setting` (`id`, `uuid`, `auto_sync`, `auto_sleep`, `sync_time`, `screen_recording_activate`, `ocrvideo_recording`, `ocrscreenshot`, `ocrtype`, `media_sync`, `microphone`, `createdon`, `updatedon`) VALUES
(31, '04BE6F63-F25B-42A8-9041-3E71FDE540D2', 0, 0, '00:50:00', 0, 0, 0, 0, NULL, '0', '2017-07-17 18:43:45', '2017-07-18 06:12:31'),
(32, '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 0, 0, '00:00:00', 0, 0, 0, 0, NULL, '0', '2017-07-24 14:55:19', '2017-07-24 15:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) DEFAULT NULL,
  `method` varchar(6) DEFAULT NULL,
  `params` text,
  `api_key` varchar(40) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` tinyint(1) DEFAULT NULL,
  `response` longtext NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(250) DEFAULT NULL,
  `filepath` varchar(250) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `module` varchar(250) DEFAULT NULL,
  `device_id` varchar(250) DEFAULT NULL,
  `media_datetime` datetime NOT NULL,
  `other` text,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1150 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `app_name`, `filepath`, `file_name`, `file_type`, `module`, `device_id`, `media_datetime`, `other`, `createdon`, `updatedon`) VALUES
(1071, 'GALLERY', 'Camera Roll', '596cfb2f1eafc.jpg', 'IMAGE', 'GALLERY', 'F3A83F82-3159-4FC9-86B5-1ED26A8F710F', '2017-07-17 18:00:15', '', '2017-07-17 18:00:15', NULL),
(1072, 'GALLERY', 'Camera Roll', '596cfb32316dd.jpg', 'IMAGE', 'GALLERY', 'F3A83F82-3159-4FC9-86B5-1ED26A8F710F', '2017-07-17 18:00:18', '', '2017-07-17 18:00:18', NULL),
(1073, 'GALLERY', 'Camera Roll', '596cfb342ae29.jpg', 'IMAGE', 'GALLERY', 'F3A83F82-3159-4FC9-86B5-1ED26A8F710F', '2017-07-17 18:00:20', '', '2017-07-17 18:00:20', NULL),
(1074, 'GALLERY', 'Camera Roll', '596d05385cad6.jpg', 'IMAGE', 'GALLERY', '04BE6F63-F25B-42A8-9041-3E71FDE540D2', '2017-07-17 18:43:04', '', '2017-07-17 18:43:04', NULL),
(1075, 'GALLERY', 'Camera Roll', '596d0539aa470.jpg', 'IMAGE', 'GALLERY', '04BE6F63-F25B-42A8-9041-3E71FDE540D2', '2017-07-17 18:43:05', '', '2017-07-17 18:43:05', NULL),
(1076, 'GALLERY', 'Camera Roll', '596d053b0975b.jpg', 'IMAGE', 'GALLERY', '04BE6F63-F25B-42A8-9041-3E71FDE540D2', '2017-07-17 18:43:07', '', '2017-07-17 18:43:07', NULL),
(1077, 'GALLERY', 'Camera Roll', '596d053bf1c21.jpg', 'IMAGE', 'GALLERY', '04BE6F63-F25B-42A8-9041-3E71FDE540D2', '2017-07-17 18:43:07', '', '2017-07-17 18:43:07', NULL),
(1149, 'Recording', '', '5976114b69714.mp3', 'audio', 'Voice Recording', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '2017-07-24 15:24:59', '5976114b67a2b.caf', '2017-07-24 15:24:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ocr_media`
--

CREATE TABLE IF NOT EXISTS `ocr_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) DEFAULT NULL,
  `device_id` varchar(250) DEFAULT NULL,
  `ocr_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `createdon` datetime NOT NULL,
  `video_made` tinyint(4) NOT NULL DEFAULT '2',
  `ocr_code` varchar(100) DEFAULT NULL,
  `ocr_type` tinyint(4) NOT NULL DEFAULT '0',
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=571 ;

--
-- Dumping data for table `ocr_media`
--

INSERT INTO `ocr_media` (`id`, `file_name`, `device_id`, `ocr_text`, `createdon`, `video_made`, `ocr_code`, `ocr_type`, `updatedon`) VALUES
(1, '785127596_590733d07f067.jpg', '918798EA-0835-474E-816F-DF8517930E52', 'No SN ‘3\n\nI E} \n\n/ Ma“ Calendar Photos‘ Camela\n\n3%\n\nMaps mock \\ .\n\n,szaom‘ . @431 ~+\n\n \n\n \n\n \n\n- v a \\\n‘ ''~ Wel‘e! Notes Remln evé iTunes Store\nL l_’\n\n, App Share” ABooks Videos Home\nK > ‘ a ‘:', '2017-05-01 13:10:40', 1, '785127596', 0, '2017-05-01 20:10:40'),
(2, '785127596_590733d9b1d83.jpg', '918798EA-0835-474E-816F-DF8517930E52', 'Nos‘M . 6:40PM (I) 4 l2! -4\n\n\n\nDev" Quest Searchin Sky/De ", , ‘\n\n \n\n    \n \n\nMaster Em Tubex ‘\nsApp TubeUs vxTubeBuz..«. CF edv2\nguzz Kidneyczrev , ~L''u_myev Screade\n\ni B V@\n\\—\n\nBudd Fllmbas\n3', '2017-05-01 13:10:49', 1, '785127596', 2, '2017-05-01 20:10:49'),
(3, '785127596_590733e2ca988.jpg', '918798EA-0835-474E-816F-DF8517930E52', '1 UP NEXT\n\nNo Upcoming Events, Reminders or A‘arms\n\nShow More\n\nSemngs\n\nrk-J‘W .-\nShow More\nmmansxpms 1,0“\nSamsung, Apple retain mp positions 5-\nin smartphone market in 012017: IDC\n1d\n‘ ‘—\n\n \n\nI a WEATHER Show Mare', '2017-05-01 13:10:58', 1, '785127596', 1, '2017-05-01 20:10:58'),
(4, '785127596_590733f16a062.jpg', '918798EA-0835-474E-816F-DF8517930E52', '1 UP NEXT\n\nNo Upcomlng Evems, Reminders or A‘arms\n\n \n  \n\n1 swan APP SUGGESTIONS Show More\n\n   \n\nW‘Hmve W‘kDev Semngs\n''EI''“ -“\nNEWS Show More\nmmansxpn—ss cm-\nSamsung, Apple retain top positions\nr in smartphone market in 012017: IDC\n"d\n‘-\n\n \n\nio WEATHER Show More ‘', '2017-05-01 13:11:13', 1, '785127596', 0, '2017-05-01 20:11:13'),
(6, '594247772_590738d049333.jpg', '918798EA-0835-474E-816F-DF8517930E52', 'Nosxm''v‘ V7:01PM ‘ . @qu ~+\n‘ ’ l ‘ v‘\n'' Mum / ,\nNth" I 6 ® -\n‘ /\nNgum Devm Quest Searchlly Skype ,\n\n \n\nSocialMasler Qriry \\ , Tubex\n\nI, . m x ,\n\nQ ‘ 5% '' Q ‘ 6 ‘\n\n‘ 1 WhatsApp TubeUs VwTube uzf. CF Med V2\n~ l.,\n\n. Q \\ \\/\n\n« pany 5.12} J Kidneycare Lumyer Screade\n\n           \n \n\n''', '2017-05-01 13:32:00', 1, '594247772', 0, '2017-05-01 20:32:00'),
(7, '594247772_590738d61d6d8.jpg', '918798EA-0835-474E-816F-DF8517930E52', 'Mama,\n\n \n\nCalendar\n\n(Jack\n\nNews\n\nBot: ks\n\n@\n\nSemngs\n\n \n\nPhoKos\n\nRemindevs\n\n7:01 PM\n\nCamera\n\n\\Tunes Sxore\n\n \n\nC\n\n \n\n.EaceTirne\n\nEARNNAM...\n\n30‘\n\nVideos \\ n\n\nHome\n\nFacebook', '2017-05-01 13:32:06', 1, '594247772', 0, '2017-05-01 20:32:06'),
(8, '594247772_590738dd4289d.jpg', '918798EA-0835-474E-816F-DF8517930E52', 'Nos‘M? 7:01PM (940-4\n\n''66\n\n \n\n \n\nMail Calendar Photo{ . dial-Here ''4\n_ ; n,- » ’\n, ’5'' . _\nV ‘ ‘7‘ \nMaps Clock ‘ Weather .‘ lsfocks''\nWane: Mmes \\Remindeé iTunes Store\n\n" ))\nIll 6 0\n\nApp Store ~ ‘ Books: Videos Home', '2017-05-01 13:32:13', 1, '594247772', 0, '2017-05-01 20:32:13'),
(9, '594247772_590738e1db49b.jpg', '918798EA-0835-474E-816F-DF8517930E52', 'No SN ’6 7:01 PM\n\n.\n\n \n\n \n\n \n\n/\nMall Calendar Photo{. gCaI-ﬁera '' 7\nMaps Clock\nWane: Noﬁes \\Remindexé iTunes Store\n\n  \n\n    \n\nHeaﬂh N \\‘', '2017-05-01 13:32:17', 1, '594247772', 0, '2017-05-01 20:32:17'),
(10, '105347304_590812585cf6c.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '', '2017-05-02 05:00:08', 1, '105347304', 0, '2017-05-02 12:00:08'),
(11, '105347304_59081259cc9a6.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM 11 9AM ‘1 l2}\n\n   \n\nID*\n:0.', '2017-05-02 05:00:09', 1, '105347304', 0, '2017-05-02 12:00:09'),
(12, '105347304_5908125b5b681.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM 11 9 AM\n\nW‘Ileve\n\n   \n\n''0‘\n:0.', '2017-05-02 05:00:11', 1, '105347304', 0, '2017-05-02 12:00:11'),
(13, '105347304_5908125cae023.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM 1“ 11:59AM\n\n''0‘\n:0.', '2017-05-02 05:00:12', 1, '105347304', 0, '2017-05-02 12:00:12'),
(14, '105347304_5908125e09fb5.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM 1“ 11:59AM\n\n''0‘\n:0.', '2017-05-02 05:00:14', 1, '105347304', 0, '2017-05-02 12:00:14'),
(15, '105347304_59081260624db.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM 11 9 AM\n\nW‘Iilee\n\n   \n\n''0‘\n:0.', '2017-05-02 05:00:16', 1, '105347304', 0, '2017-05-02 12:00:16'),
(16, '105347304_590812628201e.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM 1“ 11:59AM\n\n''0‘\n:0.', '2017-05-02 05:00:18', 1, '105347304', 0, '2017-05-02 12:00:18'),
(17, '105347304_59081264657af.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '', '2017-05-02 05:00:20', 1, '105347304', 0, '2017-05-02 12:00:20'),
(18, '834125312_5908136149c76.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM 12 2PM ‘1 l2}', '2017-05-02 05:04:33', 1, '834125312', 0, '2017-05-02 12:04:33'),
(19, '834125312_59081362ee601.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM 12 2 PM\n\nW‘Iilee\n\n   \n\n''0‘\n.0.', '2017-05-02 05:04:34', 1, '834125312', 0, '2017-05-02 12:04:34'),
(20, '834125312_590813646c85b.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM 12 2 PM\n\n   \n\n''0‘\n.0.', '2017-05-02 05:04:36', 1, '834125312', 0, '2017-05-02 12:04:36'),
(21, '834125312_59081365c375c.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '', '2017-05-02 05:04:37', 1, '834125312', 0, '2017-05-02 12:04:37'),
(22, '834125312_5908136aaac00.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM 12 2 PM\n\nW‘Iilee', '2017-05-02 05:04:42', 1, '834125312', 0, '2017-05-02 12:04:42'),
(23, '834125312_5908136cbdf94.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM 3‘ 12:02 PM', '2017-05-02 05:04:44', 1, '834125312', 0, '2017-05-02 12:04:44'),
(24, '834125312_5908136e5d775.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM 12 2 PM', '2017-05-02 05:04:46', 1, '834125312', 0, '2017-05-02 12:04:46'),
(25, '834125312_590813701beff.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM 12 2 PM\n\nW‘Ileve\n\n   \n\nI0*\n:0.', '2017-05-02 05:04:48', 1, '834125312', 0, '2017-05-02 12:04:48'),
(26, '834125312_59081375afa44.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM 12 2 PM', '2017-05-02 05:04:53', 1, '834125312', 0, '2017-05-02 12:04:53'),
(27, '834125312_5908137757f6b.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM 12 2 PM', '2017-05-02 05:04:55', 1, '834125312', 0, '2017-05-02 12:04:55'),
(28, '834125312_59081379cbe92.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'AirPlay AirDrop:\nA Mirroring Receiving Off\n\n Night shin: Off\n\nE m', '2017-05-02 05:04:57', 1, '834125312', 0, '2017-05-02 12:04:57'),
(29, '834125312_5908137b6e5dd.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM 1“ 12:03 PM\n\n''0''\n.0.', '2017-05-02 05:04:59', 1, '834125312', 0, '2017-05-02 12:04:59'),
(30, '834125312_5908137d97cb8.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM ‘I 03 PM\n\nW17Lwe\n\nTuesday *\n2 . [a', '2017-05-02 05:05:01', 1, '834125312', 0, '2017-05-02 12:05:01'),
(31, '834125312_5908138147483.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM "\n\n \n\n03 PM\n\n \n\n< Collections Moments Q Select\n\nImpact Arena >\nYesmmay 1 San Mai, Nomhabun\n\n   \n\n015\n\nImpact Arena >\n7:53 AM - Ban Mai. Nomhaburi\n\n   \n\nPhoms', '2017-05-02 05:05:05', 1, '834125312', 0, '2017-05-02 12:05:05'),
(32, '834125312_5908138579943.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM "\n\n \n\n03 PM\n\n \n\n< Collections Moments Q Select\n\nImpact Arena >\nYesmday 1 Ban Mai, Nomhabun\n\n   \n\n015\n\nImpact Arena >\n7:53 AM - Ban Mal. Nomhaburi\n\n   \n\nPhotos', '2017-05-02 05:05:09', 1, '834125312', 0, '2017-05-02 12:05:09'),
(33, '834125312_590813877dc40.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM . 12:03 PM\n\nEl\n\nTuesday ‘\n2 . (a', '2017-05-02 05:05:11', 1, '834125312', 0, '2017-05-02 12:05:11'),
(34, '834125312_5908138ad6165.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'o\n\n12:03 PM 1 ID\nW17Lwe\n\nB ota.io C\n\nW1 INSTALL\n\nW1\n\nApnl 28, 2017 @ 6:49AM\n\nI\n\n. Install Application\n\n \n\n \n   \n   \n\nFacebook® Account\nSig n Up\n\nDeployed by AppSendr\n\nMacApp | API l Twmer', '2017-05-02 05:05:14', 1, '834125312', 0, '2017-05-02 12:05:14'),
(35, '834125312_5908138c558f3.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No Notifications', '2017-05-02 05:05:16', 1, '834125312', 0, '2017-05-02 12:05:16'),
(36, '834125312_5908138ed7ca2.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'AirPlay AirDrop:\nA Mirroring Receiving Off\n\n Night Shift: on\n\nGEE', '2017-05-02 05:05:18', 1, '834125312', 0, '2017-05-02 12:05:18'),
(37, '834125312_5908139048a7e.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '', '2017-05-02 05:05:20', 1, '834125312', 0, '2017-05-02 12:05:20'),
(38, '834125312_5908139261eb0.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '12 PM ‘1\nW‘liLwe\n\nTucsriay a g\n\n[I', '2017-05-02 05:05:22', 1, '834125312', 0, '2017-05-02 12:05:22'),
(39, '834125312_59081393e6bbd.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM 12:04 PM ‘1 l2}', '2017-05-02 05:05:23', 1, '834125312', 0, '2017-05-02 12:05:23'),
(40, '834125312_590813961f1d8.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM 12''04 PM ‘1 l2}\n\nW‘IiLive\n\nTuesday *\n2 . m', '2017-05-02 05:05:26', 1, '834125312', 0, '2017-05-02 12:05:26'),
(41, '834125312_590813992344c.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM . 12:04 PM ‘1 ''21\n\nTuesday *\n2 . m', '2017-05-02 05:05:29', 1, '834125312', 0, '2017-05-02 12:05:29'),
(42, '834125312_5908139aee6c2.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '', '2017-05-02 05:05:30', 1, '834125312', 0, '2017-05-02 12:05:30'),
(43, '834125312_5908139d4b913.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '12:04 PM', '2017-05-02 05:05:33', 1, '834125312', 0, '2017-05-02 12:05:33'),
(44, '834125312_5908139fbfe21.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '', '2017-05-02 05:05:35', 1, '834125312', 0, '2017-05-02 12:05:35'),
(46, '1212121212_59082d9f07c25.png', 'deepak', 'Hellossss', '2017-05-02 06:56:31', 2, '1212121212', 0, '2017-05-02 13:56:31'),
(69, '404402224_59084419dd4f6.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '', '2017-05-02 08:32:25', 1, '404402224', 0, '2017-05-02 15:32:25'),
(70, '404402224_5908441c0c957.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '', '2017-05-02 08:32:28', 1, '404402224', 0, '2017-05-02 15:32:28'),
(71, '404402224_5908441e4696c.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'J\nO\n..n\nS\nS\ne\nr\nD.', '2017-05-02 08:32:30', 1, '404402224', 0, '2017-05-02 15:32:30'),
(72, '967831530_5908458987336.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '', '2017-05-02 08:38:33', 1, '967831530', 0, '2017-05-02 15:38:33'),
(73, '967831530_5908458c6db35.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM 3‘ 3:38 PM 1 [2| 20%I7)\nW‘IiLive\n\nTuesday F .\n3 ‘\nat E\n\nr f\n\n2\n03%\n-:', '2017-05-02 08:38:36', 1, '967831530', 0, '2017-05-02 15:38:36'),
(74, '967831530_59084590a4860.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', '< Collections Moments Q Select\n\nImpact Arena >\nYesmmay 1 San Mai, Nomhabun\n\n“IA”\n015\n\nImpact Arena >\n7:53 AM -12204 PM v Ban Mal, Nomhabun\n\n   \n\n   \n\nPhoms', '2017-05-02 08:38:40', 1, '967831530', 0, '2017-05-02 15:38:40'),
(75, '967831530_590845956429c.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM "F 3238 PM\nW ''1 r L ‘ ve\n< Years Collections\n\nImpact Arena\nMon - Today‘ Ban Mai, Nonthaburi\n\n   \n\n   \n\nPhotos', '2017-05-02 08:38:45', 1, '967831530', 0, '2017-05-02 15:38:45'),
(76, '967831530_590845979830b.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'TIMEVLAPSE SQUARE PM:\n\n''n‘\n\n-', '2017-05-02 08:38:47', 1, '967831530', 0, '2017-05-02 15:38:47'),
(77, '967831530_5908459b5852e.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'TIME-LAPSE PHOTO SQUARE PANO', '2017-05-02 08:38:51', 1, '967831530', 0, '2017-05-02 15:38:51'),
(78, '967831530_5908459ed38c7.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM ''1‘ 3238 PM 4 El 20%| r\n\nTUa''gday‘ n m\n2 ‘', '2017-05-02 08:38:54', 1, '967831530', 0, '2017-05-02 15:38:54'),
(79, '967831530_590845a357403.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'No SIM ‘7‘ 3:38 PM 20%\n\nTuesday *\n2 . (a', '2017-05-02 08:38:59', 1, '967831530', 0, '2017-05-02 15:38:59'),
(80, '967831530_590845a6e41a2.jpg', '37DA8669-3B12-40EE-B566-4E0C0BBC8FE2', 'N0 SIM\n\n \n\n8 PM ‘1\nW1~L|ve\n\nTuesday *\n2 . m', '2017-05-02 08:39:02', 1, '967831530', 0, '2017-05-02 15:39:02'),
(81, '530397723_5908500296bc5.jpg', '3C4BE6BE-35EE-44AB-83FA-F1182C2B5C89', 'No Service 1* 4:22 PM 1 El >8 .3\nﬂ ota.io 0\n\nW1 INSTALL\n\n\\ W1\n\nMay 1, 2017 @ 12:34PM\n\nI\n\n. Install Application\n\n \n\n \n   \n   \n \n\nAmencan Schom\nBangkok\n\nDeployed by AppSendr\n\nMac App I AF''I I Twitter\n\n \n\n \n\n< ﬁmi', '2017-05-02 09:23:14', 1, '530397723', 0, '2017-05-02 16:23:14'),
(82, '530397723_5908500707528.jpg', '3C4BE6BE-35EE-44AB-83FA-F1182C2B5C89', 'No So! 4222 PM\n\n \n\nW 1 Lwe\n\nﬂ ota.io 0\n\nW1 INSTALL\n\nW1\n\nMay 1. 2017 @12:34PM\n\nI\n\n. Install Application\n\n \n\n \n   \n   \n\nAmencan Schoo‘\nBangkok\n\nDeployed by AppSendr\n\nMac App I API I Twitter\n\n \n\n< ELI]?', '2017-05-02 09:23:19', 1, '530397723', 0, '2017-05-02 16:23:19'),
(83, '530397723_5908500d0ba33.jpg', '3C4BE6BE-35EE-44AB-83FA-F1182C2B5C89', 'No Sen/u.\n\n \n\nﬂ ota.io 0\n\nW1 INSTALL\n\nW1\n\nMay 1. 2017 @12:34PM\n\nI\n\n. Install Application\n\n \n\n \n   \n   \n\nAmencan Schom\nBangkok\n\nDeployed by AppSendr\n\nMac App I API I Twitter\n\n \n\n< ﬁg]?', '2017-05-02 09:23:25', 1, '530397723', 0, '2017-05-02 16:23:25'),
(84, '530397723_59085013e26ec.jpg', '3C4BE6BE-35EE-44AB-83FA-F1182C2B5C89', 'it\n\n     \n \n\nFaceTinié Calculator\n\n \n\nEx‘ras YouTu be', '2017-05-02 09:23:31', 1, '530397723', 0, '2017-05-02 16:23:31'),
(85, '530397723_5908501990154.jpg', '3C4BE6BE-35EE-44AB-83FA-F1182C2B5C89', 'Mawl Calendar Photos Camera\n\n‘WW\n\nWeamer Stocks\n\nReminders iTunes Store', '2017-05-02 09:23:37', 1, '530397723', 0, '2017-05-02 16:23:37'),
(86, '530397723_5908501dcbeb4.jpg', '3C4BE6BE-35EE-44AB-83FA-F1182C2B5C89', 'iPhone Speaker', '2017-05-02 09:23:41', 1, '530397723', 0, '2017-05-02 16:23:41'),
(241, '173018989_590c708c5a0b4.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-05 12:31:08', 1, '173018989', 0, '2017-05-05 19:31:08'),
(242, '406261961_590c711cb9f93.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Edit\n\n@090\n\n3\n\nMessages (1)\n\n \n\nAIS 5:06 PM\nMao Mao 99Baht, you can enjoy\nunlimited Internet at max speed‘l Mb...\n\nAISCaIIing 2/18/2560 3E I\nvliwmsammm. nm *152# Nam/1% ﬁaaﬁ\nwaiLula Tm *888 (Eu/u)\n\n086-327-3322 2/16/2560 BE\n0863273322(1) Tmmqmlﬁa 16/02/17,\n09152.Tl’ll$ number called you.\n\n02-271-9123 12/13/2559 BE\n0899988167 Lﬁm‘iuﬁmrﬁmuai''qmﬁlﬁu\nLﬁuﬁu 100 mv:', '2017-05-05 12:33:32', 1, '406261961', 0, '2017-05-05 19:33:32'),
(243, '406261961_590c712655dbe.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Edit\n\n0690\n\n3\n\nMessages (1)\n\n \n\nAIS 5:06 PM\nMao Mao 99Baht, you can enjoy\nunlimited Internet at max speed1 Mb...\n\nAISCaIIing 2/18/2560 EgE I\nW§meiammw nm *152# Twaﬁwﬁ ﬁaaﬁ\nmaiLula Tm *888 (Eu/u)\n\n086-327-3322 2/16/2560 BE\n08632733220) Tmmqmia 16/02/17,\n09:52, This number called you.\n\n02-271-9123 12/13/2559 BE\n0899988157 Lﬁuﬁuﬁmrfmuas''qmﬁaﬁq\nGuﬁu 100 mv:', '2017-05-05 12:33:42', 1, '406261961', 0, '2017-05-05 19:33:42'),
(244, '406261961_590c71296eee6.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '086-327»3322\n\nTen Message\nThu,Feb16,9 52 AM\n\n9§_6_32_73_322(1) Twwmmu‘ja\n16/02/17, 09:52. This number\ncalled you.\n\n539% 0', '2017-05-05 12:33:45', 1, '406261961', 0, '2017-05-05 19:33:45'),
(245, '406261961_590c712c3d84d.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '086-327>3322\n\nText Message\nThu,Feb16,9 52 AM\n\nQ§§327§322(1) Twmnqmﬁa\n16/02/17, 09:52. This number\ncalled you.\n\n(39% 0', '2017-05-05 12:33:48', 1, '406261961', 0, '2017-05-05 19:33:48'),
(246, '406261961_590c712ef2d07.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '086-327>3322\n\nText Message\nThu,Feb16,9 52 AM\n\nQ§§327§322(1) Twmnqmﬁa\n16/02/17, 09:52. This number\ncalled you.\n\n(39% 0', '2017-05-05 12:33:50', 1, '406261961', 0, '2017-05-05 19:33:50'),
(247, '406261961_590c7132486c7.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '086-327>3322\n\nText Message\nThu,Feb16,9 52 AM\n\nQ§§327§322(1) Twmnqmﬁa\n16/02/17, 09:52. This number\ncalled you.\n\n(39% 0', '2017-05-05 12:33:54', 1, '406261961', 0, '2017-05-05 19:33:54'),
(248, '406261961_590c7138e86dc.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '.0000 AIS 1“ 7:32 PM ‘1 D X 49%“\n\n330 * 30\nl |\n\n\\\\\\\\\\\\\\\\\\u Ill////////\n\\\\\\\\\\\\\\\\\\\\ N %\n\n300 60\n\n///////////////\n\\\\\n\\\\\\\\\\\\\\\\\\\\\\\\\\\\\n\n270 90\n\n\\\\\\ll|HI//\nE\nm\n\nIll/(HIM\n\n/\n////////////\n\nw\\\\\\\n\n240 20\n\n’//// s \\\\\\\\\\‘\n/’/////////mmm\\\\\\\\\\\\\\\\\\\\\\\\\\\n\n210 150\n180\n\nONO', '2017-05-05 12:34:00', 1, '406261961', 0, '2017-05-05 19:34:00'),
(249, '406261961_590c713e6ab57.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '0\n3\n\na!\n\n33°\n\n0\n6\n\n//////\n\nHill/W\n\nN\n\nW\nxxx\n\\\\\\\n\n\\\\\\\\\no§§==a\n\n30\n\nO\n9\n\n2::\n\nE\n\nW\n\nm\n2\n\n\\\\§\n\n20\n\n\\x\\\\\n\n15°\n\n\\\\\n\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\n\nS\n\nmum“\n\nW”\n210\n\n¢/\n%\n\na?\n\nO\n\n24\n\n18°', '2017-05-05 12:34:06', 1, '406261961', 0, '2017-05-05 19:34:06'),
(250, '406261961_590c7140ee850.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'ooooo AIS "F 7:32 PM ‘1 W X 4934.3\n\n \n\nTilt the screen to roll the\nball around the circle\n\nCancel', '2017-05-05 12:34:08', 1, '406261961', 0, '2017-05-05 19:34:08'),
(251, '406261961_590c71446a20b.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Z S\n’/y § 120\n240 ////// S \\\\\\\\\\\n// \\\\\n///////////muu\\\\\\\\\\\\\\\\\\\\\\\\\\\\\n210 15\nW)\nO\n_ _ Bang Khen\nBangkok\n\n13°51’48" N 100°36’35" E\n20 m Elevation', '2017-05-05 12:34:12', 1, '406261961', 0, '2017-05-05 19:34:12'),
(252, '406261961_590c714689cfa.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-05 12:34:14', 1, '406261961', 0, '2017-05-05 19:34:14'),
(253, '406261961_590c7148d5750.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-05 12:34:16', 1, '406261961', 0, '2017-05-05 19:34:16'),
(254, '406261961_590c714b1e58f.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-05 12:34:19', 1, '406261961', 0, '2017-05-05 19:34:19'),
(255, '406261961_590c715a9e9b9.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Edit\n\noboe\n\n3\n\nMessages (1)\n\n \n\nAIS 5:06 PM\nMac Mac 99Baht, you can enjoy\nunlimited Internet at max speed‘} Mb...\n\nAISCaIIing 2/18/2560 5E I\nW§meiaaw1nnm *152# Twamvﬁ ﬁaaﬁ\nwaiLula Tm “888 (Eu/u)\n\n086-327-3322 2/16/2560 BE\n0863273322(1) T‘Ylivl’lﬂmlﬁa 16/02/17,\n09:52. Thxs number called you.\n\n02-271-9123 12/13/2559 BE\n0899988167 Lﬁuﬁuﬁmﬁmuas''qmﬁﬁd\nGuﬁu 100 mvu', '2017-05-05 12:34:34', 1, '406261961', 0, '2017-05-05 19:34:34'),
(256, '461257257_590ecce974e8a.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsung White C10 %\n\nToday\n\nA Messages you send to mis chat and calls\nare now secured with end»to»end\nencryption. Tap for more info,\n\nTest\n\n+| ex?»\n\nQWERTYUIOP\n\n \n\nASDFGHJKL\n\niZXCVBNMQ\n\n \n\n123 Q space return', '2017-05-07 07:29:45', 1, '461257257', 2, '2017-05-07 14:29:45'),
(257, '461257257_590eccebe8a7a.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '18;', '2017-05-07 07:29:47', 1, '461257257', 2, '2017-05-07 14:29:47'),
(258, '461257257_590eccf0dbd9a.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'm: mm mum; (a: z 28 pm\n\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap (or more info.\n\nTest\n\n+ «Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 59 space return', '2017-05-07 07:29:52', 1, '461257257', 2, '2017-05-07 14:29:52'),
(259, '461257257_590eccf7238d2.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS\n\n \n\n29 PM 1:! 31%\nW1*LlVe\n\n< Samsungwhite On %\n\nm: smw lmmy a: 2 28 PM\n1 Today\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest\n\n+\na\n(c;', '2017-05-07 07:29:59', 1, '461257257', 2, '2017-05-07 14:29:59'),
(260, '461257257_590eccfa0823e.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Edit Cha‘s :l/\n\n \n\nBroadcast Lists New Group\nSamsung White 2 23 PM\nW Test\n\n@g@¢)\n\n'', v y Chats', '2017-05-07 07:30:02', 1, '461257257', 2, '2017-05-07 14:30:02'),
(261, '461257257_590eccfcc41c9.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-07 07:30:04', 1, '461257257', 2, '2017-05-07 14:30:04'),
(262, '461257257_590ecd02a816b.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'A‘S\n\n-)\n\n2''29 PM\nWWVLwe\n\n"WeChat" Would Like to Send\nYbu Noﬁﬁcaﬁons\n\nNotifications may include alerts,\nsounds, and \\con badges. These can\nbe configured m Semngs.\n\n \n\nSanp', '2017-05-07 07:30:10', 1, '461257257', 2, '2017-05-07 14:30:10'),
(263, '461257257_590ecd070785a.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Emmy', '2017-05-07 07:30:15', 1, '461257257', 2, '2017-05-07 14:30:15'),
(264, '461257257_590ecd09189f3.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-07 07:30:17', 1, '461257257', 0, '2017-05-07 14:30:17'),
(265, '461257257_590ecd0b904a0.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '\\_4 \\/', '2017-05-07 07:30:19', 1, '461257257', 0, '2017-05-07 14:30:19'),
(266, '981072037_590ece7a947b1.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '000% AIS ’—.—‘ 2:36 PM\nEdit Connecting,“\nBroadcast Lists\nSamsung White\n\n~/./Test\n\nC’\nk 1\n5mm. Cdi»: Camera\n\nChats\n\n‘1 >3 26%D\n\nZ\n\n \n\nNew Group\n\n2:23 PM\n\nKy @ 0 @\n\nSmlmga', '2017-05-07 07:36:26', 1, '981072037', 0, '2017-05-07 14:36:26'),
(267, '981072037_590ece7d40f53.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Edit Cha‘s 3/\n\n \n\nBroadcast Lists New Group\nSamsung White 2 23 DM\nW Test\n\n@%@¢)\n\n‘ - y Chats', '2017-05-07 07:36:29', 1, '981072037', 0, '2017-05-07 14:36:29'),
(268, '981072037_590ece7fb75ee.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Edit Cha‘s 3/\n\n \n\nBroadcast Lists New Group\nSamsung White 2 23 DM\nW Test\n\n©%@D)\n\n‘ - y Chats', '2017-05-07 07:36:31', 1, '981072037', 0, '2017-05-07 14:36:31'),
(269, '981072037_590ece8208c5c.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Edit Chats :g/\n\n \n\nBroadcast Lists New Group\nSamsung White 2 23 DM\nW Test\n\n@%@¢)\n\n5, a ‘2 y Chats', '2017-05-07 07:36:34', 1, '981072037', 0, '2017-05-07 14:36:34'),
(270, '981072037_590ece8446798.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Edit Cha‘s 3/\n\n \n\nBroadcast Lists New Group\nSamsung White 2 23 DM\nW Test\n\n©%@D)\n\n‘ - y Chats', '2017-05-07 07:36:36', 1, '981072037', 0, '2017-05-07 14:36:36'),
(271, '878565167_590ecf8e4ca03.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '.3000 AIS 6‘ 2:39 PM 1 >1 26%.:\n< Samsung White On %\n\n\\a‘az scan many a: 2 25 PM\nToday\n\nA Messages you send to this chat and calls\nare now secured wim end»to»end\nencryption. Tap for more info,\n\nTest', '2017-05-07 07:41:02', 1, '878565167', 0, '2017-05-07 14:41:02'),
(272, '878565167_590ecf923628b.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS 7 39 PM 26%\nW‘Iilee\nSamsung White\n< \\as‘, awn [mm a: 2 28 PM 00 %\nToday\n3 Messages you send to ‘his chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\nTest ‘ ,‘ W', '2017-05-07 07:41:06', 1, '878565167', 0, '2017-05-07 14:41:06'),
(273, '878565167_590ecf96769a4.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS 39 PM 26%\nSamsung White\n< w. svmw today a: 2 28 pm On %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:10', 1, '878565167', 0, '2017-05-07 14:41:10'),
(274, '878565167_590ecf9a6d823.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS 39 PM 25%\nSamsung White\n< m: mu [why a: 2 28 pm On %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to»end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:14', 1, '878565167', 0, '2017-05-07 14:41:14'),
(275, '878565167_590ecf9ec07e1.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS 39 PM 25%\nSamsung White\n< w, mm [mm a: 2 28 pm On %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to»end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:18', 1, '878565167', 0, '2017-05-07 14:41:18'),
(276, '878565167_590ecfa316d6b.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS 39 PM 25%\nSamsung White\n< m. mm mm a: 2 28 pm On %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to»end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:23', 1, '878565167', 0, '2017-05-07 14:41:23'),
(277, '878565167_590ecfa5d72a7.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS 39PM 25%\nW1*lee\nSamsung White\n< N __ O“ %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:25', 1, '878565167', 0, '2017-05-07 14:41:25'),
(278, '878565167_590ecfab06586.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS 39PM 25%\nW‘Iilee\nSamsung White\n<  0° %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest\n\n4', '2017-05-07 07:41:31', 1, '878565167', 0, '2017-05-07 14:41:31'),
(279, '878565167_590ecfae47119.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS 39PM 25%\nW‘Iilee\nSamsung White\n<  0° %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest\n\n4', '2017-05-07 07:41:34', 1, '878565167', 0, '2017-05-07 14:41:34'),
(280, '878565167_590ecfb0b3ac8.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS\n\n \n\n39 PM 25%\n\nSamsung White\n<  D“ %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:36', 1, '878565167', 0, '2017-05-07 14:41:36'),
(281, '878565167_590ecfb3791ff.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite On %\n\nmvmm\n\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:39', 1, '878565167', 0, '2017-05-07 14:41:39'),
(282, '878565167_590ecfb6390c3.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS\n\n \n\n39 PM 25%\n\nSamsung White\n<  D“ %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:42', 1, '878565167', 0, '2017-05-07 14:41:42'),
(283, '878565167_590ecfb98d39c.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite On %\n\nmvmm\n\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:45', 1, '878565167', 0, '2017-05-07 14:41:45'),
(284, '878565167_590ecfbcc3025.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS\n\n \n\n39 PM 25%\n\nSamsung White\n<  D“ %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:48', 1, '878565167', 0, '2017-05-07 14:41:48'),
(285, '878565167_590ecfbfee4f0.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite On %\n\nmvmm\n\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:51', 1, '878565167', 0, '2017-05-07 14:41:51'),
(286, '878565167_590ecfc29976d.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS\n\n \n\n110 PM 25%\n\nSamsung White\n<  D“ %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest', '2017-05-07 07:41:54', 1, '878565167', 0, '2017-05-07 14:41:54'),
(287, '878565167_590ecfc59d621.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS 110 PM\nW‘IiLIve\n\n< Samsungwhite On %\n\nmva\n\n \n\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to»end\nencryption. Tap for more info.\n\nTest\n\nHello how r u today?', '2017-05-07 07:41:57', 1, '878565167', 0, '2017-05-07 14:41:57'),
(288, '878565167_590ecfc9da44b.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'o AIS 2:110 PM\n\nSamsung White\n<  Dd %\n\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to»end\nencryption. Tap for more info.\n\nTest\n\n \n\nHello how r u today?\n\nszcvbnmq}\n\n \n\n123 0 space return', '2017-05-07 07:42:01', 1, '878565167', 0, '2017-05-07 14:42:01'),
(289, '878565167_590ecfcf744dc.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '0 Al 2:110 PM 25%\n\nSamsung White\n< (:HHHE''  %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to»end\nencryption. Tap for more info.\n\nTest 34/\nHello how r u today?\n\nGood } r V\n+ Re: 9\n\nszcvbnmq}\n\n \n\n123 0 space return', '2017-05-07 07:42:07', 1, '878565167', 0, '2017-05-07 14:42:07'),
(290, '878565167_590ecfd46e31b.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite Dd %\n\nmy.va\n\nToday\n\n8 Messages you send to this chat and calls\nare now secured with end-m-end\nencryption. Tap for more info.\n\nTest z r ,y W\nHello how r u today?\nGood , W\nRelax\n¢', '2017-05-07 07:42:12', 1, '878565167', 0, '2017-05-07 14:42:12'),
(291, '878565167_590ecfdb7cda8.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '- AIS ''7‘ 2 0 PM 25m\nw\nSamsung White\n< online Dd %\nToday\n\n3 Messages you send m this cha‘ and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTat 2:23 PMJ/ 7\nHello how r u today.’ “0 pM\n\nGoad 2:40 PM W\n\nRelax\n\n2240 PM W\n\n+ And a\n-\n\nqwertyuiop\n\n \n\nasdfghjkl\n\nHHHHHHHHH\n\n.zxcvbnm.\nII@--', '2017-05-07 07:42:19', 1, '878565167', 0, '2017-05-07 14:42:19'),
(292, '878565167_590ecfe14b729.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite Dd %\n\nmmnv\n\n3 Messages you send to (his chal and calls\nare now secured with end-to-end\nencryplion. Tap for more info.\n\nTest W\nHello how r u today?\nGood W\nRelax . W\nAnd u\n¢\n+ v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 50; space return', '2017-05-07 07:42:25', 1, '878565167', 0, '2017-05-07 14:42:25'),
(293, '878565167_590ecfe8730f1.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite Dd %\n\nmmm\n\n3 Messages you send n: (his cha‘ and calls\nare now secured with end-to-end\nencrymion. Tap for more info.\n\nTest W\nHello how r u today?\nGood W\nRelax W\nAnd u .W\n+ I v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 9 0 space return', '2017-05-07 07:42:32', 1, '878565167', 0, '2017-05-07 14:42:32'),
(294, '878565167_590ecff442451.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite Dd %\n\nmy.va\n\n3 Messages you send to (his cha‘ and calls\nare now secured with end-to-end\nencrymion. Tap for more info.\n\nTest MW\nHello how r u today?\nGood W\nRelax .W\nAnd u W\n+ v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 50; space return', '2017-05-07 07:42:44', 1, '878565167', 0, '2017-05-07 14:42:44'),
(295, '878565167_590ecffb8124a.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite Dd %\n\nmmm\n\n3 Messages you send n: (his cha‘ and calls\nare now secured with end-to-end\nencrymion. Tap for more info.\n\nTest W\nHello how r u today?\n\nGood W\n\nRelax W\n\nAnd u ‘ :W\n+ I v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 9 0 space return', '2017-05-07 07:42:51', 1, '878565167', 0, '2017-05-07 14:42:51'),
(296, '878565167_590ed00317a4e.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite On %\n\nm mu\n\n3 Messages you send ‘0 this chal and calls\nare now secured with end-to-end\nencryplion. Tap for more info.\n\nTest 1W\nHello how r u today?\nGood W\nRelax .W\nAnd u ‘ ‘ W\n+ I v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 0 space return', '2017-05-07 07:42:59', 1, '878565167', 0, '2017-05-07 14:42:59'),
(297, '878565167_590ed009d30b2.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite On %\n\nm mu\n\n3 Messages you send ‘0 this chal and calls\nare now secured with end-to-end\nencryplion. Tap for more info.\n\nTest 1W\nHello how r u today?\nGood W\nRelax .W\nAnd u ‘ ‘ W\n+ v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 0 space return', '2017-05-07 07:43:05', 1, '878565167', 0, '2017-05-07 14:43:05'),
(298, '878565167_590ed011ec9e6.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite Dd %\n\nmmm\n\n3 Messages you send n: (his cha‘ and calls\nare now secured with end-to-end\nencrymion. Tap for more info.\n\nTest W\nHello how r u today?\nGood W\nRelax W\nAnd u .W\n+ I v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 9 0 space return', '2017-05-07 07:43:13', 1, '878565167', 0, '2017-05-07 14:43:13'),
(299, '878565167_590ed01789373.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite On %\n\nm mu\n\n3 Messages you send ‘0 (his cha‘ and calls\nare now secured with end-to-end\nencrymion. Tap for more info.\n\nTest 1W\nHello how r u today?\nGood W\nRelax .W\nAnd u ‘ ‘ W\n+ v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 0 space return', '2017-05-07 07:43:19', 1, '878565167', 0, '2017-05-07 14:43:19'),
(300, '878565167_590ed01d328fc.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite Dd %\n\nmmnv\n\n3 Messages you send ‘0 this cha‘ and calls\nare now secured with end-to-end\nencrymion. Tap for more info.\n\nTest W\nHello how r u today?\nGood W\nRelax . W\nAnd u W\n+ I v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 0 space return', '2017-05-07 07:43:25', 1, '878565167', 0, '2017-05-07 14:43:25'),
(301, '878565167_590ed0246533c.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite Dd %\n\nmmnv\n\n3 Messages you send u: this cha‘ and calls\nare now secured with end-to-end\nencrymion. Tap for more info.\n\nTest ,W\nHello how r u today?\nGood W\nRelax .W\nAnd u W\n+ v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 0 space return', '2017-05-07 07:43:32', 1, '878565167', 0, '2017-05-07 14:43:32'),
(302, '878565167_590ed02c6a1ca.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsungwhite Dd %\n\nmmnv\n\n3 Messages you send ‘0 this cha‘ and calls\nare now secured with end-to-end\nencrymion. Tap for more info.\n\nTest MW\nHello how r u today?\nGood .W\nRelax ‘ .W\nAnd u W\n+ I v Q»\n\nQWERTYUIOP\n\nASDFGHJKL\n\nfZXCVBNMG}\n\n \n\n123 0 space return', '2017-05-07 07:43:40', 1, '878565167', 0, '2017-05-07 14:43:40'),
(303, '838892862_590edae6b2e87.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '’0’\nll).', '2017-05-07 08:29:26', 1, '838892862', 0, '2017-05-07 15:29:26'),
(304, '838892862_590edae82177a.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Samsung White commemed on your\npost.', '2017-05-07 08:29:28', 1, '838892862', 0, '2017-05-07 15:29:28'),
(305, '838892862_590edaea185d7.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '3228 PM\nW''LLM?\n\n \n\n''. .__. Samsung While commented on your\npost.\nJﬂl .1 __ ‘', '2017-05-07 08:29:30', 1, '838892862', 0, '2017-05-07 15:29:30'),
(306, '838892862_590edaec2d19a.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '3228 PM\nW''Iere\n\n \n\nr _. Samsung While commented on your\npost.\n.‘ﬂl .1 __', '2017-05-07 08:29:32', 1, '838892862', 0, '2017-05-07 15:29:32'),
(307, '838892862_590edaed9a6b7.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-07 08:29:33', 1, '838892862', 0, '2017-05-07 15:29:33'),
(308, '838892862_590edaefe0857.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Edit Cha‘s 3/\n\n \n\nBroadcast Lists New Group\nSamsung White 2 40 PM\nW And U\n\n©%@D)\n\nn , a v y Chats', '2017-05-07 08:29:35', 1, '838892862', 0, '2017-05-07 15:29:35'),
(309, '838892862_590edaf44bb19.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS [2| 10%|\nSamsung White\n< m: mm lmmy a: z 44 PM On %\n\nToday\n\ni Messages you send to this chat and calls\nare now secured wilh end-to»end\nencryption. Tap for more info.\n\nTest V W\nHello how r u today?\nGood 7 , W\nRelax ‘ W\nAnd u ‘ W', '2017-05-07 08:29:40', 1, '838892862', 0, '2017-05-07 15:29:40'),
(310, '838892862_590edaf84e256.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS a PM III 10%:\nW‘IiLIve\nSamsung White\n< m: mm town; a: z 44 PM On %\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to»end\nencryption. Tap for more info.\n\nTest W\nHello how r u today?\nGood 7 . W\nRelax MW\nAnd u ‘ ‘ W', '2017-05-07 08:29:44', 1, '838892862', 0, '2017-05-07 15:29:44'),
(311, '838892862_590edaf9cd9c7.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', ', (9%', '2017-05-07 08:29:45', 1, '838892862', 0, '2017-05-07 15:29:45'),
(312, '838892862_590edafca12d1.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '‘11 Soard‘\n\n- Ser your profile photo\n\nSamsung White\n\nM1; M} U\n\niphone6\nh \n\na WeChatTeam\n_~ my“ :  ":5 '':''\\vv:‘\n\nInvite friends to WeChat >\n\nChats', '2017-05-07 08:29:48', 1, '838892862', 0, '2017-05-07 15:29:48'),
(313, '838892862_590edafedf686.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '3228 PM\nW17Lwe\n\n< Wechat Samsung White\n\n \n\nI''ve accepted your friend\nrequest. Now let''s chat!\n\nHi\n\nHow r u today?\n\nTap to send photo or start video\n\ncall', '2017-05-07 08:29:50', 1, '838892862', 0, '2017-05-07 15:29:50'),
(314, '838892862_590edb00e25e6.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '3228 PM\nW‘liLive\n\n< WeChat Samsung White\n\n \n\nI''ve accepted your friend\nrequest. Now let''s chat!\n\nHi\n\nHow r u today?\n\nTap to send photo or start video\n\ncall', '2017-05-07 08:29:52', 1, '838892862', 0, '2017-05-07 15:29:52'),
(315, '838892862_590edb04c964c.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '3228 PM\nW17Lwe\n\n< WeChaI Samsung White\n\n \n\nI''ve accepted your friend\nrequest. Now let''s chat!\n\nHi\n\nHow r u today?\n\nTap to send photo or start video\n\ncall', '2017-05-07 08:29:56', 1, '838892862', 0, '2017-05-07 15:29:56'),
(316, '838892862_590edb0b7d421.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Tweet\n\nSamsung White\n@SamsungWhiteG\n\ngood day\n\n5/7/2560 BE, 3:02 PM\n\n6\n\n \n\n13\n\nIphones @lphoneBw1-1s\nReplying to @SamsungWhiteS\n\nWhat you get?\n\n4s\n\n13\n\nTweet your reply\n\n0\n\nHome\n\nq\n\nEXD‘ore\n\n‘\n\nNouhcanons\n\n:4\n\nMessages\n\nMe', '2017-05-07 08:30:03', 1, '838892862', 0, '2017-05-07 15:30:03'),
(317, '838892862_590edb126aea5.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Tweet Z\n\nSamsung White v\n@Samsungwhiteﬁ\n\ngood day\n5/7/2560 BE, 3:02 PM\n\n+\\ 13 U V4\n.—‘ Iphone6 @lphone6w‘l -25m v\n\nI 5" Replying to @SamsungWhitee\n‘ What you get?\n\n4w 13 V F4\n\nTweet your reply\n\nwasp...\n\nHome EXD‘ore Notlflcauons Messages Me', '2017-05-07 08:30:10', 1, '838892862', 0, '2017-05-07 15:30:10'),
(318, '838892862_590edb1808982.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Tweet Z\n\nSamsung White v\n@Samsungwhiteﬁ\n\ngood day\n5/7/2560 BE, 3:02 PM\n\n+\\ 13 U W\n.—‘ Iphone6 @lphone6w‘l -25m v\n\nI i‘ Replying to @SamsungWhitee\n7‘ What you get?\n\n4s 13 V F4\n\nTweet your reply\n\no‘qem;\n\nHome EXD‘ore Notlflcauons Messages Me', '2017-05-07 08:30:16', 1, '838892862', 0, '2017-05-07 15:30:16'),
(319, '838892862_590edb1daaf29.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Tweet Z\n\nSamsung White v\n@Samsungwhiteﬁ\n\ngood day\n5/7/2560 BE, 3:02 PM\n\n+\\ 13 U W\n.—‘ Iphone6 @lphone6w‘l -25m v\n\nI i‘ Replying to @SamsungWhitee\n7‘ What you get?\n\n4s 13 V F4\n\nTweet your reply\n\no‘qem;\n\nHome EXD‘ore Notlflcauons Messages Me', '2017-05-07 08:30:21', 1, '838892862', 0, '2017-05-07 15:30:21'),
(320, '838892862_590edb1fc5c8b.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '._. Samsung While commented on your\n\ni614', '2017-05-07 08:30:23', 1, '838892862', 0, '2017-05-07 15:30:23'),
(321, '838892862_590edb223529f.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'A15 Q 29 PM 1 [:1', '2017-05-07 08:30:26', 1, '838892862', 0, '2017-05-07 15:30:26'),
(322, '838892862_590edb29e3270.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Mailboxes Sent Edit\n\nspri‘hunter2@gmail.com 3:23PM\nRe: Tedt\nTest 100 Sent hum my Phone\n\nspri‘hunter2@gmail.com 3:21 PM\nTedt\nTest Semi from my Phone\n\nN,\n\n@ Updated 2 minmes ago', '2017-05-07 08:30:33', 1, '838892862', 0, '2017-05-07 15:30:33'),
(323, '838892862_590edb31724f8.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Mailboxes Sent Edit\n\nspri‘hunter2@gmail.com 3:23PM\nRe: Tedt\nTest 100 Sent hum my Phone\n\nspri‘hunter2@gmail.com 3:21 PM\nTedt\nTest Semi from my Phone\n\nN,\n\n@ Updated 2 minmes ago', '2017-05-07 08:30:41', 1, '838892862', 0, '2017-05-07 15:30:41'),
(324, '838892862_590edb396e28d.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Mailboxes Sent Edit\n\nspri‘hunter2@gmail.com 3:23PM\nRe: Tedt\nTest 100 Sent hum my Phone\n\nspri‘hunter2@gmail.com 3:21 PM\nTedt\nTest Semi from my Phone\n\nN,\n\n@ Checking for Mail".', '2017-05-07 08:30:49', 1, '838892862', 0, '2017-05-07 15:30:49'),
(325, '838892862_590edb414bd6c.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Mailboxes Sent Edit\n\nspri‘hunter2@gmail.com 3:23PM\nRe: Tedt\nTest 100 Sent hum my Phone\n\nspri‘hunter2@gmail.com 3:21 PM\nTedt\nTest Semi from my Phone\n\nN,\n\n@ Updated Just Now', '2017-05-07 08:30:57', 1, '838892862', 0, '2017-05-07 15:30:57'),
(326, '609167964_590edbb697b2d.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-07 08:32:54', 1, '609167964', 0, '2017-05-07 15:32:54'),
(327, '609167964_590edbba97e82.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Mailboxes Sent Edit\n\n \n\nsprithunter2@gmail.com 3.23 PM\nRe: Tedt\nTest 100 Sent from my Phone\n\nsprithunter2©gmaiLcom 3:21 PM\nTedt\nTest Sem from my \\Phone\n\nN,\n\n@ Updated 2 minu‘es ago', '2017-05-07 08:32:58', 1, '609167964', 0, '2017-05-07 15:32:58'),
(328, '609167964_590edbbc3d6a8.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-07 08:33:00', 1, '609167964', 0, '2017-05-07 15:33:00'),
(329, '609167964_590edbbf652eb.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '6%I\n\n     \n\nAIS\n\n< Samsungwhite Dd %\n\nToday\n\ni Messages you send to this chat and calls\nare now secured with end-to-end\nencryption. Tap for more info.\n\nTest ‘ W\nHello how r u today?\nGood W\nRelax ‘ ‘ W\nAnd u l. W', '2017-05-07 08:33:03', 1, '609167964', 0, '2017-05-07 15:33:03'),
(330, '609167964_590edbc145523.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS ’6‘ 3:32 PM 6%\n\na; Q 03,', '2017-05-07 08:33:05', 1, '609167964', 0, '2017-05-07 15:33:05'),
(331, '609167964_590edbc465bc7.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '3232 PM\nW‘IiLive\n\n< WeChat Samsung White\n\n \n\nI''ve accepted your friend\nrequest Now let‘s chat!\n\nHi\n\nHow r u today?', '2017-05-07 08:33:08', 1, '609167964', 0, '2017-05-07 15:33:08'),
(332, '609167964_590edbc8ae87b.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '3232 PM\nW‘IiLive\n\n< WeChat Samsung White\n\n \n\nI''ve accepted your friend\nrequest Now let‘s chat!\n\nHi\n\nHow r u today?', '2017-05-07 08:33:12', 1, '609167964', 0, '2017-05-07 15:33:12'),
(333, '609167964_590edbd19ad52.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '3232 PM\nW‘IiLive\n\n< WeChat Samsung White\n\n \n\nI''ve accepted your friend\nrequest Now let‘s chat!\n\nHi\n\nHow r u today?', '2017-05-07 08:33:21', 1, '609167964', 0, '2017-05-07 15:33:21'),
(334, '609167964_590edbd8f1864.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '3232 PM\nW‘IiLive\n\n< WeChat Samsung White\n\n \n\nI''ve accepted your friend\nrequest Now let‘s chat!\n\nHi\n\nHow r u today?', '2017-05-07 08:33:28', 1, '609167964', 0, '2017-05-07 15:33:28'),
(335, '609167964_590edbdeaf0f0.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'u AIS ‘7‘ 3132 FM ‘1 [2| 6%I\n\n18a', '2017-05-07 08:33:34', 1, '609167964', 0, '2017-05-07 15:33:34'),
(336, '609167964_590edbe1e2de6.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '._. Samsung While commented on your\n\ni1 ".“T‘ __', '2017-05-07 08:33:37', 1, '609167964', 0, '2017-05-07 15:33:37'),
(337, '609167964_590edbe58d739.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '._. Samsung While commented on your\n\nii ".“I'' _\n\n‘——s\nW', '2017-05-07 08:33:41', 1, '609167964', 0, '2017-05-07 15:33:41'),
(338, '609167964_590edbec4eaa5.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Tweet ''Z\n\nSamsung White v\n@Samsungwhiteﬁ\n\n   \n\ngood day\n5/7/2560 BE, 3:02 PM\n\n+\\ 93 U W\nr—‘ Iphone6 @Iphone6w1 -25m v\n\nReplying to @SamsungWhiteS\nWhat you get?\n\n4s 13 V F4\n\nTweet your reply\n\no‘qaw;\n\nHome EXD‘ore Notmcauons Messages Me', '2017-05-07 08:33:48', 1, '609167964', 0, '2017-05-07 15:33:48'),
(339, '609167964_590edbf578d30.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Tweet ''Z\n\nSamsung White v\n@Samsungwhiteﬁ\n\ngood day\n5/7/2560 BE, 3:02 PM\n\n+\\ 13 U W\nr—~ Iphone6 @lphone6w‘l -25m v\n\nI i‘ Replying to @SamsungWhiteS\n‘ What you get?\n\n4s 13 V F4\n\nTweet your reply\n\no‘qem;\n\nHome EXD‘ore Notlflcauons Messages Me', '2017-05-07 08:33:57', 1, '609167964', 0, '2017-05-07 15:33:57'),
(340, '609167964_590edbf98b12e.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'so A15 Q 32 PM', '2017-05-07 08:34:01', 1, '609167964', 0, '2017-05-07 15:34:01'),
(341, '609167964_590edc00d7f25.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '7-8; :9 «a.', '2017-05-07 08:34:08', 1, '609167964', 0, '2017-05-07 15:34:08'),
(342, '609167964_590edc074d722.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '1''3; {9 «a.', '2017-05-07 08:34:15', 1, '609167964', 0, '2017-05-07 15:34:15'),
(343, '75777546_590fc69353829.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-08 01:14:59', 2, '75777546', 1, '2017-05-08 08:14:59'),
(344, '75777546_590fc6966ed61.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'X Set your profile phom\n\n \n\nSamsung White\n\niphoneG\n\na WeChatTeam\n J  r» m\n\nInvite friends to WeChat >\n\nU\nI?\nQ\np\n\nChats', '2017-05-08 01:15:02', 2, '75777546', 1, '2017-05-08 08:15:02'),
(345, '75777546_590fc69839864.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '''0 AIS ‘3 8:13 AM\nW‘IiLive\n\n< WeChat iphone6\n\n \n\nQWERTYUIOP\n\nASDFGHJKL', '2017-05-08 01:15:04', 2, '75777546', 1, '2017-05-08 08:15:04'),
(346, '75777546_590fc69a867b0.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '8:13 AM\nW‘IiLive\n\n< WeChat iphone6\n\n \n\nszcvbnmq}', '2017-05-08 01:15:06', 2, '75777546', 1, '2017-05-08 08:15:06'),
(347, '75777546_590fc69d0b39a.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'X Sex your proﬁle phom\n\n \n\niphonee\n\\f-d\n\nSamsung White\n\nM nzxuz‘H\n\na WeChat Team\nV’ H“! L‘  n.7,)“  " h! ,A t‘ ‘\n\nInvite friends to WeChat >\n\nChats', '2017-05-08 01:15:09', 2, '75777546', 1, '2017-05-08 08:15:09'),
(348, '75777546_590fc69fa01b5.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '''- AIS 3‘ 8:13 AM 1 l2} —''', '2017-05-08 01:15:11', 2, '75777546', 1, '2017-05-08 08:15:11'),
(349, '75777546_590fc6ab00ec6.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '8:13 AM\nW‘IiLive\n\n< WeChat Samsung White\n\n \n\nI''ve accepted your friend\nrequest. Now let''s chat!\n\nHi\n\nHow r u today?', '2017-05-08 01:15:23', 2, '75777546', 1, '2017-05-08 08:15:23'),
(350, '75777546_590fc6ae19349.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'I0*\n:0.', '2017-05-08 01:15:26', 2, '75777546', 1, '2017-05-08 08:15:26'),
(351, '75777546_590fc6b0e2b02.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Allow "Twitter" to access\nyour location while you use\nthe app?\n\nEnjoy me Twitter experience tai‘ored to\nyour locaﬁon.', '2017-05-08 01:15:28', 2, '75777546', 1, '2017-05-08 08:15:28'),
(352, '75777546_590fc6b3547b3.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS\n\n \n\n13AM 1''21\n\n \n\nO Q Q\n\nHome Expmm Notmcanons Meesaqes Me', '2017-05-08 01:15:31', 2, '75777546', 1, '2017-05-08 08:15:31'),
(353, '75777546_590fc6b58bfd6.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '"Twitter" Would L e to Send\nYou Notifications\n\nNmifications may include alerls,\nsounds, and icon badges. These can\nbe configured in Senings.\n\nDon''t Allow', '2017-05-08 01:15:33', 2, '75777546', 1, '2017-05-08 08:15:33'),
(354, '75777546_590fc6bb52a0f.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'hwte6~17h v\n\n \n\n{x 1 t1 V >74\nlphone6 @lphoneew1 -17h v\nI IL What you get?\n'' 1 J\nL'' ’ « f} v >2\n\nWongna: Retweeted\n\nWongnai @wongnai - 1d v\nmas’mas’mumuaxofqudu .J amnuziu!\n67mwawaﬂnaﬂfuiﬁmuvhd‘m''lu 3 mad! I\nQmi''mmm''luumgﬁmault bufny/\nZpRCKLW [Ad]\n\n \n\n \n\n«afm;\n\nHome Exp‘ore Notmcauons Messages Me', '2017-05-08 01:15:39', 2, '75777546', 1, '2017-05-08 08:15:39'),
(355, '75777546_590fc6c3bbab9.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '0.\n\nHome\n\n \n\nKitti Singhapat @Knn3Mm 16h\nRT @Nifswm_: 7j113ﬁﬁ mmws’au\nstwwﬂvm LﬁaamqquﬁTﬂn\n(6wqumnu2560)\nyoutu.be/iJcRxwytvq4\n\nvocabaday Retweeted\n\n1 vocabdujour @vocabdujour 3d\n\nI Inm’aBasic French inn 2 ﬁlm''hhm\n\nlehl I\n\naﬁns’?‘ vocabdujour.com\nL‘i''uunn''i''uq’nﬁmﬂ 09.30-12.30 u, (GIN 28\nwqwmnuﬁnﬁl)\n\nFnench 7\n\nBy P''Goo Weer\n\n \n\nnu\n\nQ4“\n\nExmmp Nmmoanons\n\n:4 .0.\n\nMPSsaqes Me', '2017-05-08 01:15:47', 2, '75777546', 1, '2017-05-08 08:15:47'),
(356, '75777546_590fc6c88559c.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'a Wowgnaw Relweeled\n\nPaliL..Love @paht‘oveA 17h\nRep‘ymg to {m uumu\n\nB Womgnax Retweeted\n\nMeow MEOW @MEOWMEOMBSSZWQ “17h\nRemvum to\n\nq\n\nkxmoo Nozmmmm MMqu w', '2017-05-08 01:15:52', 2, '75777546', 1, '2017-05-08 08:15:52'),
(357, '75777546_590fc6ca07ab7.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'AIS ‘7‘ 8:13 AM ‘V ''21 -.', '2017-05-08 01:15:54', 2, '75777546', 1, '2017-05-08 08:15:54');
INSERT INTO `ocr_media` (`id`, `file_name`, `device_id`, `ocr_text`, `createdon`, `video_made`, `ocr_code`, `ocr_type`, `updatedon`) VALUES
(358, '75777546_590fc6ccaf6b9.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'ﬂ\n\nDirect Your Smry\n\nM‘s on mom mmu?\n\n \n\nZ S\\ams h Phom\n\n~ Samsung White\n\n151»! ‘\n\n-w d\n\n \n\n.N,‘\n\nCheck In', '2017-05-08 01:15:56', 2, '75777546', 1, '2017-05-08 08:15:56'),
(359, '75777546_590fc6cfac75d.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Dvrec‘ Your Slory Faceboak\n\n \n\nat“; on your mud?\nC’J Smms B Phom\n\n~ Samsung White\n\n1''2»! «\n\nv x d\n\nNo >n~rl\n\n \n\nCheck In', '2017-05-08 01:15:59', 2, '75777546', 0, '2017-05-08 08:15:59'),
(360, '75777546_590fc6d419d6c.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '0\nﬂ\n\nDirec‘ YourSlory Faceboak\nWual‘s UH your rmmi?\nC’] Saws E Phom Check In\n\nB Good morning, Pa‘rick!\n\nStay dry mday in Bangkok. Rain ‘5 in the\nforecast\n\n29°C See More\n\n—~ Samsung White\n\n5:41 \n\nm‘w a\n\nNo >0le', '2017-05-08 01:16:04', 2, '75777546', 0, '2017-05-08 08:16:04'),
(361, '75777546_590fc6d78add8.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '111/ Status E2 Photo Check In\n\nIi Good morning, Patrick! V\nStay dry today in Bangkok. Rain is in the (\nforecast.\n\n \n\n29°C See More\n\nSamsung White v\n16 wins ~ .3\n\nIt Like I Comment A Share\n\n- Samsung White\n\nB 31.2 0 Q\n\nNews Feed Remeﬂs NmiiiCaTiOWs\n\ng', '2017-05-08 01:16:07', 2, '75777546', 0, '2017-05-08 08:16:07'),
(362, '75777546_590fc6daa0e69.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '. Like I Comment A share\n\n \n\n \n\nSamsung White v\nYesterday a 5:49 PM - a\nIt Like I Comment A Share\n\n \n\nNews Feud RequesKs VldED Notiﬁcations More', '2017-05-08 01:16:10', 2, '75777546', 0, '2017-05-08 08:16:10'),
(363, '75777546_590fc6dee0816.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '9\nﬂ\n\nD‘rec‘ YourSlory Faceboak\n‘f/wal‘s an your mmd?\nC’] Smms in Phom Check In\n\nB Good morning, Pa‘rick!\n\nStay dry today in Bangkok. Rain ‘5 in the \nforecast\n\n29°C See More\n\n—~ Samsung White\n\n1141 ‘-\n\n‘Mu a\n\nNo mrd', '2017-05-08 01:16:14', 2, '75777546', 0, '2017-05-08 08:16:14'),
(364, '75777546_590fc6e0ada99.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-08 01:16:16', 2, '75777546', 0, '2017-05-08 08:16:16'),
(365, '75777546_590fc6e24b676.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-08 01:16:18', 2, '75777546', 0, '2017-05-08 08:16:18'),
(366, '75777546_590fc6e386d71.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-08 01:16:19', 2, '75777546', 0, '2017-05-08 08:16:19'),
(367, '75777546_590fc6e82d880.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Mailboxes Sent Edit\n\nspri‘hunter2@gmail.com Yes‘erday\nRe: Tedt\nTest 100 Sent from my Phone\n\nspri‘hunter2@gmail.com Yes‘erdav\nTedt\nTest Semi from my Phone\n\nN,\n\n@ Updated Yesterday', '2017-05-08 01:16:24', 2, '75777546', 0, '2017-05-08 08:16:24'),
(368, '75777546_590fc6ea94ab1.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Back\n\nMichael Frew\nTo: sprithumer2@gmaﬂcom\n\nRe: Tedt\nYesterday at 3 23 PM\n\nLOAD‘NG\n\n \n\nV\n\nDetails @', '2017-05-08 01:16:26', 2, '75777546', 0, '2017-05-08 08:16:26'),
(369, '75777546_590fc6ee15209.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Back V\n\nMichael Frew @\nTo: sprithunler2@gmaﬂcom Details\n\nRe: Tedt\nYesterday at 3 23 PM\n\nTest too\nSent from my iPhone\n\nOn May 7, 2560 BE, at 3:21 PM, Michael\nFrew  wrote:\n\nTest\n\nSent from my iPhone', '2017-05-08 01:16:30', 2, '75777546', 0, '2017-05-08 08:16:30'),
(370, '75777546_590fc6f1af749.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Back V\n\nMichael Frew @\nTo: sprithumer2@gma\\\\.com Details\n\nRe: Tedt\nYesterday at 3 23 PM\n\nTest too\nSent from my iPhone\n\nOn May 7, 2560 BE, at 3:21 PM, Michael\nFrew  wrote:\n\nTest\n\nSent from my iPhone', '2017-05-08 01:16:33', 2, '75777546', 0, '2017-05-08 08:16:33'),
(371, '75777546_590fc6f576277.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Back V\n\nMichael Frew @\nTo: sprithumer2@gma\\\\.com Details\n\nRe: Tedt\nYesterday at 3 23 PM\n\nTest too\nSent from my iPhone\n\nOn May 7, 2560 BE, at 3:21 PM, Michael\nFrew  wrote:\n\nTest\n\nSent from my iPhone', '2017-05-08 01:16:37', 2, '75777546', 0, '2017-05-08 08:16:37'),
(372, '75777546_590fc6f94dcf1.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Back V\n\nMichael Frew @\nTo: sprithumer2@gma\\\\.com Details\n\nRe: Tedt\nYesterday at 3 23 PM\n\nTest too\nSent from my iPhone\n\nOn May 7, 2560 BE, at 3:21 PM, Michael\nFrew  wrote:\n\nTest\n\nSent from my iPhone', '2017-05-08 01:16:41', 2, '75777546', 0, '2017-05-08 08:16:41'),
(373, '75777546_590fc6fd0c9ac.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Back V\n\nMichael Frew @\nTo: sprithumer2@gma\\\\.com Details\n\nRe: Tedt\nYesterday at 3 23 PM\n\nTest too\nSent from my iPhone\n\nOn May 7, 2560 BE, at 3:21 PM, Michael\nFrew  wrote:\n\nTest\n\nSent from my iPhone', '2017-05-08 01:16:45', 2, '75777546', 0, '2017-05-08 08:16:45'),
(374, '75777546_590fc6fe05d70.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-08 01:16:46', 2, '75777546', 0, '2017-05-08 08:16:46'),
(375, '75777546_590fc6ff7ba83.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Q Search Skype\n\nRecent conversations will appear here.\n\n0 I! ‘2\n\nRecent Contacts Calls My info', '2017-05-08 01:16:47', 2, '75777546', 0, '2017-05-08 08:16:47'),
(376, '75777546_590fc704dc369.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '12AM\n\nEdit my 4-\n\nHum:\n\n \n\nSamsung White Sun\n0 H i i\n\nSkype Sun\n. 3736'' 67656 Skype Lmﬁmmwam... 0\n\n0° IE K2 4.\n\nRem: (mum ms My mm', '2017-05-08 01:16:52', 2, '75777546', 0, '2017-05-08 08:16:52'),
(377, '75777546_590fc70b73198.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Edit 6333 +\n\nQ Search Skype\n\na Samsung White Sun\n. \\“ i i\n\nskype a Sun\n. aﬁﬁl ﬁ’Vﬁﬂ Skype lswﬁmmsuam... 0\n\n0° IE\n\nRecent Comaus CaHs My mlo', '2017-05-08 01:16:59', 2, '75777546', 0, '2017-05-08 08:16:59'),
(378, '75777546_590fc70f1536f.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'NS 2 AM 1 r2]\n0 Samsung Whiie\n<   -- L\n\nSunday 4:29 PM\n\n9 Hi pat\n\nHi Sam\n\nHow are u?\n\nType a message here \n\nSnooze', '2017-05-08 01:17:03', 2, '75777546', 0, '2017-05-08 08:17:03'),
(379, '75777546_590fc712b5a91.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '0 Samsung White\n\n36\n\nA: av\n\n“3i\n\nwva\n\nType a message here\n\nQWERTYUIOP\n\n \n\nASDFGHJKL\n\niZXCVBNMG)\n\n \n\n123 Q; space return', '2017-05-08 01:17:06', 2, '75777546', 0, '2017-05-08 08:17:06'),
(380, '75777546_590fc715ac7b6.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '0'' AIS ’5“ 8:12 AM 1\nW17Lwe\n\na\n!\n\n0 Samsung thte\nm Asav\n\nSW! C)\n\nGreatl . a\n\n \n\nszcvbnmq}\n\n \n\n123 Q; space return', '2017-05-08 01:17:09', 2, '75777546', 0, '2017-05-08 08:17:09'),
(381, '75777546_590fc71801a99.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '', '2017-05-08 01:17:12', 2, '75777546', 0, '2017-05-08 08:17:12'),
(382, '75777546_590fc71a6f765.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '<\n\nSamsung white\n\n00', '2017-05-08 01:17:14', 2, '75777546', 0, '2017-05-08 08:17:14'),
(383, '75777546_590fc71e202bf.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', '< Samsung White [30\nlast seen today at 7:54 AM\n\n \n\n"WhatsApp" Would Like to\n\nAccess Your Photos\n\n} Thxs \\ets you send photos and \\IldEOS\nfrom your library and save the ones\n\nyou capture,\n\n   \n\n \n \n   \n\nDon''t AlIow', '2017-05-08 01:17:18', 2, '75777546', 0, '2017-05-08 08:17:18'),
(384, '75777546_590fc721a985a.jpg', '74C3B6F4-2984-4703-A8A2-1E7EA33EB845', 'Samsung White\n< L‘s: svmw [mm a: / :74 AV! DO %\n\nare now SE Yesterday \\d—‘o—end\nencryption. lap tor more info.\n\nTest a W\nHello how r u today?\nGood ‘ , W\nRelax . W\nAnd u . W', '2017-05-08 01:17:21', 2, '75777546', 0, '2017-05-08 08:17:21'),
(537, '475167940_59760c1588ef4.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '«000 Sunrise 4G 16:57 1 I2! :8 81%i}\n\n ‘5‘ ‘\n\nOSurveilIance OatWork‘ OTWINT .PhotoWiFi\n\nNikon\nL ool I’IX\n\nOiP-PJTr.“ OSyonE .NikonApp OBi‘rix24\n\nw; @-\n\n.PostFlnaﬂ; OBmtal Age OTKSTARW OTrials Fr,“\n\n IO\n\nsléiics.... W‘l-Dev iPhonevSuche\n\n \n\n \n\n \n\n     \n    \n\n\\ '' gll\n\nTelefon Mail 7 7 Safari\n\n \n\nMusik', '2017-07-24 15:02:45', 0, '475167940', 1, '0000-00-00 00:00:00'),
(538, '475167940_59760c2002078.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'u Sunrlse 46 16:57 1 [:1 81%->\n\n V 9\n\nOSurveilIance Oa‘Work ITWINT IPhotoWiFi\n\n\nWe \n\n.iP.PJTr... OSyncME ONikonApp .Bitrix24\n\n \n\nO‘PostFinam .Brutal Age OTKSTARW OTrials Fr...\n\n.0\n\n.F refet''lc‘siu W1-Dev iPhohe-Suche\n\n''cooooo.\n\nxilﬂ\n\nTelefon Mail Safari Musik', '2017-07-24 15:02:56', 0, '475167940', 1, '0000-00-00 00:00:00'),
(539, '475167940_59760c2caef8d.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'u Sunrlse 46 16:57 1 [:1 81%->\nW1 Dev\n\nl I ''\nA\\\nr )\n(IL ’ a E\nNETGEAR l\n\n.Surveillance OaxWork ITWINT IthoWiFi\n\n\n\n.iPAPJTr" OSyncME ONikonApp .Bitrix24\n\n_, a,\n\nO‘PostFinam OBrutal Age OTKSTAR.” OTrials Fr...\n\n_IO\n\n.Fréslzek''lc‘s.“ W1-Dev iPhohe-Suche\n\n\\\\\n\n \n\n \n\n   \n \n\n.\n’oooooo.\n\nkiln\n\nTelefon Mail Safari Musik', '2017-07-24 15:03:08', 0, '475167940', 1, '0000-00-00 00:00:00'),
(540, '475167940_59760c3937a21.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '0- Sunrise AG 16:57 1 III 81%->\n\nl I ''\nA\\\nr )\n(IL ’ 9 E\nNETGEAR I\n\n.Surveillance Oa‘Work ITWINT IPhomWiFi\n\nWe I \n\n.iPAPJTr. OSyncME ONikonApp OBitrix24\n\n'' I?!\n3%!\n\nO‘PostFinam .Brutal Age OTKSTARW OTrials Fr...\n\n.0\n\n,.F “sfeélc‘s.” W1-Dev iPhohe-Suche\n\n\\\\\n\n \n\n \n\n \n\n \n\n \n\ns\n''coooo-o\n\nkiln\n\nTelefon Mail Safari Musik', '2017-07-24 15:03:21', 0, '475167940', 1, '0000-00-00 00:00:00'),
(541, '475167940_59760c4871520.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '0- Sunrise AG 16:57 1 (I! 81%->\nWW-Dev\n\nl I ''\nAN\nr )\n(IL ’ a E\nNETGEAR I\n\n.Surveillance OaxWork ITWINT IPhotoWiFi\n\nf\nW\n\n.iP.PJTr. OSyncME ONikonApp .Bitrix24\n\n., I?\n-?%''\n\nO‘PostFinam .Erutal Age OTKSTARW OTrials Fr...\n\n.0\n\n,.F “sfeélc‘s.” W1-Dev iPhohe-Suche\n\n \n\n \n\n \n\n \n\n''coooo''.\n\nkiln\n\nTelefon Mail Safari Musik', '2017-07-24 15:03:36', 0, '475167940', 1, '0000-00-00 00:00:00'),
(542, '475167940_59760c53d4489.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '0- Sunrise AG 16:57 1 III 81%->\n\nl I ''\nAN\nr )\n(J ) 9 E\nNETGEAR I\n\n.Surveillance OaxWork ITWINT IPhotoWiFi\n\nWe I \n\n.iP.PJTr. OSyncME ONikonApp .Bitrix24\n\n., D I?\n-?%''\n\nO‘PostFinam .Srutal Age OTKSTARW OTrials Fr...\n\n_IO\n\n,.F _''9l:et''lc‘s.u W1-Dev iPhohe-Suche\n\n\\\\\n\n \n\n \n\n \n\n \n\n»\nroute...\n\nkiln\n\nTelefon Mail Safari Musik', '2017-07-24 15:03:47', 0, '475167940', 1, '0000-00-00 00:00:00'),
(543, '363020566_597610b66cfdd.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'u ~~Sunrlse AG 17:20 4 1:1 78%->\nWW-Dev\n\nOBBM OFake Tel... lSpoof Mail OHungry...\n\n  \n \n\nMobwie\n\n. Disk\n\n \n\nMorocco\n\n \n\n.Sygic\n\nw:-\n\n"OGaranbo OWDPhotos .My Cloud\n\n. . A\n1  l’ux''x''nl g\n\\ /\n\n.i’uble .Parro‘ Zik ONapsker SysSeclnfo\n'' a o o I o o o\n\nx i9\n\nTelefon Mail Safari Musik', '2017-07-24 15:22:30', 0, '363020566', 0, '0000-00-00 00:00:00'),
(544, '363020566_597610c1cb38f.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'u- -- SUnI’ISe AG 17:20 4 1:1 78%->\n\nOBBM OFake Tel... lSpoof Mail OHungry...\n\n  \n \n\n   \n\nMaple\n. Disk\nOSwissJass Ii-USBis... OHaiIo\n'' . . M°r°°°°\n’Trailers 0 ''roviummo OAOL .Sygic\n\nw:-\n\n"OGaranbo OWDPhotos OMy Cloud\n\n. . A\n''.  l’ux''x''nl g\n\\ /\n\n.Tuble .Parro‘ Zik ONapsker SysSeclnfo\n, a o o I o o a\n\nx i9\n\nTelefon Mail Safari Musik', '2017-07-24 15:22:41', 0, '363020566', 0, '0000-00-00 00:00:00'),
(545, '363020566_597610cba0aba.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'u- - u Sunrise AG 17:20 4 1:1 78%-|‘\nWWDOV\n\nOBBM OFake Tel... lSpoof Mail OHungry...\n\n  \n \n\n   \n\nMaple\n. Disk\nOSwissJass Ii—USBis... OHaiIo\n'' . . M°r°°°°\npTrailers o ''roviummo OAOL .Sygic\n\nw:-\n\n"OGaranbo OWDPhotos .My Cloud\n\n. A\nmm" .\n\n.Tuble OParro‘ Zik ONapsker SysSeclnfo\n'' a o o o o o o\n\nn I’D\n\nTelefon Mail Safari Musik', '2017-07-24 15:22:51', 0, '363020566', 0, '0000-00-00 00:00:00'),
(546, '363020566_597610dcf3532.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '00 ~ r Sunrise 46 17:21 4 1:1 78%->\nWW DOV\n\n(«3 Flu\n\nISpeedKest MoneyPark Telegram Oanibis.ch\n\nQ B 4;\nWIN * 4\nCar-Ne! ''\n\nOCar-Net .Meeting. MobilePrimOPaperles...\n\nO '' owﬁ oyﬁ m\n»- . ‘ a:\n\nOProtonMaill .Quiuung... .Quitlung.,, .WeChal\n\nQ E  4;\n\n  \n\nRiga-XL Swiss Pla‘es OBe‘st Co.“ lFIash SMS\n\nmlm\nk\n\nFIipDiving OYapp OPhomln... .Metadata\nI o o o o o o o\n\nxiii\n\nTelefon Mail Safari Musik', '2017-07-24 15:23:08', 0, '363020566', 0, '0000-00-00 00:00:00'),
(547, '363020566_597610e431727.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'u Sum HI -1 17:21 ‘V (:1 i8‘7,-‘\n\n,,WeChat” m6chte dir\n\nMitteilungen senden\n\nMitteilungen kiﬁnnen Hinweise, Tijne\nund Symbolkennzeichen sein. Sie\nkb‘nnen in den Einstellungen\n\nKonfiguriert werden.\n\n \n\nRegiSUieren', '2017-07-24 15:23:16', 0, '363020566', 0, '0000-00-00 00:00:00'),
(548, '363020566_597610efbaf38.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'cu Sum :u 17:21 4 if!\n\n,,WeChat” m6chte dir\n\nMitteilungen senden\n\nMitteilungen kiﬁnnen Hinweise, Tijne\nund Symbolkennzeichen sein. Sie\nkb‘nnen in den Einstellungen\n\nKonfiguriert werden.\n\n \n\nRegisnieren', '2017-07-24 15:23:27', 0, '363020566', 0, '0000-00-00 00:00:00'),
(549, '363020566_597610f358e12.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '"000 Sunrise AG 17:21 1 El >3 78%\nW1-Dev\n\n\\tmhdw\n\n \n\nRegistrieren', '2017-07-24 15:23:31', 0, '363020566', 0, '0000-00-00 00:00:00'),
(550, '363020566_59761102ec671.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '"in, i Sunrise 46 17:21 4 12! 77%-r\nWWng\n\n \n\nlBahnhof... .Instagram CNHL .556 3\n\nQ in M\n\nIHORZU IAirLST .Mobi)e s... .Lep''s w.“\n\n(n '' :1 [ 3''! ''>\n*M 4” i\n{i ‘ '' W ‘ it.\n\nIMARIO... Weddy Free OCIash R... .Game of...\n\n A  7’1?\n\n 2 O St rava .SNiSS Snow 0 Paris\n\n’3\n\nJWarFI-iends\n\nTelefon Mall ‘ Safari Musik\n\n \n\n \n\n  \n\n.VueZone\n\nr', '2017-07-24 15:23:46', 0, '363020566', 0, '0000-00-00 00:00:00'),
(551, '363020566_5976110dc1486.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '0- rSuanse AG 17:21 112! 77°u-p\n\nl I ''\nAN\nr )\n(J , \nNETGEAR J\n\nOSurveilIance OatWork ITWINT IPhomWiFi\n\n/\n\n\n.iPAPJTr... .SyncME ONikonApp .Bitrix24\n\n;3%“\n\nFostFinanCIeOBrutal Age OTKSTAR.” OTrials Fr,"\n\n3.0\n\nF. _''sl:et‘lcs.''.‘ W1-Dev iPhohe-Suche\n\n \n\n \n\n \n\n \n\n. . .\n\n*vooooo.\n\nxilﬁ\n\nTelefon Mail Safari Musik', '2017-07-24 15:23:57', 0, '363020566', 0, '0000-00-00 00:00:00'),
(552, '363020566_5976111363412.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrise AG 17:21\n\n \n\nTWInT\n\neglstrieren', '2017-07-24 15:24:03', 0, '363020566', 0, '0000-00-00 00:00:00'),
(553, '363020566_59761118db99a.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'SUN’ISG AG 17:21\n\n \n\nTWInT\n\neglstrieren', '2017-07-24 15:24:08', 0, '363020566', 0, '0000-00-00 00:00:00'),
(554, '363020566_5976111e8e261.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrise 40\n\n \n\nTWInT\n\neglstrieren', '2017-07-24 15:24:14', 0, '363020566', 0, '0000-00-00 00:00:00'),
(555, '363020566_597611241fe71.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrise 40\n\n \n\nTWInT\n\neglstrieren', '2017-07-24 15:24:20', 0, '363020566', 0, '0000-00-00 00:00:00'),
(556, '363020566_5976112e57603.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrise 40\n\n \n\nTWInT\n\neglstrieren', '2017-07-24 15:24:30', 0, '363020566', 0, '0000-00-00 00:00:00'),
(557, '363020566_59761134645d2.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrise 40\n\n \n\nTWInT\n\neglstrieren', '2017-07-24 15:24:36', 0, '363020566', 0, '0000-00-00 00:00:00'),
(558, '363020566_59761143331c6.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'u - rSuanse AG 17:21 1 1:1 77%->\n\nl ''\n\nA\\\n\nr )\n\n(,1, 9 E\nNETGEAR l\n\n \n\n \n\nOSurveilIance Oa‘Work TWINT .PhomWiFi\nw %\ni  0\n. . 1,,-\nV - u\n.iPAPJ Tr.. OSyncME ONikon App .Bitrix24\nI w\nA» « V\n\n   \n\n—; ''2 a v!\nPostFinanceOBrutal Age OTKSTARW OTrials Fr,"\n\n IO\n\n''sl''etlcs.“ W1-Dev iPhone-Suche\n\n \n\n.\n’ooooooo\n\nkiln\n\nTelefon Mail Safari Musik', '2017-07-24 15:24:51', 0, '363020566', 0, '0000-00-00 00:00:00'),
(559, '363020566_59761145c1522.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'qwertzuiopﬂ\nasdfghjkléé\nG yxcvbnm', '2017-07-24 15:24:53', 0, '363020566', 0, '0000-00-00 00:00:00'),
(560, '363020566_5976114c5cfb4.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '-- Swwse 46* 17:21 1 ''0 7“SUanSe\n\nQwh 0\n\n. WhatsApp\n\n+41798071642 M\n\n‘ wry/mp Dr ‘7\nm Mum J\n\n1 +41772062958\n\nA M! tho aw“\nmeledgmem u“ p\n\n \n\nRosahe Preisig\n\nm Private Themen in Ergénz\nBme aHe Mam: ver lvauhch\nbehandem. Gruss Mama', '2017-07-24 15:25:00', 0, '363020566', 0, '0000-00-00 00:00:00'),
(561, '363020566_59761158068a2.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrlse AG\n\n \n\nW\nBearbeiten Chats Cj/\nBillent Yﬁzﬂlmﬂs 10.00\n\nWWaH heutc?\n\nJaunin Freitag\n/ WMerci Monsieur Jaunin\nNous exanmerons ce paxeme,..\n\n+41 78 708 90 00 Dienstag\n\nHabs auch gesehen dass es\n\\eidm mcht am 27.06 bezahlt ..\n\nJoao Paulo Corre... Dlenstag\n\n3 Foto\n\nMiriam Lopez An... Dienslag\nWGuten Tag, Frau Lopez\nBetreffend dem VW Passat vo..\n\n \n\nAna Catarina Ferr... 14.0717\n~/ Chére Madame Ferreira\n\n’©’%@9)@\n\nChats LH mum-M\n\n \n\nmum', '2017-07-24 15:25:12', 0, '363020566', 0, '0000-00-00 00:00:00'),
(562, '363020566_597611642bc8a.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrlse AG\n\n \n\nW\nBearbeiten Chats Cj/\nBillent Yﬁzﬂlmﬂs 10.00\n\nWWan heutc?\n\nJaunin Freitag\n/ WMerci Monsieur Jaunin\nNous exammerons ce panama”\n\n+41 78 708 90 00 Dienstag\n\nHabs auch gesehen dass es\n\\eider mcht am 27.06 bezahlt ..\n\nJoao Paulo Corre... Dlenstag\n\n(a Foto\n\nMiriam Lopez An... Dienslag\nWGUten Tag, Frau Lopez\nBetreﬂend dem VW Passat vo..\n\n \n\nAna Catarina Ferr... 14.0717\n~/ Chére Madame Ferreira\n\n’©’%@Q@\n\nChats L0 MAme\n\n \n\nmum', '2017-07-24 15:25:24', 0, '363020566', 0, '0000-00-00 00:00:00'),
(563, '363020566_59761175b6f2d.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrlse AG 1 121 77%->\nWW-Dev\nBearbeiten Chats Cj/\nBillent Yﬁzﬂlmﬂs 1000\n\n67 %\n\n \n\nWWan hcutc?\n\nJaunin Freitag\nWMerci Monsieur Jaunin\nNous exammerons ce y)a\\eme,..\n\n+41 78 708 90 00 Dienstag\n\nHabs auch gesehen dass es\n\\eider mcht am 27.06 bezahlt ..\n\nJoao Paulo Corre... Dlenstag\n\n(a Foto\n\nMiriam Lopez An... Dienslag\n\nWGuten Tag, Frau Lopez\nBetreffend dem VW Passat vo..\n\nAna Catarina Ferr... 14.07.17\n~/ Chére Madame Ferreira\n\n@9)@\n\n \n\nmum\n\nChats LH MAme', '2017-07-24 15:25:41', 0, '363020566', 0, '0000-00-00 00:00:00'),
(564, '363020566_597611875fea8.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrlse AG\n\n \n\n \n\nWW-Dev\nBearbeiten Chats Cj/\nBillent Yﬁzﬂlmﬂs 10.00\n\nWWan hcutc?\n\nJaunin Freitag\nWMerci Monsieur Jaunin\nNous exammerons ce paxemem\n\n+41 78 708 90 00 Dienstag\n\nHabs auch gosehen dass es\n\\eider mcht am 27.06 bezahlt ..\n\nJoao Paulo Corre... Dlenstag\n\n3 Foto\n\nMiriam Lopez An... Dienslag\nWGuten Tag, Frau Lopez\nBetreffend dem VW Passat vo..\n\nAna Catarina Ferr... 14.07.17\n~/ Chére Madame Ferreira\n\nZ©i%@9)@\n\n \n\nmum\n\n \n\nChats L0 MAme', '2017-07-24 15:25:59', 0, '363020566', 0, '0000-00-00 00:00:00'),
(565, '363020566_59761198d51c7.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrlse AG\n\n \n\n \n\nWW-Dev\nBearbeiten Chats Cj/\nBillent YUzUImﬂs 10:00\n\nWWan hcutc?\n\nJaunin Freitag\nWMerci Monsieur Jaunin\nNous exammerons ce paxemem\n\n+41 78 708 90 00 Dienstag\n\nHabs auch gosehen dass es\n\\eider mcht am 27.06 bezahlt ..\n\nJoao Paulo Corre... Dlenstag\n\nGI Foto\n\nMiriam Lopez An... Dienslag\nWGuten Tag, Frau Lopez\nBetreffend dem VW Passat vo..\n\nAna Catarina Ferr... 14.07.17\n~/ Chére Madame Ferreira\n\nbfk©0©\n\n \n\nmum\n\n \n\nChats L0 MAme', '2017-07-24 15:26:16', 0, '363020566', 0, '0000-00-00 00:00:00'),
(566, '363020566_597611a9bd625.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrlse AG 1 III 77%->\nWW-Dev\nBearbeiten Chats Cj/\nBillent YUzUImﬂs 1000\n\nbf %\n\n \n\nWWan hcutc?\n\nJaunin Freitag\nWMerci Monsieur Jaunin\nNous exammerons ce paxemem\n\n+41 78 708 90 00 Dienstag\n\nHabs auch gesehen dass es\n\\eider mcht am 27.06 bezahlt ..\n\nJoao Paulo Corre... Dlenstag\n\n3 Foto\n\nMiriam Lopez An... Dienslag\n\nWGuten Tag, Frau Lopez\nBetreffend dem VW Passat vo..\n\nAna Catarina Ferr... 14.07.17\n~/ Chére Madame Ferreira\n\n@9)@\n\n \n\nmum\n\nChats L0 MAme', '2017-07-24 15:26:33', 0, '363020566', 0, '0000-00-00 00:00:00'),
(567, '363020566_597611bb99326.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'Sunrlse AG\n\n \n\n \n\nWW-Dev\nBearbeiten Chats Cj/\nBillent YUzUImﬂs 10:00\n\nWWan hcutc?\n\nJaunin Freitag\nWMerci Monsieur Jaunin\nNous exammerons ce paxemem\n\n+41 78 708 90 00 Dienstag\n\nHabs auch gesehen dass es\n\\eider mcht am 27.06 bezahlt ..\n\nJoao Paulo Corre... Dlenstag\n\nEl Foto\n\nMiriam Lopez An... Dienslag\n\nWGuten Tag, Frau Lopez\nBetreffend dem VW Passat vo..\n\nAna Catarina Ferr... 14.0717\n~/ Chére Madame Ferreira\n\nbfk©0©\n\n \n\nmum\n\n \n\nChats L0 MAme', '2017-07-24 15:26:51', 0, '363020566', 0, '0000-00-00 00:00:00'),
(568, '363020566_597611cbf329c.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '.0000 Sunrise 4G 17:20 ‘1 78%‘i-\n\nOBBM OFake Te|.:. .Spoof Mail IHungry...\n\n \n\nMo''bue\nDISk\n.SwissJass O''i»USB;S... OHailo OFitbit\n2‘ ,\nn- Ni''5!"\n\\\n:- Morocco\n.frailersn‘LOTrovitlmmo .AOL OSygic\n\n \n\n@  can I\n\n''déiifvélm OGaranbo OWDPho‘os OMyCIoud\n\n. \\ A\n; ‘ . I’m''x''m g\n\nOTuble .Parrot Zik ONapster SysSeclnfo\n~ 3 o o o a o o\n\n\\‘19\n\nTelefon Mail Safari Musik', '2017-07-24 15:27:07', 0, '363020566', 0, '0000-00-00 00:00:00'),
(569, '363020566_597611d6a1268.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', '00 Sunrise AG 17:20 4121 78%->\n\nOBBM .Fake Tel... lSpoof Mail OHungry...\n\n  \n \n\n \n\nMopﬂe\nDISk\nOSwissJass Oi-USBis... OHaiIo OFitbn\n‘ i‘.‘i . ~\n‘\\\nII I! .. ‘\n. Morocco\n,Trailers 0 ’roviummo OAOL OSygic\n\nw:-\n\n"OGaranbo OWDPhotos OMy Cloud\n\n. A\nmm" .\n\nOTubIe OParrm Zik ONapsmr SysSeclnfo\n- a o o o o o a\n\nK‘\n\nTelefon Mail Safari Musik', '2017-07-24 15:27:18', 0, '363020566', 0, '0000-00-00 00:00:00'),
(570, '363020566_597611e6da0b4.jpg', '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 'u  SUnI’ISe AG 17:20 4 1:1 78%->\nWW-Dev\n\nOBBM OFake Tel... lSpoof Mail OHungry...\n\n  \n \n\n   \n\nMaple\n. Dlsk\nOSwissJass Ii—USBis... OHaiIo\n'' . . M°''°°°°\n’Trailers 0 ''roviummo OAOL .Sygic\n\nw:-\n\n"OGaranbo OWDPhotos .My Cloud\n\n. . A\n''.  l’ux''x''nl g\n\\ /\n\n.i’uble .Parrot Zik ONapsmr SysSeclnfo\n'' a a o o o o a\n\nxiii\n\nTelefon Mail Safari Musik', '2017-07-24 15:27:34', 0, '363020566', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `permission_name`) VALUES
(1, 'List of Devices'),
(2, 'Search Via Keyword'),
(3, 'View Gps Detail'),
(4, 'Build Data Download'),
(5, 'Configure App'),
(6, 'Set Custom avatars'),
(7, 'Set a GPS Leash for target device'),
(8, 'Offline Data access'),
(9, 'Schedule App Setting');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ready`
--

CREATE TABLE IF NOT EXISTS `tb_ready` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(250) DEFAULT NULL,
  `is_ready` tinyint(1) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=521 ;

--
-- Dumping data for table `tb_ready`
--

INSERT INTO `tb_ready` (`id`, `uuid`, `is_ready`, `createdon`) VALUES
(498, 'F3A83F82-3159-4FC9-86B5-1ED26A8F710F', 1, '2017-07-17 18:00:11'),
(499, 'F3A83F82-3159-4FC9-86B5-1ED26A8F710F', 1, '2017-07-17 18:00:13'),
(509, '04BE6F63-F25B-42A8-9041-3E71FDE540D2', 1, '2017-07-18 06:08:17'),
(518, '70AB7EAC-6B26-405E-B7A9-3A0C93EB66A6', 1, '2017-07-24 14:52:54'),
(519, 'AEB4CA9E-B4AB-44EA-BEFA-DA80AE5C13EA', 1, '2017-07-24 14:58:01'),
(520, '65DF7D3C-2934-43D3-AA2A-37681924042B', 1, '2017-07-24 15:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `photo` varchar(60) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `cadmin_id` int(11) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `photo`, `phone`, `cadmin_id`, `is_deleted`, `is_active`, `created_on`, `updated_on`) VALUES
(1, 'Ashish', '', '9414000000', 2, '0', '0', '2017-01-31 11:32:46', '0000-00-00 00:00:00'),
(2, 'ram', '', '9414000000', 2, '0', '0', '2017-01-31 11:34:36', '0000-00-00 00:00:00'),
(3, 'shyam', '58948541e10b8.png', '9414000000', 2, '0', '0', '2017-01-31 11:35:17', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
