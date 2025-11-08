<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Event extends Entity
{
    protected array $_accessible = [
        'title' => true,
        'location' => true,
        'host' => true,
        'event_date' => true,
        'event_size' => true,
        'contact_person_full_name' => true,
        'contact_person_email' => true,
        'event_description' => true,
        'required_equipment' => true,
        'required_skills' => true,
        'number_of_required_crews' => true,
        'status' => true,
        'organisation_id' => true,
        'created' => true,
        'modified' => true,
        'organisation' => true,
        'volunteers' => true,
    ];

    protected array $_virtual = ['event_summary'];

    protected function _getEventSummary(): string
    {
        return "{$this->title} ({$this->status}) - {$this->event_date}";
    }
}
