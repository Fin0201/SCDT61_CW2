-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 10, 2024 at 10:58 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `sell_price` decimal(10,0) NOT NULL,
  `buy_price` decimal(10,0) NOT NULL,
  `stock` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_categories`
--

CREATE TABLE `equipment_categories` (
  `equipment_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_suppliers`
--

CREATE TABLE `equipment_suppliers` (
  `equipment_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `createdOn`, `modifiedOn`) VALUES
(1, 'Admin', '2023-12-06 09:38:08', '2023-12-06 09:38:08'),
(2, 'admin', '2023-12-06 09:39:17', '2023-12-06 09:39:17'),
(3, 'customer', '2023-12-06 09:41:13', '2023-12-06 09:41:13'),
(4, 'user', '2023-12-06 09:42:42', '2023-12-06 09:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` text,
  `email` varchar(255) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `password`, `email`, `createdOn`, `modifiedOn`) VALUES
(1, 'test', 'test', '$2y$10$Lwvt3nt51D5vviIifUAfyu7C02lOj2SBuJLuqNNW.krd26oAEegxy', '', '2023-11-08 11:45:04', '2023-11-08 11:46:07'),
(2, 'egeger', 'ergergerg', '$2y$10$dnrsO8mMy6RSaDvSO1UxoOLe.0PJopTZzp0FomWbVGcp77Kn0.Um.', 'regregreg@egerg.com', '2023-11-08 11:50:20', '2023-11-08 11:50:20'),
(3, 'Fred', 'Smith', '$2y$10$OtCIgHEYWtmm2umQShCLBu6KyJ48NefqkRzJ8t2OMCsPof3WnhVhO', 'Fred@Smith.com', '2023-11-15 11:17:49', '2023-11-15 11:17:49'),
(7, 'katie', 'smith', '$2y$10$AKpd5R3rl5PU4aGl0DQK3OE4p3uT19XRWhxCJ/wI5VnQOY8wUXSF2', 'katiesmith2@gmail.com', '2023-11-15 11:37:49', '2023-11-15 14:25:23'),
(8, 'jim', 'smith', '$2y$10$7j56SeGeR5YRMSAjo5LVYu/og703KV1uodU1YDMX73Tg85YNQFTva', 'jimsmith@gmail.com', '2023-11-15 14:31:29', '2023-11-15 14:31:29'),
(9, 'jim', 'smith', '$2y$10$7j56SeGeR5YRMSAjo5LVYu/og703KV1uodU1YDMX73Tg85YNQFTva', 'jimsmith@gmail.com', '2023-11-15 14:31:29', '2023-11-15 14:31:47'),
(10, 'amy', 'smith', '$2y$10$XJpmJ9LHeUUe0dE7YQVf6uQI9.lQcYjV1ks0IEnDb4w0njBZ/cQ/a', 'amysmith@test.com', '2023-11-28 15:03:11', '2023-11-28 15:03:11'),
(11, 'amy', 'smith', '$2y$10$XJpmJ9LHeUUe0dE7YQVf6uQI9.lQcYjV1ks0IEnDb4w0njBZ/cQ/a', 'amysmith@test.com', '2023-11-28 15:03:11', '2023-11-28 15:03:11'),
(12, '1', '1', '$2y$10$2G.LxZ.k9XIQjvUFrdSyz.ZvffDQd3qQn3YcngbxXdydqLM8gtd5W', 'sasa@saas.ds', '2023-11-29 09:13:15', '2023-11-29 09:13:15'),
(13, '1', '1', '$2y$10$2G.LxZ.k9XIQjvUFrdSyz.ZvffDQd3qQn3YcngbxXdydqLM8gtd5W', 'sasa@saas.ds', '2023-11-29 09:13:15', '2023-11-29 09:13:15'),
(14, '2', '2', '$2y$10$IEjdNBCxKTlGWQAY/AVDd.YCLzDA.9BNNjnAB6cRuzhbyikh5Yqlu', 'aaaa@aaaa.a', '2023-11-29 09:16:51', '2023-11-29 09:16:51'),
(15, '2', '2', '$2y$10$IEjdNBCxKTlGWQAY/AVDd.YCLzDA.9BNNjnAB6cRuzhbyikh5Yqlu', 'aaaa@aaaa.a', '2023-11-29 09:16:51', '2023-11-29 09:16:51'),
(16, '3', '3', '$2y$10$C7TKPH/LDD2r8aQWIJP6JetkwOlj6XirpXObAJURcaBC4fWgRap2O', 'dddd@dddd.com', '2023-11-29 09:22:41', '2023-11-29 09:22:41'),
(17, '3', '3', '$2y$10$C7TKPH/LDD2r8aQWIJP6JetkwOlj6XirpXObAJURcaBC4fWgRap2O', 'dddd@dddd.com', '2023-11-29 09:22:41', '2023-11-29 09:22:41'),
(18, '4', '4', '$2y$10$rIA0APomHmUmk6w9rbzEG.qv8KzggC6AtqtSoJa1wNhWbZG2/suiq', 'dddd@ddddd.com', '2023-11-29 09:24:20', '2023-11-29 09:24:20'),
(19, '4', '4', '$2y$10$rIA0APomHmUmk6w9rbzEG.qv8KzggC6AtqtSoJa1wNhWbZG2/suiq', 'dddd@ddddd.com', '2023-11-29 09:24:20', '2023-11-29 09:24:20'),
(20, '5', '5', '$2y$10$SO6ILZ6azrj0CIP6JJdOzutkJp9H7LXL0/rAmuD97SqLsFHOcxK9W', 'dddd@dddddd.com', '2023-11-29 09:24:26', '2023-11-29 09:24:26'),
(21, '5', '5', '$2y$10$SO6ILZ6azrj0CIP6JJdOzutkJp9H7LXL0/rAmuD97SqLsFHOcxK9W', 'dddd@dddddd.com', '2023-11-29 09:24:26', '2023-11-29 09:24:26'),
(22, '5', '5', '$2y$10$G6xrUGyyV3C8xbopMgp2reKY4MLxX/KVScKohdR35DiohO/zwNt9q', 'dddd@dddddd.com', '2023-11-29 09:59:48', '2023-11-29 09:59:48'),
(23, '5', '5', '$2y$10$G6xrUGyyV3C8xbopMgp2reKY4MLxX/KVScKohdR35DiohO/zwNt9q', 'dddd@dddddd.com', '2023-11-29 09:59:48', '2023-11-29 09:59:48'),
(24, '6', '6', '$2y$10$XnNg3r1EmlMMOhDoRPW.e.kKWHHzAq5MVZ3mUOUhWyrp6FADRrGC2', 'dsdsd@sss.c', '2023-11-29 10:00:29', '2023-11-29 10:00:29'),
(25, '6', '6', '$2y$10$XnNg3r1EmlMMOhDoRPW.e.kKWHHzAq5MVZ3mUOUhWyrp6FADRrGC2', 'dsdsd@sss.c', '2023-11-29 10:00:29', '2023-11-29 10:00:29'),
(26, '7', '7', '$2y$10$X5FtZ7tiRVi97Bj8Jz1c1eVBhASU/WXfaxI2ydhL098.bflT6970S', 'ddd@ddd.c', '2023-11-29 10:01:57', '2023-11-29 10:01:57'),
(27, '7', '7', '$2y$10$X5FtZ7tiRVi97Bj8Jz1c1eVBhASU/WXfaxI2ydhL098.bflT6970S', 'ddd@ddd.c', '2023-11-29 10:01:57', '2023-11-29 10:01:57'),
(28, '7', '7', '$2y$10$oR/BEXRJGTOiZV/Nde8MFucQzsQoYvhHfoT.MZM/2DXUDdaEV.B16', 'ddd@ddd.c', '2023-11-29 10:02:56', '2023-11-29 10:02:56'),
(29, '7', '7', '$2y$10$oR/BEXRJGTOiZV/Nde8MFucQzsQoYvhHfoT.MZM/2DXUDdaEV.B16', 'ddd@ddd.c', '2023-11-29 10:02:56', '2023-11-29 10:02:56'),
(30, '8', '8', '$2y$10$4Imm019wOAgH9gvoYb185e6O3ZaLA2rEhkCQeXdURHh6e355Pn.T2', 'ddd@ddd.com', '2023-11-29 10:03:07', '2023-11-29 10:03:07'),
(31, '8', '8', '$2y$10$4Imm019wOAgH9gvoYb185e6O3ZaLA2rEhkCQeXdURHh6e355Pn.T2', 'ddd@ddd.com', '2023-11-29 10:03:07', '2023-11-29 10:03:07'),
(32, '9', '9', '$2y$10$F4/4ibGcvHbuyttPFiK0hepym.V3VhX18zh.vcNX8gNmIXBpbiddq', 'ddd@ddd.com', '2023-11-29 10:04:54', '2023-11-29 10:04:54'),
(33, '9', '9', '$2y$10$F4/4ibGcvHbuyttPFiK0hepym.V3VhX18zh.vcNX8gNmIXBpbiddq', 'ddd@ddd.com', '2023-11-29 10:04:54', '2023-11-29 10:04:54'),
(34, '9', '9', '$2y$10$lfafV6iZ1lg5T.l1hhaTSOY5itqBsRA8A3ZqLtOc3JfOG9D78xFCO', 'ddd@ddd.com', '2023-11-29 10:05:26', '2023-11-29 10:05:26'),
(35, '9', '9', '$2y$10$lfafV6iZ1lg5T.l1hhaTSOY5itqBsRA8A3ZqLtOc3JfOG9D78xFCO', 'ddd@ddd.com', '2023-11-29 10:05:26', '2023-11-29 10:05:26'),
(36, '1', '1', '$2y$10$2ZKB46z.v6J8.pLL0M400OLko/YaFTnesVivWRina/ONS77oCB3re', '187@187.com', '2023-12-06 09:48:36', '2023-12-06 09:48:36'),
(37, '1', '1', '$2y$10$2ZKB46z.v6J8.pLL0M400OLko/YaFTnesVivWRina/ONS77oCB3re', '187@187.com', '2023-12-06 09:48:36', '2023-12-06 09:48:36'),
(38, '000000', 'sasasa', '$2y$10$xh5kJ39I3czqEw8J4e2ZxeDOP2J7sFtOD6QEjDA82yVcAuc9V.G2q', 'dsdsd@sss.com', '2023-12-06 09:49:48', '2023-12-06 09:49:48'),
(39, '000000', 'sasasa', '$2y$10$xh5kJ39I3czqEw8J4e2ZxeDOP2J7sFtOD6QEjDA82yVcAuc9V.G2q', 'dsdsd@sss.com', '2023-12-06 09:49:48', '2023-12-06 09:49:48'),
(40, 'admin', 'test', '$2y$10$ledPF0zICM/QtdUOv5d6t.5fWLnklP5Bbp4X6l.xHZ0ZebneKfeJq', 'admintest1@ds.sxzsa', '2024-01-03 09:38:45', '2024-01-03 09:38:45'),
(41, 'rolestest', 'lflofldsfldopfmdfokmfkod', '$2y$10$9ltR90UH8DwztOwQ3yQU5O286/evtzCWIlEZJKWp5Px.gB8gY40Fu', 'basasasa@dsdsssd.com', '2024-01-10 09:33:39', '2024-01-10 09:33:39'),
(42, 'rolestest2', 'saasaasa', '$2y$10$AXpIbqPLtRvOy2lHW11rFOA61vMFQPNWq9Zz.oJIHafkwQtZY6v16', 'asas@sasa.com', '2024-01-10 09:35:24', '2024-01-10 09:35:24'),
(43, 'rolestest3', 'dfdfdccvx', '$2y$10$3mDMMT4VnA9CjyuuWsUOSe2PP3MCzccGklnypb7C7UpyUaKobP0mS', 'admintest1@ds.sxzsa', '2024-01-10 09:36:02', '2024-01-10 09:36:02'),
(44, 'fdgfdg', 'fdgdgdfgdfggdgdfgdgdf', '$2y$10$IgKhYWgxcJtzSTEilmqU2OiiipUd0XtW3HUIY2xik1fAMjS7ydy1K', 'admintest1@ds.sxzsa', '2024-01-10 09:37:54', '2024-01-10 09:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(40, 2),
(43, 4),
(44, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_categories`
--
ALTER TABLE `equipment_categories`
  ADD PRIMARY KEY (`equipment_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `equipment_suppliers`
--
ALTER TABLE `equipment_suppliers`
  ADD PRIMARY KEY (`equipment_id`,`supplier_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment_categories`
--
ALTER TABLE `equipment_categories`
  ADD CONSTRAINT `equipment_categories_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`),
  ADD CONSTRAINT `equipment_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `equipment_suppliers`
--
ALTER TABLE `equipment_suppliers`
  ADD CONSTRAINT `equipment_suppliers_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`),
  ADD CONSTRAINT `equipment_suppliers_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
