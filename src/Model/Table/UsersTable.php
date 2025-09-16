<?php
declare(strict_types=1);

namespace App\Model\Table;

use CakeDC\Users\Model\Table\UsersTable as CakeDcUsersTable;

class UsersTable extends CakeDcUsersTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Relasi ke Groups buatan App
        $this->belongsToMany('Groups', [
            'className'        => 'App.Groups',
            'through'          => 'App.UsersGroups',
            'foreignKey'       => 'user_id',     // users_groups.user_id (UUID)
            'targetForeignKey' => 'group_id',    // users_groups.group_id (INT)
            'joinTable'        => 'users_groups',
        ]);
    }
}
