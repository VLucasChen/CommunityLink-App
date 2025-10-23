<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VolunteerSignupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VolunteerSignupsTable Test Case
 */
class VolunteerSignupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VolunteerSignupsTable
     */
    protected $VolunteerSignups;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.VolunteerSignups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('VolunteerSignups') ? [] : ['className' => VolunteerSignupsTable::class];
        $this->VolunteerSignups = $this->getTableLocator()->get('VolunteerSignups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VolunteerSignups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\VolunteerSignupsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
