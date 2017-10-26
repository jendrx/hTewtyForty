<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/24/17
 * Time: 11:03 AM
 */

namespace App\Controller;


use Cake\Collection\Collection;

class RoundsController extends AppController
{

    public function view( $id = null )
    {
        // find questions by get round by id and extract
        $round = $this->Rounds->find('all',['conditions' => ['Rounds.id' => $id],'contain' => ['Studies','QuestionsIndicatorsYears.QuestionsIndicators.Questions']]);
        $collection = new Collection($round);
        $questions = array_unique($collection->extract('questions_indicators_years.{*}.questions_indicator.question')->toArray());



        foreach($questions as &$question)
        {

            $questionsIndicators = $this->Rounds
                ->QuestionsIndicatorsYears
                ->QuestionsIndicators->find('all',['conditions' => ['QuestionsIndicators.question_id' => $question['id']],
                    'contain' => ['Indicators','QuestionsIndicatorsYears' => ['Years','Rounds' => ['conditions' => ['Rounds.id' => $id]]]]]);

            $question['questions_indicators'] = $questionsIndicators;
        }

        $result = $this->Rounds->getRoundMean($id);


        $this->set(compact('questions', 'result'));
        $this->set('_serialize',[ 'questions', 'result']);

    }

}