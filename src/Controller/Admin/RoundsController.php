<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Http\Client;
use Cake\Collection\Collection;

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
            'contain' => ['Studies' => 'Users' , 'QuestionsIndicatorsYears']
        ]);

        $submitedState = $this->Rounds->getSumbitedState($id);

        $results = $this->Rounds->getResults($id);

        $this->set(compact('round','submitedState', 'results'));
        $this->set('_serialize', ['round','submitedState', 'results']);
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

    public function finish($id = null)
    {
        $this->request->allowMethod('post');
        $round = $this->Rounds->get($id);

        $round->completed = Time::now();

        if($this->Rounds->save($round))
        {
            $this->Flash->success(__('The round has been finished'));
        } else {
            $this->Flash->error(__('The round could not be finished'));
        }
        return $this->redirect(['controller' => 'Studies', 'action' => 'view',  $round->study_id]);
    }


    public function getAnswers( $id = null)
    {
        $query = $this->Rounds->getAnswers($id);
        $round = $this->Rounds->get($id,['contain' => 'Studies']);
        $jsonPost = array();
        foreach($query as $key => $values)
        {
            $indicators_years = array();
            $indicators = array();
            $indicators_years['year'] = $key;
            $indicators_years['scenario'] = $round['study']['scenario'];
            foreach($values as $value) {
                $indicator = array();
                $answers = array();
                $indicator['description'] = $value['questions_indicators_year']['questions_indicator']['indicator']['filename'];
                $indicator['question_indicator_year'] = $value['questions_indicators_year']['id'];

                foreach ($value['answers'] as $answer) {
                    array_push($answers, ['value' => $answer['value']]);
                }
                $indicator['answers'] = $answers;

                array_push($indicators, $indicator);

            }
            $indicators_years['indicators'] = $indicators;
            array_push($jsonPost,$indicators_years);

        }
        return $jsonPost;
    }

    protected function processData($inputArray = null)
    {
        //Encode the array into JSON.
        $jsonDataEncoded = json_encode(['json' => $inputArray]);
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'http://localhost:8000/processAnswers',
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS =>  $jsonDataEncoded,
            CURLOPT_RETURNTRANSFER => TRUE,
            ]);

            $response = json_decode(curl_exec($ch));
            curl_close($ch);
        return $response;
    }


    ## get Results from round by calling to R service and redirects to view
    public function testws($id = null)
    {
        $this->loadModel('Results');
        $answers = $this->getAnswers($id);

        $response  = array();
        foreach($answers as $answer)
        {
            $indicators = $this->processData(json_encode($answer));
            echo json_encode($indicators);
            foreach($indicators as $indicator )
            {
                echo json_encode($indicator);
                $toSave = array(array('round_id' => $id, 'question_indicator_year_id' => $indicator->question_indicator_year,'val' => $indicator->result));
                $this->Results->add($toSave);
            }
        }
        $this->redirect(['controller' => 'rounds','action' => 'view',$id]);
    }






}

