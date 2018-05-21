<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Currency Entity
 *
 * @property int $id
 * @property string $name
 * @property string $symbol
 * @property float $rounding
 * @property bool $is_active
 * @property string $position
 * @property string $currency_unit_label
 * @property string $currency_subunit_label
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\CryptoCurrencyRate[] $crypto_currency_rates
 */
class Currency extends Entity
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
        'name' => true,
        'symbol' => true,
        'rounding' => true,
        'is_active' => true,
        'position' => true,
        'currency_unit_label' => true,
        'currency_subunit_label' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'crypto_currency_rates' => true
    ];
}
