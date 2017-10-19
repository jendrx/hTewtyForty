<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnswersValuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnswersValuesTable Test Case
 */
class AnswersValuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AnswersValuesTable
     */
    public $AnswersValues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.answers_values',
        'app.answers',
        'app.rounds_questions_indicators',
        'app.rounds',
        'app.studies',
        'app.users',
        'app.users_studies',
        'app.questions_indicators',
        'app.questions',
        'app.indicators',
        'app.values',
        'app.previews',
        'app.previews_values',
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
        $config = TableRegistry::exists('AnswersValues') ? [] : ['className' => AnswersValuesTable::class];
        $this->AnswersValues = TableRegistry::get('AnswersValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AnswersValues);

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
