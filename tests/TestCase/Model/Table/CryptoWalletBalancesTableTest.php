<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CryptoWalletBalancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CryptoWalletBalancesTable Test Case
 */
class CryptoWalletBalancesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CryptoWalletBalancesTable
     */
    public $CryptoWalletBalances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.crypto_wallet_balances',
        'app.customer_users',
        'app.crypto_wallets',
        'app.crypto_currencies',
        'app.currencies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CryptoWalletBalances') ? [] : ['className' => CryptoWalletBalancesTable::class];
        $this->CryptoWalletBalances = TableRegistry::getTableLocator()->get('CryptoWalletBalances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CryptoWalletBalances);

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
