<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class SalesDemoSeed extends AbstractSeed
{
    public function run(): void
    {
        $this->call('ServicesSeed');
        $this->call('SalesQuotationsSeed');
        $this->call('SalesQuotationLinesSeed');
    }
}
