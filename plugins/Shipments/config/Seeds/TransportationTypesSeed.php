<?php
use Migrations\AbstractSeed;

class TransportationTypesSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => 'Sea Freight',  'transportation_mode' => 'SEA',  'created' => date('Y-m-d H:i:s')],
            ['id' => 2, 'name' => 'Air Freight',  'transportation_mode' => 'AIR',  'created' => date('Y-m-d H:i:s')],
            ['id' => 3, 'name' => 'Land Trucking','transportation_mode' => 'LAND', 'created' => date('Y-m-d H:i:s')],
        ];
        $this->table('transportation_types')->insert($data)->save();
    }
}
