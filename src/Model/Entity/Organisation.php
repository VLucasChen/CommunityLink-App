<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Organisation Entity
 *
 * @property string $id
 * @property string $org_name
 * @property string $business_address
 * @property string $contact_person_full_name
 * @property string $email
 * @property string $phone
 * @property string $industry
 * @property string $help_description
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Event[] $events
 */
class Organisation extends Entity
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
}
