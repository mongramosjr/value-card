<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CryptoCurrenciesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CryptoCurrenciesTable Test Case
 */
class CryptoCurrenciesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CryptoCurrenciesTable
     */
    public $CryptoCurrencies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.crypto_currencies',
        'app.crypto_wallets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CryptoCurrencies') ? [] : ['className' => CryptoCurrenciesTable::class];
        $this->CryptoCurrencies = TableRegistry::get('CryptoCurrencies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CryptoCurrencies);

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
}
