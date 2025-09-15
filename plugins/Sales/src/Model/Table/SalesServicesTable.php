<?php
declare(strict_types=1);

namespace Sales\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesServices Model
 *
 * @property \Sales\Model\Table\SalesServicesTable&\Cake\ORM\Association\BelongsTo $ParentSalesServices
 * @property \Sales\Model\Table\SalesOrdersTable&\Cake\ORM\Association\HasMany $SalesOrders
 * @property \Sales\Model\Table\SalesQuotationsTable&\Cake\ORM\Association\HasMany $SalesQuotations
 * @property \Sales\Model\Table\SalesServicesTable&\Cake\ORM\Association\HasMany $ChildSalesServices
 *
 * @method \Sales\Model\Entity\SalesService newEmptyEntity()
 * @method \Sales\Model\Entity\SalesService newEntity(array $data, array $options = [])
 * @method array<\Sales\Model\Entity\SalesService> newEntities(array $data, array $options = [])
 * @method \Sales\Model\Entity\SalesService get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \Sales\Model\Entity\SalesService findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \Sales\Model\Entity\SalesService patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\Sales\Model\Entity\SalesService> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Sales\Model\Entity\SalesService|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \Sales\Model\Entity\SalesService saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\Sales\Model\Entity\SalesService>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\SalesService>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\Sales\Model\Entity\SalesService>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\SalesService> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\Sales\Model\Entity\SalesService>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\SalesService>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\Sales\Model\Entity\SalesService>|\Cake\Datasource\ResultSetInterface<\Sales\Model\Entity\SalesService> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class SalesServicesTable extends Table
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

        $this->setTable('sales_services');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentSalesServices', [
            'className' => 'Sales.SalesServices',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('SalesOrders', [
            'foreignKey' => 'sales_service_id',
            'className' => 'Sales.SalesOrders',
        ]);
        $this->hasMany('SalesQuotations', [
            'foreignKey' => 'sales_service_id',
            'className' => 'Sales.SalesQuotations',
        ]);
        $this->hasMany('ChildSalesServices', [
            'className' => 'Sales.SalesServices',
            'foreignKey' => 'parent_id',
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
            ->integer('parent_id')
            ->allowEmptyString('parent_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('transport_mode')
            ->maxLength('transport_mode', 20)
            ->allowEmptyString('transport_mode');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentSalesServices'), ['errorField' => 'parent_id']);

        return $rules;
    }
}
