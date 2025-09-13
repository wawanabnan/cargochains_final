<?php
use Migrations\AbstractSeed;

class ShipmentRoutesSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');
        $data = [[
            'id' => 1,
            'shipment_id' => 1,
            'origin_id' => 10,
            'destination_id' => 20,
            'transportation_type_id' => 1,
            'created' => $now,
            'modified' => $now,
        ]];
        $this->table('shipment_routes')->insert($data)->save();
    }
}
