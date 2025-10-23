<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VolunteerEventsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VolunteerEventsTable Test Case
 */
class VolunteerEventsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VolunteerEventsTable
     */
    protected $VolunteerEvents;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.VolunteerEvents',
        'app.Events',
        'app.Volunteers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VolunteerEvents') ? [] : ['className' => VolunteerEventsTable::class];
        $this->VolunteerEvents = $this->getTableLocator()->get('VolunteerEvents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VolunteerEvents);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\VolunteerEventsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\VolunteerEventsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
