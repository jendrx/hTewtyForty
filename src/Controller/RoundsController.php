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
        $user_id = $this->Auth->user('id');


        if($this->Rounds->userHasAnswers($id,$user_id))
            return $this->redirect(['controller' => 'users', 'action' => 'getActiveStudy']);

        $this->loadModel('Answers');
        $answer = $this->Answers->newEntity();
        $isFirst = $this->Rounds->isFirst($id);
        $userAnswers = array();
        if(!$isFirst)
        {
            $previous = $this->Rounds->getPreviousRound($id);
            $userAnswers = $this->Rounds->getUserAnswers($previous['id'], $user_id);
        }

        $roundValues = $this->Rounds->getRoundValues($id);
        $questions = $this->Rounds->getQuestions($id);

        $informativeIndicators = $this->Rounds->getInformativeIndicators($id);
        $round = $this->Rounds->get($id,['contain' => 'Studies']);
        $this->set(compact('answer','round', 'isFirst','questions', 'informativeIndicators', 'userAnswers', 'roundValues'));
        $this->set('_serialize',['answer','round', 'isFirst', 'questions', 'informativeIndicators','userAnswers', 'roundValues']);
    }
}

