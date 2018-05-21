<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Currencies Model
 *
 * @property \App\Model\Table\CryptoCurrencyRatesTable|\Cake\ORM\Association\HasMany $CryptoCurrencyRates
 *
 * @method \App\Model\Entity\Currency get($primaryKey, $options = [])
 * @method \App\Model\Entity\Currency newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Currency[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Currency|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Currency patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Currency[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Currency findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CurrenciesTable extends Table
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

        $this->setTable('currencies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CryptoCurrencyRates', [
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
            ->scalar('name')
            ->maxLength('name', 16)
            ->allowEmpty('name');

        $validator
            ->scalar('symbol')
            ->maxLength('symbol', 4)
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
            ->maxLength('position', 5)
            ->allowEmpty('position');

        $validator
            ->scalar('currency_unit_label')
            ->maxLength('currency_unit_label', 16)
            ->allowEmpty('currency_unit_label');

        $validator
            ->scalar('currency_subunit_label')
            ->maxLength('currency_subunit_label', 16)
            ->allowEmpty('currency_subunit_label');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        return $validator;
    }
}
