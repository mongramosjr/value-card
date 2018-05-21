<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CryptoTransactions Model
 *
 * @property \App\Model\Table\CustomerUsersTable|\Cake\ORM\Association\BelongsTo $CustomerUsers
 * @property \App\Model\Table\CurrenciesTable|\Cake\ORM\Association\BelongsTo $Currencies
 * @property \App\Model\Table\CryptoCurrenciesTable|\Cake\ORM\Association\BelongsTo $CryptoCurrencies
 *
 * @method \App\Model\Entity\CryptoTransaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\CryptoTransaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CryptoTransaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CryptoTransaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CryptoTransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CryptoTransaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CryptoTransaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CryptoTransactionsTable extends Table
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

        $this->setTable('crypto_transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CustomerUsers', [
            'foreignKey' => 'customer_user_id'
        ]);
        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id'
        ]);
        $this->belongsTo('CryptoCurrencies', [
            'foreignKey' => 'crypto_currency_id'
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->scalar('source_wallet_address')
            ->maxLength('source_wallet_address', 128)
            ->allowEmpty('source_wallet_address');

        $validator
            ->scalar('target_wallet_address')
            ->maxLength('target_wallet_address', 128)
            ->allowEmpty('target_wallet_address');

        $validator
            ->decimal('fees')
            ->requirePresence('fees', 'create')
            ->notEmpty('fees');

        $validator
            ->scalar('acquirer_reference')
            ->maxLength('acquirer_reference', 128)
            ->allowEmpty('acquirer_reference');

        $validator
            ->decimal('currency_amount')
            ->requirePresence('currency_amount', 'create')
            ->notEmpty('currency_amount');

        $validator
            ->scalar('currency_name')
            ->maxLength('currency_name', 16)
            ->allowEmpty('currency_name');

        $validator
            ->scalar('transaction_hash')
            ->maxLength('transaction_hash', 128)
            ->allowEmpty('transaction_hash');

        $validator
            ->scalar('transaction_type')
            ->maxLength('transaction_type', 8)
            ->allowEmpty('transaction_type');

        $validator
            ->scalar('crypto_currency_name')
            ->maxLength('crypto_currency_name', 16)
            ->allowEmpty('crypto_currency_name');

        $validator
            ->scalar('state')
            ->maxLength('state', 8)
            ->allowEmpty('state');

        $validator
            ->dateTime('date_completed')
            ->allowEmpty('date_completed');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

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
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'));
        $rules->add($rules->existsIn(['crypto_currency_id'], 'CryptoCurrencies'));

        return $rules;
    }
}
