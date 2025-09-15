<?php
declare(strict_types=1);

namespace Sales\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesServicesFixture
 */
class SalesServicesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'parent_id' => 1,
                'lft' => 1,
                'rght' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'transport_mode' => 'Lorem ipsum dolor ',
                'created' => '2025-09-15 07:31:04',
                'modified' => '2025-09-15 07:31:04',
            ],
        ];
        parent::init();
    }
}
