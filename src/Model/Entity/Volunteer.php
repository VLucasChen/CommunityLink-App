<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Volunteer Entity
 *
 * @property int $volunteer_id
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property string $skills
 * @property string $profile_picture
 * @property string $status
 * @property \Cake\I18n\DateTime|null $created_at
 */
class Volunteer extends Entity
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
        'full_name' => true,
        'email' => true,
        'phone' => true,
        'skills' => true,
        'profile_picture' => true,
        'status' => true,
        'created_at' => true,
    ];
}
