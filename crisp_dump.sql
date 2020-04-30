-- Dump for DB name: 'crisp'

CREATE DATABASE crisp;

CREATE TABLE `links` (  
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `url` TEXT NOT NULL,
  `directory` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;