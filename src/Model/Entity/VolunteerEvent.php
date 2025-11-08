<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class VolunteerEvent extends Entity
{
    protected array $_accessible = [
        'event_id' => true,
        'volunteer_id' => true,
        'created' => true,
        'modified' => true,
        'event' => true,
        'volunteer' => true,
    ];
}
