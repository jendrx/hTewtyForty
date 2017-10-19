<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RoundsQuestionsIndicatorsFixture
 *
 */
class RoundsQuestionsIndicatorsFixture extends TestFixture
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
        'question_indicator_id' => ['type' => 'biginteger', 'length' => 20, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'rounds_questions_indicators_round_id_question_indicator_id_key' => ['type' => 'unique', 'columns' => ['round_id', 'question_indicator_id'], 'length' => []],
            'rounds_questions_indicators_question_indicator_id_fkey' => ['type' => 'foreign', 'columns' => ['question_indicator_id'], 'references' => ['questions_indicators', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'rounds_questions_indicators_round_id_fkey' => ['type' => 'foreign', 'columns' => ['round_id'], 'references' => ['rounds', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'question_indicator_id' => 1
        ],
    ];
}
