<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoundsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoundsTable Test Case
 */
class RoundsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoundsTable
     */
    public $Rounds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rounds',
        'app.studies',
        'app.users',
        'app.users_studies',
        'app.questions_indicators_years',
        'app.questions_indicators',
        'app.questions',
        'app.indicators',
        'app.years',
        'app.rounds_questions_indicators_years'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Rounds') ? [] : ['className' => RoundsTable::class];
        $this->Rounds = TableRegistry::get('Rounds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rounds);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
