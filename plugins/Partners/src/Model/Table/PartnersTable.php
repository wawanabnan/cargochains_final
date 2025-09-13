<?php
declare(strict_types=1);

namespace Partners\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PartnersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('partners');
        $this->setPrimaryKey('id');
        $this->setDisplayField('name');
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $v): Validator
    {
        $v->scalar('name')->maxLength('name', 150)->notEmptyString('name');
        $v->email('email')->allowEmptyString('email');
        $v->scalar('code')->maxLength('code', 20)->allowEmptyString('code');
        $v->boolean('is_customer')->allowEmptyString('is_customer');
        $v->boolean('is_vendor')->allowEmptyString('is_vendor');
        $v->boolean('is_carrier')->allowEmptyString('is_carrier');
        $v->boolean('is_agent')->allowEmptyString('is_agent');
        $v->boolean('is_shipper')->allowEmptyString('is_shipper');
        $v->boolean('is_consignee')->allowEmptyString('is_consignee');
        return $v;
    }
}
