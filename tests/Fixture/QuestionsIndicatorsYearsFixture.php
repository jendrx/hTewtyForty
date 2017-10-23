<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * QuestionsIndicatorsYearsFixture
 *
 */
class QuestionsIndicatorsYearsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'question_indicator_id' => ['type' => 'biginteger', 'length' => 20, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'year_id' => ['type' => 'biginteger', 'length' => 20, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'questions_indicators_years_year_id_question_indicator_id_key' => ['type' => 'unique', 'columns' => ['question_indicator_id', 'year_id'], 'length' => []],
            'questions_indicators_years_question_indicator_id_fkey' => ['type' => 'foreign', 'columns' => ['question_indicator_id'], 'references' => ['questions_indicators', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'questions_indicators_years_year_id_fkey' => ['type' => 'foreign', 'columns' => ['year_id'], 'references' => ['years', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'question_indicator_id' => 1,
            'year_id' => 1
        ],
    ];
}
