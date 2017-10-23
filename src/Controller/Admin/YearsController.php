<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Years Controller
 *
 * @property \App\Model\Table\YearsTable $Years
 *
 * @method \App\Model\Entity\Year[] paginate($object = null, array $settings = [])
 */
class YearsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $years = $this->paginate($this->Years);

        $this->set(compact('years'));
        $this->set('_serialize', ['years']);
    }

    /**
     * View method
     *
     * @param string|null $id Year id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $year = $this->Years->get($id, [
            'contain' => ['QuestionsIndicators']
        ]);

        $this->set('year', $year);
        $this->set('_serialize', ['year']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $year = $this->Years->newEntity();
        if ($this->request->is('post')) {
            $year = $this->Years->patchEntity($year, $this->request->getData());
            if ($this->Years->save($year)) {
                $this->Flash->success(__('The year has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The year could not be saved. Please, try again.'));
        }
        $questionsIndicators = $this->Years->QuestionsIndicators->find('list', ['limit' => 200]);
        $this->set(compact('year', 'questionsIndicators'));
        $this->set('_serialize', ['year']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Year id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $year = $this->Years->get($id, [
            'contain' => ['QuestionsIndicators']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $year = $this->Years->patchEntity($year, $this->request->getData());
            if ($this->Years->save($year)) {
                $this->Flash->success(__('The year has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The year could not be saved. Please, try again.'));
        }
        $questionsIndicators = $this->Years->QuestionsIndicators->find('list', ['limit' => 200]);
        $this->set(compact('year', 'questionsIndicators'));
        $this->set('_serialize', ['year']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Year id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $year = $this->Years->get($id);
        if ($this->Years->delete($year)) {
            $this->Flash->success(__('The year has been deleted.'));
        } else {
            $this->Flash->error(__('The year could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
