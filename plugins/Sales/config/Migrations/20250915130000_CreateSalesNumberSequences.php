<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSalesNumberSequences extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('sales_number_sequences', ['id' => true]);
        $table
            ->addColumn('business_type', 'string', ['limit' => 30, 'null' => false]) // contoh: 'quotation', 'order'
            ->addColumn('period', 'string', ['limit' => 10, 'null' => false])        // contoh: '202509', '2025', 'ALL'
            ->addColumn('prefix', 'string', ['limit' => 20, 'null' => false, 'default' => ''])
            ->addColumn('padding', 'integer', ['null' => false, 'default' => 4])
            ->addColumn('last_no', 'integer', ['null' => false, 'default' => 0])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addIndex(['business_type', 'period'], ['unique' => true, 'name' => 'UX_seq_type_period'])
            ->create();
    }
}
