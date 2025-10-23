<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VolunteerSignups Model
 *
 * @method \App\Model\Entity\VolunteerSignup newEmptyEntity()
 * @method \App\Model\Entity\VolunteerSignup newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\VolunteerSignup> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VolunteerSignup get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\VolunteerSignup findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\VolunteerSignup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\VolunteerSignup> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VolunteerSignup|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\VolunteerSignup saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\VolunteerSignup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VolunteerSignup>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VolunteerSignup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VolunteerSignup> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VolunteerSignup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VolunteerSignup>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VolunteerSignup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VolunteerSignup> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VolunteerSignupsTable extends Table
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

        $this->setTable('volunteer_signups');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->notEmptyString('phone');

        $validator
            ->scalar('skills')
            ->requirePresence('skills', 'create')
            ->notEmptyString('skills');

        $validator
            ->scalar('interests')
            ->allowEmptyString('interests');

        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        $validator
            ->scalar('profile_picture')
            ->maxLength('profile_picture', 255)
            ->requirePresence('profile_picture', 'create')
            ->notEmptyString('profile_picture');

        $validator
            ->scalar('documents')
            ->maxLength('documents', 255)
            ->allowEmptyString('documents');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        return $validator;
    }
}
