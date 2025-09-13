<?php
declare(strict_types=1);

namespace Sales\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesQuotationsFixture
 */
class SalesQuotationsFixture extends TestFixture
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
                'customer_id' => 1,
                'date' => '2025-09-11',
                'currency' => 'Lorem ip',
                'notes' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'subtotal' => 1.5,
                'tax_total' => 1.5,
                'grand_total' => 1.5,
                'status' => 'Lorem ipsum dolor ',
                'created' => '2025-09-11 14:56:43',
                'modified' => '2025-09-11 14:56:43',
            ],
        ];
        parent::init();
    }
}
