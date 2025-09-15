<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class InitSales extends AbstractMigration
{
    public function change(): void
    {
        /**
         * sales_quotations
         */
        if (!$this->hasTable('sales_quotations')) {
            $table = $this->table('sales_quotations');
            $table
                ->addColumn('number', 'string', ['limit' => 50, 'null' => false])
                ->addColumn('customer_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('date', 'date', ['null' => true, 'default' => null])
                ->addColumn('valid_until', 'date', ['null' => true, 'default' => null])
                ->addColumn('sales_service_id', 'string', ['limit' => 10, 'null' => true, 'default' => null])
                ->addColumn('currency_id', 'string', ['limit' => 10, 'null' => true, 'default' => null]) // <-- perbaikan panah
                ->addColumn('payment_term_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('notes_1', 'text', ['null' => true])
                ->addColumn('notes_2', 'text', ['null' => true])
                ->addColumn('subtotal', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
                ->addColumn('tax_total', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
                ->addColumn('grand_total', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
                ->addColumn('status', 'string', ['limit' => 20, 'default' => 'DRAFT'])
                ->addColumn('sales_user_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('sales_agency_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('sales_reseller_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => true])
                ->addColumn('modified', 'datetime', ['null' => true])
                ->addIndex(['number'], ['unique' => true])
                ->addIndex(['customer_id'])
                ->addIndex(['sales_user_id'])
                ->addIndex(['sales_agency_id'])
                ->addIndex(['sales_reseller_id'])
                ->create();
        }

        /**
         * sales_quotation_lines
         */
        if (!$this->hasTable('sales_quotation_lines')) {
            $table = $this->table('sales_quotation_lines');
            $table
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
                    'delete' => 'CASCADE',
                    'update' => 'NO_ACTION',
                ])
                ->create();
        }

        /**
         * sales_orders
         */
        if (!$this->hasTable('sales_orders')) {
            $table = $this->table('sales_orders');
            $table
                ->addColumn('number', 'string', ['limit' => 50, 'null' => false])
                ->addColumn('customer_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('date', 'date', ['null' => true, 'default' => null])
                ->addColumn('valid_until', 'date', ['null' => true, 'default' => null])
                ->addColumn('sales_service_id', 'string', ['limit' => 10, 'null' => true, 'default' => null])
                ->addColumn('currency_id', 'string', ['limit' => 10, 'null' => true, 'default' => null]) // <-- perbaikan panah
                ->addColumn('payment_term_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('notes_1', 'text', ['null' => true])
                ->addColumn('notes_2', 'text', ['null' => true])
                ->addColumn('subtotal', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
                ->addColumn('tax_total', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
                ->addColumn('grand_total', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true])
                ->addColumn('status', 'string', ['limit' => 20, 'default' => 'DRAFT'])
                ->addColumn('sales_user_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('sales_agency_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('sales_reseller_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => true])
                ->addColumn('modified', 'datetime', ['null' => true])
                ->addIndex(['number'], ['unique' => true])
                ->addIndex(['customer_id'])
                ->addIndex(['sales_user_id'])
                ->addIndex(['sales_agency_id'])
                ->addIndex(['sales_reseller_id'])
                ->create();
        }

        /**
         * sales_order_lines
         */
        if (!$this->hasTable('sales_order_lines')) {
            $table = $this->table('sales_order_lines');
            $table
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
                    'delete' => 'CASCADE',
                    'update' => 'NO_ACTION',
                ])
                ->create();
        }

        /**
         * sales_services (tree)
         * (Aku pertahankan nama tabel dari file kamu)
         */
        if (!$this->hasTable('sales_services')) {
            $table = $this->table('sales_services');
            $table
                ->addColumn('parent_id', 'integer', ['null' => true, 'default' => null])
                ->addColumn('lft', 'integer', ['null' => true, 'default' => null])
                ->addColumn('rght', 'integer', ['null' => true, 'default' => null])
                ->addColumn('name', 'string', ['limit' => 100, 'null' => false])
                ->addColumn('transport_mode', 'string', ['limit' => 20, 'null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
                ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
                ->addIndex(['parent_id'])
                ->addIndex(['lft'])
                ->addIndex(['rght'])
                ->create();
        }
    }
}