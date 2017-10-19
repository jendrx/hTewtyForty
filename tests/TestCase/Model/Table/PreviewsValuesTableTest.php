<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PreviewsValuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PreviewsValuesTable Test Case
 */
class PreviewsValuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PreviewsValuesTable
     */
    public $PreviewsValues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.previews_values',
        'app.previews',
        'app.values',
        'app.answers',
        'app.rounds_questions_indicators',
        'app.rounds',
        'app.studies',
        'app.users',
        'app.users_studies',
        'app.questions_indicators',
        'app.questions',
        'app.indicators',
        'app.rounds_questions_indicators_values',
        'app.answers_values'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PreviewsValues') ? [] : ['className' => PreviewsValuesTable::class];
        $this->PreviewsValues = TableRegistry::get('PreviewsValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PreviewsValues);

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
