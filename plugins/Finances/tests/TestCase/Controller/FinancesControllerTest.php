<?php
declare(strict_types=1);

namespace Finances\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Finances\Controller\FinancesController;

/**
 * Finances\Controller\FinancesController Test Case
 *
 * @link \Finances\Controller\FinancesController
 */
class FinancesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'plugin.Finances.Finances',
    ];

    /**
     * Test index method
     *
     * @return void
     * @link \Finances\Controller\FinancesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @link \Finances\Controller\FinancesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @link \Finances\Controller\FinancesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @link \Finances\Controller\FinancesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @link \Finances\Controller\FinancesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
