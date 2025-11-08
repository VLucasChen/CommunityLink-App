<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class VolunteerSignup extends Entity
{
    protected array $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'phone' => true,
        'skills' => true,
        'interests' => true,
        'message' => true,
        'profile_picture' => true,
        'documents' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
    ];

    protected $_virtual = ['full_name'];

    protected function _getFullName(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}
