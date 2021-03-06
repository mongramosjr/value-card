<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CryptoCurrencyRatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CryptoCurrencyRatesTable Test Case
 */
class CryptoCurrencyRatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CryptoCurrencyRatesTable
     */
    public $CryptoCurrencyRates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.crypto_currency_rates',
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
        $config = TableRegistry::exists('CryptoCurrencyRates') ? [] : ['className' => CryptoCurrencyRatesTable::class];
        $this->CryptoCurrencyRates = TableRegistry::get('CryptoCurrencyRates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CryptoCurrencyRates);

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
