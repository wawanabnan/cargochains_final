<?php
declare(strict_types=1);

namespace Partners\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Partners\Model\Table\PartnersTable;

/**
 * Partners\Model\Table\PartnersTable Test Case
 */
class PartnersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Partners\Model\Table\PartnersTable
     */
    protected $Partners;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'plugin.Partners.Partners',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Partners') ? [] : ['className' => PartnersTable::class];
        $this->Partners = $this->getTableLocator()->get('Partners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Partners);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \Partners\Model\Table\PartnersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
