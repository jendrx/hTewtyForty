<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * QuestionsIndicatorsYear Entity
 *
 * @property int $id
 * @property int $question_indicator_id
 * @property int $year_id
 *
 * @property \App\Model\Entity\QuestionsIndicator $questions_indicator
 * @property \App\Model\Entity\Year $year
 * @property \App\Model\Entity\Round[] $rounds
 */
class QuestionsIndicatorsYear extends Entity
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
        'question_indicator_id' => true,
        'year_id' => true,
        'questions_indicator' => true,
        'year' => true,
        'rounds' => true
    ];
}
