<?php
declare(strict_types=1);

namespace Geo\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Geo\Model\Table\LocationsTable;

/**
 * Geo\Model\Table\LocationsTable Test Case
 */
class LocationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Geo\Model\Table\LocationsTable
     */
    protected $Locations;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'plugin.Geo.Locations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Locations') ? [] : ['className' => LocationsTable::class];
        $this->Locations = $this->getTableLocator()->get('Locations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Locations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \Geo\Model\Table\LocationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \Geo\Model\Table\LocationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
