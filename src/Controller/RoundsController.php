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

        $this->set(compact('questions'));
        $this->set('_serialize',[ 'questions']);

    }

    public function validate()
    {

        $error = 0.3;
        if ($this->request->is('ajax')) {
            $response = true;
            $data = $this->request->getData();

            for ($i = 0; $i < count($data) / 3; $i++) {
                $result =  $data[$i]['value'] /  $data[$i + 3]['value'];
                $max_threshold = $result + $error * $result;
                $min_threshold = $result - $error * $result;
                $ratio = $data[$i + 6]['value'];

                // if result is not between delta error
                if ($ratio > $max_threshold || $ratio < $min_threshold) {
                    $response = false;
                }
            }
        }
        $this->set(compact('response'));
        $this->set('_serialize', (['response']));
    }

}