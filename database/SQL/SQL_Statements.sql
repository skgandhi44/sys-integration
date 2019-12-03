
/*Create database for the application*/
CREATE DATABASE `IT490`;

USE IT490;

/*Create a SQL user to give access to the database*/
GRANT ALL PRIVILEGES ON *.* TO 'IT490_user'@'localhost' IDENTIFIED BY '';



/*Create table to record allergy flags from the users*/
CREATE TABLE `allergy` (
  `Email` varchar(255) NOT NULL,
  `Egg` varchar(1) NOT NULL,
  `Soy` varchar(1) NOT NULL,
  `Milk` varchar(1) NOT NULL,
  `Peanuts` varchar(1) NOT NULL,
  `Shellfish` varchar(1) NOT NULL,
  `Wheat` varchar(1) NOT NULL,
  `Gluten` varchar(1) NOT NULL,
  `Treenut` varchar(1) NOT NULL,
  `Fish` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Create table to create a token for resetting the password*/
CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Create table to record the food consumption from the users*/
CREATE TABLE `user_product_list` (
  `email` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `food_name` varchar(255) NOT NULL,
  `serving_count` decimal(5,1) NOT NULL,
  `serving_unit` varchar(100) NOT NULL,
  `calories` decimal(10,2) NOT NULL,
  PRIMARY KEY (`email`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Create table to record the user information*/
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `heightInInches` int(11) NOT NULL,
  `weightInPound` int(11) NOT NULL,
  `UserBMI` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

