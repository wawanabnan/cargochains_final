<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class InitPartnerRoles extends AbstractMigration
{
    public function change(): void
    {
        // Create partners table if it doesn't exist
        if (!$this->hasTable('partners')) {
            $partners = $this->table('partners');
            $partners
                ->addColumn('name', 'string', ['limit' => 120, 'null' => false])
                ->addColumn('email', 'string', ['limit' => 120, 'null' => true, 'default' => null])
                ->addColumn('phone', 'string', ['limit' => 60, 'null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['null' => true])
                ->addColumn('modified', 'datetime', ['null' => true])
				->addColumn('address', 'text', ['null' => true, 'default' => null])
				->addColumn('city', 'string', ['limit' => 100, 'null' => true, 'default' => null])
				->addColumn('country', 'string', ['limit' => 100, 'null' => true, 'default' => null])
                ->addIndex(['name'])
                ->create();
        }

        // partner_roles table (many roles per partner)
        if (!$this->hasTable('partner_roles')) {
            $roles = $this->table('partner_roles');
            $roles
                ->addColumn('partner_id', 'integer', ['null' => false])
                ->addColumn('role', 'string', ['limit' => 30, 'null' => false]) // CUSTOMER, AGENCY, RESELLER, CARRIER, VENDOR, etc.
                ->addColumn('created', 'datetime', ['null' => true])
                ->addColumn('modified', 'datetime', ['null' => true])
                ->addIndex(['partner_id', 'role'], ['unique' => true, 'name' => 'uniq_partner_role'])
                ->create();
        }
    }
}
