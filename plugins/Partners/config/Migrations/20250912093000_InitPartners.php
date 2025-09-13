<?php

use Migrations\AbstractMigration;

class InitPartners extends AbstractMigration
{
    public function change(): void
    {
        $this->table('partners')
            ->addColumn('code', 'string', ['limit' => 20, 'null' => true, 'default' => null])
            ->addColumn('name', 'string', ['limit' => 150, 'null' => false])
            ->addColumn('tax_id', 'string', ['limit' => 50, 'null' => true, 'default' => null])
            ->addColumn('email', 'string', ['limit' => 120, 'null' => true, 'default' => null])
            ->addColumn('phone', 'string', ['limit' => 50, 'null' => true, 'default' => null])
            ->addColumn('address', 'text', ['null' => true, 'default' => null])
            ->addColumn('city', 'string', ['limit' => 100, 'null' => true, 'default' => null])
            ->addColumn('country', 'string', ['limit' => 100, 'null' => true, 'default' => null])
            ->addColumn('is_customer', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('is_vendor', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('is_carrier', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('is_agent', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('is_shipper', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('is_consignee', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->addIndex(['code'], ['unique' => true, 'name' => 'uniq_partners_code'])
            ->addIndex(['name'], ['name' => 'idx_partners_name'])
            ->create();
    }
}
