<?php
declare(strict_types=1);

namespace Shipments\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ShipmentRoutesFixture extends TestFixture
{
    public string $table = 'shipment_routes';

    public array $records = [[
        'id' => 1,
        'shipment_id' => 1,
        'origin_id' => 10,
        'destination_id' => 20,
        'transportation_type_id' => 1,
        'created' => '2025-09-11 00:00:00',
        'modified' => '2025-09-11 00:00:00',
    ]];
}
