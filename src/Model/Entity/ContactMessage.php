<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class ContactMessage extends Entity
{
    protected array $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'phone' => true,
        'message' => true,
        'is_replied' => true,
        'created' => true,
        'modified' => true,
    ];

    protected array $_virtual = ['full_name'];

    /**
     * Virtual field: full display name.
     *
     * @return string
     */
    protected function _getFullName(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}
