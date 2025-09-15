<?php
declare(strict_types=1);

namespace Sales\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PaymentTermsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('payment_terms');
        $this->setPrimaryKey('id');
        $this->setDisplayField('name');

        $this->hasMany('SalesQuotations', [
            'className'  => 'Sales.SalesQuotations',
            'foreignKey' => 'payment_term_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator
            ->scalar('code')->maxLength('code', 20)->notEmptyString('code')
            ->scalar('name')->maxLength('name', 100)->notEmptyString('name')
            ->integer('days')->allowEmptyString('days');
    }
}
