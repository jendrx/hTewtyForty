<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Indicators Model
 *
 * @property \App\Model\Table\QuestionsTable|\Cake\ORM\Association\BelongsToMany $Questions
 *
 * @method \App\Model\Entity\Indicator get($primaryKey, $options = [])
 * @method \App\Model\Entity\Indicator newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Indicator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Indicator|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Indicator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Indicator[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Indicator findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IndicatorsTable extends Table
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

        $this->setTable('indicators');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Questions', [
            'foreignKey' => 'indicator_id',
            'targetForeignKey' => 'question_id',
            'joinTable' => 'questions_indicators'
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
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        return $validator;
    }
}
