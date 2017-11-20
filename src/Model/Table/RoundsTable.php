<?php
namespace App\Model\Table;

use Cake\Collection\Collection;
use Cake\Collection\CollectionInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rounds Model
 *
 * @property \App\Model\Table\StudiesTable|\Cake\ORM\Association\BelongsTo $Studies
 * @property \App\Model\Table\QuestionsIndicatorsYearsTable|\Cake\ORM\Association\BelongsToMany $QuestionsIndicatorsYears
 *
 * @method \App\Model\Entity\Round get($primaryKey, $options = [])
 * @method \App\Model\Entity\Round newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Round[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Round|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Round patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Round[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Round findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RoundsTable extends Table
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

        $this->setTable('rounds');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Studies', [
            'foreignKey' => 'study_id'
        ]);
        $this->belongsToMany('QuestionsIndicatorsYears', [
            'foreignKey' => 'round_id',
            'targetForeignKey' => 'question_indicator_year_id',
            'joinTable' => 'rounds_questions_indicators_years'
        ]);

        $this->hasMany('RoundsQuestionsIndicatorsYears',['foreignKey' => 'round_id']);
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
            ->requirePresence('step', 'create')
            ->notEmpty('step');

        $validator
            ->dateTime('completed')
            ->allowEmpty('completed');

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
        $rules->add($rules->existsIn(['study_id'], 'Studies'));

        return $rules;
    }

    public function getRoundMean($round_id = null)
    {
       /* $answers  = $this->RoundsQuestionsIndicatorsYears->find('all',['contain' => ['Answers' => function($q) {
            return $q->select(['round_question_indicator_year_id','value' => $q->func()->avg('value')])->group('round_question_indicator_year_id');
        }, 'QuestionsIndicatorsYears' =>[ 'Years', 'QuestionsIndicators' => ['Indicators']]]])
            ->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id])
            ->select(['id','questionsindicatorsyears.id','years.description','indicators.id','indicators.description'])->formatResults(function($q){
                 return $q->map(function($results){
                    return $results->indicators;
                });
            });*/


        $answers  = $this->RoundsQuestionsIndicatorsYears->find('all',['contain' => ['Answers' => function($q) {
            return $q->select(['round_question_indicator_year_id','value' => $q->func()->avg('value')])->group('round_question_indicator_year_id');
        }, 'QuestionsIndicatorsYears' =>[ 'Years', 'QuestionsIndicators' => ['Indicators']]]])
            ->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id])
            ->select(['id','questionsindicatorsyears.id','years.description','indicators.id','indicators.description'])
            ->formatResults(function($q){

                $collection = new collection($q);
                $indicators = array_unique($collection->extract('indicators')->toArray(),SORT_REGULAR);


                return $indicators;
            });
        return $answers;
    }

    /*->select(['id','questionsindicatorsyears.id','years.description','indicators.id','indicators.description'])*/



    public function getAnswers($round_id = null)
    {

        $answers = $this->RoundsQuestionsIndicatorsYears->find('all',['contain' => ['Answers' => function($q) {
         return $q->select(['round_question_indicator_year_id','value','user_id'])->group(['round_question_indicator_year_id','value','user_id']);
        }, 'QuestionsIndicatorsYears' => ['Years' => ['fields' => ['id', 'description']], 'QuestionsIndicators.Indicators' => ['fields' => ['id','description','filename']]]]])->formatResults( function($q)
        {
            $collection = new collection($q);

            $years = array_unique($collection->extract('questions_indicators_year.year')->toArray(),SORT_REGULAR);
            return $q;
        })->groupBy('questions_indicators_year.year.description');

        return $answers;
    }


    public function getSumbitedState($round_id = null)
    {
        $round =$this->get($round_id);

        $users = $this->Studies->Users->find('all')->matching('Studies',function($q) use($round_id){
            $study_id = $this->get($round_id)->study_id;
            return $q->where(['Studies.id' => $study_id]);
    });
        $answers = $this->RoundsQuestionsIndicatorsYears->Answers
            ->find('all',['contain' => 'Users'])->matching('RoundsQuestionsIndicatorsYears',function($q) use($round_id){
               return $q->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id]);
            })->select('round_question_indicator_year_id');


        $subtimedAnswers = $users->find('all', ['contain' => ['Answers' => ['conditions' => ['round_question_indicator_year_id in ' => $answers]]]]);
        return $subtimedAnswers;


    }


}
