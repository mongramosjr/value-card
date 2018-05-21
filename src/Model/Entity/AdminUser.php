<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AdminUser Entity
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password_crypt
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $logdate
 * @property int $lognum
 * @property bool $is_active
 * @property string $rp_token
 * @property \Cake\I18n\FrozenTime $rp_token_created_at
 */
class AdminUser extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'password_crypt' => true,
        'created' => true,
        'modified' => true,
        'logdate' => true,
        'lognum' => true,
        'is_active' => true,
        'rp_token' => true,
        'rp_token_created_at' => true
    ];
}
