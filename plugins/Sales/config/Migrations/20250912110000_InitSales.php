<?php
use Migrations\AbstractMigration;

class InitSales extends AbstractMigration
{
    public function change(): void
    {
        $this->table('sales_quotations')
            ->addColumn('number', 'string', ['limit' => 30])
            ->addIndex(['number'], ['unique' => true])
            ->addColumn('customer_id', 'integer', ['null' => true, 'default' => null])
            ->addColumn('date', 'date', ['null' => true, 'default' => null])
            ->addColumn('currency', 'string', ['limit' => 10, 'null' => true, 'default' => null])
            ->addColumn('notes', 'text', ['null' => true])
            ->addColumn('subtotal', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
            ->addColumn('tax_total', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
            ->addColumn('grand_total', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
            ->addColumn('status', 'string', ['limit' => 20, 'default' => 'DRAFT'])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->create();

        $this->table('sales_quotation_lines')
            ->addColumn('sales_quotation_id', 'integer')
            ->addColumn('origin_id', 'integer', ['null' => true])
            ->addColumn('destination_id', 'integer', ['null' => true])
            ->addColumn('description', 'string', ['limit' => 255])
            ->addColumn('qty', 'decimal', ['precision' => 12, 'scale' => 3, 'default' => 1])
            ->addColumn('price', 'decimal', ['precision' => 14, 'scale' => 2, 'default' => 0])
            ->addColumn('amount', 'decimal', ['precision' => 14, 'scale' => 2, 'default' => 0])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addForeignKey('sales_quotation_id', 'sales_quotations', 'id', [
                'delete' => 'CASCADE', 'update' => 'NO_ACTION'
            ])
            ->create();

        $this->table('sales_orders')
            ->addColumn('number', 'string', ['limit' => 30])
            ->addIndex(['number'], ['unique' => true])
            ->addColumn('customer_id', 'integer', ['null' => true])
            ->addColumn('date', 'date', ['null' => true])
            ->addColumn('currency', 'string', ['limit' => 10, 'null' => true])
            ->addColumn('notes', 'text', ['null' => true])
            ->addColumn('subtotal', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
            ->addColumn('tax_total', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
            ->addColumn('grand_total', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
            ->addColumn('status', 'string', ['limit' => 20, 'default' => 'DRAFT'])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->create();

        $this->table('sales_order_lines')
            ->addColumn('sales_order_id', 'integer')
            ->addColumn('origin_id', 'integer', ['null' => true])
            ->addColumn('destination_id', 'integer', ['null' => true])
            ->addColumn('description', 'string', ['limit' => 255])
            ->addColumn('qty', 'decimal', ['precision' => 12, 'scale' => 3, 'default' => 1])
            ->addColumn('price', 'decimal', ['precision' => 14, 'scale' => 2, 'default' => 0])
            ->addColumn('amount', 'decimal', ['precision' => 14, 'scale' => 2, 'default' => 0])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addForeignKey('sales_order_id', 'sales_orders', 'id', [
                'delete' => 'CASCADE', 'update' => 'NO_ACTION'
            ])
            ->create();
    }
}
