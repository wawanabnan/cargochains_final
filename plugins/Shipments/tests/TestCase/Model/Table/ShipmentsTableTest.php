<?php
declare(strict_types=1);

namespace Shipments\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Shipments\Model\Table\ShipmentsTable;

/**
 * Shipments\Model\Table\ShipmentsTable Test Case
 */
class ShipmentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Shipments\Model\Table\ShipmentsTable
     */
    protected $Shipments;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'plugin.Shipments.Shipments',
        'plugin.Shipments.Shipper',
        'plugin.Shipments.Consignee',
        'plugin.Shipments.Carrier',
        'plugin.Shipments.Agency',
        'plugin.Shipments.ShipmentRoutes',
        'plugin.Shipments.ShipmentDocuments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Shipments') ? [] : ['className' => ShipmentsTable::class];
        $this->Shipments = $this->getTableLocator()->get('Shipments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Shipments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \Shipments\Model\Table\ShipmentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
