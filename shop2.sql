-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 15, 2024 at 06:58 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `createdOn`, `modifiedOn`) VALUES
(2, 'Produce', '2024-01-14 21:45:12', '2024-01-14 21:46:00'),
(3, 'Meat', '2024-01-14 22:13:53', '2024-01-14 22:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `sell_price` decimal(10,0) DEFAULT NULL,
  `buy_price` decimal(10,0) DEFAULT NULL,
  `stock` decimal(10,0) DEFAULT NULL,
  `categoryId` int DEFAULT NULL,
  `supplierId` int DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `name`, `description`, `image`, `sell_price`, `buy_price`, `stock`, `categoryId`, `supplierId`, `createdOn`, `modifiedOn`) VALUES
(26, 'test', 'test desc', './images/inventory/78c51402-22aa-4c7c-b92e-4b5fba0261fa.jpg', 12, 32, 4, 3, 3, '2024-01-15 13:59:43', '2024-01-15 14:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `createdOn`, `modifiedOn`) VALUES
(1, 'Admin', '2023-12-06 09:38:08', '2023-12-06 09:38:08'),
(2, 'Member', '2023-12-06 09:39:17', '2024-01-14 15:30:38'),
(6, 'Test role', '2024-01-14 16:49:18', '2024-01-14 16:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phoneNumber` bigint DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phoneNumber`, `createdOn`, `modifiedOn`) VALUES
(3, 'test2', 'test2@test.com', 1234567890, '2024-01-14 21:30:53', '2024-01-14 21:40:27'),
(4, 'gfgfg', 'erf@dsds.ds', 12334556781, '2024-01-14 22:29:21', '2024-01-14 22:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
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
(1, 'test', 'test', '$2y$10$Lwvt3nt51D5vviIifUAfyu7C02lOj2SBuJLuqNNW.krd26oAEegxy', 'lmaio@gmail.com', '2023-11-08 11:45:04', '2024-01-12 21:10:20'),
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
(44, 'fdgfdg', 'fdgdgdfgdfggdgdfgdgdf', '$2y$10$IgKhYWgxcJtzSTEilmqU2OiiipUd0XtW3HUIY2xik1fAMjS7ydy1K', 'admintest1@ds.sxzsa', '2024-01-10 09:37:54', '2024-01-10 09:37:54'),
(45, 'Admin', 'Test', '$2y$10$PYChhrIjbQHGsazUSwU1bOiYe2rGjjy8Uko.3mctu3KlsIv8HHdna', 'admin@test.com', '2024-01-12 19:59:36', '2024-01-12 19:59:36'),
(46, 'Admin', 'Test', '$2y$10$smF76evZaD3ke8iDpKSTQ.uxOZwyH81Lm2aHNYp.glV6nfTQNrUYq', 'admin@test.com', '2024-01-12 20:54:36', '2024-01-12 20:54:36'),
(48, 'Default', 'Test', '$2y$10$pnTUBu/g/2omuMQzghLiTuJo.C.a.Kpy/XlzPgs4.H2Tw5Aws6J.C', 'normaluser@test.com', '2024-01-14 15:28:18', '2024-01-14 15:28:18'),
(49, 'Default', 'Test', '$2y$10$Y/vMgdIsDpvOxOO0ELeH1e6J5HU14/MZeCJexDL/SHMcHcj3jUjtK', 'defaultuser@test.com', '2024-01-14 15:31:04', '2024-01-14 15:31:04'),
(50, 'Default', 'Testiong', '$2y$10$njIcwEhc7EIotkMetRe6TOpo02rA/WgeYkE9BdbgpywwrNe6Y8oRq', 'admin@testsss.com', '2024-01-14 21:25:09', '2024-01-14 21:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(45, 1),
(49, 2),
(50, 2),
(1, 6);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `supplierId` (`supplierId`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `equipments_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `equipments_ibfk_2` FOREIGN KEY (`supplierId`) REFERENCES `suppliers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
