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

        $round = null;
        try{
            $round = $this->Studies->getActiveRound($id);
        }catch(RecordNotFoundException $e)
        {
            $this->Flash->error($e);
        }

        return $this->redirect(['controller' => 'rounds', 'action' => 'view', $round['id']]);



    }


}