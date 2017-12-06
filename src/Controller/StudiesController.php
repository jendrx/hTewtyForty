<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/24/17
 * Time: 10:28 AM
 */

namespace App\Controller;


use Cake\Datasource\Exception\RecordNotFoundException;

class StudiesController extends AppController
{

    public function view($id = null)
    {
        $response = null;
        $round = null;
        $user_id = $this->Auth->user('id');
        try{
            $round = $this->Studies->getActiveRound($id);
        }catch(RecordNotFoundException $e)
        {
            $this->Flash->error($e);
        }
        $hasAnswers = $this->Studies->Rounds->userHasAnswers($round['id'], $user_id);
        if($hasAnswers)
        {
            $isFirst = $this->Studies->Rounds->isFirst($round['id']);
            if($isFirst)
            {
                $response = "Obrigada pela sua resposta. Aguarde o início da segunda ronda!";
            }
            else {
                $response = 'Obrigada pela sua colaboração';
            }
        }
        else
        {
            return $this->redirect(['controller' => 'rounds', 'action' => 'view', $round['id']]);
        }
        $this->set(compact('response'));
        $this->set('_serialize',['response']);
    }


}