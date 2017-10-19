<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersStudiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersStudiesTable Test Case
 */
class UsersStudiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersStudiesTable
     */
    public $UsersStudies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_studies',
        'app.users',
        'app.studies',
        'app.rounds'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersStudies') ? [] : ['className' => UsersStudiesTable::class];
        $this->UsersStudies = TableRegistry::get('UsersStudies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersStudies);

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
