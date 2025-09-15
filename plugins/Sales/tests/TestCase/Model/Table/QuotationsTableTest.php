<?php
declare(strict_types=1);

namespace Sales\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Sales\Model\Table\QuotationsTable;

/**
 * Sales\Model\Table\QuotationsTable Test Case
 */
class QuotationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Sales\Model\Table\QuotationsTable
     */
    protected $Quotations;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'plugin.Sales.Quotations',
        'plugin.Sales.SalesServices',
        'plugin.Sales.SalesQuotationLines',
        'plugin.Sales.Customer',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Quotations') ? [] : ['className' => QuotationsTable::class];
        $this->Quotations = $this->getTableLocator()->get('Quotations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Quotations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \Sales\Model\Table\QuotationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \Sales\Model\Table\QuotationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
