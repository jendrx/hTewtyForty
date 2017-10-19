<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Values Controller
 *
 * @property \App\Model\Table\ValuesTable $Values
 *
 * @method \App\Model\Entity\Value[] paginate($object = null, array $settings = [])
 */
class ValuesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $values = $this->paginate($this->Values);

        $this->set(compact('values'));
        $this->set('_serialize', ['values']);
    }

    /**
     * View method
     *
     * @param string|null $id Value id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $value = $this->Values->get($id, [
            'contain' => ['Answers', 'Previews', 'RoundsQuestionsIndicators']
        ]);

        $this->set('value', $value);
        $this->set('_serialize', ['value']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $value = $this->Values->newEntity();
        if ($this->request->is('post')) {
            $value = $this->Values->patchEntity($value, $this->request->getData());
            if ($this->Values->save($value)) {
                $this->Flash->success(__('The value has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The value could not be saved. Please, try again.'));
        }
        $answers = $this->Values->Answers->find('list', ['limit' => 200]);
        $previews = $this->Values->Previews->find('list', ['limit' => 200]);
        $roundsQuestionsIndicators = $this->Values->RoundsQuestionsIndicators->find('list', ['limit' => 200]);
        $this->set(compact('value', 'answers', 'previews', 'roundsQuestionsIndicators'));
        $this->set('_serialize', ['value']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Value id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $value = $this->Values->get($id, [
            'contain' => ['Answers', 'Previews', 'RoundsQuestionsIndicators']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $value = $this->Values->patchEntity($value, $this->request->getData());
            if ($this->Values->save($value)) {
                $this->Flash->success(__('The value has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The value could not be saved. Please, try again.'));
        }
        $answers = $this->Values->Answers->find('list', ['limit' => 200]);
        $previews = $this->Values->Previews->find('list', ['limit' => 200]);
        $roundsQuestionsIndicators = $this->Values->RoundsQuestionsIndicators->find('list', ['limit' => 200]);
        $this->set(compact('value', 'answers', 'previews', 'roundsQuestionsIndicators'));
        $this->set('_serialize', ['value']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Value id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $value = $this->Values->get($id);
        if ($this->Values->delete($value)) {
            $this->Flash->success(__('The value has been deleted.'));
        } else {
            $this->Flash->error(__('The value could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
