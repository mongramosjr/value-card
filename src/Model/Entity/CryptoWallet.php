<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CryptoWallet Entity
 *
 * @property int $id
 * @property string $customer_user_id
 * @property string $wallet_address
 * @property string $wallet_label
 * @property int $crypto_currency_id
 * @property string $crypto_currency_name
 * @property string $password_crypt
 *
 * @property \App\Model\Entity\CustomerUser $customer_user
 * @property \App\Model\Entity\CryptoCurrency $crypto_currency
 */
class CryptoWallet extends Entity
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
        'wallet_address' => true,
        'wallet_label' => true,
        'crypto_currency_id' => true,
        'crypto_currency_name' => true,
        'password_crypt' => true,
        'customer_user' => true,
        'crypto_currency' => true
    ];
}
