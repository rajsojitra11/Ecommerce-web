-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 07:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reg`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cid` int(20) NOT NULL,
  `uid` int(20) NOT NULL,
  `pid` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `quatity` int(10) NOT NULL,
  `pimg` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cid`, `uid`, `pid`, `name`, `price`, `quatity`, `pimg`) VALUES
(24, 4, 19, 'laptop ', '60000', 1, './pimg/th (2).jpeg'),
(28, 2, 26, 'Camera', '20000', 1, './pimg/download.jpeg'),
(29, 2, 22, 'watch', '10000', 1, './pimg/th (1).jpeg'),
(30, 2, 23, 'washing machine', '60000', 1, './pimg/download (2).jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `mid` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`mid`, `email`, `name`, `message`) VALUES
(1, 'raj@gmail.com', 'raj', 'dfghklkjhgfdxzxdfghjhvcxzxfghjmnbvcfghj'),
(2, 'raj@gmail.com', 'raj', 'dfgyuioppoiuhgfdrtyuikjhgfdfgh'),
(3, 'raj@gmail.com', 'raj', 'dfgyuioppoiuhgfdrtyuikjhgfdfgh'),
(4, 'raj@gmail.com', 'raj', 'asdfghjkl;lkjhgfdssdfghjkl.lkjh'),
(5, 'admin1@gmail.com', 'admin', 'sertyuioohgfdsasdfghuiofdsa'),
(6, 'admin214@gmail.com', 'admin', 'hrllo  ...!'),
(7, 'admin214@gmail.com', 'admin', 'hrllo  ...!'),
(8, 'admin214@gmail.com', 'admin', 'hrllo  ...!'),
(9, 'admin214@gmail.com', 'sojitra raj m', 'srdfgbjkml,.;,lmkhgfdxzsazdxfgjnmkl,;kmhgyfdszdxgvj');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(10) NOT NULL,
  `uid` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `total_product` varchar(20) NOT NULL,
  `total_price` varchar(200) NOT NULL,
  `placed_on` varchar(300) NOT NULL DEFAULT current_timestamp(),
  `pyment_staus` varchar(500) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `uid`, `name`, `number`, `email`, `method`, `address`, `total_product`, `total_price`, `placed_on`, `pyment_staus`) VALUES
(1, 2, 'admin', '8563254756', 'admin214@gmail.com', 'cash on delivery', 'flat no. A 1102, savvy strata, sarkhej, ahmedabad, Gujarat, india - 568525', 'raj (20000 x 3) - wa', '141000', '2024-12-13 19:18:37', 'completed'),
(2, 2, 'om', '5842545', 'raj@gmail.com', 'cash on delivery', 'flat no. A 1102, savvy strata, sarkhej, rajkot, Gujarat, indai - 565856', 'laptop  (60000 x 1) ', '60000', '2024-12-13 19:52:55', 'completed'),
(3, 2, 'sojitra raj m', '4545474525', 'raj@gmail.com', 'cash on delivery', 'flat no. A 1102, savvy strata, sarkhej, rajkot, Gujarat, india - 414741', 'washing machine (600', '60000', '2024-12-13 19:53:29', 'completed'),
(4, 2, 'sdfghjk', '852545', 'raj@gmail.com', 'cash on delivery', 'flat no. A 1102, savvy strata, 5zxfghjk, sdfghm, fghjk, sdfghm, - 785254', 'mouse (20000 x 1) - ', '20000', '2024-12-13 19:54:18', 'Pending'),
(5, 4, 'admin', '472365', 'rppatel5257@gmail.com', 'cash on delivery', 'flat no. A 1102, savvy strata, xcvbjkl;, rajkot, Gujarat, sdfghm, - 587423', 'Camera (20000 x 1) -', '20000', '2024-12-13 22:44:23', 'completed'),
(6, 2, 'jaydev', '5745236584', 'raj@gmail.com', 'cash on delivery', 'flat no. A 1102, savvy strata, sarkhej, ahmedabad, Gujarat, india - 515412', 'watch (1000 x 1) - l', '61000', '2024-12-13 22:53:34', 'completed'),
(7, 2, 'sojitra raj m', '4742545265', 'admin214@gmail.com', 'cash on delivery', 'flat no. A 1102, savvy strata, sarkhej, rajkot, Gujarat, indai - 456857', 'watch (1000 x 1) - ', '1000', '2024-12-13 23:10:15', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(10) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `productdetails` varchar(1000) NOT NULL,
  `productprice` int(10) NOT NULL,
  `productimg` varchar(500) NOT NULL,
  `productimg2` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `productname`, `productdetails`, `productprice`, `productimg`, `productimg2`) VALUES
(10, 'watch', 'Royal Watch', 1000, './pimg/th (1).jpeg', ''),
(19, 'camera', 'new ', 60000, './pimg/th (2).jpeg', ''),
(21, 'smartphone', 'smart mobile', 50000, './pimg/th.jpeg', ''),
(22, 'watch', 'new watch', 10000, './pimg/th (1).jpeg', ''),
(23, 'washing machine', 'front load', 60000, './pimg/download (2).jpeg', ''),
(24, 'Fridge', 'Fast Cooling', 60000, './pimg/download (1).jpeg', ''),
(26, 'Camera', 'DSLR Camera', 20000, './pimg/download.jpeg', ''),
(27, 'Mobile', 'new', 50000, './pimg/th.jpeg', ''),
(28, 'TV', 'new tv ', 40000, './pimg/th (3).jpeg', ''),
(29, 'laptop ', 'new laptop', 100000, './pimg/th (5).jpeg', ''),
(30, 'laptop', 'new', 66000, './pimg/th (4).jpeg', ''),
(31, 'mobile', 'iphone', 60000, './pimg/th (3).jpeg', ''),
(32, 'laptop', 'new', 1000, './pimg/images.jpeg', ''),
(33, 'camera', 'sonny camera', 12999, './pimg/th (2).jpeg', ''),
(34, 'camera', 'new', 49998, './pimg/download.jpeg', ''),
(35, 'fridge', 'coll', 709980, './pimg/61UxmiGm8QL._SL1500_.jpg', ''),
(36, 'samsung', 'fold', 105000, './pimg/81rCIc3xUhL.jpg', ''),
(37, 'mouse', 'gaming', 799, './pimg/th.jpeg', ''),
(38, 'watch', 'new', 12888, './pimg/samsung_sm_r820nzsaxar_galaxy_watch_active2_bluetooth_1491586.jpg', ''),
(39, 'camera', 'antic', 30000, './pimg/Sony_DSCW620_R_Cyber_Shot_DSC_W620_Digital_Camera_838529.jpg', ''),
(40, 'laptop', 'new', 66777, './pimg/images.jpeg', ''),
(41, 'tv', 'new', 37000, './pimg/8192893_R_Z001A.jpeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `regdetails`
--

CREATE TABLE `regdetails` (
  `id` int(10) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `passw` varchar(10) NOT NULL,
  `usertype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regdetails`
--

INSERT INTO `regdetails` (`id`, `firstname`, `lastname`, `email`, `passw`, `usertype`) VALUES
(1, 'admin', 'admin', 'admin1@gmail.com', '4646', 'Admin'),
(2, 'raj', 'sojitra', 'raj@gmail.com', '123', 'Customer'),
(3, 'jaydeep', 'sojitra', 'sjpatel@gmail.com', '3740', 'Customer'),
(4, 'om', 'patel', 'om@gmail.com', '1111', 'Customer'),
(5, 'harsh', 'vora', 'harsh@gmail.com', '2222', 'Customer'),
(35, 'jaydeep', 'sojitra', 'raj@gmail.com', '789', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wid` int(20) NOT NULL,
  `uid` int(20) NOT NULL,
  `pid` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pprice` varchar(50) NOT NULL,
  `pimg` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wid`, `uid`, `pid`, `name`, `pprice`, `pimg`) VALUES
(17, 2, 21, 'smartphone', '50000', './pimg/th.jpeg'),
(18, 2, 10, 'watch', '1000', './pimg/th (1).jpeg'),
(20, 2, 28, 'TV', '40000', './pimg/th (3).jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `regdetails`
--
ALTER TABLE `regdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `regdetails`
--
ALTER TABLE `regdetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `regdetails` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `regdetails` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `regdetails` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
