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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Wallet Addresses';


DROP TABLE IF EXISTS `crypto_wallet_balances`;
CREATE TABLE `crypto_wallet_balances` (
  `id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Balance id',
  `customer_user_id` char(36) DEFAULT NULL COMMENT 'User ID',
  `crypto_wallet_id` char(36) DEFAULT NULL COMMENT 'Default Wallet',
  `crypto_currency_id` int(4) UNSIGNED ZEROFILL,
  `crypto_currency_name` varchar(16) DEFAULT NULL COMMENT 'Currency Name',
  `amount` decimal(12,6) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Amount',
  `currency_amount` decimal(12,6) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Amount in Currency',
  `currency_id` int(4) UNSIGNED ZEROFILL COMMENT 'Currency id',
  PRIMARY KEY (`id`),
  KEY `KEY_CRYPTO_WALLET_BAL_ID` (`crypto_wallet_id`),
  UNIQUE KEY `UNQ_CRYPTO_WALLET_BAL_USER_CRYPTO` (`customer_user_id`, `crypto_currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Wallet Balances';
