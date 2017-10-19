<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Value Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property string $description
 *
 * @property \App\Model\Entity\Answer[] $answers
 * @property \App\Model\Entity\Preview[] $previews
 * @property \App\Model\Entity\RoundsQuestionsIndicator[] $rounds_questions_indicators
 */
class Value extends Entity
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
        'description' => true,
        'answers' => true,
        'previews' => true,
        'rounds_questions_indicators' => true
    ];
}
