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
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('volunteer_id');
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
            ->scalar('full_name')
            ->maxLength('full_name', 100)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name');

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
            ->scalar('profile_picture')
            ->maxLength('profile_picture', 255)
            ->requirePresence('profile_picture', 'create')
            ->notEmptyString('profile_picture');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        return $validator;
    }
}
