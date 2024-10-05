CREATE DATABASE s104100247_db; 

CREATE TABLE IF NOT EXISTS `friends` (
  `friend_id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `profile_name` varchar(30) NOT NULL,
  `date_started` date NOT NULL,
  `num_of_friends` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`friend_id`),
  UNIQUE (`friend_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `friends` (`friend_email`, `password`, `profile_name`, `date_started`, `num_of_friends`) 
VALUES 
('11455265@swin.edu.au', '007', 'Oliver', '2024-01-01', '2'), 
('9415973@swin.edu.au', '007', 'Oscar', '2024-01-01', '2'), 
('8048130@swin.edu.au', '007', 'Isla', '2024-01-01', '2'),
('1768133@swin.edu.au', '007', 'Amelia', '2024-01-01', '2'),
('5323177@swin.edu.au', '007', 'Henrey', '2024-01-01', '2'),
('2110763@swin.edu.au', '007', 'William', '2024-01-01', '2'),
('4793664@swin.edu.au', '007', 'Hazel', '2024-01-01', '2'),
('8852855@swin.edu.au', '007', 'Jack', '2024-01-01', '2'),
('7495319@swin.edu.au', '007', 'Lucas', '2024-01-01', '2'),
('4520457@swin.edu.au', '007', 'Ella', '2024-01-01', '2')
;


CREATE TABLE IF NOT EXISTS `myfriends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_id1` int(11) NOT NULL,
  `friend_id2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `myfriends` ( `friend_id1`, `friend_id2`) 
VALUES 
( '1', '3'),
( '2', '5'),
( '6', '8'),
( '1', '4'),
( '6', '3'),
( '5', '2'),
( '4', '5'),
( '5', '8'),
( '1', '2'),
( '9', '1'),
( '10', '2'),
( '10', '1'),
( '10', '3'),
( '7', '8'),
( '8', '7'),
( '5', '6'),
( '4', '2'),
( '4', '7'),
( '9', '10'),
( '1', '10')
;