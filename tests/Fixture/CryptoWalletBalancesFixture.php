<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CryptoWalletBalancesFixture
 *
 */
class CryptoWalletBalancesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Balance id', 'autoIncrement' => true, 'precision' => null],
        'customer_user_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'User ID', 'precision' => null],
        'crypto_wallet_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'Default Wallet', 'precision' => null],
        'crypto_currency_id' => ['type' => 'integer', 'length' => 4, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'crypto_currency_name' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Currency Name', 'precision' => null, 'fixed' => null],
        'amount' => ['type' => 'decimal', 'length' => 12, 'precision' => 6, 'unsigned' => true, 'null' => false, 'default' => '0.000000', 'comment' => 'Amount'],
        'currency_amount' => ['type' => 'decimal', 'length' => 12, 'precision' => 6, 'unsigned' => true, 'null' => false, 'default' => '0.000000', 'comment' => 'Amount in Currency'],
        'currency_id' => ['type' => 'integer', 'length' => 4, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'Currency id', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'KEY_CRYPTO_WALLET_BAL_ID' => ['type' => 'index', 'columns' => ['crypto_wallet_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'UNQ_CRYPTO_WALLET_BAL_USER_CRYPTO' => ['type' => 'unique', 'columns' => ['customer_user_id', 'crypto_currency_id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
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
                'id' => 1,
                'customer_user_id' => 'fdb4e4be-c706-447a-8fd1-ac27d1828fd4',
                'crypto_wallet_id' => '53819d88-489c-45a9-b75f-11cee6b08c01',
                'crypto_currency_id' => 1,
                'crypto_currency_name' => 'Lorem ipsum do',
                'amount' => 1.5,
                'currency_amount' => 1.5,
                'currency_id' => 1
            ],
        ];
        parent::init();
    }
}
