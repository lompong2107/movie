-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2021 at 07:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_location` varchar(255) NOT NULL,
  `branch_tel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `reg_id`, `branch_name`, `branch_location`, `branch_tel`) VALUES
(1, 5, 'เอส เอฟ เอ็กซ์ ซีเนม่า เซ็นทรัลเฟสติวัล พัทยาบีช', '6th FL. Central Pattaya Beach', '1349'),
(2, 3, 'เอส เอฟ เอ็กซ์ ซีเนม่า เมญ่า เชียงใหม่', '5th FL. MAYA Lifestyle Shopping Center', '1349'),
(3, 6, 'เอส เอฟ เอ็กซ์ ซีเนม่า เซ็นทรัล ภูเก็ต เฟสติวัล', '3rd FL. Central Phuket', '1349'),
(4, 6, 'เอส เอฟ ซีเนม่า เซ็นทรัล พลาซา สุราษฎร์ธานี', '4th FL. Central Plaza Suratthani', '1349'),
(5, 5, 'เอส เอฟ เอ็กซ์ ซีเนม่า เทอร์มินอล 21 พัทยา', '3rd FL. Terminal 21 Pattaya', '1349'),
(6, 2, 'เอส เอฟ ซีเนม่า เซ็นทรัล ศาลายา', '4th FL. Central Salaya', '1349'),
(7, 4, 'เอส เอฟ เอ็กซ์ ซีเนม่า เซ็นทรัลพลาซา นครราชสีมา', '4th FL. Central Plaza Nakhon Ratchasima', '1349'),
(8, 4, 'เอส เอฟ ซีเนม่า เทอร์มินอล 21 โคราช', '5th FL. Terminal 21 Korat', '1349'),
(9, 1, 'เอ็มพรีเว่ ซีเนคลับ เอ็มโพเรียม', '5th FL. The Emporium', '1349'),
(10, 1, 'เอส เอฟ เวิลด์ ซีเนม่า เซ็นทรัลเวิลด์', '7th FL. CentralWorld', '1349'),
(11, 5, 'เอส เอฟ ซีเนม่า เซ็นทรัล ชลบุรี', '4th FL. Central Chonburi', '1349'),
(12, 5, 'เอส เอฟ ซีเนม่า โรบินสันไลฟ์สไตล์ ชลบุรี', '2nd FL. Robinson Lifestyle Chonburi', '1349'),
(13, 5, 'เอส เอฟ ซีเนม่า บิ๊กซี สระแก้ว', 'G FL. Big C Super Center Sakeaw', '1349');

-- --------------------------------------------------------

--
-- Table structure for table `cinema`
--

CREATE TABLE `cinema` (
  `cin_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `cin_name` varchar(100) NOT NULL,
  `cin_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cinema`
--

INSERT INTO `cinema` (`cin_id`, `branch_id`, `cin_name`, `cin_status`) VALUES
(1, 1, '1', '1'),
(2, 1, '2', '1'),
(3, 1, '3', '1'),
(4, 1, '4', '0'),
(5, 1, '5', '0'),
(6, 2, '1', '1'),
(7, 2, '2', '1'),
(8, 2, '3', '1'),
(10, 3, '1', '1'),
(11, 4, '1', '1'),
(12, 4, '2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cycle`
--

CREATE TABLE `cycle` (
  `cyc_id` int(11) NOT NULL,
  `cyc_time` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cycle`
--

INSERT INTO `cycle` (`cyc_id`, `cyc_time`) VALUES
(10, '21:30'),
(10, '09:40'),
(10, '13:30'),
(10, '16:35'),
(10, '21:40'),
(10, '23:45'),
(11, '09:30'),
(11, '13:15'),
(11, '20:45'),
(11, '22:30'),
(11, '23:20'),
(14, '17:35'),
(14, '19:45'),
(14, '10:50'),
(17, '00:35'),
(17, '22:40'),
(17, '14:05'),
(18, '14:30'),
(18, '17:35'),
(18, '20:40'),
(19, '15:30'),
(19, '20:35'),
(19, '10:40'),
(20, '09:50'),
(20, '14:40'),
(21, '15:10'),
(21, '10:20'),
(21, '20:30'),
(22, '23:00'),
(22, '21:10'),
(22, '00:00'),
(14, '00:01'),
(14, '00:02'),
(14, '03:05'),
(10, '00:05'),
(10, '04:09'),
(14, '23:06'),
(14, '23:09'),
(14, '00:07'),
(14, '03:10'),
(34, '17:20'),
(34, '09:30'),
(35, '23:25'),
(35, '09:30'),
(35, '13:30'),
(35, '15:30'),
(36, '09:30'),
(36, '13:40'),
(36, '17:50'),
(37, '10:20'),
(37, '11:30'),
(37, '16:40'),
(38, '11:30'),
(38, '15:40'),
(38, '18:50');

-- --------------------------------------------------------

--
-- Table structure for table `cycle_detail`
--

CREATE TABLE `cycle_detail` (
  `cyc_id` int(11) NOT NULL,
  `mov_id` int(11) NOT NULL,
  `cin_id` int(11) NOT NULL,
  `cyc_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cycle_detail`
--

INSERT INTO `cycle_detail` (`cyc_id`, `mov_id`, `cin_id`, `cyc_date`) VALUES
(10, 2, 1, '2021-08-19'),
(11, 3, 2, '2021-08-19'),
(14, 2, 1, '2021-08-18'),
(17, 2, 6, '2021-08-18'),
(18, 2, 7, '2021-08-19'),
(19, 2, 1, '2021-08-20'),
(20, 4, 3, '2021-08-18'),
(21, 4, 3, '2021-08-19'),
(22, 8, 2, '2021-08-22'),
(34, 3, 7, '2021-08-19'),
(35, 4, 10, '2021-08-18'),
(36, 5, 10, '2021-08-19'),
(37, 6, 11, '2021-08-19'),
(38, 7, 11, '2021-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `mem_id` int(11) NOT NULL,
  `mem_name` varchar(100) NOT NULL,
  `mem_surname` varchar(100) NOT NULL,
  `mem_email` varchar(100) NOT NULL,
  `mem_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`mem_id`, `mem_name`, `mem_surname`, `mem_email`, `mem_pass`) VALUES
(1, 'member', 'test', 'member@hotmail.com', '12345678'),
(2, 'ล้อมพงศ์', 'สำราญชื่น', 'keawatbun191@hotmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `mov_id` int(11) NOT NULL,
  `mov_type_id` int(11) NOT NULL,
  `mov_name` varchar(100) NOT NULL,
  `mov_actor` varchar(100) NOT NULL,
  `mov_superintendent` varchar(100) NOT NULL,
  `mov_details` text NOT NULL,
  `mov_time` varchar(5) NOT NULL,
  `mov_date_start` date NOT NULL,
  `mov_date_end` date NOT NULL,
  `mov_picture` varchar(100) NOT NULL,
  `mov_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`mov_id`, `mov_type_id`, `mov_name`, `mov_actor`, `mov_superintendent`, `mov_details`, `mov_time`, `mov_date_start`, `mov_date_end`, `mov_picture`, `mov_status`) VALUES
(2, 1, 'เดือดกู้ภัยพิทักษ์โลก', 'Eddie Peng, Zhilei Xin, Lyric Lan', 'Dante Lam, Chi-Hung Choi', 'เมื่อเกิดอุบัติเหตุร้ายแรงบนแท่นขุดเจาะกลางทะเลและเสี่ยงอันตรายต่อทุกชีวิตในมหาสมุทร งานนี้รัฐมนตรีคมนาคมจึงเร่งสั่งการให้หน่วยกู้ภัยยามฝั่งของจีนที่เสียสละทุ่มเทให้กับงานอย่างเต็มที่และไม่ค่อยจะลงรอยกัน นำทีมโดยกัปตัน Gao Qian (Eddie Peung) และคู่หู Zhao', '140', '2021-08-08', '2021-08-24', '20210808214954.jpg', '1'),
(3, 8, 'ใครสั่งเก็บตาย', 'Angelina Jolie, Nicholas Hoult, Jon Bernthal', 'Taylor Sheridan', 'ระทึกขวัญ เค้นหัวใจ ไปกับนักแสดงเจ้าของรางวัลออสการ์ แองเจลีน่า โจลี่ ใน “Those Who Wish Me Dead - ใครสั่งเก็บตาย” ภาพยนตร์ระทึกขวัญจาก นิว ไลน์ ซีเนม่า และและวอร์เนอร์ บราเดอร์ส พิกเจอร์ส ฝีมือผู้กำกับภาพยนตร์ ไทย์เลอร์ เชอริแดน เขียนบทภาพยนตร์โดย ไมเคิล', '100', '2021-08-09', '2021-08-26', '20210809111422.jpg', '1'),
(4, 1, 'ก็อดซิลล่า ปะทะ คอง', 'Eiza González, Millie Bobby Brown, Alexander Skarsgård', 'Adam Wingard', 'เมื่อสองตำนานต้องปะทะกันในศึกที่โลกต้องจารึกทุกยุคทุกสมัย โชคชะตาของโลกมนุษย์ก็ถูกแขวนอยู่บนเส้นด้าย คอง และผู้ติดตามของมันเริ่มต้นการเดินทางเสี่ยงอันตรายเพื่อตามหาบ้านที่แท้จริง หนึ่งในผู้ร่วมเดินทางนั้นคือ เจีย สาวน้อยกำพร้าที่มีสายใยมิตรภาพอันแข็งแกร่ง', '115', '2021-08-09', '2021-08-24', '20210809012244.jpg', '1'),
(5, 5, 'ดินแดนไร้เสียง 1.5', 'Emily Blunt, Noah Jupe, Millicent Simmonds', 'John Krasinski', 'จากเหตุการณ์อันตรายถึงชีวิตที่เกิดขึ้นในบ้าน ครอบครัวแอ็บบอท (เอมิลี่ บลันท์, มิลลิเซนท์ ซิมมอนด์, โนอาห์ จู๊ป) ต้องเผชิญกับหายนะในโลกภายนอก พวกเขายังคงต่อสู้เพื่ออยู่รอดในความเงียบ และต้องเสี่ยงภัยในดินแดนลึกลับ และยังรู้ว่าสิ่งมีชีวิตที่ไล่ล่าตามเสียงไม่ใช่ภัยคุกคามเดียวที่แฝงตัวอยู่นอกเส้นทางทรายเท่านั้น', '100', '2021-08-09', '2021-08-26', '20210809114120.jpg', '1'),
(6, 1, 'คนธรรมดานรกเรียกพี่', 'Bob Odenkirk, Connie Nielsen, Aleksey Serebryakov', 'Ilya Naishuller', 'ฮัทช์ แมนเซลล์ คุณพ่อและสามีคนธรรมดาที่คนมักจะไม่เห็นคุณค่า เขายอมรับในสถานการณ์และไม่เคยตอบโต้ เขาเป็นเพียงคนธรรมดา เมื่อขโมย 2 คน บุกเข้าในในบ้านของเขาในละแวกชานเมือง ฮัทช์ ปฏิเสธที่จะปกป้องตัวเองและครอบครัว โดยหวังว่าจะไม่เกิดความรุนแรงขึ้น เบลค ลูกชายวัยรุ่น (เกจ มันโรว์ จาก The Shack) ผิดหวังในตัวเขา ส่วนภรรยา เบคกา (คอนนี่ นีลเซ็น จาก Wonder Woman) ดูเหมือนจะตีตัวออกห่าง ผลจากเหตุการณ์นี้ ทำให้ฮัทช์ระเบิดความโกรธแค้นที่เดือดดาลมาเป็นเวลานานและกระตุ้นสัญชาตญาณที่เคยนิ่งเฉย ขับเคลื่อนเขาไปบนเส้นทางสายโหด ซึ่งจะเปิดเผยถึงความลับดำมืดและทักษะในการฆ่าของเขา', '95', '2021-08-11', '2021-09-30', '20210811122820.jpg', '0'),
(7, 1, 'มอร์ทัล คอมแบท', 'Jessica McNamee, Hiroyuki Sanada, Tadanobu Asano', 'Simon McQuoid', 'สิ้นสุดการรอคอยของแฟนคลับวิดีโอเกมดังจากทั่วโลก “Mortal Kombat - มอร์ทัล คอมแบท” ฉบับภาพยนตร์ปล่อยใบปิดและตัวอย่างแรกมันส์สะท้านสังเวียน เตรียมพาคุณไปพบกับศึกของเหล่านักสู้แห่งโชคชะตา ที่ท้าทายทั้งตัวเอง เพื่อนฝูง ศัตรู และอนาคตของจักรวาล!!! ผลงานฝีมือผู้กำกับ ไซม่อน แม็คคอยด์ อำนวยการสร้างโดย เจมส์ วาน จากบทภาพยนตร์ของ เกร็ก รุสโซ่ และ เดฟ คอลลาแฮม รวมถึงเรื่องราวจาก โอเรน อูเซียล', '110', '2021-09-01', '2021-10-31', '20210811122948.jpg', '1'),
(8, 5, 'คนเรียกผี', 'Vera Farmiga, Patrick Wilson, Mackenzie Foy', 'James Wan', 'ก่อนเหตุการณ์สยองขวัญที่อมิตี้วิลล์ มีเรื่องราวที่เฮี้ยนยิ่งกว่าเกิดขึ้นที่หมู่บ้านชื่อ แฮร์ริสวิลล์ สร้างจากเรื่องจริง บอกเล่าถึงตำนานเกี่ยวกับนักสืบสวนเรื่องราวเหนือธรรมชาติชื่อดัง เอ็ด (แพทริค วิลสัน) และ ลอร์เรน วอร์เรน (เวร่า ฟาร์มิก้า) ที่ถูกเรียกตัวให้ไปช่วยครอบครัวที่ถูกคุกคามจากพลังมืดลึกลับในบ้านไร่ที่ห่างไกลผู้คน ครอบครัววอร์เรน จำเป็นต้องเผชิญหน้ากับปีศาจร้ายที่ทรงอำนาจ ซึ่งนับได้ว่าเป็นคดีที่สยองขวัญที่สุดที่พวกเขาเคยประสบมาในชีวิต', '115', '2021-08-20', '2021-10-31', '20210818222916.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `movie_type`
--

CREATE TABLE `movie_type` (
  `mov_type_id` int(11) NOT NULL,
  `mov_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie_type`
--

INSERT INTO `movie_type` (`mov_type_id`, `mov_type_name`) VALUES
(1, 'Action'),
(2, 'Comedy'),
(3, 'Drama'),
(4, 'Fantasy'),
(5, 'Horror'),
(6, 'Mystery'),
(7, 'Romance'),
(8, 'Thriller'),
(9, 'Adventure'),
(10, 'War'),
(11, 'Sci-Fi'),
(12, 'Family'),
(13, 'Crime'),
(14, 'Documentaries'),
(15, 'Animation'),
(16, 'Erotic'),
(17, 'Musicals'),
(18, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `new_id` int(11) NOT NULL,
  `new_title` varchar(255) NOT NULL,
  `new_detail` text NOT NULL,
  `new_image` varchar(100) NOT NULL,
  `new_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`new_id`, `new_title`, `new_detail`, `new_image`, `new_date`) VALUES
(7, 'Movie News', 'เจมส์ กันน์ นำทีมเปิดตัวรอบปฐมทัศน์ The Suicide Squad ที่ ลอสแอนเจลิส สหรัฐอเมริกา ทัพนักแสดงร่วมงานคับคั่ง', '20210811111441.jpg', '2021-08-01'),
(9, 'Movie News', 'หนังฮีโร่ Marvel Phase 4 ปี 2021 ที่คุณห้ามพลาด!', '20210811111825.jpg', '2021-07-01'),
(10, 'Movie News', 'ไว้ใจฉัน! เราต้องรอด เตรียมลุ้นระทึกไปกับ แองเจลีน่า โจลี่ ใน Those Who Wish Me Dead', '20210811113254.jpg', '2021-07-10'),
(11, 'Movie News', '7 เรื่องน่ารู้ของ \"ท็อดด์ ฮิววิตต์\" เด็กหนุ่มผู้เกิดมาพร้อม \"พลังเสียงคิด\" ในภาพยนตร์แอ็กชัน ไซไฟ Chaos Walking', '20210811113357.jpg', '2021-06-16'),
(12, 'หัวข้อ - ข่าว', 'รายละเอียด - ข่าว', '20210818131617.jpg', '2021-08-04'),
(13, 'หัวข้อ - ข่าว', 'รายละเอียด - ข่าว', '20210818131625.jpg', '2021-08-13'),
(14, 'หัวข้อ - ข่าว', 'รายละเอียด - ข่าว', '20210818131636.jpg', '2021-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `pro_id` int(11) NOT NULL,
  `pro_title` varchar(255) NOT NULL,
  `pro_detail` text NOT NULL,
  `pro_image` varchar(100) NOT NULL,
  `pro_date_start` date NOT NULL,
  `pro_date_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`pro_id`, `pro_title`, `pro_detail`, `pro_image`, `pro_date_start`, `pro_date_end`) VALUES
(1, 'สมาชิก SF+ รับสิทธิ์ซื้อแพ็กเกจ บัตรชมภาพยนตร์ 1 ที่นั่ง พร้อม Popcorn L 1 กล่อง และ น้ำอัดลม ขนาด 32oz. 1 แก้ว', ' เอส เอฟ ขอต้อนรับการกลับมาใช้บริการอีกครั้ง พิเศษสำหรับสมาชิก SF+ รับสิทธิ์ซื้อแพ็กเกจ บัตรชมภาพยนตร์ 1 ที่นั่ง พร้อม Popcorn L 1 กล่อง และน้ำอัดลม ขนาด 32oz. 1 แก้ว (Combo Set L) ในราคาพิเศษ 199 บาท จากราคาปกติ 470 บาท', '20210811014236.jpg', '2021-08-10', '2021-08-31'),
(3, 'SF Popcorn Delivery', '1. LARGE POPCORN (ZIPLOCK 64 oz.) + Seasoning ราคา 150 บาท ซื้อ 1 ถุง ราคา 150 บาท แถมฟรี MEDIUM POPCORN (ZIPLOCK 46 oz.)\r\n2. EXTRA LARGE POPCORN (ZIPLOCK 85 oz.) + Seasoning ราคา 170 บาท ซื้อ 1 ถุงราคา 170 บาท แถมฟรี MEDIUM POPCORN (ZIPLOCK 46 oz.)', '20210811014819.jpg', '2021-08-11', '2021-08-31'),
(4, 'Black Widow Combo Set', 'สินค้าโปรโมชัน : Black Widow Combo Set\r\nประกอบด้วย TASKMASTER BUCKET พร้อมป๊อปคอร์นขนาด 85 Oz. 1 ถัง + แก้วลาย BLACK WIDOW พร้อมน้ำอัดลมขนาด 32 Oz. 1 แก้ว (มี 4 แบบให้เลือกสะสม) ราคา 380 บาท/ชุด', '20210811014954.jpg', '2021-08-17', '2021-09-30'),
(5, 'Fast & Furious 9 Combo Set', 'สินค้าโปรโมชัน : Fast & Furious 9 Combo Set\r\nประกอบด้วย : ป๊อปคอร์น ขนาด 85 Oz. จำนวน 1 ถัง + Spinning Rim Lid Cup พร้อมน้ำอัดลม ขนาด 32 Oz. 1 แก้ว ราคาชุดละ 299 บาท', '20210811015023.jpg', '2021-08-10', '2021-09-15'),
(6, 'Minions The Rise Of Gru - Goggles Bucket Combo Set', 'สินค้าโปรโมชัน :  Minions The Rise Of Gru - Goggles Bucket Combo Set\r\nประกอบด้วย : Goggles Popcorn Bucket (แว่นสามารถถอดได้) พร้อมป๊อปคอร์นขนาด 64 Oz 1 ชิ้น และน้ำอัดลมขนาด 32 Oz. 1 แก้ว ราคา 369 บาท/ชุด\r\n\r\nสินค้าโปรโมชัน : Minions The Rise Of Gru – Totem Cup Combo Set\r\nประกอบด้วย : Totem Cup พร้อมน้ำอัดลมขนาด 32 Oz. 1 แก้ว และป๊อปคอร์นขนาด 85 Oz. 1 ถัง ราคา 349 บาท/ชุด ', '20210818125709.jpg', '2021-08-18', '2021-09-30'),
(7, 'Mashita Singha Combo Set', 'สินค้าโปรโมชัน : Mashita Singha Combo Set\r\nประกอบด้วย : ป๊อปคอร์น 64 ออนซ์ 1 กล่อง + น้ำอัดลม 32 ออนซ์ 1 แก้ว + มาชิตะ 30 กรัม 1 ซอง + น้ำสิงห์ 750 ml. 1 ขวด\r\nหมายเหตุ : ราคาอาจเปลี่ยนแปลงขึ้นอยู่กับแต่ละสาขา', '20210818125752.jpg', '2021-08-18', '2021-09-30'),
(8, 'สมาชิก RABBIT REWARDS ใช้คะแนนสะสมแลกรับส่วนลดบัตรชมภาพยนตร์ 100 บาท / 1 ที่นั่ง', 'สมาชิก RABBIT REWARDS ใช้คะแนน RABBIT REWARDS แลกรับส่วนลดบัตรชมภาพยนตร์ 100 บาท / 1 ที่นั่ง สำหรับรับชมภาพยนตร์ประเภทที่นั่ง DELUXE SEAT , PREMIUM SEAT และ PRIME SEAT ในระบบ 2D ทุกเรื่อง ทุกรอบ ', '20210818130003.jpg', '2021-08-20', '2021-09-30'),
(9, 'หัวข้อ - โปรโมชัน', 'ราละเอียด - โปรโมชัน', '20210818130924.jpg', '2021-08-18', '2021-08-31'),
(10, 'หัวข้อ - โปรโมชัน', 'รายละเอีย - โปรโมชัน', '20210818130945.jpg', '2021-08-19', '2021-08-31'),
(11, 'หัวข้อ - โปรโมชัน', 'ราละเอียด - โปรโมชัน', '20210818131012.jpg', '2021-08-20', '2021-09-30'),
(12, 'หัวข้อ - โปรโมชัน', 'รายละเอียด - โปรโมชัน', '20210818131141.jpg', '2021-08-18', '2021-10-30'),
(13, 'หัวข้อ - โปรโมชัน', 'รายละเอียด - โปรโมชัน', '20210818131212.jpg', '2021-08-18', '2021-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `reg_id` int(11) NOT NULL,
  `reg_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`reg_id`, `reg_name`) VALUES
(1, 'กรุงเทพและปริมณฑล'),
(2, 'ภาคกลาง'),
(3, 'ภาคเหนือ'),
(4, 'ภาคตะวันออกเฉียงเหนือ'),
(5, 'ภาคตะวันออก'),
(6, 'ภาคใต้');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `tic_id` int(11) NOT NULL,
  `sale_date_mark` date NOT NULL,
  `sale_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `mem_id`, `tic_id`, `sale_date_mark`, `sale_status`) VALUES
(4, 2, 9, '2021-08-18', '1'),
(5, 2, 10, '2021-08-18', '1'),
(6, 2, 11, '2021-08-18', '1'),
(7, 1, 12, '2021-08-18', '1'),
(8, 2, 13, '2021-08-18', '1');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `seat_id` int(11) NOT NULL,
  `cin_id` int(11) NOT NULL,
  `seat_type_id` int(11) NOT NULL,
  `seat_row` varchar(3) NOT NULL,
  `seat_amount` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seat_id`, `cin_id`, `seat_type_id`, `seat_row`, `seat_amount`) VALUES
(2, 1, 2, 'A', '13'),
(3, 1, 1, 'B', '15'),
(4, 1, 1, 'C', '15'),
(7, 6, 2, 'A', '10'),
(8, 6, 1, 'B', '15'),
(9, 6, 1, 'C', '15'),
(10, 6, 1, 'D', '15'),
(11, 6, 1, 'E', '15'),
(12, 1, 1, 'D', '15'),
(13, 7, 2, 'A', '10'),
(14, 7, 1, 'B', '15'),
(15, 7, 1, 'C', '15'),
(16, 7, 1, 'D', '15'),
(17, 2, 2, 'A', '10'),
(18, 2, 1, 'B', '15'),
(19, 2, 1, 'C', '15'),
(20, 2, 1, 'D', '15'),
(22, 3, 2, 'A', '10'),
(23, 3, 1, 'B', '15'),
(24, 3, 1, 'C', '15'),
(25, 3, 1, 'D', '15'),
(26, 1, 1, 'E', '15'),
(28, 10, 2, 'A', '10'),
(29, 10, 1, 'B', '15'),
(30, 10, 1, 'C', '15'),
(31, 10, 1, 'D', '15'),
(32, 10, 1, 'E', '15'),
(33, 11, 2, 'A', '10'),
(34, 11, 1, 'B', '15'),
(35, 11, 1, 'C', '15'),
(36, 11, 1, 'D', '15'),
(37, 11, 1, 'E', '15'),
(38, 11, 1, 'F', '15');

-- --------------------------------------------------------

--
-- Table structure for table `seat_type`
--

CREATE TABLE `seat_type` (
  `seat_type_id` int(11) NOT NULL,
  `seat_type_name` varchar(50) NOT NULL,
  `seat_type_price` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seat_type`
--

INSERT INTO `seat_type` (`seat_type_id`, `seat_type_name`, `seat_type_price`) VALUES
(1, 'Deluxe Seat', '120'),
(2, 'Premium Seat', '160');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `tic_id` int(11) NOT NULL,
  `cyc_id` int(11) NOT NULL,
  `seat` varchar(255) NOT NULL,
  `time` varchar(5) NOT NULL,
  `tic_price` float NOT NULL,
  `tic_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`tic_id`, `cyc_id`, `seat`, `time`, `tic_price`, `tic_status`) VALUES
(9, 10, 'C7, C8', '09:40', 240, '1'),
(10, 17, 'A5', '22:40', 140, '1'),
(11, 11, 'D5', '13:15', 120, '1'),
(12, 11, 'B6', '13:15', 120, '1'),
(13, 10, 'B7, B8, B6', '00:05', 360, '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_user` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_surname` varchar(100) NOT NULL,
  `user_tel` varchar(10) NOT NULL,
  `user_status` char(1) NOT NULL COMMENT 'admin, employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `branch_id`, `user_user`, `user_pass`, `user_name`, `user_surname`, `user_tel`, `user_status`) VALUES
(1, 1, 'employee1', '1234', 'ล้อมพงศ์', 'สำราญชื่น', '0888888888', '0'),
(2, 2, 'employee2', '1234', 'นายสอง', 'สามสี่', '099999999', '0'),
(3, 3, 'employee3', '1234', 'นายหนึ่ง', 'สองสาม', '0911111111', '0'),
(4, 4, 'employee4', '1234', 'นางสาวสาม', 'สี่ห้า', '0922222222', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`cin_id`);

--
-- Indexes for table `cycle_detail`
--
ALTER TABLE `cycle_detail`
  ADD PRIMARY KEY (`cyc_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`mov_id`);

--
-- Indexes for table `movie_type`
--
ALTER TABLE `movie_type`
  ADD PRIMARY KEY (`mov_type_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`new_id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`seat_id`);

--
-- Indexes for table `seat_type`
--
ALTER TABLE `seat_type`
  ADD PRIMARY KEY (`seat_type_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`tic_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cinema`
--
ALTER TABLE `cinema`
  MODIFY `cin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cycle_detail`
--
ALTER TABLE `cycle_detail`
  MODIFY `cyc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `mov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `movie_type`
--
ALTER TABLE `movie_type`
  MODIFY `mov_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `seat_type`
--
ALTER TABLE `seat_type`
  MODIFY `seat_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `tic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
