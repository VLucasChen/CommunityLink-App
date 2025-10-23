<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganisationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganisationsTable Test Case
 */
class OrganisationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrganisationsTable
     */
    protected $Organisations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Organisations',
        'app.Events',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Organisations') ? [] : ['className' => OrganisationsTable::class];
        $this->Organisations = $this->getTableLocator()->get('Organisations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Organisations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\OrganisationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
