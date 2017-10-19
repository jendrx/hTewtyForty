<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Values Model
 *
 * @property \App\Model\Table\AnswersTable|\Cake\ORM\Association\BelongsToMany $Answers
 * @property \App\Model\Table\PreviewsTable|\Cake\ORM\Association\BelongsToMany $Previews
 * @property \App\Model\Table\RoundsQuestionsIndicatorsTable|\Cake\ORM\Association\BelongsToMany $RoundsQuestionsIndicators
 *
 * @method \App\Model\Entity\Value get($primaryKey, $options = [])
 * @method \App\Model\Entity\Value newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Value[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Value|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Value patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Value[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Value findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ValuesTable extends Table
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

        $this->setTable('values');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Answers', [
            'foreignKey' => 'value_id',
            'targetForeignKey' => 'answer_id',
            'joinTable' => 'answers_values'
        ]);
        $this->belongsToMany('Previews', [
            'foreignKey' => 'value_id',
            'targetForeignKey' => 'preview_id',
            'joinTable' => 'previews_values'
        ]);
        $this->belongsToMany('RoundsQuestionsIndicators', [
            'foreignKey' => 'value_id',
            'targetForeignKey' => 'round_question_indicator_id',
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

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        return $validator;
    }
}
