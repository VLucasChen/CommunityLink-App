<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->belongsTo('Volunteers', [
            'foreignKey' => 'volunteer_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('username')
            ->notEmptyString('password')
            ->inList('role', ['admin', 'assistant', 'volunteer'], 'Invalid role.');
        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username'], 'Username already exists.'));
        $rules->add($rules->existsIn('volunteer_id', 'Volunteers'));
        return $rules;
    }
}
