<?php
use Migrations\AbstractSeed;

class ShipmentsSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');
        $data = [[
            'id' => 1,
            'number' => 'SHP-2025-0001',
            'origin_id' => 10,
            'destination_id' => 20,
            'cargo_description' => 'Electronics parts',
            'weight' => 1200.500,
            'volume' => 3.250,
            'qty' => 100,
            'shipper_id' => 101,
            'consignee_id' => 202,
            'carrier_id' => 303,
            'agency_id' => 404,
            'etd' => date('Y-m-d', strtotime('+3 days')),
            'eta' => date('Y-m-d', strtotime('+15 days')),
            'atd' => null,
            'ata' => null,
            'status' => 'DRAFT',
            'is_multimoda' => 1,
            'origin' => 'Jakarta',
            'destination' => 'Singapore',
            'bill_of_lading_no' => null,
            'total' => null,
            'created' => $now,
            'modified' => $now,
        ]];
        $this->table('shipments')->insert($data)->save();
    }
}
