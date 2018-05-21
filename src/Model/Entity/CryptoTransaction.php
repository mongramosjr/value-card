<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CryptoTransaction Entity
 *
 * @property string $id
 * @property string $customer_user_id
 * @property float $amount
 * @property string $source_wallet_address
 * @property string $target_wallet_address
 * @property float $fees
 * @property string $acquirer_reference
 * @property float $currency_amount
 * @property int $currency_id
 * @property string $currency_name
 * @property string $transaction_hash
 * @property string $transaction_type
 * @property int $crypto_currency_id
 * @property string $crypto_currency_name
 * @property string $state
 * @property \Cake\I18n\FrozenTime $date_completed
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\CustomerUser $customer_user
 * @property \App\Model\Entity\Currency $currency
 * @property \App\Model\Entity\CryptoCurrency $crypto_currency
 */
class CryptoTransaction extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'customer_user_id' => true,
        'amount' => true,
        'source_wallet_address' => true,
        'target_wallet_address' => true,
        'fees' => true,
        'acquirer_reference' => true,
        'currency_amount' => true,
        'currency_id' => true,
        'currency_name' => true,
        'transaction_hash' => true,
        'transaction_type' => true,
        'crypto_currency_id' => true,
        'crypto_currency_name' => true,
        'state' => true,
        'date_completed' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'customer_user' => true,
        'currency' => true,
        'crypto_currency' => true
    ];
}
