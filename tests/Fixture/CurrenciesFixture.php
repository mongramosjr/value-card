<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CurrenciesFixture
 *
 */
class CurrenciesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 4, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Currency id', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Currency Name', 'precision' => null, 'fixed' => null],
        'symbol' => ['type' => 'string', 'fixed' => true, 'length' => 4, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Currency Symbol', 'precision' => null],
        'rounding' => ['type' => 'decimal', 'length' => 7, 'precision' => 6, 'unsigned' => true, 'null' => false, 'default' => '0.000000', 'comment' => 'Rounding'],
        'is_active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => 'Status', 'precision' => null],
        'position' => ['type' => 'string', 'length' => 5, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Position', 'precision' => null, 'fixed' => null],
        'currency_unit_label' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Currency Label', 'precision' => null, 'fixed' => null],
        'currency_subunit_label' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Currency Label', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record modify date', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record create date', 'precision' => null],
        'created_by' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modified_by' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'UNQ_CURRENCY_NAME_SYMBOL' => ['type' => 'unique', 'columns' => ['name', 'symbol'], 'length' => []],
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
                'name' => 'Lorem ipsum do',
                'symbol' => 'Lo',
                'rounding' => 1.5,
                'is_active' => 1,
                'position' => 'Lor',
                'currency_unit_label' => 'Lorem ipsum do',
                'currency_subunit_label' => 'Lorem ipsum do',
                'created' => '2018-05-21 10:16:23',
                'modified' => '2018-05-21 10:16:23',
                'created_by' => 1,
                'modified_by' => 1
            ],
        ];
        parent::init();
    }
}
