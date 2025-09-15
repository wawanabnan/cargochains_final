<?php
declare(strict_types=1);

namespace Sales\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * QuotationsFixture
 */
class QuotationsFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'sales_quotations';
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
                'date' => '2025-09-14',
                'valid_until' => '2025-09-14',
                'sales_service_id' => 'Lorem ip',
                'currency_id' => 'Lorem ip',
                'payment_term_id' => 1,
                'notes_1' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'notes_2' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'subtotal' => 1.5,
                'tax_total' => 1.5,
                'grand_total' => 1.5,
                'status' => 'Lorem ipsum dolor ',
                'sales_user_id' => 1,
                'sales_agency_id' => 1,
                'sales_reseller_id' => 1,
                'created' => '2025-09-14 10:25:16',
                'modified' => '2025-09-14 10:25:16',
            ],
        ];
        parent::init();
    }
}
