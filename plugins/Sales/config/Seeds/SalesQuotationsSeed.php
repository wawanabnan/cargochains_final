<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class SalesQuotationsSeed extends AbstractSeed
{
    public function run(): void
    {
        $this->table('sales_quotations')->truncate();

        $now = date('Y-m-d H:i:s');
        $statuses = ['DRAFT', 'SENT', 'CONFIRMED', 'CANCELED'];

        $customerPool = [1,2,3,4,5];       // sesuaikan dgn partners.id yang ada
        $serviceLeafPool = [2,3,4,6,7,9];  // leaf dari sales_services
		$ptIds = array_column($this->fetchAll('SELECT id FROM payment_terms'), 'id');

        $rows = [];
        for ($i = 1; $i <= 20; $i++) {
            $rows[] = [
                'number'        => sprintf('Q%05d', $i),
                'customer_id'   => $customerPool[array_rand($customerPool)],
                'date'          => date('Y-m-d'),
                'valid_until'   => date('Y-m-d', strtotime('+' . rand(7, 30) . ' days')),
                'sales_service_id' => $serviceLeafPool[array_rand($serviceLeafPool)],
                'currency_id'   => 'IDR',
                  'payment_term_id' => $ptIds ? $ptIds[array_rand($ptIds)] : null,
                'subtotal'      => 0,
                'tax_total'     => 0,
                'grand_total'   => 0,
                'status'        => $statuses[array_rand($statuses)],
                'created'       => $now,
                'modified'      => $now,
            ];
        }

        $this->table('sales_quotations')->insert($rows)->save();
    }
}
