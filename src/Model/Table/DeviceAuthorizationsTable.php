<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DeviceAuthorizations Model
 *
 * @property \App\Model\Table\CustomerUsersTable|\Cake\ORM\Association\BelongsTo $CustomerUsers
 *
 * @method \App\Model\Entity\DeviceAuthorization get($primaryKey, $options = [])
 * @method \App\Model\Entity\DeviceAuthorization newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DeviceAuthorization[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DeviceAuthorization|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeviceAuthorization|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeviceAuthorization patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DeviceAuthorization[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DeviceAuthorization findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DeviceAuthorizationsTable extends Table
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

        $this->setTable('device_authorizations');
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
            ->scalar('device_info')
            ->maxLength('device_info', 128)
            ->allowEmpty('device_info');

        $validator
            ->dateTime('date_completed')
            ->allowEmpty('date_completed');

        $validator
            ->scalar('dauth_token')
            ->allowEmpty('dauth_token');

        $validator
            ->dateTime('dauth_token_created_at')
            ->allowEmpty('dauth_token_created_at');

        $validator
            ->boolean('is_completed')
            ->requirePresence('is_completed', 'create')
            ->notEmpty('is_completed');

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
