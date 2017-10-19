<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoundsQuestionsIndicatorsValuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoundsQuestionsIndicatorsValuesTable Test Case
 */
class RoundsQuestionsIndicatorsValuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoundsQuestionsIndicatorsValuesTable
     */
    public $RoundsQuestionsIndicatorsValues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rounds_questions_indicators_values',
        'app.rounds_questions_indicators',
        'app.answers',
        'app.values',
        'app.answers_values',
        'app.previews',
        'app.previews_values',
        'app.rounds',
        'app.studies',
        'app.users',
        'app.users_studies',
        'app.questions_indicators',
        'app.questions',
        'app.indicators'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RoundsQuestionsIndicatorsValues') ? [] : ['className' => RoundsQuestionsIndicatorsValuesTable::class];
        $this->RoundsQuestionsIndicatorsValues = TableRegistry::get('RoundsQuestionsIndicatorsValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoundsQuestionsIndicatorsValues);

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
