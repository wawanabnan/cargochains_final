<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePaymentTerms extends AbstractMigration
{
    public function change(): void
    {
        $this->table('payment_terms')
            ->addColumn('code', 'string', ['limit' => 20, 'null' => false])
            ->addColumn('name', 'string', ['limit' => 100, 'null' => false])
            ->addColumn('days', 'integer', ['null' => true, 'default' => null])
            ->addColumn('description', 'text', ['null' => true, 'default' => null])
            ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->addIndex(['code'], ['unique' => true])
            ->create();
    }
}
