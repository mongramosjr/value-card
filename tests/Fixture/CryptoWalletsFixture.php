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
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Wallet id', 'precision' => null],
        'customer_user_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'User id', 'precision' => null],
        'wallet_address' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Wallet Address', 'precision' => null, 'fixed' => null],
        'wallet_label' => ['type' => 'string', 'length' => 18, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Label', 'precision' => null, 'fixed' => null],
        'crypto_currency_id' => ['type' => 'integer', 'length' => 4, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'crypto_currency_name' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Currency Name', 'precision' => null, 'fixed' => null],
        'password_crypt' => ['type' => 'string', 'length' => 2056, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Password', 'precision' => null, 'fixed' => null],
        'keystore' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'KeyStore', 'precision' => null],
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
                'id' => '9bc1f5f9-f1b0-4dc8-9018-0fb8247c540e',
                'customer_user_id' => '23c94df5-96b1-4826-a9cf-50fbbbc21cd2',
                'wallet_address' => 'Lorem ipsum dolor sit amet',
                'wallet_label' => 'Lorem ipsum dolo',
                'crypto_currency_id' => 1,
                'crypto_currency_name' => 'Lorem ipsum do',
                'password_crypt' => 'Lorem ipsum dolor sit amet',
                'keystore' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
            ],
        ];
        parent::init();
    }
}
