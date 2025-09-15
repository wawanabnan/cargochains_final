<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class SalesServicesSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'code' => 'SEA',
                'name' => 'Sea Freight',
                'description' => 'International sea freight services',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'AIR',
                'name' => 'Air Freight',
                'description' => 'International air freight services',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'LAND',
                'name' => 'Inland Trucking',
                'description' => 'Domestic trucking and inland transportation',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'code' => 'AGNT',
                'name' => 'Agency Service',
                'description' => 'Agency and representative services',
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('sales_services');
        $table->insert($data)->save();
    }
}
