<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Round Entity
 *
 * @property int $id
 * @property int $step
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $completed
 * @property int $study_id
 *
 * @property \App\Model\Entity\Study $study
 * @property \App\Model\Entity\QuestionsIndicatorsYear[] $questions_indicators_years
 */
class Round extends Entity
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
        'step' => true,
        'created' => true,
        'completed' => true,
        'study_id' => true,
        'study' => true,
        'questions_indicators_years' => true
    ];
}
