<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Volunteers Model
 *
 * @method \App\Model\Entity\Volunteer newEmptyEntity()
 * @method \App\Model\Entity\Volunteer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Volunteer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Volunteer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Volunteer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Volunteer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Volunteer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Volunteer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Volunteer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Volunteer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Volunteer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Volunteer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Volunteer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Volunteer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Volunteer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Volunteer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Volunteer> deleteManyOrFail(iterable $entities, array $options = [])
 */
class VolunteersTable extends Table
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

        $this->setTable('volunteers');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Users', [
            'foreignKey' => 'volunteer_id',
        ]);

        // Link volunteer to junction records for activities
        $this->hasMany('VolunteerEvents', [
            'foreignKey' => 'volunteer_id',
        ]);

        $this->belongsToMany('Events', [
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
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone')
            // A5 Requirement: Australian phone numbers only - 04XX format
            ->add('phone', 'australianPhone', [
                'rule' => function ($value, $context) {
                    // Australian phone number pattern: 0 followed by area code (2-9 except 1) and 8 digits
                    // Matches: 04XX XXX XXX, (04)XX XXX XXX, 04XX-XXX-XXX, etc.
                    $pattern = '/^0[2-478][0-9]{8}$/';
                    // Remove spaces, dashes, and parentheses for validation
                    $cleaned = preg_replace('/[\s\-\(\)]/', '', $value);
                    return (bool)preg_match($pattern, $cleaned);
                },
                'message' => 'Please enter a valid Australian phone number in 04XX format (e.g., 0412 345 678).'
            ]);

        $validator
            ->scalar('skills')
            ->requirePresence('skills', 'create')
            ->notEmptyString('skills');

        $validator
            ->scalar('profile_picture')
            ->maxLength('profile_picture', 255)
            ->requirePresence('profile_picture', 'create')
            ->notEmptyString('profile_picture', 'Profile picture is required', 'create')
            ->allowEmptyString('profile_picture', 'update');

        $validator
            ->scalar('documents')
            ->maxLength('documents', 255)
            ->allowEmptyString('documents');

        $validator
            ->scalar('availability')
            ->allowEmptyString('availability');

        $validator
            ->scalar('self_intro')
            ->allowEmptyString('self_intro');

        $validator
            ->date('date_submitted')
            ->allowEmptyDate('date_submitted');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }
}
