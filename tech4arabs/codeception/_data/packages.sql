-- MySQL dump 10.13  Distrib 5.6.26, for Linux (x86_64)
--
-- Host: localhost    Database: packages
-- ------------------------------------------------------
-- Server version	5.6.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `links` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `universities` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filetype` enum('pdf','rar','zip','jpeg','doc') COLLATE utf8_unicode_ci NOT NULL,
  `country` enum('afghanistan','albania','algeria','american samoa','andorra','angola','anguilla','antarctica','antigua and barbuda','argentina','armenia','aruba','australia','austria','azerbaijan','bahamas','bahrain','bangladesh','barbados','belarus','belgium','belize','benin','bermuda','bhutan','bolivia','bosnia and herzegowina','botswana','bouvet island','brazil','british indian ocean territory','brunei darussalam','bulgaria','burkina faso','burundi','cambodia','cameroon','canada','cabo verde','cayman islands','central african republic','chad','chile','china','christmas island','cocos islands','colombia','comoros','congo','congo, the democratic republic of the','cook islands','costa rica','cote d&#039;ivoire','croatia','cuba','cyprus','czech republic','denmark','djibouti','dominica','dominican republic','east timor','ecuador','egypt','el salvador','equatorial guinea','eritrea','estonia','ethiopia','falkland islands','faroe islands','fiji','finland','france','french guiana','french polynesia','french southern territories','gabon','gambia','georgia','germany','ghana','gibraltar','greece','greenland','grenada','guadeloupe','guam','guatemala','guinea','guinea-bissau','guyana','haiti','heard and mc donald islands','holy see','honduras','hong kong','hungary','iceland','india','indonesia','iran','iraq','ireland','israel','italy','jamaica','japan','jordan','kazakhstan','kenya','kiribati','korea, democratic people&#039;s republic of','korea, republic of','kuwait','kyrgyzstan','lao, people&#039;s democratic republic','latvia','lebanon','lesotho','liberia','libyan arab jamahiriya','liechtenstein','lithuania','luxembourg','macao','macedonia, the former yugoslav republic of','madagascar','malawi','malaysia','maldives','mali','malta','marshall islands','martinique','mauritania','mauritius','mayotte','mexico','micronesia, federated states of','moldova, republic of','monaco','mongolia','montserrat','morocco','mozambique','myanmar','namibia','nauru','nepal','netherlands','netherlands antilles','new caledonia','new zealand','nicaragua','niger','nigeria','niue','norfolk island','northern mariana islands','norway','oman','pakistan','palau','panama','papua new guinea','paraguay','peru','philippines','pitcairn','poland','portugal','puerto rico','qatar','reunion','romania','russian federation','rwanda','saint kitts and nevis','saint lucia','saint vincent and the grenadines','samoa','san marino','sao tome and principe','saudi arabia','senegal','seychelles','sierra leone','singapore','slovakia','slovenia','solomon islands','somalia','south africa','south georgia and the south sandwich islands','spain','sri lanka','st. helena','st. pierre and miquelon','sudan','suriname','svalbard and jan mayen islands','swaziland','sweden','switzerland','syrian arab republic','taiwan, province of china','tajikistan','tanzania, united republic of','thailand','togo','tokelau','tonga','trinidad and tobago','tunisia','turkey','turkmenistan','turks and caicos islands','tuvalu','uganda','ukraine','united arab emirates','united kingdom','united states','united states minor outlying islands','uruguay','uzbekistan','vanuatu','venezuela','vietnam','virgin islands','virgin islands','wallis and futuna islands','western sahara','yemen','serbia','zambia','zimbabwe') COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `faculty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (1,'Prof. Eden Spinka','prof-lenny-willms-i','Aut pariatur earum laborum neque est sit. Libero minima ipsum voluptatibus ab voluptas possimus nihil. Minus animi adipisci quia repudiandae sapiente.','a:1:{i:0;s:33:\"http://www.files./com/Luz Smitham\";}','a:1:{i:0;s:6:\"biskra\";}','pdf','bangladesh',0,1,'math','2016-05-10 15:03:35','2016-05-10 15:03:35'),(2,'Dr. Gaetano Kirlin','mrs-darlene-daniel','Sequi rerum officia sapiente alias. Quidem voluptatum rerum unde nesciunt ut alias laboriosam. Quis et non qui sapiente aut. Molestiae qui aliquam iusto vel.','a:1:{i:0;s:36:\"http://www.files./com/Velva Gottlieb\";}','a:1:{i:0;s:6:\"biskra\";}','zip','azerbaijan',0,2,'phisiq','2016-05-10 15:03:35','2016-05-10 15:03:35'),(3,'Antoinette Satterfield MD','jillian-hauck-ii','Amet voluptatem numquam asperiores sint voluptate omnis eum. Perferendis dolorum ratione error sunt. Eum illo cumque fugiat voluptatem quidem mollitia sequi nihil.','a:1:{i:0;s:33:\"http://www.files./com/Raheem Rowe\";}','a:1:{i:0;s:6:\"aglger\";}','pdf','antarctica',0,3,'math','2016-05-10 15:03:35','2016-05-10 15:03:35'),(4,'Dr. Nelle Pagac MD','dr-adrianna-dubuque','Quos magni et debitis. Id quisquam harum facere sit quidem magnam voluptates. Velit quia cumque quaerat doloremque sequi corrupti. Cumque doloremque est quisquam quibusdam.','a:1:{i:0;s:33:\"http://www.files./com/Kay Treutel\";}','a:1:{i:0;s:6:\"uxford\";}','rar','afghanistan',0,1,'math','2016-05-10 15:03:35','2016-05-10 15:03:35'),(5,'Marcelle Brown','ms-rachelle-marvin-dvm','Nisi blanditiis saepe similique sequi qui qui. Vel tempore nesciunt ducimus quam. Sit minus eos ipsam omnis qui.','a:1:{i:0;s:44:\"http://www.files./com/Kenyatta Macejkovic II\";}','a:1:{i:0;s:7:\"harfard\";}','rar','cabo verde',0,3,'biologie','2016-05-10 15:03:35','2016-05-10 15:03:35'),(6,'Prof. Diamond Rempel','tamia-konopelski','Enim ipsa maiores quasi temporibus et eveniet dolor. In assumenda sint placeat. Maiores excepturi similique debitis aut rerum aut quibusdam. Nam quae voluptatem sed iste.','a:1:{i:0;s:34:\"http://www.files./com/Monty Skiles\";}','a:1:{i:0;s:6:\"biskra\";}','rar','brazil',0,2,'biologie','2016-05-10 15:03:35','2016-05-10 15:03:35'),(7,'Savion Wuckert','ofelia-gorczany-dds','Velit magni porro quia fuga. Modi saepe quia assumenda in.\nSed in non sed nihil enim numquam quo magni. Vel mollitia qui porro. Ut qui pariatur earum vitae dicta.','a:1:{i:0;s:36:\"http://www.files./com/Elbert Stracke\";}','a:1:{i:0;s:7:\"harfard\";}','rar','cameroon',0,1,'math','2016-05-10 15:03:35','2016-05-10 15:03:35'),(8,'Andreane Bergnaum','mrs-lois-morar-i','Maiores aut dignissimos sit qui dolore reprehenderit aut. Ut aut quia debitis quo rem velit. Laudantium sed ducimus quo non fugiat ut optio. Quisquam quod libero blanditiis voluptate cumque iure.','a:1:{i:0;s:45:\"http://www.files./com/Guillermo Gusikowski IV\";}','a:1:{i:0;s:6:\"aglger\";}','rar','belgium',0,3,'math','2016-05-10 15:03:35','2016-05-10 15:03:35'),(9,'Gerson Runolfsson IV','mrs-eloise-hermiston-ii','Quaerat cupiditate nemo itaque et minima ipsum. In ut iure earum sequi debitis. Magni occaecati qui consequuntur repellendus dolorem pariatur quaerat.','a:1:{i:0;s:43:\"http://www.files./com/Ms. Deborah Nolan PhD\";}','a:1:{i:0;s:7:\"harfard\";}','rar','christmas island',0,3,'biologie','2016-05-10 15:03:35','2016-05-10 15:03:35'),(10,'Sedrick Orn','ricardo-predovic','Aut rerum similique sed architecto. Excepturi ut fuga iure odit unde inventore. Aliquam ipsam id est est praesentium.','a:1:{i:0;s:43:\"http://www.files./com/Miss Karlie Gaylord V\";}','a:1:{i:0;s:7:\"harfard\";}','zip','bhutan',0,2,'phisiq','2016-05-10 15:03:35','2016-05-10 15:03:35'),(11,'Coy Dach','peter-hoppe','Fugit necessitatibus et illo. Esse reprehenderit dolores perferendis et. Et voluptatem repudiandae voluptatum labore molestiae cum.','a:1:{i:0;s:35:\"http://www.files./com/Kathleen King\";}','a:1:{i:0;s:3:\"esi\";}','zip','cayman islands',0,3,'phisiq','2016-05-10 15:03:35','2016-05-10 15:03:35'),(12,'Micheal Hand','blaise-tillman','Consectetur qui ut repudiandae doloribus mollitia nihil. Adipisci iste ut quia laudantium laborum dolorem aut non. Quos porro tenetur consequatur quam expedita doloremque corporis.','a:1:{i:0;s:38:\"http://www.files./com/Mr. Wiley Senger\";}','a:1:{i:0;s:6:\"aglger\";}','zip','anguilla',0,3,'biologie','2016-05-10 15:03:35','2016-05-10 15:03:35'),(13,'Janelle Jast','prof-dagmar-schultz','Autem dolor voluptas cumque nostrum. Ab ex aut autem nostrum incidunt. Dolores quisquam aut deleniti libero pariatur qui.','a:1:{i:0;s:36:\"http://www.files./com/Mortimer Doyle\";}','a:1:{i:0;s:7:\"harfard\";}','pdf','colombia',0,2,'phisiq','2016-05-10 15:03:35','2016-05-10 15:03:35'),(14,'Ms. Nyasia Wolf','trenton-hoppe','Nostrum et qui voluptatum praesentium blanditiis sed et. Mollitia consequatur autem totam reprehenderit. Alias odit in vel rerum expedita eius.','a:1:{i:0;s:40:\"http://www.files./com/Samantha Wilderman\";}','a:1:{i:0;s:7:\"harfard\";}','pdf','congo, the democratic republic of the',0,2,'phisiq','2016-05-10 15:03:35','2016-05-10 15:03:35'),(15,'Mrs. Natalia Bashirian I','kip-daugherty','Qui ut laboriosam error enim et quis. Reprehenderit sequi dolore eum voluptas voluptate. Ratione dolores voluptas nulla sint soluta sint qui laborum. Ab quia error quis suscipit rerum voluptatem.','a:1:{i:0;s:39:\"http://www.files./com/Beulah Heaney DVM\";}','a:1:{i:0;s:7:\"harfard\";}','rar','bermuda',0,1,'biologie','2016-05-10 15:03:35','2016-05-10 15:03:35'),(16,'Zoie Schmitt','dessie-renner','Aut qui et provident vel. Iusto cupiditate impedit corporis iste accusantium. Ex quibusdam alias voluptatem molestias.','a:1:{i:0;s:34:\"http://www.files./com/Mafalda Lang\";}','a:1:{i:0;s:6:\"uxford\";}','rar','botswana',0,2,'biologie','2016-05-10 15:03:35','2016-05-10 15:03:35'),(17,'Mrs. Trinity Crooks PhD','mr-alexis-walsh','Hic asperiores voluptatem alias animi est eius eos. Voluptatem placeat occaecati voluptatem aut. Deleniti non maxime voluptas corporis earum porro.','a:1:{i:0;s:35:\"http://www.files./com/Wilbert Price\";}','a:1:{i:0;s:6:\"biskra\";}','zip','bangladesh',0,2,'biologie','2016-05-10 15:03:35','2016-05-10 15:03:35'),(18,'Prof. Alta Macejkovic','wiley-rippin-iv','Natus voluptas amet et at. Et dolores repellat eligendi sit qui et omnis. Vero adipisci quisquam ullam dolor corrupti omnis saepe.','a:1:{i:0;s:39:\"http://www.files./com/Javon Jacobson IV\";}','a:1:{i:0;s:6:\"aglger\";}','zip','brazil',0,2,'biologie','2016-05-10 15:03:35','2016-05-10 15:03:35'),(19,'Andy Hilpert','westley-mills-phd','A voluptatem nisi blanditiis magni totam est quo. Asperiores eligendi beatae rem aut illo vitae recusandae. Ipsum quo ut magni in.','a:1:{i:0;s:41:\"http://www.files./com/Candelario Mosciski\";}','a:1:{i:0;s:6:\"uxford\";}','pdf','benin',0,2,'math','2016-05-10 15:03:35','2016-05-10 15:03:35'),(20,'Dale Schmidt','kennith-ledner-phd','Illum non error sed consequatur non quia delectus. Asperiores earum amet eos veniam accusantium ratione odio.','a:1:{i:0;s:45:\"http://www.files./com/Prof. Elaina Reichert I\";}','a:1:{i:0;s:3:\"esi\";}','rar','christmas island',0,2,'phisiq','2016-05-10 15:03:36','2016-05-10 15:03:36'),(21,'Romaine Cormier','green-dietrich-dds','Quae voluptates nesciunt perspiciatis est exercitationem quisquam officia. Consequatur voluptate et ipsum. Perferendis praesentium id ea. Voluptas aperiam saepe ut quasi.','a:1:{i:0;s:39:\"http://www.files./com/Dr. Issac Waelchi\";}','a:1:{i:0;s:3:\"esi\";}','pdf','cayman islands',0,3,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(22,'Maximo Sauer','dr-jade-oberbrunner-dvm','Vel excepturi est omnis eum. Ducimus odit quia eligendi culpa. Nobis culpa et aut quae maxime porro. Molestiae sit nihil quia eum nam repellendus.','a:1:{i:0;s:38:\"http://www.files./com/Kelsie Dickinson\";}','a:1:{i:0;s:6:\"uxford\";}','pdf','bouvet island',0,2,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(23,'Preston Jast','mrs-chelsea-schmidt-md','Quod quasi officia corporis aliquam itaque debitis ut. Sed sit ea iste impedit molestias unde ad. Omnis dignissimos enim magni minus sit. Consequuntur nam fuga tenetur ducimus enim.','a:1:{i:0;s:37:\"http://www.files./com/Curtis Schmeler\";}','a:1:{i:0;s:6:\"aglger\";}','zip','cuba',0,2,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(24,'Fleta Jacobs','floy-mills','Tenetur sint non vel. Aperiam est odio nihil totam. Amet omnis doloribus vero deserunt. Sint quidem odio ab commodi doloremque nulla.','a:1:{i:0;s:45:\"http://www.files./com/Prof. Joan Aufderhar II\";}','a:1:{i:0;s:3:\"esi\";}','zip','algeria',0,1,'math','2016-05-10 15:03:36','2016-05-10 15:03:36'),(25,'Mr. Donald Rempel MD','mr-benjamin-weissnat-phd','Accusamus qui perferendis laboriosam dolores ut quidem. Inventore illo minus corrupti molestiae reiciendis. Officia commodi esse voluptatem laborum fugiat qui corporis.','a:1:{i:0;s:34:\"http://www.files./com/Brady Brakus\";}','a:1:{i:0;s:6:\"aglger\";}','rar','canada',0,1,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(26,'Mr. Wilton Koch PhD','keaton-pfeffer-jr','Voluptatum aliquid sed ut repellat voluptatem. Doloribus asperiores iusto nesciunt. Occaecati totam error sunt inventore qui. Repudiandae a et eos non.','a:1:{i:0;s:33:\"http://www.files./com/Jacky Brown\";}','a:1:{i:0;s:6:\"biskra\";}','rar','chile',0,2,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(27,'Nash Bernier','laurence-maggio','Non sit ut veniam pariatur totam. Voluptates dolores fuga nisi aut accusantium. Et et aperiam sed.','a:1:{i:0;s:39:\"http://www.files./com/Fabiola Gulgowski\";}','a:1:{i:0;s:6:\"aglger\";}','zip','cuba',0,2,'math','2016-05-10 15:03:36','2016-05-10 15:03:36'),(28,'Dr. Quincy Morissette DDS','shyanne-mayer','Et voluptatibus numquam debitis est iusto totam. Natus explicabo ipsum qui. Quia sint quos voluptate tempora rerum.','a:1:{i:0;s:37:\"http://www.files./com/Fausto Schoen I\";}','a:1:{i:0;s:7:\"harfard\";}','pdf','bhutan',0,2,'phisiq','2016-05-10 15:03:36','2016-05-10 15:03:36'),(29,'Osborne Medhurst','ms-iliana-reilly','Tempore aperiam maxime quos dolorum. Molestiae esse architecto eum id. Cum debitis quos molestiae consequatur et. Voluptates ipsum quam quaerat dolorem.','a:1:{i:0;s:35:\"http://www.files./com/Shania Beahan\";}','a:1:{i:0;s:6:\"aglger\";}','pdf','comoros',0,2,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(30,'Ardith Wisoky DVM','antonietta-hane','Accusantium est aliquid est. Aspernatur ducimus ea est.','a:1:{i:0;s:36:\"http://www.files./com/Brooke Schmidt\";}','a:1:{i:0;s:6:\"uxford\";}','zip','australia',0,2,'phisiq','2016-05-10 15:03:36','2016-05-10 15:03:36'),(31,'Madilyn Durgan','blake-rogahn','Pariatur aut aut nisi. Doloribus ipsum aliquid repellat qui aliquid quo ut. Esse et minima sed corrupti facere nulla. Animi quos ipsa sit nostrum eius rem.','a:1:{i:0;s:37:\"http://www.files./com/Forest Koch DDS\";}','a:1:{i:0;s:6:\"biskra\";}','pdf','british indian ocean territory',0,3,'math','2016-05-10 15:03:36','2016-05-10 15:03:36'),(32,'Tommie Mertz','dr-dean-gaylord-iii','Accusantium est amet culpa quis omnis. Architecto aut nostrum voluptatem commodi deserunt. Necessitatibus omnis ut ut quidem ut eum nobis.','a:1:{i:0;s:39:\"http://www.files./com/D\'angelo Schiller\";}','a:1:{i:0;s:6:\"biskra\";}','pdf','antarctica',0,3,'phisiq','2016-05-10 15:03:36','2016-05-10 15:03:36'),(33,'Margot Abbott','dr-orrin-frami-dds','Nemo incidunt placeat possimus aut nam dignissimos ullam. Ipsum dolor delectus veritatis nulla. Quo veritatis velit tenetur quisquam et quia asperiores. Tempore et a quos.','a:1:{i:0;s:39:\"http://www.files./com/General Langworth\";}','a:1:{i:0;s:7:\"harfard\";}','pdf','botswana',0,3,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(34,'Harmony Windler','kellie-christiansen','Aut impedit similique ab quam dignissimos. Natus eligendi iure voluptatem.\nDoloremque veniam pariatur quod consequuntur. Quis autem aut et recusandae. Est in recusandae id voluptas omnis.','a:1:{i:0;s:36:\"http://www.files./com/Evalyn Kling V\";}','a:1:{i:0;s:6:\"aglger\";}','pdf','bahamas',0,2,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(35,'Carson Hahn','mr-perry-dibbert','Eius pariatur optio ipsum et. Illum enim dolorem qui voluptas. Laborum debitis omnis fuga natus animi non. Qui reiciendis occaecati nihil.','a:1:{i:0;s:36:\"http://www.files./com/Carter Ullrich\";}','a:1:{i:0;s:6:\"uxford\";}','rar','bangladesh',0,3,'phisiq','2016-05-10 15:03:36','2016-05-10 15:03:36'),(36,'Emelie Harvey I','verda-durgan','Et aut expedita eos ex ut illo est. Omnis qui sit impedit laborum eaque. Et amet assumenda pariatur aut dolore quis. Magni aperiam voluptatibus voluptas quasi aut.','a:1:{i:0;s:43:\"http://www.files./com/Prof. Caleb Stark Jr.\";}','a:1:{i:0;s:7:\"harfard\";}','zip','bouvet island',0,2,'math','2016-05-10 15:03:36','2016-05-10 15:03:36'),(37,'Fritz McCullough','dr-fermin-cormier','Eum sint aut est vel consequatur. Voluptatem sequi minus voluptatem dolores doloribus ab delectus. Nesciunt et libero iusto eos amet quam.','a:1:{i:0;s:35:\"http://www.files./com/Danny D\'Amore\";}','a:1:{i:0;s:7:\"harfard\";}','rar','aruba',0,3,'phisiq','2016-05-10 15:03:36','2016-05-10 15:03:36'),(38,'Ramona Dicki','lynn-murazik','Enim tempore quis error id earum soluta magni laborum. Est perferendis dolor ex ut illum odio. Itaque exercitationem aperiam qui voluptatem nihil.','a:1:{i:0;s:45:\"http://www.files./com/Mrs. Filomena Nicolas V\";}','a:1:{i:0;s:6:\"uxford\";}','rar','cook islands',0,2,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(39,'Alvera Herzog','jarred-jast-md','Et repellendus eum a et maxime. Rerum aut mollitia earum qui fuga. Repellat reiciendis nemo aperiam recusandae.','a:1:{i:0;s:39:\"http://www.files./com/Dr. Cordell Frami\";}','a:1:{i:0;s:6:\"aglger\";}','zip','british indian ocean territory',0,2,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(40,'Baylee Will','mr-ceasar-rempel-phd','Et dolores cum similique debitis. Voluptate fugit eius perferendis veritatis vel et.','a:1:{i:0;s:41:\"http://www.files./com/Mr. Ari Nicolas DDS\";}','a:1:{i:0;s:7:\"harfard\";}','rar','central african republic',0,1,'math','2016-05-10 15:03:36','2016-05-10 15:03:36'),(41,'Dr. Christa Hermann','ms-harmony-oconnell','In eos in ratione accusantium sit ut. Ut non id ratione sit quae. Illo dolore voluptas nulla minima et architecto. Ullam velit harum nemo perspiciatis nesciunt.','a:1:{i:0;s:37:\"http://www.files./com/Abagail Corkery\";}','a:1:{i:0;s:6:\"uxford\";}','rar','bolivia',0,2,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(42,'Mrs. Hortense Hegmann','cole-damore','Dolorum occaecati eum excepturi soluta. Qui ab maxime et saepe fugit id tempore. Veritatis fugit quidem impedit vitae eum aut. Itaque deleniti iusto eligendi quam voluptate.','a:1:{i:0;s:43:\"http://www.files./com/Kailee Schamberger MD\";}','a:1:{i:0;s:6:\"biskra\";}','rar','american samoa',0,3,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(43,'Bella McLaughlin DDS','perry-romaguera','Perferendis doloribus natus quae voluptas ullam dolorem. Quia mollitia perferendis impedit tenetur. Quia vitae molestias nulla nulla minima rerum.','a:1:{i:0;s:35:\"http://www.files./com/Dora Turcotte\";}','a:1:{i:0;s:6:\"biskra\";}','rar','central african republic',0,1,'math','2016-05-10 15:03:36','2016-05-10 15:03:36'),(44,'Wayne Will','electa-hand','A deserunt qui quas ipsam voluptatibus fugiat. Ipsam facere ut aut aut dolores rerum perspiciatis culpa. Non corrupti aut accusamus nesciunt. Qui ipsum aut soluta consequatur minus ex.','a:1:{i:0;s:36:\"http://www.files./com/Kelley Goyette\";}','a:1:{i:0;s:6:\"uxford\";}','pdf','american samoa',0,1,'phisiq','2016-05-10 15:03:36','2016-05-10 15:03:36'),(45,'Dr. Alda Altenwerth V','myron-cartwright','Est ut voluptatum nostrum vel ab. Est provident sint commodi voluptate perspiciatis dolores suscipit. Voluptatem unde modi vel eum nostrum.','a:1:{i:0;s:42:\"http://www.files./com/Mr. Carson Kunde DVM\";}','a:1:{i:0;s:6:\"biskra\";}','pdf','antigua and barbuda',0,3,'biologie','2016-05-10 15:03:36','2016-05-10 15:03:36'),(46,'Mr. Vincent Hintz','erwin-ziemann','Porro sed nostrum qui quia. Dolor nobis velit est. Numquam asperiores ipsum sint quam impedit ut. Adipisci dolore sit cumque sunt ad. Qui est maiores rerum distinctio quos odit qui.','a:1:{i:0;s:45:\"http://www.files./com/Mr. Rupert Wilderman IV\";}','a:1:{i:0;s:6:\"biskra\";}','pdf','brunei darussalam',0,3,'biologie','2016-05-10 15:03:37','2016-05-10 15:03:37'),(47,'Edythe Rowe','prof-kendall-krajcik-dvm','Amet quo et occaecati non nemo. Et sunt cum quia ut velit ullam. Quod dignissimos alias laudantium facere voluptas dolor unde cum. Consectetur soluta eum repudiandae ut et assumenda repudiandae.','a:1:{i:0;s:34:\"http://www.files./com/Cydney Mante\";}','a:1:{i:0;s:6:\"uxford\";}','rar','cuba',0,3,'math','2016-05-10 15:03:37','2016-05-10 15:03:37'),(48,'Mr. Ryder Johns','dr-carson-stroman-dvm','Sit et amet nihil adipisci reiciendis. Mollitia sunt et est velit eveniet ab nesciunt. Aliquid illum quae voluptates sint quis et beatae. Officia officia iste eligendi nemo rerum velit harum.','a:1:{i:0;s:35:\"http://www.files./com/Tina Schuster\";}','a:1:{i:0;s:6:\"biskra\";}','pdf','colombia',0,3,'phisiq','2016-05-10 15:03:37','2016-05-10 15:03:37'),(49,'Pamela Koch','ryder-dicki-md','Quo non nulla libero cupiditate modi. Nulla recusandae ab quo non unde. Voluptates ipsum quaerat error unde quo minus. Numquam nisi id hic et.','a:1:{i:0;s:34:\"http://www.files./com/Rashad Dicki\";}','a:1:{i:0;s:6:\"biskra\";}','zip','armenia',0,2,'phisiq','2016-05-10 15:03:37','2016-05-10 15:03:37'),(50,'Patience Parker','wilma-wyman','Adipisci sed laboriosam dicta doloribus corrupti numquam placeat. Et aperiam saepe sint rerum sit dignissimos. Hic alias illo ut minima qui error perferendis cumque. Dicta illo qui et neque.','a:1:{i:0;s:38:\"http://www.files./com/Lemuel Wuckert V\";}','a:1:{i:0;s:6:\"biskra\";}','rar','cambodia',0,2,'math','2016-05-10 15:03:37','2016-05-10 15:03:37'),(51,'Ms. Martine Morar III','shaun-kilback','Vel quia error soluta. Eveniet similique cupiditate dicta aut nihil. Delectus nostrum sint quidem optio similique non soluta qui. Est quia quibusdam cumque autem dolor.','a:1:{i:0;s:35:\"http://www.files./com/Cyrus Zboncak\";}','a:1:{i:0;s:6:\"biskra\";}','rar','bouvet island',0,2,'biologie','2016-05-10 15:03:37','2016-05-10 15:03:37'),(52,'Earline Mitchell','vern-runolfsdottir','Dolore quia minima ullam dolorem fuga eligendi dolores. Molestias et quam voluptas quia asperiores ratione rerum. Sint quia minima pariatur qui qui nihil.','a:1:{i:0;s:41:\"http://www.files./com/Mervin Botsford Sr.\";}','a:1:{i:0;s:7:\"harfard\";}','pdf','comoros',0,1,'biologie','2016-05-10 15:03:37','2016-05-10 15:03:37'),(53,'Dr. Raoul Wunsch','ebony-abernathy-v','Inventore et suscipit sapiente placeat similique. Nihil pariatur fuga omnis est. Corrupti nihil nihil pariatur illo magnam architecto. Harum possimus quia facilis nulla ad quisquam laudantium.','a:1:{i:0;s:35:\"http://www.files./com/Pansy Gutmann\";}','a:1:{i:0;s:6:\"aglger\";}','rar','chile',0,1,'phisiq','2016-05-10 15:03:37','2016-05-10 15:03:37'),(54,'Chaya Feil','mr-haleigh-rogahn-v','Est recusandae laudantium quod sit. Voluptate nisi deserunt nostrum corrupti ea. Laborum commodi quae deserunt pariatur expedita quasi aut. Sit voluptatem sint nemo ratione est quis.','a:1:{i:0;s:33:\"http://www.files./com/Kelsi Kling\";}','a:1:{i:0;s:7:\"harfard\";}','rar','albania',0,2,'math','2016-05-10 15:03:37','2016-05-10 15:03:37'),(55,'Dr. Maximo Gleason IV','miss-jennyfer-paucek','Qui amet provident aperiam nesciunt eum ratione quo fuga. Est illum amet aut. Dolorem et illo eum sit inventore vel.','a:1:{i:0;s:39:\"http://www.files./com/Birdie McCullough\";}','a:1:{i:0;s:3:\"esi\";}','rar','chad',0,2,'phisiq','2016-05-10 15:03:37','2016-05-10 15:03:37'),(56,'Rebecca Koepp','lillian-schuster-dvm','Eos et reprehenderit doloribus et. Iusto vero maiores et aliquid exercitationem. Natus cum sit vel enim consequuntur in. Et eos sed aut dolores.','a:1:{i:0;s:37:\"http://www.files./com/Jonathon Graham\";}','a:1:{i:0;s:6:\"biskra\";}','rar','azerbaijan',0,2,'math','2016-05-10 15:03:37','2016-05-10 15:03:37'),(57,'Prof. Uriel Greenholt','onie-hand','Ut saepe vel at. Fuga odio dolore enim labore id perspiciatis ea. Cum soluta dolores ducimus deserunt deleniti voluptas aliquid sequi. In repellendus qui voluptatum cum in consequuntur ab ut.','a:1:{i:0;s:32:\"http://www.files./com/Clark Batz\";}','a:1:{i:0;s:7:\"harfard\";}','rar','american samoa',0,2,'math','2016-05-10 15:03:37','2016-05-10 15:03:37'),(58,'Prof. Athena Langosh','mrs-nyasia-grant-dvm','Sed voluptate architecto dolor dolores similique. Omnis facere voluptatem qui. Et maxime excepturi vitae vel est voluptas. Sint voluptatem ipsa qui vel qui numquam repudiandae.','a:1:{i:0;s:40:\"http://www.files./com/River Connelly Sr.\";}','a:1:{i:0;s:6:\"uxford\";}','pdf','croatia',0,3,'biologie','2016-05-10 15:03:37','2016-05-10 15:03:37'),(59,'Tina Wehner I','prof-josh-walter','Molestiae qui similique sed repellat quaerat voluptate. Ut omnis quasi ad accusamus delectus. Quia ut deserunt est doloribus.','a:1:{i:0;s:38:\"http://www.files./com/Mr. Casimir Rowe\";}','a:1:{i:0;s:6:\"biskra\";}','zip','comoros',0,2,'math','2016-05-10 15:03:37','2016-05-10 15:03:37'),(60,'Nakia Dare','miss-brianne-feil','Non voluptatem neque soluta quas labore. Ratione aut distinctio expedita dignissimos. Et qui optio fuga.','a:1:{i:0;s:33:\"http://www.files./com/Jerod Bauch\";}','a:1:{i:0;s:6:\"biskra\";}','zip','bhutan',0,1,'math','2016-05-10 15:03:37','2016-05-10 15:03:37'),(61,'Jackson Carroll','domenick-borer','Accusamus facere ipsa accusantium qui. Natus rerum ab eius est ut sint. Et eum dolorem eos totam sint illum quia vel. Repudiandae labore non repudiandae enim.','a:1:{i:0;s:41:\"http://www.files./com/Sterling Dietrich I\";}','a:1:{i:0;s:6:\"biskra\";}','rar','congo, the democratic republic of the',0,3,'biologie','2016-05-10 15:03:37','2016-05-10 15:03:37'),(62,'Daphney Hammes DVM','samantha-hammes','Sed rerum eligendi illo aut reprehenderit magnam. Maiores sit omnis repudiandae cum ut odio veniam esse.','a:1:{i:0;s:33:\"http://www.files./com/Thea Blanda\";}','a:1:{i:0;s:6:\"biskra\";}','zip','bangladesh',0,2,'math','2016-05-10 15:03:37','2016-05-10 15:03:37'),(63,'Janet Schroeder','winnifred-harber-dds','Commodi molestiae adipisci corporis ipsam iste quos ullam. Aut molestiae aut quo. Labore alias non alias voluptas dolore consequatur. Rem reiciendis suscipit ea.','a:1:{i:0;s:36:\"http://www.files./com/Chesley Blanda\";}','a:1:{i:0;s:6:\"aglger\";}','rar','argentina',0,1,'biologie','2016-05-10 15:03:37','2016-05-10 15:03:37'),(64,'Miss Freeda Schamberger','torrey-keebler','Dolores ea delectus dicta omnis illo molestias animi consequatur. Dolore sit animi est quae. Rerum est quae voluptas.','a:1:{i:0;s:37:\"http://www.files./com/Barrett Effertz\";}','a:1:{i:0;s:3:\"esi\";}','pdf','benin',0,3,'math','2016-05-10 15:03:37','2016-05-10 15:03:37'),(65,'Mr. Eliezer Aufderhar Jr.','sasha-hintz','Quae ex vitae vero quisquam ipsa ut aspernatur. Vero ipsa voluptatem ut consequuntur molestiae id. Doloremque consequatur esse quis sed.','a:1:{i:0;s:41:\"http://www.files./com/Dr. Erick Wilderman\";}','a:1:{i:0;s:7:\"harfard\";}','zip','brunei darussalam',0,3,'phisiq','2016-05-10 15:03:37','2016-05-10 15:03:37'),(66,'Alfreda Weissnat','ariane-green','Sint dolores vel et dignissimos animi enim aut earum. Molestias perspiciatis quis tenetur rerum quia suscipit. Adipisci inventore hic eum provident iste.','a:1:{i:0;s:46:\"http://www.files./com/Mr. Norbert Dickinson IV\";}','a:1:{i:0;s:3:\"esi\";}','rar','antarctica',0,3,'math','2016-05-10 15:03:37','2016-05-10 15:03:37'),(67,'Mariano Lebsack','gregoria-brakus','Quaerat facere praesentium molestiae aut reiciendis. Quod omnis odit voluptatem fugit est tenetur. Aut nulla quia magni est harum voluptatibus ut in.','a:1:{i:0;s:36:\"http://www.files./com/Wilburn Spinka\";}','a:1:{i:0;s:6:\"biskra\";}','zip','brunei darussalam',0,2,'biologie','2016-05-10 15:03:37','2016-05-10 15:03:37'),(68,'Hazel Lang','tavares-oreilly','Laboriosam ipsa molestiae adipisci non ratione est soluta. Quam a officiis animi voluptatibus. Laudantium ut dolorem consequuntur neque aperiam eum recusandae rerum. Minus aut atque aut dolor.','a:1:{i:0;s:36:\"http://www.files./com/Citlalli Zieme\";}','a:1:{i:0;s:6:\"biskra\";}','pdf','antigua and barbuda',0,3,'phisiq','2016-05-10 15:03:37','2016-05-10 15:03:37'),(69,'Miss Lina Konopelski','prof-quentin-ryan-i','Nesciunt et facilis atque in perspiciatis. Vel iusto nam voluptatem in accusamus nulla. Omnis ducimus dolor qui.','a:1:{i:0;s:45:\"http://www.files./com/Dr. Alycia Eichmann Jr.\";}','a:1:{i:0;s:7:\"harfard\";}','rar','canada',0,2,'biologie','2016-05-10 15:03:38','2016-05-10 15:03:38'),(70,'Dr. Rashawn Walsh DVM','prof-moshe-kertzmann','Inventore quaerat soluta rerum quia corrupti consequatur. Enim cumque recusandae iusto tempore voluptatem sint. Dolorem atque nemo odio quibusdam ipsam.','a:1:{i:0;s:43:\"http://www.files./com/Mr. Demetrius Fritsch\";}','a:1:{i:0;s:3:\"esi\";}','zip','bangladesh',0,1,'biologie','2016-05-10 15:03:38','2016-05-10 15:03:38'),(71,'Valentine Mayert','kelsie-gleichner','Fuga officiis laudantium numquam sit rerum omnis. Culpa deserunt sint doloribus sed. Nulla illo harum non voluptatem. Est voluptatibus delectus aliquam quis saepe asperiores.','a:1:{i:0;s:34:\"http://www.files./com/Adelia Moore\";}','a:1:{i:0;s:7:\"harfard\";}','pdf','bahamas',0,2,'biologie','2016-05-10 15:03:38','2016-05-10 15:03:38'),(72,'Prof. Freddy Bechtelar','mina-lindgren-md','Dolor deleniti architecto doloribus ducimus sed ab. Tempora sunt alias nesciunt sunt est aut illum. Itaque rerum velit aut.','a:1:{i:0;s:44:\"http://www.files./com/Miss Aryanna Hoppe PhD\";}','a:1:{i:0;s:6:\"biskra\";}','rar','antarctica',0,1,'phisiq','2016-05-10 15:03:38','2016-05-10 15:03:38'),(73,'Pierce Harber','yasmeen-muller-ii','Perspiciatis saepe exercitationem eos. Sequi labore at omnis ullam. Reiciendis minima labore quo ut assumenda.','a:1:{i:0;s:35:\"http://www.files./com/Norma Monahan\";}','a:1:{i:0;s:3:\"esi\";}','rar','bolivia',0,3,'phisiq','2016-05-10 15:03:38','2016-05-10 15:03:38'),(74,'Edward Funk V','henriette-brown','Vel et magni asperiores corrupti. Odio odit et dignissimos sit rerum. Doloremque veniam repellendus nobis quibusdam porro.','a:1:{i:0;s:38:\"http://www.files./com/Esteban Gorczany\";}','a:1:{i:0;s:6:\"aglger\";}','pdf','barbados',0,3,'biologie','2016-05-10 15:03:38','2016-05-10 15:03:38'),(75,'Karelle Collier','garnett-schowalter','Ut magnam dolore expedita. Omnis quia est ipsam aliquid ex aliquam. Ducimus aperiam in ex.','a:1:{i:0;s:37:\"http://www.files./com/Florine O\'Keefe\";}','a:1:{i:0;s:3:\"esi\";}','pdf','cameroon',0,3,'math','2016-05-10 15:03:38','2016-05-10 15:03:38'),(76,'Arturo Jacobson','rosie-lebsack','Voluptatem possimus dolorem distinctio. Veritatis autem consequatur laudantium eum fuga odit id. Et non optio nemo corrupti reprehenderit id.','a:1:{i:0;s:33:\"http://www.files./com/Roger Hilll\";}','a:1:{i:0;s:6:\"biskra\";}','rar','british indian ocean territory',0,3,'biologie','2016-05-10 15:03:38','2016-05-10 15:03:38'),(77,'Andre Bashirian','kelsie-dicki-i','Quasi dolorem velit sed et enim eveniet et. Soluta animi occaecati reprehenderit quos aut.','a:1:{i:0;s:47:\"http://www.files./com/Prof. Kennith Marquardt I\";}','a:1:{i:0;s:6:\"biskra\";}','rar','brunei darussalam',0,2,'biologie','2016-05-10 15:03:38','2016-05-10 15:03:38'),(78,'Telly Cremin','fred-predovic-ii','Quod est mollitia possimus. Quas vel consequatur vero aspernatur ut eligendi. Neque id ut consequatur ea. Veritatis sit assumenda est architecto.','a:1:{i:0;s:41:\"http://www.files./com/Kristopher Howe III\";}','a:1:{i:0;s:6:\"aglger\";}','zip','colombia',0,3,'biologie','2016-05-10 15:03:38','2016-05-10 15:03:38'),(79,'Ella Dibbert','una-koss','A repellendus dolor sit placeat natus. Dicta et et debitis cupiditate fuga. Nam quia facere est sunt sapiente. Labore et nobis harum omnis.','a:1:{i:0;s:34:\"http://www.files./com/Eden Langosh\";}','a:1:{i:0;s:7:\"harfard\";}','pdf','argentina',0,1,'math','2016-05-10 15:03:38','2016-05-10 15:03:38'),(80,'Mr. Marcelo Predovic MD','maynard-grimes','Sit officiis iste aut quis temporibus. Velit sunt libero ad provident. Voluptas enim numquam architecto et ipsum dolores repudiandae. Dolor ut nihil quaerat fuga facilis molestiae.','a:1:{i:0;s:42:\"http://www.files./com/Prof. Mayra Casper I\";}','a:1:{i:0;s:7:\"harfard\";}','zip','bouvet island',0,3,'phisiq','2016-05-10 15:03:38','2016-05-10 15:03:38'),(81,'Katrine Bahringer IV','prof-ned-aufderhar-iv','Dicta sed dolores dolorem mollitia sint id. Inventore a molestiae qui dolorum tenetur. Vitae repellendus et sit. Minus velit natus culpa in.','a:1:{i:0;s:35:\"http://www.files./com/Jarrett Weber\";}','a:1:{i:0;s:6:\"aglger\";}','rar','costa rica',0,2,'math','2016-05-10 15:03:38','2016-05-10 15:03:38'),(82,'Eleanora Gleason','norwood-schowalter','Id voluptatum aliquid necessitatibus dicta. Aut velit velit qui culpa. Quae fuga suscipit in eos voluptatem sit. Nam labore architecto enim similique eligendi vel.','a:1:{i:0;s:43:\"http://www.files./com/Marcelina Bogisich IV\";}','a:1:{i:0;s:6:\"aglger\";}','pdf','cocos islands',0,2,'phisiq','2016-05-10 15:03:38','2016-05-10 15:03:38'),(83,'Miller Hane','shany-terry','Saepe non unde laboriosam accusamus. Quod molestiae in corrupti soluta ducimus rerum et soluta.\nEaque aut sed et magni. Et laboriosam error qui cum totam hic. Eos corporis illum aut ut delectus.','a:1:{i:0;s:39:\"http://www.files./com/Zackary Wilkinson\";}','a:1:{i:0;s:7:\"harfard\";}','pdf','algeria',0,1,'phisiq','2016-05-10 15:03:38','2016-05-10 15:03:38'),(84,'Vincenza Wintheiser','maynard-botsford','Culpa harum iusto excepturi et aut dolores aliquam. Optio consequatur quo in officiis fugiat et. Sed illo ipsa facere error illum.','a:1:{i:0;s:36:\"http://www.files./com/Dereck Kub III\";}','a:1:{i:0;s:3:\"esi\";}','pdf','comoros',0,1,'math','2016-05-10 15:03:38','2016-05-10 15:03:38'),(85,'Nicole Olson','aliyah-hartmann','Reprehenderit molestias fugit quam eos. Officia velit aut iusto assumenda voluptatem aspernatur occaecati non. Ut incidunt et vel.','a:1:{i:0;s:38:\"http://www.files./com/Shanel Rodriguez\";}','a:1:{i:0;s:6:\"uxford\";}','rar','austria',0,2,'phisiq','2016-05-10 15:03:38','2016-05-10 15:03:38'),(86,'Matilda Morissette Jr.','jules-turcotte','Sed est adipisci quia atque. Odit nam vel ex libero. Commodi recusandae qui omnis quidem et facere velit.','a:1:{i:0;s:43:\"http://www.files./com/Dr. Irving Schmitt II\";}','a:1:{i:0;s:3:\"esi\";}','rar','central african republic',0,2,'biologie','2016-05-10 15:03:38','2016-05-10 15:03:38'),(87,'Dr. Noble Wintheiser Jr.','prof-dina-fadel','Dolores est et iure illum rem. Quo voluptas quia veritatis qui itaque rerum reiciendis. Expedita tempora magnam similique odio perferendis vel. Et odio est et veritatis voluptatem adipisci a.','a:1:{i:0;s:42:\"http://www.files./com/Miss Larissa Roberts\";}','a:1:{i:0;s:7:\"harfard\";}','zip','american samoa',0,3,'math','2016-05-10 15:03:38','2016-05-10 15:03:38'),(88,'Maximillia Pfeffer','dr-melvina-windler-jr','Velit dolorem recusandae voluptas consequatur omnis expedita perferendis. Et quis et sapiente quae laboriosam. Expedita delectus corporis molestias saepe. Quia ipsum molestias ea nihil.','a:1:{i:0;s:35:\"http://www.files./com/Darion Gibson\";}','a:1:{i:0;s:3:\"esi\";}','pdf','cyprus',0,3,'phisiq','2016-05-10 15:03:38','2016-05-10 15:03:38'),(89,'Mrs. Emmie Walter DVM','mr-garrison-daugherty','Dolorem consequatur qui minus ut voluptatibus. Eveniet laudantium odit ut velit. Qui iure dolorem provident mollitia tenetur error. Provident blanditiis odit dolorum ut ut impedit perferendis.','a:1:{i:0;s:35:\"http://www.files./com/Sibyl Quigley\";}','a:1:{i:0;s:6:\"biskra\";}','zip','antarctica',0,3,'phisiq','2016-05-10 15:03:38','2016-05-10 15:03:38'),(90,'Prof. Haskell Koch DVM','dr-twila-dach-iii','Ut molestiae fuga minus doloribus id. Dolorum modi consequatur possimus tempora quia cumque aspernatur. Quis ipsam et dolor architecto laborum.','a:1:{i:0;s:37:\"http://www.files./com/Jessica Abshire\";}','a:1:{i:0;s:7:\"harfard\";}','rar','brazil',0,2,'phisiq','2016-05-10 15:03:39','2016-05-10 15:03:39'),(91,'Murphy Wolf DVM','ronaldo-gleason','Saepe aut qui aut aut mollitia reprehenderit. Repudiandae cumque repudiandae alias non. Dignissimos ut minima exercitationem ipsam pariatur.','a:1:{i:0;s:35:\"http://www.files./com/Collin Corwin\";}','a:1:{i:0;s:6:\"uxford\";}','zip','congo, the democratic republic of the',0,3,'phisiq','2016-05-10 15:03:39','2016-05-10 15:03:39'),(92,'Tara Friesen','dahlia-balistreri','Numquam omnis accusamus consequatur rem aut inventore. Et et voluptatem voluptates libero maxime sit.','a:1:{i:0;s:33:\"http://www.files./com/German Kihn\";}','a:1:{i:0;s:7:\"harfard\";}','pdf','cambodia',0,3,'math','2016-05-10 15:03:39','2016-05-10 15:03:39'),(93,'Gavin Metz','marshall-ritchie','Vero beatae numquam in molestiae quam similique et. Unde mollitia ea tempora sed odio deleniti voluptatem. Nihil velit aut doloribus iste ut quo. Quis alias adipisci quo aut dolor est possimus.','a:1:{i:0;s:35:\"http://www.files./com/Shawna Herzog\";}','a:1:{i:0;s:3:\"esi\";}','pdf','cook islands',0,2,'math','2016-05-10 15:03:39','2016-05-10 15:03:39'),(94,'Mr. Arvel Bashirian Jr.','mabelle-ankunding','Delectus natus nobis impedit quo quis repellat eveniet qui. Esse voluptas et repellendus neque voluptas et molestiae architecto.','a:1:{i:0;s:34:\"http://www.files./com/Adele Pouros\";}','a:1:{i:0;s:6:\"biskra\";}','pdf','andorra',0,2,'biologie','2016-05-10 15:03:39','2016-05-10 15:03:39'),(95,'Maci Borer','jordyn-green','Ut ut possimus qui expedita saepe voluptas repudiandae. Sit cum aspernatur qui.','a:1:{i:0;s:35:\"http://www.files./com/Prof. Sam Fay\";}','a:1:{i:0;s:6:\"aglger\";}','zip','bosnia and herzegowina',0,1,'phisiq','2016-05-10 15:03:39','2016-05-10 15:03:39'),(96,'Taurean Herman','mr-victor-corwin','Quibusdam consequuntur earum et quis accusantium sit. Rerum est quibusdam odit molestiae earum quidem autem. Exercitationem perferendis iste eum qui aut atque magni.','a:1:{i:0;s:42:\"http://www.files./com/Dr. Sabryna Tremblay\";}','a:1:{i:0;s:3:\"esi\";}','rar','antarctica',0,3,'biologie','2016-05-10 15:03:39','2016-05-10 15:03:39'),(97,'Dedric Heidenreich','prof-cora-marquardt-md','Incidunt eligendi non perspiciatis et earum quis. Adipisci eaque aut temporibus dolore. Explicabo at reprehenderit qui eos. Blanditiis illo atque distinctio sit.','a:1:{i:0;s:37:\"http://www.files./com/Kelsie Anderson\";}','a:1:{i:0;s:7:\"harfard\";}','pdf','cuba',0,1,'biologie','2016-05-10 15:03:39','2016-05-10 15:03:39'),(98,'Vallie Schultz III','delphia-boyer','Molestias sed sed distinctio. Sed aut neque voluptatem tempore inventore aut quae. In nihil sint et eius voluptas consequuntur corporis.','a:1:{i:0;s:42:\"http://www.files./com/Madeline Waelchi III\";}','a:1:{i:0;s:7:\"harfard\";}','zip','cuba',0,1,'biologie','2016-05-10 15:03:39','2016-05-10 15:03:39'),(99,'Mr. Victor Mosciski V','mrs-pat-conroy-sr','Qui nihil pariatur autem vel deleniti quo. Cum est necessitatibus odio labore corporis. Est harum aperiam dolores optio. Quisquam qui veritatis assumenda dolore enim dignissimos saepe.','a:1:{i:0;s:38:\"http://www.files./com/Adelia Aufderhar\";}','a:1:{i:0;s:6:\"biskra\";}','pdf','belarus',0,3,'phisiq','2016-05-10 15:03:39','2016-05-10 15:03:39'),(100,'Bonita Willms IV','jamel-vonrueden','Deleniti ut blanditiis consequatur ex suscipit. Omnis rerum commodi voluptas nulla est laboriosam architecto. Nulla libero alias ut aspernatur earum voluptatibus aperiam exercitationem.','a:1:{i:0;s:40:\"http://www.files./com/Kristin Pfeffer IV\";}','a:1:{i:0;s:6:\"aglger\";}','zip','belgium',0,2,'phisiq','2016-05-10 15:03:39','2016-05-10 15:03:39');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table',1),('2015_11_08_110613_create_users_table',1),('2015_12_10_104600_create_files_table',1),('2016_01_13_170907_create_roles_table',1),('2016_01_13_171327_create_role_user_table',1),('2016_02_28_040138_create_permissions_table',1),('2016_02_28_040403_create_permission_role_table',1),('2016_02_29_145923_create_profiles_table',1),('2016_05_10_152845_create_pages_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `country` enum('afghanistan','albania','algeria','american samoa','andorra','angola','anguilla','antarctica','antigua and barbuda','argentina','armenia','aruba','australia','austria','azerbaijan','bahamas','bahrain','bangladesh','barbados','belarus','belgium','belize','benin','bermuda','bhutan','bolivia','bosnia and herzegowina','botswana','bouvet island','brazil','british indian ocean territory','brunei darussalam','bulgaria','burkina faso','burundi','cambodia','cameroon','canada','cabo verde','cayman islands','central african republic','chad','chile','china','christmas island','cocos islands','colombia','comoros','congo','congo, the democratic republic of the','cook islands','costa rica','cote d&#039;ivoire','croatia','cuba','cyprus','czech republic','denmark','djibouti','dominica','dominican republic','east timor','ecuador','egypt','el salvador','equatorial guinea','eritrea','estonia','ethiopia','falkland islands','faroe islands','fiji','finland','france','french guiana','french polynesia','french southern territories','gabon','gambia','georgia','germany','ghana','gibraltar','greece','greenland','grenada','guadeloupe','guam','guatemala','guinea','guinea-bissau','guyana','haiti','heard and mc donald islands','holy see','honduras','hong kong','hungary','iceland','india','indonesia','iran','iraq','ireland','israel','italy','jamaica','japan','jordan','kazakhstan','kenya','kiribati','korea, democratic people&#039;s republic of','korea, republic of','kuwait','kyrgyzstan','lao, people&#039;s democratic republic','latvia','lebanon','lesotho','liberia','libyan arab jamahiriya','liechtenstein','lithuania','luxembourg','macao','macedonia, the former yugoslav republic of','madagascar','malawi','malaysia','maldives','mali','malta','marshall islands','martinique','mauritania','mauritius','mayotte','mexico','micronesia, federated states of','moldova, republic of','monaco','mongolia','montserrat','morocco','mozambique','myanmar','namibia','nauru','nepal','netherlands','netherlands antilles','new caledonia','new zealand','nicaragua','niger','nigeria','niue','norfolk island','northern mariana islands','norway','oman','pakistan','palau','panama','papua new guinea','paraguay','peru','philippines','pitcairn','poland','portugal','puerto rico','qatar','reunion','romania','russian federation','rwanda','saint kitts and nevis','saint lucia','saint vincent and the grenadines','samoa','san marino','sao tome and principe','saudi arabia','senegal','seychelles','sierra leone','singapore','slovakia','slovenia','solomon islands','somalia','south africa','south georgia and the south sandwich islands','spain','sri lanka','st. helena','st. pierre and miquelon','sudan','suriname','svalbard and jan mayen islands','swaziland','sweden','switzerland','syrian arab republic','taiwan, province of china','tajikistan','tanzania, united republic of','thailand','togo','tokelau','tonga','trinidad and tobago','tunisia','turkey','turkmenistan','turks and caicos islands','tuvalu','uganda','ukraine','united arab emirates','united kingdom','united states','united states minor outlying islands','uruguay','uzbekistan','vanuatu','venezuela','vietnam','virgin islands','virgin islands','wallis and futuna islands','western sahara','yemen','serbia','zambia','zimbabwe') COLLATE utf8_unicode_ci NOT NULL,
  `sex` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profiles_user_id_unique` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,1,'united states','male','1991-01-01','2016-05-10 15:03:34','2016-05-10 15:03:34'),(2,2,'algeria','female','1991-05-01','2016-05-10 15:03:34','2016-05-10 15:03:34');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_user_role_id_user_id_unique` (`role_id`,`user_id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,2,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','2016-05-10 15:03:34','2016-05-10 15:03:34'),(2,'owner','2016-05-10 15:03:34','2016-05-10 15:03:34'),(3,'developper','2016-05-10 15:03:34','2016-05-10 15:03:34'),(4,'designer','2016-05-10 15:03:34','2016-05-10 15:03:34');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user','user@gmail.com','$2y$10$pptnvaWXGaNIgqNyo0CbGegBwW3ws5c5eidaKF4uhjwShZyu2oTp6',NULL,'2016-05-10 15:03:34','2016-05-10 15:03:34'),(2,'admin','admin@gmail.com','$2y$10$BAWsbyC4BYCP9B3UP96k.u8w4r0ZayT8hGYaqXsnKUw8N1Pg38vLi',NULL,'2016-05-10 15:03:34','2016-05-10 15:03:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-10 17:03:39
