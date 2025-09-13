<?php
declare(strict_types=1);

namespace Sales\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Sales\Model\Table\SalesQuotationsTable;

/**
 * Sales\Model\Table\SalesQuotationsTable Test Case
 */
class SalesQuotationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Sales\Model\Table\SalesQuotationsTable
     */
    protected $SalesQuotations;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'plugin.Sales.SalesQuotations',
        'plugin.Sales.SalesQuotationLines',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SalesQuotations') ? [] : ['className' => SalesQuotationsTable::class];
        $this->SalesQuotations = $this->getTableLocator()->get('SalesQuotations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SalesQuotations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \Sales\Model\Table\SalesQuotationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \Sales\Model\Table\SalesQuotationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
