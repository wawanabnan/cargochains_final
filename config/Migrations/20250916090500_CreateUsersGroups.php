<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsersGroups extends AbstractMigration
{
    public function change(): void
    {
        $this->table('users_groups')
		->addColumn('user_id', 'uuid', ['null' => false])      // <-- UUID
		->addColumn('group_id', 'integer', ['null' => false])  // groups.id tetap integer
		->addColumn('created', 'datetime', ['null' => true, 'default' => null])
		->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
		->addIndex(['user_id', 'group_id'], ['unique' => true, 'name' => 'UG_UNIQUE'])
		->addForeignKey('user_id', 'users', 'id', [
			'delete' => 'CASCADE', 'update' => 'NO_ACTION'
		])
		->addForeignKey('group_id', 'groups', 'id', [
			'delete' => 'CASCADE', 'update' => 'NO_ACTION'
		])
		->create();

    }
}
