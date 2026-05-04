<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\Date;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use DateTime;

/**
 * Events Model
 *
 * @property \App\Model\Table\OrganisationsTable&\Cake\ORM\Association\BelongsTo $Organisations
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

        $this->addBehavior('Timestamp');

        $this->belongsTo('Organisations', [
            'foreignKey' => 'organisation_id',
        ]);

        $this->belongsToMany('Volunteers', [
            'through' => 'VolunteerEvents',
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
            ->scalar('host')
            ->maxLength('host', 100)
            ->requirePresence('host', 'create')
            ->notEmptyString('host');

        $validator
            ->date('event_date')
            ->requirePresence('event_date', 'create')
            ->notEmptyDate('event_date')
            ->add('event_date', 'futureDate', [
                'rule' => function ($value, $context) {
                    // Allow past dates (for archive/failed events), but validate format
                    if ($value instanceof Date || $value instanceof DateTime) {
                        return true;
                    }
                    // If it's a string, try to parse it
                    if (is_string($value)) {
                        $date = Date::parseDate($value);

                        return $date !== false;
                    }

                    return false;
                },
                'message' => 'Please enter a valid date.',
            ]);

        $validator
            ->integer('event_size')
            ->requirePresence('event_size', 'create')
            ->notEmptyString('event_size')
            ->add('event_size', 'positive', [
                'rule' => function ($value, $context) {
                    return is_numeric($value) && $value > 0;
                },
                'message' => 'Event size must be a positive number.',
            ]);

        $validator
            ->scalar('contact_person_full_name')
            ->maxLength('contact_person_full_name', 100)
            ->requirePresence('contact_person_full_name', 'create')
            ->notEmptyString('contact_person_full_name');

        $validator
            ->email('contact_person_email')
            ->requirePresence('contact_person_email', 'create')
            ->notEmptyString('contact_person_email');

        $validator
            ->scalar('event_description')
            ->requirePresence('event_description', 'create')
            ->notEmptyString('event_description');

        $validator
            ->scalar('required_equipment')
            ->allowEmptyString('required_equipment');

        $validator
            ->scalar('required_skills')
            ->allowEmptyString('required_skills');

        $validator
            ->integer('number_of_required_crews')
            ->requirePresence('number_of_required_crews', 'create')
            ->notEmptyString('number_of_required_crews')
            ->add('number_of_required_crews', 'positive', [
                'rule' => function ($value, $context) {
                    return is_numeric($value) && $value > 0;
                },
                'message' => 'Number of required crews must be a positive number.',
            ]);

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->scalar('organisation_id')
            ->allowEmptyString('organisation_id');

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
