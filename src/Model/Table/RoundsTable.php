<?php
namespace App\Model\Table;

use Cake\Collection\Collection;
use Cake\Collection\CollectionInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;


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

        $this->hasMany('Results', ['foreignKey' => 'round_id']);
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

    /*public function getAnswers($round_id = null)
     {
         $answers = $this->RoundsQuestionsIndicatorsYears->find('all',['contain' => ['Answers' => function($q) {
             $ids = $q->select([ 'id' => $q->func()->max('id'), 'round_question_indicator_year_id'])->group(['round_question_indicator_year_id','user_id'])->extract('id')->toArray();
             return $this->RoundsQuestionsIndicatorsYears->Answers->find('all',['fields' => ['user_id','value','round_question_indicator_year_id']])->where(['Answers.id in ' => $ids]);
         }, 'QuestionsIndicatorsYears' => ['Years' => ['fields' => ['id', 'description']], 'QuestionsIndicators.Indicators' => ['fields' => ['id','description','filename']]]]])
             ->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id])->groupBy('questions_indicators_year.year.description');

         return $answers;
     }*/

    /*get only consistent answers*/
    public function getAnswers($round_id = null)
    {
        $answers = $this->RoundsQuestionsIndicatorsYears->find('all',['contain' => ['Answers' => function($q) {
            $ids = $q->select([ 'id' => $q->func()->max('id'), 'round_question_indicator_year_id'])->where(['consistent' => true])->group(['round_question_indicator_year_id','user_id'])->extract('id')->toArray();
            return $this->RoundsQuestionsIndicatorsYears->Answers->find('all',['fields' => ['user_id','value','round_question_indicator_year_id']])->where(['Answers.id in ' => $ids]);
        }, 'QuestionsIndicatorsYears' => ['Years' => ['fields' => ['id', 'description']], 'QuestionsIndicators.Indicators' => ['fields' => ['id','description','filename']]]]])
            ->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id])->groupBy('questions_indicators_year.year.description');

        return $answers;
    }

    public function getResults($round_id = null)
    {
        $results = $this->Results->find('all', ['contain' => ['QuestionsIndicatorsYears' => ['QuestionsIndicators.Indicators', 'Years']]])->formatResults(function ($q) {
            $indicators = array_unique($q->extract('questions_indicators_year.questions_indicator.indicator')->toArray());
            foreach ($indicators as &$indicator) {
                $temp = $q->match(['questions_indicators_year.questions_indicator.indicator.id' => $indicator->id]);
                $indicator['values'] = $temp->extract(function ($key) {
                    return array('year' => $key['questions_indicators_year']['year']['description'], 'value' => $key['val']);
                });
            }

            return $indicators;
        })->where(['round_id' => $round_id]);

        return $results;
    }

    public function getSumbitedState($round_id = null)
    {
        $round = $this->get($round_id);

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


    public function getUsersAnswersv2($round_id,$user_id)
    {

    }

    public function getRoundsQuestionsIndicatorsYears($round_id)
    {
        $rqiy = $this->RoundsQuestionsIndicatorsYears
            ->find('all',['contain' => ['QuestionsIndicatorsYears' => ['Years','QuestionsIndicators.Indicators']]])->order('RoundsQuestionsIndicatorsYears.id')
            ->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id])->toArray();

        return $rqiy;
    }
    public function getQuestionsIndicatorsYears($round_id)
    {
        $rqiy = $this->RoundsQuestionsIndicatorsYears
            ->find('all',['contain' => ['QuestionsIndicatorsYears' => ['Years','QuestionsIndicators.Indicators']]])
            ->formatResults(function($q) {
                $indicators = array_unique($q->extract('questions_indicators_year.questions_indicator.indicator')->toArray());

                $tmp = array();
                foreach ($indicators as &$indicator)
                {
                    $tmp = $q->match(['questions_indicators_year.questions_indicator.indicator.id' => $indicator->id])->extract(function($key)
                    {
                        return array('question_indicator_year_id' => $key['question_indicator_year_id'], 'Year' => $key['questions_indicators_year']['year']['description'], 'value' => $key['value']);
                    })->toArray();
                    $indicator['years'] = array_values($tmp);
                }
                return $indicators;
            })
            ->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id])->toArray();
        return $rqiy;
    }

    public function isFirst($id)
    {
        $round = $this->get($id);

        return $round['step'] === 1;
    }

    public function getPreviousRound($id)
    {
        $current_round = $this->get($id);
        $previous_round = $this->find('all', ['conditions' => ['step' => $current_round['step'] - 1, 'study_id' => $current_round['study_id']]])->firstOrFail();
        return $previous_round;
    }

/*    public function getUserAnswers($round_id, $user_id)
    {
        $answers = $this->RoundsQuestionsIndicatorsYears->find('all',['contain' => ['Answers' => function($q) use($user_id) {
            $ids = $q->select([ 'id' => $q->func()->max('id'), 'round_question_indicator_year_id'])->where(['consistent' => true, 'user_id' => $user_id])->group(['round_question_indicator_year_id','user_id'])->extract('id')->toArray();
            return $this->RoundsQuestionsIndicatorsYears->Answers->find('all',['fields' => ['user_id','value','round_question_indicator_year_id']])->where(['Answers.id in ' => $ids]);
        }, 'QuestionsIndicatorsYears' => ['Years' => ['fields' => ['id', 'description']], 'QuestionsIndicators.Indicators' => ['fields' => ['id','description','filename']]]]])
            ->formatResults(function($q){
                $indicators = array_unique($q->extract('questions_indicators_year.questions_indicator')->toArray());
                $tmp = array();
                foreach($indicators as &$indicator)
                {
                    $tmp = $q->match(['questions_indicators_year.questions_indicator.id' => $indicator->id])->extract(function($key){
                        return array('Year' => $key['questions_indicators_year']['year']['description'], 'value' => $key['answers'][0]['value'],'round_question_indicator_year_id' => $key['answers'][0]['round_question_indicator_year_id']   );
                    })->toArray();
                    $indicator['user_values'] = array_values($tmp);
                }
                return array_values($indicators);

            })
            ->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id])->toArray();

        return array_values($answers);
    }*/


    public function getUserAnswersv2($round_id, $user_id)
    {
        $answers = $this->RoundsQuestionsIndicatorsYears->find('all',['contain' => ['Answers' => function($q) use($user_id) {
            $ids = $q->select([ 'id' => $q->func()->max('id'), 'round_question_indicator_year_id'])->where(['consistent' => true, 'user_id' => $user_id])->group(['round_question_indicator_year_id','user_id'])->extract('id')->toArray();

            return $this->RoundsQuestionsIndicatorsYears->Answers->find('all',['fields' => ['user_id','value','round_question_indicator_year_id']])->where(['Answers.id in ' => $ids]);
        }, 'QuestionsIndicatorsYears' => ['Years' => ['fields' => ['id', 'description']], 'QuestionsIndicators.Indicators' => ['fields' => ['id','description','filename']]]]])
            ->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id])->toArray();
        return array_values($answers);
    }

    public function merge($rqiy,$answers)
    {
        $cRqiy = new Collection($rqiy);
        $cAnswers = new Collection($answers);
        $rounds_questions_indicators_years = $cRqiy->extract(function($key)
        {
            return array('round_question_indicator_year_id' => $key['id'], 'questions_indicators_year' => $key['questions_indicators_year']);
        });

        $tmp = array();
        foreach($rounds_questions_indicators_years as $rounds_questions_indicators_year)
        {
            $round_question_indicator_year_id = $rounds_questions_indicators_year['round_question_indicator_year_id'];
            $answers = array_values($cAnswers->match(['questions_indicators_year.id' => $rounds_questions_indicators_year['questions_indicators_year']['id']])->extract(function($key) use($round_question_indicator_year_id) {
               return array('value' => $key['answers'][0]['value'], 'user_id' => $key['answers'][0]['user_id'], 'round_question_indicator_year_id' => $round_question_indicator_year_id);
            })->toArray());

            array_push($tmp, ['questions_indicators_year' => $rounds_questions_indicators_year['questions_indicators_year'], 'answer' => $answers[0]]);
        }

        //return $tmp;
        $cTmp = new Collection($tmp);
        $indicators = array_unique($cTmp->extract('questions_indicators_year.questions_indicator')->toArray());

        foreach($indicators as &$indicator)
        {
            $indicator['user_values'] =
            array_values($cTmp->match(['questions_indicators_year.questions_indicator.id' => $indicator['id']])->extract(function($key)
            {
                return array('Year' => $key['questions_indicators_year']['year']['description'],'value' =>$key['answer']['value'],'user_id' =>$key['answer']['user_id'],'round_question_indicator_year_id' =>$key['answer']['round_question_indicator_year_id']);
            })->toArray());
        }

        return array_values($indicators);
    }

    public function getRoundValues($round_id)
    {
        $answers = $this->RoundsQuestionsIndicatorsYears->find('all', ['contain' => ['QuestionsIndicatorsYears' => ['Years','QuestionsIndicators.Indicators']]])->order(['RoundsQuestionsIndicatorsYears.id' => 'ASC'])
            ->formatResults(function($results) {
                $indicators = array_unique($results->extract('questions_indicators_year.questions_indicator')->toArray());
                $tmp = array();
                foreach($indicators as &$indicator)
                {
                    $tmp = array_values($results->match(['questions_indicators_year.questions_indicator.id' => $indicator->id])->extract(function($key){
                    return array('Year' => $key['questions_indicators_year']['year']['description'], 'value' => $key['value'],  'round_question_indicator_year_id' => $key['id']);
                })->toArray());
                    $indicator['round_values'] = array_values($tmp);
                }
                return array_values($indicators);
            })
            ->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id])->toArray();

        return array_values($answers);
    }

    public function getQuestions($round_id)
    {
        $questions = $this->find('all',['contain' => ['RoundsQuestionsIndicatorsYears.QuestionsIndicatorsYears.QuestionsIndicators.Questions']])->where(['id' => $round_id]);
        return array_unique($questions->extract('rounds_questions_indicators_years.{*}.questions_indicators_year.questions_indicator.question')->first()->toArray());
    }

    public function getInformativeIndicators($round_id)
    {
        $questionsIndicatorsTable = TableRegistry::get('QuestionsIndicators');
        $questions = $this->getQuestions($round_id);
        $questionsIndicators = $questionsIndicatorsTable->find('all',['conditions' =>['question_id' => $questions['id'],'target' => false]])->contain('Indicators');
        return $questionsIndicators;
    }


    public function userHasAnswers($round_id, $user_id)
    {
        $answers = $this->RoundsQuestionsIndicatorsYears->Answers->find('all')->matching('RoundsQuestionsIndicatorsYears',function($q) use($round_id)
        {
            return $q->where(['RoundsQuestionsIndicatorsYears.round_id' => $round_id]);
        })->where(['Answers.user_id' => $user_id]);

        return !$answers->isEmpty();
    }
}
