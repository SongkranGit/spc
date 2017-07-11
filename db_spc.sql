/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_spc

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-06-09 07:52:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(5) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `title_th` varchar(1000) DEFAULT NULL,
  `title_en` varchar(1000) DEFAULT NULL,
  `body_th` text,
  `body_en` text,
  `published_date` datetime NOT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `order_seq` tinyint(3) DEFAULT NULL,
  `published` bit(1) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articles
-- ----------------------------

-- ----------------------------
-- Table structure for articles_categories
-- ----------------------------
DROP TABLE IF EXISTS `articles_categories`;
CREATE TABLE `articles_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_th` varchar(50) DEFAULT NULL,
  `name_en` varchar(50) DEFAULT NULL,
  `is_deleted` bit(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articles_categories
-- ----------------------------
INSERT INTO `articles_categories` VALUES ('1', 'เกี่ยวกับเรา', 'About Us', '\0');
INSERT INTO `articles_categories` VALUES ('2', 'สูตรพิชิต', 'Achivement Plan', '\0');

-- ----------------------------
-- Table structure for clips
-- ----------------------------
DROP TABLE IF EXISTS `clips`;
CREATE TABLE `clips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `youtube_link` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `published` bit(1) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `description_th` text,
  `description_en` text,
  `order_seq` tinyint(3) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clips
-- ----------------------------
INSERT INTO `clips` VALUES ('1', 'https://youtu.be/PRW0GUWkFtA', '', '2016-05-27 14:40:57', 'กดเหกดเหกดเหกดเหกดเหกดเdsasdfasfasdfasdfasdf', 'กดเหกหกดเหกดเหกดเหกดเหกเหกเดหกเกหดเหกกasdfasdfasdfasdfasdf', '15', '2016-05-27 22:09:58', '1');
INSERT INTO `clips` VALUES ('2', 'https://youtu.be/tDn3XYpn40A', '', '2016-05-27 15:09:01', 'สหกด่าสฟห่กสด่ฟกาหด', 'asdfasdfasdfasdfasdf', '3', '2016-05-27 15:54:05', '1');
INSERT INTO `clips` VALUES ('3', 'https://youtu.be/ICwy7_9bnkQ', '', '2016-05-27 21:51:47', 'sdfasdfasdf', 'asdfasdfasdf', '2', '2016-05-27 21:51:47', '0');
INSERT INTO `clips` VALUES ('4', 'https://youtu.be/AxX0Mm7ss_Q', '', '2016-06-06 15:29:28', 'หหกดฟหกดฟหกดฟหกดฟหกดฟ', 'lsdjfklajdflasjdflajsldfkasdfasdf', null, '2016-06-06 15:29:28', '0');
INSERT INTO `clips` VALUES ('5', 'https://youtu.be/iTC-quaJzoA', '', '2016-06-06 15:30:09', 'fasdfasdf', 'asdfasdfasd', '4', '2016-06-06 15:30:09', '0');

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `education` varchar(50) DEFAULT NULL,
  `age` int(2) DEFAULT NULL,
  `message` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES ('1', 'sdfsdf', 'bsongkran_167@hotmail.com', '7', '5', '', '2016-05-03 19:54:37', null);
INSERT INTO `contacts` VALUES ('2', 'sdfasdf', 'demos@softaculous.com', '7', '5', '', '2016-05-03 19:55:20', null);
INSERT INTO `contacts` VALUES ('3', 'sdfsdf', 'demos@softaculous.com', '9', '565', '', '2016-05-03 19:56:03', null);
INSERT INTO `contacts` VALUES ('4', 'sdfsdf', 'demos@softaculous.com', '9', '565', '', '2016-05-03 19:56:05', null);
INSERT INTO `contacts` VALUES ('5', 'sdfsdf', 'demos@softaculous.com', '9', '565', '', '2016-05-03 19:56:41', null);
INSERT INTO `contacts` VALUES ('6', 'sdfasd', 'bsongkran167@gmail.com', '0', '55', '', '2016-05-03 19:56:50', null);
INSERT INTO `contacts` VALUES ('7', 'sdfsdf', 'demos@softaculous.com', '0', '3', '', '2016-05-03 19:57:55', null);
INSERT INTO `contacts` VALUES ('8', 'sdfasdf', 'demos@softaculous.com', '0', '33', '', '2016-05-03 19:58:49', null);
INSERT INTO `contacts` VALUES ('9', 'sdfasdfas', 'bsongkran_167@hotmail.com', '16', '55', '', '2016-05-03 19:59:25', null);
INSERT INTO `contacts` VALUES ('10', 'sdfasdf', 'bsongkran_167@hotmail.com', '17', '22', '', '2016-05-03 20:01:16', null);
INSERT INTO `contacts` VALUES ('11', 'sdfasdf', 'demos@softaculous.com', '15', '52', '', '2016-05-03 20:02:26', null);
INSERT INTO `contacts` VALUES ('12', 'sdfsadf', 'demos@softaculous.com', '11', '55', '', '2016-05-03 20:05:18', null);
INSERT INTO `contacts` VALUES ('13', 'sdf', 'demos@softaculous.com', '0', '55', '', '2016-05-03 20:05:53', null);
INSERT INTO `contacts` VALUES ('14', 'sdfasdf', 'demos@softaculous.com', '18', '66', '', '2016-05-03 20:09:55', null);
INSERT INTO `contacts` VALUES ('15', 'sdf', 'bsongkran167@gmail.com', '13', '555', '', '2016-05-03 20:10:20', null);
INSERT INTO `contacts` VALUES ('16', 'sdfasdf', 'bsongkran167@gmail.com', '14', '55', '', '2016-05-03 20:13:48', null);
INSERT INTO `contacts` VALUES ('17', 'asfasdf', 'sfsdfs@sdfsdfa.cpom', '14', '66', 'asdfasdflasklfjalsjdlfjasldjflajsldfjalsjdflajksdfasj;dlfkjalksdjflasdfasdfasdf', '2016-05-03 20:20:49', null);
INSERT INTO `contacts` VALUES ('18', 'ทดสอบ', 'bsongkran167@gmail.com', '13', '56', 'ห่ดสฟ่หสกาด่ฟห่กดฟ่ห่ดฟหสา่ดฟหกดฟหกด', '2016-05-03 20:30:31', null);
INSERT INTO `contacts` VALUES ('19', 'asdfa', 'bsongkran167@gmail.com', '0', '55', 'sdfasd', '2016-05-03 20:32:52', null);
INSERT INTO `contacts` VALUES ('20', 'dfasdf', 'bsongkran167@gmail.com', '0', '5', 'zfaSASFASDFsdfsafsdf', '2016-05-03 20:54:16', null);
INSERT INTO `contacts` VALUES ('21', 'sdfasdf', 'bsongkran_167@hotmail.com', '0', '22', 'sadfasdfasdf', '2016-05-03 20:54:51', null);
INSERT INTO `contacts` VALUES ('22', 'sdfsdfsdf', 'bsongkran_167@hotmail.com', '0', '55', 'sadfasdfasdfasdfasdf', '2016-05-03 21:01:18', null);
INSERT INTO `contacts` VALUES ('23', 'asdfasdf', 'bsongkran_167@hotmail.com', '0', '22', 'sdfasdfasdf', '2016-05-03 21:04:12', null);
INSERT INTO `contacts` VALUES ('24', 'sdfasdf', 'bsongkran167@gmail.com', '0', '8', 'sdfasdfasdf', '2016-05-03 22:05:06', null);
INSERT INTO `contacts` VALUES ('25', 'sdfsdf', 'bsongkran_167@hotmail.com', '0', '5', 'sadfasdfasdfasdfsdf', '2016-05-03 22:07:55', null);
INSERT INTO `contacts` VALUES ('26', 'sdfsdf', 'bsongkran_167@hotmail.com', '0', '22', 'sdfasdfasdfsad', '2016-05-03 22:09:18', null);
INSERT INTO `contacts` VALUES ('27', 'sdfsdfasdf', 'bsongkran167@gmail.com', '0', '5', 'sdfasdfasd', '2016-05-04 05:38:32', null);
INSERT INTO `contacts` VALUES ('28', 'sdfsdfsd', 'bsongkran_167@hotmail.com', '16', '5', 'sdfasdfasdf', '2016-05-04 05:39:02', null);
INSERT INTO `contacts` VALUES ('29', 'sdfasdfasdf', 'bsongkran_167@hotmail.com', '11', '5', 'sdfasdfasdf', '2016-05-04 05:39:27', null);
INSERT INTO `contacts` VALUES ('30', 'sfasdfas', 'demos@softaculous.com', '0', '3', 'sdfs', '2016-05-04 06:00:52', null);

-- ----------------------------
-- Table structure for educations
-- ----------------------------
DROP TABLE IF EXISTS `educations`;
CREATE TABLE `educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_th` varchar(50) DEFAULT NULL,
  `education_en` varchar(50) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of educations
-- ----------------------------
INSERT INTO `educations` VALUES ('1', 'อนุบาล', 'Kindergarten', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('2', 'เตรียมประถม', 'Pre-elementary school', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('3', 'โรงเรียนระดับประถมศึกษา', 'Primary School / Elemantary School', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('4', 'ชั้น ป. 1 - ป. 6', 'Grade 1-6', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('5', 'โรงเรียนระดับมัธยมศึกษา', 'Secondary School / High School', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('6', '	\r\nชั้น ม. 1 - ม. 6', 'Grade 7-12', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('7', 'ชั้นมัธยมศึกษาตอนต้น (เทียบเท่า)', 'Middle School (Grade 6-8)', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('8', 'ชั้นมัธยมศึกษาตอนต้น', 'Junior High School', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('9', 'ชั้นมัธยมศึกษาตอนปลาย', 'Senior High School', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('10', 'ปวช. (ประกาศนียบัตรวิชาชีพ)', 'Vocational Certificate', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('11', 'ปวส. (ประกาศนียบัตรวิชาชีพชั้นสูง)', 'High Vocational Certificate', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('12', '	\r\nปวท. (ประกาศนียบัตรวิชาชีพเทคนิค)', 'Technical Certificate', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('13', 'การศึกษานอกโรงเรียน (กศน.)', 'Non-Formal Education', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('14', 'การศึกษาภาคบังคับ', 'Compulsory Education', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('15', '	\r\nการศึกษาผู้ใหญ่', 'Adult Education', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('16', 'วิทยาลัยเทคนิค', 'Technical College', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('17', 'วิทยาลัยสารพัดช่าง', 'Polytechnic School', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('18', 'ปริญญาตรี', 'B.A. (Bachelor of Arts)', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('19', 'ปริญญาโท', 'M.A. (Master of Arts)', '0000-00-00 00:00:00');
INSERT INTO `educations` VALUES ('20', 'ปริญญาเอก', 'Ph.D. (Doctor of Philosophy)', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for galleries
-- ----------------------------
DROP TABLE IF EXISTS `galleries`;
CREATE TABLE `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `published` bit(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of galleries
-- ----------------------------
INSERT INTO `galleries` VALUES ('1', null, 'เข้ารับมอบงาน', 'asdfasdf333333333333', '', '2016-05-04 21:52:09', '2016-05-09 22:45:38', '0');
INSERT INTO `galleries` VALUES ('2', null, 'งานแต่งงาน', 'sdfasdfasdfasdfasdfasdf', '', '2016-05-04 21:54:20', '2016-05-09 22:45:14', '0');
INSERT INTO `galleries` VALUES ('3', null, 'รูปภาพงานบุญ', '333333333333333333333333333', '', '2016-05-04 21:57:52', '2016-05-09 22:45:00', '0');
INSERT INTO `galleries` VALUES ('4', null, 'sdfasdfasf', 'sdfasdfasdfassfasdfasdf', '', '2016-05-28 22:43:23', '2016-05-28 22:43:23', '1');
INSERT INTO `galleries` VALUES ('5', null, 'หกดหกดกหดกห', 'ดฟหกดฟหกดฟหกด', '', '2016-05-28 22:44:14', '2016-05-28 22:44:14', '0');

-- ----------------------------
-- Table structure for galleries_images
-- ----------------------------
DROP TABLE IF EXISTS `galleries_images`;
CREATE TABLE `galleries_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `description_th` text,
  `description_en` text,
  `file_name` varchar(255) NOT NULL,
  `order_seq` tinyint(3) DEFAULT NULL,
  `published` bit(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`gallery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of galleries_images
-- ----------------------------
INSERT INTO `galleries_images` VALUES ('96', '1', 'I had the same problem. It is caused by the inclusion of bootstrap-responsive.css (v2.0.3 in my case) and it affects both the proper display of the modal and its edition when you tap the input field and the keyword pops-up. I slightly modified the patch presented in this StackOverflow question with this:', '', 'd825f326-10d3-4650-b377-421cb9ae0f68.jpg', '1', '', '2016-06-03 05:04:44', '2016-06-04 10:44:09');
INSERT INTO `galleries_images` VALUES ('97', '1', 'I had the same problem. It is caused by the inclusion of bootstrap-responsive.css (v2.0.3 in my case) and it affects both the proper display of the modal and its edition when you tap the input field and the keyword pops-up. I slightly modified the patch presented in this StackOverflow question with this:', '', 'c90ba626-c027-45da-8390-1051749d926b.jpg', '1', '', '2016-06-03 05:04:49', '2016-06-04 10:44:04');
INSERT INTO `galleries_images` VALUES ('98', '1', 'I had the same problem. It is caused by the inclusion of bootstrap-responsive.css (v2.0.3 in my case) and it affects both the proper display of the modal and its edition when you tap the input field and the keyword pops-up. I slightly modified the patch presented in this StackOverflow question with this:', '', '71a4f1d7-42e6-4391-9047-23e9110e61c0.JPG', '3', '', '2016-06-03 05:04:56', '2016-06-04 10:43:54');
INSERT INTO `galleries_images` VALUES ('99', '1', 'I had the same problem. It is caused by the inclusion of bootstrap-responsive.css (v2.0.3 in my case) and it affects both the proper display of the modal and its ', 'sdfasdfasfsf', '86f12e5b-ac8b-4a4e-8478-7ec7a76192b6.JPG', '6', '\0', '2016-06-03 05:04:57', '2016-06-05 05:22:23');

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` bit(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES ('1', 'berm', 'bsongkran@hotmail.com', '8787778', 'test title ', '2016-05-13 12:42:04', null, '\0');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` tinyint(1) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `title_en` varchar(2000) DEFAULT NULL,
  `title_th` varchar(2000) DEFAULT NULL,
  `body_th` text,
  `body_en` text,
  `published_date` datetime NOT NULL,
  `published` bit(1) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `order_seq` tinyint(3) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('20', '1', 'ข่าวของฉัน', 'ข่าวของฉันข่าวของฉันข่าวของฉันข่าวของฉันข่าวของฉันข่าวของฉันข่าวของฉัน', 'my news my news my newsmy news my news', '', '', '2016-06-15 00:00:00', '', 'fbfffa94-8282-4de8-af30-baf803cdb94b.jpg', '3', '2016-06-05 18:32:11', '2016-06-05 18:32:11', '0');
INSERT INTO `news` VALUES ('21', '2', 'test', 'english sdfsdfsdfdsf sdfasdfasdfasdfasdf', 'หัวข้อ หัวข้อ หัวข้อ หัวข้อ หัวข้อ หัวข้อ หัวข้อ', '<p>เนื้อหา เนื้อหา เนื้อหา เนื้อหา</p>', '<p><img src=\"http://localhost/spc/assets/uploads/about_us/spc_to_cu_2013.jpg?1465216048933\" alt=\"testsfja;lsdfklasdf\" width=\"400\" height=\"215\" /></p>', '2016-06-06 00:00:00', '', 'fbaa53ee-f37c-40d6-ab61-5b7f2a574660.jpg', '4', '2016-06-06 14:22:24', '2016-06-06 14:27:44', '0');

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `title_th` varchar(100) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `body_th` text NOT NULL,
  `body_en` text NOT NULL,
  `template` varchar(50) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `published` bit(1) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', 'home', 'หน้าแรก', 'Home', '', '', 'home', '1', '0', '', '2016-05-22 13:59:29', '2016-05-22 13:59:29', '0');
INSERT INTO `pages` VALUES ('2', 'news', 'ข่าวสาร', 'Information', '', '', 'home', '8', '0', '', '2016-05-22 14:25:01', '2016-06-04 23:07:56', '0');
INSERT INTO `pages` VALUES ('3', 'achievement', 'ความสำเร็จ', 'Achievement', '', '', 'content', '9', '0', '', '2016-05-22 14:36:28', '2016-06-07 17:35:44', '0');
INSERT INTO `pages` VALUES ('4', 'gallery', 'แกลเลอรี่', 'Gallery', '', '', 'gallery', '10', '0', '\0', '2016-05-22 14:37:47', '2016-06-01 20:08:35', '0');
INSERT INTO `pages` VALUES ('5', 'Aboutus', 'เกี่ยวกับเรา', 'About Us', '', '', 'about_us', '2', '0', '', '2016-05-22 19:20:45', '2016-06-08 17:26:22', '0');
INSERT INTO `pages` VALUES ('6', 'contact_us', 'ติดต่อเรา', 'Contact Us', '<p><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.1538662523453!2d100.65925881531588!3d13.769593100589628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d61817a47ddbf%3A0xa66443fe01f75fe1!2sStudy+Plus+Center!5e0!3m2!1sth!2sth!4v1464097235273\" width=\"100%\" height=\"450\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></p>', '<p><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.1538662523453!2d100.65925881531588!3d13.769593100589628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d61817a47ddbf%3A0xa66443fe01f75fe1!2sStudy+Plus+Center!5e0!3m2!1sth!2sth!4v1464097235273\" width=\"100%\" height=\"450\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></p>', 'contact_us', '13', '0', '', '2016-05-22 19:21:16', '2016-05-24 16:28:13', '0');
INSERT INTO `pages` VALUES ('7', 'course_igcse', 'หลักสูตร IGCSE', 'Course IGCSE', '<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<h2><strong>IGCSE&nbsp; ( International General Certificate for Secondary Education )</strong></h2>\r\n<p><strong>IGCSE &nbsp;</strong>เป็นหลักสูตรนานาชาติระบบอังกฤษ ที่มีความหลากหลายทางด้านวิชาการทั้งแบบ Core&nbsp; และแบบ Extended&nbsp; ในเกือบทุกวิชา&nbsp;&nbsp; จัดทำขึ้นโดย University of Cambridge&nbsp; เพื่อวัดความสามารถของนักเรียนและนักเรียนสามารถเลือกสอบวิชาที่เหมาะสมกับตนเองได้&nbsp;&nbsp;&nbsp; โดยการสอบระดับ Core เป็นระดับความสามารถส่วนใหญ่ของนักเรียนซึ่งจะเป็นเนื้อหาอย่างกว้างๆในแต่ ละวิชาและเกรดที่นักเรียนจะได้รับคือ C, D, E, F, และ G&nbsp;&nbsp;&nbsp;&nbsp; ส่วนการสอบระดับ Extended เป็นการรวบรวมเอาหลักสูตรของ Core และเนื้อหาอื่นๆเข้าไว้ด้วยกันซึ่งในที่นี้หมายถึงการเพิ่มเนื้อหาพิเศษและเฉพาะเจาะจงลงไป&nbsp; และเกรดที่นักเรียนจะได้รับ คือ A, B, C, D, E, F, และ G&nbsp;&nbsp; ในปี ค.ศ. 2009 มีนักเรียนมากกว่า 120 ประเทศทั่วโลกที่เข้าสอบ IGCSE&nbsp;&nbsp; ในวิชาต่างๆมากกว่า 70 วิชา</p>\r\n<p><strong>GCE </strong><strong><em>&nbsp;&nbsp;</em></strong>เป็นหลักสูตรระบบอังกฤษ&nbsp; แต่จัดขึ้นโดย University of London&nbsp; เพื่อวัดความสามารถในหลากหลายวิชาของนักเรียนเช่นกัน&nbsp;&nbsp; ซึ่งในปี 2010 จะเป็นปีสุดท้ายที่มีการจัดสอบ&nbsp; และจะถูกยกเลิกไป</p>\r\n<p>นักเรียนสามารถเลือกสอบได้ตั้งแต่ 5 วิชาขึ้นไปและมีผลสอบในแต่ละวิชาไม่ต่ำกว่า C&nbsp; ของทั้ง&nbsp; IGCSE&nbsp; และ&nbsp; GCE รวมกัน จึงจะสามาถนำไปเทียบวุฒิการศึกษาเทียบเท่ามัธยมศึกษาปีที่ 6 ที่กระทรวงศึกษาธิการได้&nbsp; และสามารถใช้ใบเทียบวุฒิการศึกษานี้สมัครเข้าเรียนต่อในมหาวิทยลัยของรัฐและเอกชนของไทยได้ทุกแห่ง</p>\r\n<p><strong>STUDY PLUS CENTER</strong> &nbsp;จัดสอนเนื้อหาในวิชาที่สอบทุกวิชา&nbsp; พร้อม Past paper (ข้อสอบเก่า) โดยอาจารย์ผู้ทรงคุณวุฒิที่เชี่ยวชาญเฉพาะวิชา&nbsp; <strong><em>เรามีฝ่ายแนะแนวที่จะช่วยให้ความกระจ่างในการเลือกวิชาที่จะสอบกับนักเรียน &nbsp;</em></strong>นักเรียนสามารถเลือกเรียนเป็นรายวิชา&nbsp; แบบตัวต่อตัว&nbsp; คู่ หรือ แบบกลุ่มได้&nbsp; และเมื่อนักเรียนสอบผ่านครบทั้ง 5 วิชาแล้ว&nbsp; ทางสถาบันมีบริการเทียบวุฒิการศึกษาให้เช่นกัน</p>\r\n<p><strong>การสมัครสอบ</strong>&nbsp; สมัครสอบได้ที่ British Council สยามสแควร์ด้วยตนเอง โดยการสอบจะจัดให้มีขึ้น ปีละ&nbsp; 2&nbsp; ครั้ง ในช่วงเดือน พ.ค. - มิ.ย.&nbsp; และ ต.ค. - พ.ย. โดยประมาณของทุกปี&nbsp; นักเรียนสามารถตรวจสอบวันและเวลาสอบที่แน่นอนได้ที่www.britishcouncil.org/th</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '', 'content', '6', '14', '', '2016-05-22 19:59:54', '2016-05-24 14:38:52', '1');
INSERT INTO `pages` VALUES ('8', 'course_ged', 'หลักสูตร GED', 'Course GED', '<p><strong>GED <em>(General Educational Development)</em></strong></p>\r\n<p>เป็นการ สอบเทียบความรู้เท่าระดับมัธยมศึกษาตอนปลาย (เกรด 12)&nbsp; ในประเทศสหรัฐอเมริกา&nbsp; ซึ่งมีมาตั้งแต่เดือน พฤศจิกายน ปี ค.ศ 1942&nbsp;&nbsp; ชุดข้อสอบมี 5 วิชา คือ</p>\r\n<p>-<strong> Science</strong>&nbsp; &nbsp; &nbsp; &nbsp; เน้นเนื้อหาในเรื่อง Life Science 45%, Earth and Space Science 20%; Physical Science 35%&nbsp;&nbsp; (includes: Chemistry and Physics)</p>\r\n<p>- <strong>Math&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>เน้นเนื้อหาในเรื่อง Number Operations และ Number Sense 25%;&nbsp; Measurement&nbsp; และ Geometry 25%;&nbsp; Data&nbsp; Analysis, Statistics, และ Probability 25%;Algebra,&nbsp;&nbsp;Functions&nbsp;และ&nbsp;Patterns 25%.</p>\r\n<p>- <strong>Language Arts, Writing</strong>&nbsp;&nbsp;&nbsp; ข้อสอบแบ่งเป็น 2 ส่วน&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ส่วนที่ 1 &nbsp;&nbsp;เน้นเนื้อหาเกี่ยวกับ Organization 15%; Sentence Structure &nbsp;30 %;&nbsp;;&nbsp;Usage&nbsp;30%;&nbsp;&nbsp;Mechanics&nbsp; 25%&nbsp;&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ส่วนที่ 2 &nbsp;เป็นการเขียนเรียงความแสดงความคิดเห็นของนักเรียนในแง่มุมต่างๆของหัวข้อที่หลากหลาย</p>\r\n<p>- <strong>Language Arts, Reading </strong>&nbsp;&nbsp;เป็นข้อสอบที่มุ่งเน้นให้นักเรียนแสดงออกซึ่งทักษะที่จำเป็นในการใช้ภาษาอังกฤษในหัวข้อ Poetry; Drama; Prose Fiction ก่อนปี ค.ศ. 1920,</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ระหว่างปี ค.ศ. 1920, 1960 และหลังปี 1960 รวม 75%;&nbsp; Nonfiction Prose 25%</p>\r\n<p>- <strong>Social Studies</strong>&nbsp; เน้นเนื้อหาเกี่ยวกับ National History 45%; World History 15%; Economics 20% ; Civics และ Government 25% ; Geography 15%</p>\r\n<p>&nbsp;</p>\r\n<p>โดยต้องได้คะแนนในแต่ละวิชาไม่น้อยกว่า 410 คะแนน จากคะแนนเต็ม 800&nbsp; และคะแนนรวมทั้ง&nbsp; 5 วิชา ต้องไม่น้อยกว่า 2250 คะแนนจึงจะถือว่าสอบผ่าน&nbsp;&nbsp; ผู้ที่สอบวิชาใดไม่ผ่าน สามารถทำการสอบวิชานั้นใหม่ได้หลังการสอบวิชานั้นแล้ว&nbsp; 90 วัน</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ดังนั้นเมื่อนักเรียนสอบ GED ผ่านครบทั้ง 5 วิชา ก็หมายความว่านักเรียนมีศักดิ์และสิทธิ์เทียบเท่ากับนักเรียนจบมัธยมศึกษาตอนปลาย ม. 6 ของโรงเรียนในประเทศไทย&nbsp; โดยที่กระทรวงศึกษาธิการรับรองคุณวุฒินี้ &nbsp; นักเรียนสามารถนำวุฒิบัตรที่ได้รับจากอเมริกาไปสมัครเข้าเรียนในมหาวิทยาลัยของรัฐ หรือมหาวิทยาลัยเอกชนในเมืองไทยได้ทุกแห่ง</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; STUDY&nbsp; PLUS CENTER&nbsp; จัดดำเนินการสอน &nbsp;GED โดยมุ่งเน้นความสามารถของนักเรียนเป็นหลักในการเตรียมตัวนักเรียนเข้าสอบ GED อย่างตรงเป้า &nbsp; เพื่อให้มั่นใจว่านักเรียนที่เข้าสอบ GED สามารถทำข้อสอบได้ตรงตามมาตรฐานที่ประเทศสหรัฐอเมริกากำหนด และสามารถนำความรู้จากการเรียนไปต่อยอดในมหาวิทยาลัยได้ &nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; นักเรียนสามารถเลือกเรียนตัวต่อตัว หรือ คู่ หรือ กลุ่ม ตามเวลาที่ผู้เรียนสะดวก &nbsp; อาจารย์ผู้สอนทุกท่านมีความสามารถ เพียบพร้อมด้วยประสบการณ์และเชี่ยวชาญในแต่ละวิชา &nbsp;</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;สถาบันมีบริการสมัครสอบ&nbsp;&nbsp; ติดตาม Transcript, Diploma โดพยไม่คิดค่าบริการ &nbsp;พร้อมทั้งบริการแนะแนวการศึกษาต่อเพื่อมุ่งเข้าสู่รั้วมหาวิทยาลัย&nbsp;โดยเฉพาะ \"<strong>จุฬาลงกรณ์มหาวิทยาลัย หลักสูตรนานาชาติ</strong>\" คือจุดมุ่งหมายของเราที่ทำสำเร็จมาทุกปี</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '', 'content', '7', '14', '', '2016-05-22 21:01:37', '2016-05-23 22:04:39', '1');
INSERT INTO `pages` VALUES ('9', 'founder', 'ผู้ก่อตั้ง', 'Founder', '<p>&nbsp;</p>\r\n<p><span style=\"color: #008000;\"><strong>ใครเป็นผู้ก่อตั้งและผู้จัดการหลักสูตรการเรียนการสอน</strong></span></p>\r\n<p><img src=\"http://localhost/spc/assets/uploads/about_us/founder2.jpg?1464793970246\" alt=\"\" width=\"500\" height=\"330\" /></p>', '', 'about_us', '3', '5', '', '2016-05-24 16:54:59', '2016-06-01 17:13:28', '1');
INSERT INTO `pages` VALUES ('12', 'vision', 'วิสัยทัศน์', 'Vision', '', '', 'about_us', '4', '5', '', '2016-05-24 18:58:41', '2016-05-24 18:58:41', '1');
INSERT INTO `pages` VALUES ('13', 'test', 'หกดฟสหก่ดาสฟห', 'Test', '', '', 'none', '11', '0', '', '2016-05-26 21:13:11', '2016-05-26 21:13:11', '1');
INSERT INTO `pages` VALUES ('14', 'curricula', 'หลักสูตร', 'Curricula', '', '', 'curricula', '5', '0', '', '2016-06-01 16:18:37', '2016-06-08 16:32:24', '0');
INSERT INTO `pages` VALUES ('15', 'parent_response', 'เสียงจากผู้ปกครอง', 'Parent Response', '<p>เสียงจากผู้ปกครอง</p>', '<p>Parent Response</p>', 'content', '12', '3', '', '2016-06-04 09:06:24', '2016-06-04 09:06:24', '0');
INSERT INTO `pages` VALUES ('16', 'student_memorable', 'นักเรียนที่โดดเด่น', 'Student memorable', '<p>นักเรียนที่โดดเด่น</p>', '<p>Student memorable</p>', 'content', '10', '3', '', '2016-06-04 09:09:40', '2016-06-04 09:09:40', '0');
INSERT INTO `pages` VALUES ('17', 'alumni', 'ศิษย์เก่า', 'Alumni', '<p>ศิษย์เก่า</p>', '<p>Alumni</p>', 'content', '11', '3', '', '2016-06-04 09:11:15', '2016-06-04 09:11:36', '0');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` bit(1) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Super Admin', '2016-01-10 04:47:48', null, '\0');
INSERT INTO `roles` VALUES ('2', 'Admin', '2016-01-10 04:48:16', null, '\0');
INSERT INTO `roles` VALUES ('3', 'User', '2016-05-16 01:02:28', null, '\0');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `setting_id` int(10) NOT NULL AUTO_INCREMENT,
  `website_name` varchar(100) DEFAULT NULL,
  `website_short_name` varchar(10) DEFAULT NULL,
  `default_language` varchar(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address_th` varchar(500) DEFAULT NULL,
  `address_en` varchar(500) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `facebook_link` varchar(500) DEFAULT NULL,
  `twitter_link` varchar(500) DEFAULT NULL,
  `instagram_link` varchar(500) DEFAULT NULL,
  `line_id` varchar(20) DEFAULT NULL,
  `vision_th` text,
  `vision_en` text,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('2', 'Study Plus Center', 'SPC', 'thai', 'studypluscenter@hotmail.com', '322/1  รามคำแหง 74 (เยื้องโฮมโปร รามคำแหง) \r\nหัวหมาก  บางกะปิ  กทม. 10240\r\n', '322/1 Ramkhamhang 74 Huamark Bangkapi Bangkok 10240', '5989998', '6898989', 'https://www.facebook.com/StudyPlusCenter/', 'http://twitter.com', 'http://instagram.com', '@SPCFastTrack', '<h2>“Your success is our goal”</h2>\r\n<p class=\"text-center\">“ความสำเร็จของคุณคือเป้าหมายของเรา ถ้ามีศักยภาพแต่ยังไม่รู้หนทาง หรือ อาจจะยังไม่รู้ว่าตัวเองมีศักยภาพ ทีมอาจารย์ที่เข้มแข็งของเรา SPC พร้อมโค้ชให้คุณผ่านเส้นทางที่มืดมนนี้ได้สำร็จ ความสำเร็จอาจไม่ได้มาอย่างง่ายดาย ความตั้งใจของคุณบวกกับความชำนาญของเรา SPC จะช่วยพาคุณสู่ความสำเร็จได้”</p>', '<h2>“Your success is our goal”</h2>\r\n<p class=\"text-center\">“ Your success is our goal. I do not know if there are potential avenues or may not know that their potential . With our strong team of professors SPC coach you through this dark path for Finished . Success may not come easily . Your intentions , combined with the expertise of our SPC will help lead you to success .”</p>', '2016-04-21 14:52:13', '2016-05-30 18:20:32');

-- ----------------------------
-- Table structure for slideshow
-- ----------------------------
DROP TABLE IF EXISTS `slideshow`;
CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `description_en` text,
  `description_th` text,
  `published` bit(1) NOT NULL,
  `order_seq` tinyint(3) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slideshow
-- ----------------------------
INSERT INTO `slideshow` VALUES ('97', 'thumb_7fea36f1-8b02-4734-ac9a-494417df3d51.jpg.jpg', '', '', '', '1', '2016-06-05 06:31:08', '2016-06-05 06:31:08', '0');
INSERT INTO `slideshow` VALUES ('98', 'thumb_967afb85-e261-4cbe-a070-a9eea844f4e4.jpg.jpg', '', '', '', '1', '2016-06-05 06:35:33', '2016-06-05 06:35:33', '0');
INSERT INTO `slideshow` VALUES ('99', 'thumb_4ce67992-b817-439d-a0f4-5865ec0ef579.jpg.jpg', '', '', '', '1', '2016-06-05 06:35:38', '2016-06-05 06:35:38', '0');

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` bit(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of students
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(2) NOT NULL,
  `facebook_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logged_in_date` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Songkran', 'Sommit', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'bsongkran@hotmail.com', '55555', '1', null, '2016-06-08 16:45:49', '2016-05-20 19:04:09', null);
INSERT INTO `users` VALUES ('2', 'Tester', 'surename', 'user1', '81dc9bdb52d04dc20036dbd8313ed055', 'bsongkran_167@hotmail.com', '666666', '3', null, '2016-06-08 13:46:19', '2016-06-02 13:57:50', '2016-06-02 13:57:50');

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `user_role_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` bit(1) NOT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_role
-- ----------------------------
