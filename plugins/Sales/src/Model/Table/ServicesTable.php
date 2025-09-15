<?php
declare(strict_types=1);

namespace Sales\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ServicesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('sales_services');
        $this->setPrimaryKey('id');
        $this->setDisplayField('name');

        $this->addBehavior('Tree'); // gunakan kolom parent_id, lft, rght

        $this->hasMany('Quotations', [
            'className' => 'Sales.Quotations',
            'foreignKey' => 'sales_service_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator
            ->scalar('name')->maxLength('name', 100)->notEmptyString('name')
            ->scalar('transport_mode')->allowEmptyString('transport_mode');
    }
}
