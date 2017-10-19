<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoundsQuestionsIndicatorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoundsQuestionsIndicatorsTable Test Case
 */
class RoundsQuestionsIndicatorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoundsQuestionsIndicatorsTable
     */
    public $RoundsQuestionsIndicators;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rounds_questions_indicators',
        'app.rounds',
        'app.studies',
        'app.users',
        'app.users_studies',
        'app.questions_indicators',
        'app.questions',
        'app.indicators',
        'app.values',
        'app.rounds_questions_indicators_values'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RoundsQuestionsIndicators') ? [] : ['className' => RoundsQuestionsIndicatorsTable::class];
        $this->RoundsQuestionsIndicators = TableRegistry::get('RoundsQuestionsIndicators', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoundsQuestionsIndicators);

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
