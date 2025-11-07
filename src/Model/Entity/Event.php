<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $event_id
 * @property string $title
 * @property string $location
 * @property string $description
 * @property \Cake\I18n\Date $date
 * @property int|null $organisation_id
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\Organisation $organisation
 */
class Event extends Entity
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
        'title' => true,
        'location' => true,
        'description' => true,
        'date' => true,
        'organisation_id' => true,
        'created_at' => true,
        'organisation' => true,
        'organisation_id' => true, 
    ];
}
