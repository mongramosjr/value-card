<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoWallet[]|\Cake\Collection\CollectionInterface $cryptoWallets
 */
?>
<div class="content">
    
<h2><?= __('My Wallets') ?></h2>
<div class="row">
    <div class="users view large-6 medium-6 columns">
        <p>Earn points for every purchase made at participating partners.</p>
         <div class="row">
            <div class="large-8 medium-12 columns">
                
        <ul class="button-group round  even-2">
        <li>
            <?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?>
        </li>
        <li>
            <?= $this->Html->link(__('Request'), ['controller' => 'PaymentTransactions', 'action' => 'receive', isset($cryptoWallet->id) ? $cryptoWallet->id : null], ['class' => 'button round secondary']) ?> 
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
    <div class="cryptoWallets index large-12 medium-12 columns">
        
            
        <?= $this->Form->create($wallet, ['type'=>'post', 'url' => ['controller' => 'Wallets', 'action' => 'index', isset($cryptoWallet->id) ? $cryptoWallet->id : null]]) ?>
            
            <div class="large-8 medium-12 columns">
                <div class="row collapse postfix-round">
                    <div class="large-3 medium-4 columns">
                    <?php echo $this->Form->control('crypto_currency_id', ['options' => $cryptoCurrencies, 'empty' => false, 'label' => false]); ?>
                    </div>
                    <div class="large-6 medium-5 columns">
                    <?php echo $this->Form->control('wallet_address', ['label' => false, 'placeholder' => 'Address or label']); ?>
                    </div>
                    <div class="large-3 medium-3 columns">
                    <?= $this->Form->button(__('Filter'), ['class' => 'button secondary round postfix']) ?>
                    </div>
                </div>
            </div>
            
        <?= $this->Form->end() ?>
            <div class="large-4 medium-12 columns">
                <div class="row collapse">
                    <div class="large-12 medium-12 columns">
                    <?= $this->Html->link(__('+ Create New Wallet'), ['controller' => 'Wallets', 'action' => 'create'], ['class' => 'button round secondary right']) ?>
                    </div>
                </div>
            </div>
            
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('crypto_currency_name', ['label' => 'Crypto Currency']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('wallet_address') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('wallet_label', ['label' => 'Label']) ?></th>
                    <th scope="col" class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($wallets as $wallet): ?>
                <tr>
                    <td><?= $wallet->has('crypto_currency') ? $wallet->crypto_currency->currency_unit_label : '' ?></td>
                    <td><?= h($wallet->wallet_address) ?></td>
                    <td><?= h($wallet->wallet_label) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['controller' => 'Wallets', 'action' => 'view', $wallet->id], ['class' => 'button round secondary right']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>

</div>
