<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SignupConfirmations Model
 *
 * @property \App\Model\Table\CustomerUsersTable|\Cake\ORM\Association\BelongsTo $CustomerUsers
 *
 * @method \App\Model\Entity\SignupConfirmation get($primaryKey, $options = [])
 * @method \App\Model\Entity\SignupConfirmation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SignupConfirmation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SignupConfirmation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SignupConfirmation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SignupConfirmation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SignupConfirmation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SignupConfirmation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SignupConfirmationsTable extends Table
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

        $this->setTable('signup_confirmations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CustomerUsers', [
            'foreignKey' => 'customer_user_id'
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
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('ccw_token')
            ->allowEmpty('ccw_token');

        $validator
            ->dateTime('ccw_token_created_at')
            ->allowEmpty('ccw_token_created_at');

        $validator
            ->boolean('is_done')
            ->requirePresence('is_done', 'create')
            ->notEmpty('is_done');

        $validator
            ->boolean('is_confirmed')
            ->requirePresence('is_confirmed', 'create')
            ->notEmpty('is_confirmed');

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
        $rules->add($rules->existsIn(['customer_user_id'], 'CustomerUsers'));

        return $rules;
    }
}
