<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ValuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ValuesTable Test Case
 */
class ValuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ValuesTable
     */
    public $Values;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.answers_values',
        'app.previews',
        'app.previews_values'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Values') ? [] : ['className' => ValuesTable::class];
        $this->Values = TableRegistry::get('Values', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Values);

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
}
