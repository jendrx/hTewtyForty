<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RoundsQuestionsIndicatorsValue Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $round_question_indicator_id
 * @property int $value_id
 *
 * @property \App\Model\Entity\Value $value
 * @property \App\Model\Entity\RoundsQuestionsIndicator $rounds_questions_indicator
 */
class RoundsQuestionsIndicatorsValue extends Entity
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
        'created' => true,
        'value' => true,
        'round_question_indicator_id' => true,
        'value_id' => true,
        'rounds_questions_indicator' => true
    ];
}
