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

    /**
     * Update expired events from Preparing to Failed
     * Events that have passed their event_date and are still in Preparing status
     * will be automatically updated to Failed status
     */
    public function updateExpiredEvents(): int
    {
        $today = new \Cake\I18n\Date();
        
        // Find all events that are past their event_date and still in Preparing status
        $expiredEvents = $this->find()
            ->where([
                'event_date <' => $today,
                'status' => 'Preparing'
            ])
            ->toArray();
        
        $count = 0;
        // Update each expired event to Failed status
        foreach ($expiredEvents as $event) {
            $event->status = 'Failed';
            if ($this->save($event)) {
                $count++;
            }
        }
        
        return $count;
    }
}
