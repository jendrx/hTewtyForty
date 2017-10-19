<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RoundsQuestionsIndicatorsValuesFixture
 *
 */
class RoundsQuestionsIndicatorsValuesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'value' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'round_question_indicator_id' => ['type' => 'biginteger', 'length' => 20, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'value_id' => ['type' => 'biginteger', 'length' => 20, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'rounds_questions_indicators_v_round_question_indicator_id_v_key' => ['type' => 'unique', 'columns' => ['round_question_indicator_id', 'value_id'], 'length' => []],
            'rounds_questions_indicators_va_round_question_indicator_id_fkey' => ['type' => 'foreign', 'columns' => ['round_question_indicator_id'], 'references' => ['rounds_questions_indicators', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'rounds_questions_indicators_values_value_id_fkey' => ['type' => 'foreign', 'columns' => ['value_id'], 'references' => ['"values"', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'created' => 1508422888,
            'value' => 1,
            'round_question_indicator_id' => 1,
            'value_id' => 1
        ],
    ];
}
