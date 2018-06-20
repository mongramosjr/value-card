<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CryptoWalletBalances Model
 *
 * @property \App\Model\Table\CustomerUsersTable|\Cake\ORM\Association\BelongsTo $CustomerUsers
 * @property \App\Model\Table\CryptoWalletsTable|\Cake\ORM\Association\BelongsTo $CryptoWallets
 * @property \App\Model\Table\CryptoCurrenciesTable|\Cake\ORM\Association\BelongsTo $CryptoCurrencies
 * @property \App\Model\Table\CurrenciesTable|\Cake\ORM\Association\BelongsTo $Currencies
 *
 * @method \App\Model\Entity\CryptoWalletBalance get($primaryKey, $options = [])
 * @method \App\Model\Entity\CryptoWalletBalance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CryptoWalletBalance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CryptoWalletBalance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CryptoWalletBalance|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CryptoWalletBalance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CryptoWalletBalance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CryptoWalletBalance findOrCreate($search, callable $callback = null, $options = [])
 */
class CryptoWalletBalancesTable extends Table
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

        $this->setTable('crypto_wallet_balances');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('CustomerUsers', [
            'foreignKey' => 'customer_user_id'
        ]);
        $this->belongsTo('CryptoWallets', [
            'foreignKey' => 'crypto_wallet_id'
        ]);
        $this->belongsTo('CryptoCurrencies', [
            'foreignKey' => 'crypto_currency_id'
        ]);
        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('crypto_currency_name')
            ->maxLength('crypto_currency_name', 16)
            ->allowEmpty('crypto_currency_name');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->decimal('currency_amount')
            ->requirePresence('currency_amount', 'create')
            ->notEmpty('currency_amount');

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
        $rules->add($rules->existsIn(['crypto_wallet_id'], 'CryptoWallets'));
        $rules->add($rules->existsIn(['crypto_currency_id'], 'CryptoCurrencies'));
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'));

        return $rules;
    }
}
