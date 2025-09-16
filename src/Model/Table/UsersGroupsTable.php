<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class UsersGroupsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('users_groups');
        $this->setPrimaryKey('id');

    	
		$this->belongsTo('Users', [
			'className'  => 'App.Users',   // <-- ganti dari 'CakeDC/Users.Users'
			'foreignKey' => 'user_id',
			'joinType'   => 'INNER',
		]);


        $this->belongsTo('Groups', [
            'className'  => 'App.Groups',
            'foreignKey' => 'group_id',
        ]);
    }
}
