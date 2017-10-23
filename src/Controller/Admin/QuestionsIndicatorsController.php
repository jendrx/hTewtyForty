<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * QuestionsIndicators Controller
 *
 * @property \App\Model\Table\QuestionsIndicatorsTable $QuestionsIndicators
 *
 * @method \App\Model\Entity\QuestionsIndicator[] paginate($object = null, array $settings = [])
 */
class QuestionsIndicatorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Questions', 'Indicators']
        ];
        $questionsIndicators = $this->paginate($this->QuestionsIndicators);

        $this->set(compact('questionsIndicators'));
        $this->set('_serialize', ['questionsIndicators']);
    }

    /**
     * View method
     *
     * @param string|null $id Questions Indicator id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionsIndicator = $this->QuestionsIndicators->get($id, [
            'contain' => ['Questions', 'Indicators', 'Years']
        ]);

        $this->set('questionsIndicator', $questionsIndicator);
        $this->set('_serialize', ['questionsIndicator']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionsIndicator = $this->QuestionsIndicators->newEntity();
        if ($this->request->is('post')) {
            $data  = $this->request->getData();
            debug($data);


            $questionsIndicator = $this->QuestionsIndicators->patchEntity($questionsIndicator, $data,['associated' => ['Years']]);


            if ($this->QuestionsIndicators->save($questionsIndicator)) {
                $this->Flash->success(__('The questions indicator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The questions indicator could not be saved. Please, try again.'));
        }
        $questions = $this->QuestionsIndicators->Questions->find('list',['keyField' => 'id', 'valueField' => 'description' ]);
        $indicators = $this->QuestionsIndicators->Indicators->find('list',['keyField' => 'id', 'valueField' => 'description' ]);
        $years = $this->QuestionsIndicators->Years->find('list', ['keyField' => 'id', 'valueField' => 'description' ]);
        $this->set(compact('questionsIndicator', 'questions', 'indicators', 'years'));
        $this->set('_serialize', ['questionsIndicator']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Questions Indicator id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionsIndicator = $this->QuestionsIndicators->get($id, [
            'contain' => ['Years']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionsIndicator = $this->QuestionsIndicators->patchEntity($questionsIndicator, $this->request->getData());
            if ($this->QuestionsIndicators->save($questionsIndicator)) {
                $this->Flash->success(__('The questions indicator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The questions indicator could not be saved. Please, try again.'));
        }
        $questions = $this->QuestionsIndicators->Questions->find('list', ['limit' => 200]);
        $indicators = $this->QuestionsIndicators->Indicators->find('list', ['limit' => 200]);
        $years = $this->QuestionsIndicators->Years->find('list', ['limit' => 200]);
        $this->set(compact('questionsIndicator', 'questions', 'indicators', 'years'));
        $this->set('_serialize', ['questionsIndicator']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Questions Indicator id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionsIndicator = $this->QuestionsIndicators->get($id);
        if ($this->QuestionsIndicators->delete($questionsIndicator)) {
            $this->Flash->success(__('The questions indicator has been deleted.'));
        } else {
            $this->Flash->error(__('The questions indicator could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
