<?php
declare(strict_types=1);

namespace Shipments\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class TransportationTypesFixture extends TestFixture
{
    public string $table = 'transportation_types';

    public array $records = [
        ['id' => 1, 'name' => 'Sea Freight',  'transportation_mode' => 'SEA',  'created' => '2025-09-11 00:00:00'],
        ['id' => 2, 'name' => 'Air Freight',  'transportation_mode' => 'AIR',  'created' => '2025-09-11 00:00:00'],
        ['id' => 3, 'name' => 'Land Trucking','transportation_mode' => 'LAND', 'created' => '2025-09-11 00:00:00'],
    ];
}
