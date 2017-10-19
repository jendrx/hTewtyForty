<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Preview Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $round_question_indicator_id
 *
 * @property \App\Model\Entity\RoundsQuestionsIndicator $rounds_questions_indicator
 * @property \App\Model\Entity\Value[] $values
 */
class Preview extends Entity
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
        'round_question_indicator_id' => true,
        'rounds_questions_indicator' => true,
        'values' => true
    ];
}
