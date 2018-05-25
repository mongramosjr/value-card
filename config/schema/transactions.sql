DROP TABLE IF EXISTS `crypto_transactions`;
CREATE TABLE `crypto_transactions` (
  `id` char(36) COMMENT 'id',
  `customer_user_id` char(36) DEFAULT NULL COMMENT 'User id',
  `amount` decimal(12,6) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Amount',
  `source_wallet_address` varchar(128) COMMENT 'Wallet Address',
  `target_wallet_address` varchar(128) COMMENT 'Wallet Address',
  `fees` decimal(8,6) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Fees',
  `acquirer_reference` varchar(128) COMMENT 'Payment Gateway Acquirer Reference',
  `currency_amount` decimal(12,6) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Amount in Currency',
  `currency_id` int(4) UNSIGNED ZEROFILL COMMENT 'Currency id',
  `currency_name` varchar(16) DEFAULT NULL COMMENT 'Currency Name',
  `transaction_hash` varchar(128) COMMENT 'Transaction Hash',
  `transaction_type` varchar(8) DEFAULT NULL COMMENT '(inbound, outbound)',
  `crypto_currency_id` int(4) UNSIGNED ZEROFILL COMMENT 'Currency id',
  `crypto_currency_name` varchar(16) DEFAULT NULL COMMENT 'Currency Name',
  `state` varchar(8) DEFAULT NULL COMMENT '(pending, completed)',
  `date_completed` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'record modify date',
  `created` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'record modify date',
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'record create date',
  `created_by` int(8) UNSIGNED ZEROFILL,
  `modified_by` int(8) UNSIGNED ZEROFILL,
  PRIMARY KEY (`id`),
  KEY `KEY_CRYPTO_TRANS_USER` (`customer_user_id`),
  KEY `KEY_CRYPTO_TRANS_TARGET_ADDRESS` (`target_wallet_address`),
  KEY `KEY_CRYPTO_TRANS_SOURCE_ADDRESS` (`source_wallet_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Crypto Transactions';




