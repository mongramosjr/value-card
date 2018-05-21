<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CryptoWalletsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CryptoWalletsTable Test Case
 */
class CryptoWalletsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CryptoWalletsTable
     */
    public $CryptoWallets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.crypto_wallets',
        'app.customer_users',
        'app.crypto_currencies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CryptoWallets') ? [] : ['className' => CryptoWalletsTable::class];
        $this->CryptoWallets = TableRegistry::get('CryptoWallets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CryptoWallets);

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
