<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VolunteerSignup Entity
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $skills
 * @property string $availability
 * @property string $self_intro
 * @property string $profile_picture
 * @property string $documents
 * @property \Cake\I18n\Date|null $date_submitted
 * @property string $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 */
class VolunteerSignup extends Entity
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
        'availability' => true,
        'self_intro' => true,
        'profile_picture' => true,
        'documents' => true,
        'date_submitted' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
    ];
}
