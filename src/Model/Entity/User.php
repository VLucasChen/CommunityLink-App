<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class User extends Entity
{
    protected array $_accessible = [
        'username' => true,
        'password' => true,
        'role' => true,
        'volunteer_id' => true,
        'created' => true,
        'modified' => true,
        'volunteer' => true,
    ];

    protected array $_hidden = ['password'];

    /**
     * Hash password before saving
     */
    protected function _setPassword(string $password): string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
        return $password;
    }
}
