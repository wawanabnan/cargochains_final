<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateGroups extends AbstractMigration
{
    public function change(): void
    {
        $this->table('groups')
            ->addColumn('name', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('description', 'text', ['null' => true, 'default' => null])
            ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }
}
