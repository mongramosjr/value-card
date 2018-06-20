<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DeviceAuthorization Entity
 *
 * @property string $id
 * @property string $customer_user_id
 * @property string $device_info
 * @property \Cake\I18n\FrozenTime $date_completed
 * @property string $dauth_token
 * @property \Cake\I18n\FrozenTime $dauth_token_created_at
 * @property bool $is_completed
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CustomerUser $customer_user
 */
class DeviceAuthorization extends Entity
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
        'device_info' => true,
        'date_completed' => true,
        'dauth_token' => true,
        'dauth_token_created_at' => true,
        'is_completed' => true,
        'created' => true,
        'modified' => true,
        'customer_user' => true
    ];
}
