<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QuestionsIndicators Model
 *
 * @property \App\Model\Table\QuestionsTable|\Cake\ORM\Association\BelongsTo $Questions
 * @property \App\Model\Table\IndicatorsTable|\Cake\ORM\Association\BelongsTo $Indicators
 * @property \App\Model\Table\RoundsTable|\Cake\ORM\Association\BelongsToMany $Rounds
 *
 * @method \App\Model\Entity\QuestionsIndicator get($primaryKey, $options = [])
 * @method \App\Model\Entity\QuestionsIndicator newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\QuestionsIndicator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\QuestionsIndicator|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QuestionsIndicator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionsIndicator[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionsIndicator findOrCreate($search, callable $callback = null, $options = [])
 */
class QuestionsIndicatorsTable extends Table
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

        $this->setTable('questions_indicators');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id'
        ]);
        $this->belongsTo('Indicators', [
            'foreignKey' => 'indicator_id'
        ]);
        $this->belongsToMany('Rounds', [
            'foreignKey' => 'question_indicator_id',
            'targetForeignKey' => 'round_id',
            'joinTable' => 'rounds_questions_indicators'
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
            ->boolean('target')
            ->allowEmpty('target');

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
        $rules->add($rules->existsIn(['question_id'], 'Questions'));
        $rules->add($rules->existsIn(['indicator_id'], 'Indicators'));

        return $rules;
    }
}
