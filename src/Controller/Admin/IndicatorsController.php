<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Indicators Controller
 *
 * @property \App\Model\Table\IndicatorsTable $Indicators
 *
 * @method \App\Model\Entity\Indicator[] paginate($object = null, array $settings = [])
 */
class IndicatorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $indicators = $this->paginate($this->Indicators);

        $this->set(compact('indicators'));
        $this->set('_serialize', ['indicators']);
    }

    /**
     * View method
     *
     * @param string|null $id Indicator id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $indicator = $this->Indicators->get($id, [
            'contain' => ['Questions']
        ]);

        $this->set('indicator', $indicator);
        $this->set('_serialize', ['indicator']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $indicator = $this->Indicators->newEntity();
        if ($this->request->is('post')) {
            $indicator = $this->Indicators->patchEntity($indicator, $this->request->getData());
            if ($this->Indicators->save($indicator)) {
                $this->Flash->success(__('The indicator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The indicator could not be saved. Please, try again.'));
        }
        $this->set(compact('indicator', 'questions'));
        $this->set('_serialize', ['indicator']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Indicator id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $indicator = $this->Indicators->get($id, [
            'contain' => ['Questions']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $indicator = $this->Indicators->patchEntity($indicator, $this->request->getData());
            if ($this->Indicators->save($indicator)) {
                $this->Flash->success(__('The indicator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The indicator could not be saved. Please, try again.'));
        }
        $questions = $this->Indicators->Questions->find('list', ['limit' => 200]);
        $this->set(compact('indicator', 'questions'));
        $this->set('_serialize', ['indicator']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Indicator id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $indicator = $this->Indicators->get($id);
        if ($this->Indicators->delete($indicator)) {
            $this->Flash->success(__('The indicator has been deleted.'));
        } else {
            $this->Flash->error(__('The indicator could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
