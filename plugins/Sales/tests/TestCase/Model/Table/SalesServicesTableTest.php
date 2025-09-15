<?php
declare(strict_types=1);

namespace Sales\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Sales\Model\Table\SalesServicesTable;

/**
 * Sales\Model\Table\SalesServicesTable Test Case
 */
class SalesServicesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Sales\Model\Table\SalesServicesTable
     */
    protected $SalesServices;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'plugin.Sales.SalesServices',
        'plugin.Sales.SalesOrders',
        'plugin.Sales.SalesQuotations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SalesServices') ? [] : ['className' => SalesServicesTable::class];
        $this->SalesServices = $this->getTableLocator()->get('SalesServices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SalesServices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \Sales\Model\Table\SalesServicesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \Sales\Model\Table\SalesServicesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
