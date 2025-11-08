<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class VolunteerEventsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('volunteer_events');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
        ]);
        $this->belongsTo('Volunteers', [
            'foreignKey' => 'volunteer_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('event_id')
            ->notEmptyString('volunteer_id');
        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('event_id', 'Events'));
        $rules->add($rules->existsIn('volunteer_id', 'Volunteers'));
        return $rules;
    }
}
