<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoundsQuestionsIndicatorsYears Model
 *
 * @property \App\Model\Table\RoundsTable|\Cake\ORM\Association\BelongsTo $Rounds
 * @property \App\Model\Table\QuestionsIndicatorsYearsTable|\Cake\ORM\Association\BelongsTo $QuestionsIndicatorsYears
 *
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsYear get($primaryKey, $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsYear newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsYear[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsYear|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsYear patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsYear[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RoundsQuestionsIndicatorsYear findOrCreate($search, callable $callback = null, $options = [])
 */
class RoundsQuestionsIndicatorsYearsTable extends Table
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

        $this->setTable('rounds_questions_indicators_years');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Rounds', [
            'foreignKey' => 'round_id'
        ]);
        $this->belongsTo('QuestionsIndicatorsYears', [
            'foreignKey' => 'question_indicator_year_id'
        ]);

        $this->hasMany('Answers',['foreignKey' => 'round_question_indicator_year_id']);
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
            ->requirePresence('value')
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
        $rules->add($rules->existsIn(['round_id'], 'Rounds'));
        $rules->add($rules->existsIn(['question_indicator_year_id'], 'QuestionsIndicatorsYears'));

        return $rules;
    }
}
