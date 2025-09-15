<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * SalesQuotations seed.
 */
class SalesQuotationsSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/4/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [];

        $table = $this->table('sales_quotations');
        $table->insert($data)->save();
    }
}
