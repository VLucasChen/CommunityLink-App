<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class OrganisationsTable extends Table
{
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

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('org_name')
            ->notEmptyString('business_address')
            ->email('email')
            ->notEmptyString('contact_person_full_name')
            ->notEmptyString('phone')
            ->notEmptyString('industry')
            ->notEmptyString('help_description');
        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email'], 'Email must be unique.'));
        return $rules;
    }
}
