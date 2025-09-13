<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class InsertGeoSeed extends AbstractMigration
{
    public function up(): void
    {
        $rows = [
            // Country
            ['id' => 1, 'code' => 'ID',    'name' => 'Indonesia',               'kind' => 'country', 'parent_id' => null, 'lft' => null, 'rght' => null, 'iata_code' => null, 'unlocode' => null, 'latitude' => null,   'longitude' => null],

            // Province (parent: ID)
            ['id' => 2, 'code' => 'ID-JK', 'name' => 'DKI Jakarta',             'kind' => 'province', 'parent_id' => 1,  'lft' => null, 'rght' => null, 'iata_code' => null, 'unlocode' => null, 'latitude' => -6.2000, 'longitude' => 106.8167],

            // City (parent: ID-JK)
            ['id' => 3, 'code' => 'ID-JKT','name' => 'Jakarta',                 'kind' => 'city',     'parent_id' => 2,  'lft' => null, 'rght' => null, 'iata_code' => null, 'unlocode' => null, 'latitude' => -6.2088, 'longitude' => 106.8456],

            // Sea Port (parent: Jakarta)
            ['id' => 4, 'code' => 'IDJKT', 'name' => 'Tanjung Priok',           'kind' => 'port',     'parent_id' => 3,  'lft' => null, 'rght' => null, 'iata_code' => null, 'unlocode' => 'IDJKT', 'latitude' => -6.1040, 'longitude' => 106.8860],

            // Airport (parent: Jakarta)
            ['id' => 5, 'code' => 'CGK',   'name' => 'Soekarno-Hatta (CGK)',    'kind' => 'airport',  'parent_id' => 3,  'lft' => null, 'rght' => null, 'iata_code' => 'CGK', 'unlocode' => null,   'latitude' => -6.1256, 'longitude' => 106.6559],

            // Contoh lain (opsional, bisa ditambah)
            ['id' => 6, 'code' => 'SUB',   'name' => 'Tanjung Perak (SUB port)','kind' => 'port',     'parent_id' => 3,  'lft' => null, 'rght' => null, 'iata_code' => null, 'unlocode' => 'IDSUB', 'latitude' => -7.2110, 'longitude' => 112.7300],
        ];

        $this->table('locations')->insert($rows)->save();
    }

    public function down(): void
    {
        $this->execute("DELETE FROM locations WHERE id BETWEEN 1 AND 6");
    }
}
