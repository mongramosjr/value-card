<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CryptoTransactionsFixture
 *
 */
class CryptoTransactionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'id', 'precision' => null],
        'customer_user_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'User id', 'precision' => null],
        'amount' => ['type' => 'decimal', 'length' => 12, 'precision' => 6, 'unsigned' => true, 'null' => false, 'default' => '0.000000', 'comment' => 'Amount'],
        'source_wallet_address' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Wallet Address', 'precision' => null, 'fixed' => null],
        'target_wallet_address' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Wallet Address', 'precision' => null, 'fixed' => null],
        'fees' => ['type' => 'decimal', 'length' => 8, 'precision' => 6, 'unsigned' => true, 'null' => false, 'default' => '0.000000', 'comment' => 'Fees'],
        'acquirer_reference' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Payment Gateway Acquirer Reference', 'precision' => null, 'fixed' => null],
        'currency_amount' => ['type' => 'decimal', 'length' => 12, 'precision' => 6, 'unsigned' => true, 'null' => false, 'default' => '0.000000', 'comment' => 'Amount in Currency'],
        'currency_id' => ['type' => 'integer', 'length' => 4, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'Currency id', 'precision' => null, 'autoIncrement' => null],
        'currency_name' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Currency Name', 'precision' => null, 'fixed' => null],
        'transaction_hash' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Transaction Hash', 'precision' => null, 'fixed' => null],
        'transaction_type' => ['type' => 'string', 'length' => 8, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '(inbound, outbound)', 'precision' => null, 'fixed' => null],
        'crypto_currency_id' => ['type' => 'integer', 'length' => 4, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'Currency id', 'precision' => null, 'autoIncrement' => null],
        'crypto_currency_name' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Currency Name', 'precision' => null, 'fixed' => null],
        'state' => ['type' => 'string', 'length' => 8, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '(pending, completed)', 'precision' => null, 'fixed' => null],
        'date_completed' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record modify date', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record modify date', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record create date', 'precision' => null],
        'created_by' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modified_by' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'KEY_CRYPTO_TRANS_USER' => ['type' => 'index', 'columns' => ['customer_user_id'], 'length' => []],
            'KEY_CRYPTO_TRANS_TARGET_ADDRESS' => ['type' => 'index', 'columns' => ['target_wallet_address'], 'length' => []],
            'KEY_CRYPTO_TRANS_SOURCE_ADDRESS' => ['type' => 'index', 'columns' => ['source_wallet_address'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 'f264cf44-6873-419d-b3be-9df831f7ed9b',
                'customer_user_id' => '76e4cb75-b9b9-443c-bb04-c46ffe70cd30',
                'amount' => 1.5,
                'source_wallet_address' => 'Lorem ipsum dolor sit amet',
                'target_wallet_address' => 'Lorem ipsum dolor sit amet',
                'fees' => 1.5,
                'acquirer_reference' => 'Lorem ipsum dolor sit amet',
                'currency_amount' => 1.5,
                'currency_id' => 1,
                'currency_name' => 'Lorem ipsum do',
                'transaction_hash' => 'Lorem ipsum dolor sit amet',
                'transaction_type' => 'Lorem ',
                'crypto_currency_id' => 1,
                'crypto_currency_name' => 'Lorem ipsum do',
                'state' => 'Lorem ',
                'date_completed' => '2018-05-21 10:20:47',
                'created' => '2018-05-21 10:20:47',
                'modified' => '2018-05-21 10:20:47',
                'created_by' => 1,
                'modified_by' => 1
            ],
        ];
        parent::init();
    }
}
