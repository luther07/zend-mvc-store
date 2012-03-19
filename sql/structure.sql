--
-- Definition of table `storefront`.`category`
--
-- If you place a USE db_name statement in the file, it is unnecessary to specify the
-- database name on the command line.

USE storefront

CREATE TABLE  `category` (
  `categoryId` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `parentId` int(10) unsigned NOT NULL,
  `ident` varchar(200) NOT NULL,
  PRIMARY KEY  (`categoryId`),
  UNIQUE KEY `ident` (`ident`),
  KEY `parent` (`parentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Definition of table `storefront`.`product`
--

USE storefront

CREATE TABLE  `product` (
  `productId` int(10) unsigned NOT NULL auto_increment,
  `categoryId` int(10) unsigned NOT NULL,
  `ident` varchar(56) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `shortDescription` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discountPercent` int(3) NOT NULL,
  `taxable` enum('Yes','No') NOT NULL,
  PRIMARY KEY  (`productId`),
  UNIQUE KEY `ident` (`ident`),
  KEY `category` (`categoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Definition of table `storefront`.`productImage`
--

USE storefront

CREATE TABLE  `productImage` (
  `imageId` int(10) unsigned NOT NULL auto_increment,
  `productId` int(10) unsigned NOT NULL,
  `thumbnail` varchar(200) NOT NULL,
  `full` varchar(200) NOT NULL,
  `isDefault` enum('Yes','No') NOT NULL default 'No',
  PRIMARY KEY  (`imageId`),
  KEY `productId` (`productId`),
  CONSTRAINT `fk_product` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Definition of table `storefront`.`user`
--

USE storefront

CREATE TABLE  `user` (
  `userId` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(10) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `passwd` char(40) NOT NULL,
  `salt` char(32) NOT NULL,
  `role` varchar(100) NOT NULL default 'customer',
  PRIMARY KEY  (`userId`),
  KEY `email_pass` (`email`,`passwd`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
