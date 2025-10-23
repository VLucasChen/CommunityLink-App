<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organisations Model
 *
 * @property \App\Model\Table\EventsTable&\Cake\ORM\Association\HasMany $Events
 *
 * @method \App\Model\Entity\Organisation newEmptyEntity()
 * @method \App\Model\Entity\Organisation newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Organisation> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Organisation get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Organisation findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Organisation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Organisation> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Organisation|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Organisation saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Organisation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organisation>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Organisation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organisation> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Organisation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organisation>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Organisation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organisation> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrganisationsTable extends Table
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

        $this->setTable('organisations');
        $this->setDisplayField('org_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Events', [
            'foreignKey' => 'organisation_id',
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
            ->scalar('org_name')
            ->maxLength('org_name', 100)
            ->requirePresence('org_name', 'create')
            ->notEmptyString('org_name');

        $validator
            ->scalar('business_address')
            ->requirePresence('business_address', 'create')
            ->notEmptyString('business_address');

        $validator
            ->scalar('contact_person_full_name')
            ->maxLength('contact_person_full_name', 100)
            ->requirePresence('contact_person_full_name', 'create')
            ->notEmptyString('contact_person_full_name');

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
            ->scalar('industry')
            ->maxLength('industry', 100)
            ->requirePresence('industry', 'create')
            ->notEmptyString('industry');

        $validator
            ->scalar('help_description')
            ->requirePresence('help_description', 'create')
            ->notEmptyString('help_description');

        return $validator;
    }
}
