<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SignupConfirmationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SignupConfirmationsTable Test Case
 */
class SignupConfirmationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SignupConfirmationsTable
     */
    public $SignupConfirmations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.signup_confirmations',
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
        $config = TableRegistry::getTableLocator()->exists('SignupConfirmations') ? [] : ['className' => SignupConfirmationsTable::class];
        $this->SignupConfirmations = TableRegistry::getTableLocator()->get('SignupConfirmations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SignupConfirmations);

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
