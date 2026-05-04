<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VolunteerEvent Entity
 *
 * @property string $id
 * @property string $event_id
 * @property string $volunteer_id
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\Volunteer $volunteer
 */
class VolunteerEvent extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'event_id' => true,
        'volunteer_id' => true,
        'created' => true,
        'modified' => true,
        'event' => true,
        'volunteer' => true,
    ];
}
