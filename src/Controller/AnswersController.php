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
        if($this->request->is('post'))
        {
            $data = $this->request->getData();
            $answers = $this->Answers->newEntities($data);

            $user_id = $this->Auth->user('id');

            foreach($answers as $answer)
            {
                $answer->user_id = $user_id;
            }

            if($this->Answers->saveMany($answers))
            {
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

}