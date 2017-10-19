<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Previews Model
 *
 * @property \App\Model\Table\RoundsQuestionsIndicatorsTable|\Cake\ORM\Association\BelongsTo $RoundsQuestionsIndicators
 * @property \App\Model\Table\ValuesTable|\Cake\ORM\Association\BelongsToMany $Values
 *
 * @method \App\Model\Entity\Preview get($primaryKey, $options = [])
 * @method \App\Model\Entity\Preview newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Preview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Preview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Preview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Preview[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Preview findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PreviewsTable extends Table
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

        $this->setTable('previews');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RoundsQuestionsIndicators', [
            'foreignKey' => 'round_question_indicator_id'
        ]);
        $this->belongsToMany('Values', [
            'foreignKey' => 'preview_id',
            'targetForeignKey' => 'value_id',
            'joinTable' => 'previews_values'
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
        $rules->add($rules->existsIn(['round_question_indicator_id'], 'RoundsQuestionsIndicators'));

        return $rules;
    }
}
