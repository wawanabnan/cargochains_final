<?php
declare(strict_types=1);

namespace Partners\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartnersFixture
 */
class PartnersFixture extends TestFixture
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
                'tax_id' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'city' => 'Lorem ipsum dolor sit amet',
                'country' => 'Lorem ipsum dolor sit amet',
                'is_customer' => 1,
                'is_vendor' => 1,
                'is_carrier' => 1,
                'is_agent' => 1,
                'is_shipper' => 1,
                'is_consignee' => 1,
                'created' => '2025-09-12 09:48:59',
                'modified' => '2025-09-12 09:48:59',
            ],
        ];
        parent::init();
    }
}
