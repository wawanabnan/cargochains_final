<?php
declare(strict_types=1);

namespace Sales\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\Event\EventInterface;
use ArrayObject;
use Cake\I18n\FrozenDate;
use Sales\Service\NumberingService;

/**
 * Quotations Model
 *
 * @property \Sales\Model\Table\SalesServicesTable&\Cake\ORM\Association\BelongsTo $SalesServices
 * @property \Sales\Model\Table\SalesQuotationLinesTable&\Cake\ORM\Association\HasMany $SalesQuotationLines
 *
 * @method \Sales\Model\Entity\Quotation newEmptyEntity()
 * @method \Sales\Model\Entity\Quotation newEntity(array $data, array $options = [])
 * @method array<\Sales\Model\Entity\Quotation> newEntities(array $data, array $options = [])
 * @method \Sales\Model\Entity\Quotation get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \Sales\Model\Entity\Quotation findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \Sales\Model\Entity\Quotation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\Sales\Model\Entity\Quotation> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Sales\Model\Entity\Quotation|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \Sales\Model\Entity\Quotation saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\Sales\Model\Entity\Quotation>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\Quotation>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\Sales\Model\Entity\Quotation>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\Quotation> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\Sales\Model\Entity\Quotation>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\Quotation>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\Sales\Model\Entity\Quotation>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\Quotation> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuotationsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('sales_quotations');
        $this->setDisplayField('number');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SalesServices', [
            'foreignKey' => 'sales_service_id',
            'className' => 'Sales.SalesServices',
			'joinType'   => 'LEFT',
        ]);
        $this->hasMany('SalesQuotationLines', [
            'foreignKey' => 'sales_quotation_id',
            'className' => 'Sales.SalesQuotationLines',
        ]);
		if ($this->hasAssociation('Customers')) {
			$this->getAssociation('Customers')->setClassName('Partners.Customers');
		} else {
			$this->belongsTo('Customers', [
				'className'  => 'Partners.Customers',
				'foreignKey' => 'customer_id',
				'joinType'   => 'LEFT',
			]);
		}
		
		
		
		
		
		$this->belongsTo('PaymentTerms', [
			'className'  => 'Sales.PaymentTerms',
			'foreignKey' => 'payment_term_id',
			'joinType'   => 'LEFT',
		]);
		
		 $this->hasMany('QuotationLines', [
            'className' => 'Sales.QuotationLines',
            'foreignKey' => 'quotation_id',
            'saveStrategy' => 'replace',
            'dependent' => true,
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('number')
            ->maxLength('number', 50)
            // ->requirePresence('number', 'create')
             ->allowEmptyString('number', null, 'create')
			 ->add('number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('customer_id')
            ->allowEmptyString('customer_id');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->date('valid_until')
            ->allowEmptyDate('valid_until');

        $validator
            ->scalar('sales_service_id')
            ->maxLength('sales_service_id', 10)
            ->allowEmptyString('sales_service_id');

        $validator
            ->scalar('currency_id')
            ->maxLength('currency_id', 10)
            ->allowEmptyString('currency_id');

        $validator
            ->integer('payment_term_id')
            ->allowEmptyString('payment_term_id');

        $validator
            ->scalar('notes_1')
            ->allowEmptyString('notes_1');

        $validator
            ->scalar('notes_2')
            ->allowEmptyString('notes_2');

        $validator
            ->decimal('subtotal')
            ->allowEmptyString('subtotal');

        $validator
            ->decimal('tax_total')
            ->allowEmptyString('tax_total');

        $validator
            ->decimal('grand_total')
            ->allowEmptyString('grand_total');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->notEmptyString('status');

        $validator
            ->integer('sales_user_id')
            ->allowEmptyString('sales_user_id');

        $validator
            ->integer('sales_agency_id')
            ->allowEmptyString('sales_agency_id');

        $validator
            ->integer('sales_reseller_id')
            ->allowEmptyString('sales_reseller_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
         $rules->add(function ($e) {
				if (!$e->customer_id) return false;
				$Customers = $this->getAssociation('Customers')->getTarget();
				return (bool)$Customers->find('asCustomers')
					->where([$Customers->aliasField('id') => $e->customer_id])
					->first();
			}, 'customerMustHaveRole', [
				'errorField' => 'customer_id',
				'message'    => 'Partner yang dipilih harus memiliki role Customer.'
			]);
			return $rules;
	}
	
	public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
	{
		if (empty($data['business_type'])) {
			$data['business_type'] = 'freight';
		}
	}
	
	 public function beforeSave(EventInterface $event, \Cake\Datasource\EntityInterface $entity, ArrayObject $options)
    {
        if ($entity->isNew() && empty($entity->code)) {
            $date = $entity->quotation_date instanceof \DateTimeInterface
                ? $entity->quotation_date
                : FrozenDate::today();
				
				
			$locator = TableRegistry::getTableLocator();
            $svc  = new NumberingService($locator);
            // contoh: reset per BULAN, prefix QTN, format: QTN-YYYYMM-0001
            $entity->code = $svc->generate('quotation', $date, [
                'reset'  => 'month',                 // 'year' | 'none'
                'prefix' => 'QTN',
                'padding'=> 4,
                'format' => '{PREFIX}-{YYYY}{MM}-{SEQ}'
            ]);
        }
    }
	
	
	
	// validator ringan khusus Step-1 (header saja)
	public function validationHeader(Validator $v): Validator
	{
		return (new Validator())
			->requirePresence('customer_id', 'create')->notEmptyString('customer_id', 'Pilih customer')
			->requirePresence('sales_service_id', 'create')->notEmptyString('sales_service_id', 'Pilih service')
			->requirePresence('payment_term_id', 'create')->notEmptyString('payment_term_id', 'Pilih payment term')
			->allowEmptyDate('valid_until')        // boleh kosong
			->date('valid_until')                  // jika diisi harus valid date
			->allowEmptyString('note_1')
			->allowEmptyString('note_2');
	}
	
	
	
}	
