<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddBusinessTypeToSalesQuotations extends AbstractMigration
{
    public function change(): void
    {
        if ($this->hasTable('sales_quotations')) {
            $this->table('sales_quotations')
                ->addColumn('business_type', 'string', [
                    'limit' => 30, 'null' => false, 'default' => 'freight'
                ])
                ->update();
        }
    }
}
