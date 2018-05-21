<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CryptoCurrencyRate Entity
 *
 * @property int $id
 * @property int $crypto_currency_id
 * @property string $crypto_currency_name
 * @property string $symbol
 * @property float $price
 * @property float $market_capitalization
 * @property float $circulating_supply
 * @property float $volume
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\CryptoCurrency $crypto_currency
 */
class CryptoCurrencyRate extends Entity
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
        'crypto_currency_id' => true,
        'crypto_currency_name' => true,
        'symbol' => true,
        'price' => true,
        'market_capitalization' => true,
        'circulating_supply' => true,
        'volume' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'crypto_currency' => true
    ];
}
