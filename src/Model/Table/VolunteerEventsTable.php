<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VolunteerEvents Model
 *
 * @property \App\Model\Table\EventsTable&\Cake\ORM\Association\BelongsTo $Events
 * @property \App\Model\Table\VolunteersTable&\Cake\ORM\Association\BelongsTo $Volunteers
 * @method \App\Model\Entity\VolunteerEvent newEmptyEntity()
 * @method \App\Model\Entity\VolunteerEvent newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\VolunteerEvent> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VolunteerEvent get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\VolunteerEvent findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\VolunteerEvent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\VolunteerEvent> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VolunteerEvent|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\VolunteerEvent saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\VolunteerEvent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VolunteerEvent>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VolunteerEvent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VolunteerEvent> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VolunteerEvent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VolunteerEvent>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VolunteerEvent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VolunteerEvent> deleteManyOrFail(iterable $entities, array $options = [])
 */
class VolunteerEventsTable extends Table
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

        $this->setTable('volunteer_events');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Volunteers', [
            'foreignKey' => 'volunteer_id',
            'joinType' => 'INNER',
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
            ->scalar('event_id')
            ->requirePresence('event_id', 'create')
            ->notEmptyString('event_id');

        $validator
            ->scalar('volunteer_id')
            ->requirePresence('volunteer_id', 'create')
            ->notEmptyString('volunteer_id');

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
        $rules->add($rules->existsIn(['event_id'], 'Events'), ['errorField' => 'event_id']);
        $rules->add($rules->existsIn(['volunteer_id'], 'Volunteers'), ['errorField' => 'volunteer_id']);

        return $rules;
    }
}
