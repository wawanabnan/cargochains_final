<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddUniqueCodeToQuotations extends AbstractMigration
{
    public function change(): void
    {
        if ($this->hasTable('sales_quotations')) {
            $this->table('sales_quotations')
                ->addIndex(['number'], ['unique' => true, 'name' => 'UX_sales_quotations_code'])
                ->update();
        }
    }
}
