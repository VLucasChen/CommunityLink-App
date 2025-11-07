<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \App\Model\Table\OrganisationsTable&\Cake\ORM\Association\BelongsTo $Organisations
 *
 * @method \App\Model\Entity\Event newEmptyEntity()
 * @method \App\Model\Entity\Event newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Event> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Event get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Event findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Event> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Event|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Event saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Event>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Event>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Event>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Event> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Event>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Event>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Event>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Event> deleteManyOrFail(iterable $entities, array $options = [])
 */
class EventsTable extends Table
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

        $this->setTable('events');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Organisations', [
            'foreignKey' => 'organisation_id',
        ]);
        $this->hasMany('VolunteerEvents', [
            'foreignKey' => 'event_id'
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
            ->scalar('title')
            ->maxLength('title', 200)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('location')
            ->maxLength('location', 200)
            ->requirePresence('location', 'create')
            ->notEmptyString('location');

        $validator
            ->scalar('event_description')
            ->requirePresence('event_description', 'create')
            ->notEmptyString('event_description');

        $validator
            ->date('event_date')
            ->requirePresence('event_date', 'create')
            ->notEmptyDate('event_date');

        $validator
            ->uuid('organisation_id')
            ->allowEmptyString('organisation_id');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

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
        $rules->add($rules->existsIn(['organisation_id'], 'Organisations'), ['errorField' => 'organisation_id']);

        return $rules;
    }
}
