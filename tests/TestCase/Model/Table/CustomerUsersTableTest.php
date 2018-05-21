<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerUsersTable Test Case
 */
class CustomerUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerUsersTable
     */
    public $CustomerUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.customer_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomerUsers') ? [] : ['className' => CustomerUsersTable::class];
        $this->CustomerUsers = TableRegistry::get('CustomerUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerUsers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
