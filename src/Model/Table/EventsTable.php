<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class EventsTable extends Table
{
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
            'joinTable' => 'volunteer_events',
            'foreignKey' => 'event_id',
            'targetForeignKey' => 'volunteer_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('title')
            ->notEmptyString('location')
            ->date('event_date')
            ->integer('event_size')
            ->notEmptyString('status')
            ->notEmptyString('contact_person_full_name')
            ->email('contact_person_email')
            ->notEmptyString('event_description');
        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('organisation_id', 'Organisations'));
        return $rules;
    }
}
