<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Answer Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property float $value
 * @property int $user_id
 * @property int $round_question_indicator_year_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\RoundsQuestionsIndicatorsYear $rounds_questions_indicators_year
 */
class Answer extends Entity
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
        'user_id' => true,
        'round_question_indicator_year_id' => true,
        'user' => true,
        'rounds_questions_indicators_year' => true
    ];
}
