<?php
namespace App\Model\Table;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;


/**
 * Users Model
 *
 * @property \App\Model\Table\StudiesTable|\Cake\ORM\Association\BelongsToMany $Studies
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Studies', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'study_id',
            'joinTable' => 'users_studies'
        ]);

        $this->hasMany('Answers',['foreignKey' => 'user_id']);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('role')
            ->notEmpty('role');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }

/*
    public function getActiveStudy($id = null)
    {
        $study_id = $this->Studies->find('all',['conditions' => 'Studies.completed is null', 'order' => ['Studies.id' => 'ASC']])->matching('Users', function($q) use($id){
            return $q->where(['Users.id' => $id]);
        })->first();


        if(empty($study_id))
        {
            throw new RecordNotFoundException(__('Study not found'));
        }

        return $study_id;
    }*/



    public function getActiveStudy($id = null)
    {

        $usersStudiesTable = TableRegistry::get('users_studies');

        $query = $usersStudiesTable->find('all',['conditions' => ['user_id' => $id, 'completed is null'], 'order' => ['id' => 'ASC']])->firstorFail();

        $study = $this->Studies->get($query->study_id);
        
        return $study;
    }

    // dirty field is missing
    public function finishStudy($user_id,$study_id)
    {
        $usersStudiesTable = TableRegistry::get('users_studies');


        $query = $usersStudiesTable->find('all',['conditions' => ['user_id' => $user_id, 'study_id' => $study_id]])->first();

        $usersStudies = $usersStudiesTable->get($query->id);

        echo $usersStudies;

        $usersStudies->completed = Time::now();

        echo $usersStudies;
        if($usersStudiesTable->save($usersStudies))
            return true;

        return false;

    }


}
