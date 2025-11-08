<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Volunteer Entity
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $skills
 * @property string $profile_picture
 * @property string|null $documents
 * @property string|null $availability
 * @property string|null $self_intro
 * @property \Cake\I18n\Date|null $date_submitted
 * @property string $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\VolunteerEvent[] $volunteer_events
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
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'phone' => true,
        'skills' => true,
        'profile_picture' => true,
        'documents' => true,
        'availability' => true,
        'self_intro' => true,
        'date_submitted' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'volunteer_events' => true,
    ];

    /**
     * Get full name
     *
     * @return string
     */
    protected function _getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get display name for dropdowns
     *
     * @return string
     */
    protected function _getDisplayName(): string
    {
        return $this->first_name . ' ' . $this->last_name . ' (' . $this->email . ')';
    }
}
