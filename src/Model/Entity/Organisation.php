<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Organisation extends Entity
{
    protected array $_accessible = [
        'org_name' => true,
        'business_address' => true,
        'contact_person_full_name' => true,
        'email' => true,
        'phone' => true,
        'industry' => true,
        'help_description' => true,
        'created' => true,
        'modified' => true,
        'events' => true,
    ];

    protected array $_virtual = ['display_name'];

    protected function _getDisplayName(): string
    {
        return $this->org_name . ' (' . $this->industry . ')';
    }
}
