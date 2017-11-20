<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Result Entity
 *
 * @property int $id
 * @property int $round_id
 * @property int $question_indicator_year_id
 * @property float $val
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Round $round
 * @property \App\Model\Entity\QuestionsIndicatorsYear $questions_indicators_year
 */
class Result extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'round_id' => true,
        'question_indicator_year_id' => true,
        'val' => true,
        'created' => true,
        'round' => true,
        'questions_indicators_year' => true
    ];
}
