-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-10-23 15:50:42
-- 伺服器版本: 10.1.13-MariaDB
-- PHP 版本： 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `tbs`
--

-- --------------------------------------------------------

--
-- 資料表結構 `user_trade`
--

CREATE TABLE `user_trade` (
  `tid` int(11) NOT NULL,
  `demandList_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `trade_date` datetime NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `requester_id` int(11) NOT NULL,
  `message_demand` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_confirm` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requester_score` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requester_comment` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requester_comment_date` datetime DEFAULT NULL,
  `provider_check` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requester_check` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `need_num` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `user_trade`
--

INSERT INTO `user_trade` (`tid`, `demandList_id`, `product_id`, `trade_date`, `provider_id`, `requester_id`, `message_demand`, `provider_confirm`, `requester_score`, `requester_comment`, `requester_comment_date`, `provider_check`, `requester_check`, `need_num`) VALUES
(1, 3, NULL, '2016-08-25 13:53:38', NULL, 3, NULL, 'no', NULL, NULL, NULL, 'yes', 'no', NULL),
(2, NULL, 18, '2016-10-02 15:57:43', NULL, 2, '我想要這自行車', 'yes', '4', '白色自行車nice!', '2016-10-18 20:50:54', 'no', 'no', NULL),
(3, NULL, 11, '2016-10-02 15:58:20', NULL, 2, '我可以幫你代班哦～', 'yes', 'no', NULL, NULL, 'no', 'no', NULL),
(4, NULL, 21, '2016-10-02 15:58:38', NULL, 2, '我想要去台北！', 'no', 'no', NULL, NULL, 'no', 'no', NULL),
(5, NULL, 15, '2016-10-23 21:27:28', 3, 5, NULL, 'no', 'no', 'no', NULL, 'yes', 'yes', 1);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `user_trade`
--
ALTER TABLE `user_trade`
  ADD PRIMARY KEY (`tid`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `user_trade`
--
ALTER TABLE `user_trade`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
