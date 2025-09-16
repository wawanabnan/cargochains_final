<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class GroupsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('groups');
        $this->setPrimaryKey('id');
        $this->setDisplayField('name');

        $this->belongsToMany('Users', [
            'className'        => 'CakeDC/Users.Users',
            'through'          => 'App.UsersGroups',
            'foreignKey'       => 'group_id',
            'targetForeignKey' => 'user_id',
            'joinTable'        => 'users_groups',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator->scalar('name')->maxLength('name', 50)->notEmptyString('name');
    }
}
