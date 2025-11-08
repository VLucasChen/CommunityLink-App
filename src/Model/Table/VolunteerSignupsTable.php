<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class VolunteerSignupsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('volunteer_signups');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('first_name')
            ->notEmptyString('last_name')
            ->email('email')
            ->notEmptyString('skills')
            ->allowEmptyFile('profile_picture')
            ->allowEmptyFile('documents');
        return $validator;
    }
}
