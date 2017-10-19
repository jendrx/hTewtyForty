<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AnswersValues Model
 *
 * @property \App\Model\Table\AnswersTable|\Cake\ORM\Association\BelongsTo $Answers
 * @property \App\Model\Table\ValuesTable|\Cake\ORM\Association\BelongsTo $Values
 *
 * @method \App\Model\Entity\AnswersValue get($primaryKey, $options = [])
 * @method \App\Model\Entity\AnswersValue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AnswersValue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AnswersValue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AnswersValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AnswersValue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AnswersValue findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AnswersValuesTable extends Table
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

        $this->setTable('answers_values');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Answers', [
            'foreignKey' => 'answer_id'
        ]);
        $this->belongsTo('Values', [
            'foreignKey' => 'value_id'
        ]);
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
            ->numeric('value')
            ->requirePresence('value', 'create')
            ->notEmpty('value');

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
        $rules->add($rules->existsIn(['answer_id'], 'Answers'));
        $rules->add($rules->existsIn(['value_id'], 'Values'));

        return $rules;
    }
}
