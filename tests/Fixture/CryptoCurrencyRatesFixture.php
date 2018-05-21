<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CryptoCurrencyRatesFixture
 *
 */
class CryptoCurrencyRatesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 4, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'id', 'autoIncrement' => true, 'precision' => null],
        'crypto_currency_id' => ['type' => 'integer', 'length' => 4, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'Currency id', 'precision' => null, 'autoIncrement' => null],
        'crypto_currency_name' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Currency Name', 'precision' => null, 'fixed' => null],
        'symbol' => ['type' => 'string', 'fixed' => true, 'length' => 4, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Currency Symbol', 'precision' => null],
        'price' => ['type' => 'decimal', 'length' => 12, 'precision' => 6, 'unsigned' => true, 'null' => false, 'default' => '0.000000', 'comment' => 'Price'],
        'market_capitalization' => ['type' => 'decimal', 'length' => 18, 'precision' => 6, 'unsigned' => true, 'null' => false, 'default' => '0.000000', 'comment' => 'Market Capitalization'],
        'circulating_supply' => ['type' => 'decimal', 'length' => 18, 'precision' => 6, 'unsigned' => true, 'null' => false, 'default' => '0.000000', 'comment' => 'Circulating Supply'],
        'volume' => ['type' => 'decimal', 'length' => 12, 'precision' => 0, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => 'Volume'],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record modify date', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record create date', 'precision' => null],
        'created_by' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modified_by' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'UNQ_CRYPTO_RATE_ID' => ['type' => 'unique', 'columns' => ['crypto_currency_id'], 'length' => []],
            'UNQ_CRYPTO_RATE_NAME_SYMBOL' => ['type' => 'unique', 'columns' => ['crypto_currency_name', 'symbol'], 'length' => []],
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
                'crypto_currency_id' => 1,
                'crypto_currency_name' => 'Lorem ipsum do',
                'symbol' => 'Lo',
                'price' => 1.5,
                'market_capitalization' => 1.5,
                'circulating_supply' => 1.5,
                'volume' => 1.5,
                'created' => '2018-05-21 06:51:27',
                'modified' => '2018-05-21 06:51:27',
                'created_by' => 1,
                'modified_by' => 1
            ],
        ];
        parent::init();
    }
}
