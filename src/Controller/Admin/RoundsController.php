<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Rounds Controller
 *
 * @property \App\Model\Table\RoundsTable $Rounds
 *
 * @method \App\Model\Entity\Round[] paginate($object = null, array $settings = [])
 */
class RoundsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Studies']
        ];
        $rounds = $this->paginate($this->Rounds);

        $this->set(compact('rounds'));
        $this->set('_serialize', ['rounds']);
    }

    /**
     * View method
     *
     * @param string|null $id Round id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $round = $this->Rounds->get($id, [
            'contain' => ['Studies', 'QuestionsIndicatorsYears']
        ]);

        $this->set('round', $round);
        $this->set('_serialize', ['round']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $round = $this->Rounds->newEntity();
        if ($this->request->is('post')) {
            $round = $this->Rounds->patchEntity($round, $this->request->getData());
            if ($this->Rounds->save($round)) {
                $this->Flash->success(__('The round has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The round could not be saved. Please, try again.'));
        }
        $studies = $this->Rounds->Studies->find('list', ['limit' => 200]);
        $questionsIndicatorsYears = $this->Rounds->QuestionsIndicatorsYears->find('list', ['limit' => 200]);
        $this->set(compact('round', 'studies', 'questionsIndicatorsYears'));
        $this->set('_serialize', ['round']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Round id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $round = $this->Rounds->get($id, [
            'contain' => ['QuestionsIndicatorsYears']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $round = $this->Rounds->patchEntity($round, $this->request->getData());
            if ($this->Rounds->save($round)) {
                $this->Flash->success(__('The round has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The round could not be saved. Please, try again.'));
        }
        $studies = $this->Rounds->Studies->find('list', ['limit' => 200]);
        $questionsIndicatorsYears = $this->Rounds->QuestionsIndicatorsYears->find('list', ['limit' => 200]);
        $this->set(compact('round', 'studies', 'questionsIndicatorsYears'));
        $this->set('_serialize', ['round']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Round id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $round = $this->Rounds->get($id);
        if ($this->Rounds->delete($round)) {
            $this->Flash->success(__('The round has been deleted.'));
        } else {
            $this->Flash->error(__('The round could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
