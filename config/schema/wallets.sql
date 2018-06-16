DROP TABLE IF EXISTS `crypto_wallets`;
CREATE TABLE `crypto_wallets` (
  `id` char(36) COMMENT 'Wallet id',
  `customer_user_id` char(36) DEFAULT NULL COMMENT 'User id',
  `wallet_address` varchar(128) COMMENT 'Wallet Address',
  `wallet_label` varchar(18) COMMENT 'Label',
  `crypto_currency_id` int(4) UNSIGNED ZEROFILL,
  `crypto_currency_name` varchar(16) DEFAULT NULL COMMENT 'Currency Name',
  `password_crypt` varchar(2056) DEFAULT NULL COMMENT 'Password',
  `keystore` text DEFAULT NULL COMMENT 'KeyStore',
  PRIMARY KEY (`id`),
  KEY `KEY_CRYPTO_WALLET_USER` (`customer_user_id`),
  KEY `KEY_CRYPTO_WALLET_ADDRESS` (`wallet_address`),
  KEY `KEY_CRYPTO_WALLET_CURRENCY` (`crypto_currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Api Users';




DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Currency id',
  `name` varchar(16) DEFAULT NULL COMMENT 'Currency Name',
  `symbol` char(8) DEFAULT NULL COMMENT 'Currency Symbol',
  `rounding` decimal(7,6) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Rounding',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status',
  `position` varchar(6) DEFAULT 'after' COMMENT 'Position',
  `currency_unit_label` varchar(16) DEFAULT NULL COMMENT 'Currency Label',
  `currency_subunit_label` varchar(16) DEFAULT NULL COMMENT 'Currency Label',
  `created` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'record modify date',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'record create date',
  `created_by` int(8) UNSIGNED ZEROFILL,
  `modified_by` int(8) UNSIGNED ZEROFILL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_CURRENCY_NAME_SYMBOL` (`name`,`symbol`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Currency';

DROP TABLE IF EXISTS `crypto_currencies`;
CREATE TABLE `crypto_currencies` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Currency id',
  `name` varchar(16) DEFAULT NULL COMMENT 'Currency Name',
  `symbol`  char(8) DEFAULT NULL COMMENT 'Currency Symbol',
  `rounding` decimal(7,6) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Rounding',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status',
  `position` varchar(6) DEFAULT 'after' COMMENT 'Position',
  `currency_unit_label` varchar(16) DEFAULT NULL COMMENT 'Currency Label',
  `currency_unit_tag` varchar(16) DEFAULT NULL COMMENT 'Currency Category (coins, points, point values, reward points)',
  `created` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'record modify date',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'record create date',
  `created_by` int(8) UNSIGNED ZEROFILL,
  `modified_by` int(8) UNSIGNED ZEROFILL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_CRYPTO_NAME_SYMBOL` (`name`,`symbol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Crypto Currency';

REPLACE INTO `crypto_currencies` (`id`, `name`, `symbol`, `rounding`, `is_active`, `position`, `currency_unit_label`, `currency_unit_tag`, `created`, `modified`, `created_by`, `modified_by`) 
VALUES ('1', 'PV', 'ᜩᜳ', '0.000001', '1', 'after', 'Varatto', 'reward points', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, NULL);

REPLACE INTO `crypto_currencies` (`id`, `name`, `symbol`, `rounding`, `is_active`, `position`, `currency_unit_label`, `currency_unit_tag`, `created`, `modified`, `created_by`, `modified_by`) 
VALUES ('2', 'NU', 'ᜨᜳ', '0.000001', '1', 'after', 'Nutracoin', 'coins', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, NULL);

REPLACE INTO `crypto_currencies` (`id`, `name`, `symbol`, `rounding`, `is_active`, `position`, `currency_unit_label`, `currency_unit_tag`, `created`, `modified`, `created_by`, `modified_by`) 
VALUES ('3', 'ETH', 'Ξ', '0.000001', '1', 'before', 'Ethereum', 'coins', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, NULL);

REPLACE INTO `crypto_currencies` (`id`, `name`, `symbol`, `rounding`, `is_active`, `position`, `currency_unit_label`, `currency_unit_tag`, `created`, `modified`, `created_by`, `modified_by`) 
VALUES ('4', 'BTC', '₿', '0.000001', '0', 'before', 'Bitcoin', 'coins', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, NULL);

REPLACE INTO `crypto_currencies` (`id`, `name`, `symbol`, `rounding`, `is_active`, `position`, `currency_unit_label`, `currency_unit_tag`, `created`, `modified`, `created_by`, `modified_by`) 
VALUES ('5', 'LTC', 'Ł', '0.000001', '0', 'after', 'Litecoin', 'coins', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, NULL);

DROP TABLE IF EXISTS `crypto_currency_rates`;
CREATE TABLE `crypto_currency_rates` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'id',
  `crypto_currency_id` int(4) UNSIGNED ZEROFILL COMMENT 'Currency id',
  `crypto_currency_name` varchar(16) DEFAULT NULL COMMENT 'Currency Name',
  `symbol`  char(4) DEFAULT NULL COMMENT 'Currency Symbol',
  `price` decimal(12,6) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Price',
  `market_capitalization` decimal(18,6) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Market Capitalization',
  `circulating_supply` decimal(18,6) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Circulating Supply',
  `volume` decimal(12,0) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Volume',
  `currency_id` int(4) UNSIGNED ZEROFILL COMMENT 'default currency is in USD',
  `currency_name` varchar(16) DEFAULT NULL COMMENT 'Currency Name',
  `created` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'record modify date',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'record create date',
  `created_by` int(8) UNSIGNED ZEROFILL,
  `modified_by` int(8) UNSIGNED ZEROFILL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_CRYPTO_RATE_ID` (`crypto_currency_id`, `currency_id`),
  UNIQUE KEY `UNQ_CRYPTO_RATE_NAME_SYMBOL` (`crypto_currency_name`,`symbol`,`currency_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Crypto Currency';

