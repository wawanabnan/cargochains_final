<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSalesOrders extends AbstractMigration
{
    public function change(): void
    {
        $t = $this->table('sales_orders');
        $t->addColumn('code', 'string', ['limit' => 50, 'null' => false])
          ->addColumn('business_type', 'string', ['limit' => 30, 'null' => false, 'default' => 'freight'])
          ->addColumn('quotation_id', 'integer', ['null' => true, 'default' => null])
          ->addColumn('customer_id', 'integer', ['null' => false])
          ->addColumn('sales_service_id', 'integer', ['null' => true, 'default' => null])
          ->addColumn('payment_term_id', 'integer', ['null' => true, 'default' => null])
          ->addColumn('sales_user_id', 'integer', ['null' => true, 'default' => null])
          ->addColumn('order_date', 'date', ['null' => false])
          ->addColumn('status', 'string', ['limit' => 20, 'null' => false, 'default' => 'OPEN'])
          ->addColumn('total', 'decimal', ['precision' => 12, 'scale' => 2, 'null' => true, 'default' => null])
          ->addColumn('created', 'datetime', ['null' => true])
          ->addColumn('modified', 'datetime', ['null' => true])
          ->addIndex(['code'], ['unique' => true, 'name' => 'UX_sales_orders_code'])
          ->create();
    }
}
