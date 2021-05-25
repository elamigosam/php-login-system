CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `code` varchar(32) NOT NULL,
  `isActive` tinyint(4) DEFAULT 0,
  `isAdmin` int(1) NOT NULL DEFAULT 0,
  `isUser` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `password`, `mobile`, `code`, `isActive`, `isAdmin`, `isUser`, `created_at`, `updated_at`) VALUES
(1, 'Pancho', 'Admin', 'panchoadmin', 'pancho@gmail.com', '$2y$10$VlNWT6yqVzr9FvcQRuAkcedZEc7Us1pgwRbXv07RI74wvJ98Frf5u', '', 'b56a18e0eacdf51aa2a5306b0f533204', 1, 1, 0, '2020-03-12 16:23:01', '2020-03-12 16:23:01'),
(2, 'Edgar', 'Lopez', 'Eddy', 'edgar@gmail.com', '$2y$10$uV6TFInHhOnbOZiTrTeyjOG69LjgPwwoHxGpHkmE.eOpXZ9FLOWBC', '', '', 1, 0, 0, '2020-03-12 18:20:24', '2020-03-12 18:20:24');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;


--
-- Table structure for table `account_sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(255) NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `account_sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);




