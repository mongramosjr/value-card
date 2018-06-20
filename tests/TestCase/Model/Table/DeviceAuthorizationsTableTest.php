<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeviceAuthorizationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeviceAuthorizationsTable Test Case
 */
class DeviceAuthorizationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DeviceAuthorizationsTable
     */
    public $DeviceAuthorizations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.device_authorizations',
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
        $config = TableRegistry::getTableLocator()->exists('DeviceAuthorizations') ? [] : ['className' => DeviceAuthorizationsTable::class];
        $this->DeviceAuthorizations = TableRegistry::getTableLocator()->get('DeviceAuthorizations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DeviceAuthorizations);

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
