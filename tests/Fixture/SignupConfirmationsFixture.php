<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SignupConfirmationsFixture
 *
 */
class SignupConfirmationsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Signup Confirmation ID', 'precision' => null],
        'customer_user_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'User id', 'precision' => null],
        'ccw_token' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Create Wallet Link Token Using Openssl', 'precision' => null],
        'ccw_token_created_at' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'Create Wallet Link Token Creation Date', 'precision' => null],
        'is_done' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => 'Status of Wallet Creation', 'precision' => null],
        'is_confirmed' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => 'Status of Signup Confirmation', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created Time', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'Modified Time', 'precision' => null],
        '_indexes' => [
            'KEY_SIGNUP_USER' => ['type' => 'index', 'columns' => ['customer_user_id'], 'length' => []],
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
                'id' => '3ba31a92-4f68-4dbf-b0fe-80fc01097d52',
                'customer_user_id' => '4eede2b0-7f89-4a65-932b-7a84a4224683',
                'ccw_token' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'ccw_token_created_at' => 1529454974,
                'is_done' => 1,
                'is_confirmed' => 1,
                'created' => '2018-06-20 00:36:14',
                'modified' => '2018-06-20 00:36:14'
            ],
        ];
        parent::init();
    }
}
