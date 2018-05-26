<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CryptoCurrencies Model
 *
 * @property \App\Model\Table\CryptoCurrencyRatesTable|\Cake\ORM\Association\HasMany $CryptoCurrencyRates
 * @property \App\Model\Table\CryptoTransactionsTable|\Cake\ORM\Association\HasMany $CryptoTransactions
 * @property \App\Model\Table\CryptoWalletsTable|\Cake\ORM\Association\HasMany $CryptoWallets
 *
 * @method \App\Model\Entity\CryptoCurrency get($primaryKey, $options = [])
 * @method \App\Model\Entity\CryptoCurrency newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CryptoCurrency[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CryptoCurrency|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CryptoCurrency patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CryptoCurrency[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CryptoCurrency findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CryptoCurrenciesTable extends Table
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

        $this->setTable('crypto_currencies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CryptoCurrencyRates', [
            'foreignKey' => 'crypto_currency_id'
        ]);
        $this->hasMany('CryptoTransactions', [
            'foreignKey' => 'crypto_currency_id'
        ]);
        $this->hasMany('CryptoWallets', [
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
            ->scalar('name')
            ->maxLength('name', 16)
            ->allowEmpty('name');

        $validator
            ->scalar('symbol')
            ->maxLength('symbol', 8)
            ->allowEmpty('symbol');

        $validator
            ->decimal('rounding')
            ->requirePresence('rounding', 'create')
            ->notEmpty('rounding');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->scalar('position')
            ->maxLength('position', 6)
            ->allowEmpty('position');

        $validator
            ->scalar('currency_unit_label')
            ->maxLength('currency_unit_label', 16)
            ->allowEmpty('currency_unit_label');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        return $validator;
    }
}
