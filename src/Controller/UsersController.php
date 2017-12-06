<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10/19/17
 * Time: 11:57 AM
 */

namespace App\Controller;


use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event); // TODO: Change the autogenerated stub
        $this->Auth->allow('add');
    }

    public function add()
    {
        $user = $this->Users->newEntity();

        if($this->request->is('post'))
        {
            $data = $this->request->getData();
            $user = $this->Users->patchEntity($user, $data);
            $user->role = 'user';

            if($this->Users->save($user))
            {
                $this->Flash->success(__('User has been saved'));
                return $this->redirect(['controller' => 'users','action' => 'login']);
            }
            $this->Flash->error(__('Unable to register the user'));
        }
        $this->set(compact('user'));
        $this->set('_serialize',['user']);
    }

    public function login()
    {

        $this->viewBuilder()->setLayout('unlogged');
        if($this->request->is('post'))
        {
            $user = $this->Auth->identify();
            if($user)
            {
                $this->Auth->setUser($user);

                return $this->redirect(['action' => 'getActiveStudy']);
            }
            else
            {
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }
    }

    public function logout()
    {
        $this->viewBuilder()->setLayout('unlogged');
        return $this->redirect($this->Auth->logout());

    }


    public function getActiveStudy($answered = false)
    {
        $user_id = $this->Auth->user('id');

        $study = null;

        try{
            $study = $this->Users->getActiveStudy($user_id);
        }catch( RecordNotFoundException $e)
        {
            if($answered)
                $this->Flash->success(__('Obrigado pela sua colaboração.'));
            else
                $this->Flash->error(__('Não existem estudos associados à sua conta.'));
            $this->redirect(['action' => 'logout']);
        }

        if($study)
            return $this->redirect(['controller' => 'Studies', 'action' => 'view', $study['id']]);
    }
}