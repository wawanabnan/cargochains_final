<?php
declare(strict_types=1);

namespace Shipments\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ShipmentsFixture
 */
class ShipmentsFixture extends TestFixture
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
                'number' => 'Lorem ipsum dolor sit amet',
                'origin_id' => 1,
                'destination_id' => 1,
                'cargo_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'weight' => 1.5,
                'volume' => 1.5,
                'qty' => 1,
                'shipper_id' => 1,
                'consignee_id' => 1,
                'carrier_id' => 1,
                'agency_id' => 1,
                'etd' => '2025-09-11',
                'eta' => '2025-09-11',
                'atd' => '2025-09-11 22:31:31',
                'ata' => '2025-09-11 22:31:31',
                'status' => 'Lorem ipsum dolor ',
                'is_multimoda' => 1,
                'origin' => 'Lorem ipsum dolor sit amet',
                'destination' => 'Lorem ipsum dolor sit amet',
                'bill_of_lading_no' => 'Lorem ipsum dolor sit amet',
                'total' => 1.5,
                'created' => '2025-09-11 22:31:31',
                'modified' => '2025-09-11 22:31:31',
            ],
        ];
        parent::init();
    }
}
