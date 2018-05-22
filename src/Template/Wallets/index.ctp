<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CryptoWallet[]|\Cake\Collection\CollectionInterface $cryptoWallets
 */
?>
<div class="content">
<div class="row">
    <div class="cryptoWallets index large-12 medium-12 columns">
        <h3><?= __('Wallets') ?></h3>
        
            
        <?= $this->Form->create($cryptoWallet, ['url' => [$customer_user_id]]) ?>
            
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
                    <?= $this->Html->link(__('+ Create New Wallet'), ['controller' => 'Wallets', 'action' => 'create', $customer_user_id], ['class' => 'button round secondary right']) ?>
                    </div>
                </div>
            </div>
            
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('crypto_currency_name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('wallet_address') ?></th>
                    <th scope="col" class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($wallets as $cryptoWallet): ?>
                <tr>
                    <td><?= $this->Number->format($cryptoWallet->id) ?></td>
                    <td><?= h($cryptoWallet->wallet_address) ?></td>
                    <td><?= $cryptoWallet->has('crypto_currency') ? $this->Html->link($cryptoWallet->crypto_currency->name, ['controller' => 'CryptoCurrencies', 'action' => 'view', $cryptoWallet->crypto_currency->id]) : '' ?></td>
                    <td><?= h($cryptoWallet->crypto_currency_name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Details'), ['controller' => 'Wallets', 'action' => 'view', $cryptoWallet->id]) ?>
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
<div class="row">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('Me'), ['controller' => 'Users', 'action' => 'view', $customer_user_id]) ?></li>
            <li><?= $this->Html->link(__('My Wallets'), ['controller' => 'Wallets', 'action' => 'index', $customer_user_id]) ?></li>
            <li><?= $this->Html->link(__('New Wallet'), ['controller' => 'Wallets', 'action' => 'create', $customer_user_id]) ?> </li>
            <li><?= $this->Html->link(__('Crypto Currencies'), ['controller' => 'CryptoCurrencyRates', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Transactions'), ['controller' => 'PaymentTransactions', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('Send'), ['controller' => 'PaymentTransactions', 'action' => 'send']) ?> </li>
            <li><?= $this->Html->link(__('Receive'), ['controller' => 'PaymentTransactions', 'action' => 'receive']) ?> </li>
        </ul>
    </nav>
</div>

</div>
