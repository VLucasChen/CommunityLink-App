<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property string $id
 * @property string $title
 * @property string $location
 * @property string $host
 * @property \Cake\I18n\Date $event_date
 * @property int $event_size
 * @property string $contact_person_full_name
 * @property string $contact_person_email
 * @property string $event_description
 * @property string|null $required_equipment
 * @property string|null $required_skills
 * @property int $number_of_required_crews
 * @property string $status
 * @property string|null $organisation_id
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Organisation $organisation
 * @property \App\Model\Entity\VolunteerEvent[] $volunteer_events
 */
class Event extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
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
        'volunteer_events' => true,
    ];

    /**
     * Get display name for dropdowns
     *
     * @return string
     */
    protected function _getDisplayName(): string
    {
        return $this->title . ' - ' . $this->location . ' (' . $this->event_date->format('Y-m-d') . ')';
    }
}
