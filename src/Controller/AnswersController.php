<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/24/17
 * Time: 6:19 PM
 */

namespace App\Controller;


class AnswersController extends AppController
{

    public function add()
    {
        $this->loadModel('Users');
        if($this->request->is('post'))
        {
            $data = $this->request->getData();
            $answers = $this->Answers->newEntities($data);
            $user_id = $this->Auth->user('id');

            foreach($answers as $answer)
            {
                $answer->user_id = $user_id;
                $answer->consistent = true;
            }
            if($this->Answers->saveMany($answers))
            {

                // get study for answers, set user study completed and get new study
                //$study_id = $this->Answers->getStudy($answers[0]['id']);
                //$this->Users->finishStudy($user_id,$study_id);

                $answered = true;
                $this->redirect(['controller' => 'users', 'action' => 'getActiveStudy', $answered]);

                $this->Flash->success(__('Answer has been saved'));
            }
            else
            {
                $this->Flash->error(__('Answer has not been saved'));
            }
        }

        $this->set(compact('answer'));
        $this->set('_serialize',['answer']);
    }


    /*public function validate()
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
    }*/

    public function validate()
    {

        if($this->request->is('ajax'))
        {
            $error = 0.3;
            $response = true;
            $data = $this->request->getData();
            $user_id = $this->Auth->user('id');
            if(!$this->missingValues($data))
            {
                for ($i = 0; $i < count($data) / 3; $i++) {
                    $result = $data[$i]['value'] / $data[$i + 3]['value'];
                    $max_threshold = $result + $error * $result;
                    $min_threshold = $result - $error * $result;
                    $ratio = $data[$i + 6]['value'];

                    // if result is not between delta error
                    if ($ratio > $max_threshold || $ratio < $min_threshold) {
                        $response = false;
                        break;
                    }
                }

                if($response === false)
                    $this->Answers->addMany($data,false,$user_id);
            }
            else
            {
                $response = false;
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize',['response']);
    }

    // check if there are missing inputs
    protected function missingValues($data = null)
    {
        foreach($data as $answer)
        {
            if(empty($answer['value']))
                return true;

        }
        return false;
    }

}