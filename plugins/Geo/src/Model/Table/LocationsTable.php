<?php
declare(strict_types=1);

namespace Geo\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Locations Model
 *
 * @property \Geo\Model\Table\LocationsTable&\Cake\ORM\Association\BelongsTo $ParentLocations
 * @property \Geo\Model\Table\LocationsTable&\Cake\ORM\Association\HasMany $ChildLocations
 *
 * @method \Geo\Model\Entity\Location newEmptyEntity()
 * @method \Geo\Model\Entity\Location newEntity(array $data, array $options = [])
 * @method array<\Geo\Model\Entity\Location> newEntities(array $data, array $options = [])
 * @method \Geo\Model\Entity\Location get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \Geo\Model\Entity\Location findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \Geo\Model\Entity\Location patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\Geo\Model\Entity\Location> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Geo\Model\Entity\Location|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \Geo\Model\Entity\Location saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\Geo\Model\Entity\Location>|\Cake\Datasource\ResultSetInterface<\Geo\Model\Entity\Location>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\Geo\Model\Entity\Location>|\Cake\Datasource\ResultSetInterface<\Geo\Model\Entity\Location> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\Geo\Model\Entity\Location>|\Cake\Datasource\ResultSetInterface<\Geo\Model\Entity\Location>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\Geo\Model\Entity\Location>|\Cake\Datasource\ResultSetInterface<\Geo\Model\Entity\Location> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class LocationsTable extends Table
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

        $this->setTable('locations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('ParentLocations', [
            'className' => 'Geo.Locations',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildLocations', [
            'className' => 'Geo.Locations',
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
            ->scalar('code')
            ->maxLength('code', 20)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('kind')
            ->maxLength('kind', 20)
            ->requirePresence('kind', 'create')
            ->notEmptyString('kind');

        $validator
            ->integer('parent_id')
            ->notEmptyString('parent_id');

        $validator
            ->scalar('iata_code')
            ->maxLength('iata_code', 10)
            ->requirePresence('iata_code', 'create')
            ->notEmptyString('iata_code');

        $validator
            ->scalar('unlocode')
            ->maxLength('unlocode', 10)
            ->requirePresence('unlocode', 'create')
            ->notEmptyString('unlocode');

        $validator
            ->decimal('latitude')
            ->requirePresence('latitude', 'create')
            ->notEmptyString('latitude');

        $validator
            ->decimal('longitude')
            ->requirePresence('longitude', 'create')
            ->notEmptyString('longitude');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentLocations'), ['errorField' => 'parent_id']);

        return $rules;
    }
}
