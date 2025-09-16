<?php
declare(strict_types=1);

namespace Sales\Model\Table;

use Cake\Event\EventInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\I18n\FrozenDate;
use ArrayObject;
use Sales\Service\NumberingService;
use Cake\Datasource\EntityInterface;

class SalesOrdersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('sales_orders');
        $this->setPrimaryKey('id');
        $this->setDisplayField('code');

        $this->belongsTo('Quotations', [
            'className'  => 'Sales.Quotations',
            'foreignKey' => 'quotation_id',
        ]);
        $this->belongsTo('Customer', [
            'className'  => 'Partners.Partners',
            'foreignKey' => 'customer_id',
        ]);
        $this->belongsTo('SalesServices', [
            'className'  => 'Sales.SalesServices',
            'foreignKey' => 'sales_service_id',
        ]);
        $this->belongsTo('PaymentTerms', [
            'className'  => 'Sales.PaymentTerms',
            'foreignKey' => 'payment_term_id',
        ]);
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['code'], 'Order code must be unique.'));
        $rules->add($rules->existsIn(['customer_id'], 'Customer'));
        return $rules;
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if ($entity->isNew() && empty($entity->code)) {
            $date = $entity->order_date instanceof \DateTimeInterface ? $entity->order_date : FrozenDate::today();
            $bt   = $entity->business_type ?: 'freight';
            $svc  = new NumberingService($this->getTableLocator());

            $entity->code = $svc->generate($bt . '.order', $date, [
                'reset'  => 'month',
                'prefix' => strtoupper(substr($bt, 0, 1)) . 'O',
                'padding'=> 4,
                'format' => '{PREFIX}-{YYYY}{MM}-{SEQ}',
            ]);
        }
    }
}
