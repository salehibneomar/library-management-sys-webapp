-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2020 at 08:28 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssb280_library_management_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `b_id` bigint(20) NOT NULL,
  `b_title` varchar(250) NOT NULL,
  `b_published_year` varchar(20) NOT NULL,
  `b_author` mediumtext NOT NULL,
  `b_language` varchar(100) NOT NULL,
  `b_publication` varchar(250) NOT NULL,
  `b_image` longtext NOT NULL,
  `b_category_id` int(11) NOT NULL,
  `b_added_by` int(11) NOT NULL,
  `b_status` varchar(20) NOT NULL,
  `b_date_added` date NOT NULL,
  `b_quantity` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`b_id`, `b_title`, `b_published_year`, `b_author`, `b_language`, `b_publication`, `b_image`, `b_category_id`, `b_added_by`, `b_status`, `b_date_added`, `b_quantity`) VALUES
(6, 'জুযউ রফইল ইয়াদায়ন ফিস সালাত', '2018', 'ইমাম মুহাম্মদ ইবনে ইসমাইল বোখারী (র)', 'Bangla', 'তাওহীদ পাবলিকেশন', 'W7145_20201110_213748_b9461539e_77782.png', 19, 1, 'public', '2020-11-10', 20),
(7, 'মনের উপর লাগাম', '2017', 'আল্লামা হাফিয ইবনুল কায়্যিম আল জাওযী,মাসুদ শরীফ', 'Bangla', 'ওয়াফি পাবলিকেশন', 'M3414_20201110_134352_03a86d799_155548.jpg', 19, 1, 'public', '2020-11-10', 10),
(8, 'প্রোগ্রামিং কনটেস্ট ডেটা স্ট্রাকচার ও অ্যালগরিদম', '2016', 'মো: মাহবুবুল হাসান', 'Bangla', 'দ্বিমিক প্রকাশনী', 'K8108_20201110_161731_4f33a1d957d4_117663.jpg', 20, 3, 'public', '2020-11-10', 50),
(9, 'The Girl in Room 105', '2018', 'Chetan Bhagat', 'English', 'Westland', 'C6926_20201110_170755_f12700521_171171.jpg', 25, 2, 'public', '2020-11-10', 6),
(10, 'As You Like It', '2004', 'William Shakespeare', 'English', 'Rupa Publications', 'D6014_20201110_171046_0b0444b27_118371.jpg', 24, 2, 'public', '2020-11-10', 30),
(11, 'শূন্য', '2010', 'হুমায়ূন আহমেদ', 'Bangla', 'সময় প্রকাশন', 'C2785_20201110_171821_img141201_1336.jpg', 5, 2, 'public', '2020-11-10', 29),
(12, 'নিয়ান', '2019', 'মুহম্মদ জাফর ইকবাল', 'Bangla', 'তাম্রলিপি', 'D4032_20201110_171948_5a1c96358_177052.jpg', 5, 2, 'public', '2020-11-10', 15),
(13, 'ময়াল', '2020', 'মুনির হাসান', 'Bangla', 'তাম্রলিপি', 'T2860_20201110_172123_2a06825e2_195359.png', 5, 2, 'public', '2020-11-10', 12),
(14, 'এইচ.এস.সি হ্যাকস: শর্টকাট সাজেশন', '2020', 'মনির উদ্দিন তামিম', 'Bangla', 'নিউরন প্লাস পাবলিকেশন', 'I7724_20201110_172246_2b14e3d5a_195483.png', 27, 2, 'hidden', '2020-11-10', 120),
(15, 'HSC Vocabulary Builder', '2019', 'Tahmid Hasan', 'English', 'Grammar World', 'W8750_20201110_175704_304162785_192911.png', 28, 4, 'public', '2020-11-10', 20),
(16, 'উচ্চতর গণিত-প্রথম পত্র', '2020', 'মোঃ কেতাব উদ্দীন,মোঃ নজরুল ইসলাম', 'Bangla', 'এস. কে. এল. পাবলিকেশন', 'M8471_20201110_175905_236f56496_101715.jpg', 27, 4, 'public', '2020-11-10', 2),
(17, 'পদার্থবিজ্ঞান-২য় পত্র', '2019', 'ড. শাহজাহান তপন,মুহম্মদ আজিজ হাসান,ড. রানা চৌধুরী', 'Bangla', 'হাসান বুক হাউস', 'S7137_20201110_180058_36c7f3d77_70423.png', 27, 4, 'public', '2020-11-10', 4),
(18, 'জীববিজ্ঞান-১ম পত্র', '2019', 'ড. মোহাম্মদ আবুল হাসান', 'Bangla', 'হাসান বুক হাউস', 'I4225_20201110_180201_65ea81b6e954_69059.jpg', 27, 4, 'public', '2020-11-10', 8),
(19, 'Essentials Of Human Anatomy: Part- 1:Thorax And Abdomen', '2014', 'Asim Kumar Datta', 'English', 'CBS', 'R4220_20201110_180331_a498ae50d_75619.jpg', 2, 4, 'public', '2020-11-10', 0),
(20, 'Test book', '1002', 'saleh', 'English', 'test', 'U1536_20201112_210856_female_avatar.png', 2, 1, 'hidden', '2020-11-12', 6);

-- --------------------------------------------------------

--
-- Table structure for table `book_borrow`
--

CREATE TABLE `book_borrow` (
  `br_id` bigint(20) NOT NULL,
  `br_book_ids` varchar(250) NOT NULL,
  `br_requested_by` int(11) NOT NULL,
  `br_managed_by` int(11) DEFAULT NULL,
  `br_request_date` date NOT NULL,
  `br_from_date` date NOT NULL,
  `br_to_date` date NOT NULL,
  `br_total` int(3) NOT NULL,
  `br_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_borrow`
--

INSERT INTO `book_borrow` (`br_id`, `br_book_ids`, `br_requested_by`, `br_managed_by`, `br_request_date`, `br_from_date`, `br_to_date`, `br_total`, `br_status`) VALUES
(2, '17,18', 4, 1, '2020-11-12', '2020-11-12', '2020-11-14', 2, 'not returned'),
(3, '13', 5, NULL, '2020-11-12', '2020-11-11', '2020-11-14', 1, 'returned'),
(4, '11,8', 6, NULL, '2020-11-12', '2020-11-12', '2020-11-15', 2, 'returned'),
(5, '15', 6, NULL, '2020-11-12', '2020-11-11', '2020-11-13', 1, 'returned');

-- --------------------------------------------------------

--
-- Stand-in structure for view `book_borrow_view`
-- (See below for the actual view)
--
CREATE TABLE `book_borrow_view` (
`br_id` bigint(20)
,`br_book_ids` varchar(250)
,`br_requested_by` int(11)
,`br_managed_by` int(11)
,`br_request_date` date
,`br_from_date` date
,`br_to_date` date
,`br_total` int(3)
,`br_status` varchar(20)
,`br_u_name` varchar(150)
);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(250) NOT NULL,
  `cat_status` varchar(20) NOT NULL,
  `cat_parent` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`cat_id`, `cat_name`, `cat_status`, `cat_parent`) VALUES
(2, 'Medical', 'active', 0),
(3, 'Religion', 'active', 0),
(4, 'Science', 'active', 0),
(5, 'Science Fiction', 'active', 31),
(7, 'History', 'active', 0),
(8, 'Sports', 'active', 0),
(11, 'SSC', 'active', 0),
(16, 'Engineering', 'active', 0),
(17, 'CSE', 'active', 16),
(18, 'EEE', 'active', 16),
(19, 'Islam', 'active', 3),
(20, 'Computer Programming', 'active', 0),
(24, 'Drama', 'active', 32),
(25, 'Novel', 'active', 32),
(26, 'HSC', 'active', 0),
(27, 'Science', 'active', 26),
(28, 'English', 'active', 26),
(30, 'ICT', 'active', 26),
(31, 'Bangla', 'active', 0),
(32, 'English', 'active', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `book_category_view`
-- (See below for the actual view)
--
CREATE TABLE `book_category_view` (
`cat_id` int(11)
,`cat_name` varchar(250)
,`cat_status` varchar(20)
,`cat_parent` int(11)
,`cat_parent_name` varchar(250)
,`cat_parent_status` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `book_view`
-- (See below for the actual view)
--
CREATE TABLE `book_view` (
`b_id` bigint(20)
,`b_title` varchar(250)
,`b_published_year` varchar(20)
,`b_author` mediumtext
,`b_language` varchar(100)
,`b_publication` varchar(250)
,`b_image` longtext
,`b_category_id` int(11)
,`b_added_by` int(11)
,`b_status` varchar(20)
,`b_date_added` date
,`b_quantity` int(6)
,`b_cat_name` varchar(250)
,`b_added_by_name` varchar(150)
,`b_cat_parent_name` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `library_management`
--

CREATE TABLE `library_management` (
  `mgt_id` int(11) NOT NULL,
  `mgt_name` varchar(150) NOT NULL,
  `mgt_gender` varchar(20) NOT NULL,
  `mgt_dob` date NOT NULL,
  `mgt_email` varchar(250) NOT NULL,
  `mgt_phone` varchar(30) NOT NULL,
  `mgt_pass` varchar(250) NOT NULL,
  `mgt_role` varchar(30) NOT NULL,
  `mgt_status` varchar(20) NOT NULL,
  `mgt_joined_date` date NOT NULL,
  `mgt_profile_image` text NOT NULL,
  `mgt_present_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `library_management`
--

INSERT INTO `library_management` (`mgt_id`, `mgt_name`, `mgt_gender`, `mgt_dob`, `mgt_email`, `mgt_phone`, `mgt_pass`, `mgt_role`, `mgt_status`, `mgt_joined_date`, `mgt_profile_image`, `mgt_present_address`) VALUES
(1, 'Saleh Ibne Omar', 'male', '1996-05-22', 'saleh@gmail.com', '01611332774', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin', 'active', '2020-11-08', 'B6083_20201108_204738_saleh.jpg', 'Gulshan Model Town'),
(2, 'Muntasir Pranto', 'male', '1998-01-01', 'pranto@gmail.com', '01800000000', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin', 'active', '2020-11-08', 'W1897_20201108_220640_pranto.jpg', 'Mohakhali, Dhaka'),
(3, 'Rikuo Nura', 'male', '1999-02-01', 'nura@gmail.com', '01600000001', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'editor', 'active', '2020-11-08', 'R2640_20201108_220854_nura.jpg', 'Uttara, Dhaka'),
(4, 'Orihime Inone', 'female', '1999-11-01', 'orihime@gmail.com', '01300000000', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'editor', 'active', '2020-11-08', 'N2413_20201108_221205_orihime-and-rukia_215380_top_full.jpg', 'Baridhara, Dhaka'),
(6, 'Lee DK', 'male', '1985-01-09', 'lee@gmail.com', '01100000000', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'editor', 'inactive', '2020-11-09', 'A6915_20201108_230911_lee_dk.jpg', 'Rampura, Dhaka'),
(19, 'Test', 'female', '2020-11-12', 'boot@gmail.com', '123456789', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'editor', 'active', '2020-11-12', 'T6013_20201112_211742_female_avatar.png', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `library_management_notification`
--

CREATE TABLE `library_management_notification` (
  `mgt_nid` bigint(20) NOT NULL,
  `mgt_ntitle` varchar(250) DEFAULT NULL,
  `mgt_ntype` int(2) NOT NULL COMMENT '1 = Editor request\r\n2 = Book request\r\n3 = Member request',
  `mgt_nstatus` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `library_management_notification`
--

INSERT INTO `library_management_notification` (`mgt_nid`, `mgt_ntitle`, `mgt_ntype`, `mgt_nstatus`) VALUES
(4, NULL, 1, 1),
(5, NULL, 3, 1),
(6, NULL, 3, 1),
(7, NULL, 3, 1),
(8, NULL, 3, 1),
(14, NULL, 2, 1),
(15, NULL, 2, 1),
(16, NULL, 1, 1),
(17, NULL, 1, 1),
(18, NULL, 3, 1),
(19, NULL, 2, 1),
(20, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `library_user`
--

CREATE TABLE `library_user` (
  `u_id` bigint(20) NOT NULL,
  `u_name` varchar(150) NOT NULL,
  `u_gender` varchar(10) NOT NULL,
  `u_dob` date NOT NULL,
  `u_email` varchar(250) NOT NULL,
  `u_phone` varchar(30) NOT NULL,
  `u_pass` varchar(250) NOT NULL,
  `u_image` text NOT NULL,
  `u_joined_date` date NOT NULL,
  `u_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `library_user`
--

INSERT INTO `library_user` (`u_id`, `u_name`, `u_gender`, `u_dob`, `u_email`, `u_phone`, `u_pass`, `u_image`, `u_joined_date`, `u_status`) VALUES
(2, 'Sosuke Aizen', 'male', '1980-01-01', 'aizen@gmail.com', '01234567891', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'T8259_20201112_005056_aizen.jpg', '2020-11-12', 'inactive'),
(3, 'Seto Kaiba', 'male', '1990-11-01', 'kaiba@gmail.com', '012345678912', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'L1515_20201112_005302_b1ace08b9a633a3750e4234735c23278.jpg', '2020-11-12', 'active'),
(4, 'Roy Mustang', 'male', '1985-10-10', 'roy@gmail.com', '12345678912', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'D8230_20201112_005505_6e06d9ed9f7093fd3ad02efa5fd6443f.jpg', '2020-11-12', 'active'),
(5, 'Yoo In Na', 'female', '1982-06-05', 'yoona@gmail.com', '01478896542', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'B9830_20201112_005859_in-na-new-nm.jpg', '2020-11-12', 'active'),
(6, 'Kim Yoo Jung', 'female', '1999-09-22', 'yoojung@gmail.com', '01300012345', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'O7782_20201112_010201_kimyoojung.jpg', '2020-11-12', 'active'),
(7, 'Lucy Heartfilia', 'female', '1997-11-04', 'lucy@gmail.com', '01400000000', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'O4452_20201112_010352_unnamed.jpg', '2020-11-12', 'active'),
(8, 'Test', 'female', '2020-11-12', 'boot@gmail.com', '123456789', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Q9880_20201112_212135_female_avatar.png', '2020-11-12', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `library_user_fine`
--

CREATE TABLE `library_user_fine` (
  `f_id` bigint(20) NOT NULL,
  `f_amount` int(11) NOT NULL,
  `f_date` date NOT NULL,
  `f_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `library_user_notification`
--

CREATE TABLE `library_user_notification` (
  `u_nid` bigint(20) NOT NULL,
  `u_ntitle` varchar(250) DEFAULT NULL,
  `u_ntype` varchar(20) NOT NULL,
  `u_nstatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `book_borrow_view`
--
DROP TABLE IF EXISTS `book_borrow_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `book_borrow_view`  AS  select `br`.`br_id` AS `br_id`,`br`.`br_book_ids` AS `br_book_ids`,`br`.`br_requested_by` AS `br_requested_by`,`br`.`br_managed_by` AS `br_managed_by`,`br`.`br_request_date` AS `br_request_date`,`br`.`br_from_date` AS `br_from_date`,`br`.`br_to_date` AS `br_to_date`,`br`.`br_total` AS `br_total`,`br`.`br_status` AS `br_status`,`u`.`u_name` AS `br_u_name` from (`book_borrow` `br` join `library_user` `u`) where `br`.`br_requested_by` = `u`.`u_id` ;

-- --------------------------------------------------------

--
-- Structure for view `book_category_view`
--
DROP TABLE IF EXISTS `book_category_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `book_category_view`  AS  select `c1`.`cat_id` AS `cat_id`,`c1`.`cat_name` AS `cat_name`,`c1`.`cat_status` AS `cat_status`,`c1`.`cat_parent` AS `cat_parent`,`c2`.`cat_name` AS `cat_parent_name`,`c2`.`cat_status` AS `cat_parent_status` from (`book_category` `c1` left join `book_category` `c2` on(`c1`.`cat_parent` = `c2`.`cat_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `book_view`
--
DROP TABLE IF EXISTS `book_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `book_view`  AS  select `b`.`b_id` AS `b_id`,`b`.`b_title` AS `b_title`,`b`.`b_published_year` AS `b_published_year`,`b`.`b_author` AS `b_author`,`b`.`b_language` AS `b_language`,`b`.`b_publication` AS `b_publication`,`b`.`b_image` AS `b_image`,`b`.`b_category_id` AS `b_category_id`,`b`.`b_added_by` AS `b_added_by`,`b`.`b_status` AS `b_status`,`b`.`b_date_added` AS `b_date_added`,`b`.`b_quantity` AS `b_quantity`,`c`.`cat_name` AS `b_cat_name`,`m`.`mgt_name` AS `b_added_by_name`,`c2`.`cat_name` AS `b_cat_parent_name` from (((`book` `b` join `book_category` `c`) join `library_management` `m`) left join `book_category` `c2` on(`c`.`cat_parent` = `c2`.`cat_id`)) where `b`.`b_category_id` = `c`.`cat_id` and `c`.`cat_status` = 'active' and `m`.`mgt_id` = `b`.`b_added_by` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `book_borrow`
--
ALTER TABLE `book_borrow`
  ADD PRIMARY KEY (`br_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `library_management`
--
ALTER TABLE `library_management`
  ADD PRIMARY KEY (`mgt_id`);

--
-- Indexes for table `library_management_notification`
--
ALTER TABLE `library_management_notification`
  ADD PRIMARY KEY (`mgt_nid`);

--
-- Indexes for table `library_user`
--
ALTER TABLE `library_user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `library_user_fine`
--
ALTER TABLE `library_user_fine`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `library_user_notification`
--
ALTER TABLE `library_user_notification`
  ADD PRIMARY KEY (`u_nid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `b_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `book_borrow`
--
ALTER TABLE `book_borrow`
  MODIFY `br_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `library_management`
--
ALTER TABLE `library_management`
  MODIFY `mgt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `library_management_notification`
--
ALTER TABLE `library_management_notification`
  MODIFY `mgt_nid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `library_user`
--
ALTER TABLE `library_user`
  MODIFY `u_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `library_user_fine`
--
ALTER TABLE `library_user_fine`
  MODIFY `f_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `library_user_notification`
--
ALTER TABLE `library_user_notification`
  MODIFY `u_nid` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
