DROP TABLE IF EXISTS `device_authorizations`;
CREATE TABLE `device_authorizations` (
  `id` char(36) COMMENT 'id',
  `customer_user_id` char(36) DEFAULT NULL COMMENT 'User id',
  `device_info` varchar(128) DEFAULT NULL COMMENT 'Device ID',
  `date_completed` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'record modify date',
  `dauth_token` text COMMENT 'Device Auth Token Using Openssl',
  `dauth_token_created_at` timestamp NULL DEFAULT NULL COMMENT 'Device Auth Token Creation Date',
  `is_completed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Status of Device Auth',
  `created` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'record modify date',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'record create date',
  PRIMARY KEY (`id`),
  KEY `KEY_DEVICE_AUTH_USER` (`customer_user_id`),
  KEY `KEY_DEVICE_AUTH_DATE` (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Device Authorizations';
