-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: digitalmenu.be.mysql:3306
-- Generation Time: Oct 17, 2017 at 10:25 AM
-- Server version: 10.1.28-MariaDB-1~xenial
-- PHP Version: 5.4.45-0+deb7u11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `digitalmenu_be_restomenu3`
--
CREATE DATABASE `digitalmenu_be_restomenu3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `digitalmenu_be_restomenu3`;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(2) NOT NULL DEFAULT '0',
  `restaurants_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `status`, `restaurants_id`) VALUES
(1, 1, '1030,1032,1035,1036,1037,1038,1039,1040,1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_ml`
--

CREATE TABLE IF NOT EXISTS `advertisement_ml` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `lang` char(3) CHARACTER SET utf8 NOT NULL,
  `body` text CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `advertisement_ml`
--

INSERT INTO `advertisement_ml` (`uid`, `id`, `lang`, `body`, `title`) VALUES
(1, 1, 'en', '<p><img src="http://192.168.0.100:50405/uploads/advertisements/adventsment_1_img.jpg" alt="" width="" height="" /></p>\r\n<h1>HEEET U UW KEUZE KUNNEN MAKEN? KOM DAN LANGS BIJ MINI OTTEVAERE.</h1>\r\n<p>&nbsp;</p>\r\n<h2>OTTEVAERE&amp;nbsp</h2>\r\n<p>Leuvensesteenweg 135 - 3191 boortmeerbeek(Hever)</p>\r\n<p>Tel:015511379 - <a href="mailto:info@ottevaere.net.mini.be">info@ottevaere.net.mini.be</a></p>\r\n<p><a href="http://www.ottevaere.mini.be">www.ottevaere.mini.be</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<hr />\r\n<h2>MINI gamma: CO<sub>2</sub> 89 - 175g/km 3,4 - 7/51/100km</h2>\r\n<p>Milieu-informatie: mini.be&nbsp;&diams;Geef Voorange AAN VEILIGHEID.</p>\r\n<p>MINI Belux - BMW Belgium Luxenburg NV/SA - BE 04135338663 - mini.be</p>\r\n<p>&nbsp;</p>', 'Advertisement'),
(2, 1, 'be', '<p><img src="http://192.168.0.100:50405/uploads/advertisements/adventsment_1_img.jpg" alt="" width="" height="" /></p>\r\n<h1>HEEET U UW KEUZE KUNNEN MAKEN? KOM DAN LANGS BIJ MINI OTTEVAERE.</h1>\r\n<p>&nbsp;</p>\r\n<h2>OTTEVAERE&amp;nbsp</h2>\r\n<p>Leuvensesteenweg 135 - 3191 boortmeerbeek(Hever)</p>\r\n<p>Tel:015511379 -&nbsp;<a href="mailto:info@ottevaere.net.mini.be">info@ottevaere.net.mini.be</a></p>\r\n<p><a href="http://www.ottevaere.mini.be">www.ottevaere.mini.be</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<hr />\r\n<h2>MINI gamma: CO<sub>2</sub>&nbsp;89 - 175g/km 3,4 - 7/51/100km</h2>\r\n<p>Milieu-informatie: mini.be&nbsp;&diams;Geef Voorange AAN VEILIGHEID.</p>\r\n<p>MINI Belux - BMW Belgium Luxenburg NV/SA - BE 04135338663 - mini.be</p>\r\n<p>&nbsp;</p>', 'Advertisement');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `banner_img` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `status`, `banner_img`) VALUES
(1, 1, NULL),
(2, 1, '3c09cjf32p2u7shaz1v49rkcn.jpg'),
(3, 1, '3gkri3g566j13u9q0ubuuvlee.jpg'),
(4, 1, '0bd169f5qyhsyhx9rqhck5f5e.jpg'),
(5, 1, 'q77ej3uvq0axzoa4fq3wt6h22.jpg'),
(7, 1, 't3o7tsjtbvdmyv6v4gd7l5gmh.jpg'),
(6, 1, '3ebd8t2hsf1xregugix4tyzsc.jpg'),
(31, 1, 'ss3zycd03k1pmi7je8bfu14vq.jpg'),
(32, 1, NULL),
(33, 1, NULL),
(34, 1, NULL),
(35, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `content_ml`
--

CREATE TABLE IF NOT EXISTS `content_ml` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(11) unsigned NOT NULL,
  `lang` varchar(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text,
  `searchfield` text,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `id_lng` (`id`,`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=365 ;

--
-- Dumping data for table `content_ml`
--

INSERT INTO `content_ml` (`uid`, `id`, `lang`, `title`, `text`, `searchfield`) VALUES
(315, 1, 'am', 'Home', '<h1 class="title page-info__title underline">our services</h1>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 'Home our servicesLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(314, 1, 'en', 'Home', '<h1 class="title page-info__title underline">our services</h1>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 'Home our servicesLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(316, 1, 'ru', 'Home', '<h1 class="title page-info__title underline">our services</h1>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 'Home our servicesLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(308, 2, 'en', 'About us', '<div class="about">\r\n<article>\r\n<p>&hellip;Composers and poets are born, not made. And so working with the patients requires from the specialists innate human qualities. With the education you can get a profession, improve your qualifications, but it&rsquo;s impossible to learn to give out spiritual warmth. It is given by God. On this basis, the motto of our center is &ldquo;Humanity and professionalism&rdquo;.</p>\r\n<h3 class="title-cursive">The main activity areas of the Center are:</h3>\r\n<ul class="about-list about-list--column about-list--dotted">\r\n<li class="about-list__item">rehabilitation treatment after spinal cord injury,</li>\r\n<li class="about-list__item">treatment of diseases of the spine and spinal cord,</li>\r\n<li class="about-list__item">rehabilitation after spinal operations,</li>\r\n<li class="about-list__item">general and post-traumatic rehabilitation,</li>\r\n<li class="about-list__item">sanatorium-and-spa treatment.</li>\r\n</ul>\r\n</article>\r\n<h2 class="about__title">There are the following departments in the center:</h2>\r\n<article class="article underline">\r\n<h3 class="article__title">Spinal Rehabilitation Department</h3>\r\n<p>Intended for the treatment and rehabilitation of the patients with spinal trauma and spinal cord injury.</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">General Rehabilitation Department</h3>\r\n<p>Intended for the general recovery and rehabilitation treatment of the patients with traumas or diseases of the spine, for the rehabilitation after the cerebrovascular accident (post-stroke conditions).</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">Outpatient Department</h3>\r\n<p>Clinical and biochemical laboratory, sonography, X-rays and other specialized cabinets.</p>\r\n<h3 class="title-cursive">The main activity areas of the Center are:</h3>\r\n<ul class="about-list about-list--column about-list--dotted about-list--wide">\r\n<li class="about-list__item">Physiotherapy procedures,</li>\r\n<li class="about-list__item">Medical and classical massage,</li>\r\n<li class="about-list__item">Hydropath, hydro massage,</li>\r\n<li class="about-list__item">Mud therapy,</li>\r\n<li class="about-list__item">Kinesotherapy,</li>\r\n<li class="about-list__item">Electrotherapy,</li>\r\n<li class="about-list__item">Acupuncture,</li>\r\n<li class="about-list__item">Inhalation therapy,</li>\r\n<li class="about-list__item">SCENAR,</li>\r\n<li class="about-list__item">Intestinal procedures,</li>\r\n<li class="about-list__item">Stressologist&rsquo;s room.</li>\r\n</ul>\r\n<p>Each patient with spinal disease or spinal cord injury is individually treated by a doctor, nurse, rehabilitation therapist, psychologist and sport trainer. IRC staff training is conducted by foreign specialists both in the center and in similar centers abroad. For on-site training departments are open in the center for the preparation of rehabilitation therapists and nurses.</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">When will help you the center &ldquo;Gratsia&rdquo;?</h3>\r\n<ul class="about-list about-list--column">\r\n<li class="about-list__item"><a class="about-list__link" href="#">Spinal cord injury</a></li>\r\n<li class="about-list__item"><a class="about-list__link" href="#">Brain injury</a></li>\r\n<li class="about-list__item"><a class="about-list__link" href="#">Diseases of the musculoskeletal system</a></li>\r\n<li class="about-list__item"><a class="about-list__link" href="#">Post-stroke condition</a></li>\r\n</ul>\r\n<p>Day and night our patients are guaranteed qualified and delicate care. All rooms are equipped with a call button on duty nurses who are on duty round the clock and they are ready to provide the necessary assistance, call a doctor or a maid, to answer all your questions. Patients are always reminded about the time of the drug intake and assigned procedures.</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">Why you should choose the center &ldquo;Gratsia&rdquo;?</h3>\r\n<ul class="about-list about-list--dotted">\r\n<li class="about-list__item">We possess an effective method of moving recovery.</li>\r\n<li class="about-list__item">Our team consists of highly qualified doctors and nurses.</li>\r\n<li class="about-list__item">We guarantee the privacy of personal medical information of our patients.</li>\r\n</ul>\r\n</article>\r\n</div>', 'About us &hellip;Composers and poets are born, not made. And so working with the patients requires from the specialists innate human qualities. With the education you can get a profession, improve your qualifications, but it&rsquo;s impossible to learn to give out spiritual warmth. It is given by God. On this basis, the motto of our center is &ldquo;Humanity and professionalism&rdquo;.The main activity areas of the Center are:rehabilitation treatment after spinal cord injury,treatment of diseases of the spine and spinal cord,rehabilitation after spinal operations,general and post-traumatic rehabilitation,sanatorium-and-spa treatment.There are the following departments in the center:Spinal Rehabilitation DepartmentIntended for the treatment and rehabilitation of the patients with spinal trauma and spinal cord injury.General Rehabilitation DepartmentIntended for the general recovery and rehabilitation treatment of the patients with traumas or diseases of the spine, for the rehabilitation after the cerebrovascular accident (post-stroke conditions).Outpatient DepartmentClinical and biochemical laboratory, sonography, X-rays and other specialized cabinets.The main activity areas of the Center are:Physiotherapy procedures,Medical and classical massage,Hydropath, hydro massage,Mud therapy,Kinesotherapy,Electrotherapy,Acupuncture,Inhalation therapy,SCENAR,Intestinal procedures,Stressologist&rsquo;s room.Each patient with spinal disease or spinal cord injury is individually treated by a doctor, nurse, rehabilitation therapist, psychologist and sport trainer. IRC staff training is conducted by foreign specialists both in the center and in similar centers abroad. For on-site training departments are open in the center for the preparation of rehabilitation therapists and nurses.When will help you the center &ldquo;Gratsia&rdquo;?Spinal cord injuryBrain injuryDiseases of the musculoskeletal systemPost-stroke conditionDay and night our patients are guaranteed qualified and delicate care. All rooms are equipped with a call button on duty nurses who are on duty round the clock and they are ready to provide the necessary assistance, call a doctor or a maid, to answer all your questions. Patients are always reminded about the time of the drug intake and assigned procedures.Why you should choose the center &ldquo;Gratsia&rdquo;?We possess an effective method of moving recovery.Our team consists of highly qualified doctors and nurses.We guarantee the privacy of personal medical information of our patients.'),
(309, 2, 'am', 'About us', '<div class="about">\r\n<article>\r\n<p>&hellip;Composers and poets are born, not made. And so working with the patients requires from the specialists innate human qualities. With the education you can get a profession, improve your qualifications, but it&rsquo;s impossible to learn to give out spiritual warmth. It is given by God. On this basis, the motto of our center is &ldquo;Humanity and professionalism&rdquo;.</p>\r\n<h3 class="title-cursive">The main activity areas of the Center are:</h3>\r\n<ul class="about-list about-list--column about-list--dotted">\r\n<li class="about-list__item">rehabilitation treatment after spinal cord injury,</li>\r\n<li class="about-list__item">treatment of diseases of the spine and spinal cord,</li>\r\n<li class="about-list__item">rehabilitation after spinal operations,</li>\r\n<li class="about-list__item">general and post-traumatic rehabilitation,</li>\r\n<li class="about-list__item">sanatorium-and-spa treatment.</li>\r\n</ul>\r\n</article>\r\n<h2 class="about__title">There are the following departments in the center:</h2>\r\n<article class="article underline">\r\n<h3 class="article__title">Spinal Rehabilitation Department</h3>\r\n<p>Intended for the treatment and rehabilitation of the patients with spinal trauma and spinal cord injury.</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">General Rehabilitation Department</h3>\r\n<p>Intended for the general recovery and rehabilitation treatment of the patients with traumas or diseases of the spine, for the rehabilitation after the cerebrovascular accident (post-stroke conditions).</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">Outpatient Department</h3>\r\n<p>Clinical and biochemical laboratory, sonography, X-rays and other specialized cabinets.</p>\r\n<h3 class="title-cursive">The main activity areas of the Center are:</h3>\r\n<ul class="about-list about-list--column about-list--dotted about-list--wide">\r\n<li class="about-list__item">Physiotherapy procedures,</li>\r\n<li class="about-list__item">Medical and classical massage,</li>\r\n<li class="about-list__item">Hydropath, hydro massage,</li>\r\n<li class="about-list__item">Mud therapy,</li>\r\n<li class="about-list__item">Kinesotherapy,</li>\r\n<li class="about-list__item">Electrotherapy,</li>\r\n<li class="about-list__item">Acupuncture,</li>\r\n<li class="about-list__item">Inhalation therapy,</li>\r\n<li class="about-list__item">SCENAR,</li>\r\n<li class="about-list__item">Intestinal procedures,</li>\r\n<li class="about-list__item">Stressologist&rsquo;s room.</li>\r\n</ul>\r\n<p>Each patient with spinal disease or spinal cord injury is individually treated by a doctor, nurse, rehabilitation therapist, psychologist and sport trainer. IRC staff training is conducted by foreign specialists both in the center and in similar centers abroad. For on-site training departments are open in the center for the preparation of rehabilitation therapists and nurses.</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">When will help you the center &ldquo;Gratsia&rdquo;?</h3>\r\n<ul class="about-list about-list--column">\r\n<li class="about-list__item"><a class="about-list__link" href="#">Spinal cord injury</a></li>\r\n<li class="about-list__item"><a class="about-list__link" href="#">Brain injury</a></li>\r\n<li class="about-list__item"><a class="about-list__link" href="#">Diseases of the musculoskeletal system</a></li>\r\n<li class="about-list__item"><a class="about-list__link" href="#">Post-stroke condition</a></li>\r\n</ul>\r\n<p>Day and night our patients are guaranteed qualified and delicate care. All rooms are equipped with a call button on duty nurses who are on duty round the clock and they are ready to provide the necessary assistance, call a doctor or a maid, to answer all your questions. Patients are always reminded about the time of the drug intake and assigned procedures.</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">Why you should choose the center &ldquo;Gratsia&rdquo;?</h3>\r\n<ul class="about-list about-list--dotted">\r\n<li class="about-list__item">We possess an effective method of moving recovery.</li>\r\n<li class="about-list__item">Our team consists of highly qualified doctors and nurses.</li>\r\n<li class="about-list__item">We guarantee the privacy of personal medical information of our patients.</li>\r\n</ul>\r\n</article>\r\n</div>', 'About us &hellip;Composers and poets are born, not made. And so working with the patients requires from the specialists innate human qualities. With the education you can get a profession, improve your qualifications, but it&rsquo;s impossible to learn to give out spiritual warmth. It is given by God. On this basis, the motto of our center is &ldquo;Humanity and professionalism&rdquo;.The main activity areas of the Center are:rehabilitation treatment after spinal cord injury,treatment of diseases of the spine and spinal cord,rehabilitation after spinal operations,general and post-traumatic rehabilitation,sanatorium-and-spa treatment.There are the following departments in the center:Spinal Rehabilitation DepartmentIntended for the treatment and rehabilitation of the patients with spinal trauma and spinal cord injury.General Rehabilitation DepartmentIntended for the general recovery and rehabilitation treatment of the patients with traumas or diseases of the spine, for the rehabilitation after the cerebrovascular accident (post-stroke conditions).Outpatient DepartmentClinical and biochemical laboratory, sonography, X-rays and other specialized cabinets.The main activity areas of the Center are:Physiotherapy procedures,Medical and classical massage,Hydropath, hydro massage,Mud therapy,Kinesotherapy,Electrotherapy,Acupuncture,Inhalation therapy,SCENAR,Intestinal procedures,Stressologist&rsquo;s room.Each patient with spinal disease or spinal cord injury is individually treated by a doctor, nurse, rehabilitation therapist, psychologist and sport trainer. IRC staff training is conducted by foreign specialists both in the center and in similar centers abroad. For on-site training departments are open in the center for the preparation of rehabilitation therapists and nurses.When will help you the center &ldquo;Gratsia&rdquo;?Spinal cord injuryBrain injuryDiseases of the musculoskeletal systemPost-stroke conditionDay and night our patients are guaranteed qualified and delicate care. All rooms are equipped with a call button on duty nurses who are on duty round the clock and they are ready to provide the necessary assistance, call a doctor or a maid, to answer all your questions. Patients are always reminded about the time of the drug intake and assigned procedures.Why you should choose the center &ldquo;Gratsia&rdquo;?We possess an effective method of moving recovery.Our team consists of highly qualified doctors and nurses.We guarantee the privacy of personal medical information of our patients.'),
(310, 2, 'ru', 'About us', '<div class="about">\r\n<article>\r\n<p>&hellip;Composers and poets are born, not made. And so working with the patients requires from the specialists innate human qualities. With the education you can get a profession, improve your qualifications, but it&rsquo;s impossible to learn to give out spiritual warmth. It is given by God. On this basis, the motto of our center is &ldquo;Humanity and professionalism&rdquo;.</p>\r\n<h3 class="title-cursive">The main activity areas of the Center are:</h3>\r\n<ul class="about-list about-list--column about-list--dotted">\r\n<li class="about-list__item">rehabilitation treatment after spinal cord injury,</li>\r\n<li class="about-list__item">treatment of diseases of the spine and spinal cord,</li>\r\n<li class="about-list__item">rehabilitation after spinal operations,</li>\r\n<li class="about-list__item">general and post-traumatic rehabilitation,</li>\r\n<li class="about-list__item">sanatorium-and-spa treatment.</li>\r\n</ul>\r\n</article>\r\n<h2 class="about__title">There are the following departments in the center:</h2>\r\n<article class="article underline">\r\n<h3 class="article__title">Spinal Rehabilitation Department</h3>\r\n<p>Intended for the treatment and rehabilitation of the patients with spinal trauma and spinal cord injury.</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">General Rehabilitation Department</h3>\r\n<p>Intended for the general recovery and rehabilitation treatment of the patients with traumas or diseases of the spine, for the rehabilitation after the cerebrovascular accident (post-stroke conditions).</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">Outpatient Department</h3>\r\n<p>Clinical and biochemical laboratory, sonography, X-rays and other specialized cabinets.</p>\r\n<h3 class="title-cursive">The main activity areas of the Center are:</h3>\r\n<ul class="about-list about-list--column about-list--dotted about-list--wide">\r\n<li class="about-list__item">Physiotherapy procedures,</li>\r\n<li class="about-list__item">Medical and classical massage,</li>\r\n<li class="about-list__item">Hydropath, hydro massage,</li>\r\n<li class="about-list__item">Mud therapy,</li>\r\n<li class="about-list__item">Kinesotherapy,</li>\r\n<li class="about-list__item">Electrotherapy,</li>\r\n<li class="about-list__item">Acupuncture,</li>\r\n<li class="about-list__item">Inhalation therapy,</li>\r\n<li class="about-list__item">SCENAR,</li>\r\n<li class="about-list__item">Intestinal procedures,</li>\r\n<li class="about-list__item">Stressologist&rsquo;s room.</li>\r\n</ul>\r\n<p>Each patient with spinal disease or spinal cord injury is individually treated by a doctor, nurse, rehabilitation therapist, psychologist and sport trainer. IRC staff training is conducted by foreign specialists both in the center and in similar centers abroad. For on-site training departments are open in the center for the preparation of rehabilitation therapists and nurses.</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">When will help you the center &ldquo;Gratsia&rdquo;?</h3>\r\n<ul class="about-list about-list--column">\r\n<li class="about-list__item"><a class="about-list__link" href="#">Spinal cord injury</a></li>\r\n<li class="about-list__item"><a class="about-list__link" href="#">Brain injury</a></li>\r\n<li class="about-list__item"><a class="about-list__link" href="#">Diseases of the musculoskeletal system</a></li>\r\n<li class="about-list__item"><a class="about-list__link" href="#">Post-stroke condition</a></li>\r\n</ul>\r\n<p>Day and night our patients are guaranteed qualified and delicate care. All rooms are equipped with a call button on duty nurses who are on duty round the clock and they are ready to provide the necessary assistance, call a doctor or a maid, to answer all your questions. Patients are always reminded about the time of the drug intake and assigned procedures.</p>\r\n</article>\r\n<article class="article underline">\r\n<h3 class="article__title">Why you should choose the center &ldquo;Gratsia&rdquo;?</h3>\r\n<ul class="about-list about-list--dotted">\r\n<li class="about-list__item">We possess an effective method of moving recovery.</li>\r\n<li class="about-list__item">Our team consists of highly qualified doctors and nurses.</li>\r\n<li class="about-list__item">We guarantee the privacy of personal medical information of our patients.</li>\r\n</ul>\r\n</article>\r\n</div>', 'About us &hellip;Composers and poets are born, not made. And so working with the patients requires from the specialists innate human qualities. With the education you can get a profession, improve your qualifications, but it&rsquo;s impossible to learn to give out spiritual warmth. It is given by God. On this basis, the motto of our center is &ldquo;Humanity and professionalism&rdquo;.The main activity areas of the Center are:rehabilitation treatment after spinal cord injury,treatment of diseases of the spine and spinal cord,rehabilitation after spinal operations,general and post-traumatic rehabilitation,sanatorium-and-spa treatment.There are the following departments in the center:Spinal Rehabilitation DepartmentIntended for the treatment and rehabilitation of the patients with spinal trauma and spinal cord injury.General Rehabilitation DepartmentIntended for the general recovery and rehabilitation treatment of the patients with traumas or diseases of the spine, for the rehabilitation after the cerebrovascular accident (post-stroke conditions).Outpatient DepartmentClinical and biochemical laboratory, sonography, X-rays and other specialized cabinets.The main activity areas of the Center are:Physiotherapy procedures,Medical and classical massage,Hydropath, hydro massage,Mud therapy,Kinesotherapy,Electrotherapy,Acupuncture,Inhalation therapy,SCENAR,Intestinal procedures,Stressologist&rsquo;s room.Each patient with spinal disease or spinal cord injury is individually treated by a doctor, nurse, rehabilitation therapist, psychologist and sport trainer. IRC staff training is conducted by foreign specialists both in the center and in similar centers abroad. For on-site training departments are open in the center for the preparation of rehabilitation therapists and nurses.When will help you the center &ldquo;Gratsia&rdquo;?Spinal cord injuryBrain injuryDiseases of the musculoskeletal systemPost-stroke conditionDay and night our patients are guaranteed qualified and delicate care. All rooms are equipped with a call button on duty nurses who are on duty round the clock and they are ready to provide the necessary assistance, call a doctor or a maid, to answer all your questions. Patients are always reminded about the time of the drug intake and assigned procedures.Why you should choose the center &ldquo;Gratsia&rdquo;?We possess an effective method of moving recovery.Our team consists of highly qualified doctors and nurses.We guarantee the privacy of personal medical information of our patients.'),
(311, 3, 'en', 'Treatment of the diseases', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>', 'Treatment of the diseases Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,'),
(312, 3, 'am', 'Products', '', 'Products '),
(313, 3, 'ru', 'Products', '', 'Products '),
(317, 4, 'en', 'Contacts', '', 'Contacts '),
(318, 4, 'am', 'Contacts', '', 'Contacts '),
(328, 6, 'ru', 'Prices', '<table id="tablepress-3" class="tablepress tablepress-id-3">\r\n<thead>\r\n<tr class="row-1 odd"><th class="column-1">&nbsp;</th><th class="column-2" colspan="4"><strong style="color: black;">Для граждан Грузии и стран Евразийского Союза</strong></th><th class="column-6">&nbsp;</th></tr>\r\n</thead>\r\n<tbody class="row-hover">\r\n<tr class="row-2 even">\r\n<td class="column-1">&nbsp;</td>\r\n<td class="column-2"><strong style="color: black;">драм</strong></td>\r\n<td class="column-3"><strong style="color: black;">доллар</strong></td>\r\n<td class="column-4"><strong style="color: black;">евро</strong></td>\r\n<td class="column-5"><strong style="color: black;">рубль</strong></td>\r\n<td class="column-6">&nbsp;</td>\r\n</tr>\r\n<tr class="row-3 odd">\r\n<td class="column-1"><strong style="color: red;">Трехместный номер</strong><br /> <br /> Для одного человека <br /> Трехразовое питание <br /> Количество процедур*: 4 <br /> <strong style="color: black;">Итого</strong></td>\r\n<td class="column-2"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">20.000</strong></td>\r\n<td class="column-3"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">42</strong></td>\r\n<td class="column-4"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">39</strong></td>\r\n<td class="column-5"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">2.550</strong></td>\r\n<td class="column-6">&nbsp;</td>\r\n</tr>\r\n<tr class="row-4 even">\r\n<td class="column-1"><strong style="color: red;">Двухместный Номер</strong><br /> <br /> Для одного человека <br /> Трехразовое питание <br /> Количество процедур*: 4<br /> <strong style="color: black;">Итого</strong></td>\r\n<td class="column-2"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">26.000</strong></td>\r\n<td class="column-3"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">56</strong></td>\r\n<td class="column-4"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">51</strong></td>\r\n<td class="column-5"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">3.400</strong></td>\r\n<td class="column-6">&nbsp;</td>\r\n</tr>\r\n<tr class="row-5 odd">\r\n<td class="column-1"><strong style="color: red;">Одноместный Номер</strong><br /> <br /> Для одного человека <br /> Трехразовое питание <br /> Количество процедур*: 4<br /> <strong style="color: black;">Итого</strong></td>\r\n<td class="column-2"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">34.000</strong></td>\r\n<td class="column-3"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">71</strong></td>\r\n<td class="column-4"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">66</strong></td>\r\n<td class="column-5"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">4.400</strong></td>\r\n<td class="column-6">&nbsp;</td>\r\n</tr>\r\n<tr class="row-6 even">\r\n<td class="column-1" colspan="5"><strong style="color: black;">Цены за сутки.<br /> Стоимость может меняться в зависимости от курса валют.</strong></td>\r\n<td class="column-6">&nbsp;</td>\r\n</tr>\r\n<tr class="row-7 odd">\r\n<td class="column-1">&nbsp;</td>\r\n<td class="column-2">&nbsp;</td>\r\n<td class="column-3">&nbsp;</td>\r\n<td class="column-4">&nbsp;</td>\r\n<td class="column-5">&nbsp;</td>\r\n<td class="column-6">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'Prices &nbsp;Для граждан Грузии и стран Евразийского Союза&nbsp;&nbsp;драмдоллареврорубль&nbsp;Трехместный номер Для одного человека Трехразовое питание Количество процедур*: 4 Итого   20.000   42   39   2.550&nbsp;Двухместный Номер Для одного человека Трехразовое питание Количество процедур*: 4 Итого   26.000   56   51   3.400&nbsp;Одноместный Номер Для одного человека Трехразовое питание Количество процедур*: 4 Итого   34.000   71   66   4.400&nbsp;Цены за сутки. Стоимость может меняться в зависимости от курса валют.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'),
(319, 4, 'ru', 'Contacts', '', 'Contacts '),
(335, 5, 'en', 'Gallery', '', 'Gallery '),
(336, 5, 'am', 'Gallery', '', 'Gallery '),
(337, 5, 'ru', 'Gallery', '', 'Gallery '),
(327, 6, 'am', 'Prices', '<table id="tablepress-8" class="tablepress tablepress-id-8">\r\n<thead>\r\n<tr class="row-1 odd"><th class="column-1">&nbsp;</th><th class="column-2" colspan="4"><strong style="color: black;">Վրաստանի և Եվրասիական Միության անդամ երկրների քաղաքացիների համար</strong></th></tr>\r\n</thead>\r\n<tbody class="row-hover">\r\n<tr class="row-2 even">\r\n<td class="column-1">&nbsp;</td>\r\n<td class="column-2"><strong>դրամ</strong></td>\r\n<td class="column-3"><strong>դոլար</strong></td>\r\n<td class="column-4"><strong>Եվրո</strong></td>\r\n<td class="column-5"><strong>ռուբլի</strong></td>\r\n</tr>\r\n<tr class="row-3 odd">\r\n<td class="column-1"><strong style="color: red;">Երեքտեղանոց համար</strong><br /> <br /> Մեկ անձի համար<br /> Երեքանգամյա սնունդ<br /> Պրոցեդուրաների քանակ*: 4<br /> <strong style="color: black;">Ընդհանուր</strong></td>\r\n<td class="column-2"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">20.000&lt;b&lt; td=""&gt;</strong></td>\r\n<td class="column-3"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">42</strong></td>\r\n<td class="column-4"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">39</strong></td>\r\n<td class="column-5"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">2.550</strong></td>\r\n</tr>\r\n<tr class="row-4 even">\r\n<td class="column-1"><strong style="color: red;">Երկտեղանոց համար</strong><br /> <br /> Մեկ անձի համար<br /> Երեքանգամյա սնունդ<br /> Պրոցեդուրաների քանակ*: 4<br /> <strong style="color: black;">Ընդհանուր</strong></td>\r\n<td class="column-2"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">26.000</strong></td>\r\n<td class="column-3"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">56</strong></td>\r\n<td class="column-4"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">51</strong></td>\r\n<td class="column-5"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">3.400</strong></td>\r\n</tr>\r\n<tr class="row-5 odd">\r\n<td class="column-1"><strong style="color: red;">Մեկտեղանոց համար </strong><br /> <br /> Մեկ անձի համար<br /> Երեքանգամյա սնունդ<br /> Պրոցեդուրաների քանակ*: 4<br /> <strong style="color: black;">Ընդհանուր</strong></td>\r\n<td class="column-2"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">34.000</strong></td>\r\n<td class="column-3"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">71</strong></td>\r\n<td class="column-4"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">66</strong></td>\r\n<td class="column-5"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">4.400</strong></td>\r\n</tr>\r\n<tr class="row-6 even">\r\n<td class="column-1" colspan="5"><strong style="color: black;">Գները մեկ օրվա համար:<br /> Կախված փոխարժեքից գները կարող են փոփոխվել: </strong></td>\r\n</tr>\r\n<tr class="row-7 odd">\r\n<td class="column-1">&nbsp;</td>\r\n<td class="column-2">&nbsp;</td>\r\n<td class="column-3">&nbsp;</td>\r\n<td class="column-4">&nbsp;</td>\r\n<td class="column-5">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'Prices &nbsp;Վրաստանի և Եվրասիական Միության անդամ երկրների քաղաքացիների համար&nbsp;դրամդոլարԵվրոռուբլիԵրեքտեղանոց համար Մեկ անձի համար Երեքանգամյա սնունդ Պրոցեդուրաների քանակ*: 4 Ընդհանուր   20.000&lt;b&lt; td=""&gt;   42   39   2.550Երկտեղանոց համար Մեկ անձի համար Երեքանգամյա սնունդ Պրոցեդուրաների քանակ*: 4 Ընդհանուր   26.000   56   51   3.400Մեկտեղանոց համար  Մեկ անձի համար Երեքանգամյա սնունդ Պրոցեդուրաների քանակ*: 4 Ընդհանուր   34.000   71   66   4.400Գները մեկ օրվա համար: Կախված փոխարժեքից գները կարող են փոփոխվել: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'),
(326, 6, 'en', 'Prices', '<table id="tablepress-7" class="tablepress tablepress-id-7">\r\n<thead>\r\n<tr class="row-1 odd"><th class="column-1">&nbsp;</th><th class="column-2" colspan="4"><strong style="color: black;">For the citizens of Georgia and Eurasian Union countries</strong></th></tr>\r\n</thead>\r\n<tbody class="row-hover">\r\n<tr class="row-2 even">\r\n<td class="column-1">&nbsp;</td>\r\n<td class="column-2"><strong>AMD</strong></td>\r\n<td class="column-3"><strong>USD</strong></td>\r\n<td class="column-4"><strong>EUR</strong></td>\r\n<td class="column-5"><strong>RUB</strong></td>\r\n</tr>\r\n<tr class="row-3 odd">\r\n<td class="column-1"><strong style="color: red;">Triple room</strong><br /> <br /> For one person <br /> Nutrition &ndash; three times a day <br /> Number of procedures*: 4 <br /> <strong>Total</strong></td>\r\n<td class="column-2"><br /> <br /> <br /> <br /> <br /> <strong>20.000</strong></td>\r\n<td class="column-3"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">42</strong></td>\r\n<td class="column-4"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">39</strong></td>\r\n<td class="column-5"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">2.550</strong></td>\r\n</tr>\r\n<tr class="row-4 even">\r\n<td class="column-1"><strong style="color: red;">Double room</strong><br /> <br /> For one person <br /> Nutrition &ndash; three times a day <br /> Number of procedures*: 4 <br /> <strong>Total</strong></td>\r\n<td class="column-2"><br /> <br /> <br /> <br /> <br /> <strong>26.000</strong></td>\r\n<td class="column-3"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">56</strong></td>\r\n<td class="column-4"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">51</strong></td>\r\n<td class="column-5"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">3.400</strong></td>\r\n</tr>\r\n<tr class="row-5 odd">\r\n<td class="column-1"><strong style="color: red;">Single room</strong><br /> <br /> For one person <br /> Nutrition &ndash; three times a day <br /> Number of procedures*: 4 <br /> <strong>Total</strong></td>\r\n<td class="column-2"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">34.000</strong></td>\r\n<td class="column-3"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">71</strong></td>\r\n<td class="column-4"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">66</strong></td>\r\n<td class="column-5"><br /> <br /> <br /> <br /> <br /> <strong style="color: black;">4.400</strong></td>\r\n</tr>\r\n<tr class="row-6 even">\r\n<td class="column-1" colspan="5"><strong style="color: black;">Prices for a day.<br /> The cost can vary depending on the exchange rates.</strong></td>\r\n</tr>\r\n<tr class="row-7 odd">\r\n<td class="column-1">&nbsp;</td>\r\n<td class="column-2">&nbsp;</td>\r\n<td class="column-3">&nbsp;</td>\r\n<td class="column-4">&nbsp;</td>\r\n<td class="column-5">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'Prices &nbsp;For the citizens of Georgia and Eurasian Union countries&nbsp;AMDUSDEURRUBTriple room For one person Nutrition &ndash; three times a day Number of procedures*: 4 Total   20.000   42   39   2.550Double room For one person Nutrition &ndash; three times a day Number of procedures*: 4 Total   26.000   56   51   3.400Single room For one person Nutrition &ndash; three times a day Number of procedures*: 4 Total   34.000   71   66   4.400Prices for a day. The cost can vary depending on the exchange rates.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'),
(349, 31, 'en', '', '', ''),
(350, 31, 'be', '', '', ''),
(339, 31, 'am', 'jjjjjjjjjj', '', 'jjjjjjjjjj '),
(340, 31, 'ru', 'jjjjjjjjjj', '<p>jjjjjjjjjjjjjjjj</p>', 'jjjjjjjjjj jjjjjjjjjjjjjjjj'),
(345, 32, 'en', '', '', ''),
(346, 32, 'be', '', '', ''),
(361, 33, 'en', '', '', ''),
(362, 33, 'be', '', '', ''),
(359, 34, 'en', '', '', ''),
(360, 34, 'be', '', '', ''),
(363, 35, 'en', 'asdasd', '<p>asdasd</p>', ''),
(364, 35, 'be', 'ASdasd', '<p>asdasd</p>', '');

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE IF NOT EXISTS `labels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `type` enum('label','content','') DEFAULT 'label',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `key`, `type`) VALUES
(1, 'required_field', 'label'),
(2, 'invalid_email', 'label'),
(3, 'successfully_subscribed', 'label'),
(4, 'your_order', 'label'),
(5, 'plase_write_table_number', 'label'),
(6, 'price', 'label'),
(7, 'table_number', 'label'),
(8, 'call', 'label');

-- --------------------------------------------------------

--
-- Table structure for table `labels_ml`
--

CREATE TABLE IF NOT EXISTS `labels_ml` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(11) unsigned NOT NULL,
  `lang` char(2) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `id` (`id`,`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `labels_ml`
--

INSERT INTO `labels_ml` (`uid`, `id`, `lang`, `text`) VALUES
(1, 1, 'en', 'The field is required'),
(2, 1, 'be', 'The field is required'),
(3, 2, 'en', 'Invalid E-mail'),
(4, 2, 'be', 'Invalid E-mail'),
(5, 3, 'en', 'Successfully subscribed'),
(6, 3, 'be', 'Successfully subscribed'),
(7, 4, 'en', 'Your Order'),
(8, 4, 'be', 'Your Order'),
(9, 5, 'en', 'Plase write table number'),
(10, 5, 'be', 'Plase write table number'),
(11, 6, 'en', 'Price'),
(12, 6, 'be', 'Price'),
(13, 7, 'en', 'Table number'),
(14, 7, 'be', 'Table number'),
(15, 8, 'en', 'Call'),
(16, 8, 'be', 'Call');

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` char(2) NOT NULL,
  `short_name` char(3) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `pos` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id`, `uid`, `short_name`, `title`, `status`, `pos`) VALUES
(1, 'en', 'en', 'English', 1, 1),
(2, 'be', 'be', 'Belgium', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '1',
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `cid` int(11) unsigned DEFAULT '0',
  `pos` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `url` (`url`) USING BTREE,
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=166685 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `section_id`, `show`, `pid`, `cid`, `pos`, `status`, `url`) VALUES
(1001, 1, 1, 1003, 1, 2, 1, '/'),
(1002, 1, 1, 1001, 2, 3, 1, 'about-us'),
(1003, 1, 1, 2, 3, 1, 1, 'treatment-of-the-diseases'),
(1004, 1, 1, 1, 0, 7, 1, 'procedures'),
(1005, 1, 1, 1, 4, 13, 1, 'contacts'),
(1006, 1, 1, 1, 6, 11, 1, 'prices'),
(1007, 1, 1, 1, 0, 9, 1, 'our-rooms'),
(166679, 1, 1, 1, 5, 21, 1, 'photo-gallery'),
(166680, 1, 1, 1, 0, 15, 1, 'scaner'),
(166681, 1, 1, 1, 0, 17, 1, 'inhalation'),
(166682, 1, 1, 1, 0, 19, 1, 'intestinal-procedures'),
(166683, 1, 1, 166679, 30, 22, 1, 'news'),
(166684, 1, 1, 166683, 0, 23, 1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `menu_ml`
--

CREATE TABLE IF NOT EXISTS `menu_ml` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `lang` char(2) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `searchfield` text,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `id_lang` (`id`,`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=688 ;

--
-- Dumping data for table `menu_ml`
--

INSERT INTO `menu_ml` (`uid`, `id`, `lang`, `meta_title`, `meta_desc`, `title`, `searchfield`) VALUES
(682, 1001, 'en', 'Home', 'Home', 'Home', 'Home Home Home'),
(683, 1001, 'am', 'Home', 'Home', 'Home', 'Home Home Home'),
(684, 1001, 'ru', 'Home', 'Home', 'Home', 'Home Home Home'),
(670, 1003, 'en', 'Treatment of the diseases', 'Treatment of the diseases', 'Treatment of the diseases', 'Treatment of the diseases Treatment of the diseases Treatment of the diseases'),
(671, 1003, 'am', 'Treatment of the diseases', 'Treatment of the diseases', 'Treatment of the diseases', 'Treatment of the diseases Treatment of the diseases Treatment of the diseases'),
(672, 1003, 'ru', 'Treatment of the diseases', 'Treatment of the diseases', 'Treatment of the diseases', 'Treatment of the diseases Treatment of the diseases Treatment of the diseases'),
(619, 1004, 'en', 'Procedures', 'Procedures', 'Procedures', 'Procedures Procedures Procedures'),
(628, 1002, 'en', 'About us', 'About us', 'About us', 'About us About us About us'),
(629, 1002, 'am', 'About us', 'About us', 'About us', 'About us About us About us'),
(630, 1002, 'ru', 'About us', 'About us', 'About us', 'About us About us About us'),
(620, 1004, 'am', 'Procedures', 'Procedures', 'Procedures', 'Category 2 Category 2 Category 2'),
(621, 1004, 'ru', 'Procedures', 'Procedures', 'Procedures', 'Category 2 Category 2 Category 2'),
(652, 166680, 'en', 'Scaner', 'Scaner', 'Scaner', 'Scaner Scaner Scaner'),
(653, 166680, 'am', 'Scaner', 'Scaner', 'Scaner', 'Scaner Scaner Scaner'),
(662, 166679, 'am', 'Photo gallery', 'Photo gallery', 'Photo gallery', 'Photo gallery Photo gallery Photo gallery'),
(663, 166679, 'ru', 'Photo gallery', 'Photo gallery', 'Photo gallery', 'Photo gallery Photo gallery Photo gallery'),
(661, 166679, 'en', 'Photo gallery', 'Photo gallery', 'Photo gallery', 'Photo gallery Photo gallery Photo gallery'),
(643, 1005, 'en', 'Contacts', 'Contacts', 'Contacts', 'Contacts Contacts Contacts'),
(644, 1005, 'am', 'Contacts', 'Contacts', 'Contacts', 'Contacts Contacts Contacts'),
(645, 1005, 'ru', 'Contacts', 'Contacts', 'Contacts', 'Contacts Contacts Contacts'),
(664, 1006, 'en', 'Prices', 'Prices', 'Prices', 'Prices Prices Prices'),
(665, 1006, 'am', 'Prices', 'Prices', 'Prices', 'Prices Prices Prices'),
(666, 1006, 'ru', 'Prices', 'Prices', 'Prices', 'Prices Prices Prices'),
(640, 1007, 'en', 'Rooms', 'Rooms', 'Rooms', 'Rooms Rooms Rooms'),
(641, 1007, 'am', 'Rooms', 'Rooms', 'Rooms', 'Rooms Rooms Rooms'),
(642, 1007, 'ru', 'Rooms', 'Rooms', 'Rooms', 'Rooms Rooms Rooms'),
(654, 166680, 'ru', 'Scaner', 'Scaner', 'Scaner', 'Scaner Scaner Scaner'),
(655, 166681, 'en', 'Inhalation', 'Inhalation', 'Inhalation', 'Inhalation Inhalation Inhalation'),
(656, 166681, 'am', 'Inhalation', 'Inhalation', 'Inhalation', 'Inhalation Inhalation Inhalation'),
(657, 166681, 'ru', 'Inhalation', 'Inhalation', 'Inhalation', 'Inhalation Inhalation Inhalation'),
(658, 166682, 'en', 'Intestinal procedures', 'Intestinal procedures', 'Intestinal procedures', 'Intestinal procedures Intestinal procedures Intestinal procedures'),
(659, 166682, 'am', 'Intestinal procedures', 'Intestinal procedures', 'Intestinal procedures', 'Intestinal procedures Intestinal procedures Intestinal procedures'),
(660, 166682, 'ru', 'Intestinal procedures', 'Intestinal procedures', 'Intestinal procedures', 'Intestinal procedures Intestinal procedures Intestinal procedures'),
(679, 166683, 'en', 'News', 'News', 'News', 'News News News'),
(680, 166683, 'am', 'նորություններ', 'նորություններ', 'նորություններ', 'նորություններ նորություններ նորություններ'),
(681, 166683, 'ru', 'Новости', 'Новости', 'Новости', 'Новости Новости Новости'),
(685, 166684, 'en', 'test', 'test', 'test', 'test test test'),
(686, 166684, 'am', 'sfsdf', 'fsdf', 'fsdf', 'sfsdf fsdf fsdf'),
(687, 166684, 'ru', 'fdsfds', 'dsfsdf', 'fsdfsdf', 'fdsfds dsfsdf fsdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `menu_sections`
--

CREATE TABLE IF NOT EXISTS `menu_sections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menu_sections`
--

INSERT INTO `menu_sections` (`id`, `title`, `url`, `status`) VALUES
(1, 'Main Menu', 'main-menu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_table_numbers`
--

CREATE TABLE IF NOT EXISTS `order_table_numbers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(11) unsigned NOT NULL,
  `status` int(11) unsigned NOT NULL DEFAULT '0',
  `table_number` int(11) unsigned NOT NULL,
  `push_date` int(11) unsigned NOT NULL DEFAULT '0',
  `restaurant_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `order_table_numbers`
--

INSERT INTO `order_table_numbers` (`id`, `date`, `status`, `table_number`, `push_date`, `restaurant_id`) VALUES
(1, 1497270161, 1, 123, 0, 0),
(2, 1497270207, 1, 123, 0, 0),
(3, 1497270315, 1, 12, 0, 0),
(4, 1497274175, 1, 2, 0, 0),
(5, 1497274236, 1, 123, 0, 0),
(6, 1497274260, 1, 21, 0, 0),
(7, 1497274341, 1, 1, 0, 0),
(8, 1497274397, 1, 123, 0, 0),
(9, 1497274445, 1, 21, 1497274459, 0),
(10, 1497274481, 1, 1, 1497274482, 0),
(11, 1497274499, 1, 12, 1497274501, 0),
(12, 1497274645, 1, 213, 1497274652, 0),
(13, 1497274809, 1, 23, 1497274810, 0),
(14, 1497275177, 1, 12, 1497275178, 0),
(15, 1497275191, 1, 12, 1497275262, 0),
(16, 1497275255, 1, 123, 1497275261, 0),
(17, 1497275281, 1, 123, 1497275491, 0),
(18, 1497275286, 1, 45, 1497275296, 0),
(19, 1497275510, 1, 12, 1497275551, 0),
(20, 1497275565, 1, 12, 1497275571, 0),
(21, 1497280461, 1, 123, 1497280487, 0),
(22, 1497280499, 1, 444, 1497280522, 0),
(23, 1497337750, 1, 34234, 1497338249, 0),
(24, 1497337757, 1, 3232, 1497338258, 0),
(25, 1497341944, 1, 123, 1497341948, 0),
(26, 1497341968, 1, 123, 1497341982, 0),
(27, 1497341974, 1, 213, 1497341986, 0),
(28, 1497342058, 1, 41, 1497342083, 0),
(29, 1497342092, 1, 4141, 1497342099, 0),
(30, 1497342095, 1, 74747, 1497342154, 0),
(31, 1497342791, 1, 152, 1497352481, 0),
(32, 1497345971, 1, 111, 1497352489, 0),
(33, 1497352449, 1, 2, 1497352496, 0),
(34, 1497374287, 1, 12, 1497374311, 0),
(35, 1497374659, 1, 45, 1497374685, 0),
(36, 1497374673, 1, 35, 1497374696, 0),
(37, 1497541923, 1, 48, 1497541942, 0),
(38, 1497542105, 1, 7, 1497542599, 0),
(39, 1497542674, 1, 2, 1497542809, 0),
(43, 1497543347, 1, 3, 1497543364, 0),
(44, 1497548028, 0, 5, 0, 0),
(45, 1497551323, 0, 34, 0, 0),
(54, 1499850887, 1, 32, 1499850898, 9),
(55, 1500535889, 1, 12, 1501498242, 9),
(56, 1501140774, 1, 12, 1501498249, 9),
(59, 1505154182, 1, 3, 1507198187, 9),
(60, 1505157709, 1, 2, 1507198196, 9),
(61, 1505237626, 1, 12, 1507198219, 9),
(75, 1507714040, 1, 23, 1507714056, 9),
(76, 1507714067, 1, 12, 1507714070, 9),
(77, 1507754641, 0, 10, 0, 9),
(78, 1507928561, 0, 12, 0, 9),
(79, 1508160215, 0, 12, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_users`
--

CREATE TABLE IF NOT EXISTS `restaurant_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `restaurant_users`
--

INSERT INTO `restaurant_users` (`id`, `username`, `password`, `restaurant_id`) VALUES
(1, 'arthur', 'arthur', 9),
(2, 'admin@admin.com', '123456', 8),
(4, 'asasas', 'sadasfsf', 9);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE IF NOT EXISTS `restaurants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(2) NOT NULL,
  `logo_img` varchar(255) CHARACTER SET utf8 NOT NULL,
  `background_image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `header_icons` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#cdb359',
  `menu_scrolling_bar` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#cdb359',
  `menu_link` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#cdb359',
  `menu_link_active` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#cdb359',
  `site_link` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#cdb359',
  `site_text` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#fff',
  `heading_title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#cdb359',
  `product_menu_heading_title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#000',
  `product_menu` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#000',
  `product_menu_active` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#ee8524',
  `header` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '#fff',
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `home_content_title_color` varchar(7) COLLATE utf8_unicode_ci DEFAULT '#ffffff',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `status`, `logo_img`, `background_image`, `header_icons`, `menu_scrolling_bar`, `menu_link`, `menu_link_active`, `site_link`, `site_text`, `heading_title`, `product_menu_heading_title`, `product_menu`, `product_menu_active`, `header`, `username`, `password`, `home_content_title_color`, `url`) VALUES
(9, 1, 'uploads/restaurants/9/restaurant_images/e8adbb8f4f82f21024ee65889e1b8663.png', 'uploads/restaurants/9/restaurant_images/f42473417a1c5b0016afd3a74a3bff2b.jpg', 'CDB359', 'CDB359', 'FFFFFF', 'CDB359', 'CDB359', 'FFFFFF', 'CDB359', '000000', '000000', 'EE8524', '212121', 'resto@resto.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'CDB359', 'demo-restaurant'),
(13, 1, '', '', '#cdb359', '#cdb359', '#cdb359', '#cdb359', '#cdb359', '#fff', '#cdb359', '#000', '#000', '#ee8524', '#fff', '', '', '#ffffff', ''),
(14, 1, '', '', '#cdb359', '#cdb359', '#cdb359', '#cdb359', '#cdb359', '#fff', '#cdb359', '#000', '#000', '#ee8524', '#fff', '', '', '#ffffff', '');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants_menu`
--

CREATE TABLE IF NOT EXISTS `restaurants_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(2) NOT NULL DEFAULT '0',
  `section_id` int(11) unsigned NOT NULL,
  `show` int(2) DEFAULT '1',
  `pid` int(2) NOT NULL DEFAULT '0',
  `cid` int(2) DEFAULT '0',
  `pos` int(2) NOT NULL DEFAULT '1',
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1057 ;

--
-- Dumping data for table `restaurants_menu`
--

INSERT INTO `restaurants_menu` (`id`, `status`, `section_id`, `show`, `pid`, `cid`, `pos`, `url`) VALUES
(1030, 1, 9, NULL, 20, NULL, 1, ''),
(1031, 1, 9, NULL, 9, NULL, 1, ''),
(1032, 1, 9, NULL, 9, NULL, 3, ''),
(1035, 1, 9, NULL, 9, NULL, 15, ''),
(1036, 1, 9, NULL, 9, NULL, 13, ''),
(1037, 1, 9, NULL, 9, NULL, 19, ''),
(1038, 1, 9, NULL, 9, NULL, 11, ''),
(1039, 1, 9, NULL, 9, NULL, 5, ''),
(1040, 1, 9, NULL, 9, NULL, 7, ''),
(1041, 1, 9, NULL, 9, NULL, 9, ''),
(1042, 1, 9, NULL, 9, NULL, 17, ''),
(1043, 1, 9, NULL, 9, NULL, 21, ''),
(1044, 1, 9, NULL, 9, NULL, 35, ''),
(1045, 1, 9, NULL, 9, NULL, 37, ''),
(1046, 1, 9, NULL, 9, NULL, 39, ''),
(1047, 1, 9, NULL, 9, NULL, 33, ''),
(1048, 1, 9, NULL, 9, NULL, 31, ''),
(1049, 1, 9, NULL, 9, NULL, 23, ''),
(1050, 1, 9, NULL, 9, NULL, 25, ''),
(1051, 1, 9, NULL, 9, NULL, 27, ''),
(1052, 1, 9, NULL, 9, NULL, 29, ''),
(1053, 1, 9, NULL, 9, NULL, 41, ''),
(1054, 1, 8, NULL, 8, NULL, 1000, ''),
(1055, 1, 8, NULL, 8, NULL, 1000, ''),
(1056, 1, 16, NULL, 16, NULL, 1000, '');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants_menu_items`
--

CREATE TABLE IF NOT EXISTS `restaurants_menu_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(2) NOT NULL,
  `item_image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pos` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `restaurants_menu_items`
--

INSERT INTO `restaurants_menu_items` (`id`, `status`, `item_image`, `pos`) VALUES
(2, 1, NULL, 0),
(3, 1, NULL, 0),
(4, 1, NULL, 0),
(5, 1, NULL, 0),
(7, 1, NULL, 0),
(9, 1, NULL, 0),
(10, 1, NULL, 0),
(11, 1, NULL, 0),
(13, 1, NULL, 0),
(14, 1, 'uploads/restaurants/9/products/1030/e0857945ffcb58d256a0e11c2b6aee81.jpg', 0),
(15, 1, 'uploads/restaurants/9/products/1030/33d1621c99804a37fedaee63338e13b3.jpg', 0),
(16, 1, 'uploads/restaurants/9/products/1030/fcf931ef48b9281657d0fe291ae315d9.jpg', 0),
(17, 1, 'uploads/restaurants/9/products/1030/94f8753a4298c6828bd8c8b13cd7cde9.jpg', 0),
(18, 1, 'uploads/restaurants/9/products/1030/1eb52093f43614d9e9c95304d422dcee.jpg', 0),
(19, 1, 'uploads/restaurants/9/products/1030/94abf2db9d91e50ffa38313b085ba23e.jpg', 0),
(20, 1, NULL, 0),
(21, 1, NULL, 0),
(22, 1, NULL, 0),
(23, 1, 'uploads/restaurants/9/products/1030/91b4e171c716d1f6bbc2dacf5130e5a3.jpg', 0),
(24, 1, NULL, 0),
(25, 1, NULL, 0),
(26, 1, NULL, 0),
(27, 1, '', 0),
(28, 1, NULL, 0),
(29, 1, NULL, 0),
(30, 1, NULL, 0),
(32, 1, NULL, 0),
(35, 1, 'uploads/restaurants/16/products/1056/a455b410cd9be9047f35aab0a235d840.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants_menu_items_ml`
--

CREATE TABLE IF NOT EXISTS `restaurants_menu_items_ml` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `lang` char(3) CHARACTER SET utf8 NOT NULL,
  `restaurants_menu_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `compound` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `price` float NOT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

--
-- Dumping data for table `restaurants_menu_items_ml`
--

INSERT INTO `restaurants_menu_items_ml` (`uid`, `id`, `lang`, `restaurants_menu_id`, `title`, `compound`, `price`, `desc`) VALUES
(2, 2, 'en', 1024, 'haykakan', 'null active', 9, NULL),
(6, 2, 'be', 1024, 'haykakann', 'asfasfsaf', 9, NULL),
(7, 4, 'en', 1024, 'vracakan', 'ax bibar', 15, NULL),
(8, 4, 'be', 1024, 'vracakan', 'ax bibar', 15, NULL),
(9, 0, 'en', 1024, 'asdsdsd', 'asdsd', 15, NULL),
(10, 0, 'be', 1024, 'asdsda', 'asdsdasd', 15, NULL),
(13, 7, 'en', 0, 'dsafsda', 'gsdfg', 5, NULL),
(14, 7, 'be', 0, 'ssdgsadg', 'sdagsdag', 5, NULL),
(17, 9, 'en', 1031, 'Aperitief van het huis', 'null', 9, NULL),
(18, 9, 'be', 1031, 'Aperitief van het huis', 'null', 9, NULL),
(19, 10, 'en', 1031, 'Mojito', 'null', 10, NULL),
(20, 10, 'be', 1031, 'Mojito', 'null', 10, NULL),
(21, 11, 'en', 1031, 'Moscow Mule', 'Wodka-ginger beer-limon-suikersiroop', 10, NULL),
(22, 11, 'be', 1031, 'Moscow Mule', 'Wodka-ginger beer-limon-suikersiroop', 10, NULL),
(25, 13, 'en', 1032, 'product 1', '(compound 1);', 12, NULL),
(26, 13, 'be', 1032, 'product 1', '(compound 1)', 12, NULL),
(27, 14, 'en', 1030, 'Aperitief van het huis', 'What is Lorem Ipsum?', 8, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>'),
(28, 14, 'be', 1030, 'Aperitief van het huis', 'What is Lorem Ipsum?', 8, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>'),
(29, 15, 'en', 1030, 'Mojito', '', 9.5, NULL),
(30, 15, 'be', 1030, 'Mojito', '', 9.5, NULL),
(31, 16, 'en', 1030, 'Moscow Mule', '(wodka-ginger beer-limoen -suikersiroop)', 10, NULL),
(32, 16, 'be', 1030, 'Moscow Mule', '(wodka-ginger beer-limoen -suikersiroop)', 10, NULL),
(33, 17, 'en', 1030, 'Somersby', '', 4, NULL),
(34, 17, 'be', 1030, 'Somersby', '', 4, NULL),
(35, 18, 'en', 1030, 'Aperol', '', 5, NULL),
(36, 18, 'be', 1030, 'Aperol', '', 5, NULL),
(37, 19, 'en', 1030, 'Aperol Spritz', '', 6, NULL),
(38, 19, 'be', 1030, 'Aperol Spritz', '', 6, NULL),
(39, 20, 'en', 1030, 'Martini Bianco / Rosso / Rosato / Fiero', '', 5, ''),
(40, 20, 'be', 1030, 'Martini Bianco / Rosso / Rosato / FieroMartini Bianco / Rosso / Rosato / FieroMartini Bianco / Rosso', '', 5, ''),
(41, 21, 'en', 1030, 'Martini Royale Bianco / Rosé', '', 8, NULL),
(42, 21, 'be', 1030, 'Martini Royale Bianco / Rosé', '', 8, NULL),
(43, 22, 'en', 1030, 'Campari', '', 6, NULL),
(44, 22, 'be', 1030, 'Campari', '', 6, NULL),
(45, 23, 'en', 1030, 'Pisang / Safari / Passoa', '', 6, '<p>sad sad adsa dsad sad</p>'),
(46, 23, 'be', 1030, 'Pisang / Safari / Passoa', '', 6, '<p>13 123fdsa dsa</p>'),
(47, 24, 'en', 1030, 'Sherry dry', '', 5, NULL),
(48, 24, 'be', 1030, 'Sherry dry', '', 5, NULL),
(49, 25, 'en', 1030, 'Porto wit / rood', '', 5, NULL),
(50, 25, 'be', 1030, 'Porto wit / rood', '', 5, NULL),
(51, 26, 'en', 1030, 'Lillet blanc met Fever-Tree', '', 9, NULL),
(52, 26, 'be', 1030, 'Lillet blanc met Fever-Tree', '', 9, NULL),
(53, 27, 'en', 1030, 'Picon met witte wijn', '', 8, NULL),
(54, 27, 'be', 1030, 'Picon met witte wijn', '', 8, NULL),
(55, 28, 'en', 1030, 'Ricard', '', 6, NULL),
(56, 28, 'be', 1030, 'Ricard', '', 6, NULL),
(57, 29, 'en', 1030, 'Pineau des Charentes', '', 5, NULL),
(58, 29, 'be', 1030, 'Pineau des Charentes', '', 5, NULL),
(59, 30, 'en', 1030, 'Kir', '', 6, NULL),
(60, 30, 'be', 1030, 'Kir', '', 6, NULL),
(63, 32, 'en', 1030, 'Pineau des Charentes', '', 5, NULL),
(64, 32, 'be', 1030, 'Pineau des Charentes', '', 5, NULL),
(69, 35, 'en', 1056, 'vvvvvvvvvvvv', 'vvvvvvvvvvv', 45, NULL),
(70, 35, 'be', 1056, 'vvvvvvvvvvv', 'vvvvvvvvvvvvvvvv', 45, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants_menu_ml`
--

CREATE TABLE IF NOT EXISTS `restaurants_menu_ml` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `lang` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=155 ;

--
-- Dumping data for table `restaurants_menu_ml`
--

INSERT INTO `restaurants_menu_ml` (`uid`, `id`, `lang`, `title`) VALUES
(107, 1030, 'en', 'Aperitieven'),
(108, 1030, 'be', 'Aperitieven'),
(109, 1031, 'en', 'Jin & Zijn Tonic'),
(110, 1031, 'be', 'Jin & Zijn Tonic'),
(111, 1032, 'en', 'Huis Wijn'),
(112, 1032, 'be', 'Huis Wijn'),
(117, 1035, 'en', 'wijn suggesties'),
(118, 1035, 'be', 'wijn suggesties'),
(119, 1036, 'en', 'cava &amp; champagne'),
(120, 1036, 'be', 'cava &amp; champagne'),
(121, 1037, 'en', 'bieren van ''t vat'),
(122, 1037, 'be', 'bieren van ''t vat'),
(123, 1038, 'en', 'bieren op fles'),
(124, 1038, 'be', 'bieren op fles'),
(125, 1039, 'en', 'Bieren op fles vervolg'),
(126, 1039, 'be', 'bieren op fles vervolg'),
(127, 1040, 'en', 'bier suggesties'),
(128, 1040, 'be', 'bier suggesties'),
(129, 1041, 'en', 'freis dranken'),
(130, 1041, 'be', 'freis dranken'),
(131, 1042, 'en', 'warme dranken'),
(132, 1042, 'be', 'warme dranken'),
(133, 1043, 'en', 'geestrijke koffies'),
(134, 1043, 'be', 'geestrijke koffies'),
(135, 1044, 'en', 'thee'),
(136, 1044, 'be', 'thee'),
(137, 1045, 'en', 'geestrijee dranken &amp; ...'),
(138, 1045, 'be', 'geestrijee dranken &amp; ...'),
(139, 1046, 'en', 'suggesties'),
(140, 1046, 'be', 'suggesties'),
(141, 1047, 'en', 'tussen doortjes'),
(142, 1047, 'be', 'tussen doortjes'),
(143, 1048, 'en', 'geestrijee dranken &amp; ...'),
(144, 1048, 'be', 'geestrijee dranken &amp; ...'),
(145, 1049, 'en', 'suggesties'),
(146, 1049, 'be', 'suggesties'),
(147, 1050, 'en', 'tussen doortjes'),
(148, 1050, 'be', 'tussen doortjes'),
(149, 1051, 'en', 'geestrijee dranken &amp; ...'),
(150, 1051, 'be', 'geestrijee dranken &amp; ...'),
(151, 1052, 'en', 'suggesties'),
(152, 1052, 'be', 'suggesties'),
(153, 1053, 'en', 'tussen doortjes'),
(154, 1053, 'be', 'tussen doortjes');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants_ml`
--

CREATE TABLE IF NOT EXISTS `restaurants_ml` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(11) unsigned NOT NULL,
  `lang` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `text` text CHARACTER SET utf8,
  `searchfield` text CHARACTER SET utf8,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `id_lng` (`id`,`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=134 ;

--
-- Dumping data for table `restaurants_ml`
--

INSERT INTO `restaurants_ml` (`uid`, `id`, `lang`, `title`, `text`, `searchfield`) VALUES
(132, 9, 'en', 'Demo Restaurant', '', 'Demo Restaurant '),
(133, 9, 'be', 'Demo Restaurant', '', 'Demo Restaurant ');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) DEFAULT '1',
  `type` tinyint(4) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `status`, `type`, `name`, `key`, `value`) VALUES
(1, 1, 2, 'total price text', 'total_price', 'Total'),
(8, 1, 2, 'your order text', 'order_not_empty', 'Your Order'),
(19, 1, 2, 'empty order text', 'order_empty', 'your order basket empty'),
(20, 1, 2, 'empty pages in site (empty menus)', 'empty_pages', 'Empty!!!'),
(21, 1, 2, 'reset order text', 'reset_order', 'Reset Order ');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `date`) VALUES
(1, 'asdsadsa@asdsa.as', 1487817077),
(2, 'saddssa@asdasd.aas', 1487817101),
(3, 'sasddssa@asdasd.aas', 1487817115),
(4, 'asdasd@saddsa.as', 1487879541),
(5, 'asdsad@sadsa.as', 1487879575),
(6, 'asdsadsda@assada.sd', 1487879600),
(7, 'asdasdsad@sdsad.sd', 1487879712),
(8, 'asdsadsa@sadsadsad.dsa', 1487879722);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `userrole` enum('admin','client') DEFAULT 'client',
  `address` varchar(255) DEFAULT NULL,
  `about` text,
  `sex` char(1) DEFAULT NULL,
  `age` int(4) DEFAULT NULL,
  `schoolid` int(10) DEFAULT NULL,
  `classroom` int(2) DEFAULT NULL,
  `parallel` varchar(2) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pidx` (`id`) USING BTREE,
  UNIQUE KEY `eidx` (`email`) USING BTREE,
  KEY `fstidx` (`first_name`) USING BTREE,
  KEY `lstidx` (`last_name`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `userrole`, `address`, `about`, `sex`, `age`, `schoolid`, `classroom`, `parallel`, `restaurant_id`) VALUES
(2, 'admin@admin.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Resto', 'Menu', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'resto@resto.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'restaurant1', 'restaurant1', 'client', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4, 'restaurant@restaurant.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'restaurant2', 'restaurant2', 'client', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
