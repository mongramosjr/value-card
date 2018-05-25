DROP TABLE IF EXISTS `api_users`;
CREATE TABLE `api_users` (
  `id` char(36) COMMENT 'User id',
  `full_name` varchar(32) DEFAULT NULL COMMENT 'Full Name',
  `email` varchar(128) DEFAULT NULL COMMENT 'Email',
  
  `api_key` varchar(100) DEFAULT NULL COMMENT 'Api key',
  
  `created` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'User record modify date',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'User record create date',
  
  `lognum` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Quantity of log ins',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Account status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Api Users';


DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` char(36) COMMENT  'User ID',
  `first_name` varchar(32) DEFAULT NULL COMMENT 'User First Name',
  `last_name` varchar(32) DEFAULT NULL COMMENT 'User Last Name',
  `email` varchar(128) DEFAULT NULL COMMENT 'User Email',
  `password_crypt` varchar(100) DEFAULT NULL COMMENT 'User Password',
  `created` datetime DEFAULT CURRENT_TIMESTAMP  COMMENT 'User Created Time',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'User Modified Time',
  `logdate` timestamp NULL DEFAULT NULL COMMENT 'User Last Login Time',
  `lognum` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'User Login Number',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'User Is Active',
  `rp_token` text COMMENT 'Reset Password Link Token',
  `rp_token_created_at` timestamp NULL DEFAULT NULL COMMENT 'Reset Password Link Token Creation Date',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_ADMIN_USER_USERNAME` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin User Table';


DROP TABLE IF EXISTS `customer_users`;
CREATE TABLE `customer_users` (
  `id` char(36) COMMENT  'User ID',
  `full_name` varchar(32) DEFAULT NULL COMMENT 'Full Name',
  `email` varchar(128) DEFAULT NULL COMMENT 'User Email',
  `password_crypt` varchar(100) DEFAULT NULL COMMENT 'User Password',
  `created` datetime DEFAULT CURRENT_TIMESTAMP  COMMENT 'User Created Time',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'User Modified Time',
  `logdate` timestamp NULL DEFAULT NULL COMMENT 'User Last Login Time',
  `lognum` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'User Login Number',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'User Is Active',
  `rp_token` text COMMENT 'Reset Password Link Token',
  `rp_token_created_at` timestamp NULL DEFAULT NULL COMMENT 'Reset Password Link Token Creation Date',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_USER_USERNAME` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Customer Login Table';


--
-- `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User ID',
--
