<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestionsIndicatorsYearsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestionsIndicatorsYearsTable Test Case
 */
class QuestionsIndicatorsYearsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestionsIndicatorsYearsTable
     */
    public $QuestionsIndicatorsYears;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.questions_indicators_years',
        'app.questions_indicators',
        'app.questions',
        'app.indicators',
        'app.years',
        'app.rounds',
        'app.studies',
        'app.users',
        'app.users_studies',
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
        $config = TableRegistry::exists('QuestionsIndicatorsYears') ? [] : ['className' => QuestionsIndicatorsYearsTable::class];
        $this->QuestionsIndicatorsYears = TableRegistry::get('QuestionsIndicatorsYears', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuestionsIndicatorsYears);

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
