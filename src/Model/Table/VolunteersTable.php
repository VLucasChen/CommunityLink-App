<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class VolunteersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('volunteers');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Events', [
            'joinTable' => 'volunteer_events',
            'foreignKey' => 'volunteer_id',
            'targetForeignKey' => 'event_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('first_name')
            ->allowEmptyString('last_name') // Allow empty for edit
            ->allowEmptyString('email') // Allow empty for edit
            ->email('email', false, 'The provided value must be an e-mail address') // Validate format only if provided
            ->allowEmptyString('phone') // Allow empty for edit
            ->allowEmptyString('skills') // Allow empty for edit
            ->allowEmptyString('availability')
            ->allowEmptyString('self_intro')
            ->allowEmptyFile('profile_picture')
            ->allowEmptyFile('documents');
        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email'], 'Email must be unique.'));
        return $rules;
    }
}
