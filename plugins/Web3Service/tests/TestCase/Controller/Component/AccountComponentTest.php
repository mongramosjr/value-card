<?php
namespace Web3Service\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Web3Service\Controller\Component\AccountComponent;

/**
 * Web3Service\Controller\Component\AccountComponent Test Case
 */
class AccountComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Web3Service\Controller\Component\AccountComponent
     */
    public $Account;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Account = new AccountComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Account);

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
