<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DeviceAuthorizationsFixture
 *
 */
class DeviceAuthorizationsFixture extends TestFixture
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
        'device_info' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Device ID', 'precision' => null, 'fixed' => null],
        'date_completed' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record modify date', 'precision' => null],
        'dauth_token' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Device Auth Token Using Openssl', 'precision' => null],
        'dauth_token_created_at' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'Device Auth Token Creation Date', 'precision' => null],
        'is_completed' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => 'Status of Device Auth', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record modify date', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record create date', 'precision' => null],
        '_indexes' => [
            'KEY_DEVICE_AUTH_USER' => ['type' => 'index', 'columns' => ['customer_user_id'], 'length' => []],
            'KEY_DEVICE_AUTH_DATE' => ['type' => 'index', 'columns' => ['created'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
                'id' => 'bfcf6417-f725-4623-a52b-5214934553a2',
                'customer_user_id' => '004f47f9-decc-4863-b31e-c7695b8d3a54',
                'device_info' => 'Lorem ipsum dolor sit amet',
                'date_completed' => '2018-06-20 00:36:06',
                'dauth_token' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'dauth_token_created_at' => 1529454966,
                'is_completed' => 1,
                'created' => '2018-06-20 00:36:06',
                'modified' => '2018-06-20 00:36:06'
            ],
        ];
        parent::init();
    }
}
