CREATE TABLE `riders` (
  `rider_id` int(11) NOT NULL,
  `rider_name` varchar(255) NOT NULL,
  `rider_tel` varchar(64) NOT NULL,
  `rider_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `riders`
  ADD PRIMARY KEY (`rider_id`),
  ADD UNIQUE KEY `rider_email` (`rider_email`);

ALTER TABLE `riders`
  MODIFY `rider_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;