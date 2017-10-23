<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoundsQuestionsIndicatorsYearsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoundsQuestionsIndicatorsYearsTable Test Case
 */
class RoundsQuestionsIndicatorsYearsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoundsQuestionsIndicatorsYearsTable
     */
    public $RoundsQuestionsIndicatorsYears;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rounds_questions_indicators_years',
        'app.rounds',
        'app.studies',
        'app.users',
        'app.users_studies',
        'app.questions_indicators_years',
        'app.questions_indicators',
        'app.questions',
        'app.indicators',
        'app.years'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RoundsQuestionsIndicatorsYears') ? [] : ['className' => RoundsQuestionsIndicatorsYearsTable::class];
        $this->RoundsQuestionsIndicatorsYears = TableRegistry::get('RoundsQuestionsIndicatorsYears', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoundsQuestionsIndicatorsYears);

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
