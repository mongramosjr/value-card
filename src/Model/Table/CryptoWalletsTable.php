<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CryptoWallets Model
 *
 * @property \App\Model\Table\CustomerUsersTable|\Cake\ORM\Association\BelongsTo $CustomerUsers
 * @property \App\Model\Table\CryptoCurrenciesTable|\Cake\ORM\Association\BelongsTo $CryptoCurrencies
 *
 * @method \App\Model\Entity\CryptoWallet get($primaryKey, $options = [])
 * @method \App\Model\Entity\CryptoWallet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CryptoWallet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CryptoWallet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CryptoWallet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CryptoWallet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CryptoWallet findOrCreate($search, callable $callback = null, $options = [])
 */
class CryptoWalletsTable extends Table
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

        $this->setTable('crypto_wallets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('CustomerUsers', [
            'foreignKey' => 'customer_user_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('wallet_address')
            ->maxLength('wallet_address', 128)
            ->allowEmpty('wallet_address');

        $validator
            ->scalar('crypto_currency_name')
            ->maxLength('crypto_currency_name', 16)
            ->allowEmpty('crypto_currency_name');

        $validator
            ->scalar('password_crypt')
            ->maxLength('password_crypt', 128)
            ->allowEmpty('password_crypt');

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
        $rules->add($rules->existsIn(['crypto_currency_id'], 'CryptoCurrencies'));

        return $rules;
    }
}
