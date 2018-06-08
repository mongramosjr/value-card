<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoWallet $cryptoWallet
 */
?>
<div class="content">
    <h2><?= __('My Wallet') ?></h2>
<div class="row">
    <div class="users view large-6 medium-6 columns">
        <p>Earn points for every purchase made at participating partners.</p>
         <div class="row">
            <div class="large-8 medium-12 columns">
        <ul class="button-group round  even-2">
        <li>
            <?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send', isset($cryptoWallet->id) ? $cryptoWallet->id : null ], 
                ['class' => 'button round secondary']) ?>
        </li>
        <li>
            <?= $this->Html->link(__('Request'), ['controller' => 'PaymentTransactions', 'action' => 'receive', isset($cryptoWallet->id) ? $cryptoWallet->id : null], 
                ['class' => 'button round secondary']) ?> 
        </li>
        </ul>
        </div>
        </div>
    </div>
    <div class="users view large-6 medium-6 columns">
        <div class="text-right">
        <h5>Available Balance</h5>
        <p>0.00</p>
        </div>
    </div>
</div>    
    
    <hr/>
    
<div class="row">
    <div class="cryptoWallets view large-12 medium-12 columns">
        <h3><?= h($cryptoWallet->wallet_label) ?></h3>
        <table class="vertical-table">
            <tr>
                <th scope="row"><?= __('Crypto Currency') ?></th>
                <td><?= $cryptoWallet->has('crypto_currency') ? $cryptoWallet->crypto_currency->currency_unit_label : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Wallet Address') ?></th>
                <td><?= h($cryptoWallet->wallet_address) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Label') ?></th>
                <td><?= h($cryptoWallet->wallet_label) ?></td>
            </tr>
            
        </table>
    </div>
</div>

</div>
