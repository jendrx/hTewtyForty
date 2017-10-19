<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoundsQuestionsIndicators Model
 *
 * @property \App\Model\Table\RoundsTable|\Cake\ORM\Association\BelongsTo $Rounds
 * @property \App\Model\Table\QuestionsIndicatorsTable|\Cake\ORM\Association\BelongsTo $QuestionsIndicators
 * @property \App\Model\Table\ValuesTable|\Cake\ORM\Association\BelongsToMany $Values
 *
 * @method \App\Model\Entity\RoundsQuestionsIndicator get($primaryKey, $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicator newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicator|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicator[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicator findOrCreate($search, callable $callback = null, $options = [])
 */
class RoundsQuestionsIndicatorsTable extends Table
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

        $this->setTable('rounds_questions_indicators');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Answers',[
            'foreignKey' => 'round_question_indicator_id'
        ]);

        $this->belongsTo('Rounds', [
            'foreignKey' => 'round_id'
        ]);
        $this->belongsTo('QuestionsIndicators', [
            'foreignKey' => 'question_indicator_id'
        ]);
        $this->belongsToMany('Values', [
            'foreignKey' => 'round_question_indicator_id',
            'targetForeignKey' => 'value_id',
            'joinTable' => 'rounds_questions_indicators_values'
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
        $rules->add($rules->existsIn(['round_id'], 'Rounds'));
        $rules->add($rules->existsIn(['question_indicator_id'], 'QuestionsIndicators'));

        return $rules;
    }
}
