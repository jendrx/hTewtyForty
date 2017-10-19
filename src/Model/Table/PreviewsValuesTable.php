<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PreviewsValues Model
 *
 * @property \App\Model\Table\PreviewsTable|\Cake\ORM\Association\BelongsTo $Previews
 * @property \App\Model\Table\ValuesTable|\Cake\ORM\Association\BelongsTo $Values
 *
 * @method \App\Model\Entity\PreviewsValue get($primaryKey, $options = [])
 * @method \App\Model\Entity\PreviewsValue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PreviewsValue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PreviewsValue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PreviewsValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PreviewsValue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PreviewsValue findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PreviewsValuesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('previews_values');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Previews', [
            'foreignKey' => 'preview_id'
        ]);
        $this->belongsTo('Values', [
            'foreignKey' => 'value_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->numeric('value')
            ->requirePresence('value', 'create')
            ->notEmpty('value');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['preview_id'], 'Previews'));
        $rules->add($rules->existsIn(['value_id'], 'Values'));

        return $rules;
    }
}
