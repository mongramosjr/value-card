<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AccountUserComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\AccountUserComponent Test Case
 */
class AccountUserComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\AccountUserComponent
     */
    public $AccountUser;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->AccountUser = new AccountUserComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountUser);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
