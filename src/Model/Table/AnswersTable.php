<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Answers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RoundsQuestionsIndicatorsYearsTable|\Cake\ORM\Association\BelongsTo $RoundsQuestionsIndicatorsYears
 *
 * @method \App\Model\Entity\Answer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Answer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Answer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Answer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Answer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Answer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Answer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AnswersTable extends Table
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

        $this->setTable('answers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('RoundsQuestionsIndicatorsYears', [
            'foreignKey' => 'round_question_indicator_year_id'
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
            ->requirePresence('value')
            ->greaterThan('value',0)
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['round_question_indicator_year_id'], 'RoundsQuestionsIndicatorsYears'));

        return $rules;
    }

    public function getStudy($id)
    {
        $rounds = TableRegistry::get('Rounds');
        $answer =$this->get($id);
        $round_question_indicator_year_id = $answer->round_question_indicator_year_id;

        $study_id = $rounds->find()->matching('RoundsQuestionsIndicatorsYears', function($q) use($round_question_indicator_year_id){
           return $q->where([ 'RoundsQuestionsIndicatorsYears.id'  =>  $round_question_indicator_year_id]);
        })->first()->study_id;

        return $study_id;
    }

    public function addMany($data = null, $consistent = true, $user_id = null)
    {
        if(empty($user_id) || empty($data))
            return false;

        $answers = $this->newEntities($data);

        foreach($answers as $answer)
        {
            $answer->user_id = $user_id;
            $answer->consistent = $consistent;
        }

        if($this->saveMany($answers))
        {
            return true;
        }

        return false;
    }

    public function addOne($data = null, $consistent = true, $user_id = null)
    {
        if (empty($user_id) || empty($data))
            return false;

        $answer = $this->newEntity($data);

        $answer->user_id = $user_id;
        $answer->consistent = $consistent;

        if ($this->save($answer)) {
            return true;
        }

        return false;
    }
}
