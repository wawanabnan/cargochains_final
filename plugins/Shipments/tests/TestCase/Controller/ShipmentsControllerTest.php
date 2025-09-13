<?php
declare(strict_types=1);

namespace Shipments\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Shipments\Controller\ShipmentsController;

/**
 * Shipments\Controller\ShipmentsController Test Case
 *
 * @link \Shipments\Controller\ShipmentsController
 */
class ShipmentsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'plugin.Shipments.Shipments',
        'plugin.Shipments.Shippers',
        'plugin.Shipments.Consignees',
        'plugin.Shipments.Carriers',
        'plugin.Shipments.Agencies',
        'plugin.Shipments.ShipmentDocuments',
        'plugin.Shipments.ShipmentRoutes',
    ];

    /**
     * Test index method
     *
     * @return void
     * @link \Shipments\Controller\ShipmentsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @link \Shipments\Controller\ShipmentsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @link \Shipments\Controller\ShipmentsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @link \Shipments\Controller\ShipmentsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @link \Shipments\Controller\ShipmentsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
