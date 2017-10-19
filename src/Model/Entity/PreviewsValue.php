<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PreviewsValue Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $preview_id
 * @property int $value_id
 *
 * @property \App\Model\Entity\Value $value
 * @property \App\Model\Entity\Preview $preview
 */
class PreviewsValue extends Entity
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
        'preview_id' => true,
        'value_id' => true,
        'preview' => true
    ];
}
