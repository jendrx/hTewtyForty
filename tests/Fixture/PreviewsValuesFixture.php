<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PreviewsValuesFixture
 *
 */
class PreviewsValuesFixture extends TestFixture
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
        'preview_id' => ['type' => 'biginteger', 'length' => 20, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'value_id' => ['type' => 'biginteger', 'length' => 20, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'previews_values_preview_id_value_id_key' => ['type' => 'unique', 'columns' => ['preview_id', 'value_id'], 'length' => []],
            'previews_values_preview_id_fkey' => ['type' => 'foreign', 'columns' => ['preview_id'], 'references' => ['previews', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'previews_values_value_id_fkey' => ['type' => 'foreign', 'columns' => ['value_id'], 'references' => ['"values"', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'created' => 1508422875,
            'value' => 1,
            'preview_id' => 1,
            'value_id' => 1
        ],
    ];
}
