-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 10 月 20 日 00:38
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `yamasutagourmet`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `post`
--

CREATE TABLE `post_2` (
  `post_id_2` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_contents` varchar(300) DEFAULT NULL,
  `date_time` varchar(50) NOT NULL,
  `fabulous` int(11) NOT NULL DEFAULT 0,
  `comments` int(11) NOT NULL DEFAULT 0,
  `region` varchar(100) DEFAULT NULL,
  `media1` varchar(100) DEFAULT NULL,
  `media2` varchar(100) DEFAULT NULL,
  `media3` varchar(100) DEFAULT NULL,
  `media4` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `post`
--
ALTER TABLE `post_2`
  ADD PRIMARY KEY (`post_id_2`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `post`
--
ALTER TABLE `post_2`
  MODIFY `post_id_2` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



/*インサート文*/
INSERT INTO `post_2`(`user_id`, `post_contents`, `date_time`, `media1`) 
VALUES ('1','こんにちは','10月','img_test/プリクラ.png');
INSERT INTO `post_2`(`user_id`, `post_contents`, `date_time`, `media1`,`media2`) 
VALUES ('2','こんにちは','10月','img_test/プリクラ.png','img_test/やますたぐるめ_.DMロゴ.png');
INSERT INTO `post_2`(`user_id`, `post_contents`, `date_time`, `media1`,`media2`,`media3`) 
VALUES ('3','こんにちは','10月','img_test/プリクラ.png','img_test/やますたぐるめ_.DMロゴ.png','img_test/やますたぐるめ_ホームロゴ.png');
INSERT INTO `post_2`(`user_id`, `post_contents`, `date_time`, `media1`,`media2`,`media3`,`media4`) 
VALUES ('4','こんにちは','10月','img_test/プリクラ.png','img_test/やますたぐるめ_.DMロゴ.png','img_test/やますたぐるめ_ホームロゴ.png','img_test/やますたぐるめ_検索ロゴ.png');