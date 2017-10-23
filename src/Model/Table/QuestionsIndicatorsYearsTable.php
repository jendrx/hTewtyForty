<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QuestionsIndicatorsYears Model
 *
 * @property \App\Model\Table\QuestionsIndicatorsTable|\Cake\ORM\Association\BelongsTo $QuestionsIndicators
 * @property \App\Model\Table\YearsTable|\Cake\ORM\Association\BelongsTo $Years
 * @property \App\Model\Table\RoundsTable|\Cake\ORM\Association\BelongsToMany $Rounds
 *
 * @method \App\Model\Entity\QuestionsIndicatorsYear get($primaryKey, $options = [])
 * @method \App\Model\Entity\QuestionsIndicatorsYear newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\QuestionsIndicatorsYear[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\QuestionsIndicatorsYear|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QuestionsIndicatorsYear patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionsIndicatorsYear[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionsIndicatorsYear findOrCreate($search, callable $callback = null, $options = [])
 */
class QuestionsIndicatorsYearsTable extends Table
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

        $this->setTable('questions_indicators_years');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('QuestionsIndicators', [
            'foreignKey' => 'question_indicator_id'
        ]);
        $this->belongsTo('Years', [
            'foreignKey' => 'year_id'
        ]);
        $this->belongsToMany('Rounds', [
            'foreignKey' => 'question_indicator_year_id',
            'targetForeignKey' => 'round_id',
            'joinTable' => 'rounds_questions_indicators_years'
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
        $rules->add($rules->existsIn(['question_indicator_id'], 'QuestionsIndicators'));
        $rules->add($rules->existsIn(['year_id'], 'Years'));

        return $rules;
    }
}
