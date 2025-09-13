<?php
declare(strict_types=1);

namespace Sales\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesQuotations Model
 *
 * @property \Sales\Model\Table\SalesQuotationLinesTable&\Cake\ORM\Association\HasMany $SalesQuotationLines
 *
 * @method \Sales\Model\Entity\SalesQuotation newEmptyEntity()
 * @method \Sales\Model\Entity\SalesQuotation newEntity(array $data, array $options = [])
 * @method array<\Sales\Model\Entity\SalesQuotation> newEntities(array $data, array $options = [])
 * @method \Sales\Model\Entity\SalesQuotation get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \Sales\Model\Entity\SalesQuotation findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \Sales\Model\Entity\SalesQuotation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\Sales\Model\Entity\SalesQuotation> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Sales\Model\Entity\SalesQuotation|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \Sales\Model\Entity\SalesQuotation saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\Sales\Model\Entity\SalesQuotation>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\SalesQuotation>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\Sales\Model\Entity\SalesQuotation>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\SalesQuotation> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\Sales\Model\Entity\SalesQuotation>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\SalesQuotation>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\Sales\Model\Entity\SalesQuotation>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\SalesQuotation> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalesQuotationsTable extends Table
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

        $this->hasMany('SalesQuotationLines', [
            'foreignKey' => 'sales_quotation_id',
            'className' => 'Sales.SalesQuotationLines',
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
            ->maxLength('number', 30)
            ->requirePresence('number', 'create')
            ->notEmptyString('number')
            ->add('number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('customer_id')
            ->allowEmptyString('customer_id');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 10)
            ->allowEmptyString('currency');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

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
        $rules->add($rules->isUnique(['number']), ['errorField' => 'number']);

        return $rules;
    }
}
