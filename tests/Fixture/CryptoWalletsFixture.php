<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CryptoWalletsFixture
 *
 */
class CryptoWalletsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 9, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Wallet id', 'autoIncrement' => true, 'precision' => null],
        'customer_user_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'User id', 'precision' => null],
        'wallet_address' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Wallet Address', 'precision' => null, 'fixed' => null],
        'crypto_currency_id' => ['type' => 'integer', 'length' => 4, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'crypto_currency_name' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Currency Name', 'precision' => null, 'fixed' => null],
        'password_crypt' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Password', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'KEY_CRYPTO_WALLET_USER' => ['type' => 'index', 'columns' => ['customer_user_id'], 'length' => []],
            'KEY_CRYPTO_WALLET_ADDRESS' => ['type' => 'index', 'columns' => ['wallet_address'], 'length' => []],
            'KEY_CRYPTO_WALLET_CURRENCY' => ['type' => 'index', 'columns' => ['crypto_currency_id'], 'length' => []],
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
                'id' => 1,
                'customer_user_id' => 'c547e317-065c-4436-b820-96578be0e82c',
                'wallet_address' => 'Lorem ipsum dolor sit amet',
                'crypto_currency_id' => 1,
                'crypto_currency_name' => 'Lorem ipsum do',
                'password_crypt' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
