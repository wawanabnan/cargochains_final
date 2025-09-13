<?php
declare(strict_types=1);

namespace Geo\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LocationsFixture
 */
class LocationsFixture extends TestFixture
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
                'code' => 'Lorem ipsum dolor ',
                'name' => 'Lorem ipsum dolor sit amet',
                'kind' => 'Lorem ipsum dolor ',
                'parent_id' => 1,
                'lft' => 1,
                'rght' => 1,
                'iata_code' => 'Lorem ip',
                'unlocode' => 'Lorem ip',
                'latitude' => 1.5,
                'longitude' => 1.5,
            ],
        ];
        parent::init();
    }
}
