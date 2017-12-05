<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/24/17
 * Time: 11:03 AM
 */

namespace App\Controller;


use Cake\Collection\Collection;
use Cake\I18n\Time;

class RoundsController extends AppController
{

    public function view( $id = null )
    {
        $this->loadModel('Answers');
        $answer = $this->Answers->newEntity();
        $isFirst = $this->Rounds->isFirst($id);

        $userAnswers = array();
        if(!$isFirst)
        {
            $userAnswers = $this->Rounds->getUserAnswers($id, $this->Auth->user('id'));
        }
        $roundValues = $this->Rounds->getRoundValues($id);
        $questions = $this->Rounds->getQuestions($id);

        $informativeIndicators = $this->Rounds->getInformativeIndicators($id);
        $round = $this->Rounds->get($id,['contain' => 'Studies']);
        $this->set(compact('answer','round', 'isFirst','questions', 'informativeIndicators', 'userAnswers', 'roundValues'));
        $this->set('_serialize',['answer','round', 'isFirst', 'questions', 'informativeIndicators','userAnswers', 'roundValues']);
    }
}

