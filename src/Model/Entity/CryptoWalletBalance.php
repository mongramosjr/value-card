<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CryptoWalletBalance Entity
 *
 * @property int $id
 * @property string $customer_user_id
 * @property string $crypto_wallet_id
 * @property int $crypto_currency_id
 * @property string $crypto_currency_name
 * @property float $amount
 * @property float $currency_amount
 * @property int $currency_id
 *
 * @property \App\Model\Entity\CustomerUser $customer_user
 * @property \App\Model\Entity\CryptoWallet $crypto_wallet
 * @property \App\Model\Entity\CryptoCurrency $crypto_currency
 * @property \App\Model\Entity\Currency $currency
 */
class CryptoWalletBalance extends Entity
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
        'crypto_wallet_id' => true,
        'crypto_currency_id' => true,
        'crypto_currency_name' => true,
        'amount' => true,
        'currency_amount' => true,
        'currency_id' => true,
        'customer_user' => true,
        'crypto_wallet' => true,
        'crypto_currency' => true,
        'currency' => true
    ];
}
