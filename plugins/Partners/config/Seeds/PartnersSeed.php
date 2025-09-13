<?php
use Migrations\AbstractSeed;

class PartnersSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            ['id' => 1, 'code' => 'CUST-PTA', 'name' => 'PT Alpha Logistics', 'email' => 'alpha@example.com', 'phone' => '+62-21-1111', 'city' => 'Jakarta', 'country' => 'ID', 'is_customer' => 1, 'created' => $now],
            ['id' => 2, 'code' => 'VEND-PTB', 'name' => 'PT Beta Supplier',   'email' => 'beta@example.com',  'phone' => '+62-21-2222', 'city' => 'Surabaya','country' => 'ID', 'is_vendor' => 1, 'created' => $now],
            ['id' => 3, 'code' => 'CARR-SHIP', 'name' => 'ShipCo Lines',      'email' => 'ops@shipco.com',    'phone' => '+62-21-3333', 'city' => 'Jakarta', 'country' => 'ID', 'is_carrier' => 1, 'created' => $now],
            ['id' => 4, 'code' => 'AGNT-GAM',  'name' => 'Gamma Agency',      'email' => 'hello@gamma.id',    'phone' => '+62-21-4444', 'city' => 'Medan',   'country' => 'ID', 'is_agent' => 1, 'created' => $now],
            ['id' => 5, 'code' => 'SHIP-JOE',  'name' => 'Joe Exporter',      'email' => 'joe@exporter.id',   'phone' => '+62-21-5555', 'city' => 'Jakarta', 'country' => 'ID', 'is_shipper' => 1, 'created' => $now],
            ['id' => 6, 'code' => 'CONS-ANN',  'name' => 'Ann Importer',      'email' => 'ann@importer.sg',   'phone' => '+65-1234',    'city' => 'Singapore','country' => 'SG','is_consignee' => 1, 'created' => $now],
        ];
        $this->table('partners')->insert($data)->save();
    }
}
