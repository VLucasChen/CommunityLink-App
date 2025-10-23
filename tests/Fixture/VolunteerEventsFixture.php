<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VolunteerEventsFixture
 */
class VolunteerEventsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '42a835a2-40d4-46f9-88a3-31a3aa2c06e3',
                'event_id' => 'bb2411af-2d08-409c-88ac-02cfbe10c8dc',
                'volunteer_id' => '24d0c836-d19f-463f-bb22-71d554b40337',
                'created' => '2025-10-23 06:15:17',
                'modified' => '2025-10-23 06:15:17',
            ],
        ];
        parent::init();
    }
}
