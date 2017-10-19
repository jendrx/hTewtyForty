<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PreviewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PreviewsTable Test Case
 */
class PreviewsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PreviewsTable
     */
    public $Previews;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.previews',
        'app.rounds_questions_indicators',
        'app.answers',
        'app.values',
        'app.answers_values',
        'app.previews_values',
        'app.rounds_questions_indicators_values',
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
        $config = TableRegistry::exists('Previews') ? [] : ['className' => PreviewsTable::class];
        $this->Previews = TableRegistry::get('Previews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Previews);

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
