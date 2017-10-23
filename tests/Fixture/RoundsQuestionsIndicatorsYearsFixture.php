<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RoundsQuestionsIndicatorsYearsFixture
 *
 */
class RoundsQuestionsIndicatorsYearsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'round_id' => ['type' => 'biginteger', 'length' => 20, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'question_indicator_year_id' => ['type' => 'biginteger', 'length' => 20, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'value' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'rounds_questions_indicators_y_round_id_question_indicator_y_key' => ['type' => 'unique', 'columns' => ['round_id', 'question_indicator_year_id'], 'length' => []],
            'rounds_questions_indicators_years_question_indicator_year_id_fk' => ['type' => 'foreign', 'columns' => ['question_indicator_year_id'], 'references' => ['questions_indicators_years', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'rounds_questions_indicators_years_round_id_fkey' => ['type' => 'foreign', 'columns' => ['round_id'], 'references' => ['rounds', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
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
            'round_id' => 1,
            'question_indicator_year_id' => 1,
            'value' => 1
        ],
    ];
}
