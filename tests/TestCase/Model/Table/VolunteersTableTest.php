<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VolunteersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VolunteersTable Test Case
 */
class VolunteersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VolunteersTable
     */
    protected $Volunteers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
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
        $config = $this->getTableLocator()->exists('Volunteers') ? [] : ['className' => VolunteersTable::class];
        $this->Volunteers = $this->getTableLocator()->get('Volunteers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Volunteers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\VolunteersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
