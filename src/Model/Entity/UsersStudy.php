<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersStudy Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $study_id
 * @property \Cake\I18n\FrozenTime $completed
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Study $study
 */
class UsersStudy extends Entity
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
        'user_id' => true,
        'study_id' => true,
        'completed' => true,
        'user' => true,
        'study' => true
    ];
}
