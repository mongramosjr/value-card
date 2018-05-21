<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CryptoCurrencyRates Model
 *
 * @property \App\Model\Table\CryptoCurrenciesTable|\Cake\ORM\Association\BelongsTo $CryptoCurrencies
 * @property \App\Model\Table\CurrenciesTable|\Cake\ORM\Association\BelongsTo $Currencies
 *
 * @method \App\Model\Entity\CryptoCurrencyRate get($primaryKey, $options = [])
 * @method \App\Model\Entity\CryptoCurrencyRate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CryptoCurrencyRate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CryptoCurrencyRate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CryptoCurrencyRate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CryptoCurrencyRate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CryptoCurrencyRate findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CryptoCurrencyRatesTable extends Table
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

        $this->setTable('crypto_currency_rates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->scalar('symbol')
            ->maxLength('symbol', 4)
            ->allowEmpty('symbol');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->decimal('market_capitalization')
            ->requirePresence('market_capitalization', 'create')
            ->notEmpty('market_capitalization');

        $validator
            ->decimal('circulating_supply')
            ->requirePresence('circulating_supply', 'create')
            ->notEmpty('circulating_supply');

        $validator
            ->decimal('volume')
            ->requirePresence('volume', 'create')
            ->notEmpty('volume');

        $validator
            ->scalar('currency_name')
            ->maxLength('currency_name', 16)
            ->allowEmpty('currency_name');

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
        $rules->add($rules->existsIn(['crypto_currency_id'], 'CryptoCurrencies'));
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'));

        return $rules;
    }
}
