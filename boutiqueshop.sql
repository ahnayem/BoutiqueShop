-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 05:28 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boutiqueshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `phone`, `city`, `date`, `photo`) VALUES
(1, 'Mrs. Admin', 'admin@gmail.com', '1234', '+8801701234567', 'Rajshahi', '2021-01-17', '7d0e7ddc33f154bb1f3ea14c0ec7ab86c9a6fd9e8e0282b3375a90d802b9ca5c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `photo` tinytext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `pid`, `name`, `comment`, `date`) VALUES
(1, 7, 'User', 'The quality of this product is really good.', '2021-01-18 15:10:57'),
(2, 7, 'User', 'good', '2021-01-18 15:15:11'),
(3, 7, 'User', 'good quality.', '2021-01-18 15:29:00'),
(4, 7, 'User', 'asdf asdf', '2021-01-18 15:30:46'),
(5, 7, 'User', 'asdfgh', '2021-01-18 15:31:20'),
(6, 7, 'User', 'asdfgggg', '2021-01-18 15:33:45'),
(7, 7, 'User', 'asdfgghjkl', '2021-01-18 15:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `message`, `date`) VALUES
(1, 'User', 'user@gmail.com', 'Hi there!', '2021-01-19 13:43:45'),
(2, 'User1', 'user1@gmail.com', 'Good day!', '2021-01-19 13:44:07'),
(3, 'User3', 'user3@gmail.com', 'How are you today?', '2021-01-19 13:45:24');


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `shipping` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `txn` varchar(50) NOT NULL,
  `products` text NOT NULL,
  `price` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `name`, `shipping`, `phone`, `payment`, `txn`, `products`, `price`, `date`) VALUES
(2, 3, 'User', 'Rajshahi', '0170000000', 'Bkash', '12345678', ' -PRINT COTTON SALWAR KAMIZ 03 /  Color: Pink /  Size: X /  Qty: 2<br> -PRINT COTTON SALWAR KAMIZ 04 /  Color: Green /  Size: L /  Qty: 1<br> -PRINT COTTON SALWAR KAMIZ 01 /  Color: Red /  Size: X /  Qty: 1<br>', '2516', '2021-01-19 08:44:59'),
(3, 3, 'User', 'Rajshahi', '0170000000', 'Bkash', '12345678', ' -PRINT COTTON SALWAR KAMIZ 02 /  Color: Red /  Size: M /  Qty: 1<br> -PRINT COTTON SALWAR KAMIZ 03 /  Color: Pink /  Size: M /  Qty: 1<br>', '1318', '2021-01-19 08:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(10) NOT NULL,
  `category` varchar(20) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `category`, `photo`) VALUES
(7, 'PRINT COTTON SALWAR KAMIZ 01', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '599', 'Salwar Kamiz', '29f729692a160b7c293f4ee9a2daf2c764375f3bf5ed0ea4d312aa8e8d0b92e4.jpg'),
(8, 'PRINT COTTON SALWAR KAMIZ 02', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '599', 'Salwar Kamiz', 'a71cc619b9f6fd4b99c02c07aa2d030a9fb60357af38eb06dd86674ef305150d.jpg'),
(9, 'PRINT COTTON SALWAR KAMIZ 03', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '599', 'Salwar Kamiz', 'e5fcdb853b08eaaefc39bafdf4ffbaa58d285b1590ed19bbca73221cee22d96b.jpg'),
(10, 'PRINT COTTON SALWAR KAMIZ 04', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '599', 'Salwar Kamiz', 'b321f9f34705b1cea8b790b6328b22a4483e66a80f57220c5718327513671619.jpg'),
(11, 'PRINT COTTON SALWAR KAMIZ 05', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '599', 'Salwar Kamiz', '5b3b5b2e30d0cbf9bce9479aa27870a43a48fd65c5fbdbfe360cc2fdd88857ea.jpg'),
(12, 'PRINT COTTON SALWAR KAMIZ 06', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '599', 'Salwar Kamiz', '0239927b968659e20bf2f238cd4905ccbce141b8b8084456606add8c9904db04.jpg'),
(13, 'PRINT COTTON SALWAR KAMIZ 07', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '599', 'Salwar Kamiz', 'febb83af7221a87bcc610bb3d03978d0d5477fd35e1595297f3f84a36eb165c2.jpg'),
(14, 'PRINT COTTON SALWAR KAMIZ 08', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '599', 'Salwar Kamiz', '108c522bdc9784ad15542d415dcd779704d9b17b537aa1535a97b0bc4c55a942.jpg'),
(15, 'COTTON SALWAR KAMIZ 09', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '699', 'Salwar Kamiz', '8b72137830d37bd5cc8e498ad565bb5e3312ba44c4e648570d77fa78178b0450.jpg'),
(16, 'COTTON SALWAR KAMIZ 10', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '699', 'Salwar Kamiz', 'f58d3ec0a38dbd6a5aec050f5d1d206c115197913bcf4dadecca72297e382154.jpg'),
(17, 'COTTON SALWAR KAMIZ 11', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '699', 'Salwar Kamiz', 'd0e5ba3af4ece13721d7d0a6cec3d5f17bb2cb4a6ec31b46af42498b362d1b0e.jpg'),
(18, 'COTTON SALWAR KAMIZ 12', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '699', 'Salwar Kamiz', 'f03faf0c43dfb91181e433454d900f1ff9f0d79d400d63dc102efef269584e95.jpg'),
(19, 'COTTON SALWAR KAMIZ 13', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '699', 'Salwar Kamiz', 'c42c55fa2f5f8e0d9df2395fdb61c67a7c5a8583115be0ac898c3ace8740f83f.jpg'),
(20, 'COTTON SALWAR KAMIZ 14', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '699', 'Salwar Kamiz', 'eb5abd00bf7c4d18129d3867c0b9b65adff72dff73c1426545e8db79909b5a8f.jpg'),
(21, 'COTTON SALWAR KAMIZ 15', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '699', 'Salwar Kamiz', '1688fc21118ba4872650db32c0e997e300b4b4d10bd1fe7b0a4d9cc664245146.jpg'),
(22, 'COTTON SALWAR KAMIZ 16', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '699', 'Salwar Kamiz', '43bbf4cfa63d421fb19e4efdca52190946ffc967e4fa4803df3fcc39a052e651.jpg'),
(23, 'COTTON SALWAR KAMIZ 17', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '699', 'Salwar Kamiz', '3305b91caad6ca32787119807402bca50a6527bf28f3b6292c4cc73440db083d.jpg'),
(24, 'COTTON SALWAR KAMIZ 18', '-- Product Type: 3 Piece Cotton Dress. <br>\r\n-- Kamiz: Pure cotton (2.5 Yard).<br>\r\n-- Kamiz Length (In inch): 45\".<br>\r\n-- Separate sleeve available.<br> \r\n-- Salwar: Cotton (2.5 Yard).<br>\r\n-- Ornaa: Georgette.<br>\r\n-- Un-stitched.<br>\r\n-- Block Print.<br>\r\n-- Color: As same as picture.<br>\r\n-- Size: Free Size.<br><br>\r\n\r\n<strong>Washing Care:</strong><br>\r\nGive the first wash with shampoo for long-lasting color.\r\nPlease wash before making the dress for the betterment.\r\nIron your dress onto the backside for long-lasting block colors.\r\nDisclaimer: Product color may slightly vary due to photography, lighting sources, or your monitor settings.', '699', 'Salwar Kamiz', '307de4152c645124a5a7ff70249aff82300f599bf05b44281d6459b1aad258cc.jpg'),
(25, 'ANTIQUE HAND MADE 01', 'Original hand made product.', '399', 'Handmade', '8309b7bde7cc1f4f352753626c31d3b0fc8d2df6db7c761bbdb27faf4185d34a.jpg'),
(26, 'ANTIQUE HAND MADE 02', 'Original hand made product.', '399', 'Handmade', '6d0043294589450faa3bec532e0b02905de9791705e2b0e67ce1ac303e6beed1.jpg'),
(27, 'ANTIQUE HAND MADE 03', 'Original hand made product.', '399', 'Handmade', '17ea444f48d02d23a4506bb45903118d808776ab680acaf3cdb1b8679dab1415.jpg'),
(28, 'ANTIQUE HAND MADE 04', 'Original hand made product.', '399', 'Handmade', '7dc6356577ab56b800091d8213c5ba661f727895a8d14b5612377aaa5f312928.jpg'),
(29, 'ANTIQUE HAND MADE 05', 'Original hand made product.', '399', 'Handmade', '4af84e1326ae3c4780ff6406ba8b7e6327be2b24da7144844a53865eb207e544.jpg'),
(30, 'ANTIQUE HAND MADE 06', 'Original hand made product.', '399', 'Handmade', '84a0694e27f86f2481ef55b5433aa385abf11634c436fda6c75252eee96f15fe.jpg'),
(31, 'ANTIQUE HAND MADE 07', 'Original hand made product.', '399', 'Handmade', 'b8feac1608596c3034224e7b1672850e90aa5de632704904b227bdc69a109a4c.jpg'),
(32, 'ANTIQUE HAND MADE 08', 'Original hand made product.', '399', 'Handmade', '2b10a5cc0ee47ff6f2f08f3018a66cd6e174795f2f8f6ec559fbac2bdcb1d774.jpg'),
(33, 'ORIGINAL ANTIQUE JEWELRY 01', 'Original hand made product.', '550', 'Jewelry', '898fd1e3c7ae0060c905838b6e9182a66d9d7a40426d80402347d92d5c30a463.jpg'),
(34, 'ORIGINAL ANTIQUE JEWELRY 02', 'Original hand made product.', '550', 'Jewelry', 'd087f5f63854b4c294272d85f3f9883f4f943bc83f3f458b85853d99125a7e07.jpg'),
(35, 'ORIGINAL ANTIQUE JEWELRY 03', 'Original hand made product.', '550', 'Jewelry', 'f671929b8752686654f497a7ff1485e47b2574059d9e93a821837fb34a430da5.jpg'),
(36, 'ORIGINAL ANTIQUE JEWELRY 04', 'Original hand made product.', '550', 'Jewelry', '2fabbfde287458276ee307b2feaf5080ac32bedd26d04c8a7d5b7504bcc66dd0.jpg'),
(37, 'ORIGINAL ANTIQUE JEWELRY 05', 'Original hand made product.', '550', 'Jewelry', '8939b1c265fb67149a01c77c5c92dfa93671f01c2c607a397bc965f4ce33bbe2.jpg'),
(38, 'ORIGINAL ANTIQUE JEWELRY 06', 'Original hand made product.', '550', 'Jewelry', '314676a42e1f89f2127567a7319a1aea78071395cc97e52283fb21f2b79ff557.jpg'),
(39, 'ORIGINAL ANTIQUE JEWELRY 07', 'Original hand made product.', '550', 'Jewelry', 'c352afbf92546b02e4628110f4d28dcdd45208997feaf9e85381d7c404284483.jpg'),
(40, 'ORIGINAL ANTIQUE JEWELRY 08', 'Original hand made product.', '550', 'Jewelry', 'be5a34d93f535e7b5b1991798680bb11e67811aef6b4ce9cec1bc9344cdf8b51.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `city`, `date`, `photo`) VALUES
(3, 'User', 'user1@gmail.com', '1234', '0170000000', 'Rajshahi', '2021-01-17 15:47:38', 'b1a54dcbc3b4c9c14778770c1fb96d2cdca761a8939ecedb75dd12c3c72fddf4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
