<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoundsQuestionsIndicatorsValues Model
 *
 * @property \App\Model\Table\RoundsQuestionsIndicatorsTable|\Cake\ORM\Association\BelongsTo $RoundsQuestionsIndicators
 * @property \App\Model\Table\ValuesTable|\Cake\ORM\Association\BelongsTo $Values
 *
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsValue get($primaryKey, $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsValue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsValue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsValue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsValue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsValue findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RoundsQuestionsIndicatorsValuesTable extends Table
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

        $this->setTable('rounds_questions_indicators_values');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RoundsQuestionsIndicators', [
            'foreignKey' => 'round_question_indicator_id'
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
        $rules->add($rules->existsIn(['round_question_indicator_id'], 'RoundsQuestionsIndicators'));
        $rules->add($rules->existsIn(['value_id'], 'Values'));

        return $rules;
    }
}
